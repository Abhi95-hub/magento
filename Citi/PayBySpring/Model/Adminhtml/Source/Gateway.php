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

namespace Citi\PayBySpring\Model\Adminhtml\Source;

use Magento\Framework\Option\ArrayInterface;
use Citi\PayBySpring\Gateway\Config\Config;

class Gateway implements ArrayInterface
{
    /**
     * Return array of options as value-label pairs
     *
     * @return array Format: array(array('value' => '<value>', 'label' => '<label>'), ...)
     */
    public function toOptionArray()
    {
        return [
            [
                'value' => Config::API_SPRING_PRODUCTION,
                'label' => __('Spring Production')
            ],
            [
                'value' => Config::API_SPRING_SANDBOX,
                'label' => __('Spring Sandbox')
            ]
        ];
    }
}
