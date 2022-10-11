<?php
$package_id = filter_input(INPUT_POST, 'packageid');
$package_name = filter_input(INPUT_POST, 'package_name');
$days = filter_input(INPUT_POST, 'days');
$time_from = filter_input(INPUT_POST, 'time_from');
$time_to = filter_input(INPUT_POST, 'time_to');
$amount = filter_input(INPUT_POST, 'amount');

require_once "db_connect.php";

$query = 'INSERT INTO packages(package_id, package, days, time_from, time_to, amount) values(?,?,?,?,?,?)';
$stmt = mysqli_stmt_init($mysqli);
mysqli_stmt_prepare($stmt, $query) or exit('Query Error.'. mysqli_stmt_errno($stmt));
@mysqli_stmt_bind_param($stmt, 'ssssss', $package_id, $package_name, $days, $time_from, $time_to, $amount) or exit('Bind Param Error.');

mysqli_stmt_execute($stmt) or  exit('Query Execution failed.'. mysqli_stmt_errno($stmt));

if(mysqli_stmt_affected_rows($stmt)>0)  header("location: packages.php");;

mysqli_stmt_close($stmt);

mysqli_close($mysqli);
?>