<?php
require("connect.php");
// Lấy dữ liệu gửi từ JavaScript
$TenMon = $_POST['TenMon'];
$NgayBatDau = $_POST['NgayBatDau'];
$IDLich = $_POST['IDLich'];

// Chuẩn bị câu lệnh SQL để cập nhật dữ liệu trong bảng lichkhaigiang
$sql = "UPDATE lichkhaigiang SET TenMon='$TenMon', NgayBatDau='$NgayBatDau' WHERE IDLich=$IDLich";

if ($conn->query($sql) === TRUE) {
    echo json_encode(array("status" => "success"));
} else {
    echo json_encode(array("status" => "error", "message" => "Lỗi khi cập nhật dữ liệu: " . $conn->error));
}

// Đóng kết nối
$conn->close();
?>
