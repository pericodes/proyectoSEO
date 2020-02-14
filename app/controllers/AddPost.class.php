<?php 
	
	require_once 'app/controllers/tools/Controller.class.php';
    require_once 'app/models/tools/DataBaseFactory.class.php';

	/**
	 * 
	 */
	class AddPost extends Controller
	{	
		
		function __construct(Request $request, UserControl $userControl){
			parent::__construct('AddPost.html', $request, false, $userControl);
        }
        
        private function normalizeUrl(string $url):string
        {
            $domain = str_replace("/","\\/", getSiteConfig()["domain"]);
            $domain = str_replace(".","\\.", $domain);
            $pattern = '/https?:\/\/'.$domain.'\//i';
            echo $url;
            echo "\n\n";
            echo $pattern;
            return preg_replace($pattern, "", $url);
        }

        private function uploadImage(&$image, string $name, string $alt)
        {
            require_once 'app/dependencies/imgUploader/ImgUploader.class.php';
            $imgUploader = new ImgUploader();
            return $imgUploader->uploadImage($image, true, $name, $alt);
        }

        private function validateInputString(string $text)
        {
            return $text;
        }

		public function render(bool $useCache = true){
            $siteConfig = getSiteConfig();
			if ($this->request->getMethod() == "GET") {
                if($this->userControl->isLogued()){
                    //$this->arguments["postURL"] = $this->request->getScheme().'://'.$this->request->getPath();
                    $this->arguments["myDomain"] = $siteConfig["domain"];
                    $this->arguments["postURL"] = $siteConfig["urlAddPost"];
                    $this->arguments["uploadImageURL"] = $siteConfig["urlUploadImage"];
                    var_dump($this->userControl->getUser()->getAmazonAffiliateTag()); 
                    //$this->arguments["amazonAffiliateTag"] = isset($this->userControl->getUser()->getAmazonAffiliateTag()) ? $this->userControl->getUser()->getAmazonAffiliateTag() : $siteConfig["amazonAffiliateTag"];
                    //$this->arguments["amazonAffiliateTag"] = "fas";
                    $this->arguments["userLoged"] = isset($this->userControl) ? $this->userControl->isLogued() : false;
                    
                    $this->useCache = true;
                    $this->addInclude("coment", "includes/coment.html");
                    $this->addInclude("emojis", "includes/emojis.html");
                    $this->addInclude("smartphone", "includes/smartphone.html");
                    $this->addInclude("imageUpload", "includes/imageUpload.html");
				    return parent::render();
                }else{
                    return parent::notFound();
                }
			}else{
                if($this->origenAllowed() && $this->userLoguedOrBlock()){
                    //var_dump($this->userControl->isLogued());
                    $result["result"] = false;
                    $result["errores"] = [];

                    $mongo = DataBaseFactory::getDataBase("mongo")->getConnection();
                    $data = json_decode($this->request->getParam("json", false), true);
                    date_default_timezone_set('UTC');
                    $data["creationDate"] = ["milliseconds" => new MongoDB\BSON\UTCDateTime, "readable" => date(DateTimeInterface::ATOM)];
                    $data["link"] = $this->normalizeUrl($data["link"]);
                    $data["imagePost"] = $this->uploadImage($_FILES["postImage"], $this->validateInputString($data["imagePost"]["imagePostName"]), $this->validateInputString($data["imagePost"]["imagePostAlt"]));
                    $data["user"] = new MongoDB\BSON\ObjectId($this->userControl->getUserID());

                    //var_dump($data);
                    //We add de products if it would have
                    if(isset($data["products"])  && is_array($data["products"]) && count($data["products"]) > 0){
                        $collection = $mongo->selectCollection($data["productsKind"]);
                        $insertManyResult = $collection->insertMany($data["products"]);
                        $data["products"] = [];

                        foreach ($insertManyResult->getInsertedIds() as $productId) {
                            $data["products"][] = ['id' => $productId, 'ref' => $data["productsKind"], 'db' => $collection->getDatabaseName()];
                        }
                    }
                    //var_dump($data);
                    $collection = $mongo->selectCollection("posts");
                    $collection->insertOne($data);
                    
                    //echo json_encode($data);
                    
                    $this->updateSitemap();
                    $this->updateFeed();

                    $result["result"] = true;

                    return parent::renderJson($result);
                }
			}
			//return parent::render();
		}

		private function updateFeed(){
            //header('Content-Type: application/rss+xml; charset=utf-8');
            $siteConfig 	= parse_ini_file("./app/config/dataSite.config.php");
            $lastBuildDate = date(DATE_RFC2822);
            $rssfeed = <<<EOT
            <?xml version="1.0" encoding="UTF-8"?><rss version="2.0"
            xmlns:content="http://purl.org/rss/1.0/modules/content/"
            xmlns:wfw="http://wellformedweb.org/CommentAPI/"
            xmlns:dc="http://purl.org/dc/elements/1.1/"
            xmlns:atom="http://www.w3.org/2005/Atom"
            xmlns:sy="http://purl.org/rss/1.0/modules/syndication/"
            xmlns:slash="http://purl.org/rss/1.0/modules/slash/">
                <channel>
                    <title>{$siteConfig["siteName"]}</title>
                    <atom:link href="{$siteConfig["urlFeed"]}" rel="self" type="application/rss+xml" />
                    <link>{$siteConfig["urlIndex"]}</link>
                    <description>{$siteConfig["siteDescription"]}</description>
                    <lastBuildDate>{$lastBuildDate}</lastBuildDate>
                    <language>{$siteConfig["language"]}</language>
                    <sy:updatePeriod>hourly</sy:updatePeriod>
                    <sy:updateFrequency>1</sy:updateFrequency>
            EOT;
            $rssfeed .= PHP_EOL;

            $mongo = DataBaseFactory::getDataBase("mongo")->getConnection();
            $collection = $mongo->selectCollection("posts");
            $posts = $collection->find()->toArray();

            foreach ($posts as $post ) {
                $rssfeed .= <<<ITEM
                        <item>
                            <title>{$post["title"]}</title>
                            <link>{$siteConfig["urlIndex"]}{$post["link"]}</link>
                            <pubDate>{$post["creationDate"]["readable"]}</pubDate>
                            <description>{$post["metaDescription"]}</description>
                        </item>
                ITEM;
                $rssfeed .= PHP_EOL;
            }
            /*
            <item>
		<title>Timalí ojigualdo</title>
		<link>https://avesexoticas.org/silvidos/timali-ojigualdo/</link>
				<comments>https://avesexoticas.org/silvidos/timali-ojigualdo/#respond</comments>
				<pubDate>Thu, 26 Dec 2019 15:04:59 +0000</pubDate>
		<dc:creator><![CDATA[Noel]]></dc:creator>
				<category><![CDATA[Silvidos]]></category>
		<category><![CDATA[Timalies]]></category>
		<category><![CDATA[Asia]]></category>
		<category><![CDATA[multicolor]]></category>

		<guid isPermaLink="false">https://avesexoticas.org/?p=5380</guid>
				<description><![CDATA[<p>&#191;Listo para aprender algo nuevo sobre una especie que desconoc&#237;as? &#161;Hoy hablaremos <a class="entry-read-more" href="https://avesexoticas.org/silvidos/timali-ojigualdo/"></a></p>
<p>La entrada <a rel="nofollow" href="https://avesexoticas.org/silvidos/timali-ojigualdo/">Timalí ojigualdo</a> se publicó primero en <a rel="nofollow" href="https://avesexoticas.org">Aves Ex&oacute;ticas</a>.</p>
]]></description>
						<wfw:commentRss>https://avesexoticas.org/silvidos/timali-ojigualdo/feed/</wfw:commentRss>
		<slash:comments>0</slash:comments>
							</item>
            */

            /*while($row = mysql_fetch_array($result)) {
                extract($row);
        
                $rssfeed .= '<item>';
                $rssfeed .= '<title>' . $title . '</title>';
                $rssfeed .= '<description>' . $description . '</description>';
                $rssfeed .= '<link>' . $link . '</link>';
                $rssfeed .= '<pubDate>' . date("D, d M Y H:i:s O", strtotime($date)) . '</pubDate>';
                $rssfeed .= '</item>';
            }
        */
            $rssfeed .= "    </channel>".PHP_EOL;
            $rssfeed .= "</rss>";
            file_put_contents($siteConfig["urlFeed"].".xml", $rssfeed);
            //echo $rssfeed;
		}
		private function updateSitemap(){
            require_once 'app/dependencies/SitemapGenerator/SitemapGenerator.class.php';

			//header('Content-Type: application/rss+xml; charset=utf-8');
            $siteConfig = parse_ini_file("./app/config/dataSite.config.php");


            // Setting the current working directory to be output directory
            // for generated sitemaps (and, if needed, robots.txt)
            // The output directory setting is optional and provided for demonstration purpose.
            // By default output is written to current directory. 
            $outputDir = "public";

            $generator = new \Icamys\SitemapGenerator\SitemapGenerator($siteConfig["domain"], $outputDir);

            // will create also compressed (gzipped) sitemap
            $generator->toggleGZipFileCreation();

            // determine how many urls should be put into one file;
            // this feature is useful in case if you have too large urls
            // and your sitemap is out of allowed size (50Mb)
            // according to the standard protocol 50000 is maximum value (see http://www.sitemaps.org/protocol.html)
            $generator->setMaxURLsPerSitemap(50000);

            // sitemap file name
            $generator->setSitemapFileName("sitemap.xml");

            // sitemap index file name
            $generator->setSitemapIndexFileName("sitemap-index.xml");

            // alternate languages
            /*$alternates = [
                ['hreflang' => 'de', 'href' => "http://www.example.com/de"],
                ['hreflang' => 'fr', 'href' => "http://www.example.com/fr"],
            ];*/

            // adding url `loc`, `lastmodified`, `changefreq`, `priority`, `alternates`
            //$generator->addURL('http://example.com/url/path/', new DateTime(), 'always', 0.5, $alternates);
            //$generator->addURL($siteConfig["urlIndex"].$siteConfig["domain"], new DateTime(), 'always', 1);
            $generator->addURL("/", new DateTime(), 'always', 1);
            $generator->addURL("/".$siteConfig["urlFeed"], new DateTime(), 'always', 1);

            $mongo = DataBaseFactory::getDataBase("mongo")->getConnection();
            $collection = $mongo->selectCollection("posts");
            $posts = $collection->find()->toArray();

            foreach ($posts as $post ) {
                $generator->addURL("/".$post["link"], new DateTime(), 'always', 0.5);
            }

            // generate internally a sitemap
            $generator->createSitemap();

            // write early generated sitemap to file(s)
            $generator->writeSitemap();

            // update robots.txt file in output directory or create a new one
            $generator->updateRobots();

            // submit your sitemaps to Google, Yahoo, Bing and Ask.com
            //$generator->submitSitemap();
		}

	}

 ?>