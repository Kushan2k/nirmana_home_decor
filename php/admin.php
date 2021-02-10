<?php
include_once './conn.php';
session_start();

$er=false;
if(isset($_POST['login'])){
    $uname=$conn->real_escape_string($_POST['uname']);
    $password=$conn->real_escape_string($_POST['password']);
    $hash=password_hash($password,PASSWORD_DEFAULT,['cost'=>12]);
    $sql="SELECT password FROM user WHERE user_name="."'".$uname."'";
    if($conn->query($sql)==TRUE){
        $result=$conn->query($sql);
        if($result->num_rows>0){

            if(password_verify($password,$result->fetch_assoc()['password'])){
                setcookie('user',true,time()+86400*365,'/');
            }else{
                $_SESSION['login_error']='Password do not match!';
                echo 'password dont match';
                header('Location:../index.php');
            }
        }else{
            $_SESSION['login_error']='User Not Found';
            echo 'no users';
            header('Location:../index.php');
        }
    }else{
        $_SESSION['login_error']='Problem Conection to the database ! -500';
        echo $conn->error;
        header('Location:../index.php');
    }

}else if(!isset($_COOKIE['user'])){
    header('Location:../index.php');
}

if(isset($_SESSION['error'])){
    if($_SESSION['error']){
        $er=true;
    }
}


?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nirmana Home Decor</title>
    <link rel="shortcut icon" href="../images/logo.jpg" type="image/jpg">
    
    <link rel="stylesheet" href="../bootstrap4/css/bootstrap.css">
    <link rel="stylesheet" href="../css/formstyle.css">
    <link rel="stylesheet" href="../css/font.css">
</head>
<body>
<div class="container-fluid bg-dark d-flex align-items-center justify-content-sm-start" style="height: 50px;">
    <a href="../index.php" style="color: rgb(72, 72, 226);">Back</a>

</div>
    <style>
        a{
            text-decoration: none;
            color: black;
        }
        a:hover{
            color: black;
        }
        
    </style>
    <?php
        if($er){
            echo 
            '
            <p class="text-center alert-warning alert mt-3">'.$_SESSION['error'].'</p>
            ';
        }



?>

    

    <div class="container">
        <div class="row mt-5">
            <div class="col-10 mx-auto col-md-6 ">
                <div class="form-row label justify-content-around btn-outline-info">
                    <a class="text-center col-form-label   " href="./add.php">ADD APPOINTMENT</a>
                </div>
            </div>
        
        </div>
        <div class="row">
            <div class="col-10 mx-auto mt-3 col-md-6">
                <div class="form-row label justify-content-around btn-outline-info">
                    <a class="text-center col-form-label   " href="./appointment.php">VIEW/EDIT APPOINTMENT</a>
                </div>
            </div>
            
        </div>
        <div class="row">
            <div class="col-10 mx-auto mt-3 col-md-6">
                <div class="form-row label justify-content-around btn-outline-info">
                    <a class="text-center col-form-label   " href="./view.php">VIEW/EDIT MEASURMENT</a>
                </div>
            </div>
            
        </div>
        <div class="row">
            <div class="col-10 mx-auto mt-3 col-md-6">
                <div class="form-row label justify-content-around btn-outline-info">
                    <a class="text-center col-form-label   " href="./viewQuo.php">VIEW/EDIT Quotation</a>
                </div>
            </div>
            
        </div>
        

        <!--
        <div class="row">
            <div class="col-10 mx-auto mt-3 col-md-6">
                <div class="form-row label justify-content-around btn-outline-info">
                    <a  class="text-center col-form-label   " href="#">CREATE QUOTATION</a>
                </div>
                ./getid.php
            </div>
        </div>

        -->

    </div>

        <script>
            document.addEventListener('DOMContentLoaded',()=>{
                setInterval(() => {
                    if(document.querySelector('.alert')){
                        document.querySelector('.alert').remove();
                        <?php
                         $_SESSION['error']=false; 
                        ?>
                    }
                }, 1000);
            });
        </script>
    <script src="../bootstrap4/jquery.js"></script>
    <script src="../bootstrap4/js/bootstrap.js"></script>
</body>
</html>