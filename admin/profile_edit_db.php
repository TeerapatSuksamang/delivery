<?php

    include_once '../config/db.php';
    if(isset($_POST['submit'])){
        $admin_id = $_POST['admin_id'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $username = $_POST['username'];
        $address = $_POST['address'];
        $phone = $_POST['phone'];
        
        $temp = explode('.' , $_FILES['img']['name']);
        $filename = rand() . '.' . end($temp);
        $filepath = "../upload/" . $filename;

        if(move_uploaded_file($_FILES['img']['tmp_name'], $filepath)){
            $sql = "UPDATE `admin` SET 
            `firstname` = '$firstname',
            `lastname` = '$lastname',
            `img` = '$filename',
            `username` = '$username',
            `address` = '$address',
            `phone` = '$phone'
            WHERE `admin_id` = '$admin_id' ";
            $result = mysqli_query($conn, $sql);
        } else {
            $sql = "UPDATE `admin` SET 
            `firstname` = '$firstname',
            `lastname` = '$lastname',
            `username` = '$username',
            `address` = '$address',
            `phone` = '$phone'
            WHERE `admin_id` = '$admin_id' ";
            $result = mysqli_query($conn, $sql);
        }

        if($result){
            echo "<script>alert('แก้ไขข้อมูลเสร็จสิ้น'); window.location = 'profile.php';</script>";
        } else {
            echo "<script>alert('เกิดข้อผิดพลาด'); window.location = 'profile_edit.php';</script>";
        }
    }

?>