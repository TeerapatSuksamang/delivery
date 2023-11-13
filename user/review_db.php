<?php

    include_once 'session.php';
    if(isset($_POST['submit'])){
        $user_id = $_SESSION['user_id'];
        $food_id = $_POST['food_id'];
        $res_id = $_POST['res_id'];
        $text = $_POST['text'];

        $sql = "INSERT INTO `review`(`user_id`, `food_id`, `text`)
        VALUES ('$user_id', '$food_id', '$text' )";
        $result = mysqli_query($conn, $sql);


        if($result){
            echo "<script>alert('เพิ่มความคิดเห็นแล้ว'); window.location = 'review.php?food_id=$food_id&res_id=1';</script>";
        } else {
            echo "<script>alert('เกิดข้อผิดพลาด'); window.location = 'review.php';</script>";
        }
    }

?>