<?php
    include_once 'session.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รีวิวอาหาร</title>

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
    <?php
        $res_id = $_GET['res_id'];
    ?>
<nav class="navbar navbar-expand-sm navbar-dark bg-dark">
        <div class="container-fluid">
            <a href="" class="navbar-brand">Delivery</a>
            <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#hamburger">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="hamburger">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                </ul>
                <a href="see_restaurant.php" class="btn btn-warning me-2">ย้อนกลับ</a>
                <a href="logout.php" class="btn btn-danger">ออกจากระบบ</a>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <h1 class="text-center mt-5">รีวิวอาหาร</h1>
    </div>

    <div class="container">
        <form action="review_db.php" class="card shadow p-4 mt-5" method="post">
            <?php
                $food_id = $_GET['food_id'];
            ?>
            <div class="d-flex my-3">
                <input type="text" class="form-control me-1" placeholder="เพิ่มรีวิวของคุณ" name="text">
                <input type="hidden" name="food_id" value="<?php echo $food_id ?>">
                <input type="hidden" name="res_id" value="<?php echo $res_id ?>">
                <button type="submit" class="btn btn-primary" name="submit">โพสต์</button>
            </div>
        </form>

        <h2 class="my-5">รีวิวของสมาชิกอื่นๆ</h2>
        <?php
            $select = "SELECT * FROM `review` WHERE `food_id` = '$food_id' ";
            $result_review = mysqli_query($conn, $select);
            while($row_review = mysqli_fetch_array($result_review)){
                $select = "SELECT * FROM `user` WHERE `user_id` = '".$row_review['user_id']."' ";
                $result = mysqli_query($conn, $select);
                $row_user = mysqli_fetch_array($result);
        ?>
        <div class="card shadow p-4 mb-3">
            <div class="display-inline">
                <img src="../upload/<?php echo $row_user['img'] ?>" class="rounded-circle" style="width: 60px; height: 60px; border: 1px solid black; display: inline;">
                <h5 class="" style="width: fit-content; display: inline;"><?php echo $row_user['username'] ?></h5>
            </div>
            <input type="text" class="form-control my-3" value="<?php echo $row_review['text']; ?>" readonly>
        </div>
        <?php } ?>
    </div>
</body>
</html>