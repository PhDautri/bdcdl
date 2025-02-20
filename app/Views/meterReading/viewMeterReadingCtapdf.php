<?php
    ob_end_clean();
    // include library //
    require_once('../core/fpdf/fpdf.php');

    // Cell --> Largeur = 190 total pour P //

    $pdf = new FPDF('L','mm','A4');
    $pdf->AddPage();

    $pdf->Image('../public/img/img_societe/iconegcs.jpg',10,15,30);
    $pdf->ln(20);

    $pdf->SetFont('Times','B',12);
    $pdf->Cell(277, 10, utf8_decode('TOUS LES RELEVES DE COMPTEURS CTA'), 1, 1, 'C');

    // ligne tableau //

    $pdf->SetFont('Arial', 'IB', 10);
    $pdf->Cell(17, 8, 'Id', 1, 0, 'C');
    $pdf->Cell(20, 8, 'Date', 1, 0, 'C');
    $pdf->Cell(70, 8, utf8_decode('Electricité CTA NORD(Kwh)') , 1, 0, 'C');
    $pdf->Cell(50, 8, 'Conso(Kwh)' , 1, 0, 'C');
    $pdf->Cell(70, 8, utf8_decode('Electricité CTA SUD(Kwh)') , 1, 0, 'C');
    $pdf->Cell(50, 8, 'Conso(Kwh)' , 1, 1, 'C');
    	    	    
    // Données
    $pdf->SetFont('Times', 'I', 10);
    foreach($result as $row)
    {

        $pdf->Cell(17, 6,$row->id, 1, 0, 'C');
        $pdf->Cell(20, 6,$row->datefr, 1, 0, 'C');
        $pdf->Cell(70, 6,$row->elec_ctaNord, 1,0,'C');
        $pdf->Cell(50, 6,$row->conso_ctaNord, 1 , 0, 'C');
        $pdf->Cell(70, 6,$row->elec_ctaSud, 1, 0,'C');
        $pdf->Cell(50, 6,$row->conso_ctaSud ,1 , 1, 'C');
        //$pdf->Ln();
    }

    $pdf->Output();

?>