<?php
require("connect.php");
// Lấy dữ liệu gửi từ JavaScript
$TenMonHoc = $_POST['TenMonHoc'];
$ThongTinMonHoc = $_POST['ThongTinMonHoc'];
$IDLich = $_POST['IDLich'];

// Chuẩn bị câu lệnh SQL để thêm dữ liệu vào bảng monhoc
$sql = "INSERT INTO monhoc (TenMonHoc, ThongTinMonHoc, IDLich) VALUES ('$TenMonHoc', '$ThongTinMonHoc', '$IDLich')";

if ($conn->query($sql) === TRUE) {
    echo json_encode(array("status" => "success"));
} else {
    echo json_encode(array("status" => "error", "message" => "Lỗi khi thêm dữ liệu: " . $conn->error));
}

// Đóng kết nối
$conn->close();
?>
