<?php

session_start();
error_reporting(0);

/* First time */
if ($_SESSION["cart"] == null)
{
    $_SESSION["cart"] = array();
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Surplus Blitz</title>
    <link rel="stylesheet" href="browse.css" type="text/css">
</head>
    
<body>
    <!--Heading-->
    <div class="header">
        <h1>Surplus Blitz</h1>
        <h3>Buy items as they come in for great prices!<br> 
            Our store is always updating!</h3>
        <button type="button"><a href="cart.php">Go to Cart</a></button><br><br>
    </div>
    
    <!--Browse-->
    <div class="main">
        <div class="item">
            <img src="pplayer.jpg" alt="Philips Player">
            
            <div class="itemText">
                <p>Philips Player - $50</p>
                <div class="popup">
                    <span class="popuptext" id="myPopup1">Added to cart!</span>
                </div>
                <button type="button" id="item1" data-name="Philips Player" data-price="50"
                        onclick="item1Add()">Add to Cart</button>
            </div>
        </div>
        <br>
        <div class="item">
            <img src="4ktv.jpg" alt="Samsung 32 4K TV">
            
            <div class="itemText">
                <p>Samsung 32" 4K TV - $150</p>
                <div class="popup">
                    <span class="popuptext" id="myPopup2">Added to cart!</span>
                </div>
                <button type="button" id="item2" data-name="Samsung 32 4K TV" data-price="150"
                        onclick="item2Add()">Add to Cart</button>
            </div>
        </div>
        <br>
        <div class="item">
            <img src="fridge.jpg" alt="Fridge">
            
            <div class="itemText">
                <p>FrigidAire Fridge - $200</p>
                <div class="popup">
                    <span class="popuptext" id="myPopup3">Added to cart!</span>
                </div>
                <button type="button" id="item3" data-name="FrigidAire Fridge" data-price="200"
                        onclick="item3Add()">Add to Cart</button>
            </div>
        </div>
    </div>
    
<script src="jquery.js"></script>
<script src="browse.js"></script>
    
</body>
</html>