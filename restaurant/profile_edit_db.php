<?php

    include_once '../config/db.php';
    if(isset($_POST['submit'])){
        $res_id = $_POST['res_id'];
        $res_name = $_POST['res_name'];
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
        $select = "SELECT * FROM `restaurant` WHERE `res_id` != '$res_id' AND (`res_name` = '$res_name' AND `username` = '$username') ";
        $result = mysqli_query($conn, $select);

        if(mysqli_num_rows($result) > 0){
            echo "<script>alert('ชื่อร้านอาหาร หรือผู้ใช้ซ้ำ กรุณาเปลี่ยนใหม่'); window.location = 'register.php';</script>";
        } else {
            if(move_uploaded_file($_FILES['img']['tmp_name'], $filepath)){
                $sql = "UPDATE `restaurant` SET 
                `res_name` = '$res_name',
                `firstname` = '$firstname',
                `lastname` = '$lastname',
                `img` = '$filename',
                `username` = '$username',
                `address` = '$address',
                `phone` = '$phone'
                WHERE `res_id` = '$res_id' ";
                $result = mysqli_query($conn, $sql);
            } else {
                $sql = "UPDATE `restaurant` SET 
                `res_name` = '$res_name',
                `firstname` = '$firstname',
                `lastname` = '$lastname',
                `username` = '$username',
                `address` = '$address',
                `phone` = '$phone'
                WHERE `res_id` = '$res_id' ";
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