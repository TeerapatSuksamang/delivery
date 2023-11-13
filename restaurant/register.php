<?php
    include_once '../config/db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>สมัครเป็นร้านอาหาร</title>

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
                <form action="register_db.php" class="card shadow p-4" method="post" enctype="multipart/form-data">
                    <h1 class="text-center mb-4">สมัครเป็นร้านอาหาร</h1>

                    <label for="" class="form-lable">ชื่อร้านอาหาร</label>
                    <input type="text" class="form-control mb-3" name="res_name" required>

                    <label for="" class="form-lable">ชื่อจริง</label>
                    <input type="text" class="form-control mb-3" name="firstname" required>

                    <label for="" class="form-lable">นามสกุล</label>
                    <input type="text" class="form-control mb-3" name="lastname" required>

                    <label for="" class="form-lable">รูปภาพ</label>
                    <input type="file" class="form-control mb-3" name="img">

                    <label for="" class="form-lable">ชื่อผู้ใช้</label>
                    <input type="text" class="form-control mb-3" name="username" required>

                    <label for="" class="form-lable">รหัสผ่าน</label>
                    <input type="password" class="form-control mb-3" name="password" required>

                    <label for="" class="form-lable">ที่อยู่</label>
                    <input type="text" class="form-control mb-3" name="address" required>

                    <label for="" class="form-lable">เบอร์โทรศัพท์</label>
                    <input type="tel" class="form-control mb-3" name="phone" required>

                    <label for="" class="form-lable">ประเภทร้านอาหาร</label>
                    <select name="res_type" class="form-select mb-3" placeholder="เลือกประเภทร้านอาหาร" required>
                        <option value="-">เลือกประเภทร้านอาหาร</option>
                        <?php
                            $select = "SELECT * FROM `restaurant_type` ";
                            $result = mysqli_query($conn, $select);
                            while($row = mysqli_fetch_array($result)){
                        ?>
                            <option value="<?php echo $row['res_type']; ?>"><?php echo $row['res_type']; ?></option>
                        <?php } ?>
                    </select>

                    <div class="d-flex gap-3">
                        <input type="submit" class="btn btn-success w-100" value="ยืนยัน" name="submit">
                        <a href="login.php" class="btn btn-danger w-100">ย้อนกลับ</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>