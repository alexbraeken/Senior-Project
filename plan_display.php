<h2 class='page-title'>Your Plan: <?php echo $customer->plan_name?> plan </h2>
<hr class='style-five'>
  <?php $ex_plan = fopen($customer->plan_filepath,"r") or die("Unable to retrieve plan");
  echo fread($ex_plan, filesize($customer->plan_filepath));
  fclose($ex_plan);?>
