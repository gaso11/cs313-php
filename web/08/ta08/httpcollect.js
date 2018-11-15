var bl = require('bl');
var http = require('http');
var url = process.argv[2];

http.get(url, function(res){
    res.setEncoding("utf8");
    res.pipe(bl(function(err, data){
        if (err){
            console.log('error');
        }
        
        console.log(data.toString().length);
        console.log(data.toString());
    }))
})