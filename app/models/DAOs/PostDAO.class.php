<?php 
	//require_once 'app/models/DAOs/tools/DataObjectPDO.class.php';
	require_once 'app/models/DAOs/tools/DataAccessObjectMongo.class.php';

	/**
	 * 
	 */
	class PostDAO extends DataAccessObjectMongo
	{
        public function __construct() {
            parent::__construct("posts");
            
            $this->defaultOptions = [ 'typeMap' => ['root' => 'array'], 
            "limit" => 10, 
            "batchSize" => 10];

        }


        
        /*public static function getDatabase()
        {   
            if(!isset(self::$collection)){
                require_once 'app/models/tools/DataBaseFactory.class.php';
                self::$collection = DataBaseFactory::getDataBase("mongo")->getConnection("users");
            };
            return self::$collection; 
            
        }
		public static function getUserById(string $id)
        {
            return self::getDatabase()->findOne(["_id" => new MongoDB\BSON\ObjectId("$id")], ['typeMap' => ['root' => 'array']]);
        }*/

        public function findByLink(string $link, array $typeMap = ['root' => 'array'])
        {
            return $this->collection->findOne(["_id" => new MongoDB\BSON\ObjectId("$id")], ['typeMap' => $typeMap]);
        }

        public function findByTitle(string $title, array $options = [])
        {
            return parent::find(["title" => new MongoDB\BSON\Regex($title, "i")], $options);
        }

        public function findByUserId(string $id, array $options = [])
        {
            /*$this->cursor = $this->collection->find(["user" => new MongoDB\BSON\ObjectId("$id")], $this->mergeOptions($options));
            //var_dump($this->collection->findOne(["user" => new MongoDB\BSON\ObjectId("$link")]));
            return array_values(iterator_to_array($this->cursor, false));*/
            return parent::find(["user" => new MongoDB\BSON\ObjectId("$id")], $options);
        }

        public function deleteByIdWithUserId(string $id, string $userId, array $options = [])
        {
            return parent::deleteOne(["_id" => new MongoDB\BSON\ObjectId("$id"), "user" => new MongoDB\BSON\ObjectId("$id")], $options); 
        }
        

	}


?>