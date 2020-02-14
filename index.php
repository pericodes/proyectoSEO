<?php 
	error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
	ini_set('display_errors', 'On');
	
	define("T_START", microtime(true));
	require_once 'app/controllers/tools/ControllerFactory.class.php';
	/*require_once 'app/models/DAOs/tools/DataAccessObjectFactory.class.php';
	$userDAO = DataAccessObjectFactory::getDataAccessObject("user"); 
	$userDAO->addUser("admin", "1234", "admin");*/

	function getSiteConfig()
	{
		if(!defined("SITE_CONFIG")){
			define("SITE_CONFIG", parse_ini_file("./app/config/dataSite.config.php"));
		}
		return SITE_CONFIG; 
	}

	echo ControllerFactory::createController()->render(); 
	

 ?>