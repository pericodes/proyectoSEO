<?php 
	
	require_once 'app/controllers/tools/Controller.class.php';
	//require_once 'app/models/tools/DataBaseFactory.class.php';
	//require_once 'app/models/DAOs/tools/DataObjectFactory.class.php';

	/**
	 * 
	 */
	class Login extends Controller
	{	
		
		function __construct($request, $userControl = false){
			parent::__construct('Login.html', $request, false, $userControl or true);
		}

		public function render(){

            if ($this->request->getMethod() == "POST") {
                if($this->origenAllowed()){
                    if($this->request->getParam("action") == "login" ){
                        $user = $this->request->getParam("user");
                        $pass = $this->request->getParam("pass");
                        //return $this->validateUserAndPass($user, $pass);
                        if(!$this->userControl->login($user, $pass)){
                            return "<html><head><script>localStorage.setItem('loginError', 'true');window.history.go(-1);</script></head></html>";
                        }
                    }else if($this->request->getParam("action") == "logout"){
                        $this->userControl->logout();
                        //return "<html><head><script>window.history.go(-1)</script></head></html>";
                        unset($this->userControl);
                    }else{
                        parent::forbiden();
                    }
                    
                }
            }
            $this->arguments["userLoged"] = isset($this->userControl) ? $this->userControl->isLogued() : false;
            return parent::renderDirectly();
        }        

	}

 ?>