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
                        <a href="profile.php" class="nav-link">ข้อมูลผู้ส่งอาหาร</a>
                    </li>
                </ul>
                <a href="logout.php" class="btn btn-danger">ออกจากระบบ</a>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row mt-5">
            <h1 class="text-center mb-3">ร้านอาหาร</h1>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="card mb-3">
                    <div class="card-img-top overflow-hidden" style="height: 300px;">
                        <img src="" class="w-100 h-100" style="object-fit: cover; object-position: center center;">
                    </div>
                    <div class="card-body text-center">
                        <h2 class="card-title"><?php  ?></h2>
                        <h5 class="card-text">ประเภทร้านอาหาร : <?php  ?></h5>
                        <p class="card-text">ที่อยู่ : <?php  ?> <br>
                            เบอร์โทรศัพท์ : <?php  ?>
                        </p>

                        <a href="see_restaurant.php" class="btn btn-warning">ดูร้านอาหาร</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>