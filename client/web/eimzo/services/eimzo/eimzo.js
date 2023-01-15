var AppLoad = function () {
    EIMZOClient.API_KEYS = [
        'localhost',  '96D0C1491615C82B9A54D9989779DF825B690748224C2B04F500F370D51827CE2644D8D4A82C18184D73AB8530BB8ED537269603F61DB0D03D2104ABF789970B',
        '127.0.0.1',  'A7BCFA5D490B351BE0754130DF03A068F855DB4333D43921125B9CF2670EF6A40370C646B90401955E1F7BC9CDBF59CE0B2C5467D820BE189C845D0B79CFC96F',
        'esi.uz',     '2F01C06C4954A65559EB868AA1A0480A33FD953116920969F23F53DE8ED0688B31535348C44614D6CB391B638DBBF23D1961369DCD90127FBFC54ADC17D15E1D',
        'www.esi.uz', 'E7F216D411EFD6024CA32B8C481F43953A7F747900260112F104A89691458E02B3D07B96F2B2424321BE9C131712F568C56F0FE65C5C3F5483110FA549E015E0'
    ];
    uiLoading();
    EIMZOClient.checkVersion(function(major, minor){
        var newVersion = EIMZO_MAJOR * 100 + EIMZO_MINOR;
        var installedVersion = parseInt(major) * 100 + parseInt(minor);
        if(installedVersion < newVersion) {
            uiUpdateApp();
        } else {
            EIMZOClient.installApiKeys(function(){
                uiLoadKeys();
            },function(e, r){
                if(r){
                    uiShowMessage(r);
                } else {
                    wsError(e);
                }
            });
        }
    }, function(e, r){
        if(r){
            uiShowMessage(r);
        } else {
            uiNotLoaded(e);
        }
    });
};

var selectedUserKey;

var uiShowMessage = function(message){
    alert(message);
};

var uiLoading = function(){
    var l = $("#wait-loading");
    var f = $("#every-thing-ok");
    var n = $("#upgrade-app");
    var a = $("#two-fa");
    l.css("display", "block");
    n.css("display", "none");
    f.css("display", "none");
    a.css("display", "none");
};

var uiNotLoaded = function(e){
    var l = $("#wait-loading");
    var f = $("#every-thing-ok");
    var a = $("#two-fa");
    var n = $("#not-installed");
    if (f && n && l && a) {
        l.css("display", "none");
        f.css("display", "none");
        a.css("display", "none");
        n.css("display", "block");
        if (e) {

        } else {
            uiShowMessage(errorBrowserWS);
        }
    } else {
        if (e) {
            uiShowMessage(errorCAPIWS);
        } else {
            uiShowMessage(errorBrowserWS);
        }
    }
};

var uiUpdateApp = function(){
    var l = $("#wait-loading");
    var f = $("#every-thing-ok");
    var n = $("#upgrade-app");
    var a = $("#two-fa");
    n.html(errorUpdateApp);
    l.css("display", "none");
    f.css("display", "none");
    a.css("display", "none");
    n.css("display", "block");
};

var uiLoadKeys = function(){
    $(".img-recaptcha").click(function () {
        uiLoadCaptcha(captchaMode);
    });
    $("#refresh-captcha").click(function () {
        uiLoadCaptcha(captchaMode);
    });
    $("#password-change-button").click(function () {
        uiChangePassword();
    });
    uiLoadCaptcha(captchaMode);
    uiClearCombo();
    EIMZOClient.listAllUserKeys(function(o, i){
        var itemId = "itm-" + o.serialNumber + "-" + i;
        return itemId;
    },function(itemId, v){
        return uiCreateItem(itemId, v, lang);
    },function(items, firstId){
        uiFillCombo(items);
        uiLoaded();
        uiComboSelect(firstId);
    },function(e, r){
        uiShowMessage(errorCAPIWS);
    });
};

var uiClearCombo = function(){
    $(".dropdown-menu").empty();
};

var uiFillCombo = function(items){
    for (var itm in items) {
        $(".dropdown-menu").append(items[itm]);
    }
};

var uiLoaded = function(){
    var l = $("#wait-loading");
    var f = $("#every-thing-ok");
    var n = $("#upgrade-app");
    var a = $("#two-fa");
    l.css("display", "none");
    n.css("display", "none");
    a.css("display", "none");
    f.css("display", "block");
};

var uiValidationForm = function(twoFaCode, redirect, mobilePhone){
    var l = $("#wait-loading");
    var f = $("#every-thing-ok");
    var n = $("#upgrade-app");
    var a = $("#two-fa");
    l.css("display", "none");
    n.css("display", "none");
    f.css("display", "none");
    a.css("display", "block");

    $("#redirect").val(redirect);
    $("#two-fa-code").val(twoFaCode);
    $("#phoneLastNumber").html(mobilePhone);

    $(".form-control.pull-left.code").keyup(function(event){
        if(event.keyCode === 13){
            checkCode();
        }
    });
};

var uiComboSelect = function(id){
    if (!id) {
        selectedUserKey = null;
        return;
    }
    var s = $("#" + id).text();
    var vo = JSON.parse(s);
    selectedUserKey = vo;
    if (selectedUserKey.type === 'pfx') {
        $("#password-change-button").show();
        $("#password-recover-button").show();
        checkValidity(selectedUserKey);
    } else {
        $("#password-change-button").show();
        $("#password-recover-button").hide();
    }
    var idn = vo.TIN;
    if(idn === ""){
        idn = vo.PINFL;
    }
    if(idn === ""){
        idn = "";
    } else {
        idn = idn + " - ";
    }
    $(".btn.btn-default.dropdown-toggle").html(idn + vo.CN + "<i class=\"fa fa-chevron-down\"></i>");
};

var uiChangePassword = function(){
    if (selectedUserKey) {
        var vo = selectedUserKey;
        if (vo.type === "pfx") {
            uiShowMessage(warnBeforePasswordChanged);
        }
        EIMZOClient.changeKeyPassword(selectedUserKey, function(){
            uiShowMessage(warnPasswordChanged);
            logPasswordChange(selectedUserKey);
        },function(e, r){
            if (r) {
                if (r.indexOf("BadPaddingException") !== -1) {
                    uiShowMessage(errorWrongPassword);
                } else {
                    uiShowMessage(r);
                }
            } else {
                if(e){
                    wsError(e);
                }
            }
        });
    }
};

var checkValidity = function(vo){
    var n = $("#notification");
    n.css("display", "none");
    if(vo.type === 'pfx' && vo.validTo){
        var now = new Date();
        var till = new Date(vo.validTo);
        var oneDay = 24*60*60*1000; // hours*minutes*seconds*milliseconds
        var days = Math.round(Math.abs((till.getTime() - now.getTime())/(oneDay)));
        if(days > 0 && days <= 30){
            n.html(notifyRenewKey.replace("{}",days));
            n.css("display", "block");
        }
    }
};

var logPasswordChange = function(vo) {
    if(vo.TIN !== ""){
        try {
            microAjax('/oauth2/log?event=password-changed&tin=' + vo.TIN, function (data, s) {
                var data = JSON.parse(data);
                if (data.success) {
                    // good
                } else {
                    // bad
                }
            }, 'serialNumber=' + encodeURIComponent(vo.serialNumber) + '&CN=' + encodeURIComponent(vo.CN) + '&TIN=' + encodeURIComponent(vo.TIN) + '&UID=' + encodeURIComponent(vo.UID ? vo.UID : "") + '&type=' + encodeURIComponent(vo.type));
        } catch (e) {

        }
    }
};

var wsError = function (e) {
    if (e) {
        uiShowMessage(errorCAPIWS + " : " + e);
    } else {
        uiShowMessage(errorBrowserWS);
    }
};

var uiLoadCaptcha = function (askCaptcha) {
    uiSetCaptchaMode(askCaptcha);
    if (askCaptcha) {
        microAjax('/oauth2/captcha/get', function (data, s) {
            try {
                var data = JSON.parse(data);
                if (data.success) {
                    $(".img-recaptcha").attr('src', data.imgSrc);
                } else {
                    if (data.reason.indexOf('Try later') !== -1) {
                        uiShowMessage(errorTryLater);
                        return;
                    }
                    uiShowMessage(data.reason);
                }
            } catch (e) {
                uiShowMessage(s.status + " - " + s.statusText + "<br />" + e);
            }
        });
    }
};

var uiCreateItem = function (itmkey, vo, lang) {
    var now = new Date();
    vo.expired = dates.compare(now, vo.validTo) > 0;
    var itm = "<li><a href=\"#\" ";
    if (!vo.expired) {
        itm += "onclick=\"uiComboSelect('" + itmkey + "')\"";
    } else {
        itm += "style='color: gray'";
    }
    itm += "\>";
    if (lang === 'uz') {
        itm += "<img src=\"assets/images/icons/"+vo.type+".ico\" /> <b>SERTIFIKAT №:</b> " + vo.serialNumber.toLowerCase() + "<br />";
        if(vo.TIN !== ""){
            itm += "<b>INN:</b> " + vo.TIN;
        } else if(vo.PINFL !== ""){
            itm += "<b>PINFL:</b> " + vo.PINFL;
        }
        if (isLegalEntity(vo.TIN)) {
            itm += " <b>YURIDIK SHAXS</b>";
        } else {
            itm += " <b>JISMONIY SHAXS</b>";
        }
        itm += "<br />"
        itm += "<b>F.I.Sh.:</b>" + vo.CN + "<br />";
        if (vo.O !== "") {
            itm += "<b>Tashkilot.:</b>" + vo.O + "<br />";
        }
//        if (vo.T !== "") {
//            itm += "<b>Lavozim.:</b>" + vo.T + "<br />";
//        }
        if (vo.expired) {
            itm += "<font size=-2 color=red><b>Sertifikatni amal qilish muddati (" + vo.validFrom.ddmmyyyy() + " - " + vo.validTo.ddmmyyyy() + ") tugagan</b></font>";
        } else {
            itm += "<font size=-2><b>Sertifikatni amal qilish muddati:</b> " + vo.validFrom.ddmmyyyy() + " - " + vo.validTo.ddmmyyyy() + "</font>";
        }
    } else {
        itm += "<img src=\"assets/images/icons/"+vo.type+".ico\" /> <b>№ СЕРТИФИКАТА:</b> " + vo.serialNumber.toLowerCase() + "<br />";
        if(vo.TIN !== ""){
            itm += "<b>ИНН:</b> " + vo.TIN;
        } else if(vo.PINFL !== ""){
            itm += "<b>ПИНФЛ:</b> " + vo.PINFL;
        }
        if (isLegalEntity(vo.TIN)) {
            itm += " <b>ЮРИДИЧЕСКОЕ ЛИЦО</b>";
        } else {
            itm += " <b>ФИЗИЧЕСКОЕ ЛИЦО</b>";
        }
        itm += "<br />"
        itm += "<b>Ф.И.О.:</b>" + vo.CN + "<br />";
        if (vo.O !== "") {
            itm += "<b>Организация.:</b>" + vo.O + "<br />";
        }
//        if (vo.T !== "") {
//            itm += "<b>Должность.:</b>" + vo.T + "<br />";
//        }
        if (vo.expired) {
            itm += "<font size=-2 color=red><b>Срок действия сертификата (" + vo.validFrom.ddmmyyyy() + " - " + vo.validTo.ddmmyyyy() + ") истек</b></font>";
        } else {
            itm += "<font size=-2><b>Срок действия сертификата:</b> " + vo.validFrom.ddmmyyyy() + " - " + vo.validTo.ddmmyyyy() + "</font>";
        }
    }
    itm += "<div id='" + itmkey + "' class='hidden-value' style='display: none'>" + JSON.stringify(vo) + "</div>";
    itm += "</a></li>";
    return itm;
};

var isLegalEntity = function (tin) {
    if(tin===""){
        return false;
    }
    return (tin.charAt(0) === '2' || tin.charAt(0) === '3');
};

var postLoadKey = function (id, vo, captchaText, remember) {
    CAPIWS.callFunction({plugin: "x509", name: "get_certificate_chain", arguments: [id]}, function (event, data) {
        if (data.success) {
            var signerCert = data.certificates[0];
            CAPIWS.callFunction({name: "get_certificate_info", arguments: [signerCert]}, function (event, data) {
                if (data.success) {
                    var certificateInfo = data.certificate_info;
                    microAjax('/oauth2/signrequest?serialNumber=' + certificateInfo.serialNumber, function (data, s) {
                        try {
                            var data = JSON.parse(data);
                            if (data.success) {
                                var xml64 = data.xml64;
                                var timeStamp = data.timeStamp;
                                var hash = data.hash;
                                EIMZOClient.createPkcs7(id, xml64, null, function(pkcs7){
                                    var pass = "";
                                    microAjax('/oauth2/ajax/signin?client_id=' + clientId + '&scope=' + scope + '&redirect_uri=' + redir + '&response_type=code&state=' + state + '&lang=' + lang + '&serialNumber=' + certificateInfo.serialNumber, function (data, s) {
                                        try {
                                            var data = JSON.parse(data);
                                            if (data.success) {
                                                if(data.twoFaEnabled === true) {
                                                    uiValidationForm(data.twoFaCode, data.redirect, data.mobilePhone);
                                                } else {
                                                    window.location.href = data.redirect;
                                                    uiLoading();
                                                }
                                            } else {
                                                uiLoadCaptcha(data.askCaptcha ? data.askCaptcha : captchaMode);
                                                $(".form-control.pull-left.captcha").val("");
                                                if (data.reason.indexOf('Captcha mismatch') !== -1) {
                                                    uiShowMessage(errorCaptchaMismatch);
                                                    return;
                                                }
                                                if (data.reason.indexOf('User is not registered') !== -1) {
                                                    uiShowMessage(errorNotRegistered);
                                                    window.location.href = '/register/user';
                                                    return;
                                                }
                                                if (data.reason.indexOf('Wrong password') !== -1) {
                                                    uiShowMessage(errorWrongPassword);
                                                    return;
                                                }
                                                if (data.reason.indexOf('Certificate is not active') !== -1) {
                                                    uiShowMessage(errorCertNotActive);
                                                    return;
                                                }
                                                if (data.reason.indexOf('Authentication information is not found') !== -1) {
                                                    uiShowMessage(errorCookieProblem);
                                                    return;
                                                }
                                                if (data.reason.indexOf('Certificate is not verified') !== -1) {
                                                    uiShowMessage(errorCertNotVerified);
                                                    return;
                                                }
                                                if (data.reason.indexOf('Certificate policy is invalid') !== -1) {
                                                    uiShowMessage(errorCertPolicyIsInvalid);
                                                    return;
                                                }
                                                if (data.reason.indexOf('SMS is not sent') !== -1) {
                                                    uiShowMessage(errorSmsIsNotSent);
                                                    return;
                                                }
                                                if (data.reason.indexOf('Try later') !== -1) {
                                                    uiShowMessage(errorTryLater);
                                                    return;
                                                }
                                                if (data.reason.indexOf('Correct you PC date time') !== -1) {
                                                    uiShowMessage(errorCorrectTime);
                                                    return;
                                                }
                                                uiShowMessage(data.reason);
                                            }
                                        } catch (e) {
                                            uiShowMessage(s.status + " - " + s.statusText + "<br />" + e);
                                        }
                                    }, 'captchaText=' + encodeURIComponent(captchaText) + '&pkcs7=' + encodeURIComponent(pkcs7) + '&timeStamp=' + encodeURIComponent(timeStamp) + '&hash=' + encodeURIComponent(hash) + '&password=' + encodeURIComponent(pass) + '&remember=' + remember + '&subjectName=' + encodeURIComponent(certificateInfo.subjectName) + '&issuerName=' + encodeURIComponent(certificateInfo.issuerName) + '&keyId=' + encodeURIComponent(id) + '&keyType=' + encodeURIComponent(vo.type));
                                }, function(e, r){
                                    wsError(e);
                                });
                            } else {
                                uiShowMessage(data.reason);
                            }
                        } catch (e) {
                            uiShowMessage(s.status + " - " + s.statusText + "<br />" + e);
                        }
                    }, 'subjectName=' + encodeURIComponent(certificateInfo.subjectName) + '&issuerName=' + encodeURIComponent(certificateInfo.issuerName) + '&clientId=' + encodeURIComponent(clientId) + '&clientDomain=' + encodeURIComponent(clientDomain) + '&scope=' + encodeURIComponent(scope));
                } else {
                    uiShowMessage(data.reason);
                }
            }, wsError);
        } else {
            uiShowMessage(data.reason);
        }
    }, wsError);
};

var authorize = function () {
    if (selectedUserKey) {
        var vo = selectedUserKey;
        var captchaText = $(".form-control.pull-left.captcha").val();
        if (captchaMode && captchaText === "") {
            uiShowMessage(errorEnterCaptcha);
            return;
        }
        var remember = $("input[name=remember]").is(':checked') ? "yes" : "no";
        EIMZOClient.loadKey(vo, function(id){
            postLoadKey(id, vo, captchaText, remember);
        }, function(e, r){
            if(r){
                if (r.indexOf("BadPaddingException") != -1) {
                    uiShowMessage(errorWrongPassword);
                } else if(r === "keystore password was incorrect"){
                    uiShowMessage(errorWrongPassword);
                } else {
                    uiShowMessage(r);
                }
            } else {
                wsError(e);
            }
        });
    }
};

var checkCode = function(){
    var code = $(".form-control.pull-left.code").val();
    var twoFaCode = $("#two-fa-code").val();
    var redirect = $("#redirect").val();
    if (code === "") {
        uiShowMessage(errorEnterCode);
        return;
    }
    microAjax('/oauth2/2fa/sms', function (data, s) {
        try {
            var data = JSON.parse(data);
            if (data.success) {
                window.location.href = redirect;
                uiLoading();
            } else {
                if (data.reason.indexOf('Access code is not found') !== -1) {
                    uiShowMessage(errorAccessCodeNotFound);
                    return;
                }
                if (data.reason.indexOf('Parameter is not defined') !== -1) {
                    uiShowMessage(errorAccessCodeNotFound);
                    return;
                }
                if (data.reason.indexOf('Wrong 2FA code') !== -1) {
                    uiShowMessage(errorWrongCode);
                    return;
                }
                if (data.reason.indexOf('Try later') !== -1) {
                    uiShowMessage(errorTryLater);
                    return;
                }
                uiShowMessage(data.reason);
            }
        } catch (e) {
            uiShowMessage(s.status + " - " + s.statusText + "<br />" + e);
        }
    }, 'code=' + encodeURIComponent(code) + '&twoFaCode=' + encodeURIComponent(twoFaCode));

};

var uiSetCaptchaMode = function (mode) {
    if (mode) {
        $(".form-control.pull-left.captcha").css('display', '');
        $(".img-recaptcha").css('display', '');
        $("#refresh-captcha").css('display', '');
        //inline-block
    } else {
        $(".form-control.pull-left.captcha").hide();
        $(".img-recaptcha").hide();
        $("#refresh-captcha").hide();
        //none
    }
    captchaMode = mode;
};

$(window).load(function () {
    var header = $('.jreject-header').html();
    $.reject({
        close: false,
        header: header,
        paragraph1: '',
        paragraph2: ''
    });
});


$(AppLoad);