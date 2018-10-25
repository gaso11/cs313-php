<?php
session_start();

if($_SESSION['verified'])
{
    $make = $_POST["make"];
    $model = $_POST["model"];
    $mileage = (int)$_POST["mileage"];
    $cost = (int)$_POST["cost"];
    $rentalstatus = $_POST["rentalstatus"];
    $repairstatus = $_POST["repairstatus"];
    $car = addCar();
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

function addCar() {
    $db = dbConnect();
    $sql = "INSERT INTO Cars 
            (Cost, Mileage, Make, Model, RentalStatus, RepairStatus) VALUES
            ('%$cost%', '%$mileage%', '%$make%', '%$model%', '%$rentalstatus%', '%$repairstatus%')";
    $stmt = $db->prepare($sql);
    if ($stmt->execute())
    {
        header("Location: empcar.php");
    }
    else
    {
        echo "Insert Failed";
    }
    
  }
  



?>