/* Shows values of button */
function item1Add() {
    var button = document.getElementById("item1");
    addToCart(button);
    var popup = document.getElementById("myPopup1");
    popup.classList.toggle("show");
    setTimeout(function() {
    popup.classList.toggle("show");
    }, 1000);
    
}

function item2Add() {
    var button = document.getElementById("item2");
    addToCart(button);
    var popup = document.getElementById("myPopup2");
    popup.classList.toggle("show");
    setTimeout(function() {
    popup.classList.toggle("show");
    }, 1000);
}

function item3Add() {
    var button = document.getElementById("item3");
    addToCart(button);
    var popup = document.getElementById("myPopup3");
    popup.classList.toggle("show");
    setTimeout(function() {
    popup.classList.toggle("show");
    }, 1000);
}

function addToCart(button) {
    var name = button.getAttribute('data-name');
    var price = button.getAttribute('data-price');
    
    $.ajax({
        type: "POST",
        url: "update.php",
        data: {
            name: name,
            price: price
        },
        success: function(result) {
            return;
        }
    });
}

function removeItem(name) {
    
    $.ajax({
        type: "POST",
        url: "remove.php",
        data: {
            name: name,
        },
        success: function(result) {
            location.reload();
            return;
        }
    });
}