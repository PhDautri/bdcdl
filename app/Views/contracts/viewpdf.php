<?php
ob_end_clean();
// include library //

require_once('../core/fpdf/fpdf.php');

$result = $this->Contract->AllContract();

class PDF extends FPDF 
{

    function Header() 
    {
        $this->Image('../public/img/img_societe/iconegcs.jpg',10,15,30);
        $this->ln(20);

        $this->SetFont('Times','B',12);
        $this->Cell(190, 10, utf8_decode('Liste Des Contrat'), 1, 1, 'C');
        // ligne tableau //

	    $this->SetFont('Arial', 'IB', 10);
	    $this->Cell(10, 8, 'Id', 1, 0, 'C');
     	$this->Cell(60, 8, utf8_decode('N° Contrat'), 1, 0, 'C'); 		    
     	$this->Cell(50, 8, utf8_decode('Intervenant'), 1, 0, 'C'); 		    
	    $this->Cell(40, 8, 'Date Debut', 1, 0, 'C');
	    $this->Cell(30, 8, 'Durer (Mois)', 1, 1, 'C');            

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

$pdf = new PDF('P','mm','A4');
$pdf->SetTitle(utf8_decode('TousLescontrat.pdf'));
$pdf->AliasNbPages();
$pdf->AddPage();

// Données

foreach($result as $row)
{

    $pdf->SetFont('Arial', 'I', 8);
    $pdf->Cell(10, 8, $row->id, 1, 0, 'C');
    $pdf->Cell(60, 8, utf8_decode($row->num_contrat), 1, 0, 'C');
    $pdf->Cell(50, 8, utf8_decode($row->nom), 1, 0, 'C');
    $pdf->Cell(40, 8, utf8_decode($row->date_deb), 1, 0, 'C');
    $pdf->Cell(30, 8, utf8_decode($row->durer), 1, 1, 'C'); 
    
}   

$pdf->Output();

?>