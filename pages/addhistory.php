<?php 
session_start();

$received1 = $_POST['printer'];
$received2 = $_POST['location'];
$received3 = $_POST['date'];
$user = "user1";
$file = "sample.txt";
// Create connection
$conn = mysqli_connect("localhost", 'root', '', 'userinfo');
$sql1 = "SELECT count(*) as id from history";
$res = mysqli_query($conn, $sql1);
$id = mysqli_fetch_assoc($res)["id"];
$sql2 = "INSERT INTO history(hisid, uploadedUser, printerUsed, printerLocation, printDate, printedFile) VALUES (?,?,?,?,?,?)";
$conn->execute_query($sql2, [$id,$user, $received1, $received2, $received3, $file]);
session_abort();
?>