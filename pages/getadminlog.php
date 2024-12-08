<?php
session_start();
//Nhận data từ see_history
$utracker = $_POST['uTracker'];
if ($utracker == 'admin') {
//Kết nối tới MySQL của XMAPP
$conn = new mysqli("localhost","root","","userinfo");
//Tạo một array mới để chứa data lát gửi về
$array = array();
//Tìm các hàng trong SQL -> history có username trùng với cái cần tìm
$sql = $conn->execute_query("SELECT * FROM history",[]);
//Rồi add từng cái vào trong array
while($fetch = mysqli_fetch_assoc($sql)){
    $array[] = $fetch;
}
//Chuyển thành file JSON rồi gửi về bên kia
echo json_encode($array);
}
//Tắt
session_abort();
?>