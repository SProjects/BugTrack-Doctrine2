<?php
namespace Entity;

use Doctrine\ORM\Mapping\Entity;

/**
 * @Entity
 * @Table (name="users")
 */
class User {

    /*
     * Strategies: AUTO, SEQUENCE(Not supported), TABLE(Has to be setup), IDENTITY, CUSTOM and NONE
     * */
    /**
     * @Id
     * @Column(type="integer")
     * @GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     *@Column(type="string", length=50, nullable=false)
     */
    protected $name;

    /**
     *@Column(type="string", length=32, unique=true, nullable=false)
     */
    protected $username;

    /**
     *@Column(type="string", length=64, nullable=false)
     */
    protected $password;

    /**
     *@Column(type="string", length=64, unique=true, nullable=false)
     */
    protected $email;

    /**
     * @OneToMany(targetEntity="Bug", mappedBy="user", cascade={"persist", "remove"})
     */
    protected $bugs;

    public function setEmail($email){
        $this->email = $email;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function setName($name){
        $this->name = $name;
    }

    public function setPassword($password){
        $this->password = $this->hashPassword($password);
    }

    public function setUsername($username){
        $this->username = $username;
    }

    public function setBugs($bugs){
        $this->bugs = $bugs;
    }

    public function displayInfo($fieldName){
        $values = array('id'=>$this->id,
                        'name'=>$this->name,
                        'username'=>$this->username,
                        'password'=>$this->password,
                        'email'=>$this->email,
                        'bugs'=>$this->bugs);
        return $values[$fieldName];
    }

    public static function fromArray($userArray = NULL){
        if($userArray == NULL)
            return FALSE;
        $user = new User;
        $user->setName($userArray['name']);
        $user->setEmail($userArray['email']);
        $user->setUsername($userArray['username']);
        $user->setPassword($userArray['password']);
        return $user;
    }

    public static function toArray($user){
        return array('id'=>$user->displayInfo('id'),
                    'name'=>$user->displayInfo('name'),
                    'username'=>$user->displayInfo('username'),
                    'password'=>$user->displayInfo('password'),
                    'email'=>$user->displayInfo('email'),
                    'bugs'=>Bug::toArray($user->bugs));
    }

    public static function toJson($user){
        return json_encode(User::toArray($user));
    }

    public static function serialize($users){
        $user_array = array();
        foreach($users as $user){
            array_push($user_array, array(
                $user->id=>$user->name
            ));
        }
        return $user_array;
    }

    private function hashPassword($_password){
        $hash_password = sha1(md5($_password.$this->username));
        return $hash_password;
    }

}