<?php
require("connect.php");

// Lấy dữ liệu gửi từ JavaScript
$IDMonHoc = $_POST['IDMonHoc'];
$TenMonHoc = $_POST['TenMonHoc'];
$ThongTinMonHoc = $_POST['ThongTinMonHoc'];
$IDLich = $_POST['IDLich'];

// Chuẩn bị câu lệnh SQL để cập nhật dữ liệu trong bảng monhoc
$sql = "UPDATE monhoc SET TenMonHoc='$TenMonHoc', ThongTinMonHoc='$ThongTinMonHoc', IDLich='$IDLich' WHERE IDMonHoc='$IDMonHoc'";

if ($conn->query($sql) === TRUE) {
    echo json_encode(array("status" => "success"));
} else {
    echo json_encode(array("status" => "error", "message" => "Lỗi khi cập nhật dữ liệu: " . $conn->error));
}

// Đóng kết nối
$conn->close();
?>
