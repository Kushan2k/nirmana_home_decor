<?php
include_once './conn.php';

if(!isset($_COOKIE['user'])){
    header('Location:../index.php');
}


?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nirmana Home Decor/Appointment</title>
    <link rel="shortcut icon" href="../images/logo.jpg" type="image/jpg">
    
    <link rel="stylesheet" href="../bootstrap4/css/bootstrap.css">
    <link rel="stylesheet" href="../css/formstyle.css">
    <link rel="stylesheet" href="../css/view.css">
    <link rel="stylesheet" href="../css/font.css">
</head>
<body>
<div class="container-fluid bg-dark d-flex align-items-center justify-content-sm-start" style="height: 50px;">
    <a href="./admin.php">Back</a>

</div>
<div class="container mb-1">
    <h5 class=" display-3 text-center" style="font-size: 50px!important;">Search Appointment</h5>
</div>

<div class="container">
    <div class="row">
        <div class="col-12 col-sm-12 col-md-10 col-lg-8 col-xl-8 mx-auto">
            <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" id="search-form">
                <div class="form-row">
                    <div class="col label">
                        <p  class=" col-form-label text-center">Select Appointment Date</p>
                    </div>
                    <div class="col">
                        <input type="date" class="form-control"  id="date" name="inputdate" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-6 mx-auto mt-3">
                        <input type="submit" value="Search" class="w-100 h-100 btn btn-success" name="show">
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>

<hr>
<div class="container-fluid  error-box mt-2">
    <?php

    if(isset($_COOKIE['msg'])){
        echo '<p class="alert alert-success text-center">'.$_COOKIE['msg'].'</p>';
    }else if(isset($_COOKIE['error'])){
        echo '<p class="alert alert-warning text-center">'.$_COOKIE['error'].'</p>';
    }
    ?>
</div>


<div class="loading mx-auto mt-5 ">
</div>
<div class="container px-2  main-view d-none">
        <?php


            $getcus='SELECT ref_id,name,address,email,number,ap_date,remarks FROM customers ORDER BY ref_id DESC';

            if(isset($_POST['show'])){
                $reqdate=$_POST['inputdate'];
                $getcus="SELECT ref_id,name,address,email,number,ap_date,remarks FROM customers WHERE ap_date="."'".$reqdate."'";
    
                echo '<p class="alert alert-success text-center">By Date:- '.$reqdate.'</p>';
                
            }

            echo '<div class=="container ">';
            $result=$conn->query($getcus);
            if($result==TRUE){
                if($result->num_rows>0){
                    $count=1;
                    while($row=$result->fetch_assoc()){
                        $select="SELECT peace_id FROM carton WHERE ref_id=".$row['ref_id'];
                        $r=$conn->query($select);
                        if($r==TRUE){
                            if(!$r->num_rows>0){
                                echo
    
                                '
                                <div class="row pb-3" style="border-bottom: 2px solid black;">
                                    <div class="col-12 col-sm-12 col-md-10 col-lg-8 col-xl-8 mx-auto ">
                                        <div class="row mt-3">
                                            <div class="col with-border label">
                                                <p class="text-center col-form-label">Referance Number</p>
                                            </div>
                                            <div class="col with-border label ml-1">
                                                <p class="text-center col-form-label">'.$count.'</p>
                                
                                            </div>
                                        </div>
    
                                        
    
                                        <div class="row mt-3">
                                            <div class="col-6 with-border  label">
                                                <p class="text-center col-form-label">Appointment  Date</p>
                                            </div>
                                            
                                            <div class="col-6  p-0">
                                                <form class="editfixdate w-100 h-100 m-0">
                                                    <div class="form-row">
                                                      <div class="col-9">
                                                        <input type="hidden" name="id" value="'.$row["ref_id"].'">
                                                        <input readonly class="ml-1 col-form-label form-control text-center w-100 h-100" name="fix"  value="'.$row["ap_date"].'">
                                                      </div>
                                                      <div class="col-3">
                                                        <button type="submit"  class=" text-center w-100  btn btn-success" data-column="ap_date" name="edit">Edit</button>
                                                      </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
    
                                    </div>
                                    
                                <div class="col-12  col-sm-12 col-md-10 col-lg-8 col-xl-8 mx-auto  ">
    
                                            <div class="form-row">
    
                                                <div class="col-12 mt-3">
                                                
                                                    <div class="row">
                                                        <div class="col-6 label ">
                                                        <p class="col-form-label text-center">Customer Name</p>
                                                        </div>
                                                        <div class="col-6  p-0">
                                                            <form class="editfixdate w-100 h-100 m-0">
                                                                <div class="form-row">
                                                                <div class="col-9">
                                                                    <input type="hidden" name="id" value="'.$row["ref_id"].'">
                                                                    <input readonly class="ml-1 col-form-label form-control text-center w-100 h-100" name="fix"  value="'.ucfirst($row["name"]).'">
                                                                </div>
                                                                <div class="col-3">
                                                                    <button type="submit"  class=" text-center w-100  btn btn-success" data-column="name" name="edit">Edit</button>
                                                                </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        
                                                        
                                                    </div>
                                                </div>
                                        
                                                <div class="col-12 mt-3">
                                                    <div class="row">
                                                        <div class="col-6 label ">
                                                        <p class="col-form-label text-center">Contact Number</p>
                                                        </div>
                                                        <div class="col-6  p-0">
                                                            <form class="editfixdate w-100 h-100 m-0">
                                                                <div class="form-row">
                                                                  <div class="col-9">
                                                                    <input type="hidden" name="id" value="'.$row["ref_id"].'">
                                                                    <input readonly class="ml-1 col-form-label form-control text-center w-100 h-100" name="fix"  value="'.$row["number"].'">
                                                                  </div>
                                                                  <div class="col-3">
                                                                    <button type="submit"  class=" text-center w-100  btn btn-success" data-column="number" name="edit">Edit</button>
                                                                  </div>
                                                                </div>
                                                            </form>
                                                        
                                                        </div>
                                                        
                                                        
                                                    </div>
                                        
                                                </div>
                                        
                                                <div class="col-12 mt-3">
                                        
                                                    <div class="row">
                                                        <div class="col-6 label ">
                                                        <p class="col-form-label text-center">Site Location</p>
                                                        </div>
                                                        <div class="col-6  p-0">
                                                            <form class="editfixdate w-100 h-100 m-0">
                                                                <div class="form-row">
                                                                  <div class="col-9">
                                                                    <input type="hidden" name="id" value="'.$row["ref_id"].'">
                                                                    <input readonly class="ml-1 col-form-label form-control text-center w-100 h-100" name="fix"  value="'.ucfirst($row["address"]).'">
                                                                  </div>
                                                                  <div class="col-3">
                                                                    <button type="submit"  class=" text-center w-100  btn btn-success" data-column="address" name="edit">Edit</button>
                                                                  </div>
                                                                </div>
                                                            </form>
                                                        
                                                        </div>
                                                        
                                                        
                                                    </div>
                                        
                                                </div>
                                        
                                                <div class="col-12 mt-3">
                                        
                                                    <div class="row">
                                                        <div class="col-6 label ">
                                                        <p class="col-form-label text-center">Customer E-mail</p>
                                                        </div>
                                                        <div class="col-6  p-0">
                                                            <form class="editfixdate w-100 h-100 m-0">
                                                                <div class="form-row">
                                                                  <div class="col-9">
                                                                    <input type="hidden" name="id" value="'.$row["ref_id"].'">
                                                                    <input readonly class="ml-1 col-form-label form-control text-center w-100 h-100" name="fix"  value="'.$row["email"].'">
                                                                  </div>
                                                                  <div class="col-3">
                                                                    <button type="submit"  class=" text-center w-100  btn btn-success" data-column="email" name="edit">Edit</button>
                                                                  </div>
                                                                </div>
                                                            </form>
                                                        
                                                        </div>
                                                        
                                                        
                                                    </div>
                                        
                                                </div>
                                                <div class="col-12 mt-3">
                                                    <div class="row">
                                                        <div class="col-6 label ">
                                                        <p class="col-form-label text-center">Remarks</p>
                                                        </div>
                                                        <div class="col-6  p-0">
                                                            <form class="editfixdate w-100 h-100 m-0">
                                                                <div class="form-row">
                                                                  <div class="col-9">
                                                                    <input type="hidden" name="id" value="'.$row["ref_id"].'">
                                                                    <input readonly class="ml-1 col-form-label form-control text-center w-100 h-100" name="fix"  value="'.$row["remarks"].'">
                                                                  </div>
                                                                  <div class="col-3">
                                                                    <button type="submit"  class=" text-center w-100  btn btn-success" data-column="remarks" name="edit">Edit</button>
                                                                  </div>
                                                                </div>
                                                            </form>
                                                        
                                                        </div>
                                                        
                                                        
                                                    </div>
                                        
                                                </div>
        
                                                
                                            </div>
                                      
                                </div>
    
                                <div class="col-12  col-sm-12 col-md-10 col-lg-8 col-xl-8 mx-auto mt-2 m-0 ">
                                        <div class="row">
                                            <div class="col-6 ">
                                                <form action="./customer.php" method="POST">
                                                    <input type="hidden" value="'.$row['ref_id'].'" name="ref">
                                                    <input type="submit" name="take" value="ADD MEASURMENT " class="btn w-100 btn-success">
                                                </form>
                                            </div>
                                            <div class="col-6 ">
                                                <form action="./customer.php" method="POST"  onsubmit="return ask()">
                                                    <input type="hidden" value="'.$row['ref_id'].'" name="ref">
                                                    <input type="submit" name="del" value="DELETE CUSTOMER " class="btn w-100 btn-warning">
                                                </form>
                                            </div>
    
                                        </div>
                                </div>    
                                    
                                    
                                    
                                </div>
                                    ';
    
    
    
                            }else{
                                
                                continue;
                            }
                        }else{
                            echo '<p class="alert alert-danger text-center">'.$conn->error.'-500</p>';
                        }

                        $count+=1;
                    }
    
                    echo '</div>';
                }else{
                    echo '<p class="alert alert-warning text-center">No Customers Found!</p>';
                    
                }
            }else{
                echo '<p class="alert alert-danger text-center">'.$conn->error.'-500</p>';
            }




?>
    </div>

    
    <script>
        function ask(){
            let a=confirm('Are You sure?');
            if(a){
                return true;
            }else{
                return false;
            }
        }
    </script>


    <script src="../js/view.js"></script>
    <script src="../bootstrap4/jquery.js"></script>
    <script src="../bootstrap4/js/bootstrap.js"></script>
</body>
</html>