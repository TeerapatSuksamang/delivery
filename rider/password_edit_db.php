<?php

    include_once 'session.php';
    if(isset($_POST['submit'])){
        $old_password = $_POST['old_password'];
        $new_password = $_POST['new_password'];
        
        $select = "SELECT * FROM `rider` WHERE `password` = '$old_password' ";
        $result = mysqli_query($conn, $select);
        $row = mysqli_fetch_array($result);

        if($row['password'] == $old_password){
            $sql = "UPDATE `rider` SET 
            `password` = '$new_password' 
            WHERE `rider_id` = '".$_SESSION['rider_id']."' ";
            $result = mysqli_query($conn, $sql);

            if($result){
                echo "<script>alert('เปลี่ยนรหัสผ่านสำเร็จ'); window.location = 'profile.php';</script>";
            } else {
                echo "<script>alert('เกิดข้อผิดพลาด'); window.location = 'password_edit.php';</script>";
            }
        } else {
            echo "<script>alert('รหัสผ่านเก่าไม่ถูกต้อง'); window.location = 'password_edit.php';</script>";
        }
    }

?>