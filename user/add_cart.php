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
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
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
                <center><h1 class="mb-3">ตะกร้าสั่งอาหารของคุณ</h1></center>
            </div>
            <div class="table-responsive">
                <table class="table table-hover table-bordered table-striped text-center shadow-sm"> 
                    <tr>
                        <th>อันดับ</th>
                        <th>รายการอาหาร</th>
                        <th>รูปภาพ</th>
                        <th>ราคา</th>
                        <th>จำนวน</th>
                        <th>เพิ่ม - ลด</th>
                        <th>ราคารวม</th>
                        <th>ลบรายการ</th>
                    </tr>
                    <?php

                        $total = (int)0;
                        $sumprice = (int)0;
                        
                        for($i = 0 ; $i <= (int)$_SESSION['intLine'] ; $i++ ){
                            // loop ตำแหน่งแล้วเช็คว่า ไม่ใช่ ค่าว่างใช่ไหม
                            if($_SESSION['strProductID'][$i] != ''){
                                $sql = "SELECT * FROM `food` WHERE `food_id` = '".$_SESSION['strProductID'][$i]."' ";
                                $result_food = mysqli_query($conn, $sql);
                                $row_food = mysqli_fetch_array($result_food);

                                // ราคาที่มีส่วนลด
                                if($row_food['discount'] != 0){
                                    // ราคาใหม่ที่ลด
                                    $price = (int)$row_food['price'];
                                    $discount = (int)$row_food['discount'];
                                    $new_discount = ($price * $discount) / 100;
                                    (int)$new_price = $price - $new_discount;

                                    // เพิ่มข้อมูล
                                    $_SESSION['price'] = $new_price;
                                    $total = $_SESSION['strQty'][$i];
                                    $sum = $total * $new_price;
                                    $sumprice += $sum;
                                } else {
                                    // ราคารที่ไม่ได้ลด
                                    $price = (int)$row_food['price'];
                                    $total = $_SESSION['strQty'][$i];
                                    $sum = $total * $price;
                                    $sumprice += $sum;
                                }
                            
                    ?>
                    
                    <tr valign="middle">
                        <td><?php echo $i ?></td>
                        <td><?php echo $row_food['food_name']; ?></td>
                        <td>
                            <img src="../upload/<?php echo $row_food['food_name']; ?>" class="rounded-circle" style="width: 15vh; height: auto;">
                        </td>
                        <!-- ราคา -->
                        <td><?php echo $_SESSION['price']; ?> บาท</td>
                        <td><?php echo $_SESSION['strQty'][$i]; ?></td>
                        <td>
                            <a href="order_plus.php?food_id=<?php echo $row_food['food_id']; ?>" class="btn btn-success">+</a>
                            <?php if($_SESSION['strQty'][$i] > 1 ){ ?>
                                <a href="order_reduce.php?food_id=<?php echo $row_food['food_id']; ?>" class="btn btn-danger">-</a>
                            <?php } ?>
                            
                        </td>
                        <td><?php echo $sum ?> บาท</td>
                        <td>                        
                            <a href="order_delete.php?Line=<?php echo $i ?>" class="btn btn-outline-danger">ลบ</a>
                        </td>
                    </tr>
                    <?php }} ?>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>ราคารวมทั้งสิ้นน</td>
                        <td></td>
                        <td>บาท</td>   
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <!-- กรอกข้อมูลสำหรับการส่งอาหาร -->
    <div class="container-fluid">
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                
                    <form action="insert_order.php" method="post">
                        <h1 class="text-center mb-3">กรอกข้อมูลสำหรับการส่งอาหาร</h1>
                        <?php
                            $select = "SELECT * FROM `user` WHERE `user_id` = '".$_SESSION['user_id']."'";
                            $result = mysqli_query($conn, $select);
                            $row = mysqli_fetch_array($result);
                        ?>

                        <!-- hidden sumprice -->
                        <input type="hidden" name="sumprice" value="<?php echo $row['user_id']; ?>">

                        <label for="firstname" class="form-lable">ชื่อจริง</label>
                        <input type="text" class="form-control mb-3" name="firstname" value="<?php echo $row['firstname']; ?>">

                        <label for="lastname" class="form-lable">นามสกุล</label>
                        <input type="text" class="form-control mb-3" name="lastname" value="<?php echo $row['lastname']; ?>">

                        <label for="address" class="form-lable">ที่อยู่</label>
                        <input type="text" class="form-control mb-3" name="address" value="<?php echo $row['address']; ?>">

                        <label for="phone" class="form-lable">เบอร์โทร</label>
                        <input type="text" class="form-control mb-3" name="phone" value="<?php echo $row['phone']; ?>">

                        <div class="d-flex gap-3 mb-5">
                            <a href="see_restaurant.php" class="btn btn-primary w-50">สั่งอาหารเพิ่ม</a>
                            <input type="submit" value="ยืนยันการสั่งซื้อ" name="submit" class="btn btn-success w-50">
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

</body>
</html>