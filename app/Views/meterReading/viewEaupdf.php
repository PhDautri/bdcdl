<?php
    ob_end_clean();
    // include library //
    require_once('../core/fpdf/fpdf.php'); 

    $year = $_GET['year'];   

    // Cell --> Largeur = 190 total pour P //

    $pdf = new FPDF('L','mm','A4');
    $pdf->AddPage();

    $pdf->SetTitle('Compteur Cabinet '.$year);

    $pdf->Image('../public/img/img_societe/iconegcs.jpg',10,15,30);
    $pdf->ln(20);

    $pdf->SetFont('Times','B',12);
    $pdf->Cell(277, 10, utf8_decode('TOUS LES RELEVES DE COMPTEURS EAU CABINETS'), 1, 1, 'C');    

    $pdf->Cell(277, 10, utf8_decode('ANNEE: ') .$year, 1, 1, 'C');        

    // ligne tableau //

    $pdf->SetFont('Arial', 'IB', 10);
    $pdf->Cell(10, 8, 'Id', 1, 0, 'C');
    $pdf->Cell(30, 8, 'Date', 1, 0, 'C');
    $pdf->Cell(30, 8, utf8_decode('N° LOT') , 1, 0, 'C');
    $pdf->Cell(70, 8, 'Lieux Compteur' , 1, 0, 'C');
    $pdf->Cell(40, 8, 'Compteur(m3)' , 1, 0, 'C');
    $pdf->Cell(40, 8, 'Conso(m3)' , 1, 0, 'C');
    $pdf->Cell(57, 8, 'Appartenance' , 1, 1, 'C');
                    
    // Données
    $pdf->SetFont('Times', 'I', 10);
    $result = $this->MeterReadingEau->EauPdf($year);
    
    foreach($result as $row)
    {

        $pdf->Cell(10, 6,$row->id, 1, 0, 'C');
        $pdf->Cell(30, 6,$row->datefr, 1, 0, 'C');
        $pdf->Cell(30, 6,$row->num_lot, 1,0,'C');
        $pdf->Cell(70, 6,utf8_decode($row->lieux_compt) ,1 , 0, 'C');
        $pdf->Cell(40, 6,$row->compteur_eau ,1 ,0,'C');
        $pdf->Cell(40, 6,$row->conso_eau ,1 , 0, 'C');
        $pdf->Cell(57, 6,utf8_decode($row->appartenance) ,1 ,1,'C');
        
    }

    $pdf->Output();   

?>