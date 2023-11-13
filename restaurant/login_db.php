<?php

    include_once '../config/db.php';
    if(isset($_POST['submit'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        $select = "SELECT * FROM `restaurant` WHERE `username` = '$username' AND `password` = '$password' ";
        $result = mysqli_query($conn, $select);
        $row = mysqli_fetch_array($result);

        if(!empty($result)){
            if($row['status'] == 0 ){
                echo "<script>alert('ยังไม่ได้รับอนุญาติการใช้งาน'); window.location = 'login.php';</script>";
            } else {
                session_start();
                $_SESSION['res_id'] = $row['res_id'];
                header("location: index.php");
            }
        } else {
            echo "<script>alert('รหัสผ่าน หรือชื่อผู้ใช้ไม่ถูกต้อง'); window.location = 'login.php';</script>";
        }
    }

?>