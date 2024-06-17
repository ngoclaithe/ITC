<?php
require("connect.php");
// Lấy dữ liệu được gửi từ form
$ngayday = $_POST['ngayday'];
$phongday = $_POST['phongday'];
$IDThoiGianHoc = $_POST['IDThoiGianHoc'];
$id = $_POST['id'];

// Chuẩn bị câu lệnh SQL để cập nhật dữ liệu trong bảng tkbdetails
$sql = "UPDATE tkbdetails SET ngayday = '$ngayday', phongday = '$phongday', idThoiGianHoc = $IDThoiGianHoc WHERE idtkbdetails = $id";

// Thực thi câu lệnh SQL
if ($conn->query($sql) === TRUE) {
    echo "Cập nhật dữ liệu thành công";
} else {
    echo "Lỗi: " . $sql . "<br>" . $conn->error;
}

// Đóng kết nối
$conn->close();
?>
