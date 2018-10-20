$(document).ready(function() {
    $('form').submit(function(event) {
        var contents = $('#contents');
        console.log(contents);
        
        
        $.ajax({
            type : 'POST',
            url  : 'search.php',
            data : contents,
            
        })
        
        .done(function(data){
            console.log(contents);
        });
        
        event.preventDefault();
        
    });
});