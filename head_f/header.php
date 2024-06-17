<?php
include 'admin/database/dbconfig.php';
$query = "SELECT * FROM thongtin_web";
$query_run = mysqli_query($connection, $query);
?>
<?php
// Kết nối đến cơ sở dữ liệu của bạn
$server_name = "localhost";
$db_username = "root";
$db_password = "";
$db_name = "adminpanel";
$port = 3306; // Default MySQL port

$conn = new mysqli($server_name, $db_username, $db_password, $db_name, $port);

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
$conn->close();
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <link REL="SHORTCUT ICON" HREF="admin/anh_nhan_vien/ITC.svg">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">
    <link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'>
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700,900&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
    <script src="js\fontawesome.js"></script>
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <link rel="stylesheet" href="OwlCarousel2-2.3.4/dist/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="OwlCarousel2-2.3.4/dist/assets/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/phantrang.css">
    <link rel="shortcut icon" type="image/jpg" href="img/logo-img/icon.jpg">
    <link rel="stylesheet" href="./style/user.css">
    <style>
    .breadcrumb {
        background-color: #ffffff
            /* box-shadow: 0 2px 3px rgb(209, 209, 209); */
    }

    .lienket {
        display: inline-block;
        padding: 5px 10px;
        color: #fff;
        background: red;
        margin: 10px 0;
        font-weight: 600;
    }

    .img-tua {
        text-align: center;
        font-size: 12px;
        color: red;
    }
    </style>
    <title>Trung Tâm Tin Học ITC</title>
</head>


<body data-spy="scroll" data-target="#navbarResponsive">

    <div id="home">

        <nav class="navbar navbar-expand-md navbar-white bg-white fixed-top">
            <?php while ($row = mysqli_fetch_assoc($query_run)) {
            ?>
            <a class="navbar-brand" href="index.php"> <img style="height:100px;transition: ease 0.3s;"
                    src="admin/anh_nhan_vien/<?= $row['logo'];  ?>" alt="logo"> </a>
            <?php } ?>

            <button class="navbar-toggler custom-toggler" type="button" data-toggle="collapse"
                data-target="#navbarResponsive">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarResponsive">
                <form class="form-inline my-2 my-lg-0" id="searchForm" onsubmit="return handleSearch(event)">
                    <input class="form-control mr-sm-2" type="search" placeholder="Tìm kiếm" aria-label="Search"
                        id="searchInput">
                </form>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item"><a class="nav-link" href="tracuudiem.php">Tra cứu điểm</a></li>

                    <div class="dropdown1">
                        <a href="/ITC/lichkhaigiang.php" class="nav-link">Lịch khai giảng
                            <i class="fa fa-caret-down"></i>
                        </a>
                        <div class="dropdown1-content">
                            <div class="container1" id="listCalendar">
                            </div>
                        </div>
                    </div>
                    <li class="nav-item"><a class="nav-link" href="index.php">Trang chủ</a></li>
                    <li class="nav-item"><a class="nav-link" href="gioithieu.php">Giới thiệu</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Chương Trình Đào tạo
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="khoa-hoc-tieng-anh.php">Khóa học tin học văn phòng</a>
                            <a class="dropdown-item" href="khoa-hoc-tieng-nhat.php">Khóa học powerpoint</a>
                        </div>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="tin-tuc.php">Tin Tức</a></li>
                    <li class="nav-item"><a class="nav-link" href="lien-he.php">Liên Hệ</a></li>
                </ul>
                <form class="form-inline my-2 my-lg-0" action="./admin/login.php">
                    <button class="btn btn-outline-danger my-2 my-sm-0" type="submit">Đăng nhập</button>
                </form>
                &nbsp;

                <!-- <form class="form-inline my-2 my-lg-0" action="./admin/signup.php">
              <button class="btn btn-outline-danger my-2 my-sm-0" type="submit">Đăng ký tài khoản</button>
            </form> -->
            </div>

            <script>
            function sanitizeInput(input) {
                // Remove potentially harmful characters
                var sanitized = input.replace(/[<>\/\\'";]/g, '');
                return sanitized;
            }

            function handleSearch(event) {
                event.preventDefault();
                var query = document.getElementById('searchInput').value;
                var sanitizedQuery = sanitizeInput(query).toLowerCase();

                if (sanitizedQuery.includes('tin tức')) {
                    window.location.href = 'tin-tuc.php';
                } else if (sanitizedQuery.includes('trang chủ')) {
                    window.location.href = 'index.php';
                } else if (sanitizedQuery.includes('giới thiệu')) {
                    window.location.href = 'gioithieu.php';
                } else if (sanitizedQuery.includes('liên hệ')) {
                    window.location.href = 'lien-he.php';
                } else if (sanitizedQuery.includes('tin học văn phòng')) {
                    window.location.href = 'khoa-hoc-tieng-anh.php';
                } else if (sanitizedQuery.includes('powerpoint')) {
                    window.location.href = 'khoa-hoc-tieng-nhat.php';
                } else {
                    alert('Không tìm thấy trang phù hợp!');
                }
            }
            </script>

        </nav>



    </div>
</body>
<script>
const lichkhaigiang = <?php echo json_encode($lichkhaigiang); ?>;
const monhoc = <?php echo json_encode($monhoc); ?>;
const lopmonhoc = <?php echo json_encode($lopmonhoc); ?>;

window.addEventListener("DOMContentLoaded", () => {
    fakeDbFc(lichkhaigiang);
});

const fakeDbFc = (value = []) => {
    let listCalendar = document.querySelector("#listCalendar"); // Sửa tên biến thành listCalendar
    let txt = "";
    value?.map((i) => {
        txt += `<div class="item1" data-id="${i.IDLich}">
                <div>
                    <div>
                        <img class="w-3" src="https://cdn-icons-png.flaticon.com/512/8818/8818517.png" />
                    </div>
                </div>
                <div>
                    <div>${i.NgayBatDau}</div>
                    <div>${i.TenMon}</div>
                </div>
            </div>`;
    });
    listCalendar.innerHTML = txt;

    document.querySelectorAll(".item1").forEach((item) => {
        item.addEventListener("click", () => {
            handleSetItem(item.dataset.id);
        });
    });
};

const handleSetItem = (id) => {
    let body = document.querySelector("#body");
    const matchItem = monhoc.filter((i) => String(i?.IDLich) === id);
    if (matchItem.length > 0) {
        let txt = "";
        matchItem?.map((i) => {
            txt += `
          <div>
            <div class="border-custom" data-toggle="collapse" data-target="#collapse-${
              i.IDMonHoc
            }" aria-expanded="false" aria-controls="collapse-${i.IDMonHoc}">
              ${i?.TenMonHoc}
            </div>
            <div class="collapse" id="collapse-${i.IDMonHoc}">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th style="min-width: 300px;">Lớp</th>
                        <th>Thời gian</th>
                        <th>Ngày khai giảng</th>
                        <th>Địa điểm học</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    
                  ${lopmonhoc
                    ?.filter((item) => item?.IDMonHoc === i.IDMonHoc)
                    .map((itemChild) => {
                      return `
                      <tr>
                        <td> ${itemChild?.MaLop}</td>
                        <td> ${itemChild?.ThoiGianDangKy}</td>
                        <td>${itemChild?.ThoiGianBatDau}</td>
                        <td>${itemChild?.DiaDiemHoc}</td>
                        <td><a href="/ITC/detail.php?malop=${itemChild?.MaLop}" class="btn btn-primary">Đăng ký</a></td>
                      </tr>
                    `;
                    })}
                </tbody>
              </table>
            </div>
          </div>
        `;
        });
        body.innerHTML = txt;
    } else {
        body.innerHTML = "Không có thông tin lớp môn học cho môn này";
    }
};
</script>