<?php

    include_once 'session.php';
    if(isset($_POST['submit'])){
        $res_id = $_SESSION['res_id'];
        $food_id = $_POST['food_id'];
        $food_name = $_POST['food_name'];
        $price = $_POST['price'];
        $food_type = $_POST['food_type'];

        
        // img upload
        $temp = explode('.' , $_FILES['img']['name']);
        $filename = rand() . '.' . end($temp);
        $filepath = "../upload/" . $filename;
        

        // food name check
        $select = "SELECT * FROM `food` WHERE `food_id` != '$food_id' AND (`res_id` = '$res_id' AND `food_name` = '$food_name') ";
        $result = mysqli_query($conn, $select);

        if(mysqli_num_rows($result) > 0){
            echo "<script>alert('มีเมนูอาหารนี้แล้ว'); window.location = 'add_food.php';</script>";
        } else {
            if(move_uploaded_file($_FILES['img']['tmp_name'], $filepath)){
                $sql = "UPDATE `food` SET 
                `food_name` = '$food_name',
                `img` = '$filename',
                `price` = '$price' 
                WHERE `food_id` = '$food_id' ";
                $result = mysqli_query($conn, $sql);
            } else {
                $sql = "UPDATE `food` SET 
                `food_name` = '$food_name',
                `price` = '$price' 
                WHERE `food_id` = '$food_id' ";
                $result = mysqli_query($conn, $sql);
            }
            
            if($result){
                echo "<script>alert('บันทึกข้อมูลสำเร็จ'); window.location = 'index.php';</script>";
            } else {
                echo "<script>alert('เกิดข้อผิดพลาด'); window.location = 'add_food.php';</script>";
            }
        }
    }

?>