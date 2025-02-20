<?php
ob_end_clean();
// include library //

require_once('../core/tcpdf/tcpdf.php');

$mate = $this->Panne->finddatamateselect($_GET['id']); // id panne

$id = $mate[0]->id; // id matériel

// affiche les pannes lier //
function fetch_data2($panne){

	$output = '';	

	foreach($panne as $row){

		$output .= '
			<tr>
				<td>'.$row->id.'</td>
				<td>'.$row->user.'</td>
				<td>'.$row->date_pannefr.'</td>
				<td>'.$row->heure_panne.'</td>
				<td>'.$row->designation.'</td>
				<td>'.$row->etat_panne.'</td>
			</tr>
			';			
		
	}

	return $output; 
}

// affiche les interventions //
function fetch_data3($interv){

	$output = '';	

	foreach($interv as $row){

		$output .= '
			<tr>
				<td>'.$row->id.'</td>
				<td>'.$row->dateintervfr.'</td>
				<td>'.$row->heureintervfr.'</td>
				<td>'.$row->type_interv.'</td>
				<td>'.$row->etat_interv.'</td>				
			</tr>
			';			
		
	}

	return $output; 
}

// affiche les événements lier //
function fetch_data4($event){

	$output = '';

	foreach($event as $row){

		$output .= '
			<tr>
				<td>'.$row->id.'</td>
				<td>'.$row->date_eventfr.'</td>
				<td>'.$row->heure_event.'</td>
				<td>'.$row->event.'</td>
				<td>'.$row->designation.'</td>
				<td>'.$row->user.'</td>
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
$pdf->Cell(180,10,"Matériel & Détail Pannes",1,1,'C');

$pdf->SetFont('Helvetica','',10);

$pdf->ln(2);

// affiche les données du matériel //
$html = '<h4>Produit: '.$mate[0]->produit.' - Num Inventaire: '.$mate[0]->num_inventaire.'</h4> <p>Marque: '.$mate[0]->marque.' - Model: '.$mate[0]->model.' - Type: '.$mate[0]->type.' - Num Série: '.$mate[0]->num_serie.' - Statut: '.$mate[0]->statut.'</p>';

// affiche le matériel//
$pdf->writeHTMLCell(180, 20, '', '', $html, 1, 1, 0, true, '', true);

$panne = $this->Panne->findpanneselect($_GET['id']);

if ($panne) {
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

	//using html cell

	$pdf->ln(2);

	// affiche la panne//
	$pdf->WriteHTML($html);

} else {

	$html2 = " <h3>Pannes: aucune</h3> ";
	$pdf->WriteHTML($html);

}

$interv = $this->Panne->findintervselect($_GET['id']);

if ($interv) {

	// table interventions //
	$html2 = "
		<h3>Interventions:</h3>
		<table>		
		<tr>
			<th>Id</th>
			<th>Date</th>
			<th>Heure</th>
			<th>Type Interv</th>
			<th>Etat</th> 
		</tr>
	";	

	$html2 .= fetch_data3($interv);	

	$html2 .= "
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

	$pdf->ln(2);

	// affiche les evenements //
	$pdf->WriteHTML($html2);

} else {

	$html2 = " <h3>Interventions: aucune</h3> ";
	$pdf->WriteHTML($html2);
}


$event = $this->Panne->findeventselect($_GET['id']);

if ($event) {

	// table evenements //
	$html2 = "
		<h3>Evenements:</h3>
		<table>		
		<tr>
			<th>Id</th>
			<th>Date</th>
			<th>Heure</th>
			<th>Evenement</th>
			<th>Désignation</th>
			<th>créer par</th> 
		</tr>
	";	

	$html2 .= fetch_data4($event);	

	$html2 .= "
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

	$pdf->ln(2);

	// affiche les evenements //
	$pdf->WriteHTML($html2);

} else {

	$html2 = " <h3>Evenements: aucun</h3> ";
	$pdf->WriteHTML($html2);
}

// affiche le montant total de la réparation //

$row2 = sprintf("%.2f", $panne[0]->mfi + $panne[0]->mfr);

if($row2 == NULL) {
	$row2 = 0;
};

$html3 = '<h4>Montant Total De La réparations: '.$row2.' euros</h4>';
$pdf->WriteHTML($html3);

// output//

$pdf->Output("MateSelect.pdf", "I");