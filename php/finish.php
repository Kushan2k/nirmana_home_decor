<?php
session_start();
include './conn.php';

//include_once '../vendor/autoload.php';

if(!isset($_COOKIE['user'])){
    header('Location:../index.php');
}

if(isset($_GET['finish'])){
    $id=isset($_GET['ref'])?$_GET['ref']:$_COOKIE['id'];
    $_SESSION['location']='';
    

    
    //$pdf=new \Mpdf\Mpdf();




    
    if(savetofile($conn,$id)){
        setcookie('id',);
        session_unset();
        //$pdf->Output();

        header('Location:./admin.php');
        
    }else{
        
        setcookie('save_error','Faild to Write to a file! -500',time()+10);
        
        
    }
    

    header('Location:./admin.php');

    //TODO

    //send email function 
    //recipt function
    //send recipt function

    

    
    //



}else{
    header('Location:../index.php');
}
if(isset($_GET['fix'])){
    $col=$_GET['col'];
    $ref=$_GET['ref'];
    $fix=$_GET['fix'];
    $sql="UPDATE customers set ".$col."="."'".$fix."'"."WHERE ref_id=".$ref;
    if($conn->query($sql)==TRUE){
        $s="SELECT ".$col." FROM customers WHERE ref_id=".$ref;
        if($conn->query($s)==TRUE){
            $r=$conn->query($s);
            setcookie('msg','Update Complete!..',time()+30);
            echo $r->fetch_assoc()[$col];
        }else{
            setcookie('error','Update Faild!',time()+30);
            echo 'N/A';
        }
    }else{
        echo 'Could not Update Fixing Date!';
    }
}

function savetofile($conn,$id){
    $refid=$id;
    
    

    $sql="SELECT ref_id,name,email,number,address,reg_date,fix_date FROM customers WHERE ref_id=".$refid;
    $result=$conn->query($sql);
    if($result==TRUE){
        if($result->num_rows>0){
            while($row=$result->fetch_assoc()){
                $filename='../data_files/'.$row['name'].'_'.$row['ref_id'].'.txt';
                //open the file
                $file=fopen($filename,'w');
                //string to write
                $string="Name:- ".ucfirst($row['name'])."\n"."Email:- ".$row['email']."\n"."Number:- ".$row['number']."
                \n"."Address:- ".$row['address']."\n"."Placed Date:- ".$row['reg_date']."\n"."Fixing Date:- ".$row['fix_date']."\n\n\n";
                fwrite($file,$string);

                $pdfstring="Name:- ".ucfirst($row['name'])."<br>"."Email:- ".$row['email']."<br>"."Number:- ".$row['number']."
                <br>"."Address:- ".$row['address']."<br>"."Placed Date:- ".$row['reg_date']."<br>"."Fixing Date:- ".$row['fix_date']."<br><br><hr>";
                fwrite($file,$string);

                //$pdf->WriteHTML($pdfstring);

                $sql2="SELECT peace_id,product_name,color_code,width,height,control,additional FROM carton WHERE ref_id=".$refid;
                $result2=$conn->query($sql2);
                if($result2==TRUE){
                    if($result2->num_rows>0){
                        while($row2=$result2->fetch_assoc()){
                            $sql3="SELECT name FROM carton_locations WHERE peace_id=".$row2['peace_id'];
                            $result3=$conn->query($sql3);
                            if($result3==TRUE){
                                if($result3->num_rows>0){
                                    while($row3=$result3->fetch_assoc()){
                                        $string2="Location:- ".ucfirst($row3['name'])."\n"."\tProduct Name:- ".$row2['product_name']."\n".
                                        "\tColor Code:- ".$row2['color_code']."\n"."\tWidth:- ".$row2['width']."\n"."\tHeight:- ".$row2['height']."\n".
                                        "\tControl:- ". ucfirst($row2['control'])."\n".
                                        "\tAddition Details:- ".ucfirst($row2['additional'])."\n\n\n";

                                        /*$string3="Location:- ".$row3['name']."<br>"."Product Name:- ".$row2['product_name']."<br>".
                                        "Color Code:- ".$row2['color_code']."<br>"."Width:- ".$row2['width']."<br>"."Height:- ".$row2['height']."<br>".
                                        "Control:- ".$row2['control']."<br>"."Fixing Details:- ".$row2['fixing_details']."<br>"."Bracket Type:- ".$row2['brackets_type']."<br>".
                                        "Fixing Type:- ".$row2['fixing_type']."<br><hr>";*/
                                        
                                        $pdfstring2="Location:- ".ucfirst($row3['name'])."<br>"."---Product Name:- ".$row2['product_name']."<br>".
                                        "---Color Code:- ".$row2['color_code']."<br>"."---Width:- ".$row2['width']."<br>"."---Height:- ".$row2['height']."<br>".
                                        "---Control:- ". ucfirst($row2['control'])."<br>".
                                        "---Addition Details:- ".ucfirst($row2['additional'])."<br><br><hr>";



                                        fwrite($file,$string2);
                                       // $pdf->WriteHTML($pdfstring2);

                                        return true;
                                    }
                                    //return true;
                                }else{
                                    $error="Location:- Not Specified !! \n"."\tProduct Name:- ".$row2['product_name']."\n".
                                    "\tColor Code:- ".$row2['color_code']."\n"."\tWidth:- ".$row2['width']."\n"."\tHeight:- ".$row2['height']."\n".
                                    "\tControl:- ". ucfirst($row2['control'])."\n".
                                    "\tAdditional Details:- ".ucfirst($row2['additional'])."\n\n\n";
                                    fwrite($file,$error);

                                    $pdferror="Location:- Not Specified !! <br>"."---Product Name:- ".$row2['product_name']."<br>".
                                    "---Color Code:- ".$row2['color_code']."<br>"."---Width:- ".$row2['width']."<br>"."---Height:- ".$row2['height']."<br>".
                                    "---Control:- ". ucfirst($row2['control'])."<br>".
                                    "---Additional Details:- ".ucfirst($row2['additional'])."<br><br><hr>";
                                    //$pdf->WriteHTML($pdferror);
                                }
                            }else{
                                echo '<script>alert("Couldn\'t save data!--500")</script>';
                                //header('Location:../index.php');
                                
                                return false;
                                

                            }
                        }
                    }else{
                        fwrite($file,'No Product Found!');
                        
                    }
                }else{
                    setcookie('save_error','<script>alert("Couldn\'t save data!--500")</script>',time()+60,'/');
                    return false;
                    //header('Location:../index.php');
                    

                    
                }
                fclose($file);
                
            }
        }else{
            echo '<script>alert("No Customer Found!")</script>';
        }
    }else{
        setcookie('save_error','<script>alert("Couldn\'t save data!--500")</script>',time()+60,'/');
        return false;
        
        //header('Location:../index.php');
    }
    

    

}
$conn->close();


?>

