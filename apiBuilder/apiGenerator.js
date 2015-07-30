var fs = require('fs'),
    path = require('path'),
    yaml = require('js-yaml'),
    configFile = path.join(__dirname, 'api.yml'),
    inputFile = path.join(__dirname, 'api.js'),
    outputFile = path.join(__dirname, '../static/js/api.js'),
    encoding = {
        encoding: 'utf8'
    },
    result = [],
    originData = yaml.safeLoad(fs.readFileSync(configFile, encoding));

originData.api.forEach(function (api) {
    result.push(',');
    result.push(api.name);
    result.push(':');
    result.push(makeMethod(api));
});

fs.writeFileSync(outputFile, fs.readFileSync(inputFile, encoding).replace('/* API PLACEHOLDER */', result.join('')), encoding);

function makeMethod(api) {
    var res = 'function() { var promise = $.Deferred(), isPassed = true;';

    api.args && api.args.forEach(function (arg) {
        res += 'isPassed = this._checkArg("' + arg + '",' + 'arguments[0], promise);';
    });

    res += 'if (isPassed) {' +
                'this._doAjax({' +
                    'url:"/api/' + api.url + '",' +
                    'methodType:"' + (api.type.toLowerCase() === 'get' ? 'get' : 'post') + '",' +
                    'data:arguments[0]' +
                '}, promise);' +
            '}' +
        'return promise;';

    return res + '}';
}

console.log('Generate api successfully!');
