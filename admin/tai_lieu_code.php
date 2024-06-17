<?php
include 'security.php';

// Set the connection character set to UTF-8
$connection->query("SET NAMES 'utf8'");

// Handle file upload function
function upload_file($file, $allowed_types, $upload_dir)
{
  $file_name = basename($file['name']);
  $file_type = pathinfo($file_name, PATHINFO_EXTENSION);
  $file_path = $upload_dir . $file_name;

  if (in_array($file_type, $allowed_types)) {
    if (move_uploaded_file($file["tmp_name"], $file_path)) {
      return $file_name;
    }
  }
  return false;
}

if (isset($_POST['add_tl'])) {
  $tua_de = mysqli_real_escape_string($connection, $_POST['tua_de']);
  $tom_tat = mysqli_real_escape_string($connection, $_POST['tom_tat']);
  $url = mysqli_real_escape_string($connection, $_POST['url']);
  $ma_nhan_vien = mysqli_real_escape_string($connection, $_POST['manv']);
  $allowed_types = ['jpg', 'jpeg', 'png', 'gif', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx'];

  $image = upload_file($_FILES['image'], $allowed_types, "anh_nhan_vien/");

  if ($image) {
    $query = "INSERT INTO tai_lieu (TuaDe, TomTat, url, img, MaNhanVien) VALUES ('$tua_de', '$tom_tat', '$url', '$image', '$ma_nhan_vien')";
    $query_run = mysqli_query($connection, $query);

    if ($query_run) {
      $_SESSION['success'] = "Thêm Thành Công";
      header('Location: tai_lieu.php');
    } else {
      $_SESSION['status'] = "Thêm Thất Bại";
      header('Location: tai_lieu.php');
    }
  } else {
    $_SESSION['status'] = "File không hợp lệ";
    header('Location: tai_lieu.php');
  }
}

if (isset($_POST['update_btn'])) {
  $id = mysqli_real_escape_string($connection, $_POST['edit_id']);
  $td = mysqli_real_escape_string($connection, $_POST['tuad']);
  $tt = mysqli_real_escape_string($connection, $_POST['tomt']);
  $ul = mysqli_real_escape_string($connection, $_POST['url']);
  $ma_nhan_vien = mysqli_real_escape_string($connection, $_POST['manv']);
  $allowed_types = ['jpg', 'jpeg', 'png', 'gif', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx'];

  $image = upload_file($_FILES['image'], $allowed_types, "anh_nhan_vien/");

  if ($image) {
    $query = "UPDATE tai_lieu SET TuaDe='$td', TomTat='$tt', url='$ul', img='$image', MaNhanVien='$ma_nhan_vien' WHERE id='$id'";
    $query_run = mysqli_query($connection, $query);

    if ($query_run) {
      $_SESSION['success'] = "Sửa Thành Công";
      header('Location: tai_lieu.php');
    } else {
      $_SESSION['status'] = "Sửa Thất Bại";
      header('Location: tai_lieu.php');
    }
  } else {
    $_SESSION['status'] = "File không hợp lệ";
    header('Location: tai_lieu.php');
  }
}

if (isset($_POST['delete_btn'])) {
  $id = mysqli_real_escape_string($connection, $_POST['delete_id']);

  $query = "DELETE FROM tai_lieu WHERE id='$id'";
  $query_run = mysqli_query($connection, $query);

  if ($query_run) {
    $_SESSION['success'] = "Xóa Thành Công";
    header('Location: tai_lieu.php');
  } else {
    $_SESSION['status'] = "Xóa Thất Bại";
    header('Location: tai_lieu.php');
  }
}

$output = '';

if (isset($_POST['query'])) {
  $search = mysqli_real_escape_string($connection, $_POST['query']);
  $stmt = $connection->prepare("SELECT * FROM tai_lieu WHERE TuaDe LIKE CONCAT('%', ?, '%')");
  $stmt->bind_param("s", $search);
} else {
  $stmt = $connection->prepare("SELECT * FROM tai_lieu");
}

$stmt->execute();
$result = $stmt->get_result();
$serial_number = 0;

if ($result->num_rows > 0) {
  $output .= '
    <div class="table-responsive">
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
    <thead align="center">
        <tr>
            <th>STT </th>
            <th>Tựa Đề </th>
            <th>Hình Ảnh </th>
            <th>Tóm Tắt</th>          
            <th>URL </th>
            <th>Mã Nhân Viên </th> 
        </tr>
    </thead>
    <tbody>';

  while ($row = $result->fetch_assoc()) {
    $serial_number++;
    $output .= '
        <tr>
            <td>' . $serial_number . '</td>
            <td>' . $row['TuaDe'] . '</td>
            <td><img src="anh_nhan_vien/' . $row['img'] . '" width="100px;" height="100px" alt="Image"></td>
            <td>' . $row['TomTat'] . '</td>               
            <td>' . $row['url'] . '</td>                 
            <td>' . $row['MaNhanVien'] . '</td>
        </tr>';
  }
  $output .= "</tbody></table></div>";
  echo $output;
} else {
  echo "<h3> No Records Found!</h3>";
}
