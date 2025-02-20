<?php
ob_end_clean();

// Include the main TCPDF library //
require_once('../core/tcpdf/tcpdf.php');

$mate = $this->Material->finddatamate($_GET['id']);

$id = $mate[0]->id;

// affiche les pannes lier //
function fetch_data2($panne){

	$output = '';	

	foreach($panne as $row){

		$mtr = sprintf("%.2f",$row->montantFR + $row->montantFI);

		$output .= '
			<tr>
				<td>'.$row->id.'</td>
				<td>'.$row->user.'</td>
				<td>'.$row->date_pannefr.'</td>
				<td>'.$row->heure_panne.'</td>
				<td>'.$row->designation.'</td>
				<td>'.$row->etat_panne.'</td>
				<td>'.$mtr.'</td>
			</tr>
		';			
		
	}

	return $output; 
}

// affiche le montant de toutes les réparations //

function fetch_data3($count){

	$row2 = '';	

	foreach($count as $row){

		$row2 = sprintf("%.2f",$count[0]->mfr + $count[0]->mfi);

	}

	return $row2;
}

// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {

    //Page header
    public function Header() {
        // Logo
        $image_file = '../public/img/img_societe/iconegcs.jpg';
        $this->Image($image_file, 10, 15, 20, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        // Set font
        $this->SetFont('helvetica', 'B', 20);
        // Title
        $this->Cell(0, 20, 'Matériel & Pannes', 0, false, 'C', 0, '', 0, false, 'M', 'M');
    }

    // Page footer
    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
}

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Ph.Dautricourt');
$pdf->SetTitle('MateSelect.pdf');
$pdf->SetSubject('Matériel selectionner');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('times', 'BI', 10);

// add a page
$pdf->AddPage();

// affiche les données du matériel //
$html = '<h4>Produit: '.$mate[0]->produit.' - Num Inventaire: '.$mate[0]->num_inventaire.'</h4>
    <p>Marque: '.$mate[0]->marque.' - Model: '.$mate[0]->model.' - Type: '.$mate[0]->type.' - Num Série: '.$mate[0]->num_serie.' - Statut: '.$mate[0]->statut.'</p>';

// affiche le matériel//
$pdf->writeHTMLCell(180, 20, '', '', $html, 1, 1, 0, true, '', true);	

$panne = $this->Material->findmatepanneselectPdf($id);

// affiche les pannes // 
$html = "
	<h3>Pannes:</h3>
	<table>		
		<tr>
			<th>Id</th>
			<th>Déclarant</th>
			<th>Date</th>
			<th>Heure</th>
			<th>Désignation</th>
			<th>Etats</th>
			<th>Montant rép</th> 
		</tr>				
		";

$html .= fetch_data2($panne);	
	
$html .= "
	</table>

	<style>
		table {
			border-collapse;
		}
		th,td {
			border:1px solid #888;
		}
		table tr th {
			background-color:#888;
			color:#fff;
			font-weight:bold;
		}
	</style>	
	";	

// affiche le montant total des réparations //

$count = $this->Material->countmatepanne($id);

$row2 = fetch_data3($count);

if($row2 == NULL) {
	$row2 = 0;
};

$html .= '<h4>Montant Total Des réparations: '.$row2.' euros</h4>';

//using html cell

$pdf->ln(2);

// affiche la panne//
$pdf->WriteHTML($html);

// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('Mateselect.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+