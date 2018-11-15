//Get filesystem module
var fs = require('fs');

var buf = fs.readFileSync(process.argv[2]);

var str = buf.toString();

var tmp = str.split('\n');

console.log(tmp.length - 1);
