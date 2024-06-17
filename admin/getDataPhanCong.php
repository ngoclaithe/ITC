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

// Khởi tạo mảng lưu trữ dữ liệu
$data = [
    'thoiGianHocData' => [],
    'lopmonhoc' => [],
    'tkbData' => [],
    'registerData' => []
];

// Truy vấn dữ liệu từ bảng thoi_gian_hoc và gán vào mảng $data['thoiGianHocData']
$sql_thoi_gian_hoc = "SELECT * FROM thoi_gian_hoc";
$result_thoi_gian_hoc = $conn->query($sql_thoi_gian_hoc);
if ($result_thoi_gian_hoc->num_rows > 0) {
    while ($row = $result_thoi_gian_hoc->fetch_assoc()) {
        $data['thoiGianHocData'][] = [
            'id' => $row['IDThoiGianHoc'],
            'ThoiGian' => $row['ThoiGian']
        ];
    }
}

// Truy vấn dữ liệu từ bảng lopmonhoc và gán vào mảng $data['lopmonhoc']
$sql_lopmonhoc = "SELECT * FROM lopmonhoc";
$result_lopmonhoc = $conn->query($sql_lopmonhoc);
if ($result_lopmonhoc->num_rows > 0) {
    while ($row = $result_lopmonhoc->fetch_assoc()) {
        $data['lopmonhoc'][] = [
            'idLopMonHoc' => $row['MaLop'],
            'MaLop' => $row['MaLop'],
            'HocPhi' => $row['HocPhi'],
            'ThoiGianBatDau' => $row['ThoiGianBatDau'],
            'ThoiGianKetThuc' => $row['ThoiGianKetThuc'],
            'ThoiGianDangKy' => $row['ThoiGianDangKy'],
            'ThoiGianDongDangKy' => $row['ThoiGianDongDangKy'],
            'SoLuongHocVien' => $row['SoLuongHocVien'],
            'DiaDiemHoc' => $row['DiaDiemHoc'],
            'NgayKhaiGiang' => $row['NgayKhaiGiang'],
            'IDMonHoc' => $row['IDMonHoc']
        ];
    }
}

// Truy vấn dữ liệu từ bảng tkb và gán vào mảng $data['tkbData']
$sql_tkb = "SELECT * FROM tkb";
$result_tkb = $conn->query($sql_tkb);
if ($result_tkb->num_rows > 0) {
    while ($row = $result_tkb->fetch_assoc()) {
        $data['tkbData'][] = [
            'MaLop' => $row['MaLop'],
            'MaGV' => $row['MaGV'],
            'id' => $row['idtkb']
        ];
    }
}

// Truy vấn dữ liệu từ bảng register và gán vào mảng $data['registerData']
$sql_register = "SELECT * FROM register WHERE usertype = 'teacher'";
$result_register = $conn->query($sql_register);
if ($result_register->num_rows > 0) {
    while ($row = $result_register->fetch_assoc()) {
        $data['registerData'][] = [
            'username' => $row['username'],
            'email' => $row['email'],
            'password' => $row['password'],
            'usertype' => $row['usertype'],
            'Ma' => $row['Ma']
        ];
    }
}

// Đóng kết nối
$conn->close();

// Trả về dữ liệu dưới dạng JSON
echo json_encode($data);
