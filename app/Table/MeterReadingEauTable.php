<?php

namespace App\Table;

use Core\Table\Table;


class MeterReadingEauTable extends Table {

	protected $table = 'relever_compteurseau';

    // function qui remonte les années des relevées Compteurs EAU //
    
    public function extractYearEau() {

        return $this->query('SELECT DISTINCT YEAR(rce.date) AS annee FROM relever_compteurseau rce ORDER BY YEAR(rce.date)');
    }

    // function qui remonte l'année antérieur en fonction de l'id //
    
    public function previousYearEau($id) {        
            
        return $this->query('SELECT rce.annee_ante FROM relever_compteurseau rce WHERE rce.id = ?', [$id]);
        
    }

    // function qui remonte les données des relevés eau par année selectionner //
    
    public function SelectDataEau($id) {

        return $this->query('SELECT rce.id, rce.lotID, rce.compteur_eau, rce.conso_eau, l.lieux_compt, l.appartenance 

                            FROM relever_compteurseau rce

                            LEFT JOIN lot l ON rce.lotID = l.num_lot

                            WHERE YEAR(rce.date) = "'.$_POST['id'].'" 

                            ORDER BY rce.id

                            ');

    } 	

    // function qui remonte le dernier relevé par sont année et numéro lot //
    
    public function findLastMeterEau($id, $annee) {

        return $this->query('SELECT rce.lotID, rce.compteur_eau FROM relever_compteurseau rce WHERE rce.lotID = '.$id.' AND YEAR(rce.date) = '.$annee.'');
        
    } 

    // function qui remonte les données des relevés mensuel compteurs Eau cabinets (annee) //
    
    public function EauPdf($annee) {

        return $this->query('SELECT rce.id, rce.lotID, DATE_FORMAT(rce.date, \'%d-%m-%Y\') AS datefr, 
                            rce.compteur_eau, rce.conso_eau, l.num_lot, l.lieux_compt, l.appartenance 

                            FROM relever_compteurseau rce

                            LEFT JOIN lot l ON l.num_lot = rce.lotID

                            WHERE YEAR(rce.date) = '.$annee.'

                            ORDER BY rce.id

                            ');

    }
      

}