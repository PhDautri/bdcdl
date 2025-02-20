<?php
ob_end_clean();
// include library //
require_once('../core/fpdf/fpdf.php');

$result = $this->Contributor->allContributExt();

class PDF extends FPDF 
{

    function Header() 
    {
        $this->Image('../public/img/img_societe/iconegcs.jpg',10,15,30);
        $this->ln(20);

        $this->SetFont('Times','B',12);
        $this->Cell(277, 10, utf8_decode('Liste Des Intervenants Extérieur'), 1, 1, 'C');
        // ligne tableau //

	    $this->SetFont('Arial', 'IB', 10);
	    $this->Cell(10, 8, 'Id', 1, 0, 'C');		    
	    $this->Cell(40, 8, 'Nom', 1, 0, 'C');
	    $this->Cell(85, 8, 'Adresse', 1, 0, 'C');
	    $this->Cell(25, 8, 'Code Postal', 1, 0, 'C');
	    $this->Cell(30, 8, 'Ville', 1, 0, 'C');
	    $this->Cell(25, 8, utf8_decode('Téléphone'), 1, 0, 'C');
	    $this->Cell(62, 8, 'Site Web', 1, 1, 'C');            

    }   

    // Pied de page
    function Footer()
    {
        // Positionnement à 1,5 cm du bas
        $this->SetY(-15);
        // Police Arial italique 8
        $this->SetFont('Arial','I',8);
        // Numéro de page
        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
    }
}

$pdf = new PDF('L','mm','A4');
$pdf->SetTitle('AllContriExt.pdf');
$pdf->AliasNbPages();
$pdf->AddPage();

// Données

foreach($result as $row)
{

    $pdf->SetFont('Arial', 'I', 8);
    $pdf->Cell(10, 8, $row->id, 1, 0, 'C');
    $pdf->Cell(40, 8, utf8_decode($row->nom), 1, 0, 'L');
    $pdf->Cell(85, 8, utf8_decode($row->adresse), 1, 0, 'L');        
    $pdf->Cell(25, 8, $row->code_postal, 1, 0, 'C');
    $pdf->Cell(30, 8, utf8_decode($row->ville), 1, 0, 'L');
    $pdf->Cell(25, 8, utf8_decode($row->num_phone), 1, 0, 'C');
    $pdf->Cell(62, 8, utf8_decode($row->site_web), 1, 0, 'L');

    $pdf->Ln();
    
}   

$pdf->Output();

?>
