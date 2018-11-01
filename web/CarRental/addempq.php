<?php
session_start();

if($_SESSION['verified'])
{
    $username = filter_var($_POST["username"]);
    $password = filter_var($_POST["password"]);
    addEmp($username, $password);
}
else
{
    header("Location: empcar.php");
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

function addEmp($username, $password) {
    $hash = password_hash($password, PASSWORD_BCRYPT);
    $db = dbConnect();
    $sql = "INSERT INTO Employees (username, password) VALUES (:username, :password)";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(":username", $username, PDO::PARAM_INT);
    $stmt->bindValue(":password", $hash, PDO::PARAM_INT);
    
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