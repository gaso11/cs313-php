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

//These don't really need to be in here, but I'll leave it just in case
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
    
    <br><h3 class="addform">Enter the details for the car</h3>
    <div class="addform">
    <form action="addq.php" method="POST">
        <label for="make">Make:</label>
        <input type="text", name="make", id="make"><br>
        <label for="model">Model:</label>
        <input type="text", name="model", id="model"><br>
        <label for="mileage">Mileage:</label>
        <input type="number", name="mileage", id="mileage"><br>
        <label for="cost">Cost:</label>
        <input type="number", name="cost", id="cost"><br>
        <label for="rentalstatus">Rental Status:</label>
        <select name="rentalstatus" id="rentalstatus">
            <option value="Open">Open</option>
            <option value="Closed">Closed</option>
        </select><br>
        <label for="repairstatus">Repair Status:</label>
        <select name="repairstatus" id="repairstatus">
            <option value="Okay">Okay</option>
            <option value="In Shop">In Shop</option>
            <option value="Needs Repair">Needs Repair</option>
        </select><br><br>
        <input class="button" type="submit" name="submit" value="Add">
    </form>
    </div>
</body>
</html>