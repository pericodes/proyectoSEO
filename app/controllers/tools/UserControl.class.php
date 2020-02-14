<?php 
    session_cache_expire(60);
    session_start();
    session_regenerate_id(true);

	/**
	 * 
	 */
	class UserControl 
	{
		
		private $user;
        private $userID;
        protected $isLogued = false;
        protected $isAdmin = false;

		function __construct()
		{
            $this->isAdmin = false; 
			//abrimos la sesión
            if (isset($_SESSION["userID"])) {//El usuario está registrado
                $this->userID = $_SESSION["userID"];
				require_once 'app/models/DAOs/tools/DataAccessObjectFactory.class.php';
                $this->user = DataAccessObjectFactory::getDataAccessObject("user")->findById($_SESSION["userID"]);
				if($this->user != null){
                    $this->isLogued = true;
                    //$this->isAdmin = $this->user["role"] == "admin";
                    $this->isAdmin = $this->user->getRole() == "admin";
                }else{
                    $this->isLogued = false;
                }
			}else{
                $this->isLogued = false; 
			}
        }
        public function isLogued():bool
		{
			return $this->isLogued;
        }
        public function isAdmin():bool
		{
			return $this->isAdmin;
		}
        
        /*public function setUserID(string $userID):void
        {
            $this->userID = $userID;
            $_SESSION["userID"] = $this->userID;
        }*/

        public function getUserID():string
        {
            return $this->userID;
        }

        public function getUser():UserVO 
        {
            return $this->user;
        }

        public function login(string $user, string $pass): bool
        {
            require_once 'app/models/VOs/UserVO.class.php';

            require_once 'app/models/tools/DataBaseFactory.class.php';
            $userCollection = DataBaseFactory::getDataBase("mongo")->getConnection("users");
            $user = $userCollection->findOne(["user" => $user], ["hash", "role"]);
            //echo $user->validatePass($pass) ? "true" : "false"; 
            if(($user != null && $user->validatePass($pass))){
            //if(($user != null && password_verify($pass, $user["hash"]) )){
                $this->userID = $user->getId();
                $_SESSION["userID"] = $this->userID;
                $this->isLogued = true;
                $this->isAdmin = $user->getRole() == "admin";

                return true; 
            }
            return false;
        }

        public function logout() : void
		{
            unset($this->user);
            unset($this->userID);
            $this->isLogued = false;

			if (session_status()==PHP_SESSION_NONE)
			session_start();
			// Borrar variables de sesión
			session_unset(); 
			// Obtener parámetros de cookie de sesión
			$param = session_get_cookie_params();
            // Borrar cookie de sesión si existe
            if(isset($_COOKIE[session_name()])){
                setcookie(session_name(), $_COOKIE[session_name()], time()-2592000,
			    $param['path'], $param['domain'], $param['secure'], $param['httponly']);
            }
			// Destruir sesión
			session_destroy();
		}


	}


 ?>