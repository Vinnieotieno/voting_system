
<?php
require('fpdf184/fpdf.php');
include "database/config.php";
$sql = "SELECT president,COUNT(*) FROM votes GROUP BY president";
$result = mysqli_query($conn, $sql);
$votedPresident = mysqli_fetch_all($result,MYSQLI_ASSOC);
$county = $_POST['county'];

$sql1 = "SELECT governor ,COUNT(*) FROM votes WHERE county ='$county' GROUP BY governor ";
$result1 = mysqli_query($conn, $sql1);
$votedGovernor = mysqli_fetch_all($result1,MYSQLI_ASSOC);

$sql2 = "SELECT senator ,COUNT(*) FROM votes WHERE county ='$county' GROUP BY senator ";
$result2 = mysqli_query($conn, $sql2);
$votedSenator = mysqli_fetch_all($result2,MYSQLI_ASSOC);

$sql3 = "SELECT women ,COUNT(*) FROM votes WHERE county ='$county' GROUP BY women ";
$result3 = mysqli_query($conn, $sql3);
$votedWomen = mysqli_fetch_all($result2,MYSQLI_ASSOC);


$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
foreach($votedPresident as $president){
    $pdf->SetFont('Arial','',12);
    $pdf->Ln();
    foreach($president as $press){
        $pdf->Cell(90,12,$press,1);
    }
}

foreach($votedGovernor as $governor){
    $pdf->SetFont('Arial','',12);
    $pdf->Ln();
    foreach($governor as $gov){
        $pdf->Cell(90,12,$gov,1);
    }
}

foreach($votedSenator as $senator){
    $pdf->SetFont('Arial','',12);
    $pdf->Ln();
    foreach($senator as $sen){
        $pdf->Cell(90,12,$sen,1);
    }
}

foreach($votedWomen as $women){
    $pdf->SetFont('Arial','',12);
    $pdf->Ln();
    foreach($women as $men){
        $pdf->Cell(90,12,$men,1);
    }
}
$pdf->Output();
?>
