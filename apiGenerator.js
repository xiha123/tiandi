var fs = require('fs'),
    path = require('path'),
    yaml = require('js-yaml'),
    encoding = {
    encoding: 'utf8'
},
result = [
    '"use strict";',
    'module.exports = {',
    '_doAjax: ',
    (function (config) {
        var promise = _rq.$.Deferred();

        _rq.$.ajax({
            cache: false,
            data: config.data,
            dataType: 'json',
            type: config.methodType,
            context: window,
            url: config.url,
            timeout: 5000,
            success: function (res, status, xhr) {
                if (res.code === 0) {
                    promise.resolve(res);
                } else {
                    promise.reject(res.message);
                }
            },
            error: function () {
                promise.reject('请求失败');
            }
        });

        return promise;
    }).toString(),
    ', _checkArg: ',
    (function (need, target) {
        if (target[need] === undefined || target[need].trim() === '') {
            throw new Error('No required argument: "' + need + '"');
        }
        target[need] = target[need].trim();
    }).toString(),
];

this.files.forEach(function (files) {
    files.src.forEach(function (file) {
        var originData = yaml.safeLoad(fs.readFileSync(file, encoding));

        originData.api.forEach(function (api) {
            result.push(',');
            result.push(api.name);
            result.push(':');
            result.push(makeMethod(api));
        });
    });

    result.push('};');
    fs.writeFileSync(files.target, result.join(''));
});

function makeMethod(api) {
    var res = 'function() {';

    api.args && api.args.forEach(function (arg) {
        res += 'this._checkArg("' + arg + '",' + 'arguments[0]);';
    });

    res += 'return this._doAjax({' +
        'url:"/api/' + api.url + '",' +
        'methodType:"' + (api.type.toLowerCase() === 'get' ? 'get' : 'post') + '",' +
        'data:arguments[0]' +
        '});';

    return res + '}';
}

console.log('Generate api successfully!');
