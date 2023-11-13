<?php
    include_once 'session.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Long Chim</title>
    <!-- bootstrap -->
    <link rel="stylesheet" href="../css/bootstrap/css/bootstrap.min.css">
    <!-- icon -->
    <link rel="stylesheet" href="../icon/bootstrap-icons.css">
    <!-- javascript -->
    <script src="../css/bootstrap/js/bootstrap.bundle.min.js"></script>
    <style>
        @font-face {
            font-family: "Prompt";
            src: url("../font/Prompt-Regular.ttf") format("truetype");
        }
        body {
            font-family: "Prompt";
        }
    </style>
</head>
<body>
    <!-- navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">Long Chim</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                </ul>
                <a href="index.php" class="btn btn-primary me-3">ย้อนกลับ</a>
                <a href="logout.php" class="btn btn-dark"> ออกจากระบบ</a>
            </div>
        </div>
    </nav>

    <!-- table -->
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-12">
                <center><h1 class="mb-3">เลือกรับรายการสั่งอาหาร</h1></center>
            </div>
            <div class="table-responsive">
                <table class="table table-hover table-bordered table-striped text-center shadow-sm"> 
                    <tr>
                        <th>ชื่อร้านอาหาร</th>
                        <th>ชื่อผู้สั่งอาหาร</th>
                        <th>ที่อยู่ผู้สั่งอาหาร</th>
                        <th>เบอร์โทรผู้สั่งอาหาร</th>
                        <th>ราคารวม</th>
                        <th width="25%">จัดการ</th>
                    </tr>
                    <?php
                        /* 
                            "เลือก ทั้งหมด (status จาก order_food) มาตั้งชื่อ collumn ใหม่ ว่า order_status,  
                            (firstname จาก order_food) มาตั้งชื่อ collumn ใหม่ว่า order_firstname
                            จากตาราง restaurant และ order_food ให้รวมกัน
                            เฉพาะ แถวที่ collumn id แล้วก้ไม่เข้าใจแล้ว ;( "
                        */
                        $sql = "SELECT *, order_food.status AS order_status, 
                        order_food.firstname AS order_firstname 
                        FROM `restaurant` INNER JOIN `order_food` 
                        ON restaurant.id = order_food.res_id WHERE res_id = '".$_GET['id']."'";
                        
                        $result = mysqli_query($conn, $sql);
                        while($row = mysqli_fetch_array($result)){ 
                            // ถ้า rider id = 0 และ order_status = 0
                            if($row['rider_id'] == 0 && $row['order_status'] == 0) {
                    ?>
                    <tr valign="middle">
                        <td><?php echo $row['res_name'];?></td>
                        <td><?php echo $row['order_firstname'];?></td>
                        <td><?php echo $row['address'];?></td>
                        <td><?php echo $row['phone'];?></td>
                        <td><?php echo $row['price'];?></td>
                        <td>
                            <a href="receive_order.php?id=<?php echo $row['id'];?>" class="btn btn-warning text-white mb-3">รับรายการสั่งอาหาร</a>
                        </td>
                    </tr>
                    <?php } } ?>
                </table>
            </div>
        </div>
</body>
</html>