<html>
<head>
    <title>Car Rental Service</title>
    <link rel="stylesheet" href="empcar.css" type="text/css">
</head>
<!--Header from https://codepen.io/linux/pen/aEQKWP -->
<header>
    <div class="header">
        <h1>Rent a Car</h1><br>
    </div>
</header>
<body>
    
    <?php
    
    session_start();
    $_SESSION['carid'] = $_POST['carList'];
    
    ?>
    
    <div class="addform">
    <form action="rentq.php" method="post">
        <label for="firstname">First Name:</label>
        <input type="text" name="firstname" id="firstname">
        <label for="lastname">Last Name:</label>
        <input type="text" name="lastname" id="lastname">
        <input class="button" type="submit" name="submit" value="Reserve Car">
    </form>
    </div>