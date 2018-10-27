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
        <h1>Update a Car</h1><br>
    </div>
</header>
<body>
    <h3 style="text-align: center;">Only fill out fields you want to change</h3>
    
<?php
    
/* Make list of cars to remove */
echo "<form class=\"addform\" action=\"updateq.php\" method=\"POST\">";
echo "<label for=\"carList\">Select Car:</label>";
echo "<select name=\"carList\" id=\"carList\">\n";
foreach($cars as $car) 
{
    echo "<option value=\"" . $car['carid'] . "\">" . $car['carid'] . " - "
        . $car['make'] . " " . $car['model'] . "</option><br><br>";
}

?>
<!--This needs to be here for some reason...-->
<input class="hide" type="number" name="fake">
<!--End of useless html-->
    
<label for="mileage">Mileage:</label>
<input type="number", name="mileage", id="mileage"><br><br>
<label for="cost">Cost:</label>
<input type="number", name="cost", id="cost"><br><br>
<label for="rentalstatus">Rental Status:</label>
<select name="rentalstatus" id="rentalstatus">
    <option value="Open">Open</option>
    <option value="Closed">Closed</option>
</select><br><br>
<label for="repairstatus">Repair Status:</label>
<select name="repairstatus" id="repairstatus">
    <option value="Okay">Okay</option>
    <option value="In Shop">In Shop</option>
    <option value="Needs Repair">Needs Repair</option>
</select><br><br>
<label for="renterfirstname">Renter First Name:</label>
<input type="text" name="renterfirstname" id="renterfirstname"><br><br>
<label for="renterfirstname">Renter Last Name:</label>
<input type="text" name="renterlastname" id="renterlastname"><br><br>
<input class="button" type="submit" value="Update">
</form>

    
<?php
    

?>

</body>
</html>