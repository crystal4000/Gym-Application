<?php

// $memberid = filter_input(INPUT_POST,'memberid');

// require_once "db_connect.php";

// $query='delete from members where member_id=?';
// $stmt=mysqli_stmt_init($mysqli);

//  mysqli_stmt_prepare($stmt,$query) or exit('Query Error.'. mysqli_stmt_errno($stmt));
 
//  @mysqli_stmt_bind_param($stmt,'s',$memberid) or exit('Bind Param Error.');// if "or part" & "@" omitted error will be displayed
 
//  mysqli_stmt_execute($stmt) or exit('Query Execution failed.'. mysqli_stmt_errno($stmt));
   

//  if (mysqli_stmt_affected_rows($stmt)>0) echo "Record removed.";

// mysqli_stmt_close($stmt);


//  mysqli_close($mysqli);

require_once "db_connect.php";
$id = $_GET['memberid'];
$del = mysqli_query($mysqli, "DELETE FROM members where member_id = '$id'");

if ($del) {
    mysqli_close($mysqli);
    header("Location: members.php");
}
else{
    echo "ERRROR";
}
?>

