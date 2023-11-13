<?php

    include_once 'session.php';
    if(isset($_POST['submit'])){
        $user_id = $_SESSION['user_id'];
        $old_password = $_POST['old_password'];
        $new_password = $_POST['new_password'];
        
        $select = "SELECT * FROM `user` WHERE `user_id` = '$user_id' ";
        $result = mysqli_query($conn, $select);
        $row = mysqli_fetch_array($result);

        if($old_password == $row['password']){
            $sql = "UPDATE `user` SET 
            `password` = '$new_password'
            WHERE `user_id` = '$user_id' ";
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