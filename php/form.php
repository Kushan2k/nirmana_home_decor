<?php
session_start();
require_once 'conn.php';
$id=0;
$sql="SELECT peace_id as last_id FROM carton ORDER BY peace_id DESC";
    $result=$conn->query($sql);
    if($result==TRUE){
        if($result->num_rows>0){
          $id=$result->fetch_assoc()['last_id'];
        }else{
          $id=0;
        }
        
        
        

    }
    else{
        header('Location:./mesurment.php');
    }
if(isset($_GET['create'])){
    $_SESSION['location']=$_GET['location'];
    
    setcookie('location',$_GET['location'],time()+1000);

    
    

    

}
else if(!isset($_COOKIE['location'])){
    header('Location:./add.php');
}

$show=false;
if(isset($_SESSION['msg'])){
  if($_SESSION['msg']){
    $msg=$_SESSION['msg'];
    $show=true;
  }else{
    $show=false;
  }
}






?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nirmana Home Decor</title>
    <link rel="shortcut icon" href="../images/logo.jpg" type="image/jpg">
    <link rel='stylesheet' href='../bootstrap4/css/bootstrap.css'>
    <link rel="stylesheet" href="../css/form.css">
    <link rel="stylesheet" href="../css/formstyle.css">
    <link rel="stylesheet" href="../css/font.css">
</head>
<body>
    <style>
        .formdiv{
            border-bottom: 1px solid grey;
            padding: 10px 0;
            box-shadow: 0px 10px 7px -10px rgb(99, 97, 97)
        }

        @media (min-width:768px){
            .formdiv{
                border-left:1px solid rgb(107, 105, 105,0.1);
                border-right:1px solid rgb(107, 105, 105,0.1);
            }
        }
    </style>
    <div class='container-fluid bg-dark logo-div '   style='width:100%;height:70px;z-index:100;'>
        
    </div>
    <div class="container msg">
      <h3 class="display-4 text-center" style=" font-size:50px!important;">Measurment Details</h3>
    </div>
    
    <style>
        .with-border{
        border: 0.4px solid grey;
        border-radius: 5px;
        }
        .no-right{
        border-left: none;
        }

  </style>
<?php

if($show){
  echo '
  <div class="container">
    <p class="alert alert-success text-center">'.$msg.'</p>
  </div>';
}




?>


  <div class="container mt-3 mb-2">
    <div class="row mt-3">
      <div class="col-12 col-sm-12 col-md-10 col-lg-8 col-xl-8 mx-auto">
        <div class="row">
          <div class="col with-border label" >
            <h5 class="col-form-label text-center">Location Name</h5>
          </div>
          <div class="col with-border  label ml-1">
            <h5 class="col-form-label text-center">#<?php echo $_SESSION['location'];?></h5>
          </div>
        </div>
      </div>

    </div>
        <div class="row mt-4 formdiv">
      
          <div class="col-12 col-sm-12 col-md-10 col-lg-8 col-xl-8 mx-auto mt-4 mt-md-3 m-0">
            <div class="row">
              <div class="col with-border label">
                <h5 class="col-form-label text-center">PCS</h5>
              </div>
              <div class="col with-border label ml-1">
                <h5 class="col-form-label text-center"><?php echo $_SESSION['count']; ?></h5>
              </div>
            </div>
          </div>
          
          <div class="col-12 col-sm-12 col-md-10 col-lg-8 col-xl-8 mx-auto p-0">
              <form method="GET" action="" class="w-100 form" >
                  <div class="form-row mt-4 mt-md-3">
                      <div class="col label ">
                        <p class="text-center col-form-label ">Product Name</p>
                        <input class=" form-control" value="<?php echo $id+1; ?>" readonly type="hidden" name="peaceid">
                      </div>
                      <div class="col ">
                        <select name="names" id="pn" class="custom-select  w-100 h-100">
                          <option value="Not Enterd" selected>Default</option>
                          <option value="Venetian Blind 25mm">Venetian Blind 25mm</option>
                          <option value="Vertical Blind PVC 127mm">Vertical Blind PVC 127mm</option>
                          <option value="Vertical Blind Fabric 127mm">Vertical Blind Fabric 127mm</option>
                          <option value="Local Outdoor Bamboo Blind">Local Outdoor Bamboo Blind</option>
                          <option value="Local Outdoor Bamboo Blind with polythene backing">Local Outdoor Bamboo Blind with polythene backing</option>
                          <option value="Local Outdoor Bamboo Blind with rexine backing">Local Outdoor Bamboo Blind with rexine backing</option>
                          <option value="Imported Bamboo Blind">Imported Bamboo Blind </option>
                          <option value="Imported Bamboo Blind with lining ">Imported Bamboo Blind with lining</option>
                          <option value="Sunscreen Roller Blind">Sunscreen Roller Blind</option>
                          <option value="Blackout Roller Blind">Blackout Roller Blind </option>
                          <option value="Easy Roman Blind">Easy Roman Blind </option>
                          <option value="Roman Blind_Customer Fabric">Roman Blind_Customer Fabric </option>
                          <option value="Roman Blind">Roman Blind </option>
                          <option value="Zebra Blind">Zebra Blind </option>
                          <option value="Timber Blind">Timer Blind </option>
                          <option value="Monsoon Blind">Monsoon Blind </option>
                          <option value="Fabric Curtain_Eyelet Design">Fabric Curtain_Eyelet Design </option>
                          <option value="Fabric Curtain_Pleated Design">Fabric Curtain_Pleated Design </option>
                          <option value="Sheer Curtain_Eyelet Design">Sheer Curtain_Eyelet Design </option>
                          <option value="Sheer Curtain_Pleated Design">Sheer Curtain_Pleated Design </option>
                          <option value="Fabric & Sheer_Pannel Curtain (Same Pole)">Fabric & Sheer_Pannel Curtain (Same Pole) </option>
                          <option value="Fabric Eyelet Curtain & Sheer Pleated Curtain">Fabric Eyelet Curtain & Sheer Pleated Curtain </option>
                          <option value="Curtain Iron Pole">Curtain Iron Pole </option>
                          <option value="Curtain Wooden Pole">Curtain Wooden Pole </option>
                          <option value="Curtain Rail">Curtain Rail </option>
                          <option value="Curtain_Motorized Rail">Curtain_Motorized Rail </option>
                          <option value="Fabric/Sheer Eyelet Curatin_Customer Fabric">Fabric/Sheer Eyelet Curatin_Customer Fabric </option>
                          <option value="Fabric/Sheer Pleated Customer Fabric">Fabric/Sheer Pleated Customer Fabric </option>
                          <option value="Single Bracket">Single Bracket </option>
                          <option value="Double Bracket">Double Bracket </option>
                          <option value="Ceiling Bracket">Ceiling Bracket </option>
                          <option value="Wall Bracket">Wall Bracket </option>
                          <option value="End Cap">End Cap</option>
                  
                  
                        </select>
                      </div>
                  </div>
                  <div class="form-row mt-4 mt-md-3">
                      <div class="col label ">
                        <p class="text-center col-form-label ">Color Code</p>
                      </div>
                      <div class="col ">
                        <input type="text" autocomplete="off" name="code" class="form-control form-control-lg w-100 h-100" >
                      </div>
                  </div>
                  <div class="form-row mt-4 mt-md-3">
                    <div class="col label ">
                      <p class="text-center col-form-label ">Width(inches)</p>
                    </div>
                    <div class="col ">
                      <input type="text"  autocomplete="off" name="w"  class="form-control form-control-lg w-100 h-100" required >
                    </div>
                  </div>
                  <div class="form-row mt-4 mt-md-3">
                    <div class="col label ">
                      <p class="text-center col-form-label ">Height(inches)</p>
                    </div>
                    <div class="col ">
                      <input type="text" autocomplete="off" name="h" class="form-control form-control-lg w-100 h-100" required >
                    </div>
                  </div>
                  <div class="form-row mt-4 mt-md-3">
                    <div class="col label ">
                      <p class="text-center col-form-label ">Control</p>
                    </div>
                    <div class="col ">
                      <select name="control" id="c" class="custom-select" required>
                        <option value="Not Enterd" Selected>Default</option>
                        <option value="double side" >Double Side</option>
                        <option value="left" >Left</option>
                        <option value="right">Right</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-row mt-4 mt-md-3">
                    <div class="col label ">
                      <p class="text-center col-form-label ">Remark</p>
                    </div>
                    <div class="col ">
                      <!--<input type="text" autocomplete="off" name="pcs" class="form-control form-control-lg w-100 h-100"  >-->
                      <input name="add" autocomplete="off"   class="form-control form-control-lg w-100 h-100" >

                      
                    </div>
                  </div>
                  <div class="form-row mt-4 m-0">
                    <div class="col ">
                      <input type="hidden" value="<?php echo $_SESSION['location'];  ?>" name="location">
                      <input type="submit"  value="Submit  Details" class="w-100 h-100 btn btn-success">

                    </div>
                    <div class="col ">
                      <input type="reset" value="Clear Form" class="w-100 h-100 btn btn-success">
                    </div>
                    <div class="col">
                      <a href="./admin.php" class="btn btn-success w-100 h-100 text-center pt-2">Back</a>

                    </div>

                  </div> 

              </form>

          </div>
        </div>
      
        
    
    

    
  
  </div>
  <div class="container mt-4 ">
      <form action="./done.php" method="POST">
          <div class="form-row">
            <div class="col-6">
              <div class="form-group ml-3">
                <input type="submit" class="btn btn-success" value="Done" name="done">
              </div>
            </div>
          </div>
      </form>
  </div>

  
    


    <script>
      document.addEventListener('DOMContentLoaded',()=>{
                setInterval(() => {
                    if(document.querySelector('.alert')){
                        document.querySelector('.alert').remove();
                        <?php
                         $_SESSION['msg']=false; 
                        ?>
                    }
                }, 1000);
            });
    </script>
    <script src="../js/index.js" ></script>
    <script src='../bootstrap4/jquery.js' ></script>
    <script src='../bootstrap4/js/bootstrap.js' ></script>
</body>
</html>