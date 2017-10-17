<?php

  session_start();

  require_once('customer.php');

  if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] == false || $_SESSION['auth_type'] == 'U'){
    header("Location: index.php");
  }

  $user = $_SESSION["user"];
  require('connection.php');
  $query="SELECT gym_id, gym_name FROM gyms";
  $result = $conn->query($query);
  $menu=" ";


?>
<html>
  <head>
    <meta charset="utf-8">
    <title>Smart Gym Solutions | Services</title>
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
              <li ><a href="index.php">Home</a></li>
              <li><a href="about.php">About</a></li>
              <li class = "current"><a href="services.php">Services</a></li>
              <li><a href="users.php">Users</a></li>
              <li><a href="logout.php">Log Out</a></li>
          </ul>
        </nav>
      </div>
    </header>
    <div class="content">
      <section id="services">
      <input type="button" id="add_user_btn" class="button_1" value="Add User">
      <div id="add_user">
        <form method="POST" action="added.php" id="new_user">
          First Name: <br> <input type="text" id="user_Fname" name="Fname" class="new_user"><br>
          Last Name: <br> <input type="text" id="user_Lname" name="Lname" class="new_user"><br>
          Username: <br> <input type="text" id="user_name" name="username" class="new_user"><br>
          Date of Birth: <br> <input type="date" id="user_bday" name="bday" class="new_user"><br>
          Password: <br> <input type="text" id="user_pw" name="pw" class="new_user"><br>
          Gym:<br>
          <select id="gym_id" name="gym_id">
            <option selected disabled hidden>Gym Name</option>
          <?php while($row = mysqli_fetch_array($result))
            {
              $menu .="<option value = ".$row['gym_id'].">" . $row['gym_name'] . "</option>";
            }
            echo $menu;
            ?>
          </select>
          <br>
          User Type:<br>
          <select id="auth_type" name="auth_type" >
            <option selected disabled hidden>User Authorization</option>
            <option>Administrator</option>
            <option>Gym Staff</option>
            <option>User</option>
          </select>
          <br>
          <br>
          <input type="submit" class="button_1" value="Submit">
      </div>
    </section>
    <footer>
      <p>Smart Gym Solutions, copyright &copy; 2017 </p>
    </footer>
    <script type = "text/javascript">
      $(document).ready(function(){
        $('#add_user_btn').click(function(){
          $('#add_user').slideToggle();
        });
      });
    </script>
    </div>
  </body>
</html>
<?php
 ob_end_flush(); ?>
