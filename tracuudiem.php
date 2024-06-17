<?php
include 'head_f/header.php';
include 'head_f/slide.php';
include 'admin/database/dbconfig.php';

// Handle form submission
$scores = null;
$error = null;
if (isset($_POST['submit'])) {
    $MaHocSinh = $_POST['MaHocSinh'];
    $MaCaHoc = $_POST['MaCaHoc'];

    $query_score = "SELECT DiemTK1, DiemTK2, DiemTK3, DiemGK, DiemCK FROM diem WHERE MaHocSinh = '$MaHocSinh' AND MaCaHoc = '$MaCaHoc'";
    $query_score_run = mysqli_query($connection, $query_score);

    if (mysqli_num_rows($query_score_run) > 0) {
        $scores = mysqli_fetch_assoc($query_score_run);
    } else {
        $error = "No results found.";
    }
}

$query = "SELECT * FROM gioi_thieu";
$query_run = mysqli_query($connection, $query);
?>

<div class="container-fluid py-2">
    <div class="container">
        <ol class="breadcrumb p-0 mb-0">
            <li class="breadcrumb-item"><a href="">Trang Chủ</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tra cứu điểm</li>
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
                            <?php while ($row = mysqli_fetch_assoc($query_run)) { ?>
                                <?php echo $row['Content']; ?>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-2">
                <div class="card">
                    <div class="card-body">
                        <h5>Tra cứu điểm</h5>
                        <form method="POST" action="">
                            <div class="form-group">
                                <label for="MaHocSinh">Mã Học Sinh</label>
                                <input type="text" class="form-control" id="MaHocSinh" name="MaHocSinh" required>
                            </div>
                            <div class="form-group">
                                <label for="MaCaHoc">Mã Ca Học</label>
                                <input type="text" class="form-control" id="MaCaHoc" name="MaCaHoc" required>
                            </div>
                            <button type="submit" name="submit" class="btn btn-primary">Tra cứu</button>
                        </form>

                        <?php if ($scores !== null) { ?>
                            <div class="mt-3">
                                <h6>Kết quả:</h6>
                                <p><strong>Điểm Word:</strong> <?php echo htmlspecialchars($scores['DiemTK1']); ?></p>
                                <p><strong>Điểm Excel:</strong> <?php echo htmlspecialchars($scores['DiemTK2']); ?></p>
                                <p><strong>Điểm Powerpoint:</strong> <?php echo htmlspecialchars($scores['DiemTK3']); ?></p>
                                <p><strong>Điểm GK:</strong> <?php echo htmlspecialchars($scores['DiemGK']); ?></p>
                                <p><strong>Điểm CK:</strong> <?php echo htmlspecialchars($scores['DiemCK']); ?></p>
                            </div>
                        <?php } elseif ($error !== null) { ?>
                            <div class="mt-3">
                                <h6>Kết quả:</h6>
                                <p><?php echo htmlspecialchars($error); ?></p>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<?php include 'head_f/footer.php'; ?>

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