<?php
$con = mysqli_connect("localhost", "root", "", "userinfo");

$usertrim = trim($_POST['username']);
$usertrip = stripcslashes($usertrim);
$finaluser = htmlspecialchars($usertrip);

$passtrim = trim($_POST['password']);
$passstrip = stripcslashes($passtrim);
$finalpass = htmlspecialchars($passstrip);

$sql = "SELECT * FROM user_balance where username = '$finaluser' AND password = '$finalpass'";
$result = mysqli_query($con, $sql);

if(mysqli_num_rows($result) >= 1){
    $sql = "SELECT * FROM user_balance where username = '$finaluser' AND password = '$finalpass'";
    $result = mysqli_query($con, $sql);
    if(mysqli_num_rows($result) < 1)
    {
        $sql = "INSERT INTO user_balance (username,password,normalPaper,colorPaper) values ('$finaluser','$finalpass',0,0)";
        $result = mysqli_query($con, $sql);
    }
    $sql = "SELECT normalPaper FROM user_balance where username = '$finaluser' AND password = '$finalpass'";
    $normalPaper=mysqli_fetch_array(mysqli_query($con, $sql))['normalPaper'];
    $sql = "SELECT colorPaper FROM user_balance where username = '$finaluser' AND password = '$finalpass'";
    $colorPaper=mysqli_fetch_array(mysqli_query($con, $sql))['colorPaper'];

    $cost = $_POST['paperCount'];
    $hasLeft = $normalPaper - $_POST['paperCount'] < 0? 0: $normalPaper - $_POST['paperCount'];

    $sql= "UPDATE user_balance SET normalPaper=$hasLeft WHERE username = '$finaluser' AND password = '$finalpass'";

    $link = "Location: /pages/print_success.html";
    header($link);
}else{
    $_SESSION["error"] = "You are not valid user";
    header("Location: /pages/sso.html");
}
?>