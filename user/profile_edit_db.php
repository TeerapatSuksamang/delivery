<?php

    include_once '../config/db.php';
    if(isset($_POST['submit'])){
        $user_id = $_POST['user_id'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $username = $_POST['username'];
        $address = $_POST['address'];
        $phone = $_POST['phone'];
        
        // img upload
        $temp = explode('.' , $_FILES['img']['name']);
        $filename = rand() . '.' . end($temp);
        $filepath = "../upload/" . $filename;

        // username and res name check
        $select = "SELECT * FROM `user` WHERE `user_id` != '$user_id' AND `username` = '$username' ";
        $result = mysqli_query($conn, $select);

        if(mysqli_num_rows($result) > 0){
            echo "<script>alert('ชื่อผู้ใช้ซ้ำ กรุณาเปลี่ยนใหม่'); window.location = 'profile_edit.php';</script>";
        } else {
            if(move_uploaded_file($_FILES['img']['tmp_name'], $filepath)){
                $sql = "UPDATE `user` SET 
                `firstname` = '$firstname',
                `lastname` = '$lastname',
                `img` = '$filename',
                `username` = '$username',
                `address` = '$address',
                `phone` = '$phone'
                WHERE `user_id` = '$user_id' ";
                $result = mysqli_query($conn, $sql);
            } else {
                $sql = "UPDATE `user` SET 
                `firstname` = '$firstname',
                `lastname` = '$lastname',
                `username` = '$username',
                `address` = '$address',
                `phone` = '$phone'
                WHERE `user_id` = '$user_id' ";
                $result = mysqli_query($conn, $sql);
            }
    
            if($result){
                echo "<script>alert('แก้ไขข้อมูลเสร็จสิ้น'); window.location = 'profile.php';</script>";
            } else {
                echo "<script>alert('เกิดข้อผิดพลาด'); window.location = 'profile_edit.php';</script>";
            }
        }

        
    }

?>