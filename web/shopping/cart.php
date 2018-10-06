<head>
    <title>Surplus Blitz Cart</title>
    <link rel="stylesheet" href="browse.css" type="text/css">
</head>
    
<?php
session_start();

$cart = $_SESSION["cart"];

/* DISPLAY */
echo "<br>";
echo "<div class=\"cart\">";
echo "<h1>";
echo "You have selected the following items:";
echo "</h1>";

for ($x = 0; $x < sizeof($cart); $x++)
{
    foreach ($cart[$x] as $key => $value) {
        $jsonKey = htmlspecialchars(json_encode($key));
        $jsonvalue = htmlspecialchars(json_encode($value));
        echo "<p onclick=\"removeItem($x)\">";
        echo "$key - $$value<br>";
        echo "</p>";
    }
}

echo "<h3>";
echo "Click an item to remove it from the list";
echo "</h3>";

echo "<p>";
echo "<button type=\"button\"><a href=\"browse.php\">Back to Shopping</a></button><br><br>";
echo "<button type=\"button\"><a href=\"checkout.php\">Go to checkout</a></button><br><br>";
echo "</p>";
echo "</div>";

?>

<script src="jquery.js"></script>
<script src="browse.js"></script>