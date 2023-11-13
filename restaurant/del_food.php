<?php

    include_once '../config/db.php';
    if(isset($_GET['food_id'])){
        $id = $_GET['food_id'];

        $sql = "DELETE FROM `food` WHERE `food_id` = '$id' ";
        $result = mysqli_query($conn, $sql);

        if($result){
            echo "<script>alert('ลบข้อมูลสำเร็จ'); window.location = 'index.php';</script>";
        } else {
            echo "<script>alert('เกิดข้อผิดพลาด'); window.location = 'index.php';</script>";
        }
    }

?>