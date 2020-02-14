<?php 
	
	require_once 'app/controllers/tools/Controller.class.php';
	require_once 'app/models/tools/DataBaseFactory.class.php';
	require_once 'app/models/DAOs/tools/DataObjectFactory.class.php';

	/**
	 * 
	 */
	class NotFound extends Controller
	{	
		
		function __construct($request){
			parent::__construct('NotFound.html', $request);
		}

		public function render(){
			return parent::render();
		}

	}

 ?>