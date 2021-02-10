<?php

include_once './vendor/autoload.php';

$html='
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./bootstrap4/css/bootstrap.css">
</head>
<body>

    <div class="container">
        <p class="alert alert-success">Hello World</p>
    </div>
    
</body>
</html>';


$pdf=new \Dompdf\Dompdf();

$pdf->loadHtml($html,"utf-8");
$pdf->setPaper('A4');

$pdf->render();

$pdf->stream();



?>