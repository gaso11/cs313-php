<?php
session_start();

if($_SESSION['verified'])
{
    $make = filter_var($_POST["make"]);
    $model = filter_var($_POST["model"], FILTER_SANITIZER_STRING);
    $mileage = filter_var($_POST["mileage"], FILTER_SANITIZE_NUMBER_INT);
    $cost = filter_var($_POST["cost"], FILTER_SANITIZE_NUMBER_INT);
    $rentalstatus = filter_var($_POST["rentalstatus"], FILTER_SANITIZER_STRING);
    $repairstatus = filter_var($_POST["repairstatus"], FILTER_SANITIZER_STRING);
    echo "Make is: " . $make . "\n";
    echo "Model is: " . $model . "\n";
    echo "Mileage is: " . $mileage . "\n";
    echo "Cost is: " . $cost . "\n";
    echo "Rental Status is: " . $rentatlstatus . "\n";
    echo "Repair Status is: " . $repairstatus . "\n";
    echo var_dump($_POST);
    //$added = addCar($make, $model, $mileage, $cost, $rentalstatus, $repairstatus);
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

function addCar($make, $model, $mileage, $cost, $rentalstatus, $repairstatus) {
    $db = dbConnect();
    $sql = "INSERT INTO Cars (Cost, Mileage, Make, Model, RentalStatus, RepairStatus)
            VALUES (:cost, :mileage, :make, :model, :rentalstatus, :repairstatus)";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(":cost", $cost, PDO::PARAM_INT);
    $stmt->bindValue(":mileage", $mileage, PDO::PARAM_INT);
    $stmt->bindValue(":make", $make, PDO::PARAM_STR);
    $stmt->bindValue(":model", $model, PDO::PARAM_STR);
    $stmt->bindValue(":rentalstatus", $rentalstatus, PDO::PARAM_STR);
    $stmt->bindValue(":repairstatus", $repairstatus, PDO::PARAM_STR);
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