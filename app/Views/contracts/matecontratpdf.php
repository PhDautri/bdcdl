<?php
ob_end_clean();
// include library //

require_once('../core/fpdf/fpdf.php');

$result = $this->Material->MateContrat($_GET['id']);

class PDF extends FPDF 
{

    function Header() 
    {
        $this->Image('../public/img/img_societe/iconegcs.jpg',10,15,30);
        $this->ln(20);

        $this->SetFont('Times','B',12);
        $this->Cell(260, 10, utf8_decode('Liste Du Matériel lié au Contrat'), 1, 1, 'C');
        // ligne tableau //

	    $this->SetFont('Arial', 'IB', 10);
	    $this->Cell(10, 8, 'Id', 1, 0, 'C');
     	$this->Cell(30, 8, utf8_decode('N° Inventaire'), 1, 0, 'C'); 		    
     	$this->Cell(40, 8, 'Produit', 1, 0, 'C'); 		    
	    $this->Cell(25, 8, 'Marque', 1, 0, 'C');
        $this->Cell(40, 8, 'Model', 1, 0, 'C');            
        $this->Cell(25, 8, 'Type', 1, 0, 'C');            
        $this->Cell(45, 8, utf8_decode('N° Série'), 1, 0, 'C');            
        $this->Cell(20, 8, 'Statut', 1, 0, 'C');          
	    $this->Cell(25, 8, 'Total Pannes', 1, 1, 'C');            

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
$pdf->SetTitle(utf8_decode('Materielcontrat.pdf'));
$pdf->AliasNbPages();
$pdf->AddPage();

// Données

foreach($result as $row)
{

    $pdf->SetFont('Arial', 'I', 8);
    $pdf->Cell(10, 8, $row->id, 1, 0, 'C');
    $pdf->Cell(30, 8, utf8_decode($row->num_inventaire), 1, 0, 'C');
    $pdf->Cell(40, 8, utf8_decode($row->produit), 1, 0, 'C');
    $pdf->Cell(25, 8, utf8_decode($row->marque), 1, 0, 'C');
    $pdf->Cell(40, 8, utf8_decode($row->model), 1, 0, 'C'); 
    $pdf->Cell(25, 8, utf8_decode($row->type), 1, 0, 'C'); 
    $pdf->Cell(45, 8, utf8_decode($row->num_serie), 1, 0, 'C'); 
    $pdf->Cell(20, 8, utf8_decode($row->statut), 1, 0, 'C'); 
    $pdf->Cell(25, 8, utf8_decode($row->nbrtotalpanne), 1, 1, 'C');    
    
}   

$pdf->Output();

?>