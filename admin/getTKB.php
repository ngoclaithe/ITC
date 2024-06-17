<?php
session_start();
// Kết nối tới cơ sở dữ liệu

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

// Lấy dữ liệu từ bảng lich_hoc và thoi_gian_hoc
// Kiểm tra xem session có tồn tại không
if (isset($_SESSION['Ma'])) {
    if (isset($_SESSION['Ma']) && strpos($_SESSION['Ma'], 'GV') === 0) {
        $MaGV = $_SESSION['Ma'];
    } else {
        $MaGV = 'GV01';
    }
    $sql = "SELECT *, lichkhaigiang.TenMon AS TenMonHoc2, monhoc.IDLich, tkbdetails.ngayday, tkbdetails.phongday 
            FROM tkb
            JOIN lopmonhoc ON tkb.MaLop = lopmonhoc.MaLop
            JOIN monhoc ON lopmonhoc.IDMonHoc = monhoc.IDMonHoc
            JOIN lichkhaigiang ON monhoc.IDLich = lichkhaigiang.IDLich
            JOIN tkbdetails ON tkb.idtkb = tkbdetails.idtkb
            JOIN thoi_gian_hoc ON tkbdetails.idThoiGianHoc = thoi_gian_hoc.IDThoiGianHoc
            JOIN register ON tkb.MaGV = register.Ma
            WHERE tkb.MaGV = '$MaGV'
            ORDER BY thoi_gian_hoc.ThoiGian";
} else {

    echo "Phải login mới có thể xem!";
}



$result = $conn->query($sql);

// Khởi tạo mảng kết quả
$lich_hoc = array(
    'sang' => array(),
    'trua' => array(),
    'chieu' => array(),
    'toi' => array()
);

// Lặp qua các dòng kết quả và phân loại vào các mảng tương ứng
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Kiểm tra xem các khóa "ThoiGian" và "NgayHoc" có tồn tại không
        if (isset($row['ThoiGian']) && isset($row['ngayday'])) {
            $thoi_gian = $row['ThoiGian'];
            $date = date('d-m-Y', strtotime($row['ngayday']));

            switch ($thoi_gian) {
                case 'sang':
                    $lich_hoc['sang'][] = array(
                        'date' => $date,
                        'cv' => $row['TenMonHoc'],
                        'cvid' => $row['username'],
                        'phonghoc' => $row['phongday']
                    );
                    break;
                case 'trua':
                    $lich_hoc['trua'][] = array(
                        'date' => $date,
                        'cv' => $row['TenMonHoc'],
                        'cvid' => $row['username'],
                        'phonghoc' => $row['phongday']
                    );
                    break;
                case 'chieu':
                    $lich_hoc['chieu'][] = array(
                        'date' => $date,
                        'cv' => $row['TenMonHoc'],
                        'cvid' => $row['username'],
                        'phonghoc' => $row['phongday']
                    );
                    break;
                case 'toi':
                    $lich_hoc['toi'][] = array(
                        'date' => $date,
                        'cv' => $row['TenMonHoc'],
                        'cvid' => $row['username'],
                        'phonghoc' => $row['phongday']
                    );
                    break;
            }
        }
    }
}


// In kết quả dưới dạng JSON
echo json_encode($lich_hoc);

// Đóng kết nối
$conn->close();
