<?php
session_start();

if($_SESSION['verified'])
{
    $cars = getCarsDB();
}
else
{
    header("Location: carRentalBrowse.php");
}

function dbConnect(){
    try {
      $url = getenv('DATABASE_URL');
      $opts = parse_url($url);
      $server = $opts["host"];
      $database = ltrim($opts["path"],'/');
      $user = $opts["user"];
      $password = $opts["pass"];
      $port = $opts["port"];
      $dsn = "pgsql:host=$server; port=$port;dbname=$database";
      $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
      $link = new PDO($dsn, $user, $password, $options);
      return $link;
    }
    catch (PDOException $ex) {
      echo $ex;
      exit;
    }
  }

function getCarsDB() {
    $db = dbConnect();
    $sql = "SELECT * FROM Cars";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_NAMED);
    $stmt->closeCursor();
    return $data;
  }
?>

<html>
<head>
    <title>Car Rental Service</title>
    <link rel="stylesheet" href="empcar.css" type="text/css">
</head>
<!--Header from https://codepen.io/linux/pen/aEQKWP -->
<header>
    <div class="header">
        <h1>Remove a Car</h1><br>
    </div>
</header>
<body>

<?php
    
/* Make list of cars to remove */
echo "<form>";
echo "<select name=\"carList\" id=\"carList\">";
foreach($cars as $car) 
{
    echo "<option value=\"" . $car['carid'] . "\">" . $car['carid'] . " - "
        . $car['make'] . " " . $car['model'] . "</option>";
}
echo "<input class=\"button\" type=\"submit\" value=\"Delete\">";
echo "</form>";

?>
</body>