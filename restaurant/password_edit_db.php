<?php

    include_once 'session.php';
    if(isset($_POST['submit'])){
        $res_id = $_SESSION['res_id'];
        $old_password = $_POST['old_password'];
        $new_password = $_POST['new_password'];
        
        $select = "SELECT * FROM `restaurant` WHERE `res_id` = '$res_id' ";
        $result = mysqli_query($conn, $select);
        $row = mysqli_fetch_array($result);

        if($old_password == $row['password']){
            $sql = "UPDATE `restaurant` SET 
            `password` = '$new_password'
            WHERE `res_id` = '$res_id' ";
            $result = mysqli_query($conn, $sql);

            if($result){
                echo "<script>alert('เปลี่ยนรหัสผ่านสำเร็จ'); window.location = 'profile.php';</script>";
            } else {
                echo "<script>alert('เเกิดข้อผิดพลาด'); window.location = 'password_edit.php';</script>";
            }
        } else {
            echo "<script>alert('รหัสผ่านเก่าไม่ถูกต้อง'); window.location = 'password_edit.php';</script>";
        }
    }

?>