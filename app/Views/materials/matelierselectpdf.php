<?php
ob_end_clean();
// include library //

require_once('../core/tcpdf/tcpdf.php');

$mate = $this->Material->finddatamate($_GET['id']);

$id = $mate[0]->id; // id mate lier

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

// make TCPDF object //

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
$pdf->Cell(180,10,"Listes Des Pannes Du Matériels",1,1,'C');

$pdf->SetFont('Helvetica','',10);
$pdf->ln(2);


// affiche les données du matériel //
$html = '<h4>Produit: '.$mate[0]->produit.' - Num Inventaire: '.$mate[0]->num_inventaire.'</h4> <p>Marque: '.$mate[0]->marque.' - Model: '.$mate[0]->model.' - Type: '.$mate[0]->type.' - Num Série: '.$mate[0]->num_serie.' - Statut: '.$mate[0]->statut.'</p>';

// affiche le matériel lier//
$pdf->writeHTMLCell(180, 20, '', '', $html, 1, 1, 0, true, '', true);

$panne = $this->Material->findmatepanneselectPdf($_GET['id']); // id mate lier	

// affiche la table panne // 
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

// affiche le(s) matériel(s) lier //
$pdf->WriteHTML($html);	

// output//

$pdf->Output("MateSelect.pdf", "I");