
<?php include 'head_f/header.php';
    include 'head_f/slide.php';
     $query = "SELECT * FROM tin_tuc";
          $query_run= mysqli_query($connection,$query);
?>

        <div class="container-fluid py-2">
             <div class="container">
             <ol class="breadcrumb p-0 mb-0">
                            <li class="breadcrumb-item"><a href="">Trang Chủ</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Khóa Học Tiếng Trung</li>
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
                                                           <img class="mr-3 rounded" src="img/course-img/trung.png" alt="" style="width:200px;" align="left">
                                                            <div class="media-body" >
                                                            <a class="text-dark" href="tieng-trung-so-cap.php"><h5 class="mt-0 mb-0">TIẾNG TRUNG SƠ CẤP</h5></a>
                                                            <p class="date-time hidden-xs hidden-sm"><i class="fa fa-calendar" aria-hidden="true"></i> <span>11-09-2019</span>
                                                            </p>
                                                                <p style="font-size:15px">Bạn đang tìm 1 trung tâm tiếng Trung tốt và uy tín tại quận Hải An Hải Phòng nhưng không biết đâu là địa chỉ phù hợp với mình giữa rất nhiều trung tâm ngoại ngữ trên địa bàn thành phố? Hãy đến với TOMATO để cảm nhận sự khác biệt vượt trội</p>
                                                            </div>
                                                        </div>
                                                </li>
                                                 <li class="list-group-item p-2"  style="background: #fefefe;">
                                                        <div class="large" >
                                                           <img class="mr-3 rounded" src="img/course-img/trungct.png" alt="" style="width:200px;" align="left">
                                                            <div class="media-body" >
                                                            <a class="text-dark" href="tieng-trung-cap-toc.php"><h5 class="mt-0 mb-0">TIẾNG TRUNG CẤP TỐC</h5></a>
                                                            <p class="date-time hidden-xs hidden-sm"><i class="fa fa-calendar" aria-hidden="true"></i> <span>11-09-2017</span>
                                                            </p>
                                                                <p style="font-size:15px">Bạn không muốn kéo dài việc học, luôn muốn tiếp xúc với tiesng Trung một cách nhanh và chính xác nhất. Hãy đến với trung tâm TOMATO Hải Phòng và đăng ký khóa học Tiếng Trung cấp tốc ... </p>
                                                            </div>
                                                        </div>
                                                </li>
                                                <li class="list-group-item p-2"  style="background: #fefefe;">
                                                        <div class="large" >
                                                           <img class="mr-3 rounded" src="img/course-img/trungghsk.png" alt="" style="width:200px;" align="left">
                                                            <div class="media-body" >
                                                            <a class="text-dark" href="on-thi-hsk.php"><h5 class="mt-0 mb-0">ÔN THI HSK</h5></a>
                                                            <p class="date-time hidden-xs hidden-sm"><i class="fa fa-calendar" aria-hidden="true"></i> <span>11-09-2019</span>
                                                            </p>
                                                                <p style="font-size:15px">HSK là Kỳ thi sát hạch trình độ tiếng Trung cho các đối tượng muốn đến Trung Quốc du ọc và làm việc tại Hỉa Phòng. Trung tâm tiếng Trung TOMATO Hải Phòng giới thiệu khóa học tiếng Trung ở Hải Phòng giúp cho học viên ... </p>
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
 