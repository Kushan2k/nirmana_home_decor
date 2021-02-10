<?php


include_once '../vendor/autoload.php';

include_once './conn.php';

if(!isset($_COOKIE['user'])){
    header('Location:../index.php');
}
if(isset($_GET['pdf'])){
    $id=$_GET['id'];
    $name=$_GET['name'];
    
}else{
    header('Location:./view.php');
}





/*


*/

$html='

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quotations Pdf</title>
    
</head>
<body>
    <style>
        td,th{
            text-align: center;
        }
        
        .header-details{
            
            display: block;
            
            border-bottom: 2px solid rgb(16,16,133);
            padding-bottom: 0;
            margin-bottom: 18px;
            width: 100%;

            
        }
        .header-details>p{
            margin-top: 0;
            text-align: right;
            margin-right: 10px;
        }
        .header-details>h5{
            text-align: right;
            font-size: 19px;
            margin-right: 10px;
            margin-bottom: 10px;
        }
        .order-values{
            margin-bottom: 10px;
            width: 100%;
            margin: 0;
            
           
        }
        .customer-details{
            
            width: 100%;
            margin-top: 20px;
            margin-bottom: 20px;
            
            
        }
        .personal{
            display: inline-block;
            margin-top: 30px;
            
            
        }
        .order{
            display: inline-block;
            margin-left: 50px;
            width: 270px;
            
            
        }
        
        
        table{
            margin-bottom: 40px;
            border-collapse: collapse;
            width: 100%;

        }
        .order-values>p{
            margin-bottom: 0;
        }
        *{
            color: rgb(16, 16, 133);

        }
        p{
            font-size: 17px;
            font-weight: lighter;
        }
        th{
            font-weight: 400;
            padding: 15px;
        }
        
        .order>p{
            text-align: right;
        }
        
        
        .customer-details>div>p{
            margin-top: 0;
            margin-bottom: 1rem;
            
        }
        
        td{
            padding: 10px 5px;
        }
        .ex{
            height: 70px;
        }
        .des{
            text-align: left;
        }
        .des>p{
            margin: 0;
        }
        .bank{
            display: block;
            width: 50%;
            
            margin-top: 20px;
            
        }
        .bank>.online>p{
            margin-left: 20px;
            text-decoration: underline;
            font-weight: 500;
        }
        
        
        .conditions{
            display: block;
            margin: 40px auto;
            

            
        }
        .conditions>p{
            margin-bottom: 0;
            margin-top: 20px;
        }
        
        
        


        
    </style>';


    $check="SELECT peace_id FROM quotations WHERE ref_id=".$id;
    $res=$conn->query($check);
    $pdfname=$id.'-'.$name;
    $create=false;
    if($res==TRUE){
        if($res->num_rows>0){
            $html.=PDF($conn,$id);
            $create=true;
        }else{
            $create=false;
            echo '<h2 style="text-align:center;margin-top:50px;">No Quotations</h2>';
        }
    }else{

    }


    function PDF($conn,$uid){
        $var='';
        $sql="SELECT name,address,email,number,reg_date,ref_id FROM customers WHERE ref_id=".$uid;
        $r=$conn->query($sql);
        if($r==TRUE){
            if($r->num_rows>0){
                //cusomer details goes here....
                $row=$r->fetch_assoc();
                $getdate="SELECT date FROM quotations WHERE ref_id=".$uid;
                $date='';
                if($conn->query($getdate)==TRUE){
                    $d=$conn->query($getdate);
                    $date=$d->fetch_assoc()['date'];
                }
                $var.=

                    '<div class="top">
                        <div class="header-details">
                            <h5><b>WARUNA  RATHNAMALALA</b></h5>
                            <p>SOLE PROPRIETOR | BUSINESS REG. NO. 15/2069</p>
                            <p>MOBILE : +94 76 210 1443</p>
                            <p>E-MAIL : info@nirmanahomedecor.lk</p>
                        </div>
                    </div>
                    
                        <div class="customer-details">
                            <div class="personal">
                                <p>CUSTOMER NAME :      '.$row["name"].'    </p>
                                <p>SITE ADDRESS :       '.ucfirst($row["address"]).' </p>
                                <p>CONTACT PERSON :     '.'SAME AS ABOVE'.' </p>
                                <p>
                                    CONTACT NUMBER :        '.$row["number"].'
                                </p>
                                <p>E-MAIL :     '.$row["email"].'   </p>
    
                            </div>
                            <div class="order">
                                <p>QUOTATION NO. :      '.$row["ref_id"].'    </p>
                                <p>QUOTATION DATE :  '.$date.'</p>
                                
                                <p>MESURMENT DATE :     '.date("Y-m-d",$row["reg_date"]).'  </p>
                                
                                <p>
                                    PREPARED BY :
                                WARUNA
                                </p>
                            </div>
                        </div>
                   
                    



                    ';
                     

                    $getquoMES="SELECT peace_id FROM quotations WHERE ref_id=".$uid;
                    $mes=$conn->query($getquoMES);
                    $total_Price=0;
                    if($mes==TRUE){
                        if($mes->num_rows>0){
                            
                            $var.= 
                            '
                            

                            <div class=" order-values" >
                                <table border="1" class=" mx-auto w-100 ">
                                <tr>
                                    <th>DESCRIPTION</th>
                                    <th>QTY</th>
                                    <th>SQ.FT</th>
                                    <th>Unit Price</th>
                                    <th>Net Amount(LKR)</th>
                                    
                                </tr>
                            ';

                            
                            while($pid=$mes->fetch_assoc()['peace_id']){
                                $get_values="SELECT unit_price,total_price,sqft FROM quotations WHERE ref_id=".$uid." AND peace_id=".$pid;
                                $valueR=$conn->query($get_values);
                                if($valueR==TRUE){
                                    if($valueR->num_rows>0){

                                        $var.= '<tr>';
                                        $prices=$valueR->fetch_assoc();

                                        $cartonD="SELECT product_name,color_code,name FROM carton,carton_locations WHERE carton.peace_id=carton_locations.peace_id AND carton.peace_id=".$pid;
                                        $details=$conn->query($cartonD);
                                        $aboutcarton='';
                                        if($details==TRUE){
                                            if($details->num_rows>0){
                                                $aboutcarton=$details->fetch_Assoc();
                                            }else{
                                                $var.= '<p class="text-center alert alert-warning">No mesuarment found!..</p>';
                                            }
                                        }else{
                                            continue;
                                        }

                                        $var.= 
                                        '
                                        
                                            <td class="des">
                                                <p>'.$aboutcarton['product_name'].'</p>
                                                <p>COLOR CODE :'.$aboutcarton['color_code'].'</p>
                                                <p>LOCATION: '.$aboutcarton['name'].'</p>
                                            </td>
                                            
                                            <td>1</td>
                                            <td>'.$prices['sqft'].'<br>SQ FT</td>
                                            <td>LKR. '.number_format((float)$prices['unit_price'],2).'</td>
                
                                            <td>LKR. '.number_format((float)$prices['total_price'],2).'</td>





                                        ';
                                        $var.= '</tr>';
                                        $total_Price+=(float)$prices['total_price'];
                                    }else{
                                        continue;
                                    }

                                }else{
                                    $var.='<p class="text-center alert alert-warning">'.$conn->error.'</p>';
                                }
                            }


                        }
                            
                        $var.= '
                            <tr class="ex">
                                <td colspan="5"></td>
                                
                            </tr>
                            <tr>
                                <td colspan="4" class="des">TOTAL MATERIAL VALUE</td>
                                <td>LKR. '.number_format($total_Price,2) .'</td>
                            </tr>
                            <tr>
                                <td colspan="4" class="des">DISCOUNT VALUE</td>
                                <td></td>

                            </tr>
                            <tr>
                                <td colspan="4" class="des">NET MATERIAL VALUE</td>
                                <td>LKR. '.number_format($total_Price,2) .'</td>
                            </tr>
                            <tr>
                                <td colspan="4" class="des">DELIVERY AND INSTALLATION CHARGES</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td colspan="4" class="des">GRAND TOTAL</td>
                                <td>LKR. '.number_format($total_Price,2) .'</td>
                            </tr>
                        </table>

                        <p style="text-align: center;"><small >LEADING SUPPLIER OF INDOOR/OUTDOOR WINDOW BLINDS AND FABRIC CURTAIN</small></p>
                        </div>';

                        

                       
                            
                    }


                    





                
            }else{
                $var.= '<p class="alert alert-warning text-center mt-3">No Customers Found !</p>';
            }
        }else{
            $var.= '<p class="alert alert-danger text-center">'.$conn->error.'-500</p>';
        }


        $var.=
        '
        <div class="conditions">
            <div class="terms">
                
                <p>
                    <b>TERMS AND CONDITIONS</b><br>
                    <ol type="1">
                        <li>Quotation is valid for 30 DAYS from the above date and with our confirmation with thereafter.</li>
                        <li>Order will be accepted, once the stock is verified</li>
                        <li>Minimum chargeable area is for Indoor Window Blinds 16 SQ.FT.</li>
                        <li>An approximate time for delivery would be 1 week for Indoor blinds and 10 days for Outdoor blinds.</li>
                        <li>Extra charges will be added if there are any additional works at the site.</li>
                        <li>Quotation will be revised after final site inspections.</li>
                    </ol>
                </p>
            </div>
            <div class="warrenty">
                <p>
                    <b>WARRENTY PERIOD</b> For Indoor Window Blinds and Curtain Accessories<br>
                    We provide one year service warranty on the product against manufacturing defects (i.e., a flaw in the product design,
                    materials or workmanship that causes the product to no longer function) under normal use and for as long as the original
                    retail purchaser owns the product. If your product is defective during the warranty period, we will repair or replace the
                    defective product.
                </p>
            </div>
            <div class="perion">
                <p>
                    <b>WARRENTY PERIOD</b> For Outdoor Local Bamboo Blinds (Waterbased)<br>
                    5 Year service warranty for factory defects.
                    NOTE : Color fading is not considered a factory defect and is not covered by the warranty
                    Manufacturer recommends the blinds to be inspected regularly and given a fresh top clear coat every 12 to 24 months,
                    or more often in areas of extreme environmental exposure. This will help to extend the life of the blinds and help preserve
                    its original factory appearance.
                </p>
            </div>
            <div class="confor">
                <p><b>COMFIRMATION</b></p>
                <p>Order to be finalized upon receiving the confirmation by an advanced payment.</p>

            </div>
            <div class="payment">
                <p><b>PAYMENT TERMS</b></p>
                50% Advanced payment on order confirmation and Balance payment after completion the job.
                Cheque to be drawn in favour of “Nirmana Home Decor”
            </div>

            <div class="bank">
                <div class="online">
                    <p>Online Transfer :</p>

                </div>
                <div class="d">
                    <p>Account Number : 0102 1000 0696</p>
                    <p>Account Name : Nirmana Home Decor</p>
                    <p>Bank : Sampath Bank</p>
                    <p>Branch : Nikaweratiya Branch</p>
                </div>
            </div>
            

            <p style="text-align: center;"><small>THANK YOU FOR YOUR BUSINESS !<br>
                NO. 594/4, MORAGALANDA MAWATHA, EREWWALA, PANNIPITIYA, SRI LANKA.
            </small></p>
        </div>

        ';

        $var.='
    
        </body>
        </html>';

        return $var;
    }




//echo $html;

if($create){
    $pdf=new \Dompdf\Dompdf();
    $pdf->setPaper('A4');
    $pdf->loadHTML($html);

    $pdf->render();
    $pdfn=$pdfname.".pdf";
    $pdf->stream($pdfn);
}

?>
