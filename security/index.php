<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web Security Test</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://www.google.com/recaptcha/api.js"></script>
</head>
<style>
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 20px;
    display: flex;
    justify-content: space-around;
    align-items: center;
    width: 100%;
}

h1 {
    text-align: center;
}

form {
    width: 300px;
    margin: 0 auto;
}

label {
    font-weight: bold;
}

input[type="text"],
input[type="password"],
input[type="file"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
}

button {
    padding: 10px 20px;
    background-color: #007bff;
    color: #fff;
    border: none;
    cursor: pointer;
}

button:hover {
    background-color: #0056b3;
}
</style>


<body>

    <div>
        <h1>Form đã bảo mật</h1>
        <form action="" method="POST" enctype="multipart/form-data">
            <label for="username">Username:</label><br>
            <input type="text" id="username" name="username" required><br><br>
            <label for="password">Password:</label><br>
            <input type="password" id="password" name="password" required><br><br>
            <label for="file">Upload File:</label><br>
            <input type="file" id="file" name="file"><br><br>
            <button type="submit">Submit</button>
        </form>

    </div>
</body>
<?php
session_start();

if (isset($_POST['g-recaptcha-response'])) {
    // kiểm tra tấn công xss
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);

    echo   'username: ' . $username . '<br/>';
    echo   'password: ' . $password . '<br/>';


    // kiểm tra tấn công upload file
    if (isset($_FILES['file'])) {
        $file_name = $_FILES['file']['name'];
        $file_tmp = $_FILES['file']['tmp_name'];
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        $allowed_ext = array('jpg', 'jpeg', 'png', 'gif', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx');

        if (!in_array($file_ext, $allowed_ext)) {
            echo 'Chỉ các tệp Word, Excel, PowerPoint và hình ảnh được phép' . '<br/>';
        } else {


            move_uploaded_file($file_tmp, "uploads/" . $file_name);
            echo  'đã upload vào : ' . $file_name . '<br/>';
        }
    }

    // kiểm tra recaptcha
    $captcha_response = $_POST['g-recaptcha-response'];
    $secret_key = "6Len1-QpAAAAACpDvn5gQ4m3-d1HLHDjJlhmtkMb";
    $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret_key&response=$captcha_response");
    $response_keys = json_decode($response, true);
    if (!$response_keys["success"]) {
        echo ("Bạn là robot" . '<br/>');
    } else {
        echo ("Bạn không phải roboot" . '<br/>');
    }
    // kiểm sql injection
    $servername = "localhost";
    $username = "rooot";
    $password = "";
    $dbname = "security";

    $conn = mysqli_connect($servername, $username, $password, $dbname, 3306);

    if (!$conn) {
        die("Kết nối thất bại: " . mysqli_connect_error());
    }

    $username = $_POST['username'];
    $password = $_POST['password'];

    $username = mysqli_real_escape_string($conn, $username);
    $password = mysqli_real_escape_string($conn, $password);

    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        echo "đăng nhập thành công.";
    } else {
        echo "Không tìm thấy người dùng.";
    }
    mysqli_close($conn);
} ?>

</html>