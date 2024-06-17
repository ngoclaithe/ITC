<?php
include 'security.php';

include 'includes/header.php';
include 'includes/navbar_superadmin.php';
?>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<head>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons">
    <link rel="stylesheet"
        href="https://unpkg.com/bootstrap-material-design@4.1.1/dist/css/bootstrap-material-design.min.css"
        integrity="sha384-wXznGJNEXNG1NFsbm0ugrLFMQPWswR3lds2VeinahP8N0zJw9VWSopbjv2x7WCvX" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons">
</head>

<body>
    <div class="container mt-4">
        <div class="row">
            <div class="col-lg-8 col-md-10 ml-auto mr-auto">
                <h4><small>Thông tin lịch dạy</small></h4>
                <button type="button" class="btn btn-info btn-sm border bg-info text-white" data-toggle="modal"
                    data-target="#modalAdd">
                    Thêm mới
                    <!-- <i class="material-icons">add</i> -->
                </button>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="w-25">Ngày dạy</th>
                                <th class="w-25">Phòng dạy</th>
                                <th class="w-25">Ca học</th>
                                <th class="w-25">Hành động</th>
                            </tr>
                        </thead>
                        <tbody id="tBody">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="modalAdd" tabindex="-1" aria-labelledby="modalAddLabel" aria-hidden="true">
            <div style="padding-top: 10%;">
                <form onsubmit="handleAddSubmitLick(event)">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalAddLabel">Thêm mới lịch dạy</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group mt-3">
                                    <label>Ngày dạy</label>
                                    <input type="date" class="form-control" name="ngayday">
                                </div>
                                <div class="form-group mt-3">
                                    <label>Phòng dạy</label>
                                    <input type="text" class="form-control" name="phongday">
                                    <input type="text" class="form-control" value="<?php echo $_GET['idtkb']; ?>"
                                        name="idtkb" hidden>
                                </div>
                                <div class="mt-3">
                                    <label>Ca dạy</label>
                                    <select class="form-control" name="IDThoiGianHoc" id="IDThoiGianHoc">
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                                <button type="submit" class="btn btn-primary">Lưu</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="modalEditLabel" aria-hidden="true">
            <div style="padding-top: 10%;">
                <form onsubmit="handleEditSubmit(event)">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalEditLabel">Cập nhật lịch dạy</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group mt-3">
                                    <label>Ngày dạy</label>
                                    <input type="date" class="form-control" name="ngayday">
                                </div>
                                <div class="form-group mt-3">
                                    <label>Phòng dạy</label>
                                    <input type="text" class="form-control" name="phongday">
                                </div>
                                <div class="mt-3">
                                    <label>Ca dạy</label>
                                    <select class="form-control" name="IDThoiGianHoc" id="IDThoiGianHocEdit">
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                                <button type="submit" class="btn btn-primary">Lưu</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div style="padding-top: 10%;">
                <div class="modal-dialog">
                    <form id="deleteForm">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalUpdateLabel">Xóa thông tin lịch dạy</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>Bạn có chắc chắc muốn xóa bản ghi này?</p>
                                <p class="text-warning"><small>Hành động này không thể được hoàn tác.</small></p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                                <button type="submit" class="btn btn-primary">Xác nhận</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</body>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
</script>
<script src="https://unpkg.com/popper.js@1.12.6/dist/umd/popper.js"
    integrity="sha384-fA23ZRQ3G/J53mElWqVJEGJzU0sTs+SvzG8fXVWP+kJQ1lwFAOkcUOysnlKJC33U" crossorigin="anonymous">
</script>
<script src="https://unpkg.com/bootstrap-material-design@4.1.1/dist/js/bootstrap-material-design.js"
    integrity="sha384-CauSuKpEqAFajSpkdjv3z9t8E7RlpJ1UP0lKM/+NdtSarroVKu069AlsRPKkFBz9" crossorigin="anonymous">
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="quanlylichday.js"></script>