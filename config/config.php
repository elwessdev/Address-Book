<?php 
// DataBase Connection credentials
$hostname="localhost";
$database="address book";
$user="root";
$password="";
// Check connection
$connect= "";
try{
  $connect = mysqli_connect($hostname,$user,$password,$database);
} catch(mysqli_sql_exception){
  echo "could not connect";
}
if($connect){
  // echo "you are connect";
}

?>