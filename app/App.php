<?php

use Core\Config;

use Core\Database\MysqlDatabase;


class App{

	
	public $title = "Base CDL";

	private $db_instance;

	private static $_instance;


	// function getInstance qui return l'instance unique //

	public static function getInstance(){

		if(is_null(self::$_instance)){

			self::$_instance = new App();
		}

		return self::$_instance;
	}
	

	public static function load(){

		session_start();

		require ROOT . '/app/Autoloader.php';

		App\Autoloader::register();

		require ROOT . '/core/Autoloader.php';

		Core\Autoloader::register();
	}

	// return objet Class Table //

	public function getTable($name){

		$class_name = '\\App\\Table\\' . ucfirst($name) . 'Table';
		
		return new $class_name($this->getDb());
	}

	
	public function getDb(){

		$config = Config::getInstance(ROOT . '/config/config.php');

		if(is_null($this->db_instance)){

			return new MysqlDatabase($config->get('db_name'), $config->get('db_user'), $config->get('db_pass'), $config->get('db_host'));
		}
			return $this->db_instance;
		
	}

	

    
}