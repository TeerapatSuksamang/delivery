<?php
    include_once 'session.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>หน้าหลัก</title>

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
                        <a href="index.php" class="nav-link active">หน้าหลัก</a>
                    </li>
                    <li class="nav-item">
                        <a href="profile.php" class="nav-link">ข้อมูลร้านอาหาร</a>
                    </li>
                </ul>
                <a href="add_food.php" class="btn btn-primary">เพิ่มรายการอาหาร</a>
                <a href="add_food_type.php" class="btn btn-primary mx-2">สร้างหมวดหมู่อาหาร</a>
                <a href="logout.php" class="btn btn-danger">ออกจากระบบ</a>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row mt-5">
            <?php
                $res_id = $_SESSION['res_id'];
                $select = "SELECT * FROM `food_type` WHERE `res_id` = '$res_id' ";
                $result = mysqli_query($conn, $select);
                while($row = mysqli_fetch_array($result)){
            ?>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="card mb-3">
                    <div class="card-img-top overflow-hidden" style="height: 300px;">
                        <img src="../upload/<?php echo $row['img']; ?>" class="w-100 h-100" style="object-fit: cover; object-position: center center;">
                    </div>
                    <div class="card-body text-center">
                        <h5><?php echo $row['food_type'] ?></h5>
                        <a href="del_food_type.php?id=<?php echo $row['food_type_id']; ?>" class="btn btn-outline-danger">ลบหมวดหมู่อาหาร</a>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>

        <h1 class="text-center my-3">รายการอาหาร</h1>
        <div class="table-responsive">
            <table class="table table-striped table-hover table-bordered text-center shadow">
                <tr>
                    <th>ชื่ออาหาร</th>
                    <th>รูปภาพ</th>
                    <th>ราคา</th>
                    <th>หมวดหมู่อาหาร</th>
                    <th>จัดการ</th>
                </tr>

                <?php
                    $select = "SELECT * FROM `food` WHERE `res_id` = '$res_id' ";
                    $result = mysqli_query($conn, $select);
                    while($row_food = mysqli_fetch_array($result)){
                ?>
                <tr>
                    <td><?php echo $row_food['food_name']; ?></td>
                    <td>
                        <img src="../upload/<?php echo $row_food['img']; ?>" class="rounded" width="100px">
                    </td>
                    <td>
                        <?php
                            if($row_food['discount'] != 0 ){
                                $price = $row_food['price'];
                                $discount = $row_food['discount'];
                                $new_discount = ($price * $discount) / 100;
                                $new_price = $price - $new_discount;
                        ?>
                        <?php echo $price; ?> บาท <br>
                        ส่วนลด <?php echo $discount; ?> % <br>
                        <p style="color: red;"> ลดเหลือ <?php echo $new_price; ?> บาท</p>
                        <?php } else { echo $row_food['price']; ?> 
                        บาท
                        <?php } ?>
                    </td>
                    <td><?php echo $row_food['food_type']; ?></td>
                    <td>
                        <a href="food_edit.php?food_id=<?php echo $row_food['food_id']; ?>" class="btn btn-warning">แก้ไข</a>
                        <a href="food_discount.php?food_id=<?php echo $row_food['food_id']; ?>" class="btn btn-primary">ส่วนลด</a>
                        <a href="del_food.php?food_id=<?php echo $row_food['food_id']; ?>" class="btn btn-danger">ลบ</a>
                    </td>
                </tr>
                <?php } ?>
            </table>
        </div>
    </div>
</body>
</html>