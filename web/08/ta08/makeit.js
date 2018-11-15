var path = require('path');
var module = require('./module');
var dir = process.argv[2];
var filter = process.argv[3];

var callback = function (err, list) {
    list.forEach(function (file) {
        console.log(file);
    })
}

module(dir, filter, callback);