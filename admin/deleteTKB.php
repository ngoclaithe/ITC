<?php
require("connect.php");
// Lấy id từ yêu cầu POST
$id = $_POST['id'];

// Chuẩn bị câu lệnh SQL
$sql = "DELETE FROM tkb WHERE idtkb=$id";

// Thực thi câu lệnh SQL
if ($conn->query($sql) === TRUE) {
    echo "Dữ liệu đã được xóa thành công";
} else {
    echo "Lỗi: " . $sql . "<br>" . $conn->error;
}

// Đóng kết nối
$conn->close();
?>
