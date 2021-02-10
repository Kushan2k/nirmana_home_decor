<?php
include_once './conn.php';
if(!isset($_COOKIE['user'])){
    header('Location:../index.php');
}
$sql="DELETE FROM discount;";
$sql.="DELETE FROM cortation;";
$sql.="ALTER TABLE discount AUTO_INCREMENT=1;";
$sql.="ALTER TABLE cortation AUTO_INCREMENT=1;";
if(!$conn->multi_query($sql)==TRUE){
    header('Location:./admin.php');

}


?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nirmana Home Decor</title>
    <link rel="stylesheet" href="../bootstrap4/css/bootstrap.css">
    <link rel="shortcut icon" href="../images/logo.jpg" type="image/jpg">
    <link rel="stylesheet" href="../css/formstyle.css">
</head>
<body>

<div class="container-fluid w-100 bg-dark" style="height: 50px;">
    <h1><a href="./admin.php" style="text-decoration: none;">&leftarrow;</a></h1>

</div>
<div class="container">
    <h3 class="display-4 text-center">Create Quotation</h3>
</div>
<div class="container mt-3">
    <div class="row">
        <div class="col-12 colsm-10 col-md-6 col-lg-6 col-xl-6 mx-auto">
            <form action="./createcortation.php" method="GET">
                <div class="form-row">
                    <div class="col label">
                        <h3 class="col-form-label text-center">Enter Customer ID</h3>
                    </div>
                    <div class="col">
                        <input type="number" autocomplete="off" name="refid" placeholder="ID" class="form-control form-control-lg w-100 h-100">
                    </div>
                </div>
                <div class="form-row mt-3">
                    <div class="col-5 offset-7">
                        <input type="submit" name="cortation" value="Create" class="w-100 h-100  btn btn-outline-info">

                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
    
</body>
</html>