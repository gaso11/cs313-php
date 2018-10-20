$(document).ready(function() {
    $('form').submit(function(event) {
        var formData = document.getElementById(search);
        console.log(formData);
        
        
        $.ajax({
            type : 'GET',
            url  : 'search.php',
            data : formData,
            
        })
        
        .done(function(data){
            console.log(data);
        });
        
        event.preventDefault();
        
    });
});