<?php
session_start();

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

function getDB() {
    $db = dbConnect();
    $sql = "SELECT * FROM Employees";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_NAMED);
    $stmt->closeCursor();
    return $data;
  }

$emps = getDB();
$username = $_POST["username"];
$password = $_POST["password"];

echo $emps . $username . $password;

foreach($emps as $emp)
{
    if ($username == $emp['firstname'])
    {
        $hash = $emp['password'];
        
        if (password_verify($password, $hash))
        {
            $_SESSION['verified'] = true;
            /* Re-direct */
            header("Location: empcar.php");
        }
        else
        {
            echo "FAILED TO AUTHENTICATE";
        }
    }
    else
    {
        echo "NO USER FOUND";
    }
}

?>