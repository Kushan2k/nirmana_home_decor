<?php
$host='localhost';
$user='root';
$password='';
$database='factory';

$conn=new mysqli($host,$user,$password,$database);
if($conn->connect_error){
    header('Location:../index.php');
}



?>