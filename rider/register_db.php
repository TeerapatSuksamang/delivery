<?php

    include_once '../config/db.php';
    if(isset($_POST)){
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $address = $_POST['address'];
        $phone = $_POST['phone'];
        
        // img upload
        $temp = explode('.' , $_FILES['img']['name']);
        $filename = rand() . '.' . end($temp);
        $filepath = "../upload/" . $filename;
        move_uploaded_file($_FILES['img']['tmp_name'], $filepath);

        // username check
        $select = "SELECT * FROM `rider` WHERE `username` = '$username' ";
        $result = mysqli_query($conn, $select);

        if(mysqli_num_rows($result) > 0){
            echo "<script>alert('ชื่อผู้ใช้ซ้ำ กรุณาเปลี่ยนใหม่'); window.location = 'register.php';</script>";
        } else {
            $sql = "INSERT INTO `rider`(`firstname`, `lastname`, `img`, `username`, `password`, `address`, `phone`, `status`)
            VALUES ('$firstname', '$lastname', '$filename', '$username', '$password', '$address', '$phone', 0) ";
            $result = mysqli_query($conn, $sql);

            if($result){
                echo "<script>alert('สมัครใช้งานเรียบร้อย'); window.location = 'login.php';</script>";
            } else {
                echo "<script>alert('เกิดข้อผิดพลาด'); window.location = 'register.php';</script>";
            }
        }
        
    }

?>