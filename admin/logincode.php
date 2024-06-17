<?php
include 'security.php';

if (isset($_POST['login_btn'])) {
    if (isset($_POST['g-recaptcha-response'])) {
        // bảo mật xss
        $email_login = htmlspecialchars($_POST['email']);
        $password_login = htmlspecialchars(md5($_POST['password']));

        // bảo mật recaptcha
        $captcha_response = $_POST['g-recaptcha-response'];
        $secret_key = "6Len1-QpAAAAACpDvn5gQ4m3-d1HLHDjJlhmtkMb";
        $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret_key&response=$captcha_response");
        $response_keys = json_decode($response, true);

        if (!$response_keys["success"]) {
            echo ("Bạn là robot" . '<br/>');
            die();
        } else {
            echo ("Bạn không phải roboot" . '<br/>');
        }


        $query = "SELECT * FROM register WHERE email = '$email_login' AND password = '$password_login'";
        $query_run = mysqli_query($connection, $query);
        $usertypes = mysqli_fetch_array($query_run);

        if ($usertypes) {
            // Đăng nhập thành công, lưu 'Ma' vào session
            $_SESSION['email'] = $email_login;
            $_SESSION['username'] = $usertypes['username'];
            $_SESSION['Ma'] = $usertypes['Ma'];

            // Chuyển hướng đến trang phù hợp với từng loại người dùng
            if ($usertypes['usertype'] == 'admin') {
                header('Location: index1.php');
            } elseif ($usertypes['usertype'] == 'ministry') {
                header('Location: index.php');
            } elseif ($usertypes['usertype'] == 'student') {
                header('Location: lop_hocst.php');
            } elseif ($usertypes['usertype'] == 'director') {
                header('Location: index_giamdoctrungtam.php');
            } elseif ($usertypes['usertype'] == 'teacher') {
                header('Location: diem_danhtc.php');
            }
        } else {
            $_SESSION['status'] = 'Email id / Password is Invalid';
            header('Location: login.php');
        }
    }
}
