<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>หน้าหลัก</title>

    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">

    <style>
        @font-face {
            font-family: "Prompt";
            src: url("font/Prompt-Regular.ttf") format("truetype");
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
                <form action="" class="card shadow p-4">
                    <h1 class="text-center mb-4">เข้าสู่ระบบ</h1>

                    <a href="user/login.php" class="btn btn-primary mb-3">ผู้ใช้งาน(User)</a>
                    <a href="restaurant/login.php" class="btn btn-primary mb-3">ร้านอาหาร(Resstaurant)</a>
                    <a href="rider/login.php" class="btn btn-primary mb-3">ผู้ส่งอาหาร(Rider)</a>
                    <a href="admin/login.php" class="btn btn-primary mb-3">ผู้ดูแลระบบ(Admin)</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>