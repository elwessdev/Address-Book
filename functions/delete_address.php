<?php
  session_start();
  include("../config/config.php");
  if($_SERVER["REQUEST_METHOD"]=="POST"){
    $user_id = $_SESSION["user_id"];
    $name = $_POST["name"];
    $city = $_POST["city"];
    $phone_number = $_POST["phone_number"];
    $email = $_POST["email"];

    $stms=$connect->prepare("DELETE FROM addresses WHERE user_id = ? AND name = ? AND city = ? AND phone_number = ? AND email = ?");
    $stms->bind_param("issss",$user_id,$name,$city,$phone_number,$email);
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