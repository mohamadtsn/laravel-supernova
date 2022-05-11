require('./bootstrap');

window.Services = {
    providerCallbacks: {
        booting: [],
        boot: [],
        booted: [],
    },
    onLoadCallbacks: {
        booting: [],
        boot: [],
        booted: [],
    },

    bootApp: function () {
        this.bootProviderCallback.booting().boot().booted();
        this.bootOnLoadCallback.booting().boot().booted();
    },

    isEmpty: function (data) {
        return (data === '' || data === null || ($.isArray(data) && data.length === 0));
    },

    checkPassword: function (t) {
        return (/^.*(?=.{8,})(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%&]).*$/).test(t);
    },

    serializeObject: function () {
        const o = {};
        const a = this.serializeArray();
        $.each(a, function () {
            if (o[this.name] !== undefined) {
                if (!o[this.name].push) {
                    o[this.name] = [o[this.name]];
                }
                o[this.name].push(this.value || '');
            } else {
                o[this.name] = this.value || '';
            }
        });
        return o;
    },

    convertToFaDigit: function (a) {
        let b = '' + a;
        for (let c = 48; c <= 57; c++) {
            const d = String.fromCharCode(c);
            const e = String.fromCharCode(c + 1728);
            b = b.replace(new RegExp(d.toString(), "g"), e.toString())
        }
        return b;
    },

    formatCurrency: function (num, isRial, symbol) {
        num = num.toString().replace(/\$|\,/g, "");
        if (isNaN(num)) num = "0";
        const sign = (num == (num = Math.abs(num)));
        num = Math.round(num * 100 + 0.50000000001);
        num = Math.round(num / (isRial ? 1000 : 100)).toString();
        for (let i = 0; i < Math.floor((num.length - (1 + i)) / 3); i++)
            num = num.substring(0, num.length - (4 * i + 3)) + ',' + num.substring(num.length - (4 * i + 3));
        return (((sign) ? "" : "-") + num + " " + symbol);
    },

    convertToEnDigit: function (str) {
        return str
            .replace(/۰/g, '0')
            .replace(/۱/g, '1')
            .replace(/۲/g, '2')
            .replace(/۳/g, '3')
            .replace(/۴/g, '4')
            .replace(/۵/g, '5')
            .replace(/۶/g, '6')
            .replace(/۷/g, '7')
            .replace(/۸/g, '8')
            .replace(/۹/g, '9')
            .replace(/٠/g, '0')
            .replace(/١/g, '1')
            .replace(/٢/g, '2')
            .replace(/٣/g, '3')
            .replace(/٤/g, '4')
            .replace(/٥/g, '5')
            .replace(/٦/g, '6')
            .replace(/٧/g, '7')
            .replace(/٨/g, '8')
            .replace(/٩/g, '9');

    },

    setCookie: function (cookieName, cookieValue, expireDays) {
        const d = new Date();
        d.setTime(d.getTime() + (expireDays * 24 * 60 * 60 * 1000));
        const expires = "expires=" + d.toUTCString();
        document.cookie = cookieName + "=" + cookieValue + ";" + expires + ";path=/";
    },

    getCookie: function (cookieName) {
        const name = cookieName + "=";
        const ca = document.cookie.split(';');
        for (let i = 0; i < ca.length; i++) {
            let c = ca[i];
            while (c.charAt(0) === ' ') {
                c = c.substring(1);
            }
            if (c.indexOf(name) === 0) {
                return c.substring(name.length, c.length);
            }
        }
        return "";
    },

    checkCookie: function (cookieName) {
        const name = this.getCookie(cookieName);
        return name !== "";
    },

    nl2br: function (str) {
        if (typeof str === 'undefined' || str === null) {
            return '';
        }
        const breakTag = '<br>';
        return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1' + breakTag + '$2');
    },

    arrayToObjectKey: function (array) {
        const output = {};

        array.reduce(function (object, value) {
            return Object.assign(object, {[value]: 1})
        }, output);

        return output;
    },

    getQueryString: function (url) {
        if (typeof url !== 'string' || url.indexOf('?') < 0) return '';
        return url.substring(url.indexOf('?'));
    },

    parseQueryString: function (query) {
        if (!query || typeof query !== 'string') return {};

        query = query.substring(1);
        const queryString = {};
        const vars = query.split("&");
        for (let i = 0; i < vars.length; i++) {
            if (vars[i] === "") {
                continue;
            }
            const pair = vars[i].split("=");
            const key = pair[0];
            const value = pair.length > 1 ? pair[1] : "";
            try {
                const paramValue = decodeURIComponent(value.replace(/\+/g, "%20"));
                if (typeof queryString[key] === "undefined") {
                    queryString[key] = paramValue;
                } else {
                    if (typeof queryString[key] === "string") {
                        queryString[key] = [queryString[key], paramValue];
                    } else {
                        queryString[key].push(paramValue);
                    }
                }
            } catch (err) {
            }
        }
        return queryString;
    },

    isFunction: function (variable) {
        return variable && Object.prototype.toString.call(variable) === '[object Function]';
    },

    isObject: function (variable) {
        return variable && Object.prototype.toString.call(variable) === '[object Object]';
    },

    isArray: function (variable) {
        return Object.prototype.toString.call(variable) === '[object Array]';
    },

    isConstructor: function (f) {
        try {
            return eval(f);
        } catch (err) {
            return false;
        }
    },

    getConstructor: function (f) {
        try {
            return new f();
        } catch (err) {
            return false;
        }
    },

    scrollWindowToList: function () {
        $('html, body').animate({scrollTop: 170}, 1000);
    },

    delay: function () {
        return new Delay();
    },

    numberWithCommas: function (x) {
        return x.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
    },

    URL: {
        /**
         * @see Get URL full
         * @example => http://example.test/test-page?q=tset#test-hash
         * @return {string}
         */
        full: function () {
            return window.location.href;
        },

        /**
         * @see Get URL full without origin section
         * @example => /test-page?q=test#test-hash
         * @return {string}
         */
        fullWithoutOrigin: function () {
            return this.path() + this.queryString() + this.hash();
        },

        /**
         * @see Get URL full without origin and hash section
         * @example => /test-page?q=test
         * @return {string}
         */
        fullWithoutOriginAndHash: function () {
            return this.path() + this.queryString();
        },

        /**
         * @see Get "origin" section URL
         * @example => http://example.test
         * @return {string}
         */
        origin: function () {
            return window.location.origin;
        },

        /**
         * @see Get "host" section URL
         * @example => example.test
         * @return {string}
         */
        host: function () {
            return window.location.host;
        },

        /**
         * @see Get "path" section URL
         * @example => /test-page
         * @return {string}
         */
        path: function () {
            return window.location.pathname;
        },

        /**
         * @see Get "hash" section URL
         * @example => #test-hash
         * @return {string}
         */
        hash: function () {
            return window.location.hash;
        },

        /**
         * @see Get "query string" section URL
         * @example => ?q=test&query-test[]=test-value
         * @return {string}
         */
        queryString: function () {
            return window.location.search;
        },

        /**
         * @see Create a URL with origin section
         * @param data
         * @return {string}
         */
        createWithOrigin: function (data) {
            if (data.startsWith('/')) {
                return this.origin() + data;
            }
            return this.origin() + '/' + data;
        },

        /**
         * @see Create a URL with origin section
         * @param data
         * @return {string}
         */
        createWithHost: function (data) {
            if (data.startsWith('/')) {
                return this.host() + data;
            }
            return this.host() + '/' + data;
        }
    },

    Request: {
        redirect: function (data) {
            return window.location.replace(data);
        },
        back: function () {
            window.history.back();
        },
        reload: function () {
            return window.location.reload();
        }
    },

    bootOnLoadCallback: {
        boot: function () {
            const $boot = Services.onLoadCallbacks.boot;
            if ($boot.length > 0) {
                $(window).on("load", function (event) {
                    $boot.forEach(function (item) {
                        item.callback(...[event, ...item.arguments]);
                    })
                });
            }
            return this;
        },
        booting: function () {
            const $boot = Services.onLoadCallbacks.booting;
            if ($boot.length > 0) {
                $(window).on("load", function (event) {
                    $boot.forEach(function (item) {
                        item.callback(...[event, ...item.arguments]);
                    })
                });
            }
            return this;
        },
        booted: function () {
            const $boot = Services.onLoadCallbacks.booted;
            if ($boot.length > 0) {
                $(window).on("load", function (event) {
                    $boot.forEach(function (item) {
                        item.callback(...[event, ...item.arguments]);
                    })
                });
            }
            return this;
        }
    },

    bootProviderCallback: {
        boot: function () {
            const $boot = Services.providerCallbacks.boot;
            if ($boot.length > 0) {
                $boot.forEach(function (item) {
                    item.callback(...item.arguments);
                })
            }
            return this
        },
        booting: function () {
            const $boot = Services.providerCallbacks.booting;
            if ($boot.length > 0) {
                $boot.forEach(function (item) {
                    item.callback(...item.arguments);
                })
            }
            return this
        },
        booted: function () {
            const $boot = Services.providerCallbacks.booted;
            if ($boot.length > 0) {
                $boot.forEach(function (item) {
                    item.callback(...item.arguments);
                })
            }
            return this
        }
    },

    humanFileSize: function ($size, $unit = '') {
        if ((!$unit && $size >= 1 << 30) || $unit === "GB") {
            return this.numberWithCommas(($size / (1 << 30)).toFixed(2)) + " GB";
        }
        if ((!$unit && $size >= 1 << 20) || $unit === "MB") {
            return this.numberWithCommas(($size / (1 << 20)).toFixed(2)) + " MB";
        }
        if ((!$unit && $size >= 1 << 10) || $unit === "KB") {
            return this.numberWithCommas(($size / (1 << 10)).toFixed(2)) + " KB";
        }
        return this.numberWithCommas($size) + " bytes";
    },

    pluckObject: function (object, key) {
        const response = [];
        for (const item of object) {
            response.push(item[key]);
        }
        return response;
    },

    initPageLoader: () => {
        window.preloader = new Promise((resolve, reject) => {
            $(document).find('.page-loader').delay('500').fadeOut(500, function () {
                $('body').removeClass('page-loading');
                resolve(this);
            });
        });
    }
}

class RegistererOnLoadCallback {
    static $services = Services;

    static boot(callback, ...params) {
        RegistererOnLoadCallback.$services.onLoadCallbacks.boot.push({callback: callback, arguments: params})
    }

    static booting(callback, ...params) {
        RegistererOnLoadCallback.$services.onLoadCallbacks.booting.push({callback: callback, arguments: params})
    }

    static booted(callback, ...params) {
        RegistererOnLoadCallback.$services.onLoadCallbacks.booted.push({callback: callback, arguments: params})
    }
}

class RegistererProviderCallback {
    static $services = Services;

    static boot(callback, ...params) {
        RegistererProviderCallback.$services.providerCallbacks.boot.push({callback: callback, arguments: params})
    }

    static booting(callback, ...params) {
        RegistererProviderCallback.$services.providerCallbacks.booting.push({callback: callback, arguments: params})
    }

    static booted(callback, ...params) {
        RegistererProviderCallback.$services.providerCallbacks.booted.push({callback: callback, arguments: params})
    }
}

class Delay {
    $timeOut;
    $handler;

    constructor() {
        this.$timeOut = 1500;
        this.$handler = function () {
            console.log('Empty Callback...');
        };
    }

    time(data) {
        this.$timeOut = data;
        return this;
    }

    handler(callback) {
        this.$handler = callback;
        return this;
    }

    fire() {
        setTimeout(() => {
            this.$handler();
        }, this.$timeOut)
    }
}

class Loader {
    $target;
    $overlayColor;
    $message;
    $state;
    $opacity;
    $size;

    constructor($target, options = {}) {
        this.$target = $target;
        this.$overlayColor = (options.hasOwnProperty('overlayColor')) ? options.overlayColor : '#000000';
        this.$message = (options.hasOwnProperty('message')) ? options.message : 'لطفا کمی صبر کنید...';
        this.$state = (options.hasOwnProperty('state')) ? options.state : 'danger';
        this.$opacity = (options.hasOwnProperty('opacity')) ? options.opacity : 0.3;
        this.$size = (options.hasOwnProperty('size')) ? options.size : 'sm';
    }

    message(message) {
        this.$message = message;
        return this;
    }

    fire() {
        KTApp.block(this.$target, {
            overlayColor: this.$overlayColor,
            state: this.$state,
            size: this.$size,
            opacity: this.$opacity,
            message: this.$message,
        });
    }

    down() {
        KTApp.unblock(this.$target);
    }
}

function delay() {
    return new Delay();
}

function loader(target, options = {}) {
    return new Loader(target, options);
}

function dd(...data) {
    console.log(data);
    throw ('Exit program ....');
}

function down(message = null) {
    throw ((!Services.isEmpty(message)) ? message : 'The operation of the program stopped unexpectedly ...!');
}

window.customFunctions = {
    init: function () {
        this.id();
        this.serializeObject();
        this.addProperty();
        this.preventDoubleSubmission();
        this.preventEnterKeySubmission();
        this.disableSubmitButton();
        this.enableSubmitButton();
    },

    serializeObject: function () {
        $.fn.serializeObject = function () {
            const o = {};
            const a = this.serializeArray();
            $.each(a, function () {
                if (o[this.name] !== undefined) {
                    if (!o[this.name].push) {
                        o[this.name] = [o[this.name]];
                    }
                    o[this.name].push(this.value || '');
                } else {
                    o[this.name] = this.value || '';
                }
            });
            return o;
        }
    },

    addProperty: function () {
        $.fn.addProperty = function (properties) {
            const $object = {...this}[0];
            Object.assign($object, properties);
            return $object;
        }
    },

    id: function () {
        $.fn.id = function () {
            return this.attr('id');
        }
    },

    preventDoubleSubmission: function () {
        $.fn.preventDoubleSubmission = function (exception = false) {
            const $form = this;
            $form.on('submit', function (e) {
                if ($form.data('submitted') === true) {
                    e.preventDefault();
                    throw new Error('The action taken is unauthorized.');
                } else {
                    $form.attr('data-submitted', true);
                }
            });
            return this;
        }
    },

    preventEnterKeySubmission: function () {
        $.fn.preventEnterKeySubmission = function () {
            const $form = $(this);
            $form.on('keydown', function (e) {
                if (e.keyCode === 13 || e.key === 'Enter') {
                    e.preventDefault();
                    throw new Error('The action taken is unauthorized.');
                }
            });
            return this;
        }
    },

    disableSubmitButton: function () {
        $.fn.disableSubmitButton = function () {
            const $form = this;
            $form.find('button[type="submit"]').prop('disabled', true);
            $(document).find('button[form=' + $form.id() + ']').prop('disabled', true);
        }
    },

    enableSubmitButton: function () {
        $.fn.enableSubmitButton = function () {
            const $form = this;
            $form.find('button[type="submit"]').prop('disabled', false);
            $(document).find('button[form=' + $form.id() + ']').prop('disabled', false);
        }
    },
}

window.notification = {
    options: function (event, timer, message, preventDuplicates = true, positionClass = 'toast-top-right', closeButton = false) {
        toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": true,
            "progressBar": true,
            "positionClass": 'toast-top-right',
            "preventDuplicates": true,
            "onclick": null,
            "showDuration": "400",
            "hideDuration": "5000",
            "timeOut": timer + "000",
            "extendedTimeOut": "2500",
            "showEasing": "swing",
            "hideEasing": "swing",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };
        if (event === 'error') {
            return toastr.error("<b class='fof-14'>" + message + "</b>");
        } else if (event === 'info') {
            return toastr.info("<b class='fof-14'>" + message + "</b>");
        } else if (event === 'warning') {
            return toastr.warning("<b class='fof-14'>" + message + "</b>");
        } else if (event === 'success') {
            return toastr.success("<b class='fof-14'>" + message + "</b>");
        } else {
            return false;
        }
    }
};

window.actionHandler = {
    init: function () {
        this.onReady();
        this.clickEvent.adminDelete();
    },

    onReady: function () {

    },

    clickEvent: {
        adminDelete: function () {
            const $elem_class = 'delete-admin';
            const $elem = $(document).find('.'.concat($elem_class));
            $elem.on('click', function () {
                let item_id = $(this).data('delete');
                let text = "مدیریت قابل بازگشت نیست";
                let icon = "warning";
                let target = "deleteAdmin";
                sweetAlert(item_id, text, icon, target);
            });
        }
    },
}

if (typeof module !== 'undefined' && typeof module.exports !== 'undefined') {
    window.RegistererOnLoadCallback = RegistererOnLoadCallback;
}
if (typeof module !== 'undefined' && typeof module.exports !== 'undefined') {
    window.RegistererProviderCallback = RegistererProviderCallback;
}

function sweetAlert(id, text, icon, target, confirmText = "بله اطمینان دارم", confirmColor = '#d31', cancelText = "خیر", cancelColor = 'rgb(48, 133, 214)', outside = false) {
    Swal.fire({
        title: "آیا اطمینان دارید؟",
        text: text,
        icon: icon,
        showCancelButton: true,
        confirmButtonText: confirmText,
        cancelButtonText: cancelText,
        reverseButtons: true,
        allowOutsideClick: outside,
    }).then(function (result) {
        if (result.value) {
            $('#' + target + id).submit();
        }
    });
}

$(function () {
    RegistererProviderCallback.booting(function () {
        customFunctions.init();
        actionHandler.init();
        RegistererOnLoadCallback.booting(Services.initPageLoader);
    });

    Services.bootApp();
});
