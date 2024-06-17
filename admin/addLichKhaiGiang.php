<?php
require("connect.php");
// Lấy dữ liệu gửi từ JavaScript
$TenMon = $_POST['TenMon'];
$NgayBatDau = $_POST['NgayBatDau'];

// Chuẩn bị câu lệnh SQL để thêm dữ liệu vào bảng lichkhaigiang
$sql = "INSERT INTO lichkhaigiang (TenMon, NgayBatDau) VALUES ('$TenMon', '$NgayBatDau')";

if ($conn->query($sql) === TRUE) {
    echo json_encode(array("status" => "success"));
} else {
    echo json_encode(array("status" => "error", "message" => "Lỗi khi thêm dữ liệu: " . $conn->error));
}

// Đóng kết nối
$conn->close();
?>
