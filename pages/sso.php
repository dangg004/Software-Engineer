<?php
session_start();
$con = mysqli_connect("localhost", "root", "", "userinfo");

$usertrim = trim($_POST['username']);
$usertrip = stripcslashes($usertrim);
$finaluser = htmlspecialchars($usertrip);

$passtrim = trim($_POST['password']);
$passstrip = stripcslashes($passtrim);
$finalpass = htmlspecialchars($passstrip);

$sql = "SELECT * FROM username_password where username = '$finaluser' AND password = '$finalpass'";
$result = mysqli_query($con, $sql);

if(mysqli_num_rows($result) >= 1){
    $_SESSION["myuser"] = $finaluser;
    header("Location: /pages/index.html");
}else{
    $_SESSION["error"] = "You are not valid user";
    header("Location: /pages/error.html");
}
?>