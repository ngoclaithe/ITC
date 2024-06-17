<?php 
  include 'security.php';

  include 'includes/header.php';
  include 'includes/navbar_student.php';
 ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>time table - Bootdey.com</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">
    body {
        margin-top: 20px;
    }

    .bg-light-gray {
        background-color: #f7f7f7;
    }

    .table-bordered thead td,
    .table-bordered thead th {
        border-bottom-width: 2px;
    }

    .table thead th {
        vertical-align: bottom;
        border-bottom: 2px solid #dee2e6;
    }

    .table-bordered td,
    .table-bordered th {
        border: 1px solid #dee2e6;
    }


    .bg-sky.box-shadow {
        box-shadow: 0px 5px 0px 0px #00a2a7
    }

    .bg-orange.box-shadow {
        box-shadow: 0px 5px 0px 0px #af4305
    }

    .bg-green.box-shadow {
        box-shadow: 0px 5px 0px 0px #4ca520
    }

    .bg-yellow.box-shadow {
        box-shadow: 0px 5px 0px 0px #dcbf02
    }

    .bg-pink.box-shadow {
        box-shadow: 0px 5px 0px 0px #e82d8b
    }

    .bg-purple.box-shadow {
        box-shadow: 0px 5px 0px 0px #8343e8
    }

    .bg-lightred.box-shadow {
        box-shadow: 0px 5px 0px 0px #d84213
    }


    .bg-sky {
        background-color: #02c2c7
    }

    .bg-orange {
        background-color: #e95601
    }

    .bg-green {
        background-color: #5bbd2a
    }

    .bg-yellow {
        background-color: #f0d001
    }

    .bg-pink {
        background-color: #ff48a4
    }

    .bg-purple {
        background-color: #9d60ff
    }

    .bg-lightred {
        background-color: #ff5722
    }

    .padding-15px-lr {
        padding-left: 15px;
        padding-right: 15px;
    }

    .padding-5px-tb {
        padding-top: 5px;
        padding-bottom: 5px;
    }

    .margin-10px-bottom {
        margin-bottom: 10px;
    }

    .border-radius-5 {
        border-radius: 5px;
    }

    .margin-10px-top {
        margin-top: 10px;
    }

    .font-size14 {
        font-size: 14px;
    }

    .text-light-gray {
        color: #d6d5d5;
    }

    .font-size13 {
        font-size: 13px;
    }

    .table-bordered td,
    .table-bordered th {
        border: 1px solid #dee2e6;
    }

    .table td,
    .table th {
        padding: .75rem;
        vertical-align: top;
        border-top: 1px solid #dee2e6;
    }

    .min-h-50 {
        min-height: 50px;
    }
    </style>
</head>

<body>
    <div class="modal fade" id="addadminprofile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                </div>

            </div>
        </div>
    </div>


    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800">Lịch Học</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="container">
                    <button id="prev" type="button"
                        class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">Trước</button>
                    <button id="next" type="button"
                        class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">Sau</button>
                    <div class="table-responsive">
                        <table class="table table-bordered text-center">
                            <thead>
                                <tr class="bg-light-gray" id="headerRow">
                                </tr>
                            </thead>
                            <tbody>
                                <tr id="sangRow" class="min-h-50">
                                </tr>
                                <tr id="truaRow" class="min-h-50">
                                </tr>
                                <tr id="chieuRow" class="min-h-50">
                                </tr>
                                <tr id="toiRow" class="min-h-50">
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>



            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.30.1/moment.min.js"
        integrity="sha512-hUhvpC5f8cgc04OZb55j0KNGh4eh7dLxd/dPSJ5VyzqDWxsayYbojWyl5Tkcgrmb/RVKCRJI1jNlRbVP4WWC4w=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript"></script>
    <script src="app.js"></script>
</body>

</html>
<?php 
  include 'includes/scripts.php';
  include 'includes/footer.php';
   ?>