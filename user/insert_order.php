<?php

    include_once 'session.php';
    if(isset($_POST['submit'])){
        $food_id = $_POST['food_id'];
        $qty = $_POST['qty'];
        $sumprice = $_POST['sumprice'];
        
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $address = $_POST['address'];
        $phone = $_POST['phone'];
        $user_id = $_POST['user_id'];
        
        $res_id = $_POST['res_id'];

        $select = mysqli_query($conn, "SELECT `img` FROM `food` WHERE `food_id` = '$food_id' ");
        $row = mysqli_fetch_array($select);
        $img = $row['img'];

        $sql = "INSERT INTO `food_order`(`user_id`, `firstname`, `lastname`, `address`, `phone`, `quality`, `sumprice`, `food_id`, `food_img`, `res_id`, `rider_id`, `status`)
        VALUES ('$user_id', '$firstname', '$lastname', '$address', '$phone', '$qty', '$sumprice', '$food_id', '$img', '$res_id', 0, 0) ";
        $result = mysqli_query($conn, $sql);

        if($result){
            header("location: status.php");
        } else {
            echo "<script>alert('เกิดข้อผิดพลาด'); window.location = 'order.php';</script>";
        }
        
    }

?>