<?php
include_once '../vendor/autoload.php';
include_once './conn.php';
//include_once '../vendor/dompdf/dompdf/src/Autoloader.php';


if(isset($_POST['finish'])){
     $html=$_POST['pdf'];
     
    $pdf=new  Dompdf\Dompdf();
    $opo=new \Dompdf\Options();
    $opo->setIsPhpEnabled(true);
    $pdf->loadHtml($_POST['pdf']);
    $pdf->setPaper('A4');
    $pdf->render();
 
    $pdf->stream('Quotation.pdf',array('Atatachment'=>1));
     
 
    $sql="DELETE FROM discount;";
    $sql.="DELETE FROM cortation;";
    $sql.="ALTER TABLE discount AUTO_INCREMENT=1;";
    $sql.="ALTER TABLE cortation AUTO_INCREMENT=1;";
    if(!$conn->multi_query($sql)==TRUE){
        header('Location:./admin.php');
 
    }
 
 
    header('Location:./admin.php');
}


?>