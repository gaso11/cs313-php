var express = require("express");
var app = express();

app.use(express.static("public"));
app.set("views", "views");
app.set("view engine", "ejs");

app.get("/", function(req, res) {
    console.log("Recieved request for root");
    
    res.write("This is the root");
    res.end();
});

app.get("/home", function(req, res) {
    console.log("Recieved request for home page");
    var name = getCurrentUser();
    var emailAdr = "john@email.com";
    
    var params = {username: name};
    res.render("home", params);
})

app.listen(5000, function(req, res) {
    console.log("The server is running on port 5000");
});

function getCurrentUser() {
    return "Evan";
}