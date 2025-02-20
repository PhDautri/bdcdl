<?php

namespace App\Table;

use Core\Table\Table;


class EventTable extends Table{

	protected $table = 'evenements';

	
	// function qui remonte les évenements de pannes / id panne //
	
	public function affevent($id) {

		return $this->query('SELECT e.id, e.pannes_id, DATE_FORMAT(e.date_event, \'%d-%m-%Y\') AS dateeventfr, TIME_FORMAT(e.heure_event, \'%H:%i\') AS heureeventfr , e.event, e.designation, e.user

						FROM evenements e							
						
						WHERE e.pannes_id = ?', [$id]

						);

	}

	// function qui remonte les évenements de l'intervention sans panne / id interv //
	
	public function affeventSP($id) {		

		return $this->query('SELECT e.id, DATE_FORMAT(e.date_event, \'%d-%m-%Y\') AS dateeventfr, TIME_FORMAT(e.heure_event, \'%H:%i\') AS heureeventfr, 
						e.event, e.designation, e.user

						FROM evenements e							
					
						WHERE e.interv_id = ?', [$id]

						);				

	}

	// function qui remonte les évenements des travaux id work //
	
	public function affeventwork($id, $statut) {

		$result = $this->query('SELECT e.id, e.travaux_id, DATE_FORMAT(e.date_event, \'%d-%m-%Y\') AS dateeventfr, TIME_FORMAT(e.heure_event, \'%H:%i\') AS heureeventfr , e.event, e.designation, e.user

						FROM evenements e							
						
						WHERE e.travaux_id = ?', [$id]

						);

		if ($statut === "Terminé") {
			
			$output = '
				
				<table id="TableEventWork" class="table table-hover table-bordered" style="width: 100%">
					<tr>
						<th>Id</th>						
		                <th>Date</th>
		                <th>Heure</th>
		                <th>Evenement</th>
		                <th>Désignation</th>
		                <th>Créer par</th>						
					</tr>
				';
			

			if($result)
			{		

				foreach($result as $row)
				{
					
					$output .= '
					<tr>
						<td>'.$row->id.'</td>
						<td>'.$row->dateeventfr.'</td>
						<td>'.$row->heureeventfr.'</td>
                      	<td>'.$row->event.'</td>
                      	<td>'.$row->designation.'</td>                      	
                      	<td>'.$row->user.'</td>											
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
				
				<table id="TableEventWork" class="table table-hover table-bordered" style="width: 100%">
					<tr>
						<th>Id</th>						
		                <th>Date</th>
		                <th>Heure</th>
		                <th>Evenement</th>
		                <th>Désignation</th>
		                <th>Créer par</th>		                	                		                    
						<th>Actions</th>						
					</tr>
				';
			

			if($result)
			{		

				foreach($result as $row)
				{
					
					$output .= '
					<tr>
						<td>'.$row->id.'</td>
						<td>'.$row->dateeventfr.'</td>
						<td>'.$row->heureeventfr.'</td>
                      	<td>'.$row->event.'</td>
                      	<td>'.$row->designation.'</td>                      	
                      	<td>'.$row->user.'</td>	
						<td>						
							<button class="btn btn-primary btn-xs" data-role="EditEventWork" data-id="'.$row->travaux_id.'"<abbr title="Edition de l\'évenement"><span class="glyphicon  glyphicon-pencil"></span></abbr></button>
							<button type="submit" class="btn btn-danger btn-xs hidden"<abbr title="Supprimé l\'évenement"><span class="glyphicon glyphicon-trash"></span></abbr></button>
						</td>					
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

	// function qui verifie si des évenement existe pour la panne // id panne //
	
	public function CheckedEvent($id, $page) {

		if ($page === "mate") {
			return $this->query('SELECT e.id, e.event, pa.materiel_id, pa.etat_panne 
							FROM pannes pa
							LEFT JOIN evenements e ON e.pannes_id = pa.id 
							WHERE pa.id = ?', [$id]
							);
		} else if ($page === "work") {
			
			return $this->query('SELECT * FROM evenements e WHERE e.travaux_id =?', [$id]);

		}
		
	}

	// function qui remonte l'evenement desig / id panne / inp = input / idcont = id contributor //
	
	public function findeventdesig($id, $inp, $idcont) {

		if ($inp == 'datev') { // validation //
			return $this->query('SELECT e.id, e.designation  
								FROM evenements e
								WHERE e.event = "Accéptation Devis" AND e.contribut_id = "'.$idcont.'" AND e.pannes_id = ?', [$id]);
		} else {
			return $this->query('SELECT e.id, e.designation 
								FROM evenements e 
								WHERE e.event = "Devis Refusé" AND e.contribut_id = "'.$idcont.'" AND e.pannes_id = ?', [$id]);
		}		

	} 	

}