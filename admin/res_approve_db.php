<?php

    include_once '../config/db.php';
    if(isset($_GET['res_id'])){
        $res_id = $_GET['res_id'];
        echo 1;

        $select = "SELECT * FROM `restaurant` WHERE `res_id` = '$res_id' ";
        $result = mysqli_query($conn, $select);
        $row = mysqli_fetch_array($result);

        $status = 0;
        if($row['status'] == 0){
            $status = 1;
        }

        $sql = "UPDATE `restaurant` SET 
        `status` = '$status'
        WHERE `res_id` = '$res_id' ";
        $result = mysqli_query($conn, $sql);

        if($result){
            echo "<script>alert('บันทึกข้อมูลเรียบร้อย'); window.location = 'res_approve.php';</script>";
        } else {
            echo "<script>alert('เกิดข้อผิดพลาด'); window.location = 'res_approve.php';</script>";
        }
    }

?>