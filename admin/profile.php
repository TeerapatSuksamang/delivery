<?php
    include_once 'session.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ข้อมูลผู้ดูแลระบบ</title>

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
                        <a href="profile.php" class="nav-link active">ข้อมูลผู้ดูแลระบบ</a>
                    </li>
                    <li class="nav-item">
                        <a href="res_approve.php" class="nav-link">อนุมัติร้านอาหาร</a>
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
        <h1 class="my-5">ข้อมูลผู้ดูแลระบบ</h1>
        <div class="table-responsive">
            <table class="table table-striped table-hover table-bordered shadow text-center">
                <tr>
                    <th>ชื่อจริง</th>
                    <th>นามสกุล</th>
                    <th>รูปภาพ</th>
                    <th>ชื่อผู้ใช้</th>
                    <th>ที่อยู่</th>
                    <th>เบอร์โทรศัพท์</th>
                    <th>จัดการ</th>
                </tr>

                <?php
                    $admin_id = $_SESSION['admin_id'];
                    $select = "SELECT * FROM `admin` WHERE `admin_id` = '$admin_id' ";
                    $result = mysqli_query($conn, $select);
                    $row = mysqli_fetch_array($result);
                ?>
                <tr>
                    <td><?php echo $row['firstname']; ?></td>
                    <td><?php echo $row['lastname']; ?></td>
                    <td>
                        <img src="../upload/<?php echo $row['img']; ?>" class="rounded" height="100px">
                    </td>
                    <td><?php echo $row['username']; ?></td>
                    <td><?php echo $row['address']; ?></td>
                    <td><?php echo $row['phone']; ?></td>
                    <td>
                        <a href="profile_edit.php" class="btn btn-warning">แก้ไขข้อมูล</a>
                        <a href="password_edit.php" class="btn btn-secondary">แก้ไขรหัสผ่าน</a>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</body>
</html>