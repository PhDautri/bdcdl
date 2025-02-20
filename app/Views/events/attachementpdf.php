<?php
ob_end_clean();

// include library //
require_once('../core/fpdf/fpdf.php');

class PDF extends FPDF
{
    // En-tête
    function Header()
    {
        // Logo
        $this->Image('../public/img/img_societe/iconegcs.jpg',10,6,30);
        // Police Arial gras 15
        $this->SetFont('Arial','B',15);
        // Décalage à droite
        $this->Cell(60);
        // Titre
        $this->Cell(80,10,utf8_decode('Liste des matériels en panne'),1,0,'C');
        // Saut de ligne
        $this->Ln(40);
        // affiche la date 
        $this->SetFont('Times','I',12);
        $this->Cell(150, 0, 'Saint Pierre Du Mont Le, '.date('d-m-Y'), 0,1, 'C');
        // saut de ligne
        $this->ln(15);

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

// Instanciation de la classe dérivée
$pdf = new PDF('P', 'mm','A4');
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','I',12);

// affiche du text 
$pdf->Cell(10, 0, utf8_decode('Bonjour,  '), 0, 1);
$pdf->ln(15);
$pdf->Cell(0, 0, utf8_decode('Voici la liste du matériels en panne avec numéro de série et leurs panne,  '), 0, 'L', 1);
$pdf->Cell(0, 10, utf8_decode('vous trouverais aussi le besoin ou non de nacelle pour ces interventions.'), 0, 'L', 1);

$pdf->ln(20);
for ($n=1; $n<=$key; $n++) {
    $i = $n-1;
    $mate = $this->Material->findmatepannePdfEmail($val[$i]);
    
    $line = $mate[0]->mate;
    $niv = $mate[0]->niv;
    $lieu = "Lieux: ".$mate[0]->lieux;
    $piece = "Piéce: ".$mate[0]->piece;
    $design = "Panne: ".$mate[0]->design;

    if ($mate[0]->nacelle == 0) {
        $nacel = " - Pas besoin de nacelle";
    } else {

        $nacel = " - Besoin d'une nacelle";
    }

    $pdf->MultiCell(0,10,utf8_decode("$n) $line $niv \n $lieu  -  $piece \n $design $nacel"));
}
 
$pdf->Output('F', '../public/documents/pdf/'.$_POST['numfile'].'.pdf');

?>