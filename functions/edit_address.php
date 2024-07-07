<?php
  session_start();
  include("../config/config.php");
  if($_SERVER["REQUEST_METHOD"]=="POST"){
    // Old Data
    $oldName = $_POST["oldName"];
    $oldCity = $_POST["oldCity"];
    $oldPhone = $_POST["oldPhone"];
    $oldEmail = $_POST["oldEmail"];
    // New Data
    $user_id = $_SESSION["user_id"];
    $name = $_POST["name"];
    $city = $_POST["city"];
    $phone_number = $_POST["phone_number"];
    $email = $_POST["email"];

    if(empty($name)||empty($city)||empty($phone_number)||empty($email)){
      echo "Please fill all fields";
      exit();
    }
    $stms=$connect->prepare("UPDATE addresses SET name = ?, city = ?, phone_number = ?, email = ? 
    WHERE user_id = ? AND name = ? AND city = ? AND phone_number = ? AND email = ?");
    $stms->bind_param("ssssissss",$name,$city,$phone_number,$email,$user_id,$oldName,$oldCity,$oldPhone,$oldEmail);
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