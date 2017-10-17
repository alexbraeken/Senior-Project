<?php

  session_start();

  require_once('customer.php');

  if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] == false){
    header("Location: index.php");
  }

  $user = $_SESSION["user"];

require('connection.php');
//Retrieve customer info
  $query = "SELECT wp.plan_name, wp.plan_duration, wp.plan_filepath, cu.age, cu.height, cu.weight, gy.gym_name, gy.gym_logo_fp
            FROM workout_plans wp, Customers cu, gyms gy
            WHERE wp.plan_id = cu.plan_id
            AND cu.gym_id = gy.gym_id
            AND cu.cust_id='".$user."'";
  $result = $conn->query($query);

$customer = new Customer();
$logged_user = mysqli_fetch_array($result);
$customer->plan_name=$logged_user['plan_name'];
$customer->plan_filepath=$logged_user['plan_filepath'];
$customer->cust_age=$logged_user['age'];
$customer->cust_height=$logged_user['height'];
$customer->cust_weight=$logged_user['weight'];
$customer->cust_gym=$logged_user['gym_name'];
$customer->cust_gym_logo_fp=$logged_user['gym_logo_fp'];

 ?>



<!DOCTYPE html>
<html>
  <head>
      <title>Smart Gym Solutions | Profile</title>
      <?php include('header.php');?>

      <script type="text/javascript">


      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Week'],
          ['Strength', 3],
          ['Cardio',     11]
        ]);

        var options = {
          title: 'Week Average Breakdown',
          legend: 'top',
          backgroundColor: '#efe1e1',
          chartArea:{left:20,top:20,width:"60%",height:"60%"},
          fontSize:'12',
          pieSliceText:'label'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }

function drawStacked() {
      var options = {
        title: 'Calories burned per day',
        legend: 'top',
        isStacked: true,
        fontSize:'12',
        hAxis: {
          title: 'Date',
          format: 'M-d'
        },
        vAxis: {
          title: 'Calories burned'
        },
        backgroundColor: '#efe1e1',
        animations:{
          startup:true,
          duration: 100,
          easing: 'out'},
        chartArea:{left:20,top:20,width:"60%",height:"60%"}
      };

      var data = new google.visualization.DataTable();
      data.addColumn('date', 'Date');
      data.addColumn('number', 'Calories burned / Strength Training');
      data.addColumn('number', 'Calories burned / Cardio');

      data.addRows([
        [new Date('2017-1-15'), 1, .25],
        [new Date('2017-1-16'), 2, .5],
        [new Date('2017-1-17'), 3, 1],
        [new Date('2017-1-18'), 4, 2.25],
        [new Date('2017-1-19'), 5, 2.25],
        [new Date('2017-1-20'), 6, 3],
        [new Date('2017-1-21'), 7, 4],
      ]);

      var formatter = new google.visualization.DateFormat({formatType: 'short'});
      formatter.format(data, 1);

      var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
      chart.draw(data, options);
    }

      google.charts.load('current', {'packages': ['corechart', 'bar']});
      google.charts.setOnLoadCallback(drawStacked);
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

    </script>
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
              <li><a href="logout.php">Log Out</a></li>
          </ul>
        </nav>
      </div>
    </header>
    <div class="content">
    <section id="profile_nav">
      <div class="container">
        <div class = "gym_logo"><img src = "<?php echo $customer->cust_gym_logo_fp?>" ></div>
        <h1><?php echo   $_SESSION["first_name"]."'s Profile<br>";?></h1>
      </div>
    </section>

    <section id="main">
      <div class="container">
        <article id="main-col">
        <?php if(!$customer->plan_name==''){
          include("plan_display.php");
        }
        else{
          include("create.php");
        }
           ?>
        </article>


        <aside id="progress">
          <?php
          if(!$customer->plan_name=='')
            include("plan_sidebar.php");
          else {
            include("create_sidebar.php");
            }
            ?>

        </aside>
      </div>

    </section>
  </div>
    <footer>
      <p>Smart Gym Solutions, copyright &copy; 2017 </p>
    </footer>
  </body>
</html>

<?php
 ob_end_flush(); ?>
