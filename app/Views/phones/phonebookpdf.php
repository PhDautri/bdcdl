<?php
ob_end_clean();
// include library //

require_once('../core/tcpdf/tcpdf.php');

$phone = $this->Phone->PhonesBook();

// affiche la table annuaire //
function fetch_data($phone){

	$output = '';	

	foreach($phone as $row){

		$output .= '
			<tr>
				<td>'.$row->id.'</td>
				<td>'.$row->num_tel.'</td>
				<td>'.$row->num_sda.'</td>
				<td>'.$row->type.'</td>
				<td>'.$row->nom_tel.'</td>
				<td>'.$row->nom_service.'</td>
				<td>'.$row->zone.'</td>
			</tr>
			';			
		
	}

	return $output; 
}

// make TCPDF object /:

$pdf = new TCPDF('p', 'mm', 'A4', true, 'UTF-8', false);
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetTitle("Liste Annuaire");
$pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
$pdf->SetDefaultMonospacedFont('helvetica');
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$pdf->SetMargins(PDF_MARGIN_LEFT, '5', PDF_MARGIN_RIGHT);
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
$pdf->SetAutoPageBreak(TRUE, 10);

// add page //

$pdf->AddPage();

// add content
// using cell
$pdf->SetFont('Helvetica','',14);
$pdf->Cell(180,10,"Annuaire",1,1,'C');

$pdf->SetFont('Helvetica','',7);


if ($phone) {

	$html = '
	<table border="1" cellspacing="3" cellpadding="4">
	    
	    <tr>
	        <th>Id</th>

	        <th>Numéro</th>

	        <th>Num SDA</th>

	        <th>Type</th>

	        <th>Nom Téléphone</th>

	        <th>Service</th>

	        <th>Zone</th>
	    </tr>
		';

	$html .= fetch_data($phone);	
		
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

	// reset pointer to the last page
	$pdf->lastPage();

	//using html cell

	$pdf->WriteHTML($html);

} else {

	$html = " <h3>Liens: aucun</h3> ";
	$pdf->WriteHTML($html);

}

// output//

$pdf->Output("Annuaire.pdf", "I");