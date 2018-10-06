<head>
    <title>Thank you!</title>
    <link rel="stylesheet" href="browse.css" type="text/css">
</head>

<?php
session_start();

$cart = $_SESSION["cart"];

//W3 PHP Form Validation
$addrNum = $stName = $city = $state = $zip = "";
    
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $addrNum = test_input($_POST["addrNum"]);
    $stName = test_input($_POST["stName"]);
    $city = test_input($_POST["city"]);
    $state = test_input($_POST["state"]);
    $zip = test_input($_POST["zip"]);
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

?>

<html>
<body>

<?php
/* Seperate php sections just in case */
echo "<br>";
echo "<div class=\"cart\">";
echo "<h1>Thank you for your purchase of:</h1>";
for ($x = 0; $x < sizeof($cart); $x++)
{
    foreach ($cart[$x] as $key => $value) {
        echo "<p>";
        echo "$key - $$value<br>";
        echo "</p>";
    }
}

echo "<br><h3>Shipping to:</h3>";
echo "<p>$addrNum $stName<br>";
echo "$city, $state $zip</p>";
    
/* Clear cart for further shopping */
/* This will cause the back arrow to show errors which can be easily fixed, like I did on browse.php ln 4 */
session_unset();

echo "<p>";
echo "<button type=\"button\"><a href=\"browse.php\">Back to Shopping</a></button><br><br>";
echo "</p>";
echo "</div>";
    
?>

</body>
</html>