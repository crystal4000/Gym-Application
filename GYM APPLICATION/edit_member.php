

<?php

require_once "db_connect.php";

if(isset($_POST['updateinfo'])) {
     $memberid =$mysqli -> real_escape_string($_POST['memberid']);
     $firstname =$mysqli -> real_escape_string($_POST['firstname']);
     $lastname = $mysqli -> real_escape_string($_POST['lastname']);
     $email = $mysqli -> real_escape_string($_POST['email']);
     $contact =$mysqli -> real_escape_string($_POST['contact']);
     $gender = $mysqli -> real_escape_string($_POST['gender']);
     $address = $mysqli -> real_escape_string($_POST['address']);
     $package = $mysqli -> real_escape_string($_POST['package']);

     $updatequery = "UPDATE members set member_id='$memberid', firstname='$firstname', lastname='$lastname', email='$email', contact_info='$contact', gender='$gender', address='$address', package='$package' where member_id ='$memberid'";
    $edit = mysqli_query($mysqli, $updatequery);
    if($edit){
      echo "<script>alert('Info updated');</script>";
    }

 }


?>
