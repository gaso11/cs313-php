<!-- THIS WILL ONLY WORK WHEN PUSHED TO HEROKU -->
<?php

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
  
$cars = getCarsDB();

?>

<html>
<head>
    <title>Car Rental Service</title>
    <link rel="stylesheet" href="carRentalBrowse.css" type="text/css">
</head>
<!--Header from https://codepen.io/linux/pen/aEQKWP -->
<header>
    <div class="header">
        <h1>Car Rental Service</h1><br>
        <h3>At new all low prices!</h3>
        <br><br>
        <button>Test Button</button>
    </div>
</header> 
<body>
    <?php
    
    echo "<table>";
    foreach($cars as $car) {
        echo "<td><tr>" . $car['make'];
    }
    echo "</table>";
    
    ?>
</body>