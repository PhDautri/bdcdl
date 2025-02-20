<?php

namespace App\Table;

use Core\Table\Table;


class DailyeventTable extends Table {

	protected $table = 'daily_events';


	// function qui remonte tous les événements journalier //
	
	public function allevents(){

		return $this->query('SELECT de.id, de.user, DATE_FORMAT(de.date, \'%d-%m-%Y\') AS dateeventfr, de.designation, de.commentaire

							FROM daily_events de							

							ORDER BY de.id
						');
	
	}


}