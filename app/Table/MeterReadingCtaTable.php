<?php

namespace App\Table;

use Core\Table\Table;


class MeterReadingCtaTable extends Table {

	protected $table = 'relever_compteurscta';


	// function qui remonte les données des relevés mensuel compteurs CTA //
    
    public function allMeterReadingCta() {

        return $this->query('SELECT rcta.id, DATE_FORMAT(rcta.date, \'%d-%m-%Y\') AS datefr, rcta.elec_ctaNord, rcta.conso_ctaNord, rcta.elec_ctaSud, rcta.conso_ctaSud 

                            FROM relever_compteurscta rcta

                            ORDER BY rcta.id

                            ');

    }

    // function qui remonte le rélevé précedent CTA / id meter//
    
    public function FindPreviousMeterCta($id) {

        return $this->query('SELECT rcta.id, rcta.elec_ctaNord, rcta.conso_ctaNord, rcta.elec_ctaSud, rcta.conso_ctaSud

                            FROM relever_compteurscta rcta

                            WHERE rcta.id < "'.$id.'" 

                            ORDER BY rcta.id DESC LIMIT 1

                            ');

    }      

}