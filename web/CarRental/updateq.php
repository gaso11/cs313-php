<?php
session_start();
if($_SESSION['verified'])
{
    $cars = getCarsDB();
    $carid = $_POST['carList'];
    
    foreach ($cars as $car)
    {
        if ($car['carid'] == $carid)
        {
            $newMake = $car['make'];
            $newModel = $car['model'];
            $newMileage = $car['mileage'];
            $newCost = $car['cost'];
            $newRental = $car['rentalstatus'];
            $newRepair = $car['repairstatus'];
            $newfirst = $car['renterfirstname'];
            $newlast = $car['renterlastname'];
            
            if ($_POST['mileage'] != "")
                $newMileage = $_POST['mileage'];
            if ($_POST['cost'] != "")
                $newCost = $_POST['cost'];
            if ($_POST['rentalstatus'] != "")
                $newRental = $_POST['rentalstatus'];
            if ($_POST['repairstatus'] != "")
                $newRepair = $_POST['repairstatus'];
            if ($_POST['renterfirstname'] != "")
                $newfirst = $_POST['renterfirstname'];
            if ($_POST['renterlastname'] != "")
                $newlast = $_POST['renterlastname'];
            
            /*
            echo "<p>Make: $newMake</p><br>";
            echo "<p>Model: $newModel</p><br>";
            echo "<p>Mileage: $newMileage</p><br>";
            echo "<p>Cost: $newCost</p><br>";
            echo "<p>Rental: $newRental</p><br>";
            echo "<p>Repair: $newRepair</p><br>";
            echo "<p>First: $newfirst</p><br>";
            echo "<p>Last: $newlast</p><br>";
            */
            
            editCar($carid, $newCost, $newMileage);
            return;
        }
    }
    
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

function editCar($carid, $newCost, $newMileage) {
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
        echo "CarID: $carid";
        echo "Mileage: $mileage";
        //header("Location: empcar.php");
    }
    else
    {
        echo "Edit Failed";
    }
}

?>