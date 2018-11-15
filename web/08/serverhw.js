var http = require('http');
var fs = require('fs');
var jsonData = {"name":"Br. Burton","class":"cs313"};

/* Function found at https://stackoverflow.com/questions/901115/how-can-i-get-query-string-values-in-javascript */
function getParameterByName(name, url) {
    if (!url) url = window.location.href;
    name = name.replace(/[\[\]]/g, '\\$&');
    var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
        results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, ' '));
}

function onRequest(req, res) {
    console.log("Recieved a request for: " + req.url);
    
    if (req.url == "/home"){
        res.writeHead(200, {"Content-Type": "text/html"});
        res.write("<h1>Welcome to the Home Page</h1>");
        res.end();
    }
    else if (req.url == "/getData"){
        fs.writeFileSync('output.json', JSON.stringify(jsonData));
        res.writeHead(200, {"Content-Type": "text/html"});
        res.write("<h1>JSON data has been written</h1>");
        res.end();
    }
    else if (req.url.split('?')[0] == "/getName") {
        /* I'm not sure how to check for a fail condition,
        so don't put garbage in the query string */
        var first = getParameterByName('first', req.url);
        var last = getParameterByName('last', req.url);

        res.writeHead(200, {"Content-Type": "text/html"});
        res.write("<h1>Your name is ");
        res.write(first);
        res.write(" ");
        res.write(last);
        res.end();
    }
    else {
        console.log(res.url);
        res.writeHead(404, {"Content-Type": "text/html"});
        res.write("<h1>Error 404: Page Not Found</h1>");
        res.end();
    }
        
}

var server = http.createServer(onRequest);
server.listen(8888);

console.log("The server is now listening on port 8888...");