<?php

namespace App\Table;

use Core\Table\Table;


class IntervTable extends Table{

	protected $table = 'interventions';

	// INTERV AVEC PANNE //

		// affiche toutes les interventions //
		
		public function allinterv() {

			return $this->query('SELECT DISTINCT inte.id, DATE_FORMAT(inte.date_interv, \'%d-%m-%Y\') AS dateintervfr, 
								TIME_FORMAT(inte.heure_interv, \'%H:%i\') AS heureintervfr, inte.type_interv, m.id AS idmate, m.mat_lier, 
								CONCAT(p.produit, " - ", ma.marque, " - ", mo.model, " - ", t.type, " - ", m.num_serie) AS mate,
								 m.num_inventaire, i.nom, fi.montantFI AS mfi, inte.etat_interv, inte.pannes_id

								FROM (((((((( interventions inte

								LEFT JOIN pannes pa ON pa.id = inte.pannes_id) 
								
								LEFT JOIN materiels m ON pa.materiel_id = m.id)

								LEFT JOIN produits p ON m.produits_id = p.id)

								LEFT JOIN marques ma ON m.marques_id = ma.id)

								LEFT JOIN models mo ON m.models_id = mo.id)

								LEFT JOIN types t ON m.types_id = t.id)							

								LEFT JOIN intervenants i ON inte.contribut_id = i.id)

								LEFT JOIN factures_interv fi ON inte.id = fi.intervs_id)

								WHERE inte.pannes_id IS NOT NULL

								');
		}	

		// affiche toutes les interventions en cours //
		
		public function affIntervsEnCours() {

			return $this->query('SELECT DISTINCT inte.id, DATE_FORMAT(inte.date_interv, \'%d-%m-%Y\') AS dateintervfr, 
								TIME_FORMAT(inte.heure_interv, \'%H:%i\') AS heureintervfr, inte.type_interv, m.id AS idmate, m.mat_lier, 
								CONCAT(p.produit, " - ", ma.marque, " - ", mo.model, " - ", t.type, " - ", m.num_serie) AS mate,
								 m.num_inventaire, i.nom, fi.montantFI AS mfi, inte.etat_interv, inte.pannes_id

								FROM (((((((( interventions inte

								LEFT JOIN pannes pa ON pa.id = inte.pannes_id) 
								
								LEFT JOIN materiels m ON pa.materiel_id = m.id)

								LEFT JOIN produits p ON m.produits_id = p.id)

								LEFT JOIN marques ma ON m.marques_id = ma.id)

								LEFT JOIN models mo ON m.models_id = mo.id)

								LEFT JOIN types t ON m.types_id = t.id)							

								LEFT JOIN intervenants i ON inte.contribut_id = i.id)

								LEFT JOIN factures_interv fi ON inte.id = fi.intervs_id)

								WHERE inte.etat_interv != "Terminé"

								');
			
		}

		// function qui remonte les interventions de pannes // id panne pour All & id interv pour select //
		
		public function affintervpanne($id, $index, $type) {

			if ($index == 'All') {

				$result = $this->query('SELECT DISTINCT inte.id, inte.pannes_id, DATE_FORMAT(inte.date_interv, \'%d-%m-%Y\') AS dateintervfr, 
				TIME_FORMAT(inte.heure_interv, \'%H:%i\') AS heureintervfr, inte.type_interv, inte.user, inte.etat_interv, i.nom 

							FROM interventions inte
							LEFT JOIN intervenants i ON i.id = inte.contribut_id							
							
							WHERE inte.pannes_id = ?', [$id]

							);
				
			} else if ($index == 'Select') {

				$result = $this->query('SELECT DISTINCT inte.id, inte.pannes_id, DATE_FORMAT(inte.date_interv, \'%d-%m-%Y\') AS dateintervfr, 
				TIME_FORMAT(inte.heure_interv, \'%H:%i\') AS heureintervfr, inte.type_interv, inte.user, inte.etat_interv, i.nom 

							FROM interventions inte
							LEFT JOIN intervenants i ON i.id = inte.contribut_id							
							
							WHERE inte.id = ?', [$id]

							);
				
			}		

			if ($type === "administrateur") {
				
				$output = '
					
					<table id="TableInterv" class="table table-hover table-bordered" style="width:100%">
						<tr>
							<th>Id</th>						
			                <th>Date</th>
			                <th>Heure</th>
			                <th>Type</th>
			                <th>Société</th>
			                <th>Créer par</th>
			                <th>Etats</th>
			                <th>Actions</th>						
						</tr>
					';
				

				if($result)
				{		

					foreach($result as $row)
					{

						if($row->etat_interv == 'En Cours') {
	                               
				            $btn = 'btn-warning btn-xs btn-round';

				        } else if ($row->etat_interv == 'Terminé') {

				            $btn = 'btn-danger btn-xs btn-round';

				        }			        
						
						$output .= '
						<tr>
							<td>'.$row->id.'</td>
							<td>'.$row->dateintervfr.'</td>
							<td>'.$row->heureintervfr.'</td>                     	
							<td>'.$row->type_interv.'</td>
							<td>'.$row->nom.'</td>                     	
	                      	<td>'.$row->user.'</td>
	                      	<td><a class="'.$btn.'" disabled>'.$row->etat_interv.'</a></td>
	                      	<th>						
								<button class="btn btn-primary btn-xs" data-role="EditInterv" data-index="panne"<abbr title="Edition de l\'intervention"><span class="glyphicon  glyphicon-pencil"></span></abbr></button>	
							</th>												
						</tr>
						';
					}
				}
				else
				{
					$output .= '
					<tr>
						<td colspan="4" align="center">Aucune Données</td>
					</tr>
					';
				}

				$output .= '</table>';

				echo $output;

			} else {		
			
			$output = '
					
					<table id="TableInterv" class="table table-hover table-bordered" style="width:100%">
						<tr>
							<th>Id</th>						
			                <th>Date</th>
			                <th>Heure</th>
			                <th>Type</th>
			                <th>Société</th>
			                <th>Créer par</th>
			                <th>Etats</th>
			            </tr>
					';
				

				if($result) {		

					foreach($result as $row) {
						
						if($row->etat_interv == 'En Cours') {
	                               
				            $btn = 'btn-warning btn-xs btn-round';

				        } else if ($row->etat_interv == 'Terminé') {

				            $btn = 'btn-danger btn-xs btn-round';

				        }
						
						$output .= '
						<tr>
							<td>'.$row->id.'</td>
							<td>'.$row->dateintervfr.'</td>
							<td>'.$row->heureintervfr.'</td>                      	
							<td>'.$row->type_interv.'</td>
							<td>'.$row->nom.'</td>                      	
	                      	<td>'.$row->user.'</td>
	                      	<td><a class="'.$btn.'" disabled>'.$row->etat_interv.'</a></td>                      											
						</tr>
						';
					}
				}
				else
				{
					$output .= '
					<tr>
						<td colspan="4" align="center">Aucune Données</td>
					</tr>
					';
				}

				$output .= '</table>';

				echo $output;
			}
		}	

		// verifie si la pannes à des interventions  //
		
		public function checkedinterv($id) {

			return $this->query('SELECT inte.id, inte.etat_interv FROM interventions inte WHERE inte.pannes_id = ?',[$id]);
		}

		// function qui remonte l'intervenant en function de l'intervention //
		
		public function viewscontribinterv($id) {

			return $this->query('SELECT contr.id, contr.nom, contr.adresse, CONCAT(contr.code_postal, " " ,contr.ville) AS lieux, contr.num_phone, contr.site_web 
								FROM interventions inte 
								INNER JOIN intervenants contr ON inte.contribut_id = contr.id 
								WHERE inte.id = ?' , [$id]
								);
		}

		// COUNT //
		
		// remonte le nbr d'intervention en attente //
		
		public function CountInterT() {

			return $this->query('SELECT COUNT(inte.id) AS id FROM interventions inte');
		} 

		// remonte le nbr d'intervention en cours //
		
		public function CountAttInterRep() {

			return $this->query('SELECT COUNT(inte.id) AS id FROM interventions inte WHERE inte.etat_interv = "En Cours"');
		}

		// remonte le nombre d'intervention lier aux pannes // id panne //
		
		public function countnbrinterv($id) {

			return $this->query('SELECT COUNT(inte.id) AS nbrinterv FROM interventions inte WHERE inte.pannes_id = ?', [$id]);
		}	

		// function qui remonte le montant total des interventions par id matériel //
		
		public function countintervst($id) {

			return $this->query('SELECT SUM(fi.montantFI) AS mti FROM factures_interv fi WHERE fi.materiel_id = ?', [$id]);
		}

		// function qui remonte le montant total des interventions par id panne//
		
		public function countintervs($id) {

			return $this->query('SELECT SUM(fi.montantFI) AS mi 
								 FROM ((pannes pa

								 LEFT JOIN interventions inte ON inte.pannes_id = pa.id)

								 LEFT JOIN factures_interv fi ON fi.intervs_id = inte.id)

								 WHERE pa.id = ?', [$id]);
		}	

	/////////////////// INTERV SANS PANNE ////////////////////////////////////////////////////////
	
		// affiche toutes les interventions sans panne //
	
		public function allintervsanspanne() {

			return $this->query('SELECT DISTINCT inte.id, DATE_FORMAT(inte.date_interv, \'%d-%m-%Y\') AS dateintervfr, 
								TIME_FORMAT(inte.heure_interv, \'%H:%i\') AS heureintervfr, inte.design_interv, m.id AS idmate, m.mat_lier, 
								CONCAT(p.produit, " - ", ma.marque, " - ", mo.model, " - ", t.type, " - ", m.num_serie) AS mate,
								 m.num_inventaire, i.nom, fi.montantFI AS mfi , inte.etat_interv

								FROM ((((((( interventions inte 
								
								LEFT JOIN materiels m ON inte.materiel_id = m.id)

								LEFT JOIN produits p ON m.produits_id = p.id)

								LEFT JOIN marques ma ON m.marques_id = ma.id)

								LEFT JOIN models mo ON m.models_id = mo.id)

								LEFT JOIN types t ON m.types_id = t.id)							

								LEFT JOIN intervenants i ON inte.contribut_id = i.id)

								LEFT JOIN factures_interv fi ON inte.id = fi.intervs_id)

								WHERE inte.pannes_id IS NULL

								');
		}

		// function qui remonte les interventions du materiel sans panne // id mate / index = Select ou All //
	
		public function affintervsp($id, $index) {

			if ($index == 'All') {						

				$result = $this->query('SELECT DISTINCT inte.id, inte.pannes_id, contr.nom, DATE_FORMAT(inte.date_interv, \'%d-%m-%Y\') AS dateintervfr, 
										TIME_FORMAT(inte.heure_interv, \'%H:%i\') AS heureintervfr, inte.type_interv, inte.design_interv, inte.user, inte.etat_interv 

										FROM interventions inte

										LEFT JOIN intervenants contr ON contr.id = inte.contribut_id
							
										WHERE inte.category_int = "SP" AND inte.materiel_id = ?', [$id]

										);

			} else if ($index == 'Select') {

				$result = $this->query('SELECT DISTINCT inte.id, inte.pannes_id, contr.nom, DATE_FORMAT(inte.date_interv, \'%d-%m-%Y\') AS dateintervfr, 
										TIME_FORMAT(inte.heure_interv, \'%H:%i\') AS heureintervfr, inte.type_interv, inte.design_interv, inte.user, inte.etat_interv 

										FROM interventions inte

										LEFT JOIN intervenants contr ON contr.id = inte.contribut_id
							
										WHERE inte.category_int = "SP" AND inte.id = ?', [$id]
									);

			}	
	
			$output = '
				
				<table id="TableIntervSansP" class="table table-hover table-bordered" style="width:100%">
					<tr>
						<th>Id</th>						
		                <th>Date</th>
		                <th>Heure</th>
		                <th>Type</th>
		                <th>Intervenant</th>
		                <th>Désignation</th>
		                <th>Créer par</th>
		                <th>Etats</th>
		                <th>Actions</th>						
					</tr>
				';			

			if($result)	{		

				foreach($result as $row)
				{

					if($row->etat_interv == 'En Cours') {
                               
			            $btn = 'btn btn-warning btn-xs btn-round';

			        } else if ($row->etat_interv == 'Terminé') {

			            $btn = 'btn btn-danger btn-xs btn-round';

			        }			        
					
					$output .= '
					<tr>
						<td>'.$row->id.'</td>
						<td>'.$row->dateintervfr.'</td>
						<td>'.$row->heureintervfr.'</td>                     	
						<td>'.$row->type_interv.'</td>                     	
						<td>'.$row->nom.'</td>                     	
						<td>'.$row->design_interv.'</td>                     	
                      	<td>'.$row->user.'</td>
                      	<td><a class="'.$btn.'" data-role="ChangeEtatSP"<abbr title="Cliqué sur le bouton pour changer l\'état">'.$row->etat_interv.'</abbr></a></td>
                      	<td>						
							<button class="btn btn-primary btn-xs" data-role="EditInterv" data-index="sans_panne"<abbr title="Edition de l\'intervention"><span class="glyphicon  glyphicon-pencil"></span></abbr></button>	
						</td>												
					</tr>
					';
				}
			}

			else {

				$output .= '
				<tr>
					<td colspan="4" align="center">Aucune Données</td>
				</tr>
				';
			}

			$output .= '</table>';

			echo $output;
			
		}	

		// function qui remonte le montant de l'interventions // id interv//
	
		public function countintervsanspanne($id) {

			return $this->query('SELECT fi.montantFI AS mi FROM factures_interv fi WHERE fi.intervs_id = ?', [$id]);
		}

		// remonte le nombre d'intervention realiser sans pannne // id mate //

		public function countnbrintervsanspanne($id) {

			return $this->query('SELECT COUNT(inte.id) AS nbrintervsanspanne FROM interventions inte WHERE inte.category_int = "SP" AND inte.materiel_id = ?', [$id]);

		}	
	
	/////////////// INTERV CONTRAT MAINTENANCE ////////////////////////////////////////////////////////////////////////////////////////

		// affiche toutes les interventions contrat de maintenance //
	
		public function allintervscm() {

			return $this->query('SELECT DISTINCT inte.id, DATE_FORMAT(inte.date_interv, \'%d-%m-%Y\') AS dateintervfr,
								inte.design_interv, m.id AS idmate, m.mat_lier, 
								CONCAT(p.produit, " - ", ma.marque, " - ", mo.model, " - ", t.type, " - ", m.num_serie) AS mate,
								m.num_inventaire, i.nom, inte.etat_interv

								FROM (((((( interventions inte 
								
								LEFT JOIN materiels m ON inte.materiel_id = m.id)

								LEFT JOIN produits p ON m.produits_id = p.id)

								LEFT JOIN marques ma ON m.marques_id = ma.id)

								LEFT JOIN models mo ON m.models_id = mo.id)

								LEFT JOIN types t ON m.types_id = t.id)							

								LEFT JOIN intervenants i ON inte.contribut_id = i.id)

								WHERE inte.category_int = "CM"

								');
		}
	
		// remonte le nombre d'intervention lier aux contrat de maintenance // id mat //
		
		public function countnbrintervMC($id) {

			return $this->query('SELECT COUNT(inte.id) AS nbrinterv 
								FROM interventions inte 
								WHERE inte.category_int = "CM" AND inte.materiel_id = ?', [$id]);
		}

		// function qui remonte les interventions contrat de maintenance du materiel // id mate  //
	
		public function affintervcm($id) {						

			return $this->query('SELECT DISTINCT inte.id, inte.pannes_id, contr.nom, 
									DATE_FORMAT(inte.date_interv, \'%d-%m-%Y\') AS dateintervfr, 
									TIME_FORMAT(inte.heure_interv, \'%H:%i\') AS heureintervfr, 
									inte.type_interv, inte.design_interv, inte.user, inte.lien_icm, inte.etat_interv 

									FROM interventions inte

									LEFT JOIN intervenants contr ON contr.id = inte.contribut_id
						
									WHERE inte.category_int = "CM" AND inte.materiel_id = ?', [$id]

								);

		}

		// function qui remonte le montant total du contrat de maintenance /*********A_C*******/
		
		public function countintervCM($id) {

			return $id;

		} 			

	////// Function Commun ///////////////
	
		// function qui verifie si une interv SP ou CM et en cours //
		
		public function checkedstatutinterv($id) {

			return $this->query('SELECT inte.category_int FROM interventions inte WHERE inte.etat_interv = "En Cours" AND inte.materiel_id = ?', [$id]);
		}
}