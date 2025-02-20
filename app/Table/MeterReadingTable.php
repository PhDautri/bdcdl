<?php

namespace App\Table;

use Core\Table\Table;


class MeterReadingTable extends Table {

	protected $table = 'relever_compteurs';


    // function qui remonte les données des relevés mensuel //
    
    public function allMeterReading() {

        return $this->query('SELECT rc.id, DATE_FORMAT(rc.date, \'%d-%m-%Y\') AS datefr, rc.date, rc.eau, rc.conso_eau, rc.rst_eau, rc.gaz, rc.conso_gaz, rc.rst_gaz, rc.elec_scan, rc.conso_scan, rc.rst_scan, rc.elec_irm, rc.conso_irm, rc.rst_irm, rc.elec_radio, rc.conso_radio, rc.rst_radio, rc.eau_radio, rc.conso_eauradio, rc.rst_eauradio, rc.eau_apf, rc.conso_apf, rc.rst_apf 

                            FROM relever_compteurs rc

                            ORDER BY rc.id DESC

                            ');

    }    

    // function qui remonte le rélevé précedent / id meter//
    
    public function FindPreviousMeter($id) {

        return $this->query('SELECT rc.id, rc.eau, rc.conso_eau, rc.gaz, rc.conso_gaz, rc.elec_scan, rc.conso_scan, rc.elec_irm,rc.conso_irm, rc.elec_radio, 
                            rc.conso_radio, rc.eau_radio, rc.conso_eauradio, rc.eau_apf, rc.conso_apf  

                            FROM relever_compteurs rc

                            WHERE rc.id < "'.$id.'" 

                            ORDER BY rc.id DESC LIMIT 1

                            ');

    }

    // function qui remonte le dernier compteur différent de 0 //

    public function FindLastNonZeroElement($col, $page) {

        if ($page == 'cta') {
            return $this->query('SELECT rcta.'.$col.' FROM relever_compteurscta rcta WHERE rcta.'.$col.' <> "0" ORDER BY rcta.id DESC LIMIT 1');
        } else {
            return $this->query('SELECT rc.'.$col.' FROM relever_compteurs rc WHERE rc.'.$col.' <> "0" ORDER BY rc.id DESC LIMIT 1');
        }
        
    }

}