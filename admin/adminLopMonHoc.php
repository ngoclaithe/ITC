<?php
include 'security.php';

include 'includes/header.php';
include 'includes/navbar_superadmin.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap CRUD Data Table for Database with Modal Form</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="./style/admin.css">

<body>
    <a href="./user.html">dasd</a>
    <div class="container">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6">
                        <h2>Quản lý <b>lớp </b></h2>
                    </div>
                    <div class="col-sm-6">
                        <a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Thêm mới lớp </span></a>
                    </div>
                </div>
            </div>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th style="min-width: 100px;">Mã lớp</th>
                        <th>Thời gian bắt đầu</th>
                        <th>Thời gian kết thúc</th>
                        <th>Ngày khai giảng</th>
                        <th>mon hoc</th>
                        <th>Địa điểm học</th>
                        <th>Số lượng học viên</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody id="body">

                </tbody>
            </table>
        </div>
    </div>
    <!-- Add Modal HTML -->
    <div id="addEmployeeModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form onsubmit="handleSubmitAdd(event)">
                    <div class="modal-header">
                        <h4 class="modal-title">Thêm lớp môn học</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Mã lớp</label>
                            <input type="text" class="form-control" name="MaLop" onchange="handleChange(event)">
                        </div>
                        <div class="form-group">
                            <label>Thời gian bắt đầu</label>
                            <input type="date" class="form-control" name="ThoiGianBatDau" onchange="handleChange(event)">
                        </div>
                        <div class="form-group">
                            <label>Thời gian kết thúc</label>
                            <input type="date" class="form-control" name="ThoiGianKetThuc" onchange="handleChange(event)">
                        </div>
                        <div class="form-group">
                            <label>Thời gian đăng ký</label>
                            <input type="date" class="form-control" name="ThoiGianDangKy" onchange="handleChange(event)">
                        </div>
                        <div class="form-group">
                            <label>Thời gian đóng đăng ký</label>
                            <input type="date" class="form-control" name="ThoiGianDongDangKy" onchange="handleChange(event)">
                        </div>
                        <div class="form-group">
                            <label>Số lượng học viên</label>
                            <input type="text" class="form-control" name="SoLuongHocVien" onchange="handleChange(event)">
                        </div>
                        <div class="form-group">
                            <label>Địa điểm học</label>
                            <input type="text" class="form-control" name="DiaDiemHoc" onchange="handleChange(event)">
                        </div>
                        <div class="form-group">
                            <label>Ngày khai giảng</label>
                            <input type="date" class="form-control" name="NgayKhaiGiang" onchange="handleChange(event)">
                        </div>
                        <div class="form-group">
                            <label>Học phí</label>
                            <input type="text" class="form-control" name="HocPhi" onchange="handleChange(event)">
                        </div>
                        <div class="form-group">
                            <label>Môn học</label>
                            <select class="form-control" name="IDLich" id="selectIDLichAdd">
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Hủy">
                        <input type="submit" class="btn btn-success" value="Lưu">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Edit Modal HTML -->
    <div id="editEmployeeModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form onsubmit="handleSubmitEdit(event)">
                    <div class="modal-header">
                        <h4 class="modal-title">Chỉnh sửa lớp môn học</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" value="">
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Mã lớp</label>
                                <input type="text" class="form-control" style="pointer-events: none;" name="MaLop" onchange="handleChange(event)">
                            </div>
                            <div class="form-group">
                                <label>Thời gian bắt đầu</label>
                                <input type="date" class="form-control" name="ThoiGianBatDau" onchange="handleChange(event)">
                            </div>
                            <div class="form-group">
                                <label>Thời gian kết thúc</label>
                                <input type="date" class="form-control" name="ThoiGianKetThuc" onchange="handleChange(event)">
                            </div>
                            <div class="form-group">
                                <label>Thời gian đăng ký</label>
                                <input type="date" class="form-control" name="ThoiGianDangKy" onchange="handleChange(event)">
                            </div>
                            <div class="form-group">
                                <label>Thời gian đóng đăng ký</label>
                                <input type="date" class="form-control" name="ThoiGianDongDangKy" onchange="handleChange(event)">
                            </div>
                            <div class="form-group">
                                <label>Số lượng học viên</label>
                                <input type="text" class="form-control" name="SoLuongHocVien" onchange="handleChange(event)">
                            </div>
                            <div class="form-group">
                                <label>Địa điểm học</label>
                                <input type="text" class="form-control" name="DiaDiemHoc" onchange="handleChange(event)">
                            </div>
                            <div class="form-group">
                                <label>Ngày khai giảng</label>
                                <input type="date" class="form-control" name="NgayKhaiGiang" onchange="handleChange(event)">
                            </div>
                            <div class="form-group">
                                <label>Học phí</label>
                                <input type="text" class="form-control" name="HocPhi" onchange="handleChange(event)">
                            </div>
                            <div class="form-group">
                                <label>Môn học</label>
                                <select class="form-control" name="IDLich" id="selectIDLichEdit">
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Hủy">
                        <input type="submit" class="btn btn-info" value="Lưu">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Delete Modal HTML -->
    <div id="deleteEmployeeModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="deleteForm">
                    <div class="modal-header">
                        <h4 class="modal-title">Xóa môn học</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <p>Bạn có chắc chắc muốn xóa bản ghi này?</p>
                        <p class="text-warning"><small>Hành động này không thể được hoàn tác.</small></p>
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Hủy">
                        <button type="submit" class="btn btn-danger">Xóa</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>

</html>
<script src="adminLopMonhoc.js"></script>