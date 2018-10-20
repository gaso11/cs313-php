$(document).ready(function() {
    $('form').submit(function(event) {
        var formData = { 'search' : $('input[search=search]').val() };
        
        
        $.ajax({
            type : 'POST',
            url : 'search.php',
            data : formData,
            
        })
        
        .done(function(data){
            console.log(data);
        });
        
        event.preventDefault();
        
    });
});