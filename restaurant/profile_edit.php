<?php
    include_once 'session.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขข้อมูล</title>

    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">

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
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                <form action="profile_edit_db.php" class="card shadow p-4" method="post" enctype="multipart/form-data">
                    <h1 class="text-center mb-3">แก้ไขข้อมูลร้านอาหาร</h1>
                    <?php
                        $res_id = $_SESSION['res_id'];
                        $select = "SELECT * FROM `restaurant` WHERE `res_id` = '$res_id' ";
                        $result = mysqli_query($conn, $select);
                        $row = mysqli_fetch_array($result);
                    ?>

                    <input type="hidden" name="res_id" value="<?php echo $res_id; ?>">

                    <label for="" class="form-lable">ชื่อร้านอาหาร</label>
                    <input type="text" class="form-control mb-3" name="res_name" value="<?php echo $row['res_name']; ?>" required>

                    <label for="" class="form-lable">ชื่อจริง</label>
                    <input type="text" class="form-control mb-3" name="firstname" value="<?php echo $row['firstname']; ?>" required>

                    <label for="" class="form-lable">นามสกุล</label>
                    <input type="text" class="form-control mb-3" name="lastname" value="<?php echo $row['lastname']; ?>" required>

                    <label for="" class="form-lable">รูปภาพ</label>
                    <center><img src="../upload/<?php echo $row['img']; ?>" class="rounded mb-3" style="width: 20vh; height: auto;"></center>
                    <input type="file" class="form-control mb-3" name="img">

                    <label for="" class="form-lable">ชื่อผู้ใช้</label>
                    <input type="text" class="form-control mb-3" name="username" value="<?php echo $row['username']; ?>">

                    <label for="" class="form-lable">ที่อยู่</label>
                    <input type="text" class="form-control mb-3" name="address" value="<?php echo $row['address']; ?>">

                    <label for="" class="form-lable">เบอร์โทรศัพท์</label>
                    <input type="tel" class="form-control mb-3" name="phone" value="<?php echo $row['phone']; ?>">

                    <label for="" class="form-lable">ประเภทร้านอาหาร</label>
                    <input type="tel" class="form-control mb-3" value="<?php echo $row['res_type']; ?>" readonly>

                    <div class="d-flex gap-3">
                        <input type="submit" class="btn btn-success w-100" value="ยืนยัน" name="submit">
                        <a href="profile.php" class="btn btn-danger w-100">ย้อนกลับ</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>