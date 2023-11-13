<?php

    include_once '../config/db.php';
    if(isset($_POST['submit'])){
        $food_id = $_POST['food_id'];
        $discount = $_POST['discount'];

        $sql = "UPDATE `food` SET 
        `discount` = '$discount'
        WHERE `food_id` = '$food_id' ";
        $result = mysqli_query($conn, $sql);

        if($result){
            echo "<script>alert('บันทึกข้อมูลสำเร็จ'); window.location = 'index.php';</script>";
        } else {
            echo "<script>alert('เกิดข้อผิดพลาด'); window.location = 'add_food.php';</script>";
        }
    }

?>