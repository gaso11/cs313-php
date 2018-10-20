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
    echo "Hi";
    /*
    if (empty($_POST["search"]))
    {
        echo "Nothing to search yet";
        return;
    }
    else
    {
        $search = $_POST["search"]
        $db = dbConnect();
        $sql = "SELECT * FROM Cars WHERE 
                make LIKE '%$search%' OR model LIKE '%$search%'";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_NAMED);
        $stmt->closeCursor();
        echo json_encode($data);
    }
    */
?>