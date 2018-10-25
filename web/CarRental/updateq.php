<?php
session_start();

if($_SESSION['verified'])
{
    $carID = $_POST['carList'];
    $make = filter_var($_POST["make"]);
    $model = filter_var($_POST["model"]);
    $mileage = filter_var($_POST["mileage"]);
    $cost = filter_var($_POST["cost"]);
    $rentalstatus = filter_var($_POST["rentalstatus"]);
    $repairstatus = filter_var($_POST["repairstatus"]);
    $renterfirst = $_POST['renterfirstname'];
    $renterlast = $_POST['renterlastname'];
    
    updateCars($carID, $make, $model, $mileage, $cost, $rentalstatus,
               $repairstatus, $renterfirst, $renterlast);
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

function fixNull($col, $db)
{
    $lookup = "SELECT * FROM Cars WHERE carID = :carID";
    $stmt = $db->prepare($lookup);
    $stmt->bindValue(":carID", $carID, PDO::PARAM_INT);
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_NAMED);
    $stmt->closeCursor();
    return $data[$col];
}

function updateCars($carID, $make, $model, $mileage, $cost, $rentalstatus,
                    $repairstatus, $renterfirst, $renterlast) {
    $db = dbConnect();
    
    /* Check for NULL values */
    if ($make == "")
    {
        $make = fixNull('make', $db);
    } 
    else if ($model == "") 
    {
        $model = fixNull('model', $db);
    }
    else if ($mileage == "")
    {
        $mileage = fixNull('mileage', $db);
    }
    else if ($cost == "")
    {
        $cost = fixNull('cost', $db);
    } 
    else if ($rentalstatus == "")
    {
        $rentalstatus = fixNull('rentalstatus', $db);
    } 
    else if ($repairstatus == "") 
    {
        $repairstatus = fixNull('repairstatus', $db);
    } 
    else if ($renterfirst == "")
    {
        $renterfirst = fixNull('renterfirst', $db);
        if !(renterfirst == "")
            $firstString = "renterfirstname = :renterfirstname";
        else
            $firstString = " ";
    }   
    else if ($renterlast = "")
    {
        $renterlast = fixNull('renterlast', $db);
        if !(renterlast == "")
            $lastString = "renterlastname = :renterlastname";
        else
            $lastString = " ";
    }
    
    
    $sql = "UPDATE Cars SET
            cost = :cost,
            mileage = :mileage,
            make = :make,
            model = :model,
            rentalstatus = :rentalstatus,
            repairstatus = :repairstatus,"
            . $firstString . "," . $lastString . "
            WHERE carid = :carID";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(":cost", $cost, PDO::PARAM_INT);
    $stmt->bindValue(":mileage", $mileage, PDO::PARAM_INT);
    $stmt->bindValue(":make", $make, PDO::PARAM_STR);
    $stmt->bindValue(":model", $model, PDO::PARAM_STR);
    $stmt->bindValue(":rentalstatus", $rentalstatus, PDO::PARAM_STR);
    $stmt->bindValue(":repairstatus", $repairstatus, PDO::PARAM_STR);
    $stmt->bindValue(":renterfirst", $renterfirst, PDO::PARAM_STR);
    $stmt->bindValue(":renterlast", $renterlast, PDO::PARAM_STR);
    if ($stmt->execute())
    {
        header("Location: empcar.php");
    }
    else
    {
        echo "Update Failed";
    }
    
  }
  

?>