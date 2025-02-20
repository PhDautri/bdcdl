<?php
    ob_end_clean();
    // include library //
    require_once('../core/fpdf/fpdf.php');

    $cab = $this->Cabinet->all();

    //var_dump($cab);

    // Cell --> Largeur = 190 total //

    define('EURO', chr(128));

    $pdf = new FPDF('P','mm','A4');
    $pdf->AddPage();

    $pdf->Image('../public/img/img_societe/iconegcs.jpg',10,15,30);
    $pdf->ln(20);

    $pdf->SetFont('Times','B',12);
    $pdf->Cell(190, 10, utf8_decode('Liste Cabinet Médecins GCS'), 1, 1, 'C');

    // ligne tableau //

    $pdf->SetFont('Arial', 'IB', 10);
    $pdf->Cell(7, 8, 'Id', 1, 0, 'C');
    $pdf->Cell(60, 8, 'Nom Cabinet', 1, 0, 'C');
    $pdf->Cell(25, 8, utf8_decode('Téléphone'), 1, 0, 'C');
    $pdf->Cell(98, 8, 'Email' , 1, 1, 'C');
                    
    // Données
    $pdf->SetFont('Times', 'I', 10);
    foreach($cab as $row)
    {

        $pdf->Cell(7, 6,$row->id, 1, 0, 'C');
        $pdf->Cell(60, 6,utf8_decode($row->nom_cab), 1 , 0, 'C');
        $pdf->Cell(25, 6,utf8_decode($row->telephone),1 ,0,'C');
        $pdf->Cell(98, 6,utf8_decode($row->email), 1 , 0, 'C');
        $pdf->Ln();
    }

    $pdf->Output('I', 'CabinetsMedecins.pdf');

?>