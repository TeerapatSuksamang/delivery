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
    <link rel="stylesheet" href="../icon/bootstrap-icons.css">
    <!-- javascript -->
    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
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
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">Long Chim</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                </ul>
                <a href="see_restaurant.php" class="btn btn-primary me-3">ย้อนกลับ</a>
                <!-- <a href="logout.php" class="btn btn-dark"> ออกจากระบบ</a> -->
            </div>
        </div>
    </nav>

    <!-- ตะกร้าสั่งอาหารของคุณ -->
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-12">
                <center><h1 class="mb-3">สรุปรายการอาหาร</h1></center>
            </div>
            <!-- ฟอร์ม -->
            <form action="?act=update" method="post">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered table-striped text-center shadow-sm"> 
                        <tr>
                            <th>เมนูอาหาร</th>
                            <th>รูปภาพ</th>
                            <th>ราคา</th>
                            <th>จำนวน</th>
                            <th>ราคารวม</th>
                            <th>ลบรายการ</th>
                        </tr>
                        <?php

                            // รับค่าจากหน้า see restaurant
                            @$food_id = $_GET['food_id'];
                            $act = $_GET['act'];

                            // เพิ่ม
                            if($act == 'add' && !empty($food_id)){
                                if(isset($_SESSION['cart'][$food_id])) {
                                    // ถ้ามีอยู่แล้วให้บวกเพิ่ม
                                    $_SESSION['cart'][$food_id]++;
                                } else {
                                    // ถ้าไม่มีให้เป็น 1 อัตโนมัติ
                                    $_SESSION['cart'][$food_id] = 1;
                                }
                            }

                            // ลบทั้งหมด
                            if($act == 'remove' && !empty($food_id)){
                                unset($_SESSION['cart'][$food_id]);
                            }

                            // อัพเดท
                            if($act == 'update'){
                                $amount_array = $_POST["amount"];
                                foreach($amount_array as $food_id => $amount){
                                    $_SESSION['cart'][$food_id] = $amount;
                                }
                            }
                        ?>
                        <?php
                            $total = 0;
                            if(!empty($_SESSION['cart'])){
                                foreach($_SESSION['cart'] as $food_id => $food_qty){
                                    $select = "SELECT * FROM `food` WHERE `food_id` = '$food_id'";
                                    $result = mysqli_query($conn, $select);
                                    $row_food = mysqli_fetch_array($result);

                                    if($row_food['discount'] != 0 ){
                                        $price = $row_food['price'];
                                        $discount = $row_food['discount'];
                                        $new_discount = ($price * $discount) / 100;
                                        $new_price = $price - $new_discount;
                                    } else {
                                        $new_price = $row_food['price'];
                                    }

                                    $sum = $new_price * $food_qty;
                                    $total += $sum;
                                
                            ?>
                            <tr valign="middle">
                                <td><?php echo $row_food['food_name']; ?></td>

                                <td>
                                    <img src="../upload/<?php echo $row_food['img']; ?>" class="rounded" style="height: 100px;">
                                </td>

                                <!-- ราคา -->
                                <td><?php echo $new_price; ?></td>

                                <!-- ช่องกดเพิ่ม-ลด -->
                                <td><input type="number" class="form-control" min=1 name="amount[<?php echo $food_id?>]" value="<?php echo $food_qty; ?>"> </td>
                                
                                <td><?php echo $sum ?> บาท</td>
                                
                                <!-- ปุ่มลบ -->
                                <td><a class="btn btn-danger" href="order.php?food_id=<?php echo $food_id?>&act=remove">ลบ</td>
                            </tr>
                        <?php } ?>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>ราคารวมทั้งสิ้น</td>
                            <td><?php echo $total?> บาท</td>
                            <td></td>
                        </tr>
                        <?php } ?>
                    </table>
                    <a class="btn btn-warning w-25" href="see_restaurant.php">เลือกเพิ่ม</a> 
                    <input type="submit" class="btn btn-warning w-25" value="อัพเดทราคา">
                </div> 
            </form>
        </div>
    </div>
</body>
</html>