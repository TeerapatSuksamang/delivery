<?php

    include_once '../config/db.php';
    if(isset($_GET['id'])){
        $id = $_GET['id'];

        $sql = "DELETE FROM `food_type` WHERE `food_type_id` = '$id' ";
        $result = mysqli_query($conn, $sql);

        if($result){
            echo "<script>alert('ลบข้อมูลสำเร็จ'); window.location = 'index.php';</script>";
        } else {
            echo "<script>alert('เกิดข้อผิดพลาด'); window.location = 'index.php';</script>";
        }
    }

?>