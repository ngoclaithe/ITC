
<?php include 'head_f/header.php';
    include 'head_f/slide.php';
    $query = "SELECT * FROM tin_tuc";
          $query_run= mysqli_query($connection,$query);
?>

        <div class="container-fluid py-2">
             <div class="container">
             <ol class="breadcrumb p-0 mb-0">
                            <li class="breadcrumb-item"><a href="">Trang Chủ</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Khóa Học Tiếng Anh</li>
                </ol>
             </div>
         </div>   

         <div class="container-fluid pb-4">
             <div class="container">
                 <div class="row">
                    <div class="col-md-8 mb-2">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-body p-0">
                                            <ul class="list-group list-group-flush">
                                            
                                                <li class="list-group-item p-2"  style="background: #fefefe;">
                                                        <div class="large" >
                                                           <img class="mr-3 rounded" src="img/course-img/gt.png" alt="" style="width:200px;" align="left">
                                                            <div class="media-body" >
                                                            <a class="text-dark" href="tieng-anh-giao-tiep.php"><h5 class="mt-0 mb-0">TIẾNG ANH GIAO TIẾP</h5></a>
                                                            <p class="date-time hidden-xs hidden-sm"><i class="fa fa-calendar" aria-hidden="true"></i> <span>11-09-2017</span>
                                                            </p>
                                                                <p style="font-size:15px">Học Tiếng Anh giao tiếp để làm gì ? Trước tiên chúng ta phải xác định học Tiếng Anh giao tiếp để làm gì? Hẳn nhiều người sẽ tặc lưỡi...</p>
                                                            </div>
                                                        </div>
                                                </li>
                                                <li class="list-group-item p-2"  style="background: #fefefe;">
                                                        <div class="large" >
                                                           <img class="mr-3 rounded" src="img/course-img/kid.png" alt="" style="width:200px;" align="left">
                                                            <div class="media-body" >
                                                            <a class="text-dark" href="tieng-anh-tre-em.php"><h5 class="mt-0 mb-0">TIẾNG ANH TRẺ EM</h5></a>
                                                            <p class="date-time hidden-xs hidden-sm"><i class="fa fa-calendar" aria-hidden="true"></i> <span>11-09-2017</span>
                                                            </p>
                                                                <p style="font-size:15px">Chương trình English For Kid dành riêng cho trẻ từ 6 đến 12 tuổi, giáo trình"Family and Friends" tương đương các cấp độ...</p>
                                                            </div>
                                                        </div>
                                                </li>
                                                <li class="list-group-item p-2"  style="background: #fefefe;">
                                                        <div class="large" >
                                                           <img class="mr-3 rounded" src="img/course-img/toeic.png" alt="" style="width:200px;" align="left">
                                                            <div class="media-body" >
                                                            <a class="text-dark" href="on-thi-toeic.php"><h5 class="mt-0 mb-0">ÔN THI TOEIC CẤP TỐC</h5></a>
                                                            <p class="date-time hidden-xs hidden-sm"><i class="fa fa-calendar" aria-hidden="true"></i> <span>11-09-2019</span>
                                                            </p>
                                                                <p style="font-size:15px">Khóa học TOEIC 450+, 550+(Đảm bảo 100% đầu ra khi hoàn thành khóa học. Tại Việt Nam nói chung và tại Hải Phòng trong vòng 5 năm trở lại đây ...</p>
                                                            </div>
                                                        </div>
                                                </li>
                            </div>
                    
                        </div>
                     </div>
                    </div>
                
                <div class="col-md-4">
                <div class="card">
                                    <div class="card-header bg-white" style="border-top:3px solid red;"><h5>TIN TỨC NỔI BẬT</h5></div>
                                        <div class="card-body p-0">
                                            <ul class="list-group list-group-flush">
                                            <?php                                          
        
                                                while ($row=mysqli_fetch_assoc($query_run)) 
                                                { ?>  
                                                <li class="list-group-item p-2"  style="background: #fefefe;">
                                                        <div class="media">
                                                           <img class="mr-3 rounded" src="admin/anh_nhan_vien/<?=$row['img'] ?>" alt="" style="width:90px;">
                                                            <div class="media-body">
                                                            <a class="text-dark" href="tin-tucct.php?id=<?=$row['id'] ?>"><h6 class="mt-0 mb-0"><?php echo $row['TuaDe']; ?></h6></a>
                                                                
                                                            </div>
                                                        </div>
                                                </li>
                                                   <?php } ?>                                          
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
                $(document).ready(function () {
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
 