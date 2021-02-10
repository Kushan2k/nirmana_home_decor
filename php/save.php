<?php
session_start();
include_once 'conn.php';

if(isset($_GET['name'])){
    $productName=$conn->real_escape_string($_GET['name']);
    $colorCode=$conn->real_escape_string($_GET['code']);
    $width=$conn->real_escape_string($_GET['width']);
    $height=$conn->real_escape_string($_GET['height']);
    $control=$conn->real_escape_string($_GET['control']);
    $location=$_GET['location']?$_SESSION['location']:'N/A';
    
    $additional=$conn->real_escape_string(trim($_GET['add']));
    $peaceid=$_GET['peaceid'];
    

    if(!isset($_COOKIE['id'])){
        echo 'Customer id not found!';

    }else{
        $refid=$_COOKIE['id'];
        if(insertdata($conn,$productName,$colorCode,$width,$height,$control,$refid,$additional,$peaceid,$location)){
            echo 'Data Insert Complet !';
            $_SESSION['count']+=1;
            $_SESSION['msg']='Data Saved!';
        }else{
            $_SESSION['msg']='data not saved!';
        }
    }

    
}else{
    header('Location:../index.php');
}

function insertdata($connection,$pn,$cc='N/A',$w,$h,$c,$ref,$add='N/A',$pid,$location){
    $sql="INSERT INTO carton(product_name,color_code,width,height,control,additional,ref_id)
    VALUES("."'".$pn."'".","."'".$cc."'".","."'".$w."'".","."'".$h."'".","."'".$c."'".","."'".$add."'".",".$ref.")";

    if($connection->query($sql)==TRUE){
        $sql1="INSERT INTO carton_locations(name,peace_id) VALUES("."'". $location."'".",".$pid.")";
        if($connection->query($sql1)){
            
            return true;
        }
        else{
            echo $connection->error;
            //return false;
        }
    }
    else{
        return false;
    }
}

$conn->close();

?>