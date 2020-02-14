<?php 
	//require_once 'app/models/DAOs/ExampleDAO.class.php';
	

	final class DataAccessObjectFactory {

		private static $dataObjects = array();

		private function __construct($argument)
		{
			# code...
		}

		public static function getDataAccessObject($dataObject)
		{

			if(!isset(self::$dataObjects[$dataObject])){
				self::createDataObject($dataObject);
			}
			return self::$dataObjects[$dataObject];
			
		}

		private static function createDataObject($dataObject){
			switch ($dataObject) {
				case 'user':
					require_once 'app/models/DAOs/UserDAO.class.php';
					self::$dataObjects[$dataObject] = new UserDAO(); 
					break;
				case 'post':
					require_once 'app/models/DAOs/PostDAO.class.php';
					self::$dataObjects[$dataObject] = new PostDAO(); 
					break;
				default:
					throw new Exception("No dataObject found with this name: " . $dataObject);
					break;
			}
		}


	}


 ?>