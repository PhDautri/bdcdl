<?php
ob_end_clean();
// include library //

require_once('../core/tcpdf/tcpdf.php');

$mate = $this->Material->finddatamate($_GET['id']);

function fetch_data($matlier){

	$output = '';		
		
	foreach($matlier as $row){

		$mtr = sprintf("%.2f",$row->mfr + $row->mfi);

		$output .= '
			<tr>
				<td>'.$row->id.'</td>
				<td>'.$row->num_inventaire.'</td>
				<td>'.$row->produit.'</td>
				<td>'.$row->marque.'</td>
				<td>'.$row->model.'</td>
				<td>'.$row->type.'</td>
				<td>'.$row->num_serie.'</td>
				<td>'.$row->statut.'</td>
				<td>'.$mtr.'</td>
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

// affiche les données du matériel //
$html = '<h4>Produit: '.$mate[0]->produit.' - Num Inventaire: '.$mate[0]->num_inventaire.'</h4> <p>Marque: '.$mate[0]->marque.' - Model: '.$mate[0]->model.' - Type: '.$mate[0]->type.' - Num Série: '.$mate[0]->num_serie.' - Statut: '.$mate[0]->statut.'</p>';

// affiche le matériel lier//
$pdf->writeHTMLCell(180, 20, '', '', $html, 1, 1, 0, true, '', true);

$matlier = $this->Material->affmatelier($_GET['id']);

// affiche la table panne // 
$html = "
<h3>Matériel(s) Lier:</h3>
<table>		
	<tr>
		<th>Id</th>
		<th>N° Inventaire</th>
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