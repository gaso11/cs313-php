<head>
    <title>Surplus Blitz Checkout</title>
    <link rel="stylesheet" href="browse.css" type="text/css">
</head>

<html>
<body>

<?php
session_start();

$cart = $_SESSION["cart"];
$total = 0;

/* DISPLAY */

echo "<h1>";
echo "You have selected the following items:";
echo "</h1>";

for ($x = 0; $x < sizeof($cart); $x++)
{
    foreach ($cart[$x] as $key => $value) {
        echo "<p>";
        echo "$key - $$value<br>";
        echo "</p>";
        $total += $value;
    }
}

echo "<h3>";
echo "Your total is: $$total";
echo "</h3>";
    
?>

<!-- W3 PHP Forms -->
<h2>Shipping Information:</h2>
<form method="post" action="confirm.php">
    Address Number: <input type="text" name="addrNum">
    <br><br>
    Street Name: <input type="text" name="stName">
    <br><br>
    City: <input type="text" name="city">
    <br><br>
    State: <input type="text" name="state" maxlength="2">
    <br><br>
    Zip code: <input type="text" name="zip" maxlength="5">
    <br><br>
    <input type="submit" name="submit" value="Confirm Purchase">
</form>
<h3>or</h3>
<div class="center">
    <button type="button"><a href="browse.php">Back to Shopping</a></button>
</div>

</body>
</html>