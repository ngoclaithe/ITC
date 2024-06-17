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
$conn->close();
?>

<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="./style/admin.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="./style/user.css">
  <!-- <script src="./app/user.js"></script> -->
</head>

<body style="background-color:white;">

  <div class="navbar1">
    <a href="/ITC" class="home1" style="color: #fff;">Trang chủ</a>
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
  <div style="padding: 10px 20%;">
    <div style="padding:16px">

    </div>
    <div style="padding:16px">
      <div id="body">

      </div>
    </div>


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

</html>