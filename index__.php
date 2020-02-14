<?php 
	error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
    ini_set('display_errors', 'On');
    
    //$mongoCredentialPath = "app/config/dbMongoCredentials.config.php";
    $amazonPath = "app/config/amazon.config.php";

    define("DATA_SITE_PATH", "app/config/dataSite.config.php");
    define("MONGO_CREDENTIAL_PATH", "app/config/dbMongoCredentials.config.php");
    define("CONFIG_SECURITY", "<?php return; ?>\n; credentials\n");
    define("AMAZON_CONFIG", "app/config/amazon.config.php");

    function getSiteConfig()
	{
		if(!defined("SITE_CONFIG")){
			define("SITE_CONFIG", parse_ini_file(DATA_SITE_PATH));
		}
		return SITE_CONFIG; 
	}
	
	if($_SERVER['REQUEST_METHOD'] == "GET"){
        $html = <<<HTML
        <!DOCTYPE html>
        <html>
            <head>
                <!-- metaTags -->
                <meta charset="utf-8"/>
                <meta name="viewport" content="width=device-width, initial-scale=1"/>
                <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
                <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
            </head>
            <body class="container">
                <section id="generic-form" class="border-bottom pb-3">
        HTML;
        /*$dataSite =  parse_ini_file("./app/config/dataSite.config.php");

        foreach ($dataSite as $key => $value) {
        $html .= <<<HTML
                    <div class="form-group mb-3">
                        <label for="$key">$key</label>
                        <input type="text" class="form-control" id="$key" name="$key" value="$value">
                    </div>
                    HTML;
        }*/

        $html .= <<<HTML
                <fieldset class="scheduler-border" id="dataSite">
                    <legend class="scheduler-border">Data Site</legend>
                    <div class="form-group mb-3">
                        <label for="siteName">siteName</label>
                        <input type="text" class="form-control" id="siteName" name="siteName" placeholder="Comprar Movil Nuevo">
                    </div>
                    <div class="form-group mb-3">
                        <label for="siteDescription">siteDescription</label>
                        <textarea type="text" class="form-control" id="siteDescription" name="siteDescription" placeholder="Web para comprar móviles nuevos en oferta"></textarea>
                    </div>
                    <div class="form-group mb-3">
                        <label for="subject">subject</label>
                        <input type="text" class="form-control" id="subject" name="subject" placeholder="Ofertas de moviles">
                    </div>
                    <div class="form-group mb-3">
                        <label for="language">language</label>
                        <input type="text" class="form-control" id="language" name="language" value="ES">
                    </div>
                    <div class="form-group mb-3">
                        <label for="locale">locale</label>
                        <input type="text" class="form-control" id="locale" name="locale" value="es_ES">
                    </div>
                    <div class="form-group mb-3">
                        <label for="domain">domain</label>
                        <input type="text" class="form-control" id="domain" name="domain" value="{$_SERVER['SERVER_NAME']}">
                    </div>
                    <div class="form-group mb-3">
                        <label for="urlIndex">urlIndex</label>
                        <input type="text" class="form-control" id="urlIndex" name="urlIndex" value="http://{$_SERVER['SERVER_NAME']}/">
                    </div
                    ><div class="form-group mb-3">
                        <label for="urlFeed">urlFeed</label>
                        <input type="text" class="form-control" id="urlFeed" name="urlFeed" value="public/feed">
                    </div>
                    <div class="form-group mb-3">
                        <label for="urlSitemap">urlSitemap</label>
                        <input type="text" class="form-control" id="urlSitemap" name="urlSitemap" value="public/sitemap">
                    </div>
                    <div class="form-group mb-3">
                        <label for="urlAddPost">urlAddPost</label>
                        <input type="text" class="form-control" id="urlAddPost" name="urlAddPost" value="addPost">
                    </div>
                    <div class="form-group mb-3">
                        <label for="urlUploadImage">urlUploadImage</label>
                        <input type="text" class="form-control" id="urlUploadImage" name="urlUploadImage" value="uploadimage">
                    </div>
                </fieldset>
                <fieldset class="scheduler-border" id="amazon">
                    <legend class="scheduler-border">Amazon</legend>
                    <div class="form-group mb-3">
                        <label for="amazonAffiliateTag">amazonAffiliateTag</label>
                        <input type="text" class="form-control" id="amazonAffiliateTag" name="amazonAffiliateTag" value="ofez03-21">
                    </div>
                    <div class="form-group mb-3">
                        <label for="accessKey">accessKey</label>
                        <input type="text" class="form-control" id="accessKey" name="accessKey">
                    </div>
                    <div class="form-group mb-3">
                        <label for="secretKey">secretKey</label>
                        <input type="text" class="form-control" id="secretKey" name="secretKey">
                    </div>
                </fieldset>
                <fieldset class="scheduler-border" id="mongoCredentials">
                    <legend class="scheduler-border">Mongo Credentials</legend>
                    <div class="form-group mb-3">
                        <label for="schema">schema</label>
                        <input type="text" class="form-control" id="schema" name="schema" value="mongodb+srv">
                    </div>
                    <div class="form-group mb-3">
                        <label for="host">host</label>
                        <input type="text" class="form-control" id="host" name="host" value="pruebas-d1mid.azure.mongodb.net/test?retryWrites=true&amp;w=majority">
                    </div>
                    <div class="form-group mb-3">
                        <label for="onlyreadMongoUser">Only read user</label>
                        <input type="text" class="form-control" id="onlyreadMongoUser" name="onlyreadMongoUser">
                    </div>
                    <div class="form-group mb-3">
                        <label for="onlyreadMongoPassword">Only read password</label>
                        <input type="text" class="form-control" id="onlyreadMongoPassword" name="onlyreadMongoPassword">
                    </div>
                    <div class="form-group mb-3">
                        <label for="writeMongoUser">Write user</label>
                        <input type="text" class="form-control" id="writeMongoUser" name="writeMongoUser">
                    </div>
                    <div class="form-group mb-3">
                        <label for="writeMongoPassword">Write password</label>
                        <input type="text" class="form-control" id="writeMongoPassword" name="writeMongoPassword">
                    </div>
                </fieldset>
                <fieldset class="scheduler-border" id="userAdmin">
                    <legend class="scheduler-border">Admin user</legend>
                    <div class="form-group mb-3">
                        <label for="adminUser">Admin user</label>
                        <input type="text" class="form-control" id="adminUser" name="adminUser">
                    </div>
                    <div class="form-group mb-3">
                        <label for="adminPassword">Write password</label>
                        <input type="text" class="form-control" id="adminPassword" name="adminPassword">
                    </div>
                </fieldset>
                HTML;
        /*$dataSite =  parse_ini_file("./app/config/dbMongoCredentials.config.php");

        foreach ($dataSite as $key => $value) {
        $html .= <<<HTML
                    <div class="form-group mb-3">
                        <label for="$key">$key</label>
                        <input type="text" class="form-control" id="$key" name="$key" value="$value">
                    </div>
                    HTML;
        }*/
        $html .= <<<HTML
                    <button  class="btn btn-primary" onClick="send()">Configurar</button>
                    <script>
                    function send() {
                        let data = new Object();
                        data["dataSite"] = new Object();
                        for (const input of document.querySelectorAll("#dataSite input, #dataSite textarea")) {
                            data["dataSite"][input.name] = input.value;
                        }
                        data["amazon"] = new Object();
                        for (const input of document.querySelectorAll("#amazon input")) {
                            data["amazon"][input.name] = input.value;
                        }
                        data["mongoCredentials"] = new Object();
                        for (const input of document.querySelectorAll("#mongoCredentials input")) {
                            data["mongoCredentials"][input.name] = input.value;
                        }
                        data["userAdmin"] = new Object();
                        for (const input of document.querySelectorAll("#userAdmin input")) {
                            data["userAdmin"][input.name] = input.value;
                        }
                        console.log(JSON.stringify(data));
                        fetch("index", {
                            method: 'POST', // or 'PUT'
                            body: JSON.stringify(data), // data can be `string` or {object}!
                            headers:{
                                'Content-Type': 'application/json'
                            }
                            }).then(res => {
                                if(res.ok){
                                    res.text().then(text => {
                                        console.log(text); 
                                    }).catch(err => {
                                        console.log("Error",err);
                                    }); 
                                }
                            })
                            .catch(error => {
                                console.log("Error",error);
                            })
                            .then(response => console.log('Success:', response));
                                }
                    </script>
                </section>
                <style>
                    fieldset.scheduler-border {
                        border: 1px groove #ddd !important;
                        padding: 0 1.4em 1.4em 1.4em !important;
                        margin: 0 0 1.5em 0 !important;
                        -webkit-box-shadow:  0px 0px 0px 0px #000;
                                box-shadow:  0px 0px 0px 0px #000;
                    }
                    legend.scheduler-border {
                        font-size: 1.2em !important;
                        font-weight: bold !important;
                        text-align: left !important;
                    }
                </style>
            </body>
        </html>
        HTML;
        echo $html; 
    }else if ($_SERVER['REQUEST_METHOD'] == "POST"){
        require_once 'app/models/tools/DataBaseMongo.class.php';
        require_once 'app/models/VOs/User.class.php';
        
        $param = json_decode(file_get_contents('php://input'), true);

        $result = []; 

        // Config File
        if(file_exists(DATA_SITE_PATH)){
            $result["warning"][] = "The data site file alredy exits. It will be overwritten";
        }
        $dataSite = generateConfigFile($param["dataSite"], $result);
        if($dataSite){
            if(!file_put_contents(DATA_SITE_PATH, $dataSite)){
                $result["error"][] = "Error: the data site file couldn't be written.";
            }else{
                $result["info"][] = "Data site: written.";
            }
        }
        
        // Database
        if(!mongoTestError($param, $result)){
            $result["info"][] = "Mongo database tested and correct";
        }else{
            $result["error"][] = "Error testing the Mongo database";
        }

        // Admin User
        if(!isset($result["error"]) || (isset($result["error"]) && count($result["error"]) == 0)){
            $mongo = new DataBaseMongo(MONGO_CREDENTIAL_PATH);
            $dataBase = $mongo->getConnection("", true);
            /*if(!isset($dataBase->listCollections()["users"])){
                $resultMongo = $dataBase->createCollection('users', [
                    'validator' => [
                        'user' => ['$type' => 'string'],
                        'hash' => ['$type' => 'string'],
                        'amazonAffiliateTag' => ['$type' => 'string'],
                        'role' => ['$type' => 'array'],
                    ],
                ]);
                if($resultMongo["ok"] == 1){
                    $result["info"][] = "Users Collection created";
                }else{
                    $result["error"][] = "There was a problem creating users collection.";
                }
            }else{
                $result["warning"][] = "Users collection alreaddy exists.";
            }
            */
            
            $usersCollection = $dataBase->selectCollection("users");
            //$usersCollection->createIndex(["user" => 1], [ "unique" => true ]);

            if (strlen($param["userAdmin"]["adminUser"]) && strlen($param["userAdmin"]["adminPassword"])) {
                $insertOneResult = $usersCollection->insertOne(new User($param["userAdmin"]["adminUser"], $param["userAdmin"]["adminPassword"], "", ["admin"]));
                if($insertOneResult->getInsertedCount() == 1){
                    $result["info"][] = "Admin user inserted";
                }else{
                    $result["error"][] = "There was a problem inserting admin user.";
                }
            } else {
                $result["error"][] = "You must say a user and a password to Admin";
            }
            
            
        }else{
            $result["error"][] = "Admin user don't created because there are errors before";
        }
        
        // Amazon File
        if(file_exists(AMAZON_CONFIG)){
            $result["warning"][] = "The Amazon Config file alredy exits. It will be overwritten";
        }
        $amazon = generateConfigFile($param["amazon"], $result);
        if($amazon){
            if(!file_put_contents(AMAZON_CONFIG, $amazon)){
                $result["error"][] = "Error: the Amazon Config file couldn't be written.";
            }else{
                $result["info"][] = "Amazon Config: written.";
            }
        }
        
        
        

        var_dump ($param);
        echo "\n\n\n";
        var_dump ($result);

    }


    function mongoTestError(array &$param, array &$result): bool
    {
        $dataBaseError = false;
        try {
            DataBaseMongo::testStatic($param["mongoCredentials"]["schema"],
                            $param["mongoCredentials"]["onlyreadMongoUser"],
                            $param["mongoCredentials"]["onlyreadMongoPassword"],
                            $param["mongoCredentials"]["host"], 
                            false);
            $result["info"][] = "Connection with Read Only User: Correct";
        } catch (\Throwable $th) {
            $result["error"][] = "Error testing the connection with Read Only User";
            $dataBaseError = true;
        }
        
        try {
            DataBaseMongo::testStatic($param["mongoCredentials"]["schema"],
                            $param["mongoCredentials"]["writeMongoUser"],
                            $param["mongoCredentials"]["writeMongoPassword"],
                            $param["mongoCredentials"]["host"], 
                            true);
            $result["info"][] = "Connection with Write User: Correct";
        } catch (\Throwable $th) {
            $result["error"][] = "Error testing the connection with Write User";
            $dataBaseError = true;
        }

        if (!$dataBaseError) {
            $dbMongoCredentials = generateConfigFile($param["mongoCredentials"], $result);
            if(!$dataBaseError && $dbMongoCredentials){
                if(file_exists(MONGO_CREDENTIAL_PATH)){
                    $result["warning"][] = "The mongo credential file alredy exits. It has been overwritten";
                }
                if(!file_put_contents(MONGO_CREDENTIAL_PATH, $dbMongoCredentials)){
                    $result["error"][] = "Error the mongo credential file couldn't be written.";
                }else{
                    $result["info"][] = "Mongo credential: written.";
                    $mongo = new DataBaseMongo(MONGO_CREDENTIAL_PATH);
                    if ($mongo->test()) {
                        $result["info"][] = "Mongo credential file: tested.";
                    }else{
                        $result["error"][] = "Mongo credential file: Error.";
                        $dataBaseError = true;
                    }
                }
            }
        }

        return $dataBaseError;
    }

    function generateConfigFile(array &$data, array &$result, bool $emptyValuesAllowed = false) 
    {
        $file = CONFIG_SECURITY;
        $error = true; 

            foreach ($data as $key => $value) {

                if(!$emptyValuesAllowed){

                    if(strlen($value) > 0){
                        $file .= $key . "=\"" . $value . "\"\n";
                    }else{ 
                        $result["error"][] = "Error $key can't be empty";
                        $error = false; 
                        break;
                    }
                }else{
                    $file .= $key . "=\"" . $value . "\"\n";
                }
            }
            echo $error."\n";
            var_dump ((!$error) ? $error : $file);
            return (!$error) ? $error : $file; 
    }
 ?>