var api = require('js-api-generator');

api({
    target: './api.yml',
    browserify: 'api',
    outputFile: '../static/js/api.js'
})

console.log('Generate api successfully!');
