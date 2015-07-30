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
                    if (res.code === 0) {
                        next.resolve(res);
                    } else {
                        next.reject(res.message);
                    }
                },
                error: function () {
                    next.reject('请求失败');
                }
            });
        }
        ,addAlgorithm:function() { var promise = $.Deferred(), isPassed = true;isPassed = this._checkArg("username",arguments[0], promise);isPassed = this._checkArg("displayName",arguments[0], promise);if (isPassed) {this._doAjax({url:"/api/algorithm/add.do",methodType:"post",data:arguments[0]}, promise);}return promise;},checkLogin:function() { var promise = $.Deferred(), isPassed = true;if (isPassed) {this._doAjax({url:"/api/user/isLogin.do",methodType:"post",data:arguments[0]}, promise);}return promise;},applyResearch:function() { var promise = $.Deferred(), isPassed = true;if (isPassed) {this._doAjax({url:"/api/user/updateProfile.do",methodType:"post",data:arguments[0]}, promise);}return promise;}
    }
};
