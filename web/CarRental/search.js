$(document).ready(function() {
    $('form').submit(function(event) {
        var formData = { 'search' : $('input[search=search]').val() };
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