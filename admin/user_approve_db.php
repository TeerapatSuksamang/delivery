<?php

    include_once '../config/db.php';
    if(isset($_GET['user_id'])){
        $user_id = $_GET['user_id'];

        $select = "SELECT * FROM `user` WHERE `user_id` = '$user_id' ";
        $result = mysqli_query($conn, $select);
        $row = mysqli_fetch_array($result);

        $status = 0;
        if($row['status'] == 0){
            $status = 1;
        }

        $sql = "UPDATE `user` SET 
        `status` = '$status'
        WHERE `user_id` = '$user_id' ";
        $result = mysqli_query($conn, $sql);

        if($result){
            echo "<script>alert('บันทึกข้อมูลเรียบร้อย'); window.location = 'user_approve.php';</script>";
        } else {
            echo "<script>alert('เกิดข้อผิดพลาด'); window.location = 'user_approve.php';</script>";
        }
    }

?>