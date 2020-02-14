<?php 
	
	require_once 'app/controllers/tools/Controller.class.php';
	//require_once 'app/models/tools/DataBaseFactory.class.php';
	//require_once 'app/models/DAOs/tools/DataObjectFactory.class.php';

	/**
	 * 
	 */
	class Index extends Controller
	{	
		
		function __construct($request){
			parent::__construct('index.html', $request, true);
		}

		public function render(){
			$this->useCache = false;
			return parent::render();
		}

	}

 ?>