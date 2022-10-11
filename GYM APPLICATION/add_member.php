<?php

$memberid = filter_input(INPUT_POST, 'memberid');
$firstname = filter_input(INPUT_POST, 'firstname');
$lastname = filter_input(INPUT_POST, 'lastname');
$email = filter_input(INPUT_POST, 'email');
$contact = filter_input(INPUT_POST, 'contact');
$gender = filter_input(INPUT_POST, 'gender');
$address = filter_input(INPUT_POST, 'address');
$package = filter_input(INPUT_POST, 'package');

//if (strlen(trim($memberid))<1) exit('Member id cannot be blank');

require_once "db_connect.php";

$totalPackageSize = getTotalNum("members");

if ($totalPackageSize >= 20) {
    header("Location: members.php?msg='Members Full'");
} else {
    $query = 'INSERT INTO members(member_id, firstname, lastname, email, contact_info, gender, address, package) values(?,?,?,?,?,?,?,?)';
    $stmt = mysqli_stmt_init($mysqli);
    mysqli_stmt_prepare($stmt, $query) or exit('Query Error.'. mysqli_stmt_errno($stmt));
    @mysqli_stmt_bind_param($stmt, 'ssssssss', $memberid, $firstname, $lastname, $email, $contact, $gender, $address, $package) or exit('Bind Param Error.');

    mysqli_stmt_execute($stmt) or  exit('Query Execution failed.'. mysqli_stmt_errno($stmt));

    if(mysqli_stmt_affected_rows($stmt)>0)  header("location: members.php");;

    mysqli_stmt_close($stmt);

    mysqli_close($mysqli);
} 

?>
