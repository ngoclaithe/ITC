<?php
// Kết nối đến cơ sở dữ liệu MySQL
require("connect.php");
// Lấy IDLich từ dữ liệu gửi từ JavaScript
$IDLich = $_POST['IDLich'];

// Chuẩn bị câu lệnh SQL để xóa dữ liệu từ bảng lichkhaigiang
$sql = "DELETE FROM lichkhaigiang WHERE IDLich=$IDLich";

if ($conn->query($sql) === TRUE) {
    echo json_encode(array("status" => "success"));
} else {
    echo json_encode(array("status" => "error", "message" => "Lỗi khi xóa dữ liệu: " . $conn->error));
}

// Đóng kết nối
$conn->close();
?>
