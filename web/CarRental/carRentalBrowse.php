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
    /* This works, but testing search
    $db = dbConnect();
    $sql = "SELECT * FROM Cars";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_NAMED);
    $stmt->closeCursor();
    return $data;
    */
    $output = '';
    if (isset($_POST['search'])) {
        $searchq = $_POST['search'];
        $searchq = preg_replace("#[^0-9a-z]#i", "", $searchq);
    
        $db = $dbConnect();
        $query = pg_query($db, "SELECT * FROM Cars WHERE model 
            LIKE '%$searchq%' OR make LIKE '%$searchq%'");
        $count = pg_num_rows($query);
        if ($count == 0) {
            $output = 'No Results Found';
        }else{
            while ($row = pg_fetch_array($query)){
                $make = $row['make'];
                $model = $row['model'];
                $id = $row['id'];
                
                $ouput .= '<div> '.$make.' '.$model.'</div>';
            }
        }
    }
    
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
        <button><a href="empcar.php">Login</a></button>
    </div>
</header> 
<body>
    
    <!-- Searching -->
    <form action="carRentalBrowse.php" method="post">
        <input type="text" name="search" placeholder="Search for cars..."/>
        <input type="submit" value=">>"/>
    </form>
    
    <?php print("$output");?>
    
    <div class="carTable">
        <h2>Cars Avaliable for Rent</h2>
        <ul class="table">
            <li class="table-header">
                <div class="col col-1">Make</div>
                <div class="col col-2">Model</div>
                <div class="col col-3">Cost per day</div>
            </li>
            <?php
    
            foreach($cars as $car) 
            {
                if ($car['repairstatus'] == "Okay" && $car['rentalstatus'] == "Open")
                {
                    
                echo "<li class=\"table-row\">";
                echo "<div class=\"col col-1\" data-label=\"Make\">" . 
                    $car['make'] . "</div>";
                echo "<div class=\"col col-2\" data-label=\"Model\">" . 
                    $car['model'] . "</div>";
                echo "<div class=\"col col-3\" data-label=\"Cost\">" . 
                    "$" . $car['cost'] . "</div>";
                echo "</li>";
                }
            }
            
            ?>
        </ul>
    </div>
    <br>
</body>