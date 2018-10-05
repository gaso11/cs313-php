<?php

session_start();
    
$name = $_POST['name'];
$price = $_POST['price'];

$item = array($name=>$price);

$cart = $_SESSION["cart"];
array_push($cart, $item);
$_SESSION["cart"] = $cart;
    
?>