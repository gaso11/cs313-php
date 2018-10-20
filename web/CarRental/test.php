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
    $output = 'Hello World';
    
    if (isset($_POST['search']))
    {
        $searchq = $_POST['search'];
        $searchq = preg_replace("#[^0-9a-z]#i", "", $searchq);
        
        $stmt = $db->prepare("SELECT * FROM Cars WHERE 
                            make LIKE '%$searchq%' OR model LIKE '%$searchq%'");
        $stmt->execute();
        $count = pg_num_rows($stmt);
        if ($count == 0)
        {
            $output = 'No Results';
        } 
        else 
        {
            while($rows = $stmt->fetchALL(PDO::FETCH_ASSOC))
            {
                $make = $rows['make'];
                $model = $rows['model'];
                
                $output .= '<div> ' .$make. ' ' .$model.'</div>';
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
        <h1>*TEST PAGE*</h1><br>
        <h3>At new all low prices!</h3>
        <br><br>
        <button><a href="empcar.php">Login</a></button>
    </div>
</header> 
<body>
    
    <!-- Searching -->
    <form action="test.php" method="POST">
        <input type="text" name="search" placeholder="Search for cars..."/>
        <input type="submit" value=">>"/>
    </form>
    
    <?php echo $output ?>
    
    <br>
</body>