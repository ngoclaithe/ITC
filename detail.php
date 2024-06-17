<?php
// Kết nối đến cơ sở dữ liệu của bạn
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "adminpanel";
$port = 3306; // Default MySQL port

$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Truy vấn dữ liệu từ bảng lichkhaigiang
$sql_lichkhaigiang = "SELECT * FROM lichkhaigiang";
$result_lichkhaigiang = $conn->query($sql_lichkhaigiang);

// Truy vấn dữ liệu từ bảng monhoc
$sql_monhoc = "SELECT * FROM monhoc";
$result_monhoc = $conn->query($sql_monhoc);

// Truy vấn dữ liệu từ bảng lopmonhoc
$sql_lopmonhoc = "SELECT * FROM lopmonhoc";
$result_lopmonhoc = $conn->query($sql_lopmonhoc);

// Khởi tạo mảng lưu trữ dữ liệu từ cơ sở dữ liệu
$lichkhaigiang = [];
$monhoc = [];
$lopmonhoc = [];

// Lấy dữ liệu từ kết quả truy vấn và gán vào mảng tương ứng
if ($result_lichkhaigiang->num_rows > 0) {
    while ($row = $result_lichkhaigiang->fetch_assoc()) {
        $lichkhaigiang[] = $row;
    }
}

if ($result_monhoc->num_rows > 0) {
    while ($row = $result_monhoc->fetch_assoc()) {
        $monhoc[] = $row;
    }
}

if ($result_lopmonhoc->num_rows > 0) {
    while ($row = $result_lopmonhoc->fetch_assoc()) {
        $lopmonhoc[] = $row;
    }
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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="./style/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="./style/user.css">
    <link rel="stylesheet" href="./style/detail.css">
    <script src="./app/user.js"></script>
    <title>ITC</title>
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
                <div class="row" style="margin-bottom: 20px; padding-left: 10px;">
                    <div class="tieu-de-dang-ky">Anh/Chị đang chọn đăng ký online khóa học với thông tin như sau:</div>
                </div>
                <div class="row">
                    <div class="col-md-3 ">
                        <img style="width: 100%; max-height: 100px;" src="https://images.pexels.com/photos/20590852/pexels-photo-20590852/free-photo-of-co-d-n.jpeg?auto=compress&cs=tinysrgb&w=600&lazy=load">
                    </div>
                    <div class="col-md-8 col-xs-12">
                        <div class="thong-tin-mon">
                            <label style="font-weight: 500; width: 200px;">Môn học:</label>
                            <label id="monhoc" class="ten-mon-dang-ky" style="font-weight: bold; display: inline;">Ứng dụng CNTT cơ bản</label>
                        </div>
                        <div class="thong-tin-mon">
                            <label style="font-weight: 500; width: 200px;">Mã lớp:</label>
                            <label id="malop" class="ma-lop-dang-ky" style="font-weight: bold;">UDCB_293C246</label>
                        </div>
                        <div class="thong-tin-mon">
                            <label style="font-weight: 500; width: 200px;">Học phí (tạm tính):</label>
                            <label class="hoc-phi-old" style="display: none;"></label>
                            <label id="hocphi" class="hoc-phi-new" style="color: #000;">1.500.000 đ</label>
                        </div>
                        <div class="thong-tin-mon">
                            <label style="font-weight: 500; width: 200px;">Lịch học:</label>
                            <label id="lichhoc" class="lich-hoc-dang-ky" style="font-weight: bold; display: inline;">Thứ 2-4-6 (14:30 - 16:30) </label>
                        </div>
                        <div class="thong-tin-mon">
                            <label style="font-weight: 500; width: 200px;">Số buổi:</label>
                            <label id="sobuoi" class="ngay-khai-giang" style="font-weight: bold;">15 buổi</label>
                        </div>
                        <div class="thong-tin-mon">
                            <label style="font-weight: 500; width: 200px;">Khai giảng:</label>
                            <label id="ngaykhaigiang" class="ngay-khai-giang" style="font-weight: bold;">03/04/2024</label>
                        </div>
                        <div class="thong-tin-mon">
                            <label style="font-weight: 500; width: 200px;">Địa điểm:</label>
                            <label id="diadiemhoc" class="dia-diem-hoc" style="font-weight: bold;">227 Nguyễn Văn Cừ, Q.5</label>
                        </div>
                        <div class="thong-tin-mon">
                            <label style="font-weight: 500; width: 200px;">Tổng học phí (tạm tính):</label>
                            <label id="tonghocphi" class="tong-hoc-phi">1.500.000 đ</label>
                        </div>
                        <div class="thong-tin-mon">
                            <span style="font-style: italic;margin-top: 15px;display: block;">Anh/Chị vui lòng nhấn nút <strong>Tiếp
                                    tục</strong> để điền thông tin học viên và nhận ưu đãi học phí (nếu có)</span>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8 tiep-tuc text-center">
                        <a href="http://localhost/ITC/lichkhaigiang.php" class="btn btn-secondary custom-btn"><i class="fa fa-times" aria-hidden="true"></i> Hủy bỏ đăng ký</a>
                        <a href="checkout.php?malop=<?= $_GET['malop'] ?>" class="btn btn-success btn-next">Tiếp tục <i class="fa fa-forward btn-next" aria-hidden="true"></i></a>
                    </div>
                    <div class="col-md-2"></div>
                </div>

            </div>
        </div>
    </div>
</body>

<script>
    const lichKhaiGiangData = <?php echo json_encode($lichkhaigiang); ?>;
    const monHocData = <?php echo json_encode($monhoc); ?>;
    const lopMonHocData = <?php echo json_encode($lopmonhoc); ?>;

    window.onload = function() {
        var urlParams = new URLSearchParams(window.location.search);
        var maLop = urlParams.get('malop');
        let matchItem = lopMonHocData.find((i) => i?.MaLop === maLop);
        console.log(matchItem);
        if (matchItem) {
            let matchMonHoc = monHocData.find((i) => i?.IDMonHoc === matchItem?.IDMonHoc);
            if (matchMonHoc) {
                let data = {
                    ...matchItem,
                    ...matchMonHoc,
                };
                console.log(data);
                fillData(data);
            } else {
                console.error('Không tìm thấy thông tin môn học');
            }
        } else {
            console.error('Không tìm thấy thông tin lớp học');
        }
    };

    function fillData(data) {
        let monHocLabel = document.querySelector("#monhoc");
        let maLopLabel = document.querySelector("#malop");
        let hocPhiLabel = document.querySelector("#hocphi");
        let lichHocLabel = document.querySelector("#lichhoc");
        let ngayKhaiGiangLabel = document.querySelector("#ngaykhaigiang");
        let diaDiemHocLabel = document.querySelector("#diadiemhoc");
        let tongHocPhiLabel = document.querySelector("#tonghocphi");

        if (data) {
            console.log(data);
            monHocLabel.innerHTML = data?.TenMonHoc || '';
            maLopLabel.innerHTML = data?.MaLop || '';
            hocPhiLabel.innerHTML = formatter.format(data?.HocPhi) || '';
            ngayKhaiGiangLabel.innerHTML = data?.NgayKhaiGiang || '';
            diaDiemHocLabel.innerHTML = data?.DiaDiemHoc || '';
            tongHocPhiLabel.innerHTML = formatter.format(data?.HocPhi) || '';
            lichHocLabel.innerHTML = `Từ (${data?.ThoiGianBatDau}) đến (${data?.ThoiGianKetThuc})` || '';
        } else {
            console.error('Dữ liệu không hợp lệ');
        }
    }

    var formatter = new Intl.NumberFormat("vi-VN", {
        style: "currency",
        currency: "VND",
    });
</script>

</html>