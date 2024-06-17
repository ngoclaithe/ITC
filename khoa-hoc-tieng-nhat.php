
<?php include 'head_f/header.php';
    include 'head_f/slide.php';
     $query = "SELECT * FROM tin_tuc";
          $query_run= mysqli_query($connection,$query);
?>

        <div class="container-fluid py-2">
             <div class="container">
             <ol class="breadcrumb p-0 mb-0">
                            <li class="breadcrumb-item"><a href="">Trang Chủ</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Khóa Học Tiếng Nhật</li>
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
                                                           <img class="mr-3 rounded" src="img/course-img/nhat1.png" alt="" style="width:200px;" align="left">
                                                            <div class="media-body" >
                                                            <a class="text-dark" href="tieng-nhat-so-cap.php"><h5 class="mt-0 mb-0">TIẾNG NHẬT SƠ CẤP</h5></a>
                                                            <p class="date-time hidden-xs hidden-sm"><i class="fa fa-calendar" aria-hidden="true"></i> <span>11-09-2019</span>
                                                            </p>
                                                                <p style="font-size:15px">Trung tâm tiếng nhật tại hải phòng là trung tâm đào tạo ngoại ngữ bao gồm đào tạo tiếng anh, đào tạo tiếng hàn, đào tạo tiếng trung, đào tạo tiếng nhật....</p>
                                                            </div>
                                                        </div>
                                                </li>
                                                <li class="list-group-item p-2"  style="background: #fefefe;">
                                                        <div class="large" >
                                                           <img class="mr-3 rounded" src="img/course-img/nhatct.png" alt="" style="width:200px;" align="left">
                                                            <div class="media-body" >
                                                            <a class="text-dark" href="tieng-nhat-cap-toc.php"><h5 class="mt-0 mb-0">TIẾNG NHẬT CẤP TỐC</h5></a>
                                                            <p class="date-time hidden-xs hidden-sm"><i class="fa fa-calendar" aria-hidden="true"></i> <span>11-09-2019</span>
                                                            </p>
                                                                <p style="font-size:15px">Học tiếng Nhật là quá trình trau dồi kiến thức bao hàm tổng hợp từ vựng, ngữ pháp, giao tiếp qua nhiều bài học tiếng Nhật </p>
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
 