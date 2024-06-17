<?php
// Kết nối đến cơ sở dữ liệu của bạn
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "adminpanel";
$port = 3306; // Default MySQL port

$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Truy vấn dữ liệu từ bảng lichkhaigiang
$sql_lichkhaigiang = "SELECT * FROM lichkhaigiang";
$result_lichkhaigiang = $conn->query($sql_lichkhaigiang);

// Truy vấn dữ liệu từ bảng monhoc
$sql_monhoc = "SELECT * FROM monhoc";
$result_monhoc = $conn->query($sql_monhoc);

// Truy vấn dữ liệu từ bảng lopmonhoc
$sql_lopmonhoc = "SELECT * FROM lopmonhoc";
$result_lopmonhoc = $conn->query($sql_lopmonhoc);

// Khởi tạo mảng lưu trữ dữ liệu từ cơ sở dữ liệu
$data = [];

// Lấy dữ liệu từ kết quả truy vấn và gán vào mảng tương ứng
if ($result_lichkhaigiang->num_rows > 0) {
    $data['lichkhaigiang'] = [];
    while ($row = $result_lichkhaigiang->fetch_assoc()) {
        $data['lichkhaigiang'][] = $row;
    }
}

if ($result_monhoc->num_rows > 0) {
    $data['monhoc'] = [];
    while ($row = $result_monhoc->fetch_assoc()) {
        $data['monhoc'][] = $row;
    }
}

if ($result_lopmonhoc->num_rows > 0) {
    $data['lopmonhoc'] = [];
    while ($row = $result_lopmonhoc->fetch_assoc()) {
        $data['lopmonhoc'][] = $row;
    }
}

// Đóng kết nối
$conn->close();

// Trả về dữ liệu dưới dạng JSON
echo json_encode($data);
