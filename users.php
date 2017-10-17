<?php

  session_start();

  require_once('customer.php');

  if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] == false || $_SESSION['auth_type'] == 'U'){
    header("Location: index.php");
  }

  $user = $_SESSION["user"];

require('connection.php');

$query= 'SELECT * FROM Customers';

if($_SESSION['auth_type']!='A'){
  $query=$query.' WHERE gym_id = '.$_SESSION['gym_id'];
}
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
              <td>ID</td><td>First Name</td><td>Last Name</td><td>Date of Birth</td><td>Password</td><td>age</td><td>height</td><td>weight</td><td>Plan Id</td><td>Plan Start Date</td><td>Plan End Date</td><td>Gym ID</td><td>Authentication Type</td>
            </tr>
          </thead>
          <tbody>
            <?php while($row = mysqli_fetch_array($result)) {
            ?>
                <tr>
                    <td><?php echo $row['cust_id']?></td>
                    <td><?php echo $row['Fname']?></td>
                    <td><?php echo $row['Lname']?></td>
                    <td><?php echo $row['Date_of_Birth']?></td>
                    <td><?php echo $row['password']?></td>
                    <td><?php echo $row['age']?></td>
                    <td><?php echo $row['height']?></td>
                    <td><?php echo $row['weight']?></td>
                    <td><?php echo $row['plan_id']?></td>
                    <td><?php echo $row['plan_start_date']?></td>
                    <td><?php echo $row['plan_end_date']?></td>
                    <td><?php echo $row['gym_id']?></td>
                    <td><?php echo $row['auth_type']?></td>
                </tr>

            <?php
          }
            ?>
          </tbody>
        </table>
      </div>
    </section>
  </div>
  <footer>
    <p>Smart Gym Solutions, copyright &copy; 2017 </p>
  </footer>
  </body>
  <script>
  $(document).ready(function() {
    var table = $('#user_table').DataTable();

    $('#user_table tbody').on('click', 'tr', function () {
        var data = table.row( this ).data();
        location.href = "http://localhost:7080/site/user.php?id="+data[0];
    } );
} );
  </script>
</html>
<?php
 ob_end_flush(); ?>
