<?php
session_start();

$cars = getCarsDB();
$carid = $_SESSION['carid'];
    
foreach ($cars as $car)
{
    if ($car['carid'] == $carid)
    {
        $newRental = "Closed";
        $newfirst = $_POST['firstname'];
        $newlast = $_POST['lastname'];
        if ($newfirst or $newlast == null)
        {
            echo "<h1>First and last name are required</h1>";
            echo "<h1>$newfirst $newlast<h1>";
            return;
        }
        
        $newMake = $car['make'];
        $newModel = $car['model'];
        $newMileage = $car['mileage'];
        $newCost = $car['cost'];
        $newRepair = $car['repairstatus'];
            
        editCar($carid, $newCost, $newMileage, $newRental, $newRepair, $newfirst, $newlast);
        return;
        
    }
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

function editCar($carid, $newCost, $newMileage, $newRental, $newRepair, $newfirst, $newlast) {
    $db = dbConnect();
    $sql = "UPDATE Cars
            SET mileage = :mileage,
                cost = :cost,
                rentalstatus = :rentalstatus,
                repairstatus = :repairstatus,
                renterfirstname = :first,
                renterlastname = :last
            WHERE carid = :carid";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(":carid", $carid, PDO::PARAM_INT);
    $stmt->bindValue(":cost", $newCost, PDO::PARAM_INT);
    $stmt->bindValue(":mileage", $newMileage, PDO::PARAM_INT);
    $stmt->bindValue(":rentalstatus", $newRental, PDO::PARAM_STR);
    $stmt->bindValue(":repairstatus", $newRepair, PDO::PARAM_STR);
    $stmt->bindValue(":first", $newfirst, PDO::PARAM_STR);
    $stmt->bindValue(":last", $newlast, PDO::PARAM_STR);
    if ($stmt->execute())
    {
        header("Location: carRentalBrowse.php");
    }
    else
    {
        echo "Edit Failed";
    }
}

?>