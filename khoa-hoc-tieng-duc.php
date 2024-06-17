
<?php include 'head_f/header.php';
    include 'head_f/slide.php';
     $query = "SELECT * FROM tin_tuc";
          $query_run= mysqli_query($connection,$query);
?>

        <div class="container-fluid py-2">
             <div class="container">
             <ol class="breadcrumb p-0 mb-0">
                            <li class="breadcrumb-item"><a href="">Trang Chủ</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Khóa Học Tiếng Đức</li>
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
                                                           <img class="mr-3 rounded" src="img/course-img/duc.png" alt="" style="width:200px;" align="left">
                                                            <div class="media-body" >
                                                            <a class="text-dark" href="tieng-duc-so-cap.php"><h5 class="mt-0 mb-0">TIẾNG ĐỨC SƠ CẤP</h5></a>
                                                            <p class="date-time hidden-xs hidden-sm"><i class="fa fa-calendar" aria-hidden="true"></i> <span>11-09-2019</span>
                                                            </p>
                                                                <p style="font-size:15px">Đức là một điểm đến tiềm năng cho cả việc kinh doanh và sinh sống với  mức sống khá cao. Sự công bằng và phúc lợi xã hội đóng vai trò là trụ cột trong cuộc  sống tại Đức. Tình trạng xung đột xã hội và tỉ lệ tội phạm khá thấp...</p>
                                                            </div>
                                                        </div>
                                                </li>
                                                <li class="list-group-item p-2"  style="background: #fefefe;">
                                                        <div class="large" >
                                                           <img class="mr-3 rounded" src="img/course-img/ducct.png" alt="" style="width:200px;" align="left">
                                                            <div class="media-body" >
                                                            <a class="text-dark" href="tieng-duc-cap-toc.php"><h5 class="mt-0 mb-0">TIẾNG ĐỨC CẤP TỐC</h5></a>
                                                            <p class="date-time hidden-xs hidden-sm"><i class="fa fa-calendar" aria-hidden="true"></i> <span>11-09-2019</span>
                                                            </p>
                                                                <p style="font-size:15px">Khoảng 1.530.000 kết quả(0,35 s) cho từ khóa "đào tạo tiếng Đức Hải Phòng". Bạn đang tìm lớp dạy tiếng Đức ở Hải Phòng, hay khóa tiếng Đức tại Hải Phòng chuyên nghiệp... </p>
                                                            </div>
                                                        </div>
                                                </li>
                                                <li class="list-group-item p-2"  style="background: #fefefe;">
                                                        <div class="large" >
                                                           <img class="mr-3 rounded" src="img/course-img/duconthi1.png" alt="" style="width:200px;" align="left">
                                                            <div class="media-body" >
                                                            <a class="text-dark" href="on-thi-duc.php"><h5 class="mt-0 mb-0">ÔN THI TIẾNG DỨC</h5></a>
                                                            <p class="date-time hidden-xs hidden-sm"><i class="fa fa-calendar" aria-hidden="true"></i> <span>21-09-2018</span>
                                                            </p>
                                                                <p style="font-size:15px">Luyện thi tiếng Đức ở Hải Phòng. Câu hỏi đặt ra ở đây ai là người học giỏi, làm bài tốt, không một ai thích làm thi mà chr biết một chút kiến thức nào cả, kết quả thi tiếng Đức ... </p>
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
 