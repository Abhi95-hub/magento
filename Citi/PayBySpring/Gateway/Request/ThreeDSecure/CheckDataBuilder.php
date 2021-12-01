<?php
/**
 * Copyright (c) 2020-2021 Citigroup
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace Citi\PayBySpring\Gateway\Request\ThreeDSecure;

use Magento\Framework\Exception\LocalizedException;
use Magento\Payment\Gateway\Request\BuilderInterface;
use Magento\Payment\Gateway\Helper\SubjectReader;
use Magento\Framework\UrlInterface;
use Citi\PayBySpring\Model\Ui\Hpf\ConfigProvider;

class CheckDataBuilder implements BuilderInterface
{
    public const PAGE_GENERATION_MODE = 'CUSTOMIZED';
    public const RESPONSE_URL = 'citi/threedsecure/response';
    public const RESPONSE_SID_PARAMETER = 'citi_sid';

    /**
     * @var UrlInterface
     */
    protected $urlHelper;

    /**
     * @param UrlInterface $urlHelper
     */
    public function __construct(UrlInterface $urlHelper)
    {
        $this->urlHelper = $urlHelper;
    }

    /**
     * Builds ENV request
     *
     * @param array $buildSubject
     * @return array
     *
     * @throws LocalizedException
     */
    public function build(array $buildSubject)
    {
        $paymentDO = SubjectReader::readPayment($buildSubject);
        $order = $paymentDO->getOrder();
        $payment = $paymentDO->getPayment();

        $data = [
            '3DSecure' => [
                'authenticationRedirect' => [
                    'pageGenerationMode' => static::PAGE_GENERATION_MODE,
                    'responseUrl' => $this->urlHelper->getUrl(static::RESPONSE_URL),
                ]
            ],
            'order' => [
                'amount' => sprintf('%.2F', SubjectReader::readAmount($buildSubject)),
                'currency' => $order->getCurrencyCode(),
            ],
        ];

        $code = $payment->getMethodInstance()->getCode();

        if ($code === ConfigProvider::METHOD_CODE) {
            $data = array_merge($data, [
                'session' => [
                    'id' => $payment->getAdditionalInformation('session')
                ]
            ]);
        }

        return $data;
    }
}
