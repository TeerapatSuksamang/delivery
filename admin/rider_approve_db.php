<?php

    include_once '../config/db.php';
    if(isset($_GET['rider_id'])){
        $rider_id = $_GET['rider_id'];

        $select = "SELECT * FROM `rider` WHERE `rider_id` = '$rider_id' ";
        $result = mysqli_query($conn, $select);
        $row = mysqli_fetch_array($result);

        $status = 0;
        if($row['status'] == 0){
            $status = 1;
        }

        $sql = "UPDATE `rider` SET 
        `status` = '$status'
        WHERE `rider_id` = '$rider_id' ";
        $result = mysqli_query($conn, $sql);

        if($result){
            echo "<script>alert('บันทึกข้อมูลเรียบร้อย'); window.location = 'rid_approve.php';</script>";
        } else {
            echo "<script>alert('เกิดข้อผิดพลาด'); window.location = 'rid_approve.php';</script>";
        }
    }

?>