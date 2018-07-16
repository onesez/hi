function XVue(opts) {
    default_opts = {
        el: '#app',
        delimiters: ['${', '}'],
        methods: {
            redirectAction: function (href) {
                if (!/^http.+/.test(href)) {
                    if (-1 !== href.indexOf('?')) {
                        href = href + '&ts=' + ts();
                    } else {
                        href = href + '?ts=' + ts();
                    }
                }
                location.href = href;
            },
            backAction: function (href) {
                if (undefined == href) {
                    window.history.back();
                    return;
                }
                if (!/^http.+/.test(href)) {
                    if (-1 !== href.indexOf('?')) {
                        href = href + '&ts=' + ts();
                    } else {
                        href = href + '?ts=' + ts();
                    }
                }
                location.href = href;
            }
        }
    };
    opts.el = default_opts.el;
    opts.delimiters = default_opts.delimiters;
    opts.data.sync_submit = false;

    if (undefined !== opts.methods) {
        $.each(default_opts.methods, function (i, item) {
            opts.methods[i] = item;
        })
    } else {
        opts.methods = default_opts.methods;
    }
    return new Vue(opts);
}

getQueryValue = function (name) {
    url = location.href;
    name = name.replace(/[\[\]]/g, "\\$&");
    var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
        results = regex.exec(url);
    if (!results) {
        if (name == 'id') {
            return location.pathname.replace(/\/$/, '').split('/').reverse().shift();
        }
        return null;
    }
    if (!results[2]) {
        return '';
    }
    return decodeURIComponent(results[2].replace(/\+/g, " "));

}

ts = function () {
    return new Date().getTime();
};

(function ($) {
    $.fn.isShow = function () {
        top = this.offset().top;
        height = this.offset().height;
        window_top = $(window).scrollTop();
        window_height = $(window).height();
        return window_top < top && top < window_top + window_height;

    }

    $.authSubmit = function (target, callback) {
        if (typeof target == 'string') {
            target = $(target);
        }
        url = target.attr('action');
        method = target.attr('method');
        data = target.serialize();
        if (method && method.toLowerCase() == 'get') {
            $.authGet(url, data, callback);
        } else {
            $.authPost(url, data, callback);
        }
    }

    $.authGet = function (url, data, callback) {
        req_data = {};
        if ($.isFunction(data)) {
            callback = data;
        } else {
            req_data = data;
        }
        if (!/^http.+/.test(url)) {
            if (url.indexOf('?') < 0) {
                url += "?";
                url += 'ts=' + ts();
            } else {
                url += '&ts=' + ts();
            }
        }
        $.get(url, req_data, function (resp_data, status, xhr) {

            if (resp_data.error_code < 0 && -1001 != resp_data.error_code) {

                if (resp_data.error_url) {

                    location.href = resp_data.error_url;
                    return;
                } else if (resp_data.redirect_url) {
                    location.href = resp_data.redirect_url;
                    return;
                }
            }
            if (callback) {
                callback.call(this, resp_data, status, xhr);
            }
        });
    };
    $.authPost = function (url, data, callback) {
        if ($.isFunction(data)) {
            req_data = {};
            callback = data;
        } else {
            req_data = data;
        }

        $.post(url, req_data, function (resp_data, status, xhr) {
            if (resp_data.error_code < 0 && -1001 != resp_data.error_code) {
                if (resp_data.error_url) {
                    location.href = resp_data.error_url;
                    return;
                } else if (resp_data.redirect_url) {
                    location.href = resp_data.redirect_url;
                    return;
                }
            }

            if (callback) {
                callback.call(this, resp_data, status, xhr);

            }
        });

    };
    $.isMobile = function (mobile) {
        if (undefined == mobile) {
            return false;
        }

        return /^1[34578]{1}\d{9}$/.test(mobile) ? true : false;
    };
    $.isWeixinClient = function () {
        var ua = navigator.userAgent;

        if (ua.indexOf('MicroMessenger/') < 0) {
            return false;
        }

        return true;
    };
    $.getWeixinVersion = function () {
        var ua = navigator.userAgent;
        if (ua.indexOf('MicroMessenger/') < 0) {
            return 0;
        }

        var temp = ua.split('MicroMessenger/');

        var weixin_info = temp[1].split(' ');
        var weixin_version = weixin_info[0];
        return weixin_version;
    }

    $.isWeiboClient = function () {
        var ua = navigator.userAgent;
        if (ua.indexOf('Weibo') < 0) {
            return false;
        }

        return true;
    };

    $.isQqClient = function () {
        var ua = navigator.userAgent;
        if (ua.indexOf('QQ/') < 0) {
            return false;
        }

        return true;
    };

    $.isIos = function () {
        var ua = navigator.userAgent.toLocaleLowerCase();
        var is_ios = (ua.indexOf('iphone') != -1) || (ua.indexOf('ipad') != -1);
        return is_ios;
    }
})(jQuery);



