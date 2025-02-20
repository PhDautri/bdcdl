<?php

namespace App\Table;

use Core\Table\Table;


class LineTable extends Table {

	protected $table = 'ligne_intervs';


    // function qui remonte les lignes de l'intervention / id interv //
    
    public function findLines($id) {

        return $this->query('SELECT li.id, li.intervs_id, li.designation, li.quantite, li.ligne_ht, li.montantTHT,
                            (SELECT intd.validate FROM interv_doctors intd WHERE intd.validate = 1 AND intd.id = "'.$_POST['id'].'") AS validintd 
                            FROM ligne_intervs li                           
                            WHERE li.intervs_id = ?', [$id]);
    }

    // function qui remonte les lignes de l'intervention pour PDF / id interv //
    
    public function findLinesPdf($id) {

        return $this->query('SELECT li.id, li.intervs_id, li.designation, li.quantite, li.ligne_ht,
                            li.montantTHT
                            FROM ligne_intervs li 
                            WHERE li.intervs_id = ?', [$id]);
    }

    // function qui compte le montant total ht de l'intervention / id interv /a voir si ont garde/
    
    public function countmhtInterv($id) {

        return $this->query('SELECT SUM(li.montantTHT) AS mtht FROM ligne_intervs li WHERE li.intervs_id = ?', [$id]);
    } 

    // function qui compte le nombre de ligne enregistrer //
    
    public function countLines($id) {

        return $this->query('SELECT COUNT(li.id) AS Qtl FROM ligne_intervs li WHERE li.intervs_id = ?', [$id]);
    }

    // function qui supprime toutes les lignes de l'interv //
    
    public function deleteTLines($id) {

        return $this->query("DELETE FROM ligne_intervs WHERE intervs_id = ?", [$id]);
    }

}