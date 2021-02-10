<?php
session_start();

if(!isset($_COOKIE['user'])){
    header('Location:../index.php');
}else if(isset($_GET['ref'])){
    $id=$_GET['ref'];
    
}


$_SESSION['count']=1;
setcookie('location','');


?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nirmana Home Decor</title>
    <link rel="shortcut icon" href="../images/logo.jpg" type="image/jpg">
    <link rel="stylesheet" href="../css/formstyle.css">
    <link rel="stylesheet" href="../bootstrap4/css/bootstrap.css"> 
    <link rel="stylesheet" href="../css/font.css">
</head>
<body>
    <div class='container-fluid bg-dark logo-div '   style='width:100%;height:70px;z-index:100;'>
        
    </div>
    <style>
        .bg-dark{
            background-color: black!important;
            opacity: 0.9;
        }
    </style>
<div class="container">
    <h3 class="display-4 text-center" style="font-size: 50px!important;">Location Details</h3>
</div>
<div class="container mt-4">
    <div class="row">
        <div class="col-12 col-sm-12 col-md-10 col-lg-8 col-xl-8 mx-auto">
            <form method="GET" action="./form.php" class="w-100">
            <div class="form-row mt-4 mt-md-3">
                <div class="col label ">
                <p class="text-center col-form-label ">Location Details</p>
                </div>
                <div class="col ">
                <input type="text" autocomplete="off" name="location" class="form-control form-control-lg w-100 h-100" required >
                </div>
            </div>
            
            <div class="form-row mt-4 mt-md-3">
                <div class="col ">
                <input type="submit" name="create" value="Submit Location Details" class="w-100 h-100 btn btn-success">

                </div>
                <div class="col back ">
                <a href="./admin.php" class="btn btn-success w-100 h-100 text-center pt-2 ">Back</a>

                </div>

            </div> 

            </form>

        </div>
        </div>
        <div class="row mt-5">
        <div class="col-12 col-sm-12 col-md-10 col-lg-8 col-xl-8 mx-auto">
            <form action="./finish.php" method="GET" onsubmit="return conformANS()" >
                <div class="form-row">
                    <div class="col-8 mx-auto">
                        <input type="hidden" value="<?php echo $id;?>" name='refid'>
                        
                        <input type="submit" class="w-100 h-100 btn btn-success mt-2" value="Submit Form" name="finish">
                            
                        
                    
                    </div>
                    
                </div>
            </form>
        </div>


    </div>
</div>
    <script>
        function conformANS(){
            let p=confirm('Are You Sure!');
            if(p){
                return true;
            }else{
                return false;
            }
        }
    </script>
    

    <script src="../bootstrap4/jquery.js"></script>
    <script src="../bootstrap4/js/bootstrap.js"></script>
</body>
</html>