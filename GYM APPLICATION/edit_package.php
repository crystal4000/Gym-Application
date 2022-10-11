<?php

require_once "db_connect.php";

if(isset($_GET['updatepac'])) {
     $packageid =$mysqli -> real_escape_string($_GET['packageid']);
     $package_name =$mysqli -> real_escape_string($_GET['package_name']);
     $days = $mysqli -> real_escape_string($_GET['days']);
     $time_from = $mysqli -> real_escape_string($_GET['time_from']);
     $time_to =$mysqli -> real_escape_string($_GET['time_to']);
     $amount = $mysqli -> real_escape_string($_GET['amount']);


     $updatequery = "UPDATE packages SET package_id='$packageid' ,package='$package_name', days='$days', time_from='$time_from', time_to='$time_to', amount='$amount' WHERE package_id='$packageid'";
     $edit = mysqli_query($mysqli, $updatequery);


 }


?>
