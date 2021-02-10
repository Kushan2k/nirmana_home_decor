<?php
include_once './conn.php';
include_once './showFunction.php';

if(!isset($_COOKIE['user'])){
    header('Location:../index.php');
}

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nirmana Home Decor</title>
    <link rel="stylesheet" href="../bootstrap4/css/bootstrap.css">
    <link rel="stylesheet" href="../css/formstyle.css">
</head>
<body>

<style>
    *{
        font-family: 'Play-Bold';
    }
    th{
        text-align: center;
        font-weight: 600!important;
        font-size: 17px;
        padding: 7px;
    }
    td{
        padding: 5px;
        text-align: center;
    }
    .total{
        padding: 3px;
    }
    ::-webkit-scrollbar{
        display: none;
    }
    .ro{
        background-color: transparent!important;
        border: none;
    }
    
    
</style>

<div class="container-fluid bg-dark d-flex align-items-center justify-content-sm-start" style="height: 50px;">
    <a href="./admin.php" style="color: rgb(72, 72, 226);">Back</a>

</div>

<div class="container border-bottom" >
    <h3 class="display-4 text-center">Quotations</h3>
</div>

<div class="container mt-3">

    



<?php

        //select id form quotations refid
        $getquo="SELECT DISTINCT(ref_id) FROM quotations ";
        $quo=$conn->query($getquo);
        if($quo==TRUE){
            if($quo->num_rows>0){
                while($cus=$quo->fetch_assoc()['ref_id']){
                    echo '<div class="container-fluid mb-3 pb-4" style="border-bottom: 4px solid rgb(78, 77, 77);">';
                    ShowData($conn,$cus);
                    echo '</div>';
                    
                }
            }else{
                echo '<h4 class="alert alert-warning text-center">No Quotations Found!</h4>';
            }
        }
        //ShowData($conn,$id,);












        
    


        

        


?>
</div>



    


    <script src="../js/quotation.js"></script>
    <script src="../bootstrap4/jquery.js"></script>
    <script src="../bootstrap4/js/bootstrap.js"></script>
</body>
</html>