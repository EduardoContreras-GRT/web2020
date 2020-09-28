/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


"use strict";
var _createClass = function () {
    function defineProperties(target, props) {
        for (var i = 0; i < props.length; i++) {
            var descriptor = props[i];
            descriptor.enumerable = descriptor.enumerable || !1,
                    descriptor.configurable = !0,
                    "value"in descriptor && (descriptor.writable = !0),
                    Object.defineProperty(target, descriptor.key, descriptor)
        }
    }
    return function (Constructor, protoProps, staticProps) {
        return protoProps && defineProperties(Constructor.prototype, protoProps),
                staticProps && defineProperties(Constructor, staticProps),
                Constructor
    }
}(),
        landing = function () {
            var a = function () {
                function a() {
                    _classCallCheck(this, a)
                }
                return _createClass(a, [{
                        key: "setFieldsData",
                        value: function setFieldsData(b) {
                            for (var c in this.config.fields) {
                                var d = this.config.fields[c];
                                a.addFieldRecord(b, c, a.getElementValueBySelector(d))
                            }
                        }
                    }, {
                        key: "getLandingData",
                        value: function getLandingData() {
                            var b = {
                                formId: this.config.landingId,
                                formFieldsData: []
                            };
                            console.log("----------");
                            console.log(b);
                            console.log("----------");

                            return this.setFieldsData(b),
                                    a.setCookiesData(b),
                                    b
                        }
                    }, {
                        key: "onError",
                        value: function onError(b, c, d) {
                            a.jQuery.isFunction(this.config.onError) && this.config.onError(b, c, d)
                        }
                    }, {
                        key: "onComplete",
                        value: function onComplete(b) {
                            a.jQuery.isFunction(this.config.onComplete) && this.config.onComplete(b)
                        }
                    }, {
                        key: "onSuccess",
                        value: function onSuccess(b) {
                            a.jQuery.isFunction(this.config.onSuccess) && this.config.onSuccess(b)
                        }
                    }, {
                        key: "onResponse",
                        value: function onResponse(b) {
                            var c = b.SaveWebFormLeadDataResult || b.SaveWebFormObjectDataResult;
                            if (c) {
                                var _d = a.parseResponse(c);
                                this.config.onSuccess ? this.onSuccess(_d) : 0 === _d.resultCode && this.config.redirectUrl && this.redirect()
                            }
                        }
                    }, {
                        key: "redirect",
                        value: function redirect() {
                            window.location.href = this.config.redirectUrl
                        }
                    }, {
                        key: "createObjectFromLanding",
                        value: function createObjectFromLanding(b) {
                            this.config = b;
                            var c = {
                                formData: this.getLandingData()
                            };
                            console.log("Json Enviado: " + JSON.stringify(c));
                            this.addContactRegistrationInfo(c.formData),
                                    a.jQuery.ajax({
                                        url: b.serviceUrl,
                                        type: "POST",
                                        data: JSON.stringify({
                                            "formData": {
                                                "formId": "a8dd3d5f-a3b0-4658-a661-49b94eda74b4",
                                                "formFieldsData": [{
                                                        "name": "Subject",
                                                        "value": "Titulo"
                                                    }, {
                                                        "name": "Email",
                                                        "value": "mail"
                                                    }, {
                                                        "name": "Name",
                                                        "value": "nombre"
                                                    }, {
                                                        "name": "Phone",
                                                        "value": "9837832882"
                                                    }, {
                                                        "name": "Symptoms",
                                                        "value": "Todo lo que quiere decir"
                                                    }, {
                                                        "name": "BpmHref",
                                                        "value": "http://localhost/~grahamross/2019/bpmindex.html"
                                                    }, {
                                                        "name": "BpmSessionId",
                                                        "value": "e468b2f5-cb18-a8c7-5206-dcd40deaa232"
                                                    }]
                                            }
                                        }),
                                        contentType: "application/json; charset=UTF-8",
                                        async: !0,
                                        crossDomain: !0,
                                        error: this.onError.bind(this),
                                        success: this.onResponse.bind(this),
                                        complete: this.onComplete.bind(this)
                                    })
                        }
                    }, {
                        key: "addContactRegistrationInfo",
                        value: function addContactRegistrationInfo(b) {
                            this.contactId.value && b.formFieldsData.push(this.contactId),
                                    this.bulkEmailRecipientId.value && b.formFieldsData.push(this.bulkEmailRecipientId)
                        }
                    }, {
                        key: "createLeadFromLanding",
                        value: function createLeadFromLanding(b) {
                            return console.warn("Method \"createLeadFromLanding()\" is obsolete. Use \"createObjectFromLanding()\""),
                                    this.createObjectFromLanding(b)
                        }
                    }, {
                        key: "initLanding",
                        value: function initLanding(b) {
                            if (!a.isIE())
                                for (var c in b.fields) {
                                    var d = a.getURLParameter(c.replace(".", "_"));
                                    a.setElementValueBySelector(b.fields[c], d)
                                }
                        }
                    }, {
                        key: "contactId",
                        get: function get() {
                            if (!this._contactId) {
                                var b = a.contactIdKey;
                                this._contactId = {
                                    name: b,
                                    value: a.getURLParameter(b) || a.getCookie(b)
                                }
                            }
                            return this._contactId
                        }
                    }, {
                        key: "bulkEmailRecipientId",
                        get: function get() {
                            if (!this._bulkEmailRecipientId) {
                                var b = a.bulkEmailRecipientIdKey;
                                this._bulkEmailRecipientId = {
                                    name: b,
                                    value: a.getURLParameter(b) || a.getCookie(b)
                                }
                            }
                            return this._bulkEmailRecipientId
                        }
                    }, {
                        key: "config",
                        get: function get() {
                            if (!this._config)
                                throw Error("Config not found");
                            return this._config
                        },
                        set: function set(b) {
                            this._config = b
                        }
                    }], [{
                        key: "$",
                        value: function $() {
                            if (!window.jQuery)
                                throw Error("jQuery not found");
                            return window.jQuery.apply(window.jQuery, arguments)
                        }
                    }, {
                        key: "addFieldRecord",
                        value: function addFieldRecord(b, c, d) {
                            b.formFieldsData.push({
                                name: c,
                                value: d
                            })
                        }
                    }, {
                        key: "parseResponse",
                        value: function parseResponse(b) {
                            return b = b.replace("resultCode", "\"resultCode\""),
                                    b = b.replace("resultMessage", "\"resultMessage\""),
                                    JSON.parse(b)
                        }
                    }, {
                        key: "getCookie",
                        value: function getCookie(b) {
                            if (!b)
                                return "";
                            var c = new RegExp("(?:(?:^|.*;)\\s*" + b + "\\s*\\=\\s*([^;]*).*$)|^.*$");
                            return a.cookie.replace(c, "$1") || ""
                        }
                    }, {
                        key: "getCorrectCookiesName",
                        value: function getCorrectCookiesName(b) {
                            return {
                                BpmRef: "bpmRef",
                                BpmHref: "bpmHref",
                                BpmSessionId: "bpmTrackingId"
                            }[b]
                        }
                    }, {
                        key: "setCookiesData",
                        value: function setCookiesData(b) {
                            var _arr = ["BpmRef", "BpmHref", "BpmSessionId"];
                            for (var _i = 0; _i < _arr.length; _i++) {
                                var c = _arr[_i]
                                        , d = a.getCorrectCookiesName(c)
                                        , e = a.getCookie(d);
                                e && a.addFieldRecord(b, c, e)
                            }
                        }
                    }, {
                        key: "getElementValueBySelector",
                        value: function getElementValueBySelector(b) {
                            var c = a.$(b)[0];
                            return c ? a.$(c).is(":checkbox") ? a.$(c).prop("checked") : a.$(c).val() : ""
                        }
                    }, {
                        key: "setElementValueBySelector",
                        value: function setElementValueBySelector(b, c) {
                            var d = a.$(b)[0];
                            d && a.$(d).val(c)
                        }
                    }, {
                        key: "getURLParameter",
                        value: function getURLParameter(b) {
                            return decodeURIComponent((RegExp("[?|&]" + b + "=(.+?)(&|$)", "i").exec(a.getLocationSearch()) || [, ""])[1])
                        }
                    }, {
                        key: "getLocationSearch",
                        value: function getLocationSearch() {
                            return location.search
                        }
                    }, {
                        key: "isIE",
                        value: function isIE() {
                            return /msie|trident/i.test(window.navigator.userAgent)
                        }
                    }, {
                        key: "contactIdKey",
                        get: function get() {
                            return "ContactId"
                        }
                    }, {
                        key: "bulkEmailRecipientIdKey",
                        get: function get() {
                            return "BulkEmailRecipientId"
                        }
                    }, {
                        key: "cookieExpireDays",
                        get: function get() {
                            return 7
                        }
                    }, {
                        key: "cookie",
                        get: function get() {
                            return document.cookie
                        }
                    }, {
                        key: "jQuery",
                        get: function get() {
                            if (!window.jQuery)
                                throw Error("jQuery not found");
                            return window.jQuery
                        }
                    }]),
                        a
            }();
            return new a(window.$)
        }();
function _classCallCheck(instance, Constructor) {
    if (!(instance instanceof Constructor))
        throw new TypeError("Cannot call a class as a function")
}
