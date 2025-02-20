<?php

namespace App\Table;

use Core\Table\Table;


class BillingTable extends Table {

	protected $table = 'billings';


    // function qui remonte les données sur toutes les factures des cabinets médicaux //
    
    public function allBillings() {

        return $this->query('SELECT b.id, b.num_fact, DATE_FORMAT(b.date_fact, \'%d-%m-%Y\') AS date_fafr, c.nom_cab, b.montantTTC,
                            b.etat

                            FROM billings b 

                            LEFT JOIN cabinets_doctors c ON b.cab_id = c.id

                            ORDER BY b.id

                            ');

    }

    // function qui remonte les données sur toutes les interventions des cabinets médicaux // 
    
    public function allintervdoctor() {

    	return $this->query('SELECT intd.id, DATE_FORMAT(intd.date, \'%d-%m-%Y\') AS dateintervfr, intd.num_interv, c.nom_cab, intd.designation,    intd.etat, intd.validate, intd.validate_cab, intd.travaux, c.id AS idcab, 
                (SELECT count(li.intervs_id) FROM ligne_intervs li WHERE li.intervs_id = intd.id) AS nbrline, b.id AS idfact

                            FROM ((interv_doctors intd 

                            LEFT JOIN cabinets_doctors c ON intd.cab_id = c.id)

                            LEFT JOIN billings b ON b.interv_cab = intd.id)

                            ORDER BY intd.id');
    }    

    // function qui remonte le dernier numero ST ou SI //
    
    public function findNumInterv($deb) {

        return $this->query('SELECT intd.num_interv FROM interv_doctors intd WHERE intd.num_interv LIKE ?', [$deb.'%']);

    }       
   
    // function qui remonte les données sur la facture intervention des cabinets médicaux //
    
    public function findfactdoc($id) {

        return $this->query('SELECT b.id, b.cab_id, b.interv_cab, DATE_FORMAT(b.date_fact, \'%d-%m-%Y\') AS dateFactfr, b.num_fact, b.montantTTC, c.nom_cab, c.telephone, c.email, intd.num_interv, intd.designation, intd.totalHT

                            FROM (( billings b

                            LEFT JOIN cabinets_doctors c ON b.cab_id = c.id)

                            LEFT JOIN interv_doctors intd ON b.interv_cab = intd.id)

                            WHERE b.id = ?', [$id]

                        );
    }

    // function Count nbr de facture cab //
    
    public function CountFact() {

        return $this->query('SELECT COUNT(b.id) AS nf FROM billings b ORDER BY b.id');
    }



     
}