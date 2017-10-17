
<?php

  session_start();
  require('connection.php');

  if (isset($_POST["username"]) && isset($_POST["password"])){
    $user = $_POST["username"];
    $query = "SELECT * FROM Customers WHERE cust_id ='".$user."'";
    $result = $conn->query($query);
  if ($result->num_rows == 0){ // User doesn't exist
  $_SESSION["message"] = "User with that email doesn't exist!";
  header("location: error.php");
  }
  else {// User exists
    $logged_user = mysqli_fetch_array($result);
    if ($_POST["password"] === $logged_user["password"]) {
        $_SESSION["user"] = $logged_user["cust_id"];
        $_SESSION["first_name"] = $logged_user["Fname"];
        $_SESSION["last_name"] = $logged_user["Lname"];
        $_SESSION["logged_in"] = true;
        $_SESSION["gym_id"] = $logged_user["gym_id"];
        $_SESSION["auth_type"] = $logged_user["auth_type"];

        if($_SESSION["auth_type"]=='A' || $_SESSION["auth_type"]=='G'){
          header("location: users.php");
        }
        else{
          header("location: profile.php");
        }

      }
    else {
        $_SESSION['message'] = "You have entered the wrong password, try again!";
        header("location: error.php");
    }
  }
    }

 ?>

<html>
  <head>
    <?php include('header.php');?>
  </head>
  <body>
    <header id="header_bar">
      <div class="container">
        <div id="branding">
          <h1><span class="highlight">Smart</span> Gym Solutions</h1>
        </div>
        <nav>
          <ul>
              <li class = "current"><a href="index.php">Home</a></li>
              <li><a href="about.php">About</a></li>
              <li><a href="services.php">Services</a></li>
              <li>
                <div class="container">
                  <?php if(!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] == false){
                  echo '<div id="login_form">
                    <form method="post" action="index.php">

                      <div id="user_input">
                        Log In: <br/>
                        <Input type="text" id="username" class="text_input" name="username" placeholder="Username"/>
                      </div>
                      <div id="pass_input">
                        <Input type="password" id="password" class="text_input"  name="password" placeholder="Password"><br/>
                        <input type="submit" class="button_1" value="Login">
                      </div>

                    </form>';}
                    else{
                      if($_SESSION["auth_type"]=='U'){
                      echo '<li><a href="profile.php">Profile</a></li>';
                    }
                    else{
                      echo '<li><a href="users.php">Users</a></li>';
                    }
                    echo'<li><a href="logout.php">Log Out</a></li>';
                    }?>
                  </div>

                </div>
              </ul>
            </nav>
          </div>
    </header>
    <div class="content">
    <section id="showcase">
      <div class="container">
          <h1>Make Brains Meet Brawn</h1>
          <p>Providing Health and Fitness solutions for one of the fastest growing industries in the world</p>
      </div>
    </section>

    <section id="subscribe">
      <div class="container">
          <h1>Subsribe to our services</h1>
          <form>
            <input type="email" placeholder="Enter Email...">
            <button type="submit" class="button_1">Subscribe</button>
          </form>
      </div>
    </section>

    <section id="boxes">
      <div class="container">
        <div id="tracking_box" class="box">
          <img src="./img/tracking.png">
          <h3 id="tracking_text">Progress Tracking</h3>
          <p>Keep track of your fitness and regimen anywhere anytime from home or with our mobile app to fine tune your needs</p>
        </div>
        <div id="connected_box" class="box">
          <img src="./img/connected.png">
          <h3 id="connected_text">Smart Equipment</h3>
          <p>Use connected Smart Gym Equipment to find the right routine for you in a matter of seconds</p>
        </div>
        <div id="support_box" class="box">
          <img src="./img/support.png">
          <h3 id="support_text">Fitness Support</h3>
          <p>We provide a large array of recommneded fitness and health regimens to fit any customers goals from strength training to dietary improvements.</p>
        </div>
      </div>

    </section>
    <section id="tracking_description">
      <div class="conatiner">
        <h2>Smart Gym Solutions provides growing businesses and their clients the tools to track, understand and react to vital data and information.</h2>
      </div>
    </section>
    <section id="equipment_description">
      <div class="conatiner">
        <h2>Smart Gym Solutions provides the best in smart connected gym equipment with cutting edge technology to support the customer in every way possible</h2>
      </div>
    </section>
    <section id="support_description">
      <div class="conatiner">
        <h2>Smart Gym Solutions provides full time support for efficient and effective solution implementation</h2>
      </div>
    </section>

    <footer>
      <p>Smart Gym Solutions, copyright &copy; 2017 </p>
    </footer>
    <script type = "text/javascript">
    $(document).ready(function(){

    $('#username').focusin(function(){
        $('#pass_input').slideDown();
    });

    $('#username').blur(function(){
      if ($('#username').val() == null || $('#username').val() === ''){
        $('#pass_input').slideUp();
      }
    });

    $('#tracking_box').hover(function(){
      $('#tracking_text').css('text-decoration', 'underline');
    },function(){
      $('#tracking_text').css('text-decoration', 'none');
    });
    $('#connected_box').hover(function(){
      $('#connected_text').css('text-decoration', 'underline');
    },function(){
      $('#connected_text').css('text-decoration', 'none');
    });
    $('#support_box').hover(function(){
      $('#support_text').css('text-decoration', 'underline');
    },function(){
      $('#support_text').css('text-decoration', 'none');
    });
    $('#tracking_box').click(function(){
      $('#equipment_description').slideUp();
      $('#support_description').slideUp();
      $('#tracking_description').slideDown();
      var n = $(document).height();
      $('html, body').animate({ scrollTop: n }, 1000);
      });

    $('#connected_box').click(function(){
      $('#tracking_description').slideUp();
      $('#support_description').slideUp();
      $('#equipment_description').slideDown();
        var n = $(document).height();
      $('html, body').animate({ scrollTop: n }, 1000);
      });

      $('#support_box').click(function(){
        $('#tracking_description').slideUp();
        $('#equipment_description').slideUp();
        $('#support_description').slideDown();
          var n = $(document).height();
        $('html, body').animate({ scrollTop: n }, 1000);
        });


});

    </script>
  </div>
  </body>
</html>
<?php
 ob_end_flush(); ?>
