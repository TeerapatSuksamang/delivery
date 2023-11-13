<?php

    include_once '../config/db.php';
    if(isset($_POST['submit'])){
        $res_type = $_POST['res_type'];

        // upload img
        $temp = explode('.' , $_FILES['img']['name']);
        $filename = rand() . '.' . end($temp);
        $filepath = "../upload/" . $filename;
        move_uploaded_file($_FILES['img']['tmp_name'], $filepath);
        
        // res_type check
        $select = "SELECT * FROM `restaurant_type` WHERE `res_type` = '$res_type' ";
        $result = mysqli_query($conn, $select);
        
        if(mysqli_num_rows($result)){
            echo "<script>alert('มีประเภทร้านอาหารนี้แล้ว'); window.location = 'addrestaurant.php';</script>";
        } else {
            $sql = "INSERT INTO `restaurant_type`(`res_type`, `img` )
            VALUES ('$res_type', '$filename') ";
            $result = mysqli_query($conn, $sql);

            if($result){
                echo "<script>alert('เพิ่มประเภทร้านอาหารเรียบร้อย'); window.location = 'res_approve.php';</script>";
            } else {
                echo "<script>alert('เกิดข้อผิดพลาด'); window.location = 'addrestaurant.php';</script>";
            }
        }
    }

?>