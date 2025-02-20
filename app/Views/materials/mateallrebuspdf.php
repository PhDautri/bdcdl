<?php
ob_end_clean();
// include library //

require_once('../core/tcpdf/tcpdf.php');

$mate = $this->Material->MaterialTrash();

function fetch_data($mate){

	$output = '';		
		
	foreach($mate as $row){

		$output .= '
			<tr>
				<td>'.$row->id.'</td>
				<td>'.$row->produit.'</td>
				<td>'.$row->marque.'</td>
				<td>'.$row->model.'</td>
				<td>'.$row->type.'</td>
				<td>'.$row->num_serie.'</td>
				<td>'.$row->num_inventaire.'</td>
				<td>'.$row->statut.'</td>
			</tr>
		';
	}
	
	return $output;
	
}

// make TCPDF object /:

$pdf = new TCPDF('p', 'mm', 'A4', true, 'UTF-8', false);
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetTitle("Liste Du Matériels Au Rebus");
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
$pdf->Cell(180,10,"Listes Du Matériels Au Rebus",1,1,'C');

$pdf->SetFont('Helvetica','',10);

$pdf->ln(2);

// make the table //
$html = "
	<table>		
		<tr>
			<th>Id</th>
			<th>Produit</th>
			<th>Marque</th>
			<th>Model</th>
			<th>Type</th>
			<th>Num série</th>
			<th>Num Inv</th>
			<th>Statut</th> 
		</tr>
		";
$html .= fetch_data($mate);

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

//using html cell

$pdf->WriteHTML($html);

// output//

$pdf->Output("AllMateRebus.pdf", "I");