<?php
ob_end_clean();
// include library //
 
require_once('../core/tcpdf/tcpdf.php');

function fetch_data($volets){

	$output = '';		
		
	foreach($volets as $row){
		
		$output .= '
			<tr>
				<td>'.$row->num_serie.'</td>
				<td>'.$row->lieux.'</td>
				<td>'.$row->piece.'</td>
				<td>'.$row->nacelle.'</td>

			</tr>
		';
	}
	
	return $output;
	
}

// make TCPDF object /:

$pdf = new TCPDF('L', 'mm', 'A4', true, 'UTF-8', false);
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetTitle("Liste Des Volets En Pannes");
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
$pdf->Cell(180,10,"Listes Des Volets en Pannes",1,1,'C');

$pdf->SetFont('Helvetica','',13);
$pdf->ln(2);

$volets = $this->Panne->affpannesAttenteRepvolet();

//var_dump($volets);

// affiche la table panne // 
$html = "

<table>		
	<tr>
		<th>Volet</th> 
		<th>Lieux</th> 
		<th>Piéce</th> 
		<th>Nacelle</th> 
	</tr>				
	";

$html .= fetch_data($volets);	

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
// affiche le(s) matériel(s) lier //
$pdf->WriteHTML($html);

// output//

$pdf->Output("VoletEnPanne.pdf", "I");