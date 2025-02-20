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
            $this->Cell(277, 10, utf8_decode('TOUS LES EVENEMENTS JOURNALIER'), 1, 1, 'C');
            // ligne tableau //

		    $this->SetFont('Arial', 'IB', 10);
		    $this->Cell(17, 8, 'Id', 1, 0, 'C');		    
		    $this->Cell(30, 8, utf8_decode('Déclarant'), 1, 0, 'C');
		    $this->Cell(30, 8, 'Date', 1, 0, 'C');
		    $this->Cell(80, 8, utf8_decode('Désignation'), 1, 0, 'C');
		    $this->Cell(120, 8, utf8_decode('Commentaire') , 1, 1, 'C'); 
            

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
    
    foreach($result as $row)
    {

        $pdf->SetFont('Arial', 'I', 8);
        $pdf->Cell(17, 8, $row->id, 1, 0, 'C');
        $pdf->Cell(30, 8, $row->user, 1, 0, 'C');
        $pdf->Cell(30, 8, $row->date, 1, 0, 'C');        
        $pdf->Cell(80, 8, utf8_decode($row->designation), 1, 0, 'L');
        $pdf->Cell(120, 8, utf8_decode($row->commentaire), 1, 1, 'L');
        //$pdf->Ln();
        
    }   

    $pdf->Output();

?>