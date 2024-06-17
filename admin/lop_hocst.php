<?php
include 'security.php';
include 'includes/header.php';
include 'includes/navbar_student.php';
?>

<div class="modal fade" id="addadminprofile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>

    </div>
  </div>
</div>


<div class="container-fluid">
  <h1 class="h3 mb-2 text-gray-800">Danh sách Lớp Học</h1>

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">


    </div>

    <div class="card-body">

      <?php
      if (isset($_SESSION['success']) && $_SESSION['success'] != '') {
        echo '
              <div class="alert alert-success">
                ' . $_SESSION['success'] . '
              </div>';
        unset($_SESSION['success']);
      }

      if (isset($_SESSION['status']) && $_SESSION['status'] != '') {
        echo '
              <div class="alert alert-danger">
                ' . $_SESSION['status'] . '
              </div>';
        unset($_SESSION['status']);
      }
      ?>

      <div class="table-responsive">

        <?php

        $query = "SELECT * FROM lop_hoc   ORDER BY  Khoa_Hoc  ASC";
        $query_run = mysqli_query($connection, $query);
        ?>
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>STT </th>
              <th>Mã Lớp </th>
              <th>Mã Khóa Học </th>
              <th>Tên Lớp </th>
              <th>Giáo Viên </th>
              <th>Tình Trạng </th>
            </tr>
          </thead>
          <tbody>

            <?php
            if (mysqli_num_rows($query_run) > 0) {
              $serial_number = 0;
              while ($row = mysqli_fetch_assoc($query_run)) {
                $serial_number++;
            ?>
                <tr>
                  <td> <?php echo $serial_number; ?></td>
                  <td> <?php echo $row['MaLop']; ?></td>
                  <td> <?php echo $row['Khoa_Hoc']; ?></td>
                  <td> <?php echo $row['TenLop']; ?> </td>
                  <td> <?php echo $row['MaGV']; ?> </td>
                  <td> <?php echo $row['TinhTrang']; ?> </td>
                </tr>
            <?php
              }
            } else {
              echo "No record found";
            }
            ?>


          </tbody>
        </table>
        <?php

        $query = "SELECT * FROM tai_lieu";
        $query_run = mysqli_query($connection, $query);
        ?>
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <div class="row">
            <form action="" method="post">
              <div class="col-sm-12 col-md-6">
                <div id="dataTable_filter" class="dataTables_filter">
                  <label for="search">Tài liệu

                  </label>
                </div>
              </div>
            </form>
          </div>
          <thead align="center">
            <tr>
              <th>STT </th>
              <th>Tựa Đề </th>
              <th>Hình Ảnh </th>
              <th>Tóm Tắt</th>
              <th>URL </th>
            </tr>
          </thead>
          <tbody>

            <?php
            if (mysqli_num_rows($query_run) > 0) {
              $serial_number = 0;

              while ($row = mysqli_fetch_assoc($query_run)) {
                $serial_number++;

            ?>
                <tr>
                  <th><?php echo $serial_number; ?> </th>
                  <th><?php echo $row['TuaDe']; ?></th>
                  <td> <?php echo '<img src="anh_nhan_vien/' . $row['img'] . '" width="100px" height="100px" alt="Image">' ?>
                  </td>
                  <td> <?php echo $row['TomTat']; ?></td>
                  <td> <a href="<?php echo $row['url']; ?>">Link tải</a></td>
                </tr>
            <?php
              }
            } else {
              echo "No record found";
            }
            ?>



          </tbody>
        </table>

      </div>
    </div>
  </div>


  <?php
  include 'includes/scripts.php';
  include 'includes/footer.php';
  ?>