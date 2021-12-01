/*
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
/*browser:true*/
/*global define*/
define(
    [
        'uiComponent',
        'Magento_Checkout/js/model/payment/renderer-list'
    ],
    function (
        Component,
        rendererList
    ) {
        'use strict';
        rendererList.push(
            {
                type: 'citi_hosted',
                component: 'Citi_PayBySpring/js/view/payment/method-renderer/citi-hosted'
            },
            {
                type: 'citi_hpf',
                component: 'Citi_PayBySpring/js/view/payment/method-renderer/citi-hpf'
            },
            {
                type: 'citi_ach',
                component: 'Citi_PayBySpring/js/view/payment/method-renderer/ach'
            }
        );
        /** Add view logic here if needed */
        return Component.extend({});
    }
);
