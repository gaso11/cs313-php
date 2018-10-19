<html>
<head>
    <title>Car Rental Service</title>
    <link rel="stylesheet" href="empcar.css" type="text/css">
</head>
<!--Header from https://codepen.io/linux/pen/aEQKWP -->
<header>
    <div class="header">
        <h1>Car Rental Service Employee Page</h1><br>
    </div>
</header>
<body>
    
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
                echo "<li class=\"table-row\">";
                echo "<div class=\"col col-1\" data-label=\"Make\">" . 
                    $car['make'] . "</div>";
                echo "<div class=\"col col-2\" data-label=\"Model\">" . 
                    $car['model'] . "</div>";
                echo "<div class=\"col col-3\" data-label=\"Cost\">" . 
                    "$" . $car['cost'] . "</div>";
                echo "</li>";
            }
            
            ?>
        </ul>
        <br>
    </div>    
</body>