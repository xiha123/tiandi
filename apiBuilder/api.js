"use strict";

window._td = {
    api: {
        _checkArg: function (need, target, next) {
            if (target[need] === undefined || target[need].trim() === '') {
                next.reject('No required argument: "' + need + '"');
                return false;
            }
            target[need] = target[need].trim();
            return true;
        },
        _doAjax: function (config, next) {
            $.ajax({
                cache: false,
                data: config.data,
                dataType: 'json',
                type: config.methodType,
                context: window,
                url: config.url,
                timeout: 5000,
                success: function (res, status, xhr) {
                    if (res.status === true) {
                        next.resolve(res.data);
                    } else {
                        next.reject(res.error);
                    }
                },
                error: function () {
                    next.reject('请求失败');
                }
            });
        }
        /* API PLACEHOLDER */
    }
};