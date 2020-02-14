<?php 
	
	require_once 'app/controllers/tools/Controller.class.php';
    require_once 'app/models/DAOs/tools/DataAccessObjectFactory.class.php';

	/**
	 * 
	 */
	class AdminUsers extends Controller
	{	
        function __construct(Request $request, UserControl $userControl){
			parent::__construct('AdminUsers.html', $request, false, $userControl);
        }

		public function render(){
            if($this->userAdminOrBlock()){
                $userDAO = DataAccessObjectFactory::getDataAccessObject("user");
                if($this->request->methodIsPost()){
                    if($this->origenAllowed()){
                        switch ($this->request->getParam("action")) {
                            case 'addOrUpdateUser':
                                return $this->addOrUpdateUser($userDAO); 
                                break;
                            case 'deleteUser':
                                return $this->deleteUser($userDAO); 
                                break;
                            default:
                                # code...
                                break;
                        }
                    }
                }else if($this->request->methodIsGet()){
                    $users = $userDAO->getNormalUsers();
                    //var_dump($users);
                    $this->addInclude("userForm");
                    $this->addArgument("users", $users); 
                    return parent::renderDirectly();
                }
            }
        }
        
        private function deleteUser(UserDAO $userDAO)
        {
            $id = $this->request->getParam("id");
            return parent::renderJson($userDAO->deleteById($id));
        }

        private function addOrUpdateUser(UserDAO $userDAO)
        {
            $id = $this->request->getParam("id");
            $user = $this->request->getParam("user");
            $pass = $this->request->getParam("pass");
            $role = $this->request->getParam("role");
            $amazonAffiliateTag = $this->request->getParam("amazonAffiliateTag");
            if($id){
                return parent::renderJson($userDAO->updateUserById($id, $user, $pass, $role, $amazonAffiliateTag));
            }else{
                return parent::renderJson($userDAO->addUser($user, $pass, $role, $amazonAffiliateTag));
            }
        }

	}

 ?>