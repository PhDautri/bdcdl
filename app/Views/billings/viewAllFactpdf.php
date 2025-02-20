<?php
ob_end_clean();
// include library //
require_once('../core/fpdf/fpdf.php');

// Cell --> Largeur = 190 total //

define('EURO', chr(128));

$pdf = new FPDF('P','mm','A4');
$pdf->AddPage();

$pdf->Image('../public/img/img_societe/iconegcs.jpg',10,15,30);
$pdf->ln(20);

$pdf->SetFont('Times','B',12);
$pdf->Cell(190, 10, utf8_decode('TOUTES LES FACTURES'), 1, 1, 'C');

// ligne tableau //

$pdf->SetFont('Arial', 'IB', 10);
$pdf->Cell(10, 8, 'Id', 1, 0, 'C');
$pdf->Cell(20, 8, 'Date Interv', 1, 0, 'C');
$pdf->Cell(50, 8, 'Client' , 1, 0, 'C');
$pdf->Cell(55, 8, utf8_decode('Numéro Facture') , 1, 0, 'C');
$pdf->Cell(55, 8, utf8_decode('Montant TTC') , 1, 1, 'C');
	    	    
// Données
$pdf->SetFont('Times', 'I', 10);
foreach($fact as $row)
{

    $pdf->Cell(10, 6,$row->id, 1, 0, 'C');
    $pdf->Cell(20, 6,$row->date_fafr, 1 , 0, 'C');
    $pdf->Cell(50, 6,utf8_decode($row->nom_cab),1 ,0,'C');
    $pdf->Cell(55, 6,utf8_decode($row->num_fact), 1 , 0, 'C');
    $pdf->Cell(55, 6,utf8_decode($row->montantTTC).' '.EURO, 1 , 0, 'C');
    $pdf->Ln();
}

$pdf->Output('I', 'Factures.pdf');

?>