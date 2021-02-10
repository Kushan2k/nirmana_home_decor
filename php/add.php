<?php
session_start();
$error=null;
if(isset($_COOKIE['id_error'])){
    $error=$_COOKIE['id_error'];
}
if(!isset($_COOKIE['user'])){
    header('Location:../index.php');
}

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
    <div class="container-fluid bg-dark d-flex align-items-center justify-content-sm-start" style="height: 50px;">
        <a href="./admin.php">Back</a>
    </div>
    
    <div class="container">
        <h3 class="display-4 text-center" style="font-size: 50px!important;">Customer Details</h3>
    </div>
    <div class="container mt-4">
            <?php
            if($error){
                echo "<p class='alert alert-danger align-self-center'>".$error."</p>";
            }


            ?>
            <div class="row">
      <div class="col-12 col-sm-12 col-md-11 col-lg-8 col-xl-8 mx-auto">
            <form class="user-form w-100" action="./customer.php" method="POST" >
                <div class="form-row mt-4 mt-md-3">
                    <div class="col-6 label ">
                    <p class="text-center col-form-label ">Customer Name</p>
                    </div>
                    <div class="col-5  col-md-4">
                    <input type="text" autocomplete="off" name="name" class="form-control form-control-lg w-100 h-100" required placeholder="Enter Customer Name">
                    </div>
                    <div class="col-1 col-md-2">
                        <select name="salutation" class=" custom-select custom-select-sm h-100" >
                            <option value="Mr" selected>Mr</option>
                            <option value="Mrs" >Mrs</option>
                            <option value="Miss" >Miss</option>
                            <option value="Dr" >Dr</option>
                        </select>
                    </div>
                </div>
                <div class="form-row mt-4 mt-md-3">
                    <div class="col label">
                    <p class="text-center col-form-label">Contact Number</p>
                    </div>
                    <div class="col">
                    <input type="number" autocomplete="off" name="number" class="form-control form-control-lg w-100 h-100" placeholder="Enter Contact Number">
                    </div>
                </div>
                <div class="form-row mt-4 mt-md-3">
                    <div class="col label">
                    <p class="text-center col-form-label">Site Location</p>
                    </div>
                    <div class="col">
                    <input type="text" autocomplete="off" name="address" class="form-control form-control-lg w-100 h-100" placeholder="Enter Site Location">
                    </div>

                </div>
                <div class="form-row mt-4 mt-md-3">
                    <div class="col label">
                    <p class="text-center col-form-label">Customer Email</p>
                    </div>
                    <div class="col">
                    <input type="email" autocomplete="off" name="email" class="form-control form-control-lg w-100 h-100" placeholder="Enter Customer E-mail">
                    </div>


                </div>
                <div class="form-row mt-4 mt-md-3">
                    <div class="col label">
                    <p class="text-center col-form-label">Date Of Appointment</p>
                    </div>
                    <div class="col">
                    <input type="date" autocomplete="off" name="appointment" class="form-control form-control-lg w-100 h-100" >
                    </div>


                </div>
                <div class="form-row mt-4 mt-md-3">
                    <div class="col label">
                    <p class="text-center col-form-label">Remarks</p>
                    </div>
                    <div class="col">
                    <input type="text" autocomplete="off" name="remarks" class="form-control form-control-lg w-100 h-100" >
                    </div>
                </div>
                <div class="form-row mt-5 ">
                    <div class="col-6 ">
                        <input type="submit" name="create" value="Submit Customer Details" class="w-100 h-100 btn btn-success">

                    </div>
                    <div class="col-6 back ">
                        <a href="./admin.php" class="btn btn-success text-center w-100 h-100 py-2 ">Back</a>

                    </div>

                </div>
            </form>

      </div>
    </div>

    </div>


    
            <script>
                document.addEventListener('DOMContentLoaded',()=>{
                    if(document.querySelector('.alert')){
                        setInterval(() => {
                            document.querySelector('.alert').remove();
                            
                        }, 1000);
                    }
                })
            </script>

    <script src='../bootstrap4/jquery.js'></script>
    <script src='../bootstrap4/js/bootstrap.js'></script>
</body>
</html>