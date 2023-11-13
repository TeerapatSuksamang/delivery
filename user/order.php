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
            <div class="table-responsive">
                <table class="table table-hover table-bordered table-striped text-center shadow-sm"> 
                    <tr>
                        <th>เมนูอาหาร</th>
                        <th>รูปภาพ</th>
                        <th>ราคา</th>
                        <th>จำนวน</th>
                        <th>เพิ่ม - ลด</th>
                        <th>ราคารวม</th>
                        <!-- <th>ลบรายการ</th> -->
                    </tr>
                    <?php
                        if(isset($_GET['food_id'])){
                            $_SESSION['food_id'] = $_GET['food_id'];
                        }
                        $select = "SELECT * FROM `food` WHERE `food_id` = '".$_SESSION['food_id']."' ";
                        $result = mysqli_query($conn, $select);
                        $row_food = mysqli_fetch_array($result);
                    ?>
                    <tr valign="middle">
                        <td><?php echo $row_food['food_name']; ?></td>
                        <td>
                            <img src="../upload/<?php echo $row_food['img']; ?>" class="rounded" style="height: 100px;">
                        </td>
                        <!-- ราคา -->
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
                            <p style="color: red">ลดเหลือ <?php echo $new_price; ?> บาท</p> 
                            <?php } else { 
                                $new_price = $row_food['price'];
                                echo $row_food['price'];
                            ?>
                            บาท
                        <?php } ?>
                        </td>
                        <td>
                            <?php if(isset($_POST['plus'])){
                                $qty = $_POST['qty'];
                                (int)$qty += 1;
                            } else if(isset($_POST['reduce'])) {
                                $qty = $_POST['qty'];
                                (int)$qty -= 1;
                            } else {
                                $qty = 1;
                            }
                            echo $qty; 
                            $sumprice = $new_price * $qty;
                            ?>
                        </td>
                        <td>
                            <form action="order.php" method="post">
                                <input type="hidden" name="qty" value="<?php echo $qty; ?>">
                                <input type="submit" value="+" name="plus" class="btn btn-primary">
                                <?php if($qty > 1){ ?>
                                    <input type="submit" value="-" name="reduce" class="btn btn-warning">
                                <?php } ?>
                            </form>
                        </td>
                        <td><?php echo $sumprice ?> บาท</td>
                        <!-- <td>                        
                            <a href="" class="btn btn-outline-danger">ลบ</a>
                        </td> -->
                    </tr>
                    <!-- <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>ราคารวมทั้งสิ้น</td>
                        <td></td>
                        <td>บาท</td>   
                    </tr> -->
                </table>
            </div>
        </div>
    </div>

    <!-- กรอกข้อมูลสำหรับการส่งอาหาร -->
    <div class="container-fluid">
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                
                    <form action="insert_order.php" method="post">
                        <h1 class="text-center mb-3">ยืนยันข้อมูลสำหรับการส่งอาหาร</h1>
                        <?php
                            $select = "SELECT * FROM `user` WHERE `user_id` = '".$_SESSION['user_id']."'";
                            $result = mysqli_query($conn, $select);
                            $row = mysqli_fetch_array($result);
                        ?>

                        <!-- hidden sumprice -->
                        <input type="hidden" name="food_id" value="<?php echo $row_food['food_id']; ?>">
                        <input type="hidden" name="qty" value="<?php echo $qty; ?>">
                        <input type="hidden" name="sumprice" value="<?php echo $sumprice; ?>">
                        <input type="hidden" name="user_id" value="<?php echo $row['user_id']; ?>">
                        <input type="hidden" name="res_id" value="<?php echo $_SESSION['see_res_id']; ?>">

                        <label for="firstname" class="form-lable">ชื่อจริง</label>
                        <input type="text" class="form-control mb-3" name="firstname" value="<?php echo $row['firstname']; ?>">

                        <label for="lastname" class="form-lable">นามสกุล</label>
                        <input type="text" class="form-control mb-3" name="lastname" value="<?php echo $row['lastname']; ?>">

                        <label for="address" class="form-lable">ที่อยู่</label>
                        <input type="text" class="form-control mb-3" name="address" value="<?php echo $row['address']; ?>">

                        <label for="phone" class="form-lable">เบอร์โทร</label>
                        <input type="text" class="form-control mb-3" name="phone" value="<?php echo $row['phone']; ?>">

                        <div class="d-flex gap-3 mb-5">
                            <!-- <a href="see_restaurant.php" class="btn btn-primary w-50">สั่งอาหารเพิ่ม</a> -->
                            <input type="submit" value="ยืนยันการสั่งซื้อ" name="submit" class="btn btn-success w-100">
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

</body>
</html>