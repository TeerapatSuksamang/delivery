<?php

    include_once 'session.php';
    if(isset($_POST['submit'])){
        $res_id = $_SESSION['res_id'];
        $food_type = $_POST['food_type'];
        
        // img upload
        $temp = explode('.' , $_FILES['img']['name']);
        $filename = rand() . '.' . end($temp);
        $filepath = "../upload/" . $filename;
        move_uploaded_file($_FILES['img']['tmp_name'], $filepath);

        // username and res name check
        $select = "SELECT * FROM `food_type` WHERE `res_id` = '$res_id' AND `food_type` = '$food_type' ";
        $result = mysqli_query($conn, $select);

        if(mysqli_num_rows($result) > 0){
            echo "<script>alert('มีประเภทอาหารนี้แล้ว'); window.location = 'add_food_type.php';</script>";
        } else {
            $sql = "INSERT INTO `food_type`(`food_type`, `img`, `res_id`)
            VALUES ('$food_type', '$filename', '$res_id') ";
            $result = mysqli_query($conn, $sql);

            if($result){
                echo "<script>alert('บันทึกข้อมูลสำเร็จ'); window.location = 'index.php';</script>";
            } else {
                echo "<script>alert('เกิดข้อผิดพลาด'); window.location = 'add_food_type.php';</script>";
            }
        }
    }

?>