<?php
  // include("./config/config.php");
  try{
    $sql = "SELECT * FROM addresses WHERE user_id={$_SESSION['user_id']}";
    $result = $connect->query($sql);
  } catch(mysqli_sql_exception){
    echo "Error";
  }
?>