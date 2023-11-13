<?php
    include_once 'session.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>อนุมัติร้านอาหาร</title>

    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <script src="../bootstrap/js/bootstrap.min.js"></script>

    <style>
        @font-face {
            font-family: "Prompt";
            src: url("../font/Prompt-Regular.ttf") format("truetype");
        }
        body{
            font-family: "Prompt";
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
        <div class="container-fluid">
            <a href="" class="navbar-brand">Delivery</a>
            <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#hamburger">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="hamburger">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a href="profile.php" class="nav-link">ข้อมูลผู้ดูแลระบบ</a>
                    </li>
                    <li class="nav-item">
                        <a href="res_approve.php" class="nav-link active">อนุมัติร้านอาหาร</a>
                    </li>
                    <li class="nav-item">
                        <a href="rid_approve.php" class="nav-link">อนุมัติผู้ส่งอาหาร</a>
                    </li>
                    <li class="nav-item">
                        <a href="user_approve.php" class="nav-link">อนุมัติผู้ใช้งาน</a>
                    </li>
                </ul>
                <a href="logout.php" class="btn btn-danger">ออกจากระบบ</a>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <h1 class="text-center my-3">ประเภทร้านอาหาร</h1>
        <div class="row">
            <?php
                $select = "SELECT * FROM `restaurant_type` ";
                $result = mysqli_query($conn, $select);
                while($row = mysqli_fetch_array($result)){
            ?>
            <div class="col-lg-2 col-md-3 col-sm-4">
                <div class="card my-3">
                    <div class="card-img-top overflow-hidden" style="height: 200px;">
                        <img src="../upload/<?php echo $row['img'] ?>" class="w-100 h-100" style="object-fit: cover; object-position: center center;">
                    </div>
                    <div class="card-body text-center">
                        <h5 class="card-title"><?php echo $row['res_type']; ?></h5>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
        
        <div class="col-md-3 my-3">
             <a href="add_restaurant.php" class="btn btn-primary">เพิ่มประเภทร้านอาหาร</a>
        </div>
        <h1 class="mb-3">อนุมัติร้านอาหาร</h1>
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover text-center shadow">
                <tr>
                    <th>ชื่อร้านอาหาร</th>
                    <th>ชื่อจริง</th>
                    <th>นามสกุล</th>
                    <th>รูปภาพ</th>
                    <th>ชื่อผู้ใช้</th>
                    <th>ที่อยู่</th>
                    <th>เบอร์โทรศัพท์</th>
                    <th>จัดการ</th>
                </tr>

                <?php
                    $select = "SELECT * FROM `restaurant` ";
                    $result = mysqli_query($conn, $select);
                    while($row_res = mysqli_fetch_array($result)){
                ?>
                <tr>
                    <td><?php echo $row_res['res_name']; ?></td>
                    <td><?php echo $row_res['firstname']; ?></td>
                    <td><?php echo $row_res['lastname']; ?></td>
                    <td>
                        <img src="../upload/<?php echo $row_res['img']; ?>" class="rounded" width="100px">
                    </td>
                    <td><?php echo $row_res['username']; ?></td>
                    <td><?php echo $row_res['address']; ?></td>
                    <td><?php echo $row_res['phone']; ?></td>
                    <td>
                        <?php if($row_res['status'] == 0 ){ ?>
                            <a href="res_approve_db.php?res_id=<?php echo $row_res['res_id']; ?>" class="btn btn-success">อนุมัติ</a>
                        <?php } else { ?>
                            <a href="res_approve_db.php?res_id=<?php echo $row_res['res_id']; ?>" class="btn btn-danger">ยกเลิก</a>
                        <?php } ?>
                    </td>
                </tr>
                <?php } ?>
            </table>
        </div>
    </div>
</body>
</html>