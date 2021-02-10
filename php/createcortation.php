<?php

include_once './conn.php';
include_once './showFunction.php';


$date=date('Y-m-d',time());
$id=0;
$ex=false;
$done=false;
if(!isset($_COOKIE['user'])){
    header('Location:../index.php');
}
if(isset($_GET['qid'])){
    $id=$_GET['qid'];
    $ch="SELECT id FROM quotations WHERE ref_id=".$id;
    $cr=$conn->query($ch);
    if($cr==TRUE){
        if($cr->num_rows>0){
            $ex=true;
            echo 'has';
        }else{
            $ex=false;
            $done=true;
        }
    }else{
        header('Location:./view.php');
    }
}else{
    $id=0;
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

<div class="container mt-3">

    


    <?php
    
    $er='';
        if($ex){
            $del="DELETE FROM quotations WHERE ref_id=".$id;
            if($conn->query($del)==TRUE){
                $done=true;
            }else{
                $done=false;
                $er.=$conn->error;
            }
        }

        if($done){
            $sql="SELECT name,address,email,number,reg_date,ref_id FROM customers WHERE ref_id=".$id;
            $r=$conn->query($sql);
            if($r==TRUE){
                if($r->num_rows>0){
                    //cusomer details goes here....
                    $customer=$r->fetch_assoc();
                    echo

                    '
                    <div class="row pb-3">
                        <div class="col-12 col-sm-12 col-md-10 col-lg-8 col-xl-8 mx-auto ">
                            <div class="row mt-3">
                                <div class="col with-border label">
                                    <p class="text-center col-form-label">Quotation Number</p>
                                </div>
                                <div class="col with-border label ml-1">
                                    <p class="text-center col-form-label">'.'50'.'</p>
                    
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col with-border label">
                                    <p class="text-center  col-form-label">Quotation Date</p>
                                </div>
                                <div class="col with-border label ml-1">
                                    <p class="text-center col-form-label">'.$date.'</p>
                    
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col with-border label">
                                    <p class="text-center  col-form-label">Customer Name</p>
                                </div>
                                <div class="col with-border label ml-1">
                                    <p class="text-center col-form-label">'.$customer['name'].'</p>
                    
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col with-border label">
                                    <p class="text-center  col-form-label">Contact Number</p>
                                </div>
                                <div class="col with-border label ml-1">
                                    <p class="text-center col-form-label">'.$customer['number'].'</p>
                    
                                </div>
                            </div>
                            
                            <div class="row mt-3">
                                <div class="col with-border label">
                                    <p class="text-center  col-form-label">Site Address</p>
                                </div>
                                <div class="col with-border label ml-1">
                                    <p class="text-center col-form-label">'.$customer['address'].'</p>
                    
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col with-border label">
                                    <p class="text-center  col-form-label">E-Mail Address</p>
                                </div>
                                <div class="col with-border label ml-1">
                                    <p class="text-center col-form-label">'.$customer['email'].'</p>
                    
                                </div>
                            </div>






                        </div>
                    </div>        
                    



                    ';







                    $row=$r->fetch_assoc();
                    $getcarton="SELECT product_name,peace_id,color_code FROM carton WHERE ref_id=".$customer['ref_id'];
                    $res=$conn->query($getcarton);
                    if($res==TRUE){
                        if($res->num_rows>0){
                            //table header goes here........ 
                            echo
                            '
                            
                                <table border="1" class="table-striped mx-auto ">
                                    <tr>
                                        <th>Item Name</th>
                                        <th>Location</th>
                                        <th>Color Code</th>
                                        <th>QTY</th>
                                        <th>SQ.FT</th>
                                        <th>Unit Price</th>
                                        <th>Net Amount(LKR)</th>
                                        <th></th>
                                    </tr>
                                        ';
                            while($row2=$res->fetch_assoc()){
                                echo '<tr>';
                                $locationselect="SELECT name FROM carton_locations WHERE peace_id=".$row2['peace_id'];
                                $result=$conn->query($locationselect);
                                if($result==TRUE){
                                    if($result->num_rows>0){
                                        $location=$result->fetch_assoc()['name'];
                                    }else{
                                        $location="N/A";
                                    }

                                    //table goes here.....
                                    echo
                                        '
                                        <td style="overflow-x: scroll;"><input class=" form-control w-100 h-100 ro" value="'.$row2['product_name'].'" readonly></td>
                                        <td>'.$location.'</td>
                                        <td>'.$row2['color_code'].'</td>
                                        <form class="price-form">
                                            <input type="hidden" name="date" value="'.$date.'">
                                            <input type="hidden" name="refid" value="'.$customer['ref_id'].'">
                                            <input type="hidden" name="peaceid" value="'.$row2['peace_id'].'">
                                            <td><input type="number" autocomplete="off" value="'.'1'.'" readonly name="qty" class="ro form-control w-100 h-100" ></td>
                                            <td><input type="text" autocomplete="off" name="sqft" class=" form-control w-100 h-100" ></td>
                                            <td><input type="text" autocomplete="off" name="up" class=" form-control w-100 h-100" ></td>
                                            <td ><input type="text" name="total" class=" form-control w-100 h-100 pl-0  ro " readonly ></td>
                                            <td><input type="submit" value="Save" class="btn btn-success"></td>
                                        </form>
                                        ';

                                                            
                                }else{
                                    echo '<p class="alert alert-danger text-center">'.$conn->error.'-500</p>';
                                }

                                echo '</tr>';
                            }

                            echo '</table>
                            ';

                            echo 
                            '
                            <div class="container mt-3 ">
                                <div class="row ">
                                    <div class="col-6 col-lg-4">
                                        <a href="./view.php" class="btn btn-lg btn-danger w-100 ">Back</a>
                                    </div>
                                    <div class="col-6 col-lg-4">
                                        <form action="./cortation.php" method="GET" class="w-100 ">
                                            <input type="hidden" name="id" value="'.$customer['ref_id'].'">
                                            <input type="hidden" name="name" value="'.$customer['name'].'">
                                            
                                            <input type="submit" value="Get PDF" name="pdf" class="btn btn-lg btn-success w-100 ">
                                             
                                        </form>
                                    </div>
                                                            
                                </div>
                            </div>
                            ';

                            
                        }else{
                            echo '<p class="alert alert-warning text-center">No Any Mesuarment To this customer</p>';
                        }
                    }else{
                        echo '<p class="alert alert-danger text-center">'.$conn->error.'-500</p>';
                    }
                    
                }else{
                    echo '<p class="alert alert-warning text-center mt-3">No Customers Found !</p>';
                }
            }else{
                echo '<p class="alert alert-danger text-center">'.$conn->error.'-500</p>';
            }
        }else{
            echo '<p class="alert alert-danger text-center">Error</p>';
            echo $er;
        }


        

        


?>
</div>



    


    <script src="../js/quotation.js"></script>
    <script src="../bootstrap4/jquery.js"></script>
    <script src="../bootstrap4/js/bootstrap.js"></script>
</body>
</html>