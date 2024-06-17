<?php
require("connect.php");
// Xử lý yêu cầu từ form khi được gửi đi
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ form
    try {
        $MaGV = $_POST["MaGV"];
        $MaLop = $_POST["MaLop"];

        // Chuẩn bị câu lệnh SQL để insert dữ liệu vào bảng tkb
        $sql = "INSERT INTO tkb (MaLop, MaGV) VALUES ('$MaLop', '$MaGV')";

        if ($conn->query($sql) === TRUE) {
            echo "Thêm dữ liệu thành công";
        } else {
            throw new Exception('lỗi');
        }
    } catch (Exception $e) {
        echo "Lỗi: " . $sql . "<br>" . $conn->error;
    }
}

// Đóng kết nối
$conn->close();
