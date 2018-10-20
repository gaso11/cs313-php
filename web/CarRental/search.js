$(document).ready(function() {
    $('form').submit(function(event) {
        var data = document.getElementById("search");
        console.log(data);
        
        
        $.ajax({
            type : 'POST',
            url  : 'search.php',
            data : "Ford",
            
        })
        
        .done(function(data){
            console.log(data);
        });
        
        event.preventDefault();
        
    });
});