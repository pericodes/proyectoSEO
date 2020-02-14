<?php

class ImgUploader 
{
    
    private static $acceptedOrigins = ["http://localhost"];
    private static $acceptedExtensions = ["jpg", "jpeg", "png", "gif"];
    private static $imageFolder = "public/images/";
    private static $widthSizes  = [100, 200, 400, 800, 1000, 1400, 1800];
    private static $formats  = [IMAGETYPE_JPEG, IMAGETYPE_WEBP];
    private static $maxSize = 5242880; // 5MB default
    private static $webPConvert;

    public function __construct() {
        $siteConfig = parse_ini_file("./app/config/dataSite.config.php");
        self::$acceptedOrigins[] = $siteConfig["urlIndex"];
    }

    public static function generateSrcset( &$optimizedImages, bool $setSrcset = false, bool $lazyLoad = false):string
    {   
        if($setSrcset){
            if($lazyLoad){
                $srcset= 'data-srcset="';
            }else{
                $srcset= 'srcset="';
            }
        }else{
            $srcset="";
        }
        
        foreach ($optimizedImages as $mime => $images) {
            foreach ($images as $image) {
                $srcset .= "/{$image['src']} {$image['width']}w, ";
            }
        }
        $srcset = substr($srcset, 0, -2);
        if($setSrcset){
            $srcset .= '"';
        }
        return $srcset;
    }

    /*public static function generateSources(array &$optimizedImages, bool $addMimeType = true){

        $sources=[];

        foreach ($optimizedImages as $mime => $srcImages) {
            $sources[$mime] = "<source ";
            if($addMimeType){
                $sources[$mime] = "type='$mime' srcset='";
            }
            foreach ($srcImages as $width => $src) {
                $sources[$mime] .= "$src {$width}w, "
            }
            $sources[$mime] .= substr($sources[$mime], 0, -2)."'>";
        }

        return $sources;

    }*/

    public static function generateSources( &$optimizedImages, bool $lazyLoad = false, bool $addMimeType = true): array{

        $sources=[];

        foreach ($optimizedImages as $mime => $images) {
            $sources[$mime] = "<source";
            if($addMimeType){
                $sources[$mime] .= " type='$mime'";
            }
            if($lazyLoad){
                $sources[$mime] .= " data-srcset='";
            }else{
                $sources[$mime] .= " srcset='";
            }
            foreach ($images as $image) {
                $sources[$mime] .= "/".$image['src']." ".$image['width']."w, ";
            }
            $sources[$mime] = substr($sources[$mime], 0, -2)."'>";
        }

        return $sources;

    }

    public static function generateHTML( &$image,  $options = []): string
    {
        /*$srcset = "";
        foreach ($result["optimizedImages"] as $img ) {
            $srcset .= $img['src']." ".$img['width']."w, ";
        }
        $srcset = substr($srcset, 0, strlen($srcset)-2);
        if(count($result["optimizedImages"])>2)
            $result["src"] =  $result["optimizedImages"][2]["src"];
        else
            $result["src"] =  $result["optimizedImages"][count($result["optimizedImages"])-1]["src"];

        $result["sizes"] =  "50vw";
        $result["srcset"] =  $srcset;
        

        if($generateHtml){
            if($alt != ""){
                $alt = "alt=\"$alt\"";
            }
            $result["html"] = <<<EOT
                <figure>
                    <source type="image/webp" srcset="{$srcset}">
                    <img src="{$result["srcToOriginalImage"]}" {$alt}>
                </figure>
                EOT;
            
            /*$result["html"] = "<img src=\"".$result["src"]."\" srcset=\"".$result["srcset"]."\" sizes=\"".$result["sizes"]."\" ";
            if($alt != "")
                $result["html"] .="alt=\"".$result["alt"]."\" ";
            
            $result["html"] .=">";
        }*/

        $img = "<img "; 

        if(isset($options["lazyLoad"]) && $options["lazyLoad"] == true){
            $lazyLoad = true;
            $img .= "src=\"";
        }else{
            $lazyLoad = false;
            $img .= "data-src=\"";
        }
        $img .= "{$image['srcToOriginalImage']}\"";

        if (isset($image["alt"])) {
            $img .= " alt=\"{$image['alt']}\"";
        }
        if (isset($image["title"])) {
            $img .= " title=\"{$image['title']}\"";
        }

        if(isset($options["class"])){
            $img .= " class=\"";
            if(is_string($options["class"])){
                $img .=$options["class"].'"';
            }elseif(is_array($options["class"])){
                $img .=implode(" ", $options["class"]).'"';
            }else{
                throw new Exception("Invalid class option. Expected string or array.");
            }
        }

        if(isset($options["generatePicture"]) && $options["generatePicture"] == true){
            $img = "<picture>".implode("",self::generateSources($image["optimizedImages"],$lazyLoad)).$img."></picture>";
        }else{
            $img .= " ".self::generateSrcset($image["optimizedImages"], true, $lazyLoad).">";
            return $img; 
        }
        return $img;
    }

    /* Checks the true mime type of the given file */
	private function checkMime(&$file){
		$finfo = finfo_open( FILEINFO_MIME_TYPE );
		$mtype = finfo_file( $finfo, $file );
        finfo_close( $finfo );
        $this->mtype = $mtype;
        $aux = strpos($mtype, 'image/');
        
		if( $aux === 0){
			return true;
		} else {
			return false;
		}
		
    }

    private function optimize(string $imageSrc, string $imageName = "", array $widthSizes = [], array $formats = []): array
    {
        if(file_exists($imageSrc)){
            $images = [];
            $path_parts  = pathinfo($imageSrc);
            $extension = $path_parts ['extension'];
            $widthSizes = count($widthSizes) == 0 ? self::$widthSizes : $widthSizes;
            $formats = count($formats) == 0 ? self::$formats : $formats;
            $imageName = $imageName ? $imageName : rawurlencode(str_replace(" ", "-", str_replace(".$type", "",$path_parts["filename"])));
            list($originaWidth, $originaHeight) = getimagesize($imageSrc);
            switch ($extension) {
                case 'jpeg':
                case 'jpg':
                    $image = imagecreatefromjpeg($imageSrc);
                    break;
                case 'png':
                    $image = imagecreatefrompng($imageSrc);
                    break;
                case 'webp':
                    $image = imagecreatefromwebp($imageSrc);
                    break;
                case 'gif':
                    $image = imagecreatefromwebp($imageSrc);
                    break;
                default:
                    throw new Exception("Unsuported format type to load the image");
                    break;
            }
            foreach (self::$widthSizes as $newWidth ) {
                // we resize the image
                //$imgTmp = $this->resize($image, $newWidth, $src);
                if($newWidth > $originaWidth){
                    $newWidth = $originaWidth;
                    $newHeight = $originaHeight;
                }else{
                    $newHeight = $newWidth*$originaHeight/$originaWidth;
                }
                $imgTmp = imagescale($image, $newWidth);

                //We save the image in all formats.
                foreach ($formats as $format) {
                    switch (strtolower($format)) {
                        case IMAGETYPE_JPEG:
                            $src = self::$imageFolder."jpg/{$imageName}_{$newWidth}.jpg";
                            imagejpeg($imgTmp, $src);
                            break;
                        case IMAGETYPE_WEBP:
                            $src = self::$imageFolder."webp/{$imageName}_{$newWidth}.webp";
                            imagewebp($imgTmp, $src);
                            break;
                        case IMAGETYPE_PNG:
                            $src = self::$imageFolder."png/{$imageName}_{$newWidth}.png";
                            imagepng($imgTmp, $src);
                            break;
                        default:
                            throw new Exception("Unsuported format type to save the image");
                            break;
                    }
                    $images[image_type_to_mime_type($format)][] = ["width" => $newWidth, "src" => $src];
                }

                imagedestroy($imgTmp);
                if($newWidth == $originaWidth)
                break;
            }
            return $images;
        }else{
            throw new Exception("Image doesn't found in $imageSrc");
        }

    }

    public function uploadImage(&$file, string $name = "", string $alt = "", string $title = "", string $caption = ""){
        $result["errors"] = [];
        $result["result"] = true;
        $path_parts  = pathinfo($file['name']);
        $extension = strtolower($path_parts["extension"]);
        $result["name"] = $name != "" ? $name : $path_parts["filename"];
        $result["name"] = rawurlencode(str_replace(" ", "-", $result["name"]));

        if(empty($file['tmp_name'])){
            header("HTTP/1.1 400 Error: File (". $file['tmp_name'] .") exceeds the maximum file size that this server allowes to be uploaded!");
            $result["errors"][] = "Error: File (". $file['tmp_name'] .") exceeds the maximum file size that this server allowes to be uploaded!";
            $result["result"]= false;
            return $result; 
        }
        if (!is_uploaded_file($file['tmp_name'])){
            header("HTTP/1.1 400 Invalid file. (".$file['tmp_name'].")");
            $result["errors"][]= "Error: invalid file";
            $result["result"]= false;
            return $result; 
        }
        if(!$this->checkMime($file['tmp_name'])){
            header("HTTP/1.1 400 Invalid file.");
            $result["errors"][]= "Error: invalid file type.";
            $result["result"] = false;
            unlink($file['tmp_name']);
            return $result; 
        }
        if(!in_array($extension, self::$acceptedExtensions)){
            header("HTTP/1.1 400 Invalid ($extension) extension. ==> ". $file['name']);
            $result["errors"][] = "Error: Invalid extension.";
            $result["result"] = false;
            unlink($file['tmp_name']);
            return $result;
        }
		if(filesize($file['tmp_name']) > self::$maxSize){
            header("HTTP/1.1 400 Invalid file.");
            $result["errors"][] = "Error: the maximum file size is ".self::$maxSize.". The file is removed!";
            $result["result"] = false;
            unlink($file['tmp_name']);
            return $result;
        }
        if (preg_match("/([^\w\s\d\-_~,;:\[\]\(\).])|([\.]{2,})/", $result["name"])) {
            header("HTTP/1.1 400 Error: Error: File (". $result["name"] .") has an invalid file name.");
            $result["errors"][] = "Error: Error: File (". $result["name"] .") has an invalid file name.";
            $result["result"] = false;
            unlink($file['tmp_name']);
            return $result;
        }
        

        $filetowrite = self::$imageFolder."original/{$result['name']}.{$extension}";
        move_uploaded_file($file['tmp_name'], $filetowrite);
        $result["image"]["optimizedImages"] = $this->optimize($filetowrite, $result["name"]);
        //unlink($filetowrite);
        $result["image"]["srcToOriginalImage"] = "/".$filetowrite;
        $result["image"]["name"] = $result["name"];
        list($originaWidth, $originaHeight, $extension) = getimagesize($filetowrite);
        $result["image"]["width"] = $originaWidth;
        $result["image"]["height"] = $originaHeight;
        $result["image"]["height"] = $originaHeight;
        $result["image"]["mime"] = image_type_to_mime_type($extension);

        if($alt != "")
            $result["image"]["alt"] =  $alt;
        
        if($title != "")
            $result["image"]["title"] =  $title;
        
        if($caption != "")
            $result["image"]["caption"] =  $caption;
        
        $result["ramdomId"] = uniqid();
        return $result;

    }

    public function uploadImages(array &$images, bool $generateHtml = false, array $names = [],  array $alts = []){
        
            $results = [];
            $i = 0; 
            if(count($names) >= count($images) && count($alts) >= count($images)){
                foreach($images as $image){
                    $results[] = $this->uploadImage($image, $generateHtml, $names[$i], $alts[$i]);
                }
            }elseif(count($names) >= count($images)){
                foreach($images as $image){
                    $results[] = $this->uploadImage($image, $generateHtml, $names[$i]);
                }
            }else{
                foreach($images as $image){
                    $results[] = $this->uploadImage($image, $generateHtml);
                }
            }
            
            return $results;
        
    }

}

?>