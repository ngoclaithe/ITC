<?php
include_once 'model/connectdb.php';
$sql_lopmonhoc = "SELECT * FROM lopmonhoc WHERE MaLop = '" . $_GET['malop'] . "'";
$result_lopmonhoc = $conn->query($sql_lopmonhoc)->fetch_assoc();
if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['hovaten']) && !empty($_POST['email']) == !empty($_POST['dienthoai']) && !empty($_POST['gioitinh'])) {
    // Truy vấn dữ liệu từ bảng lichkhaigiang

    $hovaten = $_POST['hovaten'];
    $email = $_POST['email'];
    $dienthoai = $_POST['dienthoai'];
    $gioitinh = $_POST['gioitinh'];
    $noisinh = $_POST['noisinh'];
    $hocPhi  = $result_lopmonhoc['HocPhi'];
    $ngaySinh = $_POST['ngaySinh'];
    $maMon = $result_lopmonhoc['MaLop'];
    $queryUpdate = "INSERT INTO thu_tien_hoc (
       so_tien,	ho_va_ten,ngay_sinh,noi_sinh,mail,ma_lop,so_dien_thoai,gioi_tinh	
      )
      VALUES
     ($hocPhi,'$hovaten',$ngaySinh, '$noisinh','$email','$maMon',' $dienthoai',$gioitinh)";
    $conn->query($queryUpdate);
    $lastInsertedId = $conn->insert_id;


    error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
    date_default_timezone_set('Asia/Ho_Chi_Minh');

    $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";

    //  đường dẫn khi đã thanh toán thành công
    $vnp_Returnurl = "http://localhost:80/ITC/thanks.php";

    // đăng test
    $vnp_TmnCode = "I5IP1R88"; //Mã website tại VNPAY 
    $vnp_HashSecret = "YRKFTDMDIOQTHGAMRTLGBYNEJLBCTBLH"; //Chuỗi bí mật


    $vnp_TxnRef = $lastInsertedId; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này 
    // sang VNPAY
    $vnp_OrderInfo = 'Thanh toán hóa đơn phí dich vụ';
    $vnp_OrderType = 'billpayment';
    $vnp_Amount = 10000 * 100;
    $vnp_Locale = 'vn';
    // $vnp_BankCode = 'NCB';
    $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
    //Add Params
    $inputData = array(
        "vnp_Version" => "2.1.0", //Phiên bản cũ là 2.0.0, 2.0.1 thay đổi sang 2.1.0
        "vnp_TmnCode" => $vnp_TmnCode,
        "vnp_Amount" => $vnp_Amount,
        "vnp_Command" => "pay",
        "vnp_CreateDate" => date('YmdHis'),
        "vnp_CurrCode" => "VND",
        "vnp_IpAddr" => $vnp_IpAddr,
        "vnp_Locale" => $vnp_Locale,
        "vnp_OrderInfo" => $vnp_OrderInfo,
        "vnp_OrderType" => $vnp_OrderType,
        "vnp_ReturnUrl" => $vnp_Returnurl,
        "vnp_TxnRef" => $vnp_TxnRef,
    );

    if (isset($vnp_BankCode) && $vnp_BankCode != "") {
        $inputData['vnp_BankCode'] = $vnp_BankCode;
    }

    ksort($inputData);
    $query = "";
    $i = 0;
    $hashdata = "";

    //Build querystring phiên bản mới 2.1.0

    foreach ($inputData as $key => $value) {
        if ($i == 1) {
            $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
        } else {
            $hashdata .= urlencode($key) . "=" . urlencode($value);
            $i = 1;
        }
        $query .= urlencode($key) . "=" . urlencode($value) . '&';
    }
    $vnp_Url = $vnp_Url . "?" . $query;
    if (isset($vnp_HashSecret)) {
        $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret); //  
        $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
    }

    if (isset($_POST['redirect'])) {
        header('Location: ' . $vnp_Url);
        die();
    }

    // vui lòng tham khảo thêm tại code demo

}



// Đóng kết nối
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <link rel="stylesheet" href="./style/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="./style/user.css">
    <link rel="stylesheet" href="./style/detail.css">
    <script src="./app/user.js"></script>
    <title>Document</title>
    <style>
        .custom-btn {
            color: #fff;
            /* Text color */
            background-color: #ff0000;
            /* Red color */
            border-color: #ff0000;
            /* Red color */
        }

        .custom-btn:hover {
            background-color: #cc0000;
            /* Darker red color on hover */
            border-color: #cc0000;
            /* Darker red color on hover */
        }
    </style>
</head>

<body>
    <div class="navbar1">
        <a href="#" class="home1" style="color: #fff;">Trang chủ</a>
        <div class="dropdown1">
            <button class="dropbtn1">Lịch khai giảng
                <i class="fa fa-caret-down"></i>
            </button>
            <div class="dropdown1-content">
                <div class="container1" id="listCalendar">
                </div>
            </div>
        </div>
    </div>
    <div class="container-custom">
        <div class="item-custom" style="margin-top: mt5;">
            <div class="col-md-12 item-main-custom">
                <form class="m-auto" style="max-width: 1000px; " action="checkout.php?malop=<?= $_GET['malop'] ?>" method="POST">
                    <h4>Mã lớp : <?= $result_lopmonhoc['MaLop'] ?> </h4>
                    <div class="d-flex gap-4">
                        <div class="col-6">
                            <div class="row mb-3">
                                <label for="hovaten" class="col-sm-3 col-form-label">Họ và tên</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="hovaten" id="hovaten" placeholder="Điền họ và tên">
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="row mb-3">
                                <label for="hovaten" class="col-sm-3 col-form-label">SĐT</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="dienthoai" id="dienthoai" placeholder="số điện thoại của bạn">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex gap-4 mt-4 ">
                        <div class="col-6">
                            <div class="row ">
                                <label for="hovaten" class="col-sm-3 col-form-label">giới tính</label>
                                <div class="col-sm-9">
                                    <div class="form-check float-start me-3 ">
                                        <input class="form-check-input" type="radio" name="gioitinh" value="1">
                                        <label class="form-check-label" for="gioitinh">
                                            nam
                                        </label>
                                    </div>
                                    <div class="form-check float-start">
                                        <input class="form-check-input" type="radio" name="gioitinh" value="2">
                                        <label class="form-check-label">
                                            nữ
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="row mb-3">
                                <label for="hovaten" class="col-sm-3 col-form-label">Mã ưu đải <br /> (nếu có)</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="discount" id="discount" placeholder="01MAGIAMGIA...">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex gap-4 mt-4 ">
                        <div class="col-6">
                            <div class="row mb-3">
                                <label for="hovaten" class="col-sm-3 col-form-label">Email</label>
                                <div class="col-sm-9">
                                    <input type="email" name="email" class="form-control" id="email" placeholder="Abc@gmail.com">
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="row mb-3">
                                <label for="hovaten" class="col-sm-3 col-form-label">nơi sinh</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="formGroupExampleInput2" name="noisinh">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex gap-4 mt-4 ">
                        <div class="col-6">
                            <div class="row mb-3">
                                <label for="hovaten" class="col-sm-3 col-form-label">ngày sinh</label>
                                <div class="col-sm-9">
                                    <input type="date" class="form-control" id="formGroupExampleInput" name="ngaySinh">
                                </div>
                            </div>
                        </div>
                    </div>
                    <p class="fs-5 mt-4 text-danger">Học phí : <?= number_format($result_lopmonhoc['HocPhi']) ?> </p>
                    <button class="btn btn-primary mt-4" name="redirect">Thanh toán vnpay</button>
                </form>
            </div>
        </div>
    </div>
</body>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</html>