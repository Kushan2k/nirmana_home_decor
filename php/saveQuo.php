<?php

include_once './conn.php';

if(isset($_GET['refid'])&& isset($_GET['peaceid'])){
    $pid=$_GET['peaceid'];
    $rid=$_GET['refid'];
    $sqft=$_GET['sqft'];
    $qty=$_GET['qty'];
    $price=$_GET['price'];
    $total=$_GET['total'];
    $date=$_GET['date'];

    if(check($conn,$rid,$pid)){
        echo updateDATA($conn,$pid,$rid,$sqft,$qty,$price,$total);
    }else{
        echo insertDATA($conn,$pid,$rid,$sqft,$qty,$price,$total,$date);
    }

    
}

if(isset($_GET['del'])){
    echo DeleteData($conn,$_GET['refid']);
}


function check($conn,$ref,$pid){
    $sql="SELECT id FROM quotations WHERE peace_id=".$pid." AND ref_id=".$ref;
    $res=$conn->query($sql);
    if($res==TRUE){
        if($res->num_rows>0){
            return true;
        }else{
            return false;
        }
    }else{
        return $conn->error;
    }
}


function insertDATA($conn,$pid,$ref,$sq,$qt,$up,$total,$date){
    $sql="INSERT INTO quotations(qty,unit_price,sqft,total_price,date,peace_id,ref_id) VALUES("."'".$qt."'".
    ","."'".$up."'".",".
    "'".$sq."'".","."'".$total."'".","."'".$date."'".",".$pid.",".$ref.")";

    $result=$conn->query($sql);
    if($result==TRUE){
        return "Insert Successful!";
    }else{
        return $conn->error;
    }

}

function updateDATA($conn,$pid,$ref,$sq,$qt,$up,$total){
    $sql="UPDATE quotations SET qty="."'".$qt."'".","."sqft="."'".$sq."'".","."unit_price="."'".$up."'".",". 
    "total_price="."'".$total."'"." WHERE peace_id=".$pid." AND ref_id=".$ref;

    $result=$conn->query($sql);
    if($result==TRUE){
        return "Update Successful!";
    }else{
        return $conn->error;
    }
}


function DeleteData($conn,$ref){
    $sql="SELECT id FROM quotations WHERE  ref_id=".$ref;
    $res=$conn->query($sql);
    if($res==TRUE){
        if($res->num_rows>0){
            
            
            $del="DELETE FROM quotations WHERE ref_id=".$ref;
            if($conn->query($del)==TRUE){
                return 'Delete Successful!';
            }else{
                return $conn->error;
            }
        }else{
            return 'No Saved data Found';
        }
    }else{
        return $conn->error;
    }
}






?>