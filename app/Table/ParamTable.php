<?php

namespace App\Table;

use Core\Table\Table;


class ParamTable extends Table {

	protected $table = 'conf_email';


	// function qui remonte les paramétres pour envoi emails //
    
    public function dataparamsemail() {

        return $this->query('SELECT * FROM conf_email');
    }

}