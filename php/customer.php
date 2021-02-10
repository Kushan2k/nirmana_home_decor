<?php
session_start();
require_once 'conn.php';
date_default_timezone_set('Asia/Colombo');



if(isset($_POST['create'])){

    //get form data form app.php
    $customerName=htmlspecialchars(trim($_POST['name']));
    
    $customerEmail=$_POST['email']?htmlspecialchars(trim($_POST['email'])):'N/A';
    $customerNumber=$_POST['number']?htmlspecialchars(trim($_POST['number'])):'N/A';
    $date=time();
    $customerAddress=$_POST['address']?htmlspecialchars(trim($_POST['address'])):'N/A';
    $sa=$_POST['salutation']?$_POST['salutation']:'Mr/Mrs';
    $Cname=$sa.". ".$customerName;
    $ap=$_POST['appointment']?$_POST['appointment']:'Not Selected';
    $rmarks=$_POST['remarks']?$_POST['remarks']:'N/A';
    
    
    $refid=insert_data($conn,$Cname,$customerEmail,$customerNumber,$customerAddress,$date,$ap,$rmarks);
    
    if($refid){
        //setcookie('id',$refid);
        //pass in ref id as a url parameeter
        //header('Location:./mesurment.php?email='.$customerEmail.'&refid='.$refid);
        header('Location:./admin.php');
        
    }
    else{
        header('Location:./add.php');
        
    }


}else if(isset($_POST['take'])){
    setcookie('id',$_POST['ref']);
    header('Location:./mesurment.php?ref='.$_POST['ref']);


}else if(isset($_POST['del'])){
    $id= $_POST['ref'];
    $sql="DELETE FROM customers WHERE ref_id=".$id;
    $sql2="SELECT peace_id FROM carton WHERE ref_id=".$id;
    if($conn->query($sql)==TRUE){
        if($conn->query($sql2)==TRUE){
            $result=$conn->query($sql2);
            if($result->num_rows>0){
                while($row=$result->fetch_assoc()){
                    $sql3="DELETE FROM carton_locations WHERE peace_id=".$row['peace_id'];
                    $sql4="DELETE FROM carton WHERE peace_id=".$row['peace_id'];
                    if($conn->query($sql3)==TRUE){
                        if($conn->query($sql4)==TRUE){
                            setcookie('msg','Delete Completd !',time()+20);
                            header('Location:./view.php');
                        }else{
                            echo $conn->error;
                        }
                        
                        
                    }else{
                        echo $conn->error.'<br>500';
                    }
                }
            }else{
                setcookie('msg','Delete Completd !',time()+20);
                header('Location:./view.php');
            }
        }else{
            echo $conn->error;
            setcookie('error','Problem Deleting -500 !',time()+20);
        }

    }else{
        echo $conn->error;
        setcookie('error','Problem Deleting -500 !',time()+20);
    }
}
else{
    header('Location:./add.php');
}

function insert_data($connection,$name,$email='N/A',$number='N/A',$address='N/A',$regdate,$appo='Not Enterd',$remark){


    $reg=date('Y-m-d',$regdate);
    $fixdate='Not Enterd';

    //insert customer to the database
    $sql="INSERT INTO customers(name,email,number,address,reg_date,register_date,ap_date,fix_date,remarks) VALUES("."'".($name).
    "'".","."'".$email."'".","."'".$number."'".","."'".$address."'".","."'".(string)$regdate."'".",".
    "'".$reg."'".","."'".$appo."'".","."'".$fixdate."'".","."'".$remark."'".")";

    if($connection->query($sql)==TRUE){
        //get customer id from the database
        $id="SELECT ref_id FROM customers WHERE reg_date="."'".$regdate."'";
        $result=$connection->query($id);
            return (int)$result->fetch_assoc()['ref_id'];

    }else{
        setcookie('id_error','Problem connecting to the database ! please try again later.<br>'.$connection->error,time()+60);
    }
}


?>