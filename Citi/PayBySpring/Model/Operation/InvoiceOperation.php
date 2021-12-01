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
declare(strict_types=1);

namespace Citi\PayBySpring\Model\Operation;

use Magento\Framework\Exception\LocalizedException;
use Magento\Sales\Api\Data\OrderPaymentInterface;
use Magento\Sales\Model\Order\Payment;

class InvoiceOperation
{
    /**
     * @param OrderPaymentInterface $payment
     * @return OrderPaymentInterface
     * @throws LocalizedException
     */
    public function execute(OrderPaymentInterface $payment): OrderPaymentInterface
    {
        /** @var Payment $payment */
        $invoice = $payment->getOrder()->prepareInvoice();
        $invoice->register();

        $invoice->setIsPaid(true);
        $invoice->setTransactionId($payment->getLastTransId());
        $invoice->pay();

        $payment->getOrder()->addRelatedObject($invoice);
        $payment->setCreatedInvoice($invoice);

        return $payment;
    }
}
