<?php

$finaluser= $_POST['username'];
$finalpass= $_POST['password'];
$con = mysqli_connect("localhost", "root", "", "userinfo");
$sql = "SELECT * FROM user_balance where username = '$finaluser' AND password = '$finalpass'";
$result = mysqli_query($con, $sql);
if(mysqli_num_rows($result) < 1)
{
    $sql = "INSERT INTO user_balance (username,password,normalPaper,colorPaper) values ('$finaluser','$finalpass',0,0)";
    $result = mysqli_query($con, $sql);
}
$sql = "SELECT normalPaper FROM user_balance where username = '$finaluser' AND password = '$finalpass'";
$normalPaper=mysqli_fetch_array(mysqli_query($con, $sql))['normalPaper']+(int)$_POST['paper2'];
$sql = "SELECT colorPaper FROM user_balance where username = '$finaluser' AND password = '$finalpass'";
$colorPaper=mysqli_fetch_array(mysqli_query($con, $sql))['colorPaper']+(int)$_POST['paper1'];

$sql = "UPDATE user_balance set normalPaper=$normalPaper,colorPaper=$colorPaper WHERE username = '$finaluser' AND password = '$finalpass'";
$result = mysqli_query($con, $sql);





/*if (!file_exists('../database/'.$_POST['username'])) {
    mkdir('../database/'.$_POST['username'], 0744, true); 
    $normalPaper=(int)$_POST['paper2'];
    $colorPaper=(int)$_POST['paper1'];
}
else
{
    $myfile = fopen("../database/".$_POST['username'], "r") or die("Unable to open file1!");
    $normalPaper=(int)fgets($myfile)+(int)$_POST['paper2'];
    $colorPaper=(int)fgets($myfile)+(int)$_POST['paper1'];
    fclose($myfile);
}

$myfile = fopen("../database/".$_POST['username'], "w") or die("Unable to open file2!");
fwrite($myfile, $normalPaper);
fwrite($myfile, $colorPaper);
fclose($myfile);*/

$path = "Location: /pages/buy_paper_success.html?username=" . "n=" .$_POST['paper2']. "&" . "c=" .$_POST['paper1']
. "&" . "nn=" .$normalPaper. "&" . "cc=" .$colorPaper;
               
header($path);
die();
?>