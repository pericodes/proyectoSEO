<?php 
	
	require_once 'app/controllers/tools/Controller.class.php';
	require_once 'app/models/tools/DataBaseFactory.class.php';
	require_once 'app/dependencies/AmazonAPI/AmazonAPI.class.php';
	require_once 'app/dependencies/imgUploader/ImgUploader.class.php';
	//require_once 'app/dependencies/HtmlMin/HtmlMin.php';
	//require_once 'app/models/DAOs/tools/DataObjectFactory.class.php';
	/**
	 * 
	 */
	class Post extends Controller
	{	
		
		function __construct(Request $request){
			parent::__construct('Post.html', $request, true);
			//Includes
			$this->addInclude("coment", "includes/coment.html");
			$this->addInclude("amazonSingleProduct", "includes/amazonSingleProduct.html");
		}

		private function addMetaTags(object &$post)
		{
			$this->metaTags->setTitle($post["metaTitle"]);
			$this->metaTags->setDescription($post["metaDescription"]);
			$this->metaTags->setUrl($post["link"]);
			//$this->metaTags->setPubDate(date('l\, F d\, Y\, g:i a', substr( $post["creationDate"]["milliseconds"]->toDateTime()->getTimestamp(), 0, 10)));
			$this->metaTags->setPubDate($post["creationDate"]["milliseconds"]->toDateTime()->getTimestamp());
			//$this->metaTags->setPubDate(date('l',$post["creationDate"]["readable"]));
			$aux = $post["creationDate"]["milliseconds"]->toDateTime();
			$aux->format('l\, F d\, Y\, g:i a');
			//var_dump( $aux->getTimestamp());
			if($post["isAProduct"]){
				
			}
			if($post["imagePost"]["image"]["srcToOriginalImage"]){
				$this->metaTags->setUrlImage($post["imagePost"]["image"]["srcToOriginalImage"]);
			}
			//var_dump($post["keywords"]);
			if($post["keywords"]){
				$this->metaTags->setKeywords($post["keywords"]->bsonSerialize());
			}

		}

		public function render(){

			
			if(parent::haveToRender()){
				$amazonConfig = parse_ini_file("./app/config/amazon.config.php");

				$url = $this->request->getPath();
				//echo $this->request->getPath()."<br><br><br>";
				$mongo = DataBaseFactory::getDataBase("mongo")->getConnection();
				$collection = $mongo->selectCollection("posts");
				$post = $collection->findOne(['link' => $url]);

				if($post){
					//var_dump($post["keywords"][0]["keyword"]);
					$this->addMetaTags($post);
					
					$amazon = new AmazonAPI($amazonConfig["amazonAffiliateTag"], $amazonConfig["accessKey"], $amazonConfig["secretKey"]);
					//var_dump($amazon->executeFuntion("itemLookup")("B000K67UF2"));
					//echo($url."<br><br><br>");

					//var_dump($json);
					
					
					//$this->meta = $ogp->toHTML();
					//var_dump($this->meta);
					
					//var_dump($post["imagePost"]["image"]);
					$this->arguments["imgHTML"] = ImgUploader::generateHTML($post["imagePost"]["image"]);
					$this->arguments["title"] = $post["title"];
					$this->arguments["description"] = str_replace("<hr>", "",$post["html"]);
					$this->useCache = true;
					$this->useHtmlMin = true;
					
					
					//return parent::render();
					return parent::renderDirectly();
					/*$tinyHtmlMinifier = new TinyHtmlMinifier(['collapse_whitespace' => false, 'disable_comments' => false,]); 
					return $tinyHtmlMinifier->minify(parent::render());*/

				}else{
					return parent::notFound();
				}
			}else{
				return parent::sendCachedPageDirectly();
			}
			
			
			
		}

	}

 ?>