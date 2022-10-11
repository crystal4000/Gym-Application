<?php
require_once "db_connect.php";
$id = $_GET['package_id'];
$del = mysqli_query($mysqli, "DELETE FROM packages where package_id = '$id'");

if ($del) {
    mysqli_close($mysqli);
    header("Location: packages.php");
}
else{
    echo "ERRROR";
}
?>