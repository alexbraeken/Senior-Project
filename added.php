<?php
session_start();

require_once('customer.php');

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] == false || $_SESSION['auth_type'] == 'U'){
  header("Location: index.php");
}

$user = $_SESSION["user"];

require('connection.php');

$Fname = mysqli_real_escape_string($conn, $_POST['Fname']);
$Lname = mysqli_real_escape_string($conn, $_POST['Lname']);
$username = mysqli_real_escape_string($conn, $_POST['username']);
$bday = mysqli_real_escape_string($conn, $_POST['bday']);
$pw = mysqli_real_escape_string($conn, $_POST['pw']);
$gym_id = mysqli_real_escape_string($conn, $_POST['gym_id']);
$auth_type = mysqli_real_escape_string($conn, $_POST['auth_type']);
$query = "INSERT INTO Customers (cust_id, Fname, Lname, Date_of_Birth, password, gym_id, auth_type )
          VALUES ('".$username."', '".$Fname."', '".$Lname."','".$bday."','".$pw."','".$gym_id."','".$auth_type."')";
if (mysqli_query($conn, $query)) {
    $_SESSION['message'] = "Record updated successfully";
} else {
    $_SESSION['message'] = "Error: " . $query . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
?>
<html>
  <head>
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
                <li ><a href="services.php">Services</a></li>
                <li><a href="users.php">Users</a></li>
                <li><a href="logout.php">Log Out</a></li>
            </ul>
          </nav>
        </div>
      </header>
      <div class="content">
        <section id="services">
          <?php
            echo $_SESSION['message'];
          ?>
        </section>
    <footer>
      <p>Smart Gym Solutions, copyright &copy; 2017 </p>
    </footer>
  </div>
  </body>
</html>

<?php
 ob_end_flush(); ?>
