<?php
session_start();

if($_SESSION['verified'])
{
    $empID = $_POST['carList'];
    deleteEmp($empID);
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

function deleteEmp($carID) {
    $db = dbConnect();
    $sql = "DELETE FROM Employees WHERE empid = :empID";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(":empID", $empID, PDO::PARAM_INT);
    if ($stmt->execute())
    {
        header("Location: empcar.php");
    }
    else
    {
        echo "Deletion Failed";
    }
  }
  

?>