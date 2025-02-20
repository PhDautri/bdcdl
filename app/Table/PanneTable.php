<?php

namespace App\Table;

use Core\Table\Table;


class PanneTable extends Table{

	protected $table = 'pannes';

	// affiche toutes les pannes //
	
	public function allpanne() {

		return $this->query('SELECT pa.id, DATE_FORMAT(pa.date_panne, \'%d-%m-%Y\') AS datepannefr, 
							TIME_FORMAT(pa.heure_panne, \'%H:%i\') AS heurepannefr, pa.designation, m.id AS idmate, m.mat_lier, 
							CONCAT(p.produit, " - ", ma.marque, " - ", mo.model, " - ", t.type, " - ", m.num_serie) AS mate,
							 m.num_inventaire, pa.etat_panne,
							(SELECT SUM(mtfr.montantFR) FROM factures_repar mtfr WHERE pa.id = mtfr.pannes_id) AS mfr,  
							(SELECT SUM(mtfi.montantFI) FROM factures_interv mtfi WHERE pa.id = mtfi.pannes_id) AS mfi

							FROM (((((pannes pa
							
							LEFT JOIN materiels m ON pa.materiel_id = m.id)

							LEFT JOIN produits p ON m.produits_id = p.id)

							LEFT JOIN marques ma ON m.marques_id = ma.id)

							LEFT JOIN models mo ON m.models_id = mo.id)

							LEFT JOIN types t ON m.types_id = t.id)

							');
	}

	// affiche toutes les pannes en attente de réparation //
	
	public function affpannesAttenteRep() {

		return $this->query('SELECT pa.id, DATE_FORMAT(pa.date_panne, \'%d-%m-%Y\') AS datepannefr, 
							TIME_FORMAT(pa.heure_panne, \'%H:%i\') AS heurepannefr, pa.designation, m.id AS idmate, m.mat_lier, 
							CONCAT(p.produit, " - ", ma.marque, " - ", mo.model, " - ", t.type, " - ", m.num_serie) AS mate,
							 m.num_inventaire, pa.etat_panne,
							(SELECT SUM(mtfr.montantFR) FROM factures_repar mtfr WHERE pa.id = mtfr.pannes_id) AS mfr,  
							(SELECT SUM(mtfi.montantFI) FROM factures_interv mtfi WHERE pa.id = mtfi.pannes_id) AS mfi

							FROM (((((pannes pa
							
							LEFT JOIN materiels m ON pa.materiel_id = m.id)

							LEFT JOIN produits p ON m.produits_id = p.id)

							LEFT JOIN marques ma ON m.marques_id = ma.id)

							LEFT JOIN models mo ON m.models_id = mo.id)

							LEFT JOIN types t ON m.types_id = t.id)

							WHERE pa.etat_panne != "Terminé"

							');
	}

	// affiche toutes les pannes volets en attente de réparation //
	
	public function affpannesAttenteRepvolet() {

		return $this->query('SELECT pa.id, DATE_FORMAT(pa.date_panne, \'%d-%m-%Y\') AS datepannefr, 
								TIME_FORMAT(pa.heure_panne, \'%H:%i\') AS heurepannefr, pa.designation, m.id AS idmate, m.mat_lier, 
								CONCAT(ma.marque, " - ", mo.model, " - ", t.type, " - ", m.num_serie) AS mate, m.num_serie, 
								n.niveau, m.num_inventaire, pa.etat_panne, l.lieux, pi.piece, m.nacelle,
								(SELECT SUM(mtfr.montantFR) FROM factures_repar mtfr WHERE pa.id = mtfr.pannes_id) AS mfr,  
								(SELECT SUM(mtfi.montantFI) FROM factures_interv mtfi WHERE pa.id = mtfi.pannes_id) AS mfi

								FROM (((((((pannes pa
								
								LEFT JOIN materiels m ON pa.materiel_id = m.id)

								LEFT JOIN marques ma ON m.marques_id = ma.id)

								LEFT JOIN models mo ON m.models_id = mo.id)

								LEFT JOIN types t ON m.types_id = t.id)

								LEFT JOIN niveau n ON m.niveau_id = n.id)

								LEFT JOIN lieux l ON m.lieux_id = l.id)

								LEFT JOIN pieces pi ON m.pieces_id = pi.id)

								WHERE pa.etat_panne != "Terminé" AND m.num_inventaire LIKE "Volet%"

							');
	}

	// function qui remonte les pannes en fonction de l'id matériel pour All & id panne pour Select//
	
	public function affpanne($id, $index) {	

		if ($index == 'All') {	 

			$result = $this->query('SELECT pa.id, DATE_FORMAT(pa.date_panne, \'%d-%m-%Y\') AS datepannefr, TIME_FORMAT(pa.heure_panne, \'%H:%i\') AS heurepannefr, pa.designation, pa.etat_panne, pa.user        

							    FROM pannes pa						            
							    
							    WHERE pa.materiel_id = ?', [$id]

	        					);
			
	    } else if ($index == 'Select') {

	    	$result = $this->query('SELECT pa.id, DATE_FORMAT(pa.date_panne, \'%d-%m-%Y\') AS datepannefr, TIME_FORMAT(pa.heure_panne, \'%H:%i\') AS heurepannefr, pa.designation, pa.etat_panne, pa.user        

							    FROM pannes pa						            
							    
							    WHERE pa.id = ?', [$id]
							    );

	    }      				

		$output = '
				
				<table id="TablePanne" class="table table-hover table-bordered">
					<tr>
						<th>Id</th>
						<th>Déclarant</th>						
		                <th>Date Panne</th>
		                <th>Heure Panne</th>
		                <th>Désignation</th>
		                <th>Etats</th>	                		                    
						<th>Actions</th>						
					</tr>
				';			

			if($result)
			{		

				foreach($result as $row)
				{
					
					if($row->etat_panne === 'Attente Intervention Interne') {
                               
			            $btn = 'btn-warning btn-xs btn-round';

			        } else if ($row->etat_panne === 'Attente Appel Intervenant') {

			            $btn = 'btn-theme03 btn-xs btn-round';

			        } else if ($row->etat_panne === 'Attente Intervention') {

			            $btn = 'btn-theme04 btn-xs btn-round';

			        } else if ($row->etat_panne === 'Non Réparé') {

			            $btn = 'btn-info btn-xs btn-round';

			        } else if ($row->etat_panne === 'Attente Réparation') {

			            $btn = 'btn-theme btn-xs btn-round';

			        } else if ($row->etat_panne === 'Attente diagnostique') {

			            $btn = 'btn-default btn-xs btn-round';

			        } else if ($row->etat_panne === 'Attente Devis') {

			            $btn = 'btn-primary btn-xs btn-round';

			        } else if ($row->etat_panne === 'Réparation en cours') {

			            $btn = 'btn-success btn-xs btn-round';

			        } else if ($row->etat_panne === 'Réparation non terminé') {

			            $btn = 'btn-theme02 btn-xs btn-round';

			        } else if($row->etat_panne === 'Terminé') {
			           
			            $btn = 'btn-danger btn-xs btn-round';
			        } else {

			        	$btn = 'btn-default btn-xs btn-round';
			        }					       

					$output .= '
					<tr>
						<td>'.$row->id.'</td>
						<td>'.$row->user.'</td>
						<td>'.$row->datepannefr.'</td>
						<td>'.$row->heurepannefr.'</td>
                      	<td>'.$row->designation.'</td>
                      	<td><button class="'.$btn.'" disabled>'.$row->etat_panne.'</button></td>
						<th>						
							<button class="btn btn-primary btn-xs" data-role="EditPanne"<abbr title="Edition de la panne"><span class="glyphicon  glyphicon-pencil"></span></abbr></button>
							<a class="btn btn-default btn-xs" target="_blank" href="?p=pannes.viewPannePdf&id='.$row->id.'"<abbr title="PDF">PDF</a>														
						</th>					
					</tr>
					';
				}
			}
			else
			{
				$output .= '
				<tr>
					<th colspan="6" align="center">Aucune Données</th>
				</tr>
				';
			}

			$output .= '</table>';

			echo $output;
	}

	// function qui remonte l'intervenant en function de la panne //
	
	public function viewscontribpanne($id) {

		return $this->query('SELECT contr.nom, contr.adresse, CONCAT(contr.code_postal, " " ,contr.ville) AS lieux, contr.num_phone, contr.site_web 
							FROM pannes pa 
							INNER JOIN intervenants contr ON pa.contribu_id = contr.id 
							WHERE pa.id = ?' , [$id]
							);
	}

	// function qui verifie si un devis a était validé pour cette panne //
	
	public function getpanne($id) {

		return $this->query('SELECT pa.etat_devis, 
							(SELECT COUNT(de.id) FROM devis de WHERE de.etat_devis = "Devis En Attente" AND de.pannes_id = "'.$_POST['IDP_ED_Quota'].'") AS nbrquotatt 

							FROM pannes pa 
							WHERE pa.id = ?', [$id]
						    );
	} 	

	// FIND //	

	// affiche toutes les pannes lier au matériel par sont id //
	
	public function findpannemate($id) {

		return $this->query('SELECT pa.id, DATE_FORMAT(pa.date_panne, \'%d-%m-%Y\') AS datepannefr ,TIME_FORMAT(pa.heure_panne, \' à %H:%i\') AS heurepannefr, pa.designation, CONCAT(p.produit, " ", ma.marque, " ", mo.model, " ", t.type, " ", m.num_serie) AS mate, pa.etat_panne

							FROM (((((pannes pa

							INNER JOIN materiels m ON pa.materiel_id = m.id)

							INNER JOIN produits p ON m.produits_id = p.id)

							INNER JOIN marques ma ON m.marques_id = ma.id)

							INNER JOIN models mo ON m.models_id = mo.id)

							INNER JOIN types t ON m.types_id = t.id) 

							WHERE pa.materiel_id = ?' , [$id]

							);			
			
	}			

	// recherche données panne par sont id panne //
	
	public function finddatapanne($id) {

		return $this->query('SELECT pa.etat_panne, pa.etat_devis, p.produit, p.mat_category, pa.designation,							   
							inte.id AS interv_id, inte.etat_interv, inte.sous_garanti, 
							a.id AS IdAppel, a.statut_appel, a.contribut_id, a.contact_id, a.tech_id, a.type_appel, i.nom

							FROM (((((pannes pa

							INNER JOIN materiels m ON pa.materiel_id = m.id)

							INNER JOIN produits p ON m.produits_id = p.id)

							LEFT JOIN appel a ON pa.id = a.pannes_id)

							LEFT JOIN interventions inte ON inte.pannes_id = pa.id)

							LEFT JOIN intervenants i ON i.id = a.contribut_id) 

							WHERE pa.id = ?' ,[$id]);
	}
	
	// trouve les données sur le matériel et la panne selectionner //
	
	public function finddatapannemate($id) {

		return $this->query('SELECT pro.produit, ma.marque, t.type, m.num_serie, mo.model, pa.designation,
							CONCAT(n.niveau, " - ", l.lieux, " - ", pi.piece) AS situe, m.nacelle 

							FROM ((((((((pannes pa

							LEFT JOIN materiels m ON m.id = pa.materiel_id)

							LEFT JOIN produits pro ON m.produits_id = pro.id)

							LEFT JOIN marques ma ON m.marques_id = ma.id)

							LEFT JOIN models mo ON m.models_id = mo.id)

							LEFT JOIN types t ON m.types_id = t.id)

							LEFT JOIN niveau n ON m.niveau_id = n.id)

							LEFT JOIN lieux l ON m.lieux_id = l.id)

							LEFT JOIN pieces pi ON m.pieces_id = pi.id) 

							WHERE pa.id = ?', [$id]);
	}	

	// CHECKED //

	// verifie si la matériel a deja une panne active en fonction de l'id mate //
	
	public function checkedpanne($id) {

		return $this->query('SELECT pa.etat_panne, m.statut, inte.etat_interv

							FROM ((materiels m

							LEFT JOIN pannes pa ON pa.materiel_id = m.id)

							LEFT JOIN interventions inte ON inte.materiel_id = m.id)

							WHERE m.id = ?', [$id]);
	}

	// verifie si l'intervenant a des pannes //
	
	public function CheckedIntervContribut($id) {

		return $this->query('SELECT pa.id

							 FROM pannes pa

							 LEFT JOIN interventions inte ON inte.pannes_id = pa.id

							 WHERE inte.contribut_id =?' ,[$id]);

	}

	// COUNT //	
	 
	// remonte le nbr d'intervention en attente de réparation //
	
	public function CountAttRep() {

		return $this->query('SELECT COUNT(pa.id) AS id FROM pannes pa WHERE pa.etat_panne != "Terminé"');
	}

	// remonte le nombre de pannes du matériel // id matériel//
	
	public function countnbrpannesmate($id) {

		return $this->query('SELECT COUNT(pa.id) AS nbrpannes FROM pannes pa WHERE pa.materiel_id = ?', [$id]);
	}

	// retourne le nombre total de pannes des volets //

	public function CountNbrtPvolets() {

		return $this->query('SELECT COUNT(pa.id) AS nbrpv 
							FROM pannes pa 
							LEFT JOIN materiels m ON m.id = pa.materiel_id
							WHERE m.produits_id = 6 AND pa.etat_panne != "Terminé"
							');
	}

	// retourne le nbrs de factures réparation manquante /***********AC*******/

	public function nbrfactrep() {

		return $this->query('SELECT COUNT(fr.id) AS nbrfr FROM factures_repar fr ');

	}

	///////////////////////////// PDF /////////////////////////////////////
	
	// remonte les données du matériel selectionner //

	public function finddatamateselect($id) {

		return $this->query('SELECT m.id, pro.produit, ma.marque, mo.model,t.type, m.num_serie, m.num_inventaire, m.statut
						FROM (((((((materiels m

						LEFT JOIN produits pro ON m.produits_id = pro.id)

						LEFT JOIN marques ma ON m.marques_id = ma.id)

						LEFT JOIN models mo ON m.models_id = mo.id)

						LEFT JOIN lieux l ON m.lieux_id = l.id)

						LEFT JOIN niveau n ON m.niveau_id = n.id)

						LEFT JOIN types t ON m.types_id = t.id)

						LEFT JOIN pannes p ON m.id = p.materiel_id)			

						WHERE p.id = ?', [$id]); 
	}

	// remonte les pannes lier au mate selectionner id panne//
	 
	public function findpanneselect($id) {

		return $this->query('SELECT p.id, DATE_FORMAT(p.date_panne, \'%d-%m-%Y\') AS date_pannefr, 
			p.heure_panne, p.designation, p.etat_panne, p.user,
			(SELECT mfr.montantFR FROM factures_repar mfr WHERE p.id = mfr.pannes_id) AS mfr,
			(SELECT mfi.montantFI FROM factures_interv mfi WHERE p.id = mfi.pannes_id) AS mfi

			FROM pannes p			

			WHERE p.id = ?',[$id]);
	}

	// remonte les evenements de la panne selectionner //
	
	public function findeventselect($id) {

		return $this->query('SELECT e.id, DATE_FORMAT(e.date_event, \'%d-%m-%Y\') AS date_eventfr, e.heure_event, e.event, e.designation, e.user
			FROM evenements e

			LEFT JOIN pannes p ON p.id = e.pannes_id

			WHERE p.id = ?',[$id]);
	}

	// function qui remonte les interv pour le pdf //
	
	public function findintervselect($id) {

		return $this->query('SELECT inte.id, DATE_FORMAT(inte.date_interv, \'%d-%m-%Y\') AS dateintervfr, 
		TIME_FORMAT(inte.heure_interv, \'%H:%i\') AS heureintervfr, inte.type_interv, inte.etat_interv 
		FROM interventions inte 
		WHERE inte.pannes_id =?',[$id]);
	}



	///////////////////////////EMAIL///////////////////////////

	// recherche données designation panne par sont id panne pour EMAIL //
	
	public function finddatapanneDesig($id) {

		return $this->query('SELECT  pa.designation FROM pannes pa WHERE pa.id = ?' ,[$id]);
	}
	 
}