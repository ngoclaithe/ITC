<?php
require("connect.php");
// Lấy dữ liệu từ yêu cầu POST
$MaGV = $_POST['MaGV'];
$MaLop = $_POST['MaLop'];
$id = $_POST['id'];

// Chuẩn bị câu lệnh SQL
$sql = "UPDATE tkb SET MaGV='$MaGV', MaLop='$MaLop' WHERE idtkb=$id";

// Thực thi câu lệnh SQL
if ($conn->query($sql) === TRUE) {
    echo "Dữ liệu đã được cập nhật thành công";
} else {
    echo "Lỗi: " . $sql . "<br>" . $conn->error;
}

// Đóng kết nối
$conn->close();
?>
