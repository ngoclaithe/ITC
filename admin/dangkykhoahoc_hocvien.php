<?php
include 'security.php';
include 'includes/header.php';
include_once '../model/connectdb.php';
$makh = $_GET['kh'];
$lopHoc = "SELECT * FROM lopmonhoc WHERE IDMonHoc = '" . $_GET['kh'] . "'";
$lopHoc = $conn->query($lopHoc)->fetch_assoc();
$hocSinh = "SELECT * FROM hoc_sinh  WHERE MaHocSinh= '" . $_SESSION['Ma'] . "' ";
$hocSinh = $conn->query($hocSinh)->fetch_assoc();
if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['hovaten']) && !empty($_POST['email'])) {
    $hovaten = $hocSinh['TenHocSinh'];
    $email = $_SESSION['email'];
    $dienthoai = $_POST['dienthoai'] ?? '';
    $gioitinh = $_POST['gioitinh'] ?? 0;
    $noisinh = $hocSinh['DiaChi'];
    $hocPhi  = $lopHoc['HocPhi'];
    $ngaySinh = $hocSinh['NgaySinh'];
    $maMon = $_GET['kh'];
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
    $vnp_Returnurl = "http://localhost:8080/ITC/thanks.php";

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
        header('Location:' . $vnp_Url);
        die();
    }

    // vui lòng tham khảo thêm tại code demo
}
include 'includes/navbar_student.php';

?>
<div class="container-fluid py-4" style="background: #f7f7f7;">
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <h1 class="text-danger">ĐĂNG KÝ LỘ TRÌNH HỌC TẬP</h1>
                <p><i>Hãy để lại thông tin của bạn, Trung Tâm tin học ITC sẽ giúp xây dựng lộ trình học kỹ năng tin học tốt nhất dành riêng cho bạn.</i></p>
                <?php
                $email = $_SESSION['email'];
                $query = "SELECT * FROM hoc_sinh  WHERE MaHocSinh= '" . $_SESSION['Ma'] . "' ";
                $query_run = mysqli_query($connection, $query);
                foreach ($query_run as $row) {
                ?>
            </div>
            <div class="col-md-5">
                <div class="card shadow-sm rounded">
                    <div class="card-body">
                        <h2>Đăng ký</h2>
                        <form action="dangkykhoahoc_hocvien.php?kh=<?php echo $_GET['kh'] ?>" method="POST" enctype=multipart/form-data>
                            <div class="form-group">
                                <label for="">học phí</label>
                                <input type="text" class="form-control" readonly name="text" value="<?= $lopHoc['HocPhi'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="text" class="form-control" readonly name="email" value="<?php echo $_SESSION['email'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="">Họ Và Tên</label>
                                <input type="text" class="form-control" name="hovaten" value="<?php echo $row['TenHocSinh'] ?>">
                            </div>

                            <div class="form-group">
                                <label for="">Số điện thoại</label>
                                <input type="text" class="form-control" name="" value="<?php echo $row['SDT'] ?? '' ?>">

                            </div>
                            <div class="form-group">
                                <label for="">Mã sinh viên </label>
                                <input type="text" class="form-control" name="trinhdohoc" value="<?php echo $row['MaHocSinh'] ?? '' ?>">
                            </div>
                            <div class="form-group">
                                <label for="">Khóa học</label>
                                <input type="text" class="form-control" readonly name="khoahoc" value="<?php echo $_GET['kh'] ?>">
                            </div>
                            <button class="btn btn-primary mt-4" name="redirect">đăng ký</button>
                        </form>
                    </div>
                </div>
            </div>
        <?php
                }
        ?>
        </div>
    </div>
</div>