<?php
namespace Entity;

/**
 * @Entity
 * @Table (name="bugs")
 */
class Bug {

    /**
     * @Id
     * @Column(type="integer")
     * @GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @Column(type="string", length=100, nullable=false)
     */
    protected $title;

    /**
     * @Column(type="text", nullable=false)
     */
    protected $description;

    /**
     * @ManyToOne(targetEntity="User")
     * @JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user;

    /**
     * @ManyToOne(targetEntity="Status")
     * @JoinColumn(name="status_id", referencedColumnName="id")
     */
    protected $status;

    public function setId($id){
        $this->id = $id;
    }

    public function setDescription($description){
        $this->description = $description;
    }

    public function setTitle($title){
        $this->title = $title;
    }

    public function setUser($user){
        $this->user = $user;
    }

    public function setStatus($status){
        $this->status = $status;
    }

    public function displayInfo($fieldName){
        $values = array(
            'id'=>$this->id,
            'title'=>$this->title,
            'description'=>$this->description,
            'user'=>$this->user,
            'status'=>$this->status
        );
        return $values[$fieldName];
    }

    public static function toArray($bugs){
        $bugs_array = array();
        foreach($bugs as $bug){
           array_push($bugs_array, array(
               'id'=>$bug->displayInfo('id'),
               'title'=>$bug->displayInfo('title'),
               'description'=>$bug->displayInfo('description'),
               'user'=>$bug->displayInfo('user')->displayInfo('id'),
               'status'=>Status::toArray($bug->status)
           ));
        }
        return $bugs_array;
    }

    public static function toJson($bugs){
        return json_encode(Bug::toArray($bugs));
    }

    public static function serialize($bugs){
        $bug_array = array();
        foreach($bugs as $bug){
            array_push($bug_array, array(
                $bug->id=>$bug->title
            ));
        }
        return $bug_array;
    }

}