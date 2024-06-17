<?php
require("connect.php");

// Lấy ID của lớp môn học để xóa
$MaLop = $_POST['MaLop'];

// Xóa dữ liệu từ cơ sở dữ liệu
$sql = "DELETE FROM lopmonhoc WHERE MaLop='$MaLop'";

if ($conn->query($sql) === TRUE) {
    echo json_encode(array("status" => "success"));
} else {
    echo json_encode(array("status" => "error", "message" => $conn->error));
}

// Đóng kết nối
$conn->close();
?>
