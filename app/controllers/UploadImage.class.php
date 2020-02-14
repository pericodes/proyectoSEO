<?php 
	
	require_once 'app/controllers/tools/Controller.class.php';
    require_once 'app/dependencies/imgUploader/ImgUploader.class.php';

	/**
	 * 
	 */
	class UploadImage extends Controller
	{	
		
		function __construct($request, UserControl $userControl){
			parent::__construct('UploadImage.html', $request, false, $userControl);
		}

		public function render(){
			$this->metaTags->setIndex(false);
			if ($this->request->getMethod() == "GET") {
				return parent::notFound();
			}else{
				if($this->origenAllowed() && $this->userLoguedOrBlock()){
				$imgUploader = new ImgUploader(); 
				if($this->request->getParam("action") == "tinyEditor"){
					$data = $imgUploader->uploadImage($_FILES["tinyImageUpload"]);
					$data["srcset"] = ImgUploader::generateSrcset($data["image"]["optimizedImages"]);
					$data["soucers"] = ImgUploader::generateSources($data["image"]["optimizedImages"]);
					$data["picture"] = ImgUploader::generateHTML($data["image"], ["generatePicture" => true, "class" => "imgDescription"]);

				}else{
					$data = $imgUploader->uploadImages($_FILES, true);
				}
				return $this->renderJson($data);
				}else{
					header("HTTP/1.1 500 Server Error");
					return false;
				}
            }
		}

	}

 ?>