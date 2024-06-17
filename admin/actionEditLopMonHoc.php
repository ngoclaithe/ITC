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

// Cập nhật dữ liệu trong cơ sở dữ liệu
$sql = "UPDATE lopmonhoc SET 
        HocPhi='$HocPhi', 
        ThoiGianBatDau='$ThoiGianBatDau', 
        ThoiGianKetThuc='$ThoiGianKetThuc', 
        ThoiGianDangKy='$ThoiGianDangKy', 
        ThoiGianDongDangKy='$ThoiGianDongDangKy', 
        SoLuongHocVien='$SoLuongHocVien', 
        DiaDiemHoc='$DiaDiemHoc', 
        NgayKhaiGiang='$NgayKhaiGiang', 
        IDMonHoc='$IDMonHoc'
        WHERE MaLop='$MaLop'";

if ($conn->query($sql) === TRUE) {
    echo json_encode(array("status" => "success"));
    echo json_encode($sql);
} else {
    echo json_encode(array("status" => "error", "message" => $conn->error));
}

// Đóng kết nối
$conn->close();
?>
