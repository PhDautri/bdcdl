<?php
ob_end_clean();
// include library //

require_once('../core/fpdf/fpdf.php');

$result = $this->Panne->affpannesAttenteRepvolet();

class PDF extends FPDF 
{

    function Header() 
    {
        $this->Image('../public/img/img_societe/iconegcs.jpg',10,15,30);
        $this->ln(20);

        $this->SetFont('Times','B',12);
        $this->Cell(277, 10, utf8_decode('Liste Des Volets En Pannes'), 1, 1, 'C');
        // ligne tableau //

	    $this->SetFont('Arial', 'IB', 10);	   
     	$this->Cell(60, 8, utf8_decode('N° Série'), 1, 0, 'C'); 		    
	    $this->Cell(40, 8, 'Niveau', 1, 0, 'C');
	    $this->Cell(40, 8, 'Lieux', 1, 0, 'C');
	    $this->Cell(40, 8, utf8_decode('Piéce'), 1, 0, 'C');
	    $this->Cell(40, 8, 'Nacelle', 1, 1, 'C');            

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
$pdf->SetTitle(utf8_decode('VoletEnPanne.pdf'));
$pdf->AliasNbPages();
$pdf->AddPage();

// Données

foreach($result as $row)
{

    $pdf->SetFont('Arial', 'I', 12);
    $pdf->Cell(60, 8, utf8_decode($row->num_serie), 1, 0, 'L');
    $pdf->Cell(40, 8, utf8_decode($row->niveau), 1, 0, 'L');
    $pdf->Cell(40, 8, utf8_decode($row->lieux), 1, 0, 'L');
    $pdf->Cell(40, 8, utf8_decode($row->piece), 1, 0, 'L');        
    $pdf->Cell(40, 8, utf8_decode($row->nacelle), 1, 0, 'L');

    $pdf->Ln();
    
}   

$pdf->Output();

?>