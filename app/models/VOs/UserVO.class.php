<?php
    require_once 'app/dependencies/vendor/autoload.php';
    require_once 'app/models/VOs/tools/ValueObject.class.php';

class UserVO extends ValueObject implements MongoDB\BSON\Persistable
{
    private $id;
    private $user;
    private $hash;
    private $amazonAffiliateTag; 
    private $role; 

    public function __construct(string $user, string $pass, string $role, string $amazonAffiliateTag = "" )
    {   
        $this->id = new MongoDB\BSON\ObjectId;
        $this->user = (string) $user;
        $this->hash = self::generateHash($pass);
        $this->amazonAffiliateTag = (string) $amazonAffiliateTag;
        $this->role = $role;
        //$this->__pclass = new BSON\Binary(get_class($this), BSON\Binary::TYPE_USER_DEFINED);

    }

    function bsonSerialize()
    {
        if($this->id){
            return [
                '_id' => $this->id,
                'user' => $this->user,
                'hash' => $this->hash,
                'amazonAffiliateTag' => $this->amazonAffiliateTag,
                'role' => $this->role,
            ];
        }else{
            return [
                'user' => $this->user,
                'hash' => $this->hash,
                'amazonAffiliateTag' => $this->amazonAffiliateTag,
                'role' => $this->role,
            ];
        }
        
    }
    public function getId():string
    {
        return $this->id; 
    }

    public function getRole():string
    {
        return $this->role; 
    }

    public function getAmazonAffiliateTag():string
    {
        return $this->amazonAffiliateTag; 
    }

    function bsonUnserialize($data)
    {
        $this->id = $data['_id'];
        $this->user = $data['user'];
        if(isset($data['hash'])){
            $this->hash = $data['hash'];
        }else if (isset($data['pass'])) {
            $this->hash = self::generateHash($data['pass']);
        }
        $this->amazonAffiliateTag = $data['amazonAffiliateTag'];
        $this->role = $data['role'];
    }

    public static function validateUserAndPass(string $user, string $pass): bool
    {
        require_once 'app/models/tools/DataBaseFactory.class.php';
        $userCollection = DataBaseFactory::getDataBase("mongo")->getConnection("users");
        $dataUser = $userCollection->findOne(["user" => $user]);
            //$dataUser = $userCollection->findOne();
            
        //var_dump($dataUser);
        //password_verify ($pass, $hash); 
        return ($dataUser != null && true );

    }

    public function validatePass(string $pass): bool
    {
        return password_verify($pass, $this->hash);
    }

    public static function generateHash(string $pass, int $cost = 10):string
    {
        return password_hash($pass, PASSWORD_DEFAULT, ["cost" => $cost]); 
    }
    /*private function createUser(string $user, string $pass):void
    {
        $userCollection = DataBaseFactory::getDataBase("mongo")->getConnection("users");
        $coste = 10;
        $userCollection->insertOne(["user" => $user, "hash" => password_hash($pass, PASSWORD_DEFAULT, ["cost" => $coste])]);
    }*/
}

?>