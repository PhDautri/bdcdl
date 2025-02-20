<?php

namespace App\Table;

use Core\Table\Table;


class EmailTable extends Table {

	protected $table = 'emails';


    // function qui remonte les données pour la table email all //
    
    public function emailall() {

    	return $this->query('SELECT e.id, e.email, e.sujet, DATE_FORMAT(e.date_mail, \'%d-%m-%Y\') AS date_mailfr FROM emails e ORDER BY e.date_mail');
    }

    // function qui remonte les données du mail selectionnner par sont id //
    
    public function viewselectemail($id) {

        return $this->query('SELECT e.id, e.pannes_id, i.nom, 
                            DATE_FORMAT(e.date_mail, \'%d-%m-%Y\') AS date_mailfr, e.email, e.sujet, e.cc, e.bcc, e.message, e.num_pdf, e.lien_pdf 
                            FROM emails e 
                            LEFT JOIN intervenants i ON i.id = e.contribut_id
                            WHERE e.id = ?', [$id]
                            );
    }

    

}