<?php 
//Mở session
session_start();

//Nhận dữ liệu được gửi từ nguồn gọi file này dậy (ở đây là cái nút "In")
$received1 = $_POST['printer'];
$received2 = $_POST['location'];
$received3 = $_POST['date'];

//Dữ liệu tạm thời chờ đồng bộ
$user = "user1";
$file = "sample.txt";

// Kết nối tới MySQL của XMAPP
$conn = mysqli_connect("localhost", 'root', '', 'userinfo');

//Đếm số lượng dữ liệu đã có sẵn dể set ID (Có thể gặp lỗi, để handle sau)
$sql1 = "SELECT count(*) as id from history";
//Gọi sql
$res = mysqli_query($conn, $sql1);
//Lấy dữ liệu được sql trả về
$id = mysqli_fetch_assoc($res)["id"];

//Thêm một hàng mới vào history
$sql2 = "INSERT INTO history(hisid, uploadedUser, printerUsed, printerLocation, printDate, printedFile) VALUES (?,?,?,?,?,?)";
$conn->execute_query($sql2, [$id,$user, $received1, $received2, $received3, $file]);

//tắt session
session_abort();
?>