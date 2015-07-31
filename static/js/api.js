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
        ,loginAdmin:function() { var promise = $.Deferred(), isPassed = true;isPassed = this._checkArg("name",arguments[0], promise);isPassed = this._checkArg("pwd",arguments[0], promise);if (isPassed) {this._doAjax({url:"admin_api/login",methodType:"post",data:arguments[0]}, promise);}return promise;},logoutAdmin:function() { var promise = $.Deferred(), isPassed = true;if (isPassed) {this._doAjax({url:"admin_api/logout",methodType:"get",data:arguments[0]}, promise);}return promise;},createAdmin:function() { var promise = $.Deferred(), isPassed = true;isPassed = this._checkArg("name",arguments[0], promise);isPassed = this._checkArg("nickname",arguments[0], promise);isPassed = this._checkArg("pwd",arguments[0], promise);if (isPassed) {this._doAjax({url:"admin_api/create",methodType:"post",data:arguments[0]}, promise);}return promise;},editAdmin:function() { var promise = $.Deferred(), isPassed = true;isPassed = this._checkArg("nickname",arguments[0], promise);if (isPassed) {this._doAjax({url:"admin_api/edit",methodType:"post",data:arguments[0]}, promise);}return promise;},removeAdmin:function() { var promise = $.Deferred(), isPassed = true;isPassed = this._checkArg("name",arguments[0], promise);if (isPassed) {this._doAjax({url:"admin_api/remove",methodType:"post",data:arguments[0]}, promise);}return promise;}
    }
};
