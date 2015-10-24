var api = require('js-api-generator');

api({
    target: './api.yml',
    browserify: 'api',
    outputFile: '../static/js/api.js',
    lang: 'chinese'
})

console.log('Generate api successfully!');
