<?php
ob_end_clean();
// include library //
require_once('../core/fpdf/fpdf.php');

// Cell --> Largeur = 190 total //

$pdf = new FPDF('P','mm','A4');
$pdf->AddPage();

$pdf->Image('../public/img/img_societe/iconegcs.jpg',10,15,30);
$pdf->ln(20);

$pdf->SetFont('Times','B',12);
$pdf->Cell(190, 10, utf8_decode('TOUS LES BONS D\'INTERVENTIONS'), 1, 1, 'C');

// ligne tableau //

$pdf->SetFont('Arial', 'IB', 10);
$pdf->Cell(10, 8, 'Id', 1, 0, 'C');
$pdf->Cell(20, 8, 'Date Interv', 1, 0, 'C');
$pdf->Cell(50, 8, 'Client' , 1, 0, 'C');
$pdf->Cell(110, 8, utf8_decode('Désignation') , 1, 1, 'C');
	    	    
// Données
$pdf->SetFont('Times', 'I', 10);
foreach($interv as $row)
{

    $pdf->Cell(10, 6,$row->id, 1, 0, 'C');
    $pdf->Cell(20, 6,$row->datefr, 1 , 0, 'C');
    $pdf->Cell(50, 6,utf8_decode($row->nom_cab),1 ,0,'C');
    $pdf->Cell(110, 6,utf8_decode($row->designation), 1 , 0, 'L');
    $pdf->Ln();
}

$pdf->Output();

?>