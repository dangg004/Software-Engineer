<?php
session_start();
$utracker = "user1";

$conn = new mysqli("localhost","root","","userinfo");
$array = array();
$sql = $conn->execute_query("SELECT uploadedUser, printDate, printedFile FROM history where uploadedUser = ?",[$utracker]);
while($fetch = mysqli_fetch_assoc($sql)){
    $array[] = $fetch;
}
echo json_encode($array);

session_abort();
?>