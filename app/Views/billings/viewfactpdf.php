<?php
ob_end_clean();
// include library //
require_once('../core/fpdf/fpdf.php');

// Cell --> Largeur = 190 total //

$mTHT = $fact[0]->totalHT;
$tva = round($mTHT * 0.2, 2);
$ttc = round($mTHT + $tva, 2);

$echeance = '30 jours fin de mois';

define('EURO', chr(128));

$pdf = new FPDF('P','mm','A4');
$pdf->AddPage();

$pdf->Image('../public/img/img_societe/iconegcs.jpg',10,15,40);
$pdf->ln(30);

// ligne 1 //
$pdf->SetFont('Times','B',10);
$pdf->Cell(100, 10,'GCS DU Marsan - Clinique des Landes', 0, 0);
$pdf->Cell(90, 10, utf8_decode('Client:'), 0, 1);

// ligne 2 //
$pdf->SetFont('Arial', 'I', 10);
$pdf->Cell(50, 5, utf8_decode('250,rue Frédéric Joliot Curie'), 0, 0);
$pdf->Cell(50, 5, '', 0, 0);
$pdf->Cell(90, 5, utf8_decode($fact[0]->nom_cab), 0, 1);

//  ligne 3 //
$pdf->Cell(50, 5, utf8_decode('CS 40250'), 0, 0);
$pdf->Cell(50, 5, '', 0, 0);
$pdf->Cell(90, 5, utf8_decode('250,rue Frédéric Joliot Curie'), 0, 1);

// ligne 4 //
$pdf->Cell(50, 5, utf8_decode('40281 Saint Pierre du Mont'), 0, 0);
$pdf->Cell(50, 5, '', 0, 0);
$pdf->Cell(90, 5, utf8_decode('40281 Saint Pierre du Mont'), 0, 1);

// ligne 5 //
$pdf->Cell(50, 5, utf8_decode('Téléphone: 6770'), 0, 0);
$pdf->Cell(50, 5, '', 0, 0);
$pdf->Cell(90, 5, utf8_decode('Téléphone: '.$fact[0]->telephone), 0, 1);

$pdf->ln(30);

// ligne tableau //
$pdf->SetFont('Times','B',16);
$pdf->Cell(190, 10, utf8_decode('Facture N°: '.$fact[0]->num_fact), 1, 1, 'C');
$pdf->SetFont('Arial', 'I', 10);
$pdf->Cell(190, 6, 'Date: '.$fact[0]->dateFactfr, 1, 1);
$pdf->Cell(190, 6, utf8_decode('Echéance: '.$echeance), 1, 1);
$pdf->Cell(190, 6, utf8_decode('Sur Bon d\'Intervention n°: '.$fact[0]->num_interv), 1, 1);
$pdf->Cell(190, 6, ' ', 1, 1);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(190, 6, utf8_decode('Déscription Travaille: '.$fact[0]->designation), 1, 1, 'L');
$pdf->SetFont('Arial', 'I', 10);
$pdf->Cell(90, 6, utf8_decode('Désignation') , 1, 0, 'C');
$pdf->Cell(40, 6, utf8_decode('PU HT') , 1, 0, 'C');
$pdf->Cell(20, 6, utf8_decode('Quantité') , 1, 0, 'C');
$pdf->Cell(40, 6, utf8_decode('Montant') , 1, 1, 'C');
	    	    
// Données
foreach($line as $row)
{

    $pdf->Cell(90, 6,utf8_decode($row->designation), 'LR', 0);
    $pdf->Cell(40, 6,number_format($row->ligne_ht, 2, '.', '').' '.EURO, 'LR', 0, 'C');
    $pdf->Cell(20, 6,$row->quantite,'LR',0,'C');
    $pdf->Cell(40, 6,number_format($row->montantTHT, 2, '.', '').' '.EURO, 'LR', 0, 'C');
    $pdf->Ln();
}

// ligne Vide // 
$pdf->Cell(90, 6, '', 'LR', 0, '');
$pdf->Cell(40, 6, '', 'LR', 0, '');
$pdf->Cell(20, 6, '', 'LR', 0, '');
$pdf->Cell(40, 6, '', 'LR', 1, '');

// ligne Total HT //	    
$pdf->Cell(90, 6, 'ToTal HT', 'LR', 0, 'L');
$pdf->Cell(40, 6, '', 'LR', 0, '');
$pdf->Cell(20, 6, '', 'LR', 0, '');
$pdf->Cell(40, 6, number_format($mTHT, 2, '.', '').' '.EURO, 'LR', 1, 'C');

// ligne TVA //
$pdf->Cell(90, 6, 'TVA 20%', 'LR', 0, 'L');
$pdf->Cell(40, 6, '', 'LR', 0, '');
$pdf->Cell(20, 6, '', 'LR', 0, '');
$pdf->Cell(40, 6, number_format($tva, 2, '.', '').' '.EURO, 'LR', 1, 'C');

// ligne Vide // 
$pdf->Cell(90, 6, '', 'LRB', 0, '');
$pdf->Cell(40, 6, '', 'LRB', 0, '');
$pdf->Cell(20, 6, '', 'LRB', 0, '');
$pdf->Cell(40, 6, '', 'LRB', 1, '');

// ligne Vide // 
$pdf->Cell(90, 6, '', '', 0, '');
$pdf->SetFont('Times','B', 12);
$pdf->Cell(60, 6, 'TOTAL A PAYER:', 'LRB', 0, '');
$pdf->Cell(40, 6, number_format($ttc, 2, '.', '').' '.EURO, 'LRB', 1, 'C');

// ligne bon pour accord & le: & signature //

$pdf->ln(10);
$pdf->SetFont('Times', 'I', 12);
$pdf->text(10, 200, 'GCS DU MARSAN');
$pdf->text(10, 205, utf8_decode('Relevé D\'identité Bancaire CIC SUD OUEST'));
$pdf->text(10, 210, utf8_decode('Identifiant International de compte bancaire'));
$pdf->text(10, 220, 'IBAN');
$pdf->text(10, 225, 'FR 76 1005 7190 1200 0201 5680 219');

$pdf->Output('I', 'Facture.pdf');

?>