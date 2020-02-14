<?php 
	require_once 'app/controllers/tools/Request.class.php';
	
/**
 * 
 */
final class ControllerFactory
{
	private static $pathLevel = 2; 

	private function __construct(){}

	public static function createController()
	{	
		$request = new Request(); 
		//echo $request->getPath();
		switch ($request->getNextElement()) {
			case '':
			case 'index':
				require_once 'app/controllers/Index.class.php';
				return new Index($request); 
				break;
			case 'login':
				require_once 'app/controllers/Login.class.php';
				return new Login($request); 
				break;
			/*case 'addpost':
				require_once 'app/controllers/AddPost.class.php';
				return new AddPost($request); 
				break;
			case 'uploadimage':
				require_once 'app/controllers/UploadImage.class.php';
				return new UploadImage($request); 
				break;
			case 'feed':
				require_once 'app/controllers/Feed.class.php';
				return new Feed(); 
				break;
			case 'sitemap':
				require_once 'app/controllers/Sitemap.class.php';
				return new Sitemap(); 
				break;*/
			case 'logueduser':
				require_once 'app/controllers/tools/UserControl.class.php';
				$userControl = new UserControl();
				// We check if the user is logged
				if($userControl->isLogued()){
					switch ($request->getNextElement()) {
						case 'addpost':
							require_once 'app/controllers/AddPost.class.php';
							return new AddPost($request, $userControl); 
							break;
						case 'userposts':
							require_once 'app/controllers/UserPosts.class.php';
							return new UserPosts($request, $userControl); 
							break;
						case 'uploadimage':
							require_once 'app/controllers/UploadImage.class.php';
							return new UploadImage($request, $userControl); 
							break;
						case 'admin':
							if ($userControl->isAdmin()) {
								switch ($request->getNextElement()) {
									case 'adminusers':
										require_once 'app/controllers/admin/AdminUsers.class.php';
										return new AdminUsers($request, $userControl); 
										break;
									default:
									/* New Admin Page */
										require_once 'app/controllers/Index.class.php';
										return new Index($request); 
										break;
								}
							}else{
								require_once 'app/controllers/Index.class.php';
								return new Index($request); 
								break;
							}
							
						default:
							require_once 'app/controllers/Index.class.php';
							return new Index($request); 
							break;
					}
				}else{
					//if is not logged, we remove the cookie to try enter in a logged area. 
					$userControl->logout();
					require_once 'app/controllers/Index.class.php';
					return new Index($request); 
				}
				break;
			default:
				require_once 'app/controllers/Post.class.php';
				return new Post($request);
				break;
		}
	}

	/*private static function getNextNameLevel($path){
		if($path[self::$pathLevel] === ""){
			return "";
		}else{
			$re = '/\w+(?=\??)/m';
			preg_match_all($re, $path[self::$pathLevel], $matches, PREG_SET_ORDER, 0);
			//var_dump($matches);
			self::$pathLevel++;
			return $matches[0][0];
		}
		
	}*/
}


?>