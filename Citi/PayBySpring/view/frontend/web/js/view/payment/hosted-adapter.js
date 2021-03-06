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
define([
    'jquery'
], function ($) {
    'use strict';

    return {
        loadApi: function (componentUrl, onLoadedCallback, onError, onCancel, onComplete) {
            window.citiErrorCallback = $.proxy(onError, this);
            window.citiCancelCallback = $.proxy(onCancel, this);
            window.citiCompletedCallback = $.proxy(onComplete, this);

            var node = requirejs.load({
                contextName: '_',
                onScriptLoad: $.proxy(onLoadedCallback, this)
            }, 'citi_hosted', componentUrl);

            node.setAttribute('data-error', 'window.citiErrorCallback');
            node.setAttribute('data-cancel', 'window.citiCancelCallback');
            node.setAttribute('data-complete', 'window.citiCompletedCallback');
        },
        configureApi: function (merchant, sessionId, sessionVersion) {
            Checkout.configure({
                merchant: merchant,
                session: {
                    id: sessionId,
                    version: sessionVersion
                }
            });
        },
        showPayment: function () {
            Checkout.showLightbox();
        }
    };
});
