<?php
ob_end_clean();
// include library //
 
require_once('../core/tcpdf/tcpdf.php');

function fetch_data($matlier){

	$output = '';		
		
	foreach($matlier as $row){

		if ($row->mfr == NULL && $row->mfi == NULL) {
			$mtt = '0.00 €';
		} else {
			$total = $row->mfr + $row->mfi;
			$mtt = number_format($total, 2, ',', ' ').' €';
		}

		$output .= '
			<tr>				
				<td>'.$row->num_inventaire.'</td>
				<td>'.$row->produit.'</td>
				<td>'.$row->marque.'</td>
				<td>'.$row->model.'</td>
				<td>'.$row->type.'</td>
				<td>'.$row->num_serie.'</td>
				<td>'.$row->statut.'</td>
				<td>'.$mtt.'</td>
				<td>'.$row->nbrtotalpanne.'</td>
			</tr>
		';
	}
	
	return $output;
	
}

// make TCPDF object /:

$pdf = new TCPDF('p', 'mm', 'A4', true, 'UTF-8', false);
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetTitle("Matériel selectionner");
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
$pdf->Cell(180,10,"Listes Du Matériels Lié",1,1,'C');

$pdf->SetFont('Helvetica','',10);
$pdf->ln(2);

$matlier = $this->Material->allMaterialLier();

// affiche la table panne // 
$html = "

<table>		
	<tr>		
		<th>Numéro Inventaire</th>
		<th>Produit</th>
		<th>Marque</th>
		<th>Model</th>
		<th>Type</th>
		<th>Numéro Série</th>
		<th>Statut</th>
		<th>Montant Total rép</th>
		<th>Total Pannes</th> 
	</tr>				
	";

$html .= fetch_data($matlier);	

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

$pdf->Output("MateLierSelect.pdf", "I");