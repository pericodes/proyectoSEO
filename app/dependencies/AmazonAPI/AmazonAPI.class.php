<?php

class AmazonAPI {

    private $amazon_aff_id;
    private $amazon_access_key;
    private $amazon_secret_key;

    private $returnType = "SimpleObject";

    private $responseGroup; 
    private $version;

    private $error_message;
    private $error = 0;

    private static $localeTable = array(
		'br' => 'webservices.amazon.br',
		'ca' =>	'webservices.amazon.ca',
		'cn' =>	'webservices.amazon.cn',
		'fr' =>	'webservices.amazon.fr',
		'de' =>	'webservices.amazon.de',
		'in' =>	'webservices.amazon.in',
		'it' =>	'webservices.amazon.it',
		'jp' =>	'webservices.amazon.co.jp',
		'mx' =>	'webservices.amazon.com.mx',
		'es' =>	'webservices.amazon.es',
		'uk' =>	'webservices.amazon.co.uk',
		'us' =>	'webservices.amazon.coml'
    );

    private static $validSearchNames = array(
		'All',
		'Apparel',
		'Appliances',
		'Automotive',
		'Baby',
		'Beauty',
		'Blended',
		'Books',
		'Classical',
		'DVD',
		'Electronics',
		'Grocery',
		'HealthPersonalCare',
		'HomeGarden',
		'HomeImprovement',
		'Jewelry',
		'KindleStore',
		'Kitchen',
		'Lighting',
		'Marketplace',
		'MP3Downloads',
		'Music',
		'MusicTracks',
		'MusicalInstruments',
		'OfficeProducts',
		'OutdoorLiving',
		'Outlet',
		'PetSupplies',
		'PCHardware',
		'Shoes',
		'Software',
		'SoftwareVideoGames',
		'SportingGoods',
		'Tools',
		'Toys',
		'VHS',
		'Video',
		'VideoGames',
		'Watches'
    );
    
    private static $functions = [];


    public function __construct(string $affid, string $access, string $secret, string $locale = 'es', string $version = "2013-08-01")
    {
        $this->amazon_aff_id = $affid;
        $this->amazon_access_key = $access;
        $this->amazon_secret_key = $secret;

        $this->host = self::$localeTable[$locale];
        $this->path = "/onca/xml";

        $this->version = $version;

        self::addFunction("itemLookup", function (string $ItemId, array $options = [])
        {
            $params = ["fasfds" => "fasdfsd"];
            /*if (is_array($asinList)) {
                $asinList = implode(',', $asinList);
            }*/
    
            $params = array(
                'Operation' => 'ItemLookup',
                //'ResponseGroup' => 'ItemAttributes,Offers,Reviews,Images,EditorialReview',
                //'ReviewSort' => '-OverallRating',
                'ItemId' => $ItemId,
                //'MerchantId' => 'All'
            );
    
            return $this->execute($params, $options, "d");
        });

        self::addFunction("prueba", function ($blablabla)
        {
            echo "prueba: $blablabla<br><br>";
        });
        //self::$functions["echo"]();

    }

    public static function getFunctions() : array
    {
         return self::$functions; 
    }

    public static function addFunction(string $functionName, $function) : void
    {
        self::$functions[$functionName] = $function; 
    }

    public function setReturnTrype(string $returnType) : void 
    {
        $this->returnType = $returnType; 
    }
    public function executeFuntion(string $functionName)
    {
        if(array_key_exists ($functionName, self::$functions )){
            return self::$functions[$functionName];
        }else{
            throw new Exception("Error: the function $functionName doesn't exist.");
        }
    }
    public function setResponseGroup(string $responseGroup) : void 
    {
        $this->responseGroup = $responseGroup; 
    }

    public function getValidSearchNames():array 
    {
		return $this->validSearchNames;
	}

    protected function buildUrl(array $options) : string
    {
        $params = array("Service" => "AWSECommerceService",
                        "AWSAccessKeyId" => $this->amazon_access_key,
                        "AssociateTag" => $this->amazon_aff_id,
                        //"Version" => $this->version
                    );
        $params = array_merge($params, $options);
        $params["Timestamp"] = date("Y-m-d\TH:i:s\Z");

        // The new authentication requirements need the keys to be sorted
        ksort($params);


        $params = http_build_query($params, "", "&", PHP_QUERY_RFC3986);
        
        $params .= "&Signature=" . $this->generateSignature($params);

        return "http://$this->host$this->path?$params";
    }

    private function generateSignature(string &$params) : string
    {
        return str_replace("=", "%3D", str_replace("+", "%2B",base64_encode(hash_hmac("sha256",
            "GET\n$this->host\n$this->path\n" . $params,
            $this->amazon_secret_key, True))));
    }

    protected function execute(array &$baseParams, array &$options = [], string $returnType = null): string {

        if ($this->responseGroup) {
            $params["ResponseGroup"] = $this->responseGroup;
        }
        $url = $this->buildUrl(array_merge($baseParams, $options));
        $ch = curl_init($url);  
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        //curl_setopt($ch,CURLOPT_URL,$url);
        $output = curl_exec($ch);
        curl_close($ch);

        //echo $url; 
        libxml_use_internal_errors(true);
        $xml = simplexml_load_string($output);
        if($xml){
            $returnType = $returnType ? $returnType : $this->returnType;
            switch (strtolower($returnType)) {
                case 'simpleobject':
                    return $xml;
                    break;
                case 'json':
                    return json_encode($xml);
                    break;
                case 'array':
                    return json_decode(json_encode($xml), true);
                    break;
                default:
                    return $output; 
                    break;
            }
        }else{
            throw new Exception("Error Processing Request: $url");
            
        }
        
        
    }

    public function ItemLookup(string $ItemId, array $options = []) {
		if (is_array($asinList)) {
			$asinList = implode(',', $asinList);
		}

		$params = array(
			'Operation' => 'ItemLookup',
			//'ResponseGroup' => 'ItemAttributes,Offers,Reviews,Images,EditorialReview',
			//'ReviewSort' => '-OverallRating',
			'ItemId' => $ItemId,
			//'MerchantId' => 'All'
        );
        


		return $this->execute($params, $options);
    }
    
    public function ItemSearch($searchIndex = "All") {
		$params = array(
			'Operation' => 'ItemSearch',
			//'ResponseGroup' => 'ItemAttributes,Offers,Images',
			'SearchIndex' => $searchIndex
        );
        if ($this->responseGroup) {
            $params["ResponseGroup"] = $this->responseGroup;
        }

		return $this->execute($params, $options);

	}

}



?>