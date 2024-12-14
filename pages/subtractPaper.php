<?php
$con = mysqli_connect("localhost", "root", "", "userinfo");

$finaluser = $_POST['username'];

$finalpass = $_POST['password'];

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
    $hasLeft = (int)$normalPaper - 1;

    
    $sql= "UPDATE user_balance SET normalPaper=$hasLeft WHERE username = '$finaluser' AND password = '$finalpass'";
    $result = mysqli_query($con, $sql);

    $link = "Location: /pages/print_success.html";
    header($link);
}else{
    $_SESSION["error"] = "You are not valid user";
    header("Location: /pages/sso.html");
}
?>