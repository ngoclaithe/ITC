<?php include 'head_f/header.php';
include 'head_f/slide.php';
?>
<div class="container-fluid py-2">
    <div class="container">
        <ol class="breadcrumb p-0 mb-0">
            <li class="breadcrumb-item"><a href="index.php">Trang Chủ</a></li>
            <li class="breadcrumb-item"><a href="khoa-hoc-tieng-anh.php">Khóa Tin Học Văn Phòng Cơ Bản </a></li>
            <li class="breadcrumb-item active" aria-current="page">Tin Học Văn Phòng Cơ Bản</li>
        </ol>
    </div>
</div>

<div class="container-fluid pb-4">
    <div class="container">
        <div class="row">
            <div class="col-md-8 mb-2">
                <div class="card">
                    <div class="card-body">
                        <div class="blog-post">
                            <p></p>
                            <h1></h1>
                            <p></p>

                            <h2 style="text-align:center"><span style="font-size:32px; color: red">
                                    <strong>TIN HỌC VĂN PHÒNG CƠ BẢN</strong>
                                </span>
                            </h2>
                            <br>
                            <span style="font-size:16px; color: red"> <strong>1. </strong style="color: red">Đối tượng học cần học tin học văn phòng
                            </span>
                            <p style="font-size:16px">Những người bắt đầu học về kỹ năng văn phòng</p>
                            <p style="font-size:16px">Những người có nền tảng tin học nhất định, tuy nhiên kém về các kỹ năng sử dụng.</p>
                            <p style="font-size:16px">Những người muốn củng cố kỹ năng văn phòng, đặc biệt cách sử dụng máy tính.</p>
                            <span style="font-size:16px; color: red"> <strong>2. </strong>Chi tiết khóa học tiếng anh giao tiếp Hải Phòng
                            </span>
                            <p style="font-size:16px">Học phí: 3.000.000 đ/khóa</p>
                            <p style="font-size:16px">Thời gian học tập: 24 buổi</p>
                            <p style="font-size:16px">Giáo trình học tin học "new cutting edge", face to face.</p>
                            <span style="font-size:16px; color: red"> <strong>3. </strong>Lịch khai giảng và đăng ký khóa
                            </span>
                            <p><span style="font-size:16px"> <strong>+</strong>Được đăng ký học thử 1 - 2 buổi.
                                </span>
                                <br>
                                <span style="font-size:16px"> <strong>+</strong>Đăng ký và đóng học phí trước ngày khai giảng được giảm 5% học phí.
                                </span>
                                <br>
                                <span style="font-size:16px"> <strong>+</strong>Đăng ký nhóm từ 3 học viên trở lên được giảm ngay 10% học phí.
                                </span>
                                <br>
                            </p>
                            <br>
                            </p>
                            <br> <br>
                            <a href="luyen-thi-toeic.php" class="btn-detail-course-box">Đăng ký khóa học tại đây</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header bg-white" style="border-top:3px solid black;">
                        <h5>Các khóa học</h5>
                    </div>
                    <div class="card-body p-0">
                        <ul class="list-group list-group-flush">

                            <li class="list-group-item p-2" style="background: #fefefe;">
                                <div class="media">
                                    <img class="mr-3 rounded" src="img/course-img/gt.png" alt="" style="width:90px;">
                                    <div class="media-body">
                                        <a class="text-dark" href="tieng-anh-giao-tiep.php">
                                            <h6 class="mt-0 mb-0">Tin Học Văn Phòng Cơ Bản</h6>
                                        </a>
                                        <a name="" id="" class="btn  btn-link btn-sm p-0" href="tieng-anh-giao-tiep.php" role="button">Chi tiết</a>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item p-2" style="background: #fefefe;">
                                <div class="media">
                                    <img class="mr-3 rounded" src="img/course-img/kid.png" alt="" style="width:90px;">
                                    <div class="media-body">
                                        <a class="text-dark" href="tieng-anh-tre-em.php">
                                            <h6 class="mt-0 mb-0">Tin Học Văn Phòng Nâng Cao</h6>
                                        </a>
                                        <a name="" id="" class="btn  btn-link btn-sm p-0" href="tieng-anh-tre-em.php" role="button">Chi tiết</a>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item p-2" style="background: #fefefe;">
                                <div class="media">
                                    <img class="mr-3 rounded" src="img/course-img/toeic.png" alt="" style="width:90px;">
                                    <div class="media-body">
                                        <a class="text-dark" href="luyen-thi-toeic.php">
                                            <h6 class="mt-0 mb-0">Kỹ năng PowerPoint</h6>
                                        </a>
                                        <a name="" id="" class="btn  btn-link btn-sm p-0" href="luyen-thi-toeic.php" role="button">Chi tiết</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<?php
include 'head_f/footer.php';
?>


<script>
    $(document).ready(function() {
        $(".owl-carousel").owlCarousel({
            loop: true,
            margin: 30,
            responsive: {
                0: {
                    items: 1
                },
                1000: {
                    items: 4
                }
            }
        });
    });
</script>
<script src="OwlCarousel2-2.3.4/dist/owl.carousel.min.js"></script>