<?php
    echo "Hi";
    if (empty($_POST['search']))
    {
        echo "Nothing to search yet";
        return;
    }
    else
    {
        $search = $_POST['search']
        $db = dbConnect();
        $sql = "SELECT * FROM Cars WHERE 
                make LIKE '%$search%' OR model LIKE '%$search%'";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_NAMED);
        $stmt->closeCursor();
        echo json_encode($data);
    }
?>