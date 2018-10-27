<!-- THIS WILL ONLY WORK WHEN PUSHED TO HEROKU -->
<?php
session_start();

if($_SESSION['verified'])
{
    $cars = getCarsDB();
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
  


?>

<html>
<head>
    <title>Car Rental Service</title>
    <link rel="stylesheet" href="empcar.css" type="text/css">
</head>
<!--Header from https://codepen.io/linux/pen/aEQKWP -->
<header>
    <div class="header">
        <h1>Car Rental Service Employee Page</h1><br>
        <a href="add.php"><button>Add a Car</button></a>
        <a href="remove.php"><button>Remove a Car</button></a>
        <a href="update.php"><button>Edit a Car</button></a><br>
        <a href="addemp.php"><button>Add Employee</button></a>
        <a href="removeemp.php"><button>Remove Employee</button></a><br><br>
    </div>
</header>
<body>
    
    <div class="carTable">
        <h2>List of Cars</h2>
        <ul class="table">
            <li class="table-header">
                <div class="col col-1">Car ID</div>
                <div class="col col-2">Make</div>
                <div class="col col-3">Model</div>
                <div class="col col-4">Cost per day</div>
                <div class="col col-5">Mileage</div>
                <div class="col col-6">Rental Status</div>
                <div class="col col-7">Repair Status</div>
                <div class="col col-10">Renter's First</div>
                <div class="col col-11">Renter's Last</div>
            </li>
            <?php
    
            foreach($cars as $car) 
            {    
                echo "<li class=\"table-row\">";
                echo "<div class=\"col col-1\" data-label=\"CarID\">" . 
                    $car['carid'] . "</div>";
                echo "<div class=\"col col-2\" data-label=\"Make\">" . 
                    $car['make'] . "</div>";
                echo "<div class=\"col col-3\" data-label=\"Model\">" . 
                    $car['model'] . "</div>";
                echo "<div class=\"col col-4\" data-label=\"Cost\">" . 
                    "$" . $car['cost'] . "</div>";
                echo "<div class=\"col col-5\" data-label=\"Mileage\">" . 
                    $car['mileage'] . "</div>";
                echo "<div class=\"col col-8\" data-label=\"RentalSts\">" . 
                    $car['rentalstatus'] . "</div>";
                echo "<div class=\"col col-9\" data-label=\"RepairSts\">" . 
                    $car['repairstatus'] . "</div>";
                echo "<div class=\"col col-10\" data-label=\"RenterF\">" . 
                    $car['renterfirstname'] . "</div>";
                echo "<div class=\"col col-11\" data-label=\"RenterL\">" . 
                    $car['renterlastname'] . "</div>";
                echo "</li>";
            }
            
            ?>
        </ul>
    </div>
    <br>
</body>