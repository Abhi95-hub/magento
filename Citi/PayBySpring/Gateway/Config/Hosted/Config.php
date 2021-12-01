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

namespace Citi\PayBySpring\Gateway\Config\Hosted;

use Citi\PayBySpring\Gateway\Config\ConfigInterface;

class Config extends \Citi\PayBySpring\Gateway\Config\Config implements ConfigInterface
{
    //const COMPONENT_URI = '%scheckout/version/%s/checkout.js';
    const COMPONENT_URI = 'https://citi.mtf.gateway.mastercard.com/checkout/version/58/checkout.js';
    /**
     * @var string
     */
    protected $method = 'citi_hosted';

    /**
     * @return string
     */
    public function getComponentUrl()
    {
        return sprintf(
            static::COMPONENT_URI,
            $this->getApiAreaUrl(),
            $this->getValue('api_version')
        );
    }

    /**
     * @return bool
     */
    public function isVaultEnabled()
    {
        return false;
    }
}
