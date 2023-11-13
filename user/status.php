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
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <!-- icon -->
    <link rel="stylesheet" href="../bootstrap-icons.css">
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
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="index.php">หน้าหลัก</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="profile.php">ข้อมูลผู้ใช้งาน</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="status.php">สถานะการสั่งอาหาร</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="history.php">ประวัติการสั่งอาหาร</a>
                    </li>
                </ul>
                <a href="logout.php" class="btn btn-dark">ออกจากระบบ</a>
            </div>
        </div>
    </nav>

    <!-- table -->
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-12">
                <center><h1 class="mb-3">สถานะการสั่งอาหาร</h1></center>
            </div>
            <div class="table-responsive">
                <table class="table table-hover table-bordered table-striped text-center shadow-sm"> 
                    <tr>
                        <th>ชื่อร้านอาหาร</th>
                        <th>เมนูอาหาร</th>
                        <th>จำนวน</th>
                        <th>ที่อยู่ผู้สั่งอาหาร</th>
                        <th>เบอร์โทรผู้สั่งอาหาร</th>
                        <th>ราคารวม</th>
                        <th width="25%">สถานะ</th>
                    </tr>
                    <?php
                        $select = mysqli_query($conn, "SELECT * FROM `food_order` WHERE `status` < 5 AND `user_id` = '".$_SESSION['user_id']."' ");
                        while($row = mysqli_fetch_array($select)){
                            $select_food = mysqli_query($conn, "SELECT * FROM `food` WHERE `food_id` = '".$row['food_id']."' ");
                            $row_food = mysqli_fetch_array($select_food);
                            $select_res = mysqli_query($conn, "SELECT * FROM `restaurant` WHERE `res_id` = '".$row['res_id']."' ");
                            $row_res = mysqli_fetch_array($select_res);
                    ?>
                    <tr valign="middle">
                        <td><?php echo $row_res['res_name'];?></td>
                        <td>
                            <img src="../upload/<?php echo $row['food_img']; ?>" alt="" class="rounded" width="100px"><br>
                            <?php echo $row_food['food_name'];?>
                        </td>
                        <td><?php echo $row['quality'];?></td>
                        <td><?php echo $row['address'];?></td>
                        <td><?php echo $row['phone'];?></td>
                        <td><?php echo $row['sumprice'];?></td>

                        <!-- สถานะ
                        status = 1 ==> ร้านอาหารกำลังจัดทำอาหาร
                        status = 2 ==> ร้านอาหารทำอาหารเสร็จแล้ว
                        status = 3 ==> ผู้ส่งกำลังจัดส่งอาหาร
                        status = 4 ==> ผู้ส่งจัดส่งและชำระเงินเสร็จสิ้น -->

                        <td>
                            <?php if($row['status'] <= 2) { ?>
                                <p class="alert alert-info">ร้านอาหารกำลังจัดทำอาหาร</p>
                            <?php } if($row['status'] == 3) { ?>
                                <p class="alert alert-primary">ร้านอาหารทำอาหารเสร็จแล้ว</p>    
                            <?php } if($row['status'] == 4) { ?>
                                <p class="alert alert-secondary">ผู้ส่งกำลังจัดส่งอาหาร</p>
                            <?php } if($row['status'] == 5) { ?>
                                <p class="alert alert-success">ผู้ส่งจัดส่งและชำระเงินเสร็จสิ้น</p>
                            <?php } ?>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
    </div>
</body>
</html>