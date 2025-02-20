<?php
    ob_end_clean();
    // include library //
    require_once('../core/fpdf/fpdf.php');

    // Cell --> Largeur = 190 total pour P //    

    class PDF extends FPDF 
    {

        function Header() 
        {
            $this->Image('../public/img/img_societe/iconegcs.jpg',10,15,30);
            $this->ln(20);

            $this->SetFont('Times','B',12);
            $this->Cell(277, 10, utf8_decode('TOUS LES RELEVES DES COMPTEURS'), 1, 1, 'C'); 
            $this->Ln();  
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
    $pdf->AliasNbPages();
    $pdf->AddPage();
    
    // Données
    $pdf->SetFont('Times', 'I', 10);
    foreach($result as $row)
    {

        $pdf->SetFont('Arial', 'IB', 10);
        $pdf->Cell(277, 6,"Date: $row->datefr", 1, 1, 'L');

        $pdf->Cell(77, 8,utf8_decode("Eau Général"), 1, 0, 'C');
        $pdf->Cell(100, 8,utf8_decode("Relevé: $row->eau m3"), 1, 0, 'C');
        $pdf->Cell(100, 8,utf8_decode("Conso: $row->conso_eau m3"), 1, 1, 'C');

        $pdf->Cell(77, 8,utf8_decode("Gaz"), 1, 0, 'C');
        $pdf->Cell(100, 8,utf8_decode("Relevé: $row->gaz m3"), 1, 0, 'C');
        $pdf->Cell(100, 8,utf8_decode("Conso: $row->conso_gaz m3"), 1, 1, 'C');

        $pdf->Cell(77, 8,utf8_decode("Electricité Scanner"), 1, 0, 'C');
        $pdf->Cell(100, 8,utf8_decode("Relevé: $row->elec_scan Kwh"), 1, 0, 'C');
        $pdf->Cell(100, 8,utf8_decode("Conso: $row->conso_scan Kwh"), 1, 1, 'C');

        $pdf->Cell(77, 8,utf8_decode("Electricité IRM"), 1, 0, 'C');
        $pdf->Cell(100, 8,utf8_decode("Relevé: $row->elec_irm Kwh"), 1, 0, 'C');
        $pdf->Cell(100, 8,utf8_decode("Conso: $row->conso_irm Kwh"), 1, 1, 'C');

        $pdf->Cell(77, 8,utf8_decode("Electricité Radio"), 1, 0, 'C');
        $pdf->Cell(100, 8,utf8_decode("Relevé: $row->elec_radio Kwh"), 1, 0, 'C');
        $pdf->Cell(100, 8,utf8_decode("Conso: $row->conso_radio Kwh"), 1, 1, 'C');

        $pdf->Cell(77, 8,utf8_decode("Eau Radio/Scanner/IRM"), 1, 0, 'C');
        $pdf->Cell(100, 8,utf8_decode("Relevé: $row->eau_radio m3"), 1, 0, 'C');
        $pdf->Cell(100, 8,utf8_decode("Conso: $row->conso_eauradio m3"), 1, 1, 'C');

        $pdf->Cell(77, 8,utf8_decode("Eau APF"), 1, 0, 'C');
        $pdf->Cell(100, 8,utf8_decode("Relevé: $row->eau_apf m3"), 1, 0, 'C');
        $pdf->Cell(100, 8,utf8_decode("Conso: $row->conso_apf m3"), 1, 1, 'C');

        $pdf->Ln();
        
    }   

    $pdf->Output();

?>