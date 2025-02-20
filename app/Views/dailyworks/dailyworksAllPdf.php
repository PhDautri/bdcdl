<?php
ob_end_clean();
// include library //

require_once('../core/tcpdf/tcpdf.php');

$daily = $this->Dailywork->alldailyworks();

// affiche tout les travaux //
function fetch_data($daily){

	$output = '';	

	foreach($daily as $row){

		$output .= '
			<tr>
				<td>'.$row->id.'</td>
				<td>'.$row->user.'</td>
				<td>'.$row->datedailyfr.'</td>
				<td>'.$row->categorie.'</td>
				<td>'.$row->designation.'</td>
				<td>'.$row->commentaire.'</td>
				<td>'.$row->statut.'</td>
			</tr>
		';			
		
	}

	return $output; 
}

// make TCPDF object //

$pdf = new TCPDF('p', 'mm', 'A4', true, 'UTF-8', false);
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetTitle("Travaux Journalier");
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
$pdf->Cell(180,10,"Travaux Journalier",1,1,'C');

$pdf->SetFont('Helvetica','',10);
$pdf->ln(2);

// affiche les pannes // 
$html = "
	<h3>Liste Travaux:</h3>
	<table>		
		<tr>
			<th>Id</th>
			<th>Déclarant</th>
			<th>Date</th>
			<th>Catégorie</th>
			<th>Désignation</th>
			<th>commentaire</th>
			<th>Statut</th> 
		</tr>				
		";

$html .= fetch_data($daily);	
	
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

// affiche la panne//
$pdf->WriteHTML($html);	

// output//

$pdf->Output("DailyworksAll.pdf", "I");