<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "adminpanel";
$port = 3306; // Default MySQL port

$conn = new mysqli($servername, $username, $password, $dbname, $port);
// Lấy dữ liệu từ form
$ngayday = $_POST['ngayday'];
$phongday = $_POST['phongday'];
$idThoiGianHoc = $_POST['IDThoiGianHoc'];
$idtkb = $_POST['idtkb'];

// Chuẩn bị câu lệnh SQL để insert dữ liệu
$sql = "INSERT INTO tkbdetails (ngayday, phongday, idThoiGianHoc, idtkb) 
        VALUES ('$ngayday', '$phongday', '$idThoiGianHoc', '$idtkb')";

// Thực hiện insert dữ liệu và kiểm tra kết quả
if ($conn->query($sql) === TRUE) {
    echo "Dữ liệu đã được thêm thành công.";
} else {
    echo "Lỗi: " . $sql . "<br>" . $conn->error;
}

// Đóng kết nối
$conn->close();
