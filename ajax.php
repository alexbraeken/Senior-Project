<?php include("connection.php");
session_start();
$user=$_SESSION["user"];
$cat = mysqli_real_escape_string($conn, $_REQUEST['cat']);
$age = mysqli_real_escape_string($conn, $_REQUEST['age']);
$height = mysqli_real_escape_string($conn, $_REQUEST['height']);
$weight = mysqli_real_escape_string($conn, $_REQUEST['weight']);
$query = "UPDATE Customers
          SET age= '".$age."', height='".$height."', weight='".$weight."', plan_id='".$cat."'
          WHERE cust_id = '".$user."'";
if (mysqli_query($conn, $query)) {
    echo "Record updated successfully";
} else {
    echo "Error: " . $query . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);

?>
