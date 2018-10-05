<?php

session_start();

$name = $_POST['name'];

$cart = $_SESSION["cart"];

unset($cart[$name]);

$cart = array_values($cart);

$_SESSION["cart"] = $cart;

?>