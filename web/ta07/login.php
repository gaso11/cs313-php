<?php

/* Database stuff here */

?>
<html>
<head>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,300,100' rel='stylesheet' type='text/css'>
    <link href="login.css" rel="stylesheet" type="text/css">
    
</head>
<body>

  <div class="container">
    <div class="backbox">
      <div class="loginMsg">
        <div class="textcontent">
          <p class="title">Don't have an account?</p>
          <p>Sign up to save all your graph.</p>
          <button id="switch1">Sign Up</button>
        </div>
      </div>
      <div class="signupMsg visibility">
        <div class="textcontent">
          <p class="title">Have an account?</p>
          <p>Log in to see all your collection.</p>
          <button id="switch2">LOG IN</button>
        </div>
      </div>
    </div>
    <!-- backbox -->
    <form>
    <div class="frontbox">
      <div class="login">
        <h2>LOG IN</h2>
        <div class="inputbox">
          <input type="text" name="email" placeholder="  EMAIL">
          <input type="password" name="password" placeholder="  PASSWORD">
        </div>
        <p>FORGET PASSWORD?</p>
        <input class="button" type="submit" value="LOG IN">
      </div>
      </form>
      
      <form>
      <div class="signup hide">
        <h2>SIGN UP</h2>
        <div class="inputbox">
          <input type="text" name="fullname" placeholder="  FULLNAME">
          <input type="text" name="email" placeholder="  EMAIL">
          <input type="password" name="password" placeholder="  PASSWORD">
        </div>
        <input class="button" type="submit" value="SIGN UP">
      </div>
      </form>

    </div>
    <!-- frontbox -->
  </div>
</body>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="login.js"></script>

</html>