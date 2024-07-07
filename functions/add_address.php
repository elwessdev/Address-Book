<?php
  session_start();
  include("../config/config.php");
  if($_SERVER["REQUEST_METHOD"]=="POST"){
    $name = $_POST["name"];
    $city = $_POST["city"];
    $phone_number = $_POST["phone_number"];
    $email = $_POST["email"];
    $user_id = $_SESSION["user_id"];
    if(empty($name)||empty($city)||empty($phone_number)||empty($email)){
      echo "Please fill all fields";
      exit();
    }
    $colors=["42e79a","2bb2ff","f5c236","5d83e9","6841ea","919eab"];
    $bgColor=$colors[rand(0, count($colors) - 1)];
    $stms=$connect->prepare("INSERT INTO addresses (user_id,name,city,phone_number,email,bgColor) VALUES (?,?,?,?,?,?)");
    $stms->bind_param("isssss",$user_id,$name,$city,$phone_number,$email,$bgColor);
    try{
      $stms->execute();
      header("Location: ../home.php");
      exit();
    } catch(mysqli_sql_exception){
      echo "Error: " . $stmt->error;
    }
    $stmt->close();
    $connect->close();
  }
?>