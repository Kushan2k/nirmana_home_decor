<?php
include_once './conn.php';

if(!isset($_POST['edit'])){
    header('Location:./view.php');

}else{
    $location=$conn->real_escape_string(trim($_POST['location']));
    $productName=$conn->real_escape_string($_POST['pname']);
    $colorCode=$conn->real_escape_string($_POST['colorcode']);
    $width=$conn->real_escape_string($_POST['width']);
    $height=$conn->real_escape_string($_POST['height']);
    $additional=$conn->real_escape_string($_POST['additional']);
    $control=$_POST['control'];

   
}

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nirmana Home Decor</title>
    <link rel="shortcut icon" href="../images/logo.jpg" type="image/jpg">
    <link rel="stylesheet" href="../bootstrap4/css/bootstrap.css">
</head>
<body>
    <div style="height: 50px;text-decoration: none;
    transform: scale(1.3);" class="container-fluid bg-dark">
        <h1><a href="./view.php" class="back-arrow">&LeftArrow;</a></h1>
    </div>
    <style>
        .bg-dark{
            background-color: black!important;
            opacity: 0.9;
        }
    </style>
    

    <div class="container-fluid container-md mt-4">
        <div class="row">
            <div class="col-12 col-sm-8 col-md-10 col-lg-8 col-xl-8 mx-auto">
                <form action="./done.php" method="POST">
                    <div class="form-row">
                        <div class="col">
                            <div class="form-group">
                                <label for="location">Location Area</label>
                        
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <input name="location" autocomplete="off" type="text" class="form-control" value="<?php echo $location;?>">
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col">
                            <div class="form-group">
                                <label for="productname">Product Name</label>
                                
                            </div>

                        </div>
                        <div class="col">
                            <div class="form-group">
                                <select class=" custom-select" name="pname">
                                    <option value="<?php echo $productName; ?>" selected>Default</option>
                                    <option value="Veetian Blind 25mm" >Veetian Blind 25mm</option>
                                    <option value="Vertical Blind PVC 127mm">Vertical Blind PVC 127mm</option>
                                    <option value="Vertical Blind Fabric 127mm">Vertical Blind Fabric 127mm</option>
                                    <option value="Local Outdoor Bamboo Blind">Local Outdoor Bamboo Blind</option>
                                    <option value="Local Outdoor Bamboo Blind with polythene backing">Local Outdoor Bamboo Blind with polythene backing</option>
                                    <option value="Local Outdoor Bamboo Blind with rexine backing">Local Outdoor Bamboo Blind with rexine backing</option>
                                    <option value="Imported Bamboo Blind">Imported Bamboo Blind </option>
                                    <option value="Imported Bamboo Blind with lining Sunscreen Roller Blind">Imported Bamboo Blind with lining Sunscreen Roller Blind </option>
                                    <option value="Blackout Roller Blind">Blackout Roller Blind </option>
                                    <option value="Easy Roman Blind">Easy Roman Blind </option>
                                    <option value="Roman Blind_Customer Fabric">Roman Blind_Customer Fabric </option>
                                    <option value="Roman Blind">Roman Blind </option>
                                    <option value="Zebra Blind">Zebra Blind </option>
                                    <option value="Timer Blind">Timer Blind </option>
                                    <option value="Monosoon Blind">Monosoon Blind </option>
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
                                </select>
                            </div>
                        </div>
                    </div>

                    
                    
                    <div class="form-row">
                        <div class="col">
                            <div class="form-group">
                                <label for="colorCode">Color Code</label>
                                <input type="text" autocomplete="off" name="colorcode" class="form-control" value="<?php echo $colorCode;?>">
                            </div>
                        </div>
                        <div class="col">
                            
                            <div class="form-group">
                                <label for="width">Width</label>
                                <input type="text" autocomplete="off" name="width" class="form-control" value="<?php echo $width;?>">
                            </div>
                            
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="height">Height</label>
                                <input type="text" autocomplete="off" name="height" class="form-control" value="<?php echo $height;?>">
                            </div>
                        </div>
                    </div><br>

                    <div class="form-row">
                        <div class="col">
                            <div class="form-group">
                                <label for="control">Control</label>
                                <select name="control"  class="custom-select">
                                    
                                    <option value="<?php echo $control?$control:"N/A"; ?>" selected >Default</option>
                                    <option value="double side">Double Side</option>
                                    <option value="left">Right</option>
                                    <option value="right">Left</option>
                                </select>
                            </div>
                            
                        </div>
                        
                    </div>  

                    <div class="form-row">
                        <div class="col">
                            <div class="form-group">
                                <label for="additional">Additionals</label>
                                <textarea name="additional" id="add" cols="10" rows="3" class="form-control">
                                    <?php echo $additional?trim($additional):'N/A'; ?>
                                </textarea>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <input type="submit" class="btn btn-outline-success" value="Update" name="update">
                        <button class="btn btn-outline-warning" type="reset">Reset</button>
                    </div>

                    
                    <input type="hidden" value="<?php echo $_POST['ref_id'];?>" name="refid">
                    <input type="hidden" value="<?php echo $_POST['peace_id'];?>" name="peaceid">
                    <button type="button" id="del" class=" btn btn-outline-danger">Delete</button>
                    
                    
                </form>
            </div>
        </div>
    </div>
    


    <script src="../js/del.js"></script>
    <script src="../bootstrap4/jquery.js"></script>
    <script src="../bootstrap4/js/bootstrap.js"></script>
</body>
</html>