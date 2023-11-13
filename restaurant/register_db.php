<?php

    include_once '../config/db.php';
    if(isset($_POST)){
        $res_name = $_POST['res_name'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $address = $_POST['address'];
        $phone = $_POST['phone'];
        $res_type = $_POST['res_type'];
        
        // img upload
        $temp = explode('.' , $_FILES['img']['name']);
        $filename = rand() . '.' . end($temp);
        $filepath = "../upload/" . $filename;
        move_uploaded_file($_FILES['img']['tmp_name'], $filepath);

        // username and res name check
        $select = "SELECT * FROM `restaurant` WHERE `res_name` = '$res_name' AND `username` = '$username' ";
        $result = mysqli_query($conn, $select);

        if(mysqli_num_rows($result) > 0){
            echo "<script>alert('ชื่อร้านอาหาร หรือผู้ใช้ซ้ำ กรุณาเปลี่ยนใหม่'); window.location = 'register.php';</script>";
        } else {
            $sql = "INSERT INTO `restaurant`(`res_name`, `firstname`, `lastname`, `img`, `username`, `password`, `address`, `phone`, `res_type`, `status`)
            VALUES ('$res_name', '$firstname', '$lastname', '$filename', '$username', '$password', '$address', '$phone', '$res_type', 0) ";
            $result = mysqli_query($conn, $sql);

            if($result){
                echo "<script>alert('สมัครร้านอาหารเรียบร้อย'); window.location = 'login.php';</script>";
            } else {
                echo "<script>alert('เกิดข้อผิดพลาด'); window.location = 'register.php';</script>";
            }
        }
        
    }

?>