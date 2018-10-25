<?php
session_start();

if($_SESSION['verified'])
{
    $carID = $_POST['carid'];
    echo $carID . " ";
    deleteCar($carID);
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

function deleteCar($carID) {
    $db = dbConnect();
    $sql = "DELETE FROM Cars WHERE carid = :carID";
    $stmt = $db->prepare($sql);
    echo $carID . " ";
    $stmt->bindValue(":carID", $carID, PDO::PARAM_INT);
    echo $carID . " ";
    /*
    if ($stmt->execute())
    {
        header("Location: empcar.php");
    }
    else
    {
        echo "Insert Failed";
    }*/
  }
  

?>