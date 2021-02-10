<?php
include_once './conn.php';

if(isset($_POST['done'])){
    $_SESSION['count']='';
    $_SESSION['location']='';
    
    header('Location:./mesurment.php');
    

}else if(isset($_POST['update'])){
    $refid=$_POST['refid'];
    $peaceid=$_POST['peaceid'];
    $locationName=$_POST['location']?$_POST['location']:'N/A';
    $productName=$_POST['pname'];
    $colorCode=$_POST['colorcode'];
    $width=$_POST['width'];
    $height=$_POST['height'];
    $control=$_POST['control'];
    $additonal=$_POST['additional']?trim($_POST['additional']):'N/A';

    
    if(updateDate($conn,$peaceid,$locationName,$productName,$colorCode,$width,$height,$control,$additonal,$refid)){
        setcookie('msg','Update Completed !',time()+20);
        header('Location:./view.php');
    }else{
        setcookie('error','Could not save data !',time()+20);
        header('Location:./view.php');
    }


    

}else if(isset($_GET['peaceid'])){

    $peaceid=$_GET['peaceid'];
    $sql="DELETE FROM carton WHERE peace_id=".$peaceid.";";
    $sql2="DELETE FROM carton_locations WHERE peace_id=".$peaceid.";";
    $se="SELECT name,id FROM carton_locations WHERE peace_id=".$peaceid;
    if($conn->query($sql)==TRUE){
        $result=$conn->query($se);
        if($result==TRUE){
            if($result->num_rows>0){
                if($conn->query($sql2)==TRUE){
                    setcookie('msg','Successfuly Deleted!',time()+20);
                    echo true;
                    return true;
                }else{
                    setcookie('error',$conn->error.' location',time()+20);
                }


            }else{
                setcookie('msg','Successfuly Deleted!',time()+20);
                echo false;
                return true;
            }


        }else{
            setcookie('error',$conn->error.' slect location',time()+20);
            return false;

        }
    }else{
        setcookie('error','Colud not complete ! 500',time()+20);
        echo $conn->error;
        return false;

    }




}else if(isset($_GET['save'])){
    $location=$_GET['location'];
    $code=$_GET['code'];
    $pn=$_GET['pname'];
    $unit=$_GET['sf'];
    $qty=$_GET['qty'];
    $price=$_GET['price'];
    $total=$_GET['total'];

    $sql="INSERT INTO cortation(name,location,code,qty,sqf,price,tp) VALUES("."'".$pn."'".","."'".$location. 
    "'".","."'".$code."'".",".$qty.","."'".$unit."'".","."'".$price."'".","."'".$total."'".")";

    $result=$conn->query($sql);
    if($result==TRUE){
        echo 'Saved!';
        echo true;

    }else{
        echo 'Not Saved!';
        echo false;
    }






}else if(isset($_GET['discount'])){
    $dis=$_GET['discount'];
    $ref=$_GET['ref'];

    $sql="INSERT INTO discount(value,ref_id) VALUES("."'".$dis."'".",".$ref.")";
    if($conn->query($sql)==TRUE){
        echo true;
    }else{
        echo false;
        echo $conn->error;
    }
}
else{
    header('Location:form.php');
}

if(isset($_POST['finish'])){
    echo 'done';
}


function updateDate($connection,$peace_id,$location,$pname,$colorcode,$width,$height,$control,$add,$ref_id){
    $sql1="UPDATE carton SET product_name="."'".$pname."'".","."color_code="."'".$colorcode."'".","."width="."'".$width."'".","."height="."'".$height."'".","."control=".
    "'".$control."'".","."additional="."'".$add."'"."WHERE peace_id=".$peace_id." AND ref_id=".$ref_id.";";

    $sql2="UPDATE carton_locations SET name="."'".$location."'"." WHERE peace_id=".$peace_id.";";
    $ch="SELECT peace_id FROM carton_locations WHERE peace_id=".$peace_id;
    
    if($connection->query($sql1)==TRUE){
        $r=$connection->query($ch);
        if($r==TRUE){
            if($r->num_rows>0){
                if($connection->query($sql2)==TRUE){
                    return true;
                }else{
                    return 'Location:-.<br>'.$connection->error;
                }
            }else{
                $sql2="INSERT INTO carton_locations(name,peace_id) VALUES("."'".$location."'".",".$peace_id.")";
                if($connection->query($sql2)==TRUE){
                    return true;
                }else{
                    return false;
                }
            }

        }else{
            return false;
        }
    }else{
        return false;
    }
}

$conn->close();
?>