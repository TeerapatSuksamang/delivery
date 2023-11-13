<?php

    include_once '../config/db.php';
    session_start();
    if(isset($_POST['submit'])){
        $username = $_POST['username'];
        $password = $_POST['password'];

        $select = "SELECT * FROM `admin` WHERE `username` = '$username' AND `password` = '$password' ";
        $result = mysqli_query($conn, $select);
        $row = mysqli_fetch_array($result);
        
        if(!empty($result)){
            $_SESSION['admin_id'] = $row['admin_id'];
            header("location: profile.php");
        } else {
            echo "<script>alert('ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง'); window.location = 'login.php';</script>";
        }
    }


?>