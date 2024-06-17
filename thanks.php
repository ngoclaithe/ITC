<?php
include_once 'model/connectdb.php';
$sql_lopmonhoc = "UPDATE thu_tien_hoc
SET trang_thai = 1
WHERE id = " . $_GET['vnp_TxnRef'];
$result_lopmonhoc = $conn->query($sql_lopmonhoc);


?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trungtam</title>
</head>

<body>
    Thanh toán thành công
</body>

</html>