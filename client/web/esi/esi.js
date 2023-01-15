function microAjax(n, t) {
    if (this.bindFunction = function (n, t) {
        return function () {
            return n.apply(t, [t])
        }
    }, this.stateChange = function () {
        this.request.readyState === 4 && this.callbackFunction(this.request.responseText, this.request)
    }, this.getRequest = function () {
        return window.ActiveXObject ? new ActiveXObject("Microsoft.XMLHTTP") : window.XMLHttpRequest ? new XMLHttpRequest : !1
    }, this.postBody = arguments[2] || "", this.callbackFunction = t, this.url = n, this.request = this.getRequest(), this.request) {
        var i = this.request;
        i.onreadystatechange = this.bindFunction(this.stateChange, this);
        this.postBody !== "" ? (i.open("POST", n, !0), i.setRequestHeader("Access-Control-Allow-Origin", "http://uzex.uz"), i.setRequestHeader("X-Requested-With", "XMLHttpRequest"), i.setRequestHeader("Content-type", "application/x-www-form-urlencoded; charset=UTF-8"), i.setRequestHeader("Connection", "close")) : i.open("GET", n, !0);
        i.send(this.postBody)
    }
}

var dates, EIMZOClient, UIToastr;
(function (n) {
    "use strict";
    var v = n.Base64, i, e;
    typeof module != "undefined" && module.exports && (i = require("buffer").Buffer);
    var r = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/", f = function (n) {
        for (var i = {}, t = 0, r = n.length; t < r; t++) i[n.charAt(t)] = t;
        return i
    }(r), t = String.fromCharCode, y = function (n) {
        var i;
        return n.length < 2 ? (i = n.charCodeAt(0), i < 128 ? n : i < 2048 ? t(192 | i >>> 6) + t(128 | i & 63) : t(224 | i >>> 12 & 15) + t(128 | i >>> 6 & 63) + t(128 | i & 63)) : (i = 65536 + (n.charCodeAt(0) - 55296) * 1024 + (n.charCodeAt(1) - 56320), t(240 | i >>> 18 & 7) + t(128 | i >>> 12 & 63) + t(128 | i >>> 6 & 63) + t(128 | i & 63))
    }, p = /[\uD800-\uDBFF][\uDC00-\uDFFFF]|[^\x00-\x7F]/g, s = function (n) {
        return n.replace(p, y)
    }, w = function (n) {
        var i = [0, 2, 1][n.length % 3],
            t = n.charCodeAt(0) << 16 | (n.length > 1 ? n.charCodeAt(1) : 0) << 8 | (n.length > 2 ? n.charCodeAt(2) : 0),
            u = [r.charAt(t >>> 18), r.charAt(t >>> 12 & 63), i >= 2 ? "=" : r.charAt(t >>> 6 & 63), i >= 1 ? "=" : r.charAt(t & 63)];
        return u.join("")
    }, h = n.btoa ? function (t) {
        return n.btoa(t)
    } : function (n) {
        return n.replace(/[\s\S]{1,3}/g, w)
    }, c = i ? function (n) {
        return new i(n).toString("base64")
    } : function (n) {
        return h(s(n))
    }, u = function (n, t) {
        return t ? c(n).replace(/[+\/]/g, function (n) {
            return n == "+" ? "-" : "_"
        }).replace(/=/g, "") : c(n)
    }, b = function (n) {
        return u(n, !0)
    }, k = new RegExp("[À-ß][-¿]|[à-ï][-¿]{2}|[ð-÷][-¿]{3}", "g"), d = function (n) {
        switch (n.length) {
            case 4:
                var r = (7 & n.charCodeAt(0)) << 18 | (63 & n.charCodeAt(1)) << 12 | (63 & n.charCodeAt(2)) << 6 | 63 & n.charCodeAt(3),
                    i = r - 65536;
                return t((i >>> 10) + 55296) + t((i & 1023) + 56320);
            case 3:
                return t((15 & n.charCodeAt(0)) << 12 | (63 & n.charCodeAt(1)) << 6 | 63 & n.charCodeAt(2));
            default:
                return t((31 & n.charCodeAt(0)) << 6 | 63 & n.charCodeAt(1))
        }
    }, l = function (n) {
        return n.replace(k, d)
    }, g = function (n) {
        var i = n.length, e = i % 4,
            r = (i > 0 ? f[n.charAt(0)] << 18 : 0) | (i > 1 ? f[n.charAt(1)] << 12 : 0) | (i > 2 ? f[n.charAt(2)] << 6 : 0) | (i > 3 ? f[n.charAt(3)] : 0),
            u = [t(r >>> 16), t(r >>> 8 & 255), t(r & 255)];
        return u.length -= [0, 0, 2, 1][e], u.join("")
    }, a = n.atob ? function (t) {
        return n.atob(t)
    } : function (n) {
        return n.replace(/[\s\S]{1,4}/g, g)
    }, nt = i ? function (n) {
        return new i(n, "base64").toString()
    } : function (n) {
        return l(a(n))
    }, o = function (n) {
        return nt(n.replace(/[-_]/g, function (n) {
            return n == "-" ? "+" : "/"
        }).replace(/[^A-Za-z0-9\+\/]/g, ""))
    }, tt = function () {
        var t = n.Base64;
        return n.Base64 = v, t
    };
    n.Base64 = {
        VERSION: "2.1.4",
        atob: a,
        btoa: h,
        fromBase64: o,
        toBase64: u,
        utob: s,
        encode: u,
        encodeURI: b,
        btou: l,
        decode: o,
        noConflict: tt
    };
    typeof Object.defineProperty == "function" && (e = function (n) {
        return {value: n, enumerable: !1, writable: !0, configurable: !0}
    }, n.Base64.extendString = function () {
        Object.defineProperty(String.prototype, "fromBase64", e(function () {
            return o(this)
        }));
        Object.defineProperty(String.prototype, "toBase64", e(function (n) {
            return u(this, n)
        }));
        Object.defineProperty(String.prototype, "toBase64URI", e(function () {
            return u(this, !0)
        }))
    })
})(this);
CAPIWS = typeof EIMZOEXT != "undefined" ? EIMZOEXT : {
    URL: (window.location.protocol.toLowerCase() === "https:" ? "wss://127.0.0.1:64443" : "ws://127.0.0.1:64646") + "/service/cryptapi",
    callFunction: function (n, t, i) {
        if (!window.WebSocket) {
            i && i();
            return
        }
        var r;
        try {
            r = new WebSocket(this.URL)
        } catch (u) {
            i(u)
        }
        r.onerror = function (n) {
            i && i(n)
        };
        r.onmessage = function (n) {
            var i = JSON.parse(n.data);
            r.close();
            t(n, i)
        };
        r.onopen = function () {
            r.send(JSON.stringify(n))
        }
    },
    version: function (n, t) {
        if (!window.WebSocket) {
            t && t();
            return
        }
        var i;
        try {
            i = new WebSocket(this.URL)
        } catch (r) {
            t(r)
        }
        i.onerror = function (n) {
            t && t(n)
        };
        i.onmessage = function (t) {
            var r = JSON.parse(t.data);
            i.close();
            n(t, r)
        };
        i.onopen = function () {
            i.send(JSON.stringify({name: "version"}))
        }
    },
    apidoc: function (n, t) {
        if (!window.WebSocket) {
            t && t();
            return
        }
        var i;
        try {
            i = new WebSocket(this.URL)
        } catch (r) {
            t(r)
        }
        i.onerror = function (n) {
            t && t(n)
        };
        i.onmessage = function (t) {
            var r = JSON.parse(t.data);
            i.close();
            n(t, r)
        };
        i.onopen = function () {
            i.send(JSON.stringify({name: "apidoc"}))
        }
    },
    apikey: function (n, t, i) {
        if (!window.WebSocket) {
            i && i();
            return
        }
        var r;
        try {
            r = new WebSocket(this.URL)
        } catch (u) {
            i(u)
        }
        r.onerror = function (n) {
            i && i(n)
        };
        r.onmessage = function (n) {
            var i = JSON.parse(n.data);
            r.close();
            t(n, i)
        };
        r.onopen = function () {
            var t = {name: "apikey", arguments: n};
            r.send(JSON.stringify(t))
        }
    }
};
Date.prototype.yyyymmdd = function () {
    var i = this.getFullYear().toString(), n = (this.getMonth() + 1).toString(), t = this.getDate().toString();
    return i + (n[1] ? n : "0" + n[0]) + (t[1] ? t : "0" + t[0])
};
Date.prototype.ddmmyyyy = function () {
    var i = this.getFullYear().toString(), n = (this.getMonth() + 1).toString(), t = this.getDate().toString();
    return (t[1] ? t : "0" + t[0]) + "." + (n[1] ? n : "0" + n[0]) + "." + i
};
dates = {
    convert: function (n) {
        return n.constructor === Date ? n : n.constructor === Array ? new Date(n[0], n[1], n[2]) : n.constructor === Number ? new Date(n) : n.constructor === String ? new Date(n) : typeof n == "object" ? new Date(n.year, n.month, n.date) : NaN
    }, compare: function (n, t) {
        return isFinite(n = this.convert(n).valueOf()) && isFinite(t = this.convert(t).valueOf()) ? (n > t) - (n < t) : NaN
    }, inRange: function (n, t, i) {
        return isFinite(n = this.convert(n).valueOf()) && isFinite(t = this.convert(t).valueOf()) && isFinite(i = this.convert(i).valueOf()) ? t <= n && n <= i : NaN
    }
};
String.prototype.splitKeep = function (n, t) {
    var i = this, u = [], f, e, o, s;
    if (n != "") {
        function c(n) {
            for (var r = n[0] == "0" ? "1" : "0", t = "", i = 0; i < n.length; i++) t += r;
            return t
        }

        var h = [], l = n instanceof RegExp ? "replace" : "replaceAll", a = i[l](n, function (n, t) {
            return h.push({value: n, index: t}), c(n)
        }), r = 0;
        for (f = 0; f < h.length; f++) e = h[f], o = t == !0 ? e.index : e.index + e.value.length, o != r && (s = i.substring(r, o), u.push(s), r = o);
        r < i.length && (s = i.substring(r, i.length), u.push(s))
    } else u.add(i);
    return u
};
EIMZOClient = {
    NEW_API: !1,
    API_KEYS: [
        "localhost", "96D0C1491615C82B9A54D9989779DF825B690748224C2B04F500F370D51827CE2644D8D4A82C18184D73AB8530BB8ED537269603F61DB0D03D2104ABF789970B",
        "127.0.0.1", "A7BCFA5D490B351BE0754130DF03A068F855DB4333D43921125B9CF2670EF6A40370C646B90401955E1F7BC9CDBF59CE0B2C5467D820BE189C845D0B79CFC96F",
        "null", "E0A205EC4E7B78BBB56AFF83A733A1BB9FD39D562E67978CC5E7D73B0951DB1954595A20672A63332535E13CC6EC1E1FC8857BB09E0855D7E76E411B6FA16E9D",
        "uzex.uz", "A82FDEBED77F66723B93351CF113C63C8A12F9BF44CD6384B90839D8DCDCC193FB1B0375889FBD40A6CC7935E6AE0EABD8BCBE28E07D696A0D9A921A3C5B2201"
    ],
    checkVersion: function (n, t) {
        CAPIWS.version(function (i, r) {
            if (r.success === !0) if (r.major && r.minor) {
                var u = parseInt(r.major) * 100 + parseInt(r.minor);
                EIMZOClient.NEW_API = u >= 336;
                n(r.major, r.minor)
            } else t(null, "E-IMZO Version is undefined"); else t(null, r.reason)
        }, function (n) {
            t(n, null)
        })
    },
    installApiKeys: function (n, t) {
        CAPIWS.apikey(EIMZOClient.API_KEYS, function (i, r) {
            r.success ? n() : t(null, r.reason)
        }, function (n) {
            t(n, null)
        })
    },
    listAllUserKeys: function (n, t, i, r) {
        var u = [], f = [];
        EIMZOClient.NEW_API ? EIMZOClient._findCertKeys2(n, t, u, f, function (e) {
            EIMZOClient._findPfxs2(n, t, u, f, function (o) {
                EIMZOClient._findTokens2(n, t, u, f, function (n) {
                    if (u.length === 0 && f.length > 0) r(f[0].e, f[0].r); else {
                        var t = null;
                        u.length === 1 && (e ? t = e : o ? t = o : n && (t = n));
                        i(u, t)
                    }
                })
            })
        }) : EIMZOClient._findCertKeys(n, t, u, f, function (e) {
            EIMZOClient._findPfxs(n, t, u, f, function (n) {
                if (u.length === 0 && f.length > 0) r(f[0].e, f[0].r); else {
                    var t = null;
                    u.length === 1 && (e ? t = e : n && (t = n));
                    i(u, t)
                }
            })
        })
    },
    loadKey: function (n, t, i, r) {
        if (n) {
            var u = n;
            u.type === "certkey" ? CAPIWS.callFunction({
                plugin: "certkey",
                name: "load_key",
                arguments: [u.disk, u.path, u.name, u.serialNumber]
            }, function (n, r) {
                if (r.success) {
                    var u = r.keyId;
                    t(u)
                } else i(null, r.reason)
            }, function (n) {
                i(n, null)
            }) : u.type === "pfx" ? CAPIWS.callFunction({
                plugin: "pfx",
                name: "load_key",
                arguments: [u.disk, u.path, u.name, u.alias]
            }, function (n, u) {
                if (u.success) {
                    var f = u.keyId;
                    r ? CAPIWS.callFunction({name: "verify_password", plugin: "pfx", arguments: [f]}, function (n, r) {
                        r.success ? t(f) : i(null, r.reason)
                    }, function (n) {
                        i(n, null)
                    }) : t(f)
                } else i(null, u.reason)
            }, function (n) {
                i(n, null)
            }) : u.type === "ftjc" && CAPIWS.callFunction({
                plugin: "ftjc",
                name: "load_key",
                arguments: [u.cardUID]
            }, function (n, u) {
                if (u.success) {
                    var f = u.keyId;
                    r ? CAPIWS.callFunction({plugin: "ftjc", name: "verify_pin", arguments: [f, "1"]}, function (n, r) {
                        r.success ? t(f) : i(null, r.reason)
                    }, function (n) {
                        i(n, null)
                    }) : t(f)
                } else i(null, u.reason)
            }, function (n) {
                i(n, null)
            })
        }
    },
    changeKeyPassword: function (n, t, i) {
        if (n) {
            var r = n;
            r.type === "pfx" ? CAPIWS.callFunction({
                plugin: "pfx",
                name: "load_key",
                arguments: [r.disk, r.path, r.name, r.alias]
            }, function (n, r) {
                if (r.success) {
                    var u = r.keyId;
                    CAPIWS.callFunction({name: "change_password", plugin: "pfx", arguments: [u]}, function (n, r) {
                        r.success ? t() : i(null, r.reason)
                    }, function (n) {
                        i(n, null)
                    })
                } else i(null, r.reason)
            }, function (n) {
                i(n, null)
            }) : r.type === "ftjc" && CAPIWS.callFunction({
                plugin: "ftjc",
                name: "load_key",
                arguments: [r.cardUID]
            }, function (n, r) {
                if (r.success) {
                    var u = r.keyId;
                    CAPIWS.callFunction({name: "change_pin", plugin: "ftjc", arguments: [u, "1"]}, function (n, r) {
                        r.success ? t() : i(null, r.reason)
                    }, function (n) {
                        i(n, null)
                    })
                } else i(null, r.reason)
            }, function (n) {
                i(n, null)
            })
        }
    },
    createPkcs7: function (n, t, i, r, u) {
        CAPIWS.callFunction({
            plugin: "pkcs7",
            name: "create_pkcs7",
            arguments: [Base64.encode(t), n, "no"]
        }, function (n, t) {
            var f, e;
            t.success ? (f = t.pkcs7_64, i ? (e = t.signer_serial_number, i(t.signature_hex, function (n) {
                CAPIWS.callFunction({
                    plugin: "pkcs7",
                    name: "attach_timestamp_token_pkcs7",
                    arguments: [f, e, n]
                }, function (n, t) {
                    if (t.success) {
                        var i = t.pkcs7_64;
                        r(i)
                    } else u(null, t.reason)
                }, function (n) {
                    u(n, null)
                })
            }, u)) : r(f)) : u(null, t.reason)
        }, function (n) {
            u(n, null)
        })
    },
    _getX500Val: function (n, t) {
        var r = n.splitKeep(/,[A-Z]+=/g, !0), i, u;
        for (i in r) if (u = r[i].search((i > 0 ? "," : "") + t + "="), u !== -1) return r[i].slice(u + t.length + 1 + (i > 0 ? 1 : 0));
        return ""
    },
    _findCertKeyCertificates: function (n, t, i, r, u, f, e, o) {
        if (parseInt(f) + 1 > u.length) {
            o(e);
            return
        }
        CAPIWS.callFunction({plugin: "certkey", name: "list_certificates", arguments: [u[f]]}, function (s, h) {
            var a, c, l, v, y;
            if (h.success) for (a in h.certificates) (c = h.certificates[a], l = {
                disk: c.disk,
                path: c.path,
                name: c.name,
                serialNumber: c.serialNumber,
                subjectName: c.subjectName,
                validFrom: new Date(c.validFrom),
                validTo: new Date(c.validTo),
                issuerName: c.issuerName,
                publicKeyAlgName: c.publicKeyAlgName,
                CN: EIMZOClient._getX500Val(c.subjectName, "CN"),
                TIN: EIMZOClient._getX500Val(c.subjectName, "INITIALS"),
                O: EIMZOClient._getX500Val(c.subjectName, "O"),
                T: EIMZOClient._getX500Val(c.subjectName, "T"),
                type: "certkey"
            }, l.TIN) && (v = n(l, a), e.length === 0 && e.push(v), y = t(v, l), i.push(y)); else r.push({r: h.reason});
            EIMZOClient._findCertKeyCertificates(n, t, i, r, u, parseInt(f) + 1, e, o)
        }, function (s) {
            r.push({e: s});
            EIMZOClient._findCertKeyCertificates(n, t, i, r, u, parseInt(f) + 1, e, o)
        })
    },
    _findCertKeys: function (n, t, i, r, u) {
        var f = [];
        CAPIWS.callFunction({plugin: "certkey", name: "list_disks"}, function (e, o) {
            var s, h;
            if (o.success) for (s in o.disks) f.push(o.disks[s]), parseInt(s) + 1 >= o.disks.length && (h = [], EIMZOClient._findCertKeyCertificates(n, t, i, r, f, 0, h, function (n) {
                u(n[0])
            })); else r.push({r: o.reason})
        }, function (n) {
            r.push({e: n});
            u()
        })
    },
    _findPfxCertificates: function (n, t, i, r, u, f, e, o) {
        if (parseInt(f) + 1 > u.length) {
            o(e);
            return
        }
        CAPIWS.callFunction({plugin: "pfx", name: "list_certificates", arguments: [u[f]]}, function (s, h) {
            var v, l, c, a, y, p;
            if (h.success) for (v in h.certificates) (l = h.certificates[v], c = l.alias.toUpperCase(), c = c.replace("1.2.860.3.16.1.1=", "INN="), c = c.replace("1.2.860.3.16.1.2=", "PINFL="), a = {
                disk: l.disk,
                path: l.path,
                name: l.name,
                alias: l.alias,
                serialNumber: EIMZOClient._getX500Val(c, "SERIALNUMBER"),
                validFrom: new Date(EIMZOClient._getX500Val(c, "VALIDFROM").replace(/\./g, "-").replace(" ", "T")),
                validTo: new Date(EIMZOClient._getX500Val(c, "VALIDTO").replace(/\./g, "-").replace(" ", "T")),
                CN: EIMZOClient._getX500Val(c, "CN"),
                TIN: EIMZOClient._getX500Val(c, "INN") ? EIMZOClient._getX500Val(c, "INN") : EIMZOClient._getX500Val(c, "UID"),
                UID: EIMZOClient._getX500Val(c, "UID"),
                O: EIMZOClient._getX500Val(c, "O"),
                T: EIMZOClient._getX500Val(c, "T"),
                type: "pfx"
            }, a.TIN) && (y = n(a, v), e.length === 0 && e.push(y), p = t(y, a), i.push(p)); else r.push({r: h.reason});
            EIMZOClient._findPfxCertificates(n, t, i, r, u, parseInt(f) + 1, e, o)
        }, function (s) {
            r.push({e: s});
            EIMZOClient._findPfxCertificates(n, t, i, r, u, parseInt(f) + 1, e, o)
        })
    },
    _findPfxs: function (n, t, i, r, u) {
        var f = [];
        CAPIWS.callFunction({plugin: "pfx", name: "list_disks"}, function (e, o) {
            var h, s, c;
            if (o.success) {
                h = o.disks;
                for (s in h) f.push(o.disks[s]), parseInt(s) + 1 >= o.disks.length && (c = [], EIMZOClient._findPfxCertificates(n, t, i, r, f, 0, c, function (n) {
                    u(n[0])
                }))
            } else r.push({r: o.reason})
        }, function (n) {
            r.push({e: n});
            u()
        })
    },
    _findCertKeys2: function (n, t, i, r, u) {
        var f;
        CAPIWS.callFunction({plugin: "certkey", name: "list_all_certificates"}, function (e, o) {
            var c, s, h, l, a;
            if (o.success) for (c in o.certificates) (s = o.certificates[c], h = {
                disk: s.disk,
                path: s.path,
                name: s.name,
                serialNumber: s.serialNumber,
                subjectName: s.subjectName,
                validFrom: new Date(s.validFrom),
                validTo: new Date(s.validTo),
                issuerName: s.issuerName,
                publicKeyAlgName: s.publicKeyAlgName,
                CN: EIMZOClient._getX500Val(s.subjectName, "CN"),
                TIN: EIMZOClient._getX500Val(s.subjectName, "INITIALS"),
                O: EIMZOClient._getX500Val(s.subjectName, "O"),
                T: EIMZOClient._getX500Val(s.subjectName, "T"),
                type: "certkey"
            }, h.TIN) && (l = n(h, c), f || (f = l), a = t(l, h), i.push(a)); else r.push({r: o.reason});
            u(f)
        }, function (n) {
            r.push({e: n});
            u(f)
        })
    },
    _findPfxs2: function (n, t, i, r, u) {
        var f;
        CAPIWS.callFunction({plugin: "pfx", name: "list_all_certificates"}, function (e, o) {
            var c, h, s, l, a, v;
            if (o.success) for (c in o.certificates) h = o.certificates[c], s = h.alias.toUpperCase(), s = s.replace("1.2.860.3.16.1.1=", "INN="), s = s.replace("1.2.860.3.16.1.2=", "PINFL="), l = {
                disk: h.disk,
                path: h.path,
                name: h.name,
                alias: h.alias,
                serialNumber: EIMZOClient._getX500Val(s, "SERIALNUMBER"),
                validFrom: new Date(EIMZOClient._getX500Val(s, "VALIDFROM").replace(/\./g, "-").replace(" ", "T")),
                validTo: new Date(EIMZOClient._getX500Val(s, "VALIDTO").replace(/\./g, "-").replace(" ", "T")),
                CN: EIMZOClient._getX500Val(s, "CN"),
                TIN: EIMZOClient._getX500Val(s, "INN") ? EIMZOClient._getX500Val(s, "INN") : EIMZOClient._getX500Val(s, "UID"),
                PINFL: EIMZOClient._getX500Val(s, "PINFL") ? EIMZOClient._getX500Val(s, "PINFL") : EIMZOClient._getX500Val(s, "UID"),
                UID: EIMZOClient._getX500Val(s, "UID"),
                O: EIMZOClient._getX500Val(s, "O"),
                T: EIMZOClient._getX500Val(s, "T"),
                type: "pfx"
            }, a = n(l, c), f || (f = a), v = t(a, l), i.push(v); else r.push({r: o.reason});
            u(f)
        }, function (n) {
            r.push({e: n});
            u(f)
        })
    },
    _findTokens2: function (n, t, i, r, u) {
        var f;
        CAPIWS.callFunction({plugin: "ftjc", name: "list_all_keys", arguments: [""]}, function (e, o) {
            var l, h, s, c, a, v;
            if (o.success) for (l in o.tokens) (h = o.tokens[l], s = h.info.toUpperCase(), s = s.replace("1.2.860.3.16.1.1=", "INN="), s = s.replace("1.2.860.3.16.1.2=", "PINFL="), c = {
                cardUID: h.cardUID,
                statusInfo: h.statusInfo,
                ownerName: h.ownerName,
                info: h.info,
                serialNumber: EIMZOClient._getX500Val(s, "SERIALNUMBER"),
                validFrom: new Date(EIMZOClient._getX500Val(s, "VALIDFROM")),
                validTo: new Date(EIMZOClient._getX500Val(s, "VALIDTO")),
                CN: EIMZOClient._getX500Val(s, "CN"),
                TIN: EIMZOClient._getX500Val(s, "INN") ? EIMZOClient._getX500Val(s, "INN") : EIMZOClient._getX500Val(s, "UID"),
                UID: EIMZOClient._getX500Val(s, "UID"),
                O: EIMZOClient._getX500Val(s, "O"),
                T: EIMZOClient._getX500Val(s, "T"),
                type: "ftjc"
            }, c.TIN) && (a = n(c, l), f || (f = a), v = t(a, c), i.push(v)); else r.push({r: o.reason});
            u(f)
        }, function (n) {
            r.push({e: n});
            u(f)
        })
    }
}, function (n) {
    n.reject = function (r) {
        var u = n.extend(!0, {
            reject: {all: !1, msie: 9, firefox: 30, chrome: 30, safari: 4, opera: 12},
            display: [],
            browserShow: !0,
            browserInfo: {
                chrome: {text: "Google Chrome", url: "http://www.google.com/chrome/"},
                firefox: {text: "Mozilla Firefox", url: "http://www.mozilla.com/firefox/"},
                safari: {text: "Safari", url: "http://www.apple.com/safari/download/"},
                opera: {text: "Opera", url: "http://www.opera.com/download/"},
                msie: {text: "Internet Explorer", url: "http://www.microsoft.com/windows/Internet-explorer/"}
            },
            header: "Did you know that your Internet Browser is out of date?",
            paragraph1: "Your browser is out of date, and may not be compatible with our website. A list of the most popular web browsers can be found below.",
            paragraph2: "Just click on the icons to get to the download page",
            close: !0,
            closeMessage: "By closing this window you acknowledge that your experience on this website may be degraded",
            closeLink: "Close This Window",
            closeURL: "#",
            closeESC: !0,
            closeCookie: !1,
            cookieSettings: {path: "/", expires: 0},
            imagePath: "../../WEB-SOURCE/assets/images/",
            overlayBgColor: "#000",
            overlayOpacity: .9,
            fadeInTime: "fast",
            fadeOutTime: "fast",
            analytics: !1
        }, r), h, c, l, e, s, p, a, o, w, k, y;
        if (u.display.length < 1 && (u.display = ["chrome", "firefox", "opera"]), n.isFunction(u.beforeReject) && u.beforeReject(), u.close || (u.closeESC = !1), h = function (t) {
            var i = t[n.layout.name], r = t[n.browser.name];
            return !!(t.all || r && (r === !0 || n.browser.versionNumber <= r) || t[n.browser.className] || i && (i === !0 || n.layout.versionNumber <= i) || t[n.os.name])
        }, !h(u.reject)) return n.isFunction(u.onFail) && u.onFail(), !1;
        if (u.close && u.closeCookie && (c = "jreject-close", l = function (t, i) {
            var e, r, c, o, s, h, l, f, a;
            if (typeof i != "undefined") return e = "", u.cookieSettings.expires !== 0 && (r = new Date, r.setTime(r.getTime() + u.cookieSettings.expires * 1e3), e = "; expires=" + r.toGMTString()), c = u.cookieSettings.path || "/", document.cookie = t + "=" + encodeURIComponent(i ? i : "") + e + "; path=" + c, !0;
            if (s = null, document.cookie && document.cookie !== "") for (h = document.cookie.split(";"), l = h.length, f = 0; f < l; ++f) if (o = n.trim(h[f]), o.substring(0, t.length + 1) == t + "=") {
                a = t.length;
                s = decodeURIComponent(o.substring(a + 1));
                break
            }
            return s
        }, l(c))) return !1;
        if (e = '<div id="jr_overlay"><\/div><div id="jr_wrap"><div id="jr_inner"><h1 id="jr_header">' + u.header + "<\/h1>" + (u.paragraph1 === "" ? "" : "<p>" + u.paragraph1 + "<\/p>") + (u.paragraph2 === "" ? "" : "<p>" + u.paragraph2 + "<\/p>"), s = 0, u.browserShow) {
            e += "<ul>";
            for (p in u.display) (a = u.display[p], o = u.browserInfo[a] || !1, o && (o.allow == undefined || h(o.allow))) && (w = o.url || "#", e += '<li id="jr_' + a + '"><div class="jr_icon"><\/div><div><a href="' + w + '">' + (o.text || "Unknown") + "<\/a><\/div><\/li>", ++s);
            e += "<\/ul>"
        }
        e += '<div id="jr_close">' + (u.close ? '<a href="' + u.closeURL + '">' + u.closeLink + "<\/a><p>" + u.closeMessage + "<\/p>" : "") + "<\/div><\/div><\/div>";
        var f = n("<div>" + e + "<\/div>"), v = t(), b = i();
        return f.bind("closejr", function () {
            if (!u.close) return !1;
            n.isFunction(u.beforeClose) && u.beforeClose();
            n(this).unbind("closejr");
            n("#jr_overlay,#jr_wrap").fadeOut(u.fadeOutTime, function () {
                n(this).remove();
                n.isFunction(u.afterClose) && u.afterClose()
            });
            return n("embed.jr_hidden, object.jr_hidden, select.jr_hidden, applet.jr_hidden").show().removeClass("jr_hidden"), u.closeCookie && l(c, "true"), !0
        }), k = function (n) {
            if (!u.analytics) return !1;
            var t = n.split(/\/+/g)[1];
            try {
                ga("send", "event", "External", "Click", t, n)
            } catch (i) {
                try {
                    _gaq.push(["_trackEvent", "External Links", t, n])
                } catch (i) {
                }
            }
        }, y = function (n) {
            return k(n), window.open(n, "jr_" + Math.round(Math.random() * 11)), !1
        }, f.find("#jr_overlay").css({
            width: v[0],
            height: v[1],
            background: u.overlayBgColor,
            opacity: u.overlayOpacity
        }), f.find("#jr_wrap").css({top: b[1] + v[3] / 4, left: b[0]}), f.find("#jr_inner").css({
            minWidth: s * 100,
            maxWidth: s * 140,
            width: n.layout.name == "trident" ? s * 155 : "auto"
        }), f.find("#jr_inner li").css({background: 'transparent url("' + u.imagePath + 'background_browser.gif")no-repeat scroll left top'}), f.find("#jr_inner li .jr_icon").each(function () {
            var t = n(this);
            t.css("background", "transparent url(" + u.imagePath + "browser_" + t.parent("li").attr("id").replace(/jr_/, "") + ".gif) no-repeat scroll left top");
            t.click(function () {
                var t = n(this).next("div").children("a").attr("href");
                y(t)
            })
        }), f.find("#jr_inner li a").click(function () {
            return y(n(this).attr("href")), !1
        }), f.find("#jr_close a").click(function () {
            return n(this).trigger("closejr"), u.closeURL === "#" ? !1 : void 0
        }), n("#jr_overlay").focus(), n("embed, object, select, applet").each(function () {
            n(this).is(":visible") && n(this).hide().addClass("jr_hidden")
        }), n("body").append(f.hide().fadeIn(u.fadeInTime)), n(window).bind("resize scroll", function () {
            var r = t(), u;
            n("#jr_overlay").css({width: r[0], height: r[1]});
            u = i();
            n("#jr_wrap").css({top: u[1] + r[3] / 4, left: u[0]})
        }), u.closeESC && n(document).bind("keydown", function (n) {
            n.keyCode == 27 && f.trigger("closejr")
        }), n.isFunction(u.afterReject) && u.afterReject(), !0
    };
    var t = function () {
        var i = window.innerWidth && window.scrollMaxX ? window.innerWidth + window.scrollMaxX : document.body.scrollWidth > document.body.offsetWidth ? document.body.scrollWidth : document.body.offsetWidth,
            r = window.innerHeight && window.scrollMaxY ? window.innerHeight + window.scrollMaxY : document.body.scrollHeight > document.body.offsetHeight ? document.body.scrollHeight : document.body.offsetHeight,
            n = window.innerWidth ? window.innerWidth : document.documentElement && document.documentElement.clientWidth ? document.documentElement.clientWidth : document.body.clientWidth,
            t = window.innerHeight ? window.innerHeight : document.documentElement && document.documentElement.clientHeight ? document.documentElement.clientHeight : document.body.clientHeight;
        return [i < n ? i : n, r < t ? t : r, n, t]
    }, i = function () {
        return [window.pageXOffset ? window.pageXOffset : document.documentElement && document.documentElement.scrollTop ? document.documentElement.scrollLeft : document.body.scrollLeft, window.pageYOffset ? window.pageYOffset : document.documentElement && document.documentElement.scrollTop ? document.documentElement.scrollTop : document.body.scrollTop]
    }
}(jQuery), function (n) {
    n.browserTest = function (t, i) {
        var u = "unknown", r = "X", f = function (n, t) {
            for (var i = 0; i < t.length; i = i + 1) n = n.replace(t[i][0], t[i][1]);
            return n
        }, e = function (t, i, e, o) {
            var s = {name: f((i.exec(t) || [u, u])[1], e)}, l, h, a, c;
            return s[s.name] = !0, s.version = s.opera ? window.opera.version() : (o.exec(t) || [r, r, r, r])[3], /safari/.test(s.name) ? (l = /(safari)(\/|\s)([a-z0-9\.\+]*?)(\;|dev|rel|\s|$)/, h = l.exec(t), h && h[3] && h[3] < 400 && (s.version = "2.0")) : s.name === "presto" && (s.version = n.browser.version > 9.27 ? "futhark" : "linear_b"), /msie/.test(s.name) && s.version === r && (a = /rv:(\d+\.\d+)/.exec(t), s.version = a[1]), s.versionNumber = parseFloat(s.version, 10) || 0, c = 1, s.versionNumber < 100 && s.versionNumber > 9 && (c = 2), s.versionX = s.version !== r ? s.version.substr(0, c) : r, s.className = s.name + s.versionX, s
        };
        t = (/Opera|Navigator|Minefield|KHTML|Chrome|CriOS/.test(t) ? f(t, [[/(Firefox|MSIE|KHTML,\slike\sGecko|Konqueror)/, ""], ["Chrome Safari", "Chrome"], ["CriOS", "Chrome"], ["KHTML", "Konqueror"], ["Minefield", "Firefox"], ["Navigator", "Netscape"]]) : t).toLowerCase();
        n.browser = n.extend(i ? {} : n.browser, e(t, /(camino|chrome|crios|firefox|netscape|konqueror|lynx|msie|trident|opera|safari)/, [["trident", "msie"]], /(camino|chrome|crios|firefox|netscape|netscape6|opera|version|konqueror|lynx|msie|rv|safari)(:|\/|\s)([a-z0-9\.\+]*?)(\;|dev|rel|\s|$)/));
        n.layout = e(t, /(gecko|konqueror|msie|trident|opera|webkit)/, [["konqueror", "khtml"], ["msie", "trident"], ["opera", "presto"]], /(applewebkit|rv|konqueror|msie)(\:|\/|\s)([a-z0-9\.]*?)(\;|\)|\s)/);
        n.os = {name: (/(win|mac|linux|sunos|solaris|iphone|ipad)/.exec(navigator.platform.toLowerCase()) || [u])[0].replace("sunos", "solaris")};
        i || n("html").addClass([n.os.name, n.browser.name, n.browser.className, n.layout.name, n.layout.className].join(" "))
    };
    n.browserTest(navigator.userAgent)
}(jQuery), function (n) {
    n(["jquery"], function (n) {
        return function () {
            function l(n, t, u) {
                return r({type: f.error, iconClass: i().iconClasses.error, message: n, optionsOverride: u, title: t})
            }

            function a(n, t, u) {
                return r({type: f.info, iconClass: i().iconClasses.info, message: n, optionsOverride: u, title: t})
            }

            function v(n) {
                e = n
            }

            function y(n, t, u) {
                return r({
                    type: f.success,
                    iconClass: i().iconClasses.success,
                    message: n,
                    optionsOverride: u,
                    title: t
                })
            }

            function p(n, t, u) {
                return r({
                    type: f.warning,
                    iconClass: i().iconClasses.warning,
                    message: n,
                    optionsOverride: u,
                    title: t
                })
            }

            function w(r) {
                var f = i();
                if (t || u(f), r && n(":focus", r).length === 0) {
                    r[f.hideMethod]({
                        duration: f.hideDuration, easing: f.hideEasing, complete: function () {
                            s(r)
                        }
                    });
                    return
                }
                t.children().length && t[f.hideMethod]({
                    duration: f.hideDuration,
                    easing: f.hideEasing,
                    complete: function () {
                        t.remove()
                    }
                })
            }

            function b() {
                return {
                    tapToDismiss: !0,
                    toastClass: "toast",
                    containerId: "toast-container",
                    debug: !1,
                    showMethod: "fadeIn",
                    showDuration: 300,
                    showEasing: "swing",
                    onShown: undefined,
                    hideMethod: "fadeOut",
                    hideDuration: 1e3,
                    hideEasing: "swing",
                    onHidden: undefined,
                    extendedTimeOut: 1e3,
                    iconClasses: {
                        error: "toast-error",
                        info: "toast-info",
                        success: "toast-success",
                        warning: "toast-warning"
                    },
                    iconClass: "toast-info",
                    positionClass: "toast-top-right",
                    timeOut: 5e3,
                    titleClass: "toast-title",
                    messageClass: "toast-message",
                    target: "body",
                    closeHtml: "<button>&times;<\/button>",
                    newestOnTop: !0
                }
            }

            function o(n) {
                e && e(n)
            }

            function r(r) {
                function c(t) {
                    if (!n(":focus", e).length || t) return e[f.hideMethod]({
                        duration: f.hideDuration,
                        easing: f.hideEasing,
                        complete: function () {
                            s(e);
                            f.onHidden && f.onHidden();
                            l.state = "hidden";
                            l.endTime = new Date;
                            o(l)
                        }
                    })
                }

                function b() {
                    (f.timeOut > 0 || f.extendedTimeOut > 0) && (y = setTimeout(c, f.extendedTimeOut))
                }

                function k() {
                    clearTimeout(y);
                    e.stop(!0, !0)[f.showMethod]({duration: f.showDuration, easing: f.showEasing})
                }

                var f = i(), v = r.iconClass || f.iconClass;
                typeof r.optionsOverride != "undefined" && (f = n.extend(f, r.optionsOverride), v = r.optionsOverride.iconClass || v);
                h++;
                t = u(f);
                var y = null, e = n("<div/>"), p = n("<div/>"), w = n("<div/>"), a = n(f.closeHtml),
                    l = {toastId: h, state: "visible", startTime: new Date, options: f, map: r};
                return r.iconClass && e.addClass(f.toastClass).addClass(v), r.title && (p.append(r.title).addClass(f.titleClass), e.append(p)), r.message && (w.append(r.message).addClass(f.messageClass), e.append(w)), f.closeButton && (a.addClass("toast-close-button"), e.prepend(a)), e.hide(), f.newestOnTop ? t.prepend(e) : t.append(e), e[f.showMethod]({
                    duration: f.showDuration,
                    easing: f.showEasing,
                    complete: f.onShown
                }), f.timeOut > 0 && (y = setTimeout(c, f.timeOut)), e.hover(k, b), !f.onclick && f.tapToDismiss && e.click(c), f.closeButton && a && a.click(function (n) {
                    n.stopPropagation();
                    c(!0)
                }), f.onclick && e.click(function () {
                    f.onclick();
                    c()
                }), o(l), f.debug && console && console.log(l), e
            }

            function u(r) {
                return (r || (r = i()), t = n("#" + r.containerId), t.length) ? t : (t = n("<div/>").attr("id", r.containerId).addClass(r.positionClass), t.appendTo(n(r.target)), t)
            }

            function i() {
                return n.extend({}, b(), c.options)
            }

            function s(n) {
                (t || (t = u()), n.is(":visible")) || (n.remove(), n = null, t.children().length === 0 && t.remove())
            }

            var t, e, h = 0, f = {error: "error", info: "info", success: "success", warning: "warning"}, c = {
                clear: w,
                error: l,
                getContainer: u,
                info: a,
                options: {},
                subscribe: v,
                success: y,
                version: "2.0.1",
                warning: p
            };
            return c
        }()
    })
}(typeof define == "function" && define.amd ? define : function (n, t) {
    typeof module != "undefined" && module.exports ? module.exports = t(require(n[0])) : window.toastr = t(window.jQuery)
});
UIToastr = function () {
    return {
        init: function () {
            var n = -1, i = 0, t, r = function () {
                var t = ["Hello, some notification sample goes here", '<div><input class="form-control input-small" value="textbox"/>&nbsp;<a href="http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes" target="_blank">Check this out<\/a><\/div><div><button type="button" id="okBtn" class="btn blue">Close me<\/button><button type="button" id="surpriseBtn" class="btn default" style="margin: 0 8px 0 8px">Surprise me<\/button><\/div>', "Did you like this one ? :)", "Totally Awesome!!!", "Yeah, this is the Metronic!", "Explore the power of Metronic. Purchase it now!"];
                return n++, n === t.length && (n = 0), t[n]
            };
            $("#showtoast").click(function () {
                var e = $("#toastTypeGroup input:checked").val(), u = $("#message").val(), f = $("#title").val() || "",
                    o = $("#showDuration"), s = $("#hideDuration"), h = $("#timeOut"), c = $("#extendedTimeOut"),
                    l = $("#showEasing"), a = $("#hideEasing"), v = $("#showMethod"), y = $("#hideMethod"), p = i++, n;
                toastr.options = {
                    closeButton: $("#closeButton").prop("checked"),
                    debug: $("#debugInfo").prop("checked"),
                    positionClass: $("#positionGroup input:checked").val() || "toast-top-right",
                    onclick: null
                };
                $("#addBehaviorOnToastClick").prop("checked") && (toastr.options.onclick = function () {
                    alert("You can perform some custom action after a toast goes away")
                });
                o.val().length && (toastr.options.showDuration = o.val());
                s.val().length && (toastr.options.hideDuration = s.val());
                h.val().length && (toastr.options.timeOut = h.val());
                c.val().length && (toastr.options.extendedTimeOut = c.val());
                l.val().length && (toastr.options.showEasing = l.val());
                a.val().length && (toastr.options.hideEasing = a.val());
                v.val().length && (toastr.options.showMethod = v.val());
                y.val().length && (toastr.options.hideMethod = y.val());
                u || (u = r());
                $("#toastrOptions").text("Command: toastr[" + e + ']("' + u + (f ? '", "' + f : "") + '")\n\ntoastr.options = ' + JSON.stringify(toastr.options, null, 2));
                n = toastr[e](u, f);
                t = n;
                n.find("#okBtn").length && n.delegate("#okBtn", "click", function () {
                    alert("you clicked me. i was toast #" + p + ". goodbye!");
                    n.remove()
                });
                n.find("#surpriseBtn").length && n.delegate("#surpriseBtn", "click", function () {
                    alert("Surprise! you clicked me. i was toast #" + p + ". You could perform an action here.")
                });
                $("#clearlasttoast").click(function () {
                    toastr.clear(t)
                })
            });
            $("#cleartoasts").click(function () {
                toastr.clear()
            })
        }
    }
}(), function (n) {
    typeof n.fn.each2 == "undefined" && n.extend(n.fn, {
        each2: function (t) {
            for (var i = n([0]), r = -1, u = this.length; ++r < u && (i.context = i[0] = this[r]) && t.call(i[0], r, i) !== !1;) ;
            return this
        }
    })
}(jQuery), function (n, t) {
    "use strict";

    function h(n) {
        var i, t, u, r;
        if (!n || n.length < 1) return n;
        for (i = "", t = 0, u = n.length; t < u; t++) r = n.charAt(t), i += ht[r] || r;
        return i
    }

    function f(n, t) {
        for (var i = 0, r = t.length; i < r; i = i + 1) if (u(n, t[i])) return i;
        return -1
    }

    function ct() {
        var t = n(st), i;
        return t.appendTo("body"), i = {
            width: t.width() - t[0].clientWidth,
            height: t.height() - t[0].clientHeight
        }, t.remove(), i
    }

    function u(n, i) {
        return n === i ? !0 : n === t || i === t ? !1 : n === null || i === null ? !1 : n.constructor === String ? n + "" == i + "" : i.constructor === String ? i + "" == n + "" : !1
    }

    function b(t, i) {
        var u, r, f;
        if (t === null || t.length < 1) return [];
        for (u = t.split(i), r = 0, f = u.length; r < f; r = r + 1) u[r] = n.trim(u[r]);
        return u
    }

    function g(n) {
        return n.outerWidth(!1) - n.width()
    }

    function nt(i) {
        var r = "keyup-change-value";
        i.on("keydown", function () {
            n.data(i, r) === t && n.data(i, r, i.val())
        });
        i.on("keyup", function () {
            var u = n.data(i, r);
            u !== t && i.val() !== u && (n.removeData(i, r), i.trigger("keyup-change"))
        })
    }

    function lt(i) {
        i.on("mousemove", function (i) {
            var r = p;
            (r === t || r.x !== i.pageX || r.y !== i.pageY) && n(i.target).trigger("mousemove-filtered", i)
        })
    }

    function tt(n, i, r) {
        r = r || t;
        var u;
        return function () {
            var t = arguments;
            window.clearTimeout(u);
            u = window.setTimeout(function () {
                i.apply(r, t)
            }, n)
        }
    }

    function at(n) {
        var t = !1, i;
        return function () {
            return t === !1 && (i = n(), t = !0), i
        }
    }

    function vt(n, t) {
        var i = tt(n, function (n) {
            t.trigger("scroll-debounced", n)
        });
        t.on("scroll", function (n) {
            f(n.target, t.get()) >= 0 && i(n)
        })
    }

    function yt(n) {
        n[0] !== document.activeElement && window.setTimeout(function () {
            var t = n[0], r = n.val().length, i;
            n.focus();
            n.is(":visible") && t === document.activeElement && (t.setSelectionRange ? t.setSelectionRange(r, r) : t.createTextRange && (i = t.createTextRange(), i.collapse(!1), i.select()))
        }, 0)
    }

    function pt(t) {
        var i, r, u;
        return t = n(t)[0], i = 0, r = 0, "selectionStart" in t ? (i = t.selectionStart, r = t.selectionEnd - i) : "selection" in document && (t.focus(), u = document.selection.createRange(), r = document.selection.createRange().text.length, u.moveStart("character", -t.value.length), i = u.text.length - r), {
            offset: i,
            length: r
        }
    }

    function r(n) {
        n.preventDefault();
        n.stopPropagation()
    }

    function wt(n) {
        n.preventDefault();
        n.stopImmediatePropagation()
    }

    function bt(t) {
        if (!o) {
            var i = t[0].currentStyle || window.getComputedStyle(t[0], null);
            o = n(document.createElement("div")).css({
                position: "absolute",
                left: "-10000px",
                top: "-10000px",
                display: "none",
                fontSize: i.fontSize,
                fontFamily: i.fontFamily,
                fontStyle: i.fontStyle,
                fontWeight: i.fontWeight,
                letterSpacing: i.letterSpacing,
                textTransform: i.textTransform,
                whiteSpace: "nowrap"
            });
            o.attr("class", "select2-sizer");
            n("body").append(o)
        }
        return o.text(t.val()), o.width()
    }

    function a(t, i, r) {
        var u, f = [], e;
        u = t.attr("class");
        u && (u = "" + u, n(u.split(" ")).each2(function () {
            this.indexOf("select2-") === 0 && f.push(this)
        }));
        u = i.attr("class");
        u && (u = "" + u, n(u.split(" ")).each2(function () {
            this.indexOf("select2-") !== 0 && (e = r(this), e && f.push(this))
        }));
        t.attr("class", f.join(" "))
    }

    function it(n, t, i, r) {
        var u = h(n.toUpperCase()).indexOf(h(t.toUpperCase())), f = t.length;
        if (u < 0) {
            i.push(r(n));
            return
        }
        i.push(r(n.substring(0, u)));
        i.push("<span class='select2-match'>");
        i.push(r(n.substring(u, u + f)));
        i.push("<\/span>");
        i.push(r(n.substring(u + f, n.length)))
    }

    function rt(n) {
        var t = {"\\": "&#92;", "&": "&amp;", "<": "&lt;", ">": "&gt;", '"': "&quot;", "'": "&#39;", "/": "&#47;"};
        return String(n).replace(/[&<>"'\/\\]/g, function (n) {
            return t[n]
        })
    }

    function ut(i) {
        var f, u = null, e = i.quietMillis || 100, o = i.url, r = this;
        return function (s) {
            window.clearTimeout(f);
            f = window.setTimeout(function () {
                var e = i.data, f = o, c = i.transport || n.fn.select2.ajaxDefaults.transport, l = {
                    type: i.type || "GET",
                    cache: i.cache || !1,
                    jsonpCallback: i.jsonpCallback || t,
                    dataType: i.dataType || "json"
                }, h = n.extend({}, n.fn.select2.ajaxDefaults.params, l);
                e = e ? e.call(r, s.term, s.page, s.context) : null;
                f = typeof f == "function" ? f.call(r, s.term, s.page, s.context) : f;
                u && u.abort();
                i.params && (n.isFunction(i.params) ? n.extend(h, i.params.call(r)) : n.extend(h, i.params));
                n.extend(h, {
                    url: f, dataType: i.dataType, data: e, success: function (n) {
                        var t = i.results(n, s.page);
                        s.callback(t)
                    }
                });
                u = c.call(r, h)
            }, e)
        }
    }

    function ft(t) {
        var i = t, e, u, r = function (n) {
            return "" + n.text
        }, f;
        return n.isArray(i) && (u = i, i = {results: u}), n.isFunction(i) === !1 && (u = i, i = function () {
            return u
        }), f = i(), f.text && (r = f.text, n.isFunction(r) || (e = f.text, r = function (n) {
            return n[e]
        })), function (t) {
            var u = t.term, e = {results: []}, f;
            if (u === "") {
                t.callback(i());
                return
            }
            f = function (i, e) {
                var o, s;
                if (i = i[0], i.children) {
                    o = {};
                    for (s in i) i.hasOwnProperty(s) && (o[s] = i[s]);
                    o.children = [];
                    n(i.children).each2(function (n, t) {
                        f(t, o.children)
                    });
                    (o.children.length || t.matcher(u, r(o), i)) && e.push(o)
                } else t.matcher(u, r(i), i) && e.push(i)
            };
            n(i().results).each2(function (n, t) {
                f(t, e.results)
            });
            t.callback(e)
        }
    }

    function et(i) {
        var r = n.isFunction(i);
        return function (u) {
            var f = u.term, e = {results: []};
            n(r ? i() : i).each(function () {
                var n = this.text !== t, i = n ? this.text : this;
                (f === "" || u.matcher(f, i)) && e.results.push(n ? this : {id: this, text: this})
            });
            u.callback(e)
        }
    }

    function s(t, i) {
        if (n.isFunction(t)) return !0;
        if (!t) return !1;
        throw new Error(i + " must be a function or a falsy value");
    }

    function e(t) {
        return n.isFunction(t) ? t() : t
    }

    function ot(t) {
        var i = 0;
        return n.each(t, function (n, t) {
            t.children ? i += ot(t.children) : i++
        }), i
    }

    function kt(n, i, r, f) {
        var a = n, c = !1, e, s, o, h, l;
        if (!f.createSearchChoice || !f.tokenSeparators || f.tokenSeparators.length < 1) return t;
        for (; ;) {
            for (s = -1, o = 0, h = f.tokenSeparators.length; o < h; o++) if (l = f.tokenSeparators[o], s = n.indexOf(l), s >= 0) break;
            if (s < 0) break;
            if (e = n.substring(0, s), n = n.substring(s + l.length), e.length > 0 && (e = f.createSearchChoice.call(this, e, i), e !== t && e !== null && f.id(e) !== t && f.id(e) !== null)) {
                for (c = !1, o = 0, h = i.length; o < h; o++) if (u(f.id(e), f.id(i[o]))) {
                    c = !0;
                    break
                }
                c || r(e)
            }
        }
        if (a !== n) return n
    }

    function k(t, i) {
        var r = function () {
        };
        return r.prototype = new t, r.prototype.constructor = r, r.prototype.parent = t.prototype, r.prototype = n.extend(r.prototype, i), r
    }

    if (window.Select2 === t) {
        var c, v, y, l, o, p = {x: 0, y: 0}, d, w, i = {
            TAB: 9,
            ENTER: 13,
            ESC: 27,
            SPACE: 32,
            LEFT: 37,
            UP: 38,
            RIGHT: 39,
            DOWN: 40,
            SHIFT: 16,
            CTRL: 17,
            ALT: 18,
            PAGE_UP: 33,
            PAGE_DOWN: 34,
            HOME: 36,
            END: 35,
            BACKSPACE: 8,
            DELETE: 46,
            isArrow: function (n) {
                n = n.which ? n.which : n;
                switch (n) {
                    case i.LEFT:
                    case i.RIGHT:
                    case i.UP:
                    case i.DOWN:
                        return !0
                }
                return !1
            },
            isControl: function (n) {
                var t = n.which;
                switch (t) {
                    case i.SHIFT:
                    case i.CTRL:
                    case i.ALT:
                        return !0
                }
                return n.metaKey ? !0 : !1
            },
            isFunctionKey: function (n) {
                return n = n.which ? n.which : n, n >= 112 && n <= 123
            }
        }, st = "<div class='select2-measure-scrollbar'><\/div>", ht = {
            "Ⓐ": "A",
            "Ａ": "A",
            "À": "A",
            "Á": "A",
            "Â": "A",
            "Ầ": "A",
            "Ấ": "A",
            "Ẫ": "A",
            "Ẩ": "A",
            "Ã": "A",
            "Ā": "A",
            "Ă": "A",
            "Ằ": "A",
            "Ắ": "A",
            "Ẵ": "A",
            "Ẳ": "A",
            "Ȧ": "A",
            "Ǡ": "A",
            "Ä": "A",
            "Ǟ": "A",
            "Ả": "A",
            "Å": "A",
            "Ǻ": "A",
            "Ǎ": "A",
            "Ȁ": "A",
            "Ȃ": "A",
            "Ạ": "A",
            "Ậ": "A",
            "Ặ": "A",
            "Ḁ": "A",
            "Ą": "A",
            "Ⱥ": "A",
            "Ɐ": "A",
            "Ꜳ": "AA",
            "Æ": "AE",
            "Ǽ": "AE",
            "Ǣ": "AE",
            "Ꜵ": "AO",
            "Ꜷ": "AU",
            "Ꜹ": "AV",
            "Ꜻ": "AV",
            "Ꜽ": "AY",
            "Ⓑ": "B",
            "Ｂ": "B",
            "Ḃ": "B",
            "Ḅ": "B",
            "Ḇ": "B",
            "Ƀ": "B",
            "Ƃ": "B",
            "Ɓ": "B",
            "Ⓒ": "C",
            "Ｃ": "C",
            "Ć": "C",
            "Ĉ": "C",
            "Ċ": "C",
            "Č": "C",
            "Ç": "C",
            "Ḉ": "C",
            "Ƈ": "C",
            "Ȼ": "C",
            "Ꜿ": "C",
            "Ⓓ": "D",
            "Ｄ": "D",
            "Ḋ": "D",
            "Ď": "D",
            "Ḍ": "D",
            "Ḑ": "D",
            "Ḓ": "D",
            "Ḏ": "D",
            "Đ": "D",
            "Ƌ": "D",
            "Ɗ": "D",
            "Ɖ": "D",
            "Ꝺ": "D",
            "Ǳ": "DZ",
            "Ǆ": "DZ",
            "ǲ": "Dz",
            "ǅ": "Dz",
            "Ⓔ": "E",
            "Ｅ": "E",
            "È": "E",
            "É": "E",
            "Ê": "E",
            "Ề": "E",
            "Ế": "E",
            "Ễ": "E",
            "Ể": "E",
            "Ẽ": "E",
            "Ē": "E",
            "Ḕ": "E",
            "Ḗ": "E",
            "Ĕ": "E",
            "Ė": "E",
            "Ë": "E",
            "Ẻ": "E",
            "Ě": "E",
            "Ȅ": "E",
            "Ȇ": "E",
            "Ẹ": "E",
            "Ệ": "E",
            "Ȩ": "E",
            "Ḝ": "E",
            "Ę": "E",
            "Ḙ": "E",
            "Ḛ": "E",
            "Ɛ": "E",
            "Ǝ": "E",
            "Ⓕ": "F",
            "Ｆ": "F",
            "Ḟ": "F",
            "Ƒ": "F",
            "Ꝼ": "F",
            "Ⓖ": "G",
            "Ｇ": "G",
            "Ǵ": "G",
            "Ĝ": "G",
            "Ḡ": "G",
            "Ğ": "G",
            "Ġ": "G",
            "Ǧ": "G",
            "Ģ": "G",
            "Ǥ": "G",
            "Ɠ": "G",
            "Ꞡ": "G",
            "Ᵹ": "G",
            "Ꝿ": "G",
            "Ⓗ": "H",
            "Ｈ": "H",
            "Ĥ": "H",
            "Ḣ": "H",
            "Ḧ": "H",
            "Ȟ": "H",
            "Ḥ": "H",
            "Ḩ": "H",
            "Ḫ": "H",
            "Ħ": "H",
            "Ⱨ": "H",
            "Ⱶ": "H",
            "Ɥ": "H",
            "Ⓘ": "I",
            "Ｉ": "I",
            "Ì": "I",
            "Í": "I",
            "Î": "I",
            "Ĩ": "I",
            "Ī": "I",
            "Ĭ": "I",
            "İ": "I",
            "Ï": "I",
            "Ḯ": "I",
            "Ỉ": "I",
            "Ǐ": "I",
            "Ȉ": "I",
            "Ȋ": "I",
            "Ị": "I",
            "Į": "I",
            "Ḭ": "I",
            "Ɨ": "I",
            "Ⓙ": "J",
            "Ｊ": "J",
            "Ĵ": "J",
            "Ɉ": "J",
            "Ⓚ": "K",
            "Ｋ": "K",
            "Ḱ": "K",
            "Ǩ": "K",
            "Ḳ": "K",
            "Ķ": "K",
            "Ḵ": "K",
            "Ƙ": "K",
            "Ⱪ": "K",
            "Ꝁ": "K",
            "Ꝃ": "K",
            "Ꝅ": "K",
            "Ꞣ": "K",
            "Ⓛ": "L",
            "Ｌ": "L",
            "Ŀ": "L",
            "Ĺ": "L",
            "Ľ": "L",
            "Ḷ": "L",
            "Ḹ": "L",
            "Ļ": "L",
            "Ḽ": "L",
            "Ḻ": "L",
            "Ł": "L",
            "Ƚ": "L",
            "Ɫ": "L",
            "Ⱡ": "L",
            "Ꝉ": "L",
            "Ꝇ": "L",
            "Ꞁ": "L",
            "Ǉ": "LJ",
            "ǈ": "Lj",
            "Ⓜ": "M",
            "Ｍ": "M",
            "Ḿ": "M",
            "Ṁ": "M",
            "Ṃ": "M",
            "Ɱ": "M",
            "Ɯ": "M",
            "Ⓝ": "N",
            "Ｎ": "N",
            "Ǹ": "N",
            "Ń": "N",
            "Ñ": "N",
            "Ṅ": "N",
            "Ň": "N",
            "Ṇ": "N",
            "Ņ": "N",
            "Ṋ": "N",
            "Ṉ": "N",
            "Ƞ": "N",
            "Ɲ": "N",
            "Ꞑ": "N",
            "Ꞥ": "N",
            "Ǌ": "NJ",
            "ǋ": "Nj",
            "Ⓞ": "O",
            "Ｏ": "O",
            "Ò": "O",
            "Ó": "O",
            "Ô": "O",
            "Ồ": "O",
            "Ố": "O",
            "Ỗ": "O",
            "Ổ": "O",
            "Õ": "O",
            "Ṍ": "O",
            "Ȭ": "O",
            "Ṏ": "O",
            "Ō": "O",
            "Ṑ": "O",
            "Ṓ": "O",
            "Ŏ": "O",
            "Ȯ": "O",
            "Ȱ": "O",
            "Ö": "O",
            "Ȫ": "O",
            "Ỏ": "O",
            "Ő": "O",
            "Ǒ": "O",
            "Ȍ": "O",
            "Ȏ": "O",
            "Ơ": "O",
            "Ờ": "O",
            "Ớ": "O",
            "Ỡ": "O",
            "Ở": "O",
            "Ợ": "O",
            "Ọ": "O",
            "Ộ": "O",
            "Ǫ": "O",
            "Ǭ": "O",
            "Ø": "O",
            "Ǿ": "O",
            "Ɔ": "O",
            "Ɵ": "O",
            "Ꝋ": "O",
            "Ꝍ": "O",
            "Ƣ": "OI",
            "Ꝏ": "OO",
            "Ȣ": "OU",
            "Ⓟ": "P",
            "Ｐ": "P",
            "Ṕ": "P",
            "Ṗ": "P",
            "Ƥ": "P",
            "Ᵽ": "P",
            "Ꝑ": "P",
            "Ꝓ": "P",
            "Ꝕ": "P",
            "Ⓠ": "Q",
            "Ｑ": "Q",
            "Ꝗ": "Q",
            "Ꝙ": "Q",
            "Ɋ": "Q",
            "Ⓡ": "R",
            "Ｒ": "R",
            "Ŕ": "R",
            "Ṙ": "R",
            "Ř": "R",
            "Ȑ": "R",
            "Ȓ": "R",
            "Ṛ": "R",
            "Ṝ": "R",
            "Ŗ": "R",
            "Ṟ": "R",
            "Ɍ": "R",
            "Ɽ": "R",
            "Ꝛ": "R",
            "Ꞧ": "R",
            "Ꞃ": "R",
            "Ⓢ": "S",
            "Ｓ": "S",
            "ẞ": "S",
            "Ś": "S",
            "Ṥ": "S",
            "Ŝ": "S",
            "Ṡ": "S",
            "Š": "S",
            "Ṧ": "S",
            "Ṣ": "S",
            "Ṩ": "S",
            "Ș": "S",
            "Ş": "S",
            "Ȿ": "S",
            "Ꞩ": "S",
            "Ꞅ": "S",
            "Ⓣ": "T",
            "Ｔ": "T",
            "Ṫ": "T",
            "Ť": "T",
            "Ṭ": "T",
            "Ț": "T",
            "Ţ": "T",
            "Ṱ": "T",
            "Ṯ": "T",
            "Ŧ": "T",
            "Ƭ": "T",
            "Ʈ": "T",
            "Ⱦ": "T",
            "Ꞇ": "T",
            "Ꜩ": "TZ",
            "Ⓤ": "U",
            "Ｕ": "U",
            "Ù": "U",
            "Ú": "U",
            "Û": "U",
            "Ũ": "U",
            "Ṹ": "U",
            "Ū": "U",
            "Ṻ": "U",
            "Ŭ": "U",
            "Ü": "U",
            "Ǜ": "U",
            "Ǘ": "U",
            "Ǖ": "U",
            "Ǚ": "U",
            "Ủ": "U",
            "Ů": "U",
            "Ű": "U",
            "Ǔ": "U",
            "Ȕ": "U",
            "Ȗ": "U",
            "Ư": "U",
            "Ừ": "U",
            "Ứ": "U",
            "Ữ": "U",
            "Ử": "U",
            "Ự": "U",
            "Ụ": "U",
            "Ṳ": "U",
            "Ų": "U",
            "Ṷ": "U",
            "Ṵ": "U",
            "Ʉ": "U",
            "Ⓥ": "V",
            "Ｖ": "V",
            "Ṽ": "V",
            "Ṿ": "V",
            "Ʋ": "V",
            "Ꝟ": "V",
            "Ʌ": "V",
            "Ꝡ": "VY",
            "Ⓦ": "W",
            "Ｗ": "W",
            "Ẁ": "W",
            "Ẃ": "W",
            "Ŵ": "W",
            "Ẇ": "W",
            "Ẅ": "W",
            "Ẉ": "W",
            "Ⱳ": "W",
            "Ⓧ": "X",
            "Ｘ": "X",
            "Ẋ": "X",
            "Ẍ": "X",
            "Ⓨ": "Y",
            "Ｙ": "Y",
            "Ỳ": "Y",
            "Ý": "Y",
            "Ŷ": "Y",
            "Ỹ": "Y",
            "Ȳ": "Y",
            "Ẏ": "Y",
            "Ÿ": "Y",
            "Ỷ": "Y",
            "Ỵ": "Y",
            "Ƴ": "Y",
            "Ɏ": "Y",
            "Ỿ": "Y",
            "Ⓩ": "Z",
            "Ｚ": "Z",
            "Ź": "Z",
            "Ẑ": "Z",
            "Ż": "Z",
            "Ž": "Z",
            "Ẓ": "Z",
            "Ẕ": "Z",
            "Ƶ": "Z",
            "Ȥ": "Z",
            "Ɀ": "Z",
            "Ⱬ": "Z",
            "Ꝣ": "Z",
            "ⓐ": "a",
            "ａ": "a",
            "ẚ": "a",
            "à": "a",
            "á": "a",
            "â": "a",
            "ầ": "a",
            "ấ": "a",
            "ẫ": "a",
            "ẩ": "a",
            "ã": "a",
            "ā": "a",
            "ă": "a",
            "ằ": "a",
            "ắ": "a",
            "ẵ": "a",
            "ẳ": "a",
            "ȧ": "a",
            "ǡ": "a",
            "ä": "a",
            "ǟ": "a",
            "ả": "a",
            "å": "a",
            "ǻ": "a",
            "ǎ": "a",
            "ȁ": "a",
            "ȃ": "a",
            "ạ": "a",
            "ậ": "a",
            "ặ": "a",
            "ḁ": "a",
            "ą": "a",
            "ⱥ": "a",
            "ɐ": "a",
            "ꜳ": "aa",
            "æ": "ae",
            "ǽ": "ae",
            "ǣ": "ae",
            "ꜵ": "ao",
            "ꜷ": "au",
            "ꜹ": "av",
            "ꜻ": "av",
            "ꜽ": "ay",
            "ⓑ": "b",
            "ｂ": "b",
            "ḃ": "b",
            "ḅ": "b",
            "ḇ": "b",
            "ƀ": "b",
            "ƃ": "b",
            "ɓ": "b",
            "ⓒ": "c",
            "ｃ": "c",
            "ć": "c",
            "ĉ": "c",
            "ċ": "c",
            "č": "c",
            "ç": "c",
            "ḉ": "c",
            "ƈ": "c",
            "ȼ": "c",
            "ꜿ": "c",
            "ↄ": "c",
            "ⓓ": "d",
            "ｄ": "d",
            "ḋ": "d",
            "ď": "d",
            "ḍ": "d",
            "ḑ": "d",
            "ḓ": "d",
            "ḏ": "d",
            "đ": "d",
            "ƌ": "d",
            "ɖ": "d",
            "ɗ": "d",
            "ꝺ": "d",
            "ǳ": "dz",
            "ǆ": "dz",
            "ⓔ": "e",
            "ｅ": "e",
            "è": "e",
            "é": "e",
            "ê": "e",
            "ề": "e",
            "ế": "e",
            "ễ": "e",
            "ể": "e",
            "ẽ": "e",
            "ē": "e",
            "ḕ": "e",
            "ḗ": "e",
            "ĕ": "e",
            "ė": "e",
            "ë": "e",
            "ẻ": "e",
            "ě": "e",
            "ȅ": "e",
            "ȇ": "e",
            "ẹ": "e",
            "ệ": "e",
            "ȩ": "e",
            "ḝ": "e",
            "ę": "e",
            "ḙ": "e",
            "ḛ": "e",
            "ɇ": "e",
            "ɛ": "e",
            "ǝ": "e",
            "ⓕ": "f",
            "ｆ": "f",
            "ḟ": "f",
            "ƒ": "f",
            "ꝼ": "f",
            "ⓖ": "g",
            "ｇ": "g",
            "ǵ": "g",
            "ĝ": "g",
            "ḡ": "g",
            "ğ": "g",
            "ġ": "g",
            "ǧ": "g",
            "ģ": "g",
            "ǥ": "g",
            "ɠ": "g",
            "ꞡ": "g",
            "ᵹ": "g",
            "ꝿ": "g",
            "ⓗ": "h",
            "ｈ": "h",
            "ĥ": "h",
            "ḣ": "h",
            "ḧ": "h",
            "ȟ": "h",
            "ḥ": "h",
            "ḩ": "h",
            "ḫ": "h",
            "ẖ": "h",
            "ħ": "h",
            "ⱨ": "h",
            "ⱶ": "h",
            "ɥ": "h",
            "ƕ": "hv",
            "ⓘ": "i",
            "ｉ": "i",
            "ì": "i",
            "í": "i",
            "î": "i",
            "ĩ": "i",
            "ī": "i",
            "ĭ": "i",
            "ï": "i",
            "ḯ": "i",
            "ỉ": "i",
            "ǐ": "i",
            "ȉ": "i",
            "ȋ": "i",
            "ị": "i",
            "į": "i",
            "ḭ": "i",
            "ɨ": "i",
            "ı": "i",
            "ⓙ": "j",
            "ｊ": "j",
            "ĵ": "j",
            "ǰ": "j",
            "ɉ": "j",
            "ⓚ": "k",
            "ｋ": "k",
            "ḱ": "k",
            "ǩ": "k",
            "ḳ": "k",
            "ķ": "k",
            "ḵ": "k",
            "ƙ": "k",
            "ⱪ": "k",
            "ꝁ": "k",
            "ꝃ": "k",
            "ꝅ": "k",
            "ꞣ": "k",
            "ⓛ": "l",
            "ｌ": "l",
            "ŀ": "l",
            "ĺ": "l",
            "ľ": "l",
            "ḷ": "l",
            "ḹ": "l",
            "ļ": "l",
            "ḽ": "l",
            "ḻ": "l",
            "ſ": "l",
            "ł": "l",
            "ƚ": "l",
            "ɫ": "l",
            "ⱡ": "l",
            "ꝉ": "l",
            "ꞁ": "l",
            "ꝇ": "l",
            "ǉ": "lj",
            "ⓜ": "m",
            "ｍ": "m",
            "ḿ": "m",
            "ṁ": "m",
            "ṃ": "m",
            "ɱ": "m",
            "ɯ": "m",
            "ⓝ": "n",
            "ｎ": "n",
            "ǹ": "n",
            "ń": "n",
            "ñ": "n",
            "ṅ": "n",
            "ň": "n",
            "ṇ": "n",
            "ņ": "n",
            "ṋ": "n",
            "ṉ": "n",
            "ƞ": "n",
            "ɲ": "n",
            "ŉ": "n",
            "ꞑ": "n",
            "ꞥ": "n",
            "ǌ": "nj",
            "ⓞ": "o",
            "ｏ": "o",
            "ò": "o",
            "ó": "o",
            "ô": "o",
            "ồ": "o",
            "ố": "o",
            "ỗ": "o",
            "ổ": "o",
            "õ": "o",
            "ṍ": "o",
            "ȭ": "o",
            "ṏ": "o",
            "ō": "o",
            "ṑ": "o",
            "ṓ": "o",
            "ŏ": "o",
            "ȯ": "o",
            "ȱ": "o",
            "ö": "o",
            "ȫ": "o",
            "ỏ": "o",
            "ő": "o",
            "ǒ": "o",
            "ȍ": "o",
            "ȏ": "o",
            "ơ": "o",
            "ờ": "o",
            "ớ": "o",
            "ỡ": "o",
            "ở": "o",
            "ợ": "o",
            "ọ": "o",
            "ộ": "o",
            "ǫ": "o",
            "ǭ": "o",
            "ø": "o",
            "ǿ": "o",
            "ɔ": "o",
            "ꝋ": "o",
            "ꝍ": "o",
            "ɵ": "o",
            "ƣ": "oi",
            "ȣ": "ou",
            "ꝏ": "oo",
            "ⓟ": "p",
            "ｐ": "p",
            "ṕ": "p",
            "ṗ": "p",
            "ƥ": "p",
            "ᵽ": "p",
            "ꝑ": "p",
            "ꝓ": "p",
            "ꝕ": "p",
            "ⓠ": "q",
            "ｑ": "q",
            "ɋ": "q",
            "ꝗ": "q",
            "ꝙ": "q",
            "ⓡ": "r",
            "ｒ": "r",
            "ŕ": "r",
            "ṙ": "r",
            "ř": "r",
            "ȑ": "r",
            "ȓ": "r",
            "ṛ": "r",
            "ṝ": "r",
            "ŗ": "r",
            "ṟ": "r",
            "ɍ": "r",
            "ɽ": "r",
            "ꝛ": "r",
            "ꞧ": "r",
            "ꞃ": "r",
            "ⓢ": "s",
            "ｓ": "s",
            "ß": "s",
            "ś": "s",
            "ṥ": "s",
            "ŝ": "s",
            "ṡ": "s",
            "š": "s",
            "ṧ": "s",
            "ṣ": "s",
            "ṩ": "s",
            "ș": "s",
            "ş": "s",
            "ȿ": "s",
            "ꞩ": "s",
            "ꞅ": "s",
            "ẛ": "s",
            "ⓣ": "t",
            "ｔ": "t",
            "ṫ": "t",
            "ẗ": "t",
            "ť": "t",
            "ṭ": "t",
            "ț": "t",
            "ţ": "t",
            "ṱ": "t",
            "ṯ": "t",
            "ŧ": "t",
            "ƭ": "t",
            "ʈ": "t",
            "ⱦ": "t",
            "ꞇ": "t",
            "ꜩ": "tz",
            "ⓤ": "u",
            "ｕ": "u",
            "ù": "u",
            "ú": "u",
            "û": "u",
            "ũ": "u",
            "ṹ": "u",
            "ū": "u",
            "ṻ": "u",
            "ŭ": "u",
            "ü": "u",
            "ǜ": "u",
            "ǘ": "u",
            "ǖ": "u",
            "ǚ": "u",
            "ủ": "u",
            "ů": "u",
            "ű": "u",
            "ǔ": "u",
            "ȕ": "u",
            "ȗ": "u",
            "ư": "u",
            "ừ": "u",
            "ứ": "u",
            "ữ": "u",
            "ử": "u",
            "ự": "u",
            "ụ": "u",
            "ṳ": "u",
            "ų": "u",
            "ṷ": "u",
            "ṵ": "u",
            "ʉ": "u",
            "ⓥ": "v",
            "ｖ": "v",
            "ṽ": "v",
            "ṿ": "v",
            "ʋ": "v",
            "ꝟ": "v",
            "ʌ": "v",
            "ꝡ": "vy",
            "ⓦ": "w",
            "ｗ": "w",
            "ẁ": "w",
            "ẃ": "w",
            "ŵ": "w",
            "ẇ": "w",
            "ẅ": "w",
            "ẘ": "w",
            "ẉ": "w",
            "ⱳ": "w",
            "ⓧ": "x",
            "ｘ": "x",
            "ẋ": "x",
            "ẍ": "x",
            "ⓨ": "y",
            "ｙ": "y",
            "ỳ": "y",
            "ý": "y",
            "ŷ": "y",
            "ỹ": "y",
            "ȳ": "y",
            "ẏ": "y",
            "ÿ": "y",
            "ỷ": "y",
            "ẙ": "y",
            "ỵ": "y",
            "ƴ": "y",
            "ɏ": "y",
            "ỿ": "y",
            "ⓩ": "z",
            "ｚ": "z",
            "ź": "z",
            "ẑ": "z",
            "ż": "z",
            "ž": "z",
            "ẓ": "z",
            "ẕ": "z",
            "ƶ": "z",
            "ȥ": "z",
            "ɀ": "z",
            "ⱬ": "z",
            "ꝣ": "z"
        };
        d = n(document);
        l = function () {
            var n = 1;
            return function () {
                return n++
            }
        }();
        d.on("mousemove", function (n) {
            p.x = n.pageX;
            p.y = n.pageY
        });
        c = k(Object, {
            bind: function (n) {
                var t = this;
                return function () {
                    n.apply(t, arguments)
                }
            }, init: function (i) {
                var u, f, o = ".select2-results", s, h;
                this.opts = i = this.prepareOpts(i);
                this.id = i.id;
                i.element.data("select2") !== t && i.element.data("select2") !== null && i.element.data("select2").destroy();
                this.container = this.createContainer();
                this.containerId = "s2id_" + (i.element.attr("id") || "autogen" + l());
                this.containerSelector = "#" + this.containerId.replace(/([;&,\.\+\*\~':"\!\^#$%@\[\]\(\)=>\|])/g, "\\$1");
                this.container.attr("id", this.containerId);
                this.body = at(function () {
                    return i.element.closest("body")
                });
                a(this.container, this.opts.element, this.opts.adaptContainerCssClass);
                this.container.attr("style", i.element.attr("style"));
                this.container.css(e(i.containerCss));
                this.container.addClass(e(i.containerCssClass));
                this.elementTabIndex = this.opts.element.attr("tabindex");
                this.opts.element.data("select2", this).attr("tabindex", "-1").before(this.container).on("click.select2", r);
                this.container.data("select2", this);
                this.dropdown = this.container.find(".select2-drop");
                a(this.dropdown, this.opts.element, this.opts.adaptDropdownCssClass);
                this.dropdown.addClass(e(i.dropdownCssClass));
                this.dropdown.data("select2", this);
                this.dropdown.on("click", r);
                this.results = u = this.container.find(o);
                this.search = f = this.container.find("input.select2-input");
                this.queryCount = 0;
                this.resultsPage = 0;
                this.context = null;
                this.initContainer();
                this.container.on("click", r);
                lt(this.results);
                this.dropdown.on("mousemove-filtered touchstart touchmove touchend", o, this.bind(this.highlightUnderEvent));
                vt(80, this.results);
                this.dropdown.on("scroll-debounced", o, this.bind(this.loadMoreIfNeeded));
                n(this.container).on("change", ".select2-input", function (n) {
                    n.stopPropagation()
                });
                n(this.dropdown).on("change", ".select2-input", function (n) {
                    n.stopPropagation()
                });
                n.fn.mousewheel && u.mousewheel(function (n, t, i, f) {
                    var e = u.scrollTop();
                    f > 0 && e - f <= 0 ? (u.scrollTop(0), r(n)) : f < 0 && u.get(0).scrollHeight - u.scrollTop() + f <= u.height() && (u.scrollTop(u.get(0).scrollHeight - u.height()), r(n))
                });
                nt(f);
                f.on("keyup-change input paste", this.bind(this.updateResults));
                f.on("focus", function () {
                    f.addClass("select2-focused")
                });
                f.on("blur", function () {
                    f.removeClass("select2-focused")
                });
                this.dropdown.on("mouseup", o, this.bind(function (t) {
                    n(t.target).closest(".select2-result-selectable").length > 0 && (this.highlightUnderEvent(t), this.selectHighlighted(t))
                }));
                this.dropdown.on("click mouseup mousedown", function (n) {
                    n.stopPropagation()
                });
                n.isFunction(this.opts.initSelection) && (this.initSelection(), this.monitorSource());
                i.maximumInputLength !== null && this.search.attr("maxlength", i.maximumInputLength);
                s = i.element.prop("disabled");
                s === t && (s = !1);
                this.enable(!s);
                h = i.element.prop("readonly");
                h === t && (h = !1);
                this.readonly(h);
                w = w || ct();
                this.autofocus = i.element.prop("autofocus");
                i.element.prop("autofocus", !1);
                this.autofocus && this.focus();
                this.nextSearchTerm = t
            }, destroy: function () {
                var n = this.opts.element, i = n.data("select2");
                this.close();
                this.propertyObserver && (delete this.propertyObserver, this.propertyObserver = null);
                i !== t && (i.container.remove(), i.dropdown.remove(), n.removeClass("select2-offscreen").removeData("select2").off(".select2").prop("autofocus", this.autofocus || !1), this.elementTabIndex ? n.attr({tabindex: this.elementTabIndex}) : n.removeAttr("tabindex"), n.show())
            }, optionToData: function (n) {
                return n.is("option") ? {
                    id: n.prop("value"),
                    text: n.text(),
                    element: n.get(),
                    css: n.attr("class"),
                    disabled: n.prop("disabled"),
                    locked: u(n.attr("locked"), "locked") || u(n.data("locked"), !0)
                } : n.is("optgroup") ? {
                    text: n.attr("label"),
                    children: [],
                    element: n.get(),
                    css: n.attr("class")
                } : void 0
            }, prepareOpts: function (i) {
                var e, o, s, r, f = this;
                if (e = i.element, e.get(0).tagName.toLowerCase() === "select" && (this.select = o = i.element), o && n.each(["id", "multiple", "ajax", "query", "createSearchChoice", "initSelection", "data", "tags"], function () {
                    if (this in i) throw new Error("Option '" + this + "' is not allowed for Select2 when attached to a <select> element.");
                }), i = n.extend({}, {
                    populateResults: function (r, u, e) {
                        var o, s = this.opts.id;
                        o = function (r, u, h) {
                            var a, k, l, d, p, w, c, v, y, b;
                            for (r = i.sortResults(r, u, e), a = 0, k = r.length; a < k; a = a + 1) l = r[a], p = l.disabled === !0, d = !p && s(l) !== t, w = l.children && l.children.length > 0, c = n("<li><\/li>"), c.addClass("select2-results-dept-" + h), c.addClass("select2-result"), c.addClass(d ? "select2-result-selectable" : "select2-result-unselectable"), p && c.addClass("select2-disabled"), w && c.addClass("select2-result-with-children"), c.addClass(f.opts.formatResultCssClass(l)), v = n(document.createElement("div")), v.addClass("select2-result-label"), b = i.formatResult(l, v, e, f.opts.escapeMarkup), b !== t && v.html(b), c.append(v), w && (y = n("<ul><\/ul>"), y.addClass("select2-result-sub"), o(l.children, y, h + 1), c.append(y)), c.data("select2-data", l), u.append(c)
                        };
                        o(u, r, 0)
                    }
                }, n.fn.select2.defaults, i), typeof i.id != "function" && (s = i.id, i.id = function (n) {
                    return n[s]
                }), n.isArray(i.element.data("select2Tags"))) {
                    if ("tags" in i) throw"tags specified as both an attribute 'data-select2-tags' and in options of Select2 " + i.element.attr("id");
                    i.tags = i.element.data("select2Tags")
                }
                if (o ? (i.query = this.bind(function (n) {
                    var o = {results: [], more: !1}, s = n.term, i, r, u;
                    u = function (t, i) {
                        var r;
                        t.is("option") ? n.matcher(s, t.text(), t) && i.push(f.optionToData(t)) : t.is("optgroup") && (r = f.optionToData(t), t.children().each2(function (n, t) {
                            u(t, r.children)
                        }), r.children.length > 0 && i.push(r))
                    };
                    i = e.children();
                    this.getPlaceholder() !== t && i.length > 0 && (r = this.getPlaceholderOption(), r && (i = i.not(r)));
                    i.each2(function (n, t) {
                        u(t, o.results)
                    });
                    n.callback(o)
                }), i.id = function (n) {
                    return n.id
                }, i.formatResultCssClass = function (n) {
                    return n.css
                }) : "query" in i || ("ajax" in i ? (r = i.element.data("ajax-url"), r && r.length > 0 && (i.ajax.url = r), i.query = ut.call(i.element, i.ajax)) : "data" in i ? i.query = ft(i.data) : "tags" in i && (i.query = et(i.tags), i.createSearchChoice === t && (i.createSearchChoice = function (t) {
                    return {id: n.trim(t), text: n.trim(t)}
                }), i.initSelection === t && (i.initSelection = function (t, r) {
                    var f = [];
                    n(b(t.val(), i.separator)).each(function () {
                        var r = {id: this, text: this}, t = i.tags;
                        n.isFunction(t) && (t = t());
                        n(t).each(function () {
                            if (u(this.id, r.id)) return r = this, !1
                        });
                        f.push(r)
                    });
                    r(f)
                }))), typeof i.query != "function") throw"query function not defined for Select2 " + i.element.attr("id");
                return i
            }, monitorSource: function () {
                var n = this.opts.element, i;
                n.on("change.select2", this.bind(function () {
                    this.opts.element.data("select2-change-triggered") !== !0 && this.initSelection()
                }));
                i = this.bind(function () {
                    var u = this, r = n.prop("disabled"), i;
                    r === t && (r = !1);
                    this.enable(!r);
                    i = n.prop("readonly");
                    i === t && (i = !1);
                    this.readonly(i);
                    a(this.container, this.opts.element, this.opts.adaptContainerCssClass);
                    this.container.addClass(e(this.opts.containerCssClass));
                    a(this.dropdown, this.opts.element, this.opts.adaptDropdownCssClass);
                    this.dropdown.addClass(e(this.opts.dropdownCssClass))
                });
                n.on("propertychange.select2 DOMAttrModified.select2", i);
                this.mutationCallback === t && (this.mutationCallback = function (n) {
                    n.forEach(i)
                });
                typeof WebKitMutationObserver != "undefined" && (this.propertyObserver && (delete this.propertyObserver, this.propertyObserver = null), this.propertyObserver = new WebKitMutationObserver(this.mutationCallback), this.propertyObserver.observe(n.get(0), {
                    attributes: !0,
                    subtree: !1
                }))
            }, triggerSelect: function (t) {
                var i = n.Event("select2-selecting", {val: this.id(t), object: t});
                return this.opts.element.trigger(i), !i.isDefaultPrevented()
            }, triggerChange: function (t) {
                t = t || {};
                t = n.extend({}, t, {type: "change", val: this.val()});
                this.opts.element.data("select2-change-triggered", !0);
                this.opts.element.trigger(t);
                this.opts.element.data("select2-change-triggered", !1);
                this.opts.element.click();
                this.opts.blurOnChange && this.opts.element.blur()
            }, isInterfaceEnabled: function () {
                return this.enabledInterface === !0
            }, enableInterface: function () {
                var n = this._enabled && !this._readonly, t = !n;
                return n === this.enabledInterface ? !1 : (this.container.toggleClass("select2-container-disabled", t), this.close(), this.enabledInterface = n, !0)
            }, enable: function (n) {
                (n === t && (n = !0), this._enabled !== n) && (this._enabled = n, this.opts.element.prop("disabled", !n), this.enableInterface())
            }, disable: function () {
                this.enable(!1)
            }, readonly: function (n) {
                return (n === t && (n = !1), this._readonly === n) ? !1 : (this._readonly = n, this.opts.element.prop("readonly", n), this.enableInterface(), !0)
            }, opened: function () {
                return this.container.hasClass("select2-dropdown-open")
            }, positionDropdown: function () {
                var t = this.dropdown, u = this.container.offset(), k = this.container.outerHeight(!1),
                    h = t.outerHeight(!1), a = n(window).scrollLeft() + n(window).width(),
                    d = n(window).scrollTop() + n(window).height(), s = u.top + k, f = u.left, v = s + h <= d,
                    y = u.top - h >= this.body().scrollTop(), i = t.outerWidth(!1), p = f + i <= a,
                    g = t.hasClass("select2-drop-above"), c, o, b, l, nt = !!navigator.userAgent.match(/MSIE 8.0/),
                    tt = !!navigator.userAgent.match(/MSIE 9.0/), r;
                r = nt || tt ? this.container.outerWidth(!1) : window.getComputedStyle(this.container[0]).width;
                this.opts.dropdownAutoWidth ? (l = n(".select2-results", t)[0], t.addClass("select2-drop-auto-width"), t.css("width", ""), i = t.outerWidth(!1) + (l.scrollHeight === l.clientHeight ? 0 : w.width), i > r ? r = i : i = r, p = f + i <= a) : this.container.removeClass("select2-drop-auto-width");
                this.body().css("position") !== "static" && (c = this.body().offset(), s -= c.top, f -= c.left);
                g ? (o = !0, !y && v && (o = !1)) : (o = !1, !v && y && (o = !0));
                p || (f = u.left + r - i);
                o ? (s = u.top - h, this.container.addClass("select2-drop-above"), t.addClass("select2-drop-above")) : (this.container.removeClass("select2-drop-above"), t.removeClass("select2-drop-above"));
                b = n.extend({top: s, left: f, width: r}, e(this.opts.dropdownCss));
                t.css(b)
            }, shouldOpen: function () {
                var t;
                return this.opened() ? !1 : this._enabled === !1 || this._readonly === !0 ? !1 : (t = n.Event("select2-opening"), this.opts.element.trigger(t), !t.isDefaultPrevented())
            }, clearDropdownAlignmentPreference: function () {
                this.container.removeClass("select2-drop-above");
                this.dropdown.removeClass("select2-drop-above")
            }, open: function () {
                return this.shouldOpen() ? (this.opening(), !0) : !1
            }, opening: function () {
                var i = this.containerId, u = "scroll." + i, f = "resize." + i, e = "orientationchange." + i, t, r;
                if (this.container.addClass("select2-dropdown-open").addClass("select2-container-active"), this.clearDropdownAlignmentPreference(), this.dropdown[0] !== this.body().children().last()[0] && this.dropdown.detach().appendTo(this.body()), t = n("#select2-drop-mask"), t.length == 0) {
                    t = n(document.createElement("div"));
                    t.attr("id", "select2-drop-mask").attr("class", "select2-drop-mask");
                    t.hide();
                    t.appendTo(this.body());
                    t.on("mousedown touchstart click", function (t) {
                        var r = n("#select2-drop"), i;
                        r.length > 0 && (i = r.data("select2"), i.opts.selectOnBlur && i.selectHighlighted({noFocus: !0}), i.close({focus: !1}), t.preventDefault(), t.stopPropagation())
                    })
                }
                this.dropdown.prev()[0] !== t[0] && this.dropdown.before(t);
                n("#select2-drop").removeAttr("id");
                this.dropdown.attr("id", "select2-drop");
                t.show();
                this.positionDropdown();
                this.dropdown.show();
                this.positionDropdown();
                this.dropdown.addClass("select2-drop-active");
                r = this;
                this.container.parents().add(window).each(function () {
                    n(this).on(f + " " + u + " " + e, function () {
                        r.positionDropdown()
                    })
                })
            }, close: function () {
                if (this.opened()) {
                    var t = this.containerId, i = "scroll." + t, r = "resize." + t, u = "orientationchange." + t;
                    this.container.parents().add(window).each(function () {
                        n(this).off(i).off(r).off(u)
                    });
                    this.clearDropdownAlignmentPreference();
                    n("#select2-drop-mask").hide();
                    this.dropdown.removeAttr("id");
                    this.dropdown.hide();
                    this.container.removeClass("select2-dropdown-open").removeClass("select2-container-active");
                    this.results.empty();
                    this.clearSearch();
                    this.search.removeClass("select2-active");
                    this.opts.element.trigger(n.Event("select2-close"))
                }
            }, externalSearch: function (n) {
                this.open();
                this.search.val(n);
                this.updateResults(!1)
            }, clearSearch: function () {
            }, getMaximumSelectionSize: function () {
                return e(this.opts.maximumSelectionSize)
            }, ensureHighlightVisible: function () {
                var t = this.results, e, i, r, u, o, s, f;
                if (i = this.highlight(), !(i < 0)) {
                    if (i == 0) {
                        t.scrollTop(0);
                        return
                    }
                    e = this.findHighlightableChoices().find(".select2-result-label");
                    r = n(e[i]);
                    u = r.offset().top + r.outerHeight(!0);
                    i === e.length - 1 && (f = t.find("li.select2-more-results"), f.length > 0 && (u = f.offset().top + f.outerHeight(!0)));
                    o = t.offset().top + t.outerHeight(!0);
                    u > o && t.scrollTop(t.scrollTop() + (u - o));
                    s = r.offset().top - t.offset().top;
                    s < 0 && r.css("display") != "none" && t.scrollTop(t.scrollTop() + s)
                }
            }, findHighlightableChoices: function () {
                return this.results.find(".select2-result-selectable:not(.select2-disabled)")
            }, moveHighlight: function (t) {
                for (var u = this.findHighlightableChoices(), i = this.highlight(), r; i > -1 && i < u.length;) if (i += t, r = n(u[i]), r.hasClass("select2-result-selectable") && !r.hasClass("select2-disabled") && !r.hasClass("select2-selected")) {
                    this.highlight(i);
                    break
                }
            }, highlight: function (t) {
                var i = this.findHighlightableChoices(), u, r;
                if (arguments.length === 0) return f(i.filter(".select2-highlighted")[0], i.get());
                t >= i.length && (t = i.length - 1);
                t < 0 && (t = 0);
                this.removeHighlight();
                u = n(i[t]);
                u.addClass("select2-highlighted");
                this.ensureHighlightVisible();
                r = u.data("select2-data");
                r && this.opts.element.trigger({type: "select2-highlight", val: this.id(r), choice: r})
            }, removeHighlight: function () {
                this.results.find(".select2-highlighted").removeClass("select2-highlighted")
            }, countSelectableResults: function () {
                return this.findHighlightableChoices().length
            }, highlightUnderEvent: function (t) {
                var i = n(t.target).closest(".select2-result-selectable"), r;
                i.length > 0 && !i.is(".select2-highlighted") ? (r = this.findHighlightableChoices(), this.highlight(r.index(i))) : i.length == 0 && this.removeHighlight()
            }, loadMoreIfNeeded: function () {
                var t = this.results, i = t.find("li.select2-more-results"), u, r = this.resultsPage + 1, n = this,
                    f = this.search.val(), e = this.context;
                i.length !== 0 && (u = i.offset().top - t.offset().top - t.height(), u <= this.opts.loadMorePadding && (i.addClass("select2-active"), this.opts.query({
                    element: this.opts.element,
                    term: f,
                    page: r,
                    context: e,
                    matcher: this.opts.matcher,
                    callback: this.bind(function (u) {
                        n.opened() && (n.opts.populateResults.call(this, t, u.results, {
                            term: f,
                            page: r,
                            context: e
                        }), n.postprocessResults(u, !1, !1), u.more === !0 ? (i.detach().appendTo(t).text(n.opts.formatLoadMore(r + 1)), window.setTimeout(function () {
                            n.loadMoreIfNeeded()
                        }, 10)) : i.remove(), n.positionDropdown(), n.resultsPage = r, n.context = u.context, this.opts.element.trigger({
                            type: "select2-loaded",
                            items: u
                        }))
                    })
                })))
            }, tokenize: function () {
            }, updateResults: function (i) {
                function w() {
                    f.removeClass("select2-active");
                    e.positionDropdown()
                }

                function o(n) {
                    h.html(n);
                    w()
                }

                var f = this.search, h = this.results, r = this.opts, a, e = this, c, v = f.val(),
                    y = n.data(this.container, "select2-last-term"), p, l;
                if ((i === !0 || !y || !u(v, y)) && (n.data(this.container, "select2-last-term", v), i === !0 || this.showSearchInput !== !1 && this.opened())) {
                    if (p = ++this.queryCount, l = this.getMaximumSelectionSize(), l >= 1 && (a = this.data(), n.isArray(a) && a.length >= l && s(r.formatSelectionTooBig, "formatSelectionTooBig"))) {
                        o("<li class='select2-selection-limit'>" + r.formatSelectionTooBig(l) + "<\/li>");
                        return
                    }
                    if (f.val().length < r.minimumInputLength) {
                        s(r.formatInputTooShort, "formatInputTooShort") ? o("<li class='select2-no-results'>" + r.formatInputTooShort(f.val(), r.minimumInputLength) + "<\/li>") : o("");
                        i && this.showSearch && this.showSearch(!0);
                        return
                    }
                    if (r.maximumInputLength && f.val().length > r.maximumInputLength) {
                        s(r.formatInputTooLong, "formatInputTooLong") ? o("<li class='select2-no-results'>" + r.formatInputTooLong(f.val(), r.maximumInputLength) + "<\/li>") : o("");
                        return
                    }
                    r.formatSearching && this.findHighlightableChoices().length === 0 && o("<li class='select2-searching'>" + r.formatSearching() + "<\/li>");
                    f.addClass("select2-active");
                    this.removeHighlight();
                    c = this.tokenize();
                    c != t && c != null && f.val(c);
                    this.resultsPage = 1;
                    r.query({
                        element: r.element,
                        term: f.val(),
                        page: this.resultsPage,
                        context: null,
                        matcher: r.matcher,
                        callback: this.bind(function (c) {
                            var l;
                            if (p == this.queryCount) {
                                if (!this.opened()) {
                                    this.search.removeClass("select2-active");
                                    return
                                }
                                if (this.context = c.context === t ? null : c.context, this.opts.createSearchChoice && f.val() !== "" && (l = this.opts.createSearchChoice.call(e, f.val(), c.results), l !== t && l !== null && e.id(l) !== t && e.id(l) !== null && n(c.results).filter(function () {
                                    return u(e.id(this), e.id(l))
                                }).length === 0 && c.results.unshift(l)), c.results.length === 0 && s(r.formatNoMatches, "formatNoMatches")) {
                                    o("<li class='select2-no-results'>" + r.formatNoMatches(f.val()) + "<\/li>");
                                    return
                                }
                                h.empty();
                                e.opts.populateResults.call(this, h, c.results, {
                                    term: f.val(),
                                    page: this.resultsPage,
                                    context: null
                                });
                                c.more === !0 && s(r.formatLoadMore, "formatLoadMore") && (h.append("<li class='select2-more-results'>" + e.opts.escapeMarkup(r.formatLoadMore(this.resultsPage)) + "<\/li>"), window.setTimeout(function () {
                                    e.loadMoreIfNeeded()
                                }, 10));
                                this.postprocessResults(c, i);
                                w();
                                this.opts.element.trigger({type: "select2-loaded", items: c})
                            }
                        })
                    })
                }
            }, cancel: function () {
                this.close()
            }, blur: function () {
                this.opts.selectOnBlur && this.selectHighlighted({noFocus: !0});
                this.close();
                this.container.removeClass("select2-container-active");
                this.search[0] === document.activeElement && this.search.blur();
                this.clearSearch();
                this.selection.find(".select2-search-choice-focus").removeClass("select2-search-choice-focus")
            }, focusSearch: function () {
                yt(this.search)
            }, selectHighlighted: function (n) {
                var i = this.highlight(), r = this.results.find(".select2-highlighted"),
                    t = r.closest(".select2-result").data("select2-data");
                if (t) {
                    this.highlight(i);
                    this.onSelect(t, n)
                } else n && n.noFocus && this.close()
            }, getPlaceholder: function () {
                var n;
                return this.opts.element.attr("placeholder") || this.opts.element.attr("data-placeholder") || this.opts.element.data("placeholder") || this.opts.placeholder || ((n = this.getPlaceholderOption()) !== t ? n.text() : t)
            }, getPlaceholderOption: function () {
                if (this.select) {
                    var n = this.select.children().first();
                    if (this.opts.placeholderOption !== t) return this.opts.placeholderOption === "first" && n || typeof this.opts.placeholderOption == "function" && this.opts.placeholderOption(this.select);
                    if (n.text() === "" && n.val() === "") return n
                }
            }, initContainerWidth: function () {
                function r() {
                    var i, f, u, r, e;
                    if (this.opts.width === "off") return null;
                    if (this.opts.width === "element") return this.opts.element.outerWidth(!1) === 0 ? "auto" : this.opts.element.outerWidth(!1) + "px";
                    if (this.opts.width === "copy" || this.opts.width === "resolve") {
                        if (i = this.opts.element.attr("style"), i !== t) for (f = i.split(";"), r = 0, e = f.length; r < e; r = r + 1) if (u = f[r].replace(/\s/g, "").match(/[^-]width:(([-+]?([0-9]*\.)?[0-9]+)(px|em|ex|%|in|cm|mm|pt|pc))/i), u !== null && u.length >= 1) return u[1];
                        return this.opts.width === "resolve" ? (i = this.opts.element.css("width"), i.indexOf("%") > 0) ? i : this.opts.element.outerWidth(!1) === 0 ? "auto" : this.opts.element.outerWidth(!1) + "px" : null
                    }
                    return n.isFunction(this.opts.width) ? this.opts.width() : this.opts.width
                }

                var i = r.call(this);
                i !== null && this.container.css("width", i)
            }
        });
        v = k(c, {
            createContainer: function () {
                return n(document.createElement("div")).attr({"class": "select2-container"}).html("<a href='javascript:void(0)' onclick='return false;' class='select2-choice' tabindex='-1'>   <span class='select2-chosen'>&nbsp;<\/span><abbr class='select2-search-choice-close'><\/abbr>   <span class='select2-arrow'><b><\/b><\/span><\/a><input class='select2-focusser select2-offscreen' type='text'/><div class='select2-drop select2-display-none'>   <div class='select2-search'>       <input type='text' autocomplete='off' autocorrect='off' autocapitalize='off' spellcheck='false' class='select2-input'/>   <\/div>   <ul class='select2-results'>   <\/ul><\/div>")
            }, enableInterface: function () {
                this.parent.enableInterface.apply(this, arguments) && this.focusser.prop("disabled", !this.isInterfaceEnabled())
            }, opening: function () {
                var i, r, u;
                this.opts.minimumResultsForSearch >= 0 && this.showSearch(!0);
                this.parent.opening.apply(this, arguments);
                this.showSearchInput !== !1 && this.search.val(this.focusser.val());
                this.search.focus();
                i = this.search.get(0);
                i.createTextRange ? (r = i.createTextRange(), r.collapse(!1), r.select()) : i.setSelectionRange && (u = this.search.val().length, i.setSelectionRange(u, u));
                this.search.val() === "" && this.nextSearchTerm != t && (this.search.val(this.nextSearchTerm), this.search.select());
                this.focusser.prop("disabled", !0).val("");
                this.updateResults(!0);
                this.opts.element.trigger(n.Event("select2-open"))
            }, close: function (n) {
                this.opened() && (this.parent.close.apply(this, arguments), n = n || {focus: !0}, this.focusser.removeAttr("disabled"), n.focus && this.focusser.focus())
            }, focus: function () {
                this.opened() ? this.close() : (this.focusser.removeAttr("disabled"), this.focusser.focus())
            }, isFocused: function () {
                return this.container.hasClass("select2-container-active")
            }, cancel: function () {
                this.parent.cancel.apply(this, arguments);
                this.focusser.removeAttr("disabled");
                this.focusser.focus()
            }, destroy: function () {
                n("label[for='" + this.focusser.attr("id") + "']").attr("for", this.opts.element.attr("id"));
                this.parent.destroy.apply(this, arguments)
            }, initContainer: function () {
                var t, u = this.container, f = this.dropdown;
                this.opts.minimumResultsForSearch < 0 ? this.showSearch(!1) : this.showSearch(!0);
                this.selection = t = u.find(".select2-choice");
                this.focusser = u.find(".select2-focusser");
                this.focusser.attr("id", "s2id_autogen" + l());
                n("label[for='" + this.opts.element.attr("id") + "']").attr("for", this.focusser.attr("id"));
                this.focusser.attr("tabindex", this.elementTabIndex);
                this.search.on("keydown", this.bind(function (n) {
                    if (this.isInterfaceEnabled()) {
                        if (n.which === i.PAGE_UP || n.which === i.PAGE_DOWN) {
                            r(n);
                            return
                        }
                        switch (n.which) {
                            case i.UP:
                            case i.DOWN:
                                this.moveHighlight(n.which === i.UP ? -1 : 1);
                                r(n);
                                return;
                            case i.ENTER:
                                this.selectHighlighted();
                                r(n);
                                return;
                            case i.TAB:
                                this.selectHighlighted({noFocus: !0});
                                return;
                            case i.ESC:
                                this.cancel(n);
                                r(n);
                                return
                        }
                    }
                }));
                this.search.on("blur", this.bind(function () {
                    document.activeElement === this.body().get(0) && window.setTimeout(this.bind(function () {
                        this.search.focus()
                    }), 0)
                }));
                this.focusser.on("keydown", this.bind(function (n) {
                    if (this.isInterfaceEnabled() && n.which !== i.TAB && !i.isControl(n) && !i.isFunctionKey(n) && n.which !== i.ESC) {
                        if (this.opts.openOnEnter === !1 && n.which === i.ENTER) {
                            r(n);
                            return
                        }
                        if (n.which == i.DOWN || n.which == i.UP || n.which == i.ENTER && this.opts.openOnEnter) {
                            if (n.altKey || n.ctrlKey || n.shiftKey || n.metaKey) return;
                            this.open();
                            r(n);
                            return
                        }
                        if (n.which == i.DELETE || n.which == i.BACKSPACE) {
                            this.opts.allowClear && this.clear();
                            r(n);
                            return
                        }
                    }
                }));
                nt(this.focusser);
                this.focusser.on("keyup-change input", this.bind(function (n) {
                    if (this.opts.minimumResultsForSearch >= 0) {
                        if (n.stopPropagation(), this.opened()) return;
                        this.open()
                    }
                }));
                t.on("mousedown", "abbr", this.bind(function (n) {
                    this.isInterfaceEnabled() && (this.clear(), wt(n), this.close(), this.selection.focus())
                }));
                t.on("mousedown", this.bind(function (t) {
                    this.container.hasClass("select2-container-active") || this.opts.element.trigger(n.Event("select2-focus"));
                    this.opened() ? this.close() : this.isInterfaceEnabled() && this.open();
                    r(t)
                }));
                f.on("mousedown", this.bind(function () {
                    this.search.focus()
                }));
                t.on("focus", this.bind(function (n) {
                    r(n)
                }));
                this.focusser.on("focus", this.bind(function () {
                    this.container.hasClass("select2-container-active") || this.opts.element.trigger(n.Event("select2-focus"));
                    this.container.addClass("select2-container-active")
                })).on("blur", this.bind(function () {
                    this.opened() || (this.container.removeClass("select2-container-active"), this.opts.element.trigger(n.Event("select2-blur")))
                }));
                this.search.on("focus", this.bind(function () {
                    this.container.hasClass("select2-container-active") || this.opts.element.trigger(n.Event("select2-focus"));
                    this.container.addClass("select2-container-active")
                }));
                this.initContainerWidth();
                this.opts.element.addClass("select2-offscreen");
                this.setPlaceholder()
            }, clear: function (t) {
                var i = this.selection.data("select2-data"), r, u;
                if (i) {
                    if (r = n.Event("select2-clearing"), this.opts.element.trigger(r), r.isDefaultPrevented()) return;
                    u = this.getPlaceholderOption();
                    this.opts.element.val(u ? u.val() : "");
                    this.selection.find(".select2-chosen").empty();
                    this.selection.removeData("select2-data");
                    this.setPlaceholder();
                    t !== !1 && (this.opts.element.trigger({
                        type: "select2-removed",
                        val: this.id(i),
                        choice: i
                    }), this.triggerChange({removed: i}))
                }
            }, initSelection: function () {
                var n;
                this.isPlaceholderOptionSelected() ? (this.updateSelection(null), this.close(), this.setPlaceholder()) : (n = this, this.opts.initSelection.call(null, this.opts.element, function (i) {
                    i !== t && i !== null && (n.updateSelection(i), n.close(), n.setPlaceholder())
                }))
            }, isPlaceholderOptionSelected: function () {
                var n;
                return this.getPlaceholder() ? (n = this.getPlaceholderOption()) !== t && n.is(":selected") || this.opts.element.val() === "" || this.opts.element.val() === t || this.opts.element.val() === null : !1
            }, prepareOpts: function () {
                var t = this.parent.prepareOpts.apply(this, arguments), i = this;
                return t.element.get(0).tagName.toLowerCase() === "select" ? t.initSelection = function (n, t) {
                    var r = n.find(":selected");
                    t(i.optionToData(r))
                } : "data" in t && (t.initSelection = t.initSelection || function (i, r) {
                    var e = i.val(), f = null;
                    t.query({
                        matcher: function (n, i, r) {
                            var o = u(e, t.id(r));
                            return o && (f = r), o
                        }, callback: n.isFunction(r) ? function () {
                            r(f)
                        } : n.noop
                    })
                }), t
            }, getPlaceholder: function () {
                return this.select && this.getPlaceholderOption() === t ? t : this.parent.getPlaceholder.apply(this, arguments)
            }, setPlaceholder: function () {
                var n = this.getPlaceholder();
                if (this.isPlaceholderOptionSelected() && n !== t) {
                    if (this.select && this.getPlaceholderOption() === t) return;
                    this.selection.find(".select2-chosen").html(this.opts.escapeMarkup(n));
                    this.selection.addClass("select2-default");
                    this.container.removeClass("select2-allowclear")
                }
            }, postprocessResults: function (n, t, i) {
                var r = 0, e = this, f;
                this.findHighlightableChoices().each2(function (n, t) {
                    if (u(e.id(t.data("select2-data")), e.opts.element.val())) return r = n, !1
                });
                i !== !1 && (t === !0 && r >= 0 ? this.highlight(r) : this.highlight(0));
                t === !0 && (f = this.opts.minimumResultsForSearch, f >= 0 && this.showSearch(ot(n.results) >= f))
            }, showSearch: function (t) {
                this.showSearchInput !== t && (this.showSearchInput = t, this.dropdown.find(".select2-search").toggleClass("select2-search-hidden", !t), this.dropdown.find(".select2-search").toggleClass("select2-offscreen", !t), n(this.dropdown, this.container).toggleClass("select2-with-searchbox", t))
            }, onSelect: function (n, t) {
                if (this.triggerSelect(n)) {
                    var i = this.opts.element.val(), r = this.data();
                    this.opts.element.val(this.id(n));
                    this.updateSelection(n);
                    this.opts.element.trigger({type: "select2-selected", val: this.id(n), choice: n});
                    this.nextSearchTerm = this.opts.nextSearchTerm(n, this.search.val());
                    this.close();
                    t && t.noFocus || this.focusser.focus();
                    u(i, this.id(n)) || this.triggerChange({added: n, removed: r})
                }
            }, updateSelection: function (n) {
                var i = this.selection.find(".select2-chosen"), r, u;
                this.selection.data("select2-data", n);
                i.empty();
                n !== null && (r = this.opts.formatSelection(n, i, this.opts.escapeMarkup));
                r !== t && i.append(r);
                u = this.opts.formatSelectionCssClass(n, i);
                u !== t && i.addClass(u);
                this.selection.removeClass("select2-default");
                this.opts.allowClear && this.getPlaceholder() !== t && this.container.addClass("select2-allowclear")
            }, val: function () {
                var i, r = !1, u = null, n = this, f = this.data();
                if (arguments.length === 0) return this.opts.element.val();
                if (i = arguments[0], arguments.length > 1 && (r = arguments[1]), this.select) this.select.val(i).find(":selected").each2(function (t, i) {
                    return u = n.optionToData(i), !1
                }), this.updateSelection(u), this.setPlaceholder(), r && this.triggerChange({
                    added: u,
                    removed: f
                }); else {
                    if (!i && i !== 0) {
                        this.clear(r);
                        return
                    }
                    if (this.opts.initSelection === t) throw new Error("cannot call val() if initSelection() is not defined");
                    this.opts.element.val(i);
                    this.opts.initSelection(this.opts.element, function (t) {
                        n.opts.element.val(t ? n.id(t) : "");
                        n.updateSelection(t);
                        n.setPlaceholder();
                        r && n.triggerChange({added: t, removed: f})
                    })
                }
            }, clearSearch: function () {
                this.search.val("");
                this.focusser.val("")
            }, data: function (n) {
                var i, r = !1;
                if (arguments.length === 0) return i = this.selection.data("select2-data"), i == t && (i = null), i;
                arguments.length > 1 && (r = arguments[1]);
                n ? (i = this.data(), this.opts.element.val(n ? this.id(n) : ""), this.updateSelection(n), r && this.triggerChange({
                    added: n,
                    removed: i
                })) : this.clear(r)
            }
        });
        y = k(c, {
            createContainer: function () {
                return n(document.createElement("div")).attr({"class": "select2-container select2-container-multi"}).html("<ul class='select2-choices'>  <li class='select2-search-field'>    <input type='text' autocomplete='off' autocorrect='off' autocapitalize='off' spellcheck='false' class='select2-input'>  <\/li><\/ul><div class='select2-drop select2-drop-multi select2-display-none'>   <ul class='select2-results'>   <\/ul><\/div>")
            }, prepareOpts: function () {
                var t = this.parent.prepareOpts.apply(this, arguments), i = this;
                return t.element.get(0).tagName.toLowerCase() === "select" ? t.initSelection = function (n, t) {
                    var r = [];
                    n.find(":selected").each2(function (n, t) {
                        r.push(i.optionToData(t))
                    });
                    t(r)
                } : "data" in t && (t.initSelection = t.initSelection || function (i, r) {
                    var e = b(i.val(), t.separator), f = [];
                    t.query({
                        matcher: function (i, r, o) {
                            var s = n.grep(e, function (n) {
                                return u(n, t.id(o))
                            }).length;
                            return s && f.push(o), s
                        }, callback: n.isFunction(r) ? function () {
                            for (var h, n, o, s = [], i = 0; i < e.length; i++) for (h = e[i], n = 0; n < f.length; n++) if (o = f[n], u(h, t.id(o))) {
                                s.push(o);
                                f.splice(n, 1);
                                break
                            }
                            r(s)
                        } : n.noop
                    })
                }), t
            }, selectChoice: function (n) {
                var t = this.container.find(".select2-search-choice-focus");
                t.length && n && n[0] == t[0] || (t.length && this.opts.element.trigger("choice-deselected", t), t.removeClass("select2-search-choice-focus"), n && n.length && (this.close(), n.addClass("select2-search-choice-focus"), this.opts.element.trigger("choice-selected", n)))
            }, destroy: function () {
                n("label[for='" + this.search.attr("id") + "']").attr("for", this.opts.element.attr("id"));
                this.parent.destroy.apply(this, arguments)
            }, initContainer: function () {
                var t = ".select2-choices", u, f;
                this.searchContainer = this.container.find(".select2-search-field");
                this.selection = u = this.container.find(t);
                f = this;
                this.selection.on("click", ".select2-search-choice:not(.select2-locked)", function () {
                    f.search[0].focus();
                    f.selectChoice(n(this))
                });
                this.search.attr("id", "s2id_autogen" + l());
                n("label[for='" + this.opts.element.attr("id") + "']").attr("for", this.search.attr("id"));
                this.search.on("input paste", this.bind(function () {
                    this.isInterfaceEnabled() && (this.opened() || this.open())
                }));
                this.search.attr("tabindex", this.elementTabIndex);
                this.keydowns = 0;
                this.search.on("keydown", this.bind(function (n) {
                    var t;
                    if (this.isInterfaceEnabled()) {
                        ++this.keydowns;
                        var f = u.find(".select2-search-choice-focus"),
                            o = f.prev(".select2-search-choice:not(.select2-locked)"),
                            e = f.next(".select2-search-choice:not(.select2-locked)"), s = pt(this.search);
                        if (f.length && (n.which == i.LEFT || n.which == i.RIGHT || n.which == i.BACKSPACE || n.which == i.DELETE || n.which == i.ENTER)) {
                            t = f;
                            n.which == i.LEFT && o.length ? t = o : n.which == i.RIGHT ? t = e.length ? e : null : n.which === i.BACKSPACE ? (this.unselect(f.first()), this.search.width(10), t = o.length ? o : e) : n.which == i.DELETE ? (this.unselect(f.first()), this.search.width(10), t = e.length ? e : null) : n.which == i.ENTER && (t = null);
                            this.selectChoice(t);
                            r(n);
                            t && t.length || this.open();
                            return
                        }
                        if ((n.which !== i.BACKSPACE || this.keydowns != 1) && n.which != i.LEFT || s.offset != 0 || s.length) this.selectChoice(null); else {
                            this.selectChoice(u.find(".select2-search-choice:not(.select2-locked)").last());
                            r(n);
                            return
                        }
                        if (this.opened()) switch (n.which) {
                            case i.UP:
                            case i.DOWN:
                                this.moveHighlight(n.which === i.UP ? -1 : 1);
                                r(n);
                                return;
                            case i.ENTER:
                                this.selectHighlighted();
                                r(n);
                                return;
                            case i.TAB:
                                this.selectHighlighted({noFocus: !0});
                                this.close();
                                return;
                            case i.ESC:
                                this.cancel(n);
                                r(n);
                                return
                        }
                        if (n.which !== i.TAB && !i.isControl(n) && !i.isFunctionKey(n) && n.which !== i.BACKSPACE && n.which !== i.ESC) {
                            if (n.which === i.ENTER) {
                                if (this.opts.openOnEnter === !1) return;
                                if (n.altKey || n.ctrlKey || n.shiftKey || n.metaKey) return
                            }
                            this.open();
                            (n.which === i.PAGE_UP || n.which === i.PAGE_DOWN) && r(n);
                            n.which === i.ENTER && r(n)
                        }
                    }
                }));
                this.search.on("keyup", this.bind(function () {
                    this.keydowns = 0;
                    this.resizeSearch()
                }));
                this.search.on("blur", this.bind(function (t) {
                    this.container.removeClass("select2-container-active");
                    this.search.removeClass("select2-focused");
                    this.selectChoice(null);
                    this.opened() || this.clearSearch();
                    t.stopImmediatePropagation();
                    this.opts.element.trigger(n.Event("select2-blur"))
                }));
                this.container.on("click", t, this.bind(function (t) {
                    this.isInterfaceEnabled() && (n(t.target).closest(".select2-search-choice").length > 0 || (this.selectChoice(null), this.clearPlaceholder(), this.container.hasClass("select2-container-active") || this.opts.element.trigger(n.Event("select2-focus")), this.open(), this.focusSearch(), t.preventDefault()))
                }));
                this.container.on("focus", t, this.bind(function () {
                    this.isInterfaceEnabled() && (this.container.hasClass("select2-container-active") || this.opts.element.trigger(n.Event("select2-focus")), this.container.addClass("select2-container-active"), this.dropdown.addClass("select2-drop-active"), this.clearPlaceholder())
                }));
                this.initContainerWidth();
                this.opts.element.addClass("select2-offscreen");
                this.clearSearch()
            }, enableInterface: function () {
                this.parent.enableInterface.apply(this, arguments) && this.search.prop("disabled", !this.isInterfaceEnabled())
            }, initSelection: function () {
                var n;
                this.opts.element.val() === "" && this.opts.element.text() === "" && (this.updateSelection([]), this.close(), this.clearSearch());
                (this.select || this.opts.element.val() !== "") && (n = this, this.opts.initSelection.call(null, this.opts.element, function (i) {
                    i !== t && i !== null && (n.updateSelection(i), n.close(), n.clearSearch())
                }))
            }, clearSearch: function () {
                var n = this.getPlaceholder(), i = this.getMaxSearchWidth();
                n !== t && this.getVal().length === 0 && this.search.hasClass("select2-focused") === !1 ? (this.search.val(n).addClass("select2-default"), this.search.width(i > 0 ? i : this.container.css("width"))) : this.search.val("").width(10)
            }, clearPlaceholder: function () {
                this.search.hasClass("select2-default") && this.search.val("").removeClass("select2-default")
            }, opening: function () {
                this.clearPlaceholder();
                this.resizeSearch();
                this.parent.opening.apply(this, arguments);
                this.focusSearch();
                this.updateResults(!0);
                this.search.focus();
                this.opts.element.trigger(n.Event("select2-open"))
            }, close: function () {
                this.opened() && this.parent.close.apply(this, arguments)
            }, focus: function () {
                this.close();
                this.search.focus()
            }, isFocused: function () {
                return this.search.hasClass("select2-focused")
            }, updateSelection: function (t) {
                var r = [], u = [], i = this;
                n(t).each(function () {
                    f(i.id(this), r) < 0 && (r.push(i.id(this)), u.push(this))
                });
                t = u;
                this.selection.find(".select2-search-choice").remove();
                n(t).each(function () {
                    i.addSelectedChoice(this)
                });
                i.postprocessResults()
            }, tokenize: function () {
                var n = this.search.val();
                n = this.opts.tokenizer.call(this, n, this.data(), this.bind(this.onSelect), this.opts);
                n != null && n != t && (this.search.val(n), n.length > 0 && this.open())
            }, onSelect: function (n, t) {
                this.triggerSelect(n) && (this.addSelectedChoice(n), this.opts.element.trigger({
                    type: "selected",
                    val: this.id(n),
                    choice: n
                }), (this.select || !this.opts.closeOnSelect) && this.postprocessResults(n, !1, this.opts.closeOnSelect === !0), this.opts.closeOnSelect ? (this.close(), this.search.width(10)) : this.countSelectableResults() > 0 ? (this.search.width(10), this.resizeSearch(), this.getMaximumSelectionSize() > 0 && this.val().length >= this.getMaximumSelectionSize() && this.updateResults(!0), this.positionDropdown()) : (this.close(), this.search.width(10)), this.triggerChange({added: n}), t && t.noFocus || this.focusSearch())
            }, cancel: function () {
                this.close();
                this.focusSearch()
            }, addSelectedChoice: function (i) {
                var o = !i.locked,
                    h = n("<li class='select2-search-choice'>    <div><\/div>    <a href='#' onclick='return false;' class='select2-search-choice-close' tabindex='-1'><\/a><\/li>"),
                    c = n("<li class='select2-search-choice select2-locked'><div><\/div><\/li>"), u = o ? h : c,
                    l = this.id(i), s = this.getVal(), f, e;
                if (f = this.opts.formatSelection(i, u.find("div"), this.opts.escapeMarkup), f != t && u.find("div").replaceWith("<div>" + f + "<\/div>"), e = this.opts.formatSelectionCssClass(i, u.find("div")), e != t && u.addClass(e), o) u.find(".select2-search-choice-close").on("mousedown", r).on("click dblclick", this.bind(function (t) {
                    this.isInterfaceEnabled() && (n(t.target).closest(".select2-search-choice").fadeOut("fast", this.bind(function () {
                        this.unselect(n(t.target));
                        this.selection.find(".select2-search-choice-focus").removeClass("select2-search-choice-focus");
                        this.close();
                        this.focusSearch()
                    })).dequeue(), r(t))
                })).on("focus", this.bind(function () {
                    this.isInterfaceEnabled() && (this.container.addClass("select2-container-active"), this.dropdown.addClass("select2-drop-active"))
                }));
                u.data("select2-data", i);
                u.insertBefore(this.searchContainer);
                s.push(l);
                this.setVal(s)
            }, unselect: function (n) {
                var i = this.getVal(), t, r;
                if (n = n.closest(".select2-search-choice"), n.length === 0) throw"Invalid argument: " + n + ". Must be .select2-search-choice";
                if (t = n.data("select2-data"), t) {
                    while ((r = f(this.id(t), i)) >= 0) i.splice(r, 1), this.setVal(i), this.select && this.postprocessResults();
                    n.remove();
                    this.opts.element.trigger({type: "removed", val: this.id(t), choice: t});
                    this.triggerChange({removed: t})
                }
            }, postprocessResults: function (n, t, i) {
                var e = this.getVal(), u = this.results.find(".select2-result"),
                    o = this.results.find(".select2-result-with-children"), r = this;
                u.each2(function (n, t) {
                    var i = r.id(t.data("select2-data"));
                    f(i, e) >= 0 && (t.addClass("select2-selected"), t.find(".select2-result-selectable").addClass("select2-selected"))
                });
                o.each2(function (n, t) {
                    t.is(".select2-result-selectable") || t.find(".select2-result-selectable:not(.select2-selected)").length !== 0 || t.addClass("select2-selected")
                });
                this.highlight() == -1 && i !== !1 && r.highlight(0);
                !this.opts.createSearchChoice && !u.filter(".select2-result:not(.select2-selected)").length > 0 && (n && (!n || n.more || this.results.find(".select2-no-results").length !== 0) || s(r.opts.formatNoMatches, "formatNoMatches") && this.results.append("<li class='select2-no-results'>" + r.opts.formatNoMatches(r.search.val()) + "<\/li>"))
            }, getMaxSearchWidth: function () {
                return this.selection.width() - g(this.search)
            }, resizeSearch: function () {
                var i, u, t, f, n, r = g(this.search);
                i = bt(this.search) + 10;
                u = this.search.offset().left;
                t = this.selection.width();
                f = this.selection.offset().left;
                n = t - (u - f) - r;
                n < i && (n = t - r);
                n < 40 && (n = t - r);
                n <= 0 && (n = i);
                this.search.width(Math.floor(n))
            }, getVal: function () {
                var n;
                return this.select ? (n = this.select.val(), n === null ? [] : n) : (n = this.opts.element.val(), b(n, this.opts.separator))
            }, setVal: function (t) {
                var i;
                this.select ? this.select.val(t) : (i = [], n(t).each(function () {
                    f(this, i) < 0 && i.push(this)
                }), this.opts.element.val(i.length === 0 ? "" : i.join(this.opts.separator)))
            }, buildChangeDetails: function (n, t) {
                for (var i, t = t.slice(0), n = n.slice(0), r = 0; r < t.length; r++) for (i = 0; i < n.length; i++) u(this.opts.id(t[r]), this.opts.id(n[i])) && (t.splice(r, 1), r--, n.splice(i, 1), i--);
                return {added: t, removed: n}
            }, val: function (i, r) {
                var u, f = this;
                if (arguments.length === 0) return this.getVal();
                if (u = this.data(), u.length || (u = []), !i && i !== 0) {
                    this.opts.element.val("");
                    this.updateSelection([]);
                    this.clearSearch();
                    r && this.triggerChange({added: this.data(), removed: u});
                    return
                }
                if (this.setVal(i), this.select) this.opts.initSelection(this.select, this.bind(this.updateSelection)), r && this.triggerChange(this.buildChangeDetails(u, this.data())); else {
                    if (this.opts.initSelection === t) throw new Error("val() cannot be called if initSelection() is not defined");
                    this.opts.initSelection(this.opts.element, function (t) {
                        var i = n.map(t, f.id);
                        f.setVal(i);
                        f.updateSelection(t);
                        f.clearSearch();
                        r && f.triggerChange(f.buildChangeDetails(u, this.data()))
                    })
                }
                this.clearSearch()
            }, onSortStart: function () {
                if (this.select) throw new Error("Sorting of elements is not supported when attached to <select>. Attach to <input type='hidden'/> instead.");
                this.search.width(0);
                this.searchContainer.hide()
            }, onSortEnd: function () {
                var t = [], i = this;
                this.searchContainer.show();
                this.searchContainer.appendTo(this.searchContainer.parent());
                this.resizeSearch();
                this.selection.find(".select2-search-choice").each(function () {
                    t.push(i.opts.id(n(this).data("select2-data")))
                });
                this.setVal(t);
                this.triggerChange()
            }, data: function (t, i) {
                var f = this, r, u;
                if (arguments.length === 0) return this.selection.find(".select2-search-choice").map(function () {
                    return n(this).data("select2-data")
                }).get();
                u = this.data();
                t || (t = []);
                r = n.map(t, function (n) {
                    return f.opts.id(n)
                });
                this.setVal(r);
                this.updateSelection(t);
                this.clearSearch();
                i && this.triggerChange(this.buildChangeDetails(u, this.data()))
            }
        });
        n.fn.select2 = function () {
            var i = Array.prototype.slice.call(arguments, 0), r, u, e, o, s,
                c = ["val", "destroy", "opened", "open", "close", "focus", "isFocused", "container", "dropdown", "onSortStart", "onSortEnd", "enable", "disable", "readonly", "positionDropdown", "data", "search"],
                l = ["opened", "isFocused", "container", "dropdown"], a = ["val", "data"],
                h = {search: "externalSearch"};
            return this.each(function () {
                if (i.length === 0 || typeof i[0] == "object") r = i.length === 0 ? {} : n.extend({}, i[0]), r.element = n(this), r.element.get(0).tagName.toLowerCase() === "select" ? s = r.element.prop("multiple") : (s = r.multiple || !1, "tags" in r && (r.multiple = s = !0)), u = s ? new y : new v, u.init(r); else if (typeof i[0] == "string") {
                    if (f(i[0], c) < 0) throw"Unknown method: " + i[0];
                    if (o = t, u = n(this).data("select2"), u === t) return;
                    if (e = i[0], e === "container" ? o = u.container : e === "dropdown" ? o = u.dropdown : (h[e] && (e = h[e]), o = u[e].apply(u, i.slice(1))), f(i[0], l) >= 0 || f(i[0], a) && i.length == 1) return !1
                } else throw"Invalid arguments to select2 plugin: " + i;
            }), o === t ? this : o
        };
        n.fn.select2.defaults = {
            width: "copy",
            loadMorePadding: 0,
            closeOnSelect: !0,
            openOnEnter: !0,
            containerCss: {},
            dropdownCss: {},
            containerCssClass: "",
            dropdownCssClass: "",
            formatResult: function (n, t, i, r) {
                var u = [];
                return it(n.text, i.term, u, r), u.join("")
            },
            formatSelection: function (n, i, r) {
                return n ? r(n.text) : t
            },
            sortResults: function (n) {
                return n
            },
            formatResultCssClass: function () {
                return t
            },
            formatSelectionCssClass: function () {
                return t
            },
            formatNoMatches: function () {
                return "No matches found"
            },
            formatInputTooShort: function (n, t) {
                var i = t - n.length;
                return "Please enter " + i + " more character" + (i == 1 ? "" : "s")
            },
            formatInputTooLong: function (n, t) {
                var i = n.length - t;
                return "Please delete " + i + " character" + (i == 1 ? "" : "s")
            },
            formatSelectionTooBig: function (n) {
                return "You can only select " + n + " item" + (n == 1 ? "" : "s")
            },
            formatLoadMore: function () {
                return "Loading more results..."
            },
            formatSearching: function () {
                return "Searching..."
            },
            minimumResultsForSearch: 0,
            minimumInputLength: 0,
            maximumInputLength: null,
            maximumSelectionSize: 0,
            id: function (n) {
                return n.id
            },
            matcher: function (n, t) {
                return h("" + t).toUpperCase().indexOf(h("" + n).toUpperCase()) >= 0
            },
            separator: ",",
            tokenSeparators: [],
            tokenizer: kt,
            escapeMarkup: rt,
            blurOnChange: !1,
            selectOnBlur: !1,
            adaptContainerCssClass: function (n) {
                return n
            },
            adaptDropdownCssClass: function () {
                return null
            },
            nextSearchTerm: function () {
                return t
            }
        };
        n.fn.select2.ajaxDefaults = {transport: n.ajax, params: {type: "GET", cache: !1, dataType: "json"}};
        window.Select2 = {
            query: {ajax: ut, local: ft, tags: et},
            util: {debounce: tt, markMatch: it, escapeMarkup: rt, stripDiacritics: h},
            "class": {abstract: c, single: v, multi: y}
        }
    }
}(jQuery), function (n) {
    "use strict";
    n.extend(n.fn.select2.defaults, {
        formatNoMatches: function () {
            return "Совпадений не найдено"
        }, formatInputTooShort: function (n, t) {
            var i = t - n.length;
            return "Пожалуйста, введите еще " + i + " символ" + (i == 1 ? "" : i > 1 && i < 5 ? "а" : "ов")
        }, formatInputTooLong: function (n, t) {
            var i = n.length - t;
            return "Пожалуйста, введите на " + i + " символ" + (i == 1 ? "" : i > 1 && i < 5 ? "а" : "ов") + " меньше"
        }, formatSelectionTooBig: function (n) {
            return "Вы можете выбрать не более " + n + " элемент" + (n == 1 ? "а" : "ов")
        }, formatLoadMore: function () {
            return "Загрузка данных..."
        }, formatSearching: function () {
            return "Поиск..."
        }
    })
}(jQuery);
var clientDomain = "uzex.uz", clientId = "6F3572A1014859C2", scope = "certificate-info",
    redir = "http://www.uzex.uz/welcome", state = "", selectedUserKey = null, EIMZO_MAJOR = 3, EIMZO_MINOR = 17,
    lang = "ru",
    errorCAPIWS = "Ошибка соединения с E-IMZO. Возможно у вас не установлен модуль E-IMZO или Браузер E-IMZO.",
    errorBrowserWS = "Браузер не поддерживает технологию WebSocket. Установите последнюю версию браузера.",
    errorEnterCaptcha = "Введите цифры на картинке", errorEnterCode = "Введите код",
    errorCaptchaMismatch = "Цифры в картинке введены не верно", errorWrongPassword = "Пароль неверный.",
    errorWrongCode = "Код неверный.", errorNotActive = "Ваша учетная запись не активирована.",
    errorCertNotActive = "Ваш сертификат ключа не активен.",
    errorCookieProblem = "Данные Cookie не переданы. Включите поддержку cookies в настройках вашего браузера.",
    errorCertNotVerified = "Не удалось определить издателя сертификата.", errorCertPolicyIsInvalid = "Доступ запрещен.",
    errorTryLater = "Пожалуйста, обновите страницу и повторите попытку позже.",
    notifyRenewKey = 'Срок действия Вашего ключа ЭЦП заканчивается через <b>{}<\/b> дней. Получить новый ключ ЭЦП не посещая ГНИ можно здесь:<br><a class="renew-link" target="_blank" href="https://e-imzo.uz/">https://e-imzo.uz/<\/a><br/><a target="_blank" href="https://e-imzo.uz/manuals/get_own_key.pdf">Инструкция<\/a>',
    errorUpdateApp = '<p class="h4"><strong>ВНИМАНИЕ !!!<\/strong> <br />Установите новую версию приложения E-IMZO или Браузера E-IMZO.<br /><a style="background-color: rgba(253, 255, 255, 0.7); margin: 5px 0;" class="btn btn-default btn-xs" href="https://e-imzo.uz/main/downloads/" role="button">Скачать ПО E-IMZO<\/a><br /><strong>ВАЖНО !!!<\/strong> Установите приложение от имени Администратора<\/p>',
    AppLoad = function () {
        EIMZOClient.API_KEYS = ["localhost", "96D0C1491615C82B9A54D9989779DF825B690748224C2B04F500F370D51827CE2644D8D4A82C18184D73AB8530BB8ED537269603F61DB0D03D2104ABF789970B", "127.0.0.1", "A7BCFA5D490B351BE0754130DF03A068F855DB4333D43921125B9CF2670EF6A40370C646B90401955E1F7BC9CDBF59CE0B2C5467D820BE189C845D0B79CFC96F", "null", "E0A205EC4E7B78BBB56AFF83A733A1BB9FD39D562E67978CC5E7D73B0951DB1954595A20672A63332535E13CC6EC1E1FC8857BB09E0855D7E76E411B6FA16E9D", "esi.uzex.uz", "F96C087C34EAF8436DE966AAADA7C92DBB4B242C088DAE5F2E7A43404C19E4CF51A7215F4485992EE675C8B53B1BDA12D4E6F4A3C70D933241CD609F9E478920"];
        uiLoading();
        EIMZOClient.checkVersion(function (n, t) {
            var i = EIMZO_MAJOR * 100 + EIMZO_MINOR, r = parseInt(n) * 100 + parseInt(t);
            r < i ? uiUpdateApp() : EIMZOClient.installApiKeys(function () {
                uiLoadKeys()
            }, function (n, t) {
                t ? uiShowMessage(t) : wsError(n)
            })
        }, function (n, t) {
            t ? uiShowMessage(t) : uiNotLoaded(n)
        })
    }, uiShowMessage = function (n) {
        toastr.error(n, "Ошибка")
    }, uiLoading = function () {
        var n = $("#wait-loading"), t = $("#every-thing-ok"), i = $("#upgrade-app");
        i.css("display", "none");
        t.css("display", "none");
        n.css("display", "none")
    }, uiNotLoaded = function (n) {
        var t = $("#wait-loading"), i = $("#every-thing-ok"), r = $("#not-installed");
        i && r && t ? (t.css("display", "none"), i.css("display", "none"), r.css("display", "block"), n || uiShowMessage(errorBrowserWS)) : n ? uiShowMessage(errorCAPIWS) : uiShowMessage(errorBrowserWS)
    }, uiUpdateApp = function () {
        var t = $("#wait-loading"), i = $("#every-thing-ok"), n = $("#upgrade-app");
        n.html(errorUpdateApp);
        t.css("display", "none");
        i.css("display", "none");
        n.css("display", "block")
    }, uiLoadKeys = function () {
        uiClearCombo();
        EIMZOClient.listAllUserKeys(function (n, t) {
            return "itm-" + n.serialNumber + "-" + t
        }, function (n, t) {
            return uiCreateItem(n, t, lang)
        }, function (n, t) {
            n.length > 0 ? (uiFillCombo(n), uiLoaded(), uiComboSelect(t)) : ($("#every-thing-ok").show(), $("#btnAuth").hide(), $("#esp-box").html('<button class="btn btn-danger" type="button">Ключи не найдены! <\/button>'))
        }, function () {
            uiShowMessage(errorCAPIWS)
        })
    }, uiClearCombo = function () {
        $("#esp-list").empty()
    }, uiFillCombo = function (n) {
        for (var t in n) $("#esp-list").append(n[t])
    }, uiLoaded = function () {
        var n = $("#wait-loading"), t = $("#every-thing-ok"), i = $("#upgrade-app");
        n.css("display", "none");
        i.css("display", "none");
        t.css("display", "block")
    }, uiValidationForm = function () {
        var n = $("#wait-loading"), t = $("#every-thing-ok"), i = $("#upgrade-app");
        n.css("display", "block");
        i.css("display", "none");
        t.css("display", "none")
    }, uiComboSelect = function (n) {
        if (!n) {
            selectedUserKey = null;
            return
        }
        var i = $("#" + n).text(), t = JSON.parse(i);
        selectedUserKey = t;
        selectedUserKey.type === "certkey" ? $("#password-block").show() : selectedUserKey.type === "pfx" ? ($("#password-block").hide(), checkValidity(selectedUserKey)) : $("#password-block").hide();
        $("#esp-box .btn.dropdown-toggle").html(t.TIN + " - " + t.CN + '<i class="fa fa-chevron-down"><\/i>')
    }, checkValidity = function (n) {
        var t = $("#notification");
        if (t.css("display", "none"), n.type === "pfx" && n.validTo) {
            var r = new Date, u = new Date(n.validTo), i = Math.round(Math.abs((u.getTime() - r.getTime()) / 864e5));
            i > 0 && i <= 30 && (t.html(notifyRenewKey.replace("{}", i)), t.css("display", "block"))
        }
    }, wsError = function (n) {
        n ? uiShowMessage(errorCAPIWS + " : " + n) : uiShowMessage(errorBrowserWS)
    }, uiCreateItem = function (n, t, i) {
        var u = new Date, r;
        return t.expired = dates.compare(u, t.validTo) > 0, r = '<li><a href="#" ', r += "onclick=\"uiComboSelect('" + n + "')\"", r += ">", i === "uz" ? (r += '<img src="/assets/esi/' + t.type + '.ico" /> <b>SERTIFIKAT №:<\/b> ' + t.serialNumber.toLowerCase() + "<br />", r += "<b>INN:<\/b> " + t.TIN, r += isLegalEntity(t.TIN) ? " <b>YURIDIK SHAXS<\/b>" : " <b>JISMONIY SHAXS<\/b>", r += "<br />", r += "<b>F.I.Sh.:<\/b>" + t.CN + "<br />", t.O !== "" && (r += "<b>Tashkilot.:<\/b>" + t.O + "<br />"), r += t.expired ? "<font size=-2 color=red><b>Sertifikatni amal qilish muddati (" + t.validFrom.ddmmyyyy() + " - " + t.validTo.ddmmyyyy() + ") tugagan<\/b><\/font>" : "<font size=-2><b>Sertifikatni amal qilish muddati:<\/b> " + t.validFrom.ddmmyyyy() + " - " + t.validTo.ddmmyyyy() + "<\/font>", r += "<font size=-2><b>Sertifikatni amal qilish muddati:<\/b> " + t.validFrom.ddmmyyyy() + " - " + t.validTo.ddmmyyyy() + "<\/font>") : (r += '<img src="/assets/esi/' + t.type + '.ico" /> <b>№ СЕРТИФИКАТА:<\/b> ' + t.serialNumber.toLowerCase() + "<br />", t.TIN && (r += "<b>ИНН:<\/b> " + t.TIN), isLegalEntity(t.TIN) ? r += " <b>ЮРИДИЧЕСКОЕ ЛИЦО<\/b>" : (r += " <b>ФИЗИЧЕСКОЕ ЛИЦО<\/b>", r += "<br /><b>ПИНФЛ:<\/b> " + t.PINFL), r += "<br />", r += "<b>Ф.И.О.:<\/b>" + t.CN + "<br />", t.O !== "" && (r += "<b>Организация.:<\/b>" + t.O + "<br />"), r += t.expired ? "<font size=-2 color=red><b>Срок действия сертификата (" + t.validFrom.ddmmyyyy() + " - " + t.validTo.ddmmyyyy() + ") истек<\/b><\/font>" : "<font size=-2><b>Срок действия сертификата:<\/b> " + t.validFrom.ddmmyyyy() + " - " + t.validTo.ddmmyyyy() + "<\/font>", r += "<font size=-2><b>Срок действия сертификата:<\/b> " + t.validFrom.ddmmyyyy() + " - " + t.validTo.ddmmyyyy() + "<\/font>"), r += "<div id='" + n + "' class='hidden-value' style='display: none'>" + JSON.stringify(t) + "<\/div>", r + "<\/a><\/li>"
    }, isLegalEntity = function (n) {
        return n.charAt(0) === "2" || n.charAt(0) === "3"
    }, authorize = function () {
        if (!selectedUserKey) {
            uiShowMessage("Пожалуйста, выберите ключ!");
            return
        }
        var n = selectedUserKey;
        EIMZOClient.loadKey(n, function (t) {
            console.log("Load key ", n);
            var i = "";
            i = n.PINFL ? n.PINFL : n.TIN;
            EIMZOClient.createPkcs7(t, i, null, function (t) {
                var r, u, i, e, f;
                if (t) {
                    console.log("Encoded data ", t);
                    uiValidationForm();
                    $("#inn").val(n.TIN);
                    $("#pinfl").val(n.PINFL);
                    $("#fio").val(n.CN);
                    $("#org").val(n.O);
                    try {
                        for (r = "", u = n.alias.split(","), i = 0; i < u.length; i++) if (e = u[i], f = e.split("="), f[0] == "e") {
                            r = f[1];
                            break
                        }
                        $("#email").val(r)
                    } catch (o) {
                        $("#email").val("")
                    }
                    $("#serial").val(n.serialNumber);
                    $("#Signature").val(t);
                    $("#Certificate").val(JSON.stringify(n));
                    $("#login-form")[0].submit()
                }
            }, function (n, t) {
                t ? t.indexOf("BadPaddingException") != -1 ? uiShowMessage(errorWrongPassword) : uiShowMessage(t) : uiShowMessage(errorBrowserWS);
                n && wsError(n)
            })
        }, function (n, t) {
            t ? t.indexOf("BadPaddingException") != -1 ? uiShowMessage(errorWrongPassword) : uiShowMessage(t) : wsError(n)
        })
    };
$(AppLoad);
$(window).load(function () {
    $(".loader").delay(350).fadeOut("slow");
    $("body").delay(350).css({overflow: "visible"})
})