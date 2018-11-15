var net = require('net');
var port = process.argv[2] || 8000;

var date = new Date();
var month = zeroCheck(date.getUTCMonth() + 1);
var monthD = zeroCheck(date.getDate());
var hours = zeroCheck(date.getHours());
var minutes = zeroCheck(date.getMinutes());

function zeroCheck(moment) {
    return moment < 10 ? "0" + moment : moment;
}

var formattedDate = date.getFullYear() + "-" + month  + "-" + monthD 
                    + " " + hours + ":" + minutes ;

var server = net.createServer((socket) => {
    socket.write(formattedDate);
    socket.end("\n");
}).on('error', (err) => {
    throw err;
});

server.listen(port);
