<?php 
	
	require_once 'app/controllers/tools/Controller.class.php';
	//require_once 'app/models/tools/DataBaseFactory.class.php';
	require_once 'app/models/DAOs/tools/DataAccessObjectFactory.class.php';

	/**
	 * 
	 */
	class UserPosts extends Controller
	{	
		private $projection = ["projection" => ["link" => 1, "title" => 1]];
		function __construct(Request $request, UserControl $userControl){
            parent::__construct('UserPosts.html', $request, false, $userControl);
			$this->useCache = false;
		}

		private function delete() : string
		{
			$id = $this->request->getParam("id");
			if($this->userControl->isAdmin()){
				$result = DataAccessObjectFactory::getDataAccessObject("post")->deleteById($id);
			}else{
				$result = DataAccessObjectFactory::getDataAccessObject("post")->deleteByIdWithUserId($id, $this->userControl->getUserID());
			}
			return parent::renderJson($result);
		}
		
		private function search() : string
		{
			$title = $this->request->getParam("text");
			$posts = DataAccessObjectFactory::getDataAccessObject("post")->findByTitle($title, $this->projection);
			return parent::renderJson($posts);
		}

		public function render(){
            if ($this->request->getMethod() == "GET") {
                if($this->userControl->isLogued()){
					$user = $this->userControl->getUser();
					$this->arguments["userLoged"] = isset($this->userControl) ? $this->userControl->isLogued() : false;
					//var_dump($user);
					if($this->userControl->isAdmin()){
						$posts = DataAccessObjectFactory::getDataAccessObject("post")->findByUserId($_SESSION["userID"], $this->projection);
					}else{
						$posts = DataAccessObjectFactory::getDataAccessObject("post")->findByUserId($_SESSION["userID"]);
					}
					$this->arguments["posts"] = $posts;
					return parent::render();
                }
			}elseif ($this->request->getMethod() == "POST") {
				switch ($this->request->getParam("action")) {
					case 'search':
						return $this->search();
						break;
					case 'delete':
						return $this->delete();
						break;
					default:
						parent::forbiden();
						break;
				}
			}else{
                parent::forbiden();
            }
		}

	}

 ?>