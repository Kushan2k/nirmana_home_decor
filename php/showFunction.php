<?php

function ShowData($conn,$id){
    $sql="SELECT name,address,email,number,reg_date,ref_id FROM customers WHERE ref_id=".$id;
    $r=$conn->query($sql);
    if($r==TRUE){
        if($r->num_rows>0){
            //cusomer details goes here....
            $row=$r->fetch_assoc();
            $getdate="SELECT date FROM quotations WHERE ref_id=".$id;
            $date='';
            if($conn->query($getdate)==TRUE){
                $d=$conn->query($getdate);
                $date=$d->fetch_assoc()['date'];
            }
            echo

                '
                <div class="row pb-3">
                    <div class="col-12 col-sm-12 col-md-10 col-lg-8 col-xl-8 mx-auto ">
                        <div class="row mt-3">
                            <div class="col with-border label">
                                <p class="text-center col-form-label">Quotation Number</p>
                            </div>
                            <div class="col with-border label ml-1">
                                <p class="text-center col-form-label">'.$row['ref_id'].'</p>
                
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
                                <p class="text-center col-form-label">'.$row['name'].'</p>
                
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col with-border label">
                                <p class="text-center  col-form-label">Contact Number</p>
                            </div>
                            <div class="col with-border label ml-1">
                                <p class="text-center col-form-label">'.$row['number'].'</p>
                
                            </div>
                        </div>
                        
                        <div class="row mt-3">
                            <div class="col with-border label">
                                <p class="text-center  col-form-label">Site Address</p>
                            </div>
                            <div class="col with-border label ml-1">
                                <p class="text-center col-form-label">'.$row['address'].'</p>
                
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col with-border label">
                                <p class="text-center  col-form-label">E-Mail Address</p>
                            </div>
                            <div class="col with-border label ml-1">
                                <p class="text-center col-form-label">'.$row['email'].'</p>
                
                            </div>
                        </div>






                    </div>
                </div>        
                



                ';

                $getquoMES="SELECT peace_id FROM quotations WHERE ref_id=".$id;
                $mes=$conn->query($getquoMES);
                if($mes==TRUE){
                    if($mes->num_rows>0){
                        
                        echo 
                        '
                        

                        
                        <table border="1" class="table-striped mx-auto w-100 ">
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


                        while($pid=$mes->fetch_assoc()['peace_id']){
                            $get_values="SELECT unit_price,total_price,sqft FROM quotations WHERE ref_id=".$id." AND peace_id=".$pid;
                            $valueR=$conn->query($get_values);
                            if($valueR==TRUE){
                                if($valueR->num_rows>0){

                                    echo '<tr>';
                                    $prices=$valueR->fetch_assoc();

                                    $cartonD="SELECT product_name,color_code,name FROM carton,carton_locations WHERE carton.peace_id=carton_locations.peace_id AND carton.peace_id=".$pid;
                                    $details=$conn->query($cartonD);
                                    $aboutcarton='';
                                    if($details==TRUE){
                                        if($details->num_rows>0){
                                            $aboutcarton=$details->fetch_Assoc();
                                        }else{
                                            echo '<p class="text-center alert alert-warning">No mesuarment found!..</p>';
                                        }
                                    }else{
                                        continue;
                                    }

                                    echo 
                                    '
                                    <td style="overflow-x: scroll;"><input class=" form-control w-100 h-100 ro" value="'.$aboutcarton['product_name'].'" readonly></td>
                                        <td>'.$aboutcarton['name'].'</td>
                                        <td>'.$aboutcarton['color_code'].'</td>
                                        <form class="price-form">
                                                                
                                            <input type="hidden" name="refid" value="'.$id.'">
                                            <input type="hidden" name="date" value="'.$date.'">
                                            <input type="hidden" name="peaceid" value="'.$pid.'">
                                            <td><input type="number" autocomplete="off" value="'.'1'.'" readonly name="qty" class="ro form-control w-100 h-100" ></td>
                                            <td><input value="'.$prices['sqft'].'" type="text" autocomplete="off" name="sqft" class=" form-control w-100 h-100" ></td>
                                            <td><input value="'.$prices['unit_price'].'" type="text" autocomplete="off" name="up" class=" form-control w-100 h-100"  ></td>
                                            <td ><input value="'.$prices['total_price'].'" type="text" name="total" class=" form-control w-100 h-100 pl-0  ro " readonly ></td>
                                            <td><input type="submit" value="Edit" class="btn btn-warning"></td>
                                        </form>

                                    ';
                                    echo '</tr>';
                                }else{
                                    continue;
                                }

                            }else{
                                echo '<p class="text-center alert alert-warning">'.$conn->error.'</p>';
                            }
                        }


                    }
                    
                    echo '</table>';

                    echo 
                        '
                        <div class="col-12 col-sm-12 col-md-10 col-lg-8 col-xl-8 mx-auto  mt-3">
                            <div class="row">
                                <div class="col w-100">
                                    <form class="delete-form w-100">
                                        <input type="hidden" name="refid" value="'.$row['ref_id'].'">
                                        <input type="submit" value="Delete" class="btn btn-lg btn-danger w-100">
                                    </form>
                                </div>
                                <div class="col w-100">
                                    <form class=" w-100" action="./cortation.php" method="GET">
                                        <input type="hidden" name="id" value="'.$row['ref_id'].'">
                                        <input type="hidden" name="name" value="'.$row['name'].'">
                                        <input type="submit" value="Get PDF" class="btn btn-lg btn-success w-100" name="pdf">
                                    </form>
                                </div>
                            </div>
                            
                        </div>
                        ';
                }


                





            
        }else{
            echo '<p class="alert alert-warning text-center mt-3">No Customers Found !</p>';
        }
    }else{
        echo '<p class="alert alert-danger text-center">'.$conn->error.'-500</p>';
    }
}

?>