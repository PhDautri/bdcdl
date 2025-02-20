<?php
ob_end_clean();
// include library //

require_once('../core/tcpdf/tcpdf.php');

$link = $this->Phone->selectLink($_GET['id']);

// affiche les pannes lier //
function fetch_data($link){

	$output = '';	

	foreach($link as $row){

		$output .= '
			<tr>
				<td>'.$row->num_tel.'</td>
				<td>'.$row->nom_tel.'</td>
				<td>'.$row->empl_ipbx.'</td>
				<td>'.$row->nom_bandeau.'</td>
				<td>'.$row->port_rg.'</td>
				<td>'.$row->nom_arm.'</td>
				<td>'.$row->port_arm.'</td>
				<td>'.$row->niveau_arm.'</td>
				<td>'.$row->num_pbureau.'</td>
				<td>'.$row->lieux_bureau.'</td>
			</tr>
			';			
		
	}

	return $output; 
}

// make TCPDF object /:

$pdf = new TCPDF('p', 'mm', 'A4', true, 'UTF-8', false);
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetTitle("Liste Des Liens IPBX");
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
$pdf->Cell(180,10,"Listes des liens IPBX",1,1,'C');

$pdf->SetFont('Helvetica','',7);


if ($link) {

	$html = '
	<table border="1" cellspacing="3" cellpadding="4">
	    <tr style="font-weight:bold;">
	        <th colspan="5" align="center">IPBX</th>
	        <th colspan="3" align="center">Armoire Divisionnaire</th>
	        <th colspan="2" align="center">Piéce/Bureau</th>
	    </tr>
	    <tr>
	        <th>Annuaire</th>

	        <th>Nom Usager</th>

	        <th>Emplacement</th>

	        <th>Bandeau</th>

	        <th>Port RG</th>

	        <th>Nom Armoire</th>

	        <th>Port</th>

	        <th>Niveau</th>                    

	        <th>Num Prise</th>

	        <th>Lieux</th>
	    </tr>
		';

	$html .= fetch_data($link);	
		
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

$pdf->Output("LinkIpbx.pdf", "I");