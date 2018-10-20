$(document).ready(function() {
    $('form').submit(function(event) {
        var data = document.getElementById("search").val();
        
        
        $.ajax({
            type : 'POST',
            url  : 'search.php',
            data : {
                search: data
            },
            success: function(result) {
                console.log(result);
            }
            
        })
        
        event.preventDefault();
        
    });
});