<?php
require("connect.php");
// Truy vấn dữ liệu từ bảng thoi_gian_hoc
$sql_thoi_gian_hoc = "SELECT * FROM thoi_gian_hoc";
$result_thoi_gian_hoc = $conn->query($sql_thoi_gian_hoc);

// Truy vấn dữ liệu từ bảng tkb
$sql_tkb = "SELECT * FROM tkb";
$result_tkb = $conn->query($sql_tkb);

// Truy vấn dữ liệu từ bảng tkbdetails
$sql_tkb_details = "SELECT * FROM tkbdetails";
$result_tkb_details = $conn->query($sql_tkb_details);

// Khởi tạo mảng lưu trữ dữ liệu từ cơ sở dữ liệu
$data = [];

// Lấy dữ liệu từ kết quả truy vấn và gán vào mảng tương ứng
if ($result_thoi_gian_hoc->num_rows > 0) {
    $data['thoi_gian_hoc'] = [];
    while($row = $result_thoi_gian_hoc->fetch_assoc()) {
        $data['thoi_gian_hoc'][] = $row;
    }
}

if ($result_tkb->num_rows > 0) {
    $data['tkb'] = [];
    while($row = $result_tkb->fetch_assoc()) {
        $data['tkb'][] = $row;
    }
}

if ($result_tkb_details->num_rows > 0) {
    $data['tkbdetails'] = [];
    while($row = $result_tkb_details->fetch_assoc()) {
        $data['tkbdetails'][] = $row;
    }
}

// Đóng kết nối
$conn->close();

// Trả về dữ liệu dưới dạng JSON
echo json_encode($data);
?>
