<?php
require("connect.php");
// Lấy IDMonHoc từ dữ liệu gửi từ JavaScript
$IDMonHoc = $_POST['IDMonHoc'];

// Chuẩn bị câu lệnh SQL để xóa dữ liệu từ bảng monhoc
$sql = "DELETE FROM monhoc WHERE IDMonHoc='$IDMonHoc'";

if ($conn->query($sql) === TRUE) {
    echo json_encode(array("status" => "success"));
} else {
    echo json_encode(array("status" => "error", "message" => "Lỗi khi xóa dữ liệu: " . $conn->error));
}

// Đóng kết nối
$conn->close();
?>
