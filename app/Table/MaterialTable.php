<?php

namespace App\Table;

use Core\Table\Table;


class MaterialTable extends Table{


	protected $table = 'materiels';


	// affiche toute les Matériel  // 

	public function material() {

		return $this->query('SELECT m.id, m.num_inventaire, m.inventory, pro.produit, ma.marque, m.lieux_install, 
							p.piece, l.lieux, m.statut, m.img_zone, pro.mat_category, mo.model, t.type, n.niveau, m.num_serie,
							(SELECT COUNT(pa.id) FROM pannes pa WHERE m.id = pa.materiel_id) AS nbrtotalpanne,
							(SELECT SUM(mtfr.montantFR) FROM factures_repar mtfr WHERE m.id = mtfr.materiel_id) AS mfr, 
							(SELECT SUM(mtfi.montantFI) FROM factures_interv mtfi WHERE m.id = mtfi.materiel_id) AS mfi		

							FROM (((((((materiels m

							LEFT JOIN produits pro ON m.produits_id = pro.id)

							LEFT JOIN marques ma ON m.marques_id = ma.id)

							LEFT JOIN models mo ON m.models_id = mo.id)

							LEFT JOIN types t ON m.types_id = t.id)

							LEFT JOIN lieux l ON m.lieux_id = l.id)

							LEFT JOIN niveau n ON m.niveau_id = n.id)

							LEFT JOIN pieces p ON m.pieces_id = p.id)

							WHERE m.statut != "Rebus" AND m.mat_lier = 0

							ORDER BY m.id 

							');
	
	}				

	// affiche tout le matériels Au Rebus // 

	public function MaterialTrash() {

		return $this->query('SELECT m.id, m.num_inventaire, m.inventory, pro.produit, ma.marque, m.marques_id, mo.model, m.num_serie, 
							DATE_FORMAT(m.date_fab, \'%d-%m-%Y\') AS datefabfr, 
							DATE_FORMAT(m.date_install, \'%d-%m-%Y\') AS dateinstallfr, 
							DATE_FORMAT(m.date_rebus, \'%d-%m-%Y\') AS daterebusfr, 
							t.type, n.niveau, m.niveau_id, l.lieux, m.note,  m.statut,     
							(SELECT SUM(mtfr.montantFR) FROM factures_repar mtfr WHERE m.id = mtfr.materiel_id) AS mfr, 
							(SELECT SUM(mtfi.montantFI) FROM factures_interv mtfi WHERE m.id = mtfi.materiel_id) AS mfi, 
							(SELECT COUNT(pa.id) FROM pannes pa WHERE m.id = pa.materiel_id) AS nbrtotalpanne

							FROM ((((((materiels m

							LEFT JOIN produits pro ON m.produits_id = pro.id)

							LEFT JOIN marques ma ON m.marques_id = ma.id)

							LEFT JOIN models mo ON m.models_id = mo.id)

							LEFT JOIN types t ON m.types_id = t.id)

							LEFT JOIN lieux l ON m.lieux_id = l.id)

							LEFT JOIN niveau n ON m.niveau_id = n.id)							

							WHERE m.statut = "Rebus"

							ORDER BY m.id 

						');	
	}

	///////////////FIND////////////////////////////

	// remonte si le numero de serie existe //
	
	public function findNumserie($id) {

		return $this->query('SELECT m.id FROM materiels m WHERE m.num_serie = ?', [$id], true); 
	}

	// remonte le nbr de numero de serie ayant le format ####1 //
	
	public function findseriegener() {

		return $this->query('SELECT COUNT(m.id) AS nbrs, MAX(m.num_serie) AS nserie FROM materiels m WHERE m.num_serie LIKE "_____"');

	}

	// remonte le dernier numero d'inventaire en fonction du produit //
	
	public function findNuminvent($deb) {

		return $this->query('SELECT m.num_inventaire FROM materiels m WHERE m.num_inventaire LIKE "%'.$_POST['deb'].'%"');
	}	

	// remonte les données du matériel par sont Id //
	
	public function finddatamate($id) {

		return $this->query('SELECT m.id, m.num_inventaire, m.inventory, m.family_id, m.produits_id, pro.produit, pro.mat_primary, pro.mat_category, 
							m.marques_id, ma.marque, m.types_id, t.type, m.num_serie, m.lieux_install, m.date_fab, 
							DATE_FORMAT(m.date_fab, \'%d-%m-%Y\') AS datefabfr, m.date_install, 
							DATE_FORMAT(m.date_install, \'%d-%m-%Y\') AS dateinstallfr, 
							m.montantAchat, m.num_factAchat, m.arm_id AS armid, arm.nom_arm, m.niveau_id, n.niveau, m.lieux_id, l.lieux, 
							m.pieces_id, pi.piece, m.prop, m.poids_charge, m.fluide, m.caract,
							m.disjoncteur, m.note, m.statut, mo.model, mo.id AS models_id,
							CONCAT(pro.produit, " - ", ma.marque, " - ", mo.model, " - ", t.type) AS mate,							 
							CONCAT("Armoire:", arm.nom_arm, " - ", "Disjoncteur:", m.disjoncteur) AS armdisj, 
							m.lier_id, m.contrat_id, c.num_contrat, c.lien_contrat, m.history, m.nacelle

							FROM (((((((((materiels m

							LEFT JOIN produits pro ON m.produits_id = pro.id)

							LEFT JOIN marques ma ON m.marques_id = ma.id)

							LEFT JOIN models mo ON m.models_id = mo.id)

							LEFT JOIN armoires arm ON m.arm_id = arm.id)

							LEFT JOIN niveau n ON m.niveau_id = n.id)

							LEFT JOIN lieux l ON m.lieux_id = l.id)

							LEFT JOIN pieces pi ON m.pieces_id = pi.id) 

							LEFT JOIN types t ON m.types_id = t.id)

							LEFT JOIN contrats c ON m.contrat_id = c.id)

							WHERE m.id = ?', [$id]);
	}

	// remonte les données du matériel primary par l'Id mate lier//
	
	public function findDMPrimary($id) {

		return $this->query('SELECT m.id, m.num_inventaire, m.num_serie, CONCAT(pro.produit, " - ", ma.marque, " - ", mo.model, " - ", t.type) AS matep, m.statut

							FROM ((((materiels m

							LEFT JOIN produits pro ON m.produits_id = pro.id)

							LEFT JOIN marques ma ON m.marques_id = ma.id)

							LEFT JOIN models mo ON m.models_id = mo.id)

							LEFT JOIN types t ON m.types_id = t.id)

							WHERE m.id = ?', [$id]);
	}
	
	// remonte le statut du materiel selectionner / id mate//
	
	public function findStatutMate($id) {

		return $this->query('SELECT m.statut FROM materiels m WHERE m.id =?' ,[$id]);

	}

	// remonte le matériel tager en panne || En Attente  sans aucune panne déclaré //
	
	public function findstatut() {

		return $this->query('SELECT DISTINCT m.id, (SELECT COUNT(pa.id) FROM pannes pa WHERE m.id = pa.materiel_id) AS nbrpa
							FROM materiels m							
							WHERE m.statut = "En Panne" OR m.statut = "En Attente" 
							');
	}
	
	// remonte les volets en panne et en attente d'envoi email //	

	public function findvoletsfailure() {

		return  $this->query('SELECT m.id, pa.id AS idpanne, m.num_inventaire, pro.produit, ma.marque, mo.model, m.num_serie, t.type, n.niveau, p.piece, m.statut

							FROM ((((((((materiels m

							LEFT JOIN pannes pa ON pa.materiel_id = m.id) 

							LEFT JOIN produits pro ON m.produits_id = pro.id)

							LEFT JOIN marques ma ON m.marques_id = ma.id)

							LEFT JOIN models mo ON m.models_id = mo.id)

							LEFT JOIN lieux l ON m.lieux_id = l.id)

							LEFT JOIN pieces p ON m.pieces_id = p.id)

							LEFT JOIN niveau n ON m.niveau_id = n.id)

							LEFT JOIN types t ON m.types_id = t.id)

							WHERE pro.produit ="Volet Roulant" AND pa.etat_panne = "Attente Envoi email" ');
	}

	// CHECKED //

	// verifie si le matériel n'est pas un volet roulant //

	public function checkedmate($id) {

		return  $this->query('SELECT m.id FROM materiels m WHERE m.id = "'.$_POST['MateId'].'" AND m.num_inventaire LIKE "Volet%"');

	}	

	// COUNT //

	// remonte le cout total des pannes pour select pdf //
	
	public function countmatepanne($id) {

		return $this->query('SELECT DISTINCT (SELECT SUM(mtfr.montantFR) FROM factures_repar mtfr WHERE m.id = mtfr.materiel_id) AS mfr, 
						(SELECT SUM(mtfi.montantFI) FROM factures_interv mtfi WHERE m.id = mtfi.materiel_id) AS mfi
		 
						FROM pannes p

						INNER JOIN materiels m ON m.id = p.materiel_id 
						 
						WHERE p.materiel_id = ?', [$id]
		);
	}

	// remonte le nbr de matériels primaire //
	
	public function CountMP() {

		return $this->query('SELECT COUNT(m.id) AS id FROM materiels m WHERE m.mat_lier = 0');
	}

	// function qui compte le nombre de volets en panne nécésitant une nacelle //
		
	public function CountPVoletNacl() {

		return $this->query('SELECT COUNT(m.id) AS nbrpvancl 
							FROM materiels m 
							LEFT JOIN pannes pa ON m.id = pa.materiel_id
							WHERE m.num_inventaire LIKE "Volet%" AND m.statut = "En Panne" AND m.nacelle = 1 AND pa.etat_panne = "Attente Envoi email" ');
		
	} 

	// function qui compte le nombre de volets en panne ne nécésitant pas de une nacelle //
		
	public function CountPVoletSnacl() {

		return $this->query('SELECT COUNT(m.id) AS nbrpvsncl 
							FROM materiels m 
							LEFT JOIN pannes pa ON m.id = pa.materiel_id
							WHERE m.num_inventaire LIKE "Volet%" AND m.statut = "En Panne" AND m.nacelle = 0 AND pa.etat_panne = "Attente Envoi email" ');
		
	} 

	// function qui compte le nombre total de volets dans la base //
	
	public function countnbrtvolets() {

		return $this->query('SELECT COUNT(m.id) AS nbrtv FROM materiels m WHERE m.num_inventaire LIKE "Volet%" '); 
	}

	// function qui compte le nbr total de volets en attente de devis //
		
	public function CountPVoletAquota() {

		return $this->query('SELECT COUNT(m.id) AS nbrpvaquota 
							FROM materiels m 
							LEFT JOIN pannes pa ON m.id = pa.materiel_id
							WHERE m.num_inventaire LIKE "Volet%" AND pa.etat_panne = "Attente Devis"');	
	}	

	// remonte le nbr d'intervention en attente //
	
	public function CountML() {

		return $this->query('SELECT COUNT(m.id) AS id FROM materiels m WHERE m.mat_lier = 1 AND m.lier_id IS NOT NULL');
	} 	

	///////////////////////////////////////// MAT LIER ////////////////////////////////////////////////////////////
	
	// affiche tout le matériels lier // 

	public function allMaterialLier() {

		return $this->query('SELECT m.id, pro.produit, ma.marque, m.marques_id, mo.model, m.num_serie, DATE_FORMAT(m.date_fab, \'%d-%m-%Y\') AS datefabfr, 
							DATE_FORMAT(m.date_install, \'%d-%m-%Y\') AS dateinstallfr, t.type, n.niveau, m.niveau_id, p.piece, m.note, m.num_inventaire, m.statut, 
							CONCAT("Poids Charge: ", m.poids_charge,"Kgrs", " Fluide: ", m.fluide) AS caracteristique, m.disjoncteur,
							(SELECT SUM(mtfr.montantFR) FROM factures_repar mtfr WHERE m.id = mtfr.materiel_id) AS mfr, 
							(SELECT SUM(mtfi.montantFI) FROM factures_interv mtfi WHERE m.id = mtfi.materiel_id) AS mfi, 
							(SELECT COUNT(pa.id) FROM pannes pa WHERE m.id = pa.materiel_id) AS nbrtotalpanne

							FROM (((((((materiels m

							LEFT JOIN produits pro ON m.produits_id = pro.id)

							LEFT JOIN marques ma ON m.marques_id = ma.id)

							LEFT JOIN models mo ON m.models_id = mo.id)

							LEFT JOIN lieux l ON m.lieux_id = l.id)

							LEFT JOIN pieces p ON m.pieces_id = p.id)

							LEFT JOIN niveau n ON m.niveau_id = n.id)

							LEFT JOIN types t ON m.types_id = t.id)

							WHERE m.statut != "Rebus" AND m.mat_lier = 1

							ORDER BY m.id 

							');
	
	}

	// affiche le matériel lier par sont id mate //
	
	public function affmatelier($id) {

		return  $this->query('SELECT m.id, m.num_inventaire, pro.produit, ma.marque, m.marques_id, mo.model, m.num_serie, t.type, n.niveau, m.niveau_id, p.piece, m.statut, 
							DATE_FORMAT(m.date_fab, \'%d-%m-%Y\') AS datefabfr, m.date_install, DATE_FORMAT(m.date_install, \'%d-%m-%Y\') AS dateinstallfr,
							(SELECT SUM(fr.montantFR) FROM factures_repar fr WHERE m.id = fr.materiel_id) AS mfr, 
							(SELECT SUM(fi.montantFI) FROM factures_interv fi WHERE m.id = fi.materiel_id) AS mfi,
							(SELECT COUNT(pa.id) FROM pannes pa WHERE m.id = pa.materiel_id) AS nbrtotalpanne

							FROM (((((((materiels m

							LEFT JOIN produits pro ON m.produits_id = pro.id)

							LEFT JOIN marques ma ON m.marques_id = ma.id)

							LEFT JOIN models mo ON m.models_id = mo.id)

							LEFT JOIN lieux l ON m.lieux_id = l.id)

							LEFT JOIN pieces p ON m.pieces_id = p.id)

							LEFT JOIN niveau n ON m.niveau_id = n.id)

							LEFT JOIN types t ON m.types_id = t.id)

							WHERE  m.lier_id = ?', [$id]
						);		
		
	}

	// affiche le matériel non lier //
	
	public function affmatenonlier() {

		return  $this->query('SELECT m.id, m.num_inventaire, pro.produit, ma.marque, mo.model, m.num_serie, t.type,m.statut

							FROM ((((materiels m

							LEFT JOIN produits pro ON m.produits_id = pro.id)

							LEFT JOIN marques ma ON m.marques_id = ma.id)

							LEFT JOIN models mo ON m.models_id = mo.id)

							LEFT JOIN types t ON m.types_id = t.id)

							WHERE  m.mat_lier = 1 AND m.lier_id = 0');

	}

	// remonte le nombre de matériels lier au matériels // id matériel //
	
	public function countnbrmatelier($id) {

		return $this->query('SELECT COUNT(m.id) AS nbrmate FROM materiels m WHERE m.lier_id = ?', [$id]);
	}

	// remonte les données lier au matériel //
	
	public function checkedmatelier($id) {

		return $this->query('SELECT * FROM materiels mat WHERE mat.lier_id = ?', [$id]);
	}	

	//////////////////////////////////////PDF////////////////////////////////////////
	
	
	// affiche tout le matériels pour PDF // 

	public function allMaterial() {

		return $this->query('SELECT m.id, m.num_inventaire, m.inventory, pro.produit, ma.marque, m.marques_id, mo.model, m.num_serie, 
							DATE_FORMAT(m.date_fab, \'%d-%m-%Y\') AS datefabfr, 
							DATE_FORMAT(m.date_install, \'%d-%m-%Y\') AS dateinstallfr, t.type, n.niveau, m.niveau_id, l.lieux, m.note, m.statut, 
							CONCAT("Poids Charge: ", m.poids_charge,"Kgrs", " Fluide: ", m.fluide) AS caracteristique, m.disjoncteur,
							(SELECT COUNT(pa.id) FROM pannes pa WHERE m.id = pa.materiel_id) AS nbrtotalpanne,
							(SELECT SUM(mtfr.montantFR) FROM factures_repar mtfr WHERE m.id = mtfr.materiel_id) AS mfr, 
							(SELECT SUM(mtfi.montantFI) FROM factures_interv mtfi WHERE m.id = mtfi.materiel_id) AS mfi 		

							FROM ((((((materiels m

							LEFT JOIN produits pro ON m.produits_id = pro.id)

							LEFT JOIN marques ma ON m.marques_id = ma.id)

							LEFT JOIN models mo ON m.models_id = mo.id)

							LEFT JOIN lieux l ON m.lieux_id = l.id)

							LEFT JOIN niveau n ON m.niveau_id = n.id)

							LEFT JOIN types t ON m.types_id = t.id)

							WHERE m.statut != "Rebus" AND m.mat_lier = 0

							ORDER BY m.id 

							');
	
	}

	// remonte les données matériel pour le pdf //
	
	public function findmateallPdf() {

		$result =  $this->query('SELECT m.id, pro.produit, ma.marque, m.marques_id, mo.model, m.num_serie, t.type, m.num_inventaire, m.statut
								FROM ((((materiels m

								LEFT JOIN produits pro ON m.produits_id = pro.id)

								LEFT JOIN marques ma ON m.marques_id = ma.id)

								LEFT JOIN models mo ON m.models_id = mo.id)

								LEFT JOIN types t ON m.types_id = t.id)

								ORDER BY id ASC');		
		
		$output = '

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
			';

		if($result){		

			foreach($result as $row)
			{
				
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

		}
			else
			{
				$output .= '
				<tr>
					<td colspan="4" align="center">Aucune Données</td>
				</tr>
				';
			}

			$output .= '
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
					
			  ';

			return $output;

	}

	// remonte les données matériel pannes par sont id pour le pdf //
	
	public function findmatepanneselectPdf($id) {

		return $this->query('SELECT p.id, DATE_FORMAT(p.date_panne, \'%d-%m-%Y\') AS date_pannefr, p.heure_panne, p.designation, 
							p.etat_panne, p.user, fr.montantFR, fi.montantFI 

			            	FROM (((pannes p

			            	INNER JOIN materiels m ON m.id = p.materiel_id)

			            	LEFT JOIN factures_repar fr ON p.id = fr.pannes_id)

			            	LEFT JOIN factures_interv fi ON p.id = fi.pannes_id)

			            	WHERE p.materiel_id = ?' ,[$id]);

	}

	// remonte les données du matériel en panne pour création pdf demande devis volet par email / id_mate//
	
	public function findmatepannePdfEmail($id) {

		return $this->query('SELECT CONCAT(pro.produit, " - ", ma.marque, " - ", m.num_serie ) AS mate, 
							CONCAT(" - situé au ", n.niveau) AS niv, l.lieux, p.piece,
							(SELECT pa.designation FROM pannes pa WHERE pa.etat_panne = "Attente Envoi email" AND pa.materiel_id = '.$id.') AS design, m.nacelle

							FROM ((((((materiels m

							LEFT JOIN produits pro ON m.produits_id = pro.id)

							LEFT JOIN marques ma ON m.marques_id = ma.id)

							LEFT JOIN models mo ON m.models_id = mo.id)

							LEFT JOIN lieux l ON m.lieux_id = l.id)

							LEFT JOIN pieces p ON m.pieces_id = p.id)

							LEFT JOIN niveau n ON m.niveau_id = n.id)

							WHERE m.id =?', [$id]);

	}

	// remonte les données matériel lié pour le contrat selectionner  //
	
	public function MateContrat($id) {

		return $this->query('SELECT m.id, pro.produit, ma.marque, m.marques_id, mo.model, m.num_serie, DATE_FORMAT(m.date_fab, \'%d-%m-%Y\') AS datefabfr, 
							DATE_FORMAT(m.date_install, \'%d-%m-%Y\') AS dateinstallfr, t.type, n.niveau, m.niveau_id, p.piece, m.note, m.num_inventaire, m.statut, 
							CONCAT("Poids Charge: ", m.poids_charge,"Kgrs", " Fluide: ", m.fluide) AS caracteristique, m.disjoncteur,
							(SELECT SUM(mtfr.montantFR) FROM factures_repar mtfr WHERE m.id = mtfr.materiel_id) AS mfr, 
							(SELECT SUM(mtfi.montantFI) FROM factures_interv mtfi WHERE m.id = mtfi.materiel_id) AS mfi, 
							(SELECT COUNT(pa.id) FROM pannes pa WHERE m.id = pa.materiel_id) AS nbrtotalpanne

							FROM (((((((materiels m

							LEFT JOIN produits pro ON m.produits_id = pro.id)

							LEFT JOIN marques ma ON m.marques_id = ma.id)

							LEFT JOIN models mo ON m.models_id = mo.id)

							LEFT JOIN lieux l ON m.lieux_id = l.id)

							LEFT JOIN pieces p ON m.pieces_id = p.id)

							LEFT JOIN niveau n ON m.niveau_id = n.id)

							LEFT JOIN types t ON m.types_id = t.id)

							WHERE m.statut != "Rebus" AND m.contrat_id = '.$_GET['id'].' 

							ORDER BY m.id

							');
	}

		
}