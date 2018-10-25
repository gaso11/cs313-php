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
        <h1>Add a Car</h1><br>
    </div>
</header>
<body>
    
    <br><h3>Enter the details for the car</h3>
    <div class="addform">
    <form action="addq.php" method="POST">
        <input type="text", name="make", placeholder="Make">
        <input type="text", name="model", placeholder="Model"><br>
        <input type="number", name="mileage", placeholder="Mileage">
        <input type="number", name="cost", placeholder="Cost"><br>
        <input type="text", name="rentalstatus", placeholder="rentalstatus">
        <input type="text", name="repairstatus", placeholder="repairstatus"><br>
    </form>
    </div>
</body>
</html>