<?php
require("connect.php");
// Kiểm tra xem có dữ liệu được gửi từ phía JavaScript hay không
if (isset($_POST['id'])) {
    $id = $_POST['id'];

    // Chuẩn bị truy vấn SQL để xóa dữ liệu
    $sql = "DELETE FROM tkbdetails WHERE idtkbdetails = $id";

    // Thực hiện truy vấn
    if ($conn->query($sql) === TRUE) {
        // Gửi phản hồi về cho JavaScript nếu xóa thành công
        echo "Xóa dữ liệu thành công!";
    } else {
        // Gửi phản hồi về cho JavaScript nếu xóa không thành công
        echo "Lỗi khi xóa dữ liệu: " . $conn->error;
    }
} else {
    // Nếu không có dữ liệu được gửi từ phía JavaScript, thông báo lỗi
    echo "Không có dữ liệu được gửi!";
}

// Đóng kết nối
$conn->close();
?>
