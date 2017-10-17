<?php

  session_start();

  require_once('customer.php');

  if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] == false || $_SESSION['auth_type'] == 'U'){
    header("Location: index.php");
  }

  $user = $_SESSION["user"];

require('connection.php');

$query= "SELECT cr.rec_time, cr.rec_duration, cr.exe_type, eq.equip_name, cr.calories_burned, cr.reps
        FROM cust_records cr, equipment eq
        WHERE cr.equip_id=eq.equip_id
        AND cr.cust_id ='".$_GET['id']."'";

$result = $conn->query($query);


?>
<html>
  <head>
    <title>Smart Gym Solutions | Users</title>
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
              <li><a href="services.php">Services</a></li>
              <li class="current"><a href="users.php">Users</a></li>
              <li><a href="logout.php">Log Out</a></li>
          </ul>
        </nav>
      </div>
    </header>
    <div class="content">
    <section id="user_list">
      <div class="container">
        <table id='user_table' class='display' cellspacing="0" width="100%">
          <thead>
            <tr>
              <td>Date/Time</td><td>Duration</td><td>Type</td><td>Equip. Name</td><td>Calories Burned</td><td>Reps</td>
            </tr>
          </thead>
          <tbody>
            <?php while($row = mysqli_fetch_array($result)) {
            ?>
                <tr>
                    <td><?php echo $row['rec_time']?></td>
                    <td><?php echo $row['rec_duration']?></td>
                    <td><?php echo $row['exe_type']?></td>
                    <td><?php echo $row['equip_name']?></td>
                    <td><?php echo $row['calories_burned']?></td>
                    <td><?php echo $row['reps']?></td>
                </tr>

            <?php
          }
            ?>
          </tbody>
        </table>
      </div>
    </section>
  </body>
  <script>
  $(document).ready(function() {
    var table = $('#user_table').DataTable();

    $('#user_table tbody').on('click', 'tr', function () {
        var data = table.row( this ).data();
    } );
} );
  </script>
</html>
<?php
 ob_end_flush(); ?>
