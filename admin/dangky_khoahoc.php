<?php
include 'security.php';
include 'includes/header.php';
include 'includes/navbar_student.php';

?>
<style>
    /* Korean Course */
    .heading {
        text-transform: uppercase;
        margin-top: 45px;
        margin-bottom: 40px;
        font-weight: 500;
    }

    .heading::after {
        content: "";
        width: 150px;
        background-color: #dc3545;
        margin: 0 auto;
        margin-top: 10px;
        display: block;
        height: 2px;
    }

    .course-box .img-course-box {
        display: block;
        position: relative;
        padding-bottom: 56.25%;
    }

    .course-box .img-course-box img {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .course-box-up {
        border: 1px solid #ccc;
        padding: 10px;
    }

    .course-box-down {
        border: 1px solid #ccc;
        border-top: none;
        padding: 10px;
    }

    .course-box .title-course-box {
        font-size: 14px;
        font-weight: bold;
        line-height: 22px;
        text-decoration: none;
        color: black;
        margin-bottom: 5px;
    }

    .title-course-box p {
        margin-top: 10px;
        margin-bottom: 0px;
    }

    .description-course-box p {
        margin-top: 0px;
        margin-bottom: 5px;
    }

    .course-box .price-course-box {
        font-weight: bold;
        font-size: 20px;
        display: block;
        color: #dc3545;
        line-height: 20px;
    }

    .course-box .price-course-box-through {
        font-size: 14px;
        color: #ccc;
        font-weight: bold;
        text-decoration: line-through;
    }

    .price-course-box small {
        font-style: italic;
        font-weight: bold;
        padding: 1px 2px;
        color: white;
        background-color: #dc3545;
        border-radius: 3px;
        font-size: 13px
    }

    .course-box-down .btn-detail-course-box {
        font-size: 20px;
        text-decoration: none;
        padding: 4px 6px;
        border-radius: 3px;
        background-color: #dc3545;
        color: white;
    }

    .course-box-down .btn-detail-course-box:hover {
        background-color: #dd081d;
    }
</style>
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
    <h1 class="h3 mb-2 text-gray-800">Danh sách Lớp Học có thể đăng ký</h1>

    <!-- DataTales Example -->
    <div class="korean-course">
        <div class="row" style="margin: auto;">
            <div class="card-body">
                <div class="row " style="margin: -10px 0;">
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
                    <?php

                    $query = "SELECT * FROM lichkhaigiang";
                    $query_run = mysqli_query($connection, $query);
                    ?>
                    <?php
                    if (mysqli_num_rows($query_run) > 0) {
                        $serial_number = 0;
                        while ($row = mysqli_fetch_assoc($query_run)) {
                            $serial_number++;
                    ?>
                            <div class="col-md-3" style="margin: 10px 0;">
                                <div class=" bg-white py-2 px-1 shadow-sm rounded  border">
                                    <a class="flex" href="lichKhaigiang.php?IDLich=<?= $row['IDLich'] ?>" style="text-decoration: none;">
                                        <div>
                                            <div style="width: 50px; height: 50px;">
                                                <img class="w-3" src="https://cdn-icons-png.flaticon.com/512/8818/8818517.png">
                                            </div>
                                        </div>
                                        <div style="margin: 0 10px ;">
                                            <div><?= $row['NgayBatDau'] ?></div>
                                            <div><?= $row['TenMon'] ?></div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                    <?php
                        }
                    } else {
                        echo "No record found";
                    }
                    ?>
                </div>

            </div>
        </div>


    </div>
</div>


<?php
include 'includes/scripts.php';
?>