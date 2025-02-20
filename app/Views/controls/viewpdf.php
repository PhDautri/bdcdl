<?php
ob_end_clean();
// include library //

require_once('../core/fpdf/fpdf.php');

$result = $this->Control->All();

class PDF extends FPDF 
{

    function Header() 
    {
        $this->Image('../public/img/img_societe/iconegcs.jpg',10,15,30);
        $this->ln(20);

        $this->SetFont('Times','B',12);
        $this->Cell(275, 10, utf8_decode('Liste Des Contrôles Réglementaire'), 1, 1, 'C');
        // ligne tableau //

	    $this->SetFont('Arial', 'IB', 10);
	    $this->Cell(10, 8, 'Id', 1, 0, 'C');
     	$this->Cell(30, 8, utf8_decode('Type'), 1, 0, 'C'); 		    
     	$this->Cell(30, 8, utf8_decode('Catégorie'), 1, 0, 'C'); 		    
	    $this->Cell(25, 8, utf8_decode('Contrôleur'), 1, 0, 'C');
        $this->Cell(20, 8, utf8_decode('Fréq.'), 1, 0, 'C');            
        $this->Cell(40, 8, 'Nom', 1, 0, 'C');            
        $this->Cell(30, 8, 'Planification', 1, 0, 'C');            
        $this->Cell(30, 8, utf8_decode('Vérification'), 1, 0, 'C');            
        $this->Cell(30, 8, utf8_decode('Der. Contrôle'), 1, 0, 'C');            
	    $this->Cell(30, 8, utf8_decode('Echéance'), 1, 1, 'C');            

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
$pdf->SetTitle(utf8_decode('TousLescontroles.pdf'));
$pdf->AliasNbPages();
$pdf->AddPage();

// Données

foreach($result as $row)
{

    $pdf->SetFont('Arial', 'I', 10);
    $pdf->Cell(10, 8, $row->id, 1, 0, 'C');
    $pdf->Cell(30, 8, utf8_decode($row->type), 1, 0, 'C');
    $pdf->Cell(30, 8, utf8_decode($row->categorie), 1, 0, 'C');
    $pdf->Cell(25, 8, utf8_decode($row->controleur), 1, 0, 'C');
    $pdf->Cell(20, 8, utf8_decode($row->frequency), 1, 0, 'C'); 
    $pdf->Cell(40, 8, utf8_decode($row->nom), 1, 0, 'C');
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->SetTextColor(0,102,255); 
    $pdf->Cell(30, 8, utf8_decode($row->planif), 1, 0, 'C');     
    $pdf->Cell(30, 8, utf8_decode($row->verification), 1, 0, 'C');
    $pdf->SetTextColor(51,204,51);  
    $pdf->Cell(30, 8, utf8_decode($row->last_control), 1, 0, 'C');
    $pdf->SetTextColor(200,40,40); 
    $pdf->Cell(30, 8, utf8_decode($row->deadline), 1, 1, 'C'); 
    $pdf->SetTextColor(0,0,0);
}   

$pdf->Output();

?>