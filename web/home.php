<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1"/>
  <link rel="stylesheet" type="text/css" href="homeStyle.css">
  <title>Evan's Homepage</title>
<body>
  <div class="header">
    <h1>Evan's Homepage</h1>
  </div>

  <!--Menu-->
  <div class="row">
    <div class="col-3 menu">
      <ul>
      	<li onclick="location.href = 'home.php';">Home</li>
        <li onclick="location.href = 'assignments.html';">Assignments</li>
      </ul>
    </div>

    <!-- Body -->
    <div class="col-9">
    	<img src="stc.jpg" alt="Image of the STC building">
      <h1>Interests</h1>
        <p>
          I don't really have interests that trump something else. I enjoy playing video games<br>
          and watching movies with my wife. I picked the STC as my image because it's my favorite<br>
          building on campus and I have a lot of good memories from working on projects with my friends.
        </p>
    </div>
  </div>
  <div class="footer">
    <footer>
      <!---PHP Time -->
      <?php
      	// Stackoverflow: How to get date and time from server
      	date_default_timezone_set('America/Denver');
      	
      	$currentDate = date('m/d/Y - H:i:s');

      	echo "Current time on load: " . $currentDate;
      ?>
    </footer>
  </div>
</body>
</html>