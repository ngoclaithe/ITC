<?php
require("connect.php");
// Lấy dữ liệu từ biểu mẫu
$MaLop = $_POST['MaLop'];
$HocPhi = $_POST['HocPhi'];
$ThoiGianBatDau = $_POST['ThoiGianBatDau'];
$ThoiGianKetThuc = $_POST['ThoiGianKetThuc'];
$ThoiGianDangKy = $_POST['ThoiGianDangKy'];
$ThoiGianDongDangKy = $_POST['ThoiGianDongDangKy'];
$SoLuongHocVien = $_POST['SoLuongHocVien'];
$DiaDiemHoc = $_POST['DiaDiemHoc'];
$NgayKhaiGiang = $_POST['NgayKhaiGiang'];
$IDMonHoc = $_POST['IDMonHoc'];

// Thêm dữ liệu vào cơ sở dữ liệu
$sql = "INSERT INTO lopmonhoc (MaLop, HocPhi, ThoiGianBatDau, ThoiGianKetThuc, ThoiGianDangKy, ThoiGianDongDangKy, SoLuongHocVien, DiaDiemHoc, NgayKhaiGiang, IDMonHoc)
        VALUES ('$MaLop', '$HocPhi', '$ThoiGianBatDau', '$ThoiGianKetThuc', '$ThoiGianDangKy', '$ThoiGianDongDangKy', '$SoLuongHocVien', '$DiaDiemHoc', '$NgayKhaiGiang', '$IDMonHoc')";
try {
    if ($conn->query($sql) === TRUE) {
        echo json_encode(array("status" => "success",));
    } else {
        throw new Exception('không thành công');
    }
} catch (Exception $e) {
    echo json_encode(array("status" => "error", "message" => $conn->error));
}



// Đóng kết nối
$conn->close();
