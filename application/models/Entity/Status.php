<?php
namespace Entity;

/**
 * @Entity
 * @Table(name="status")
 */
class Status {

    /**
     * @Id
     * @Column(type="integer")
     * @GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @Column(type="string", length=10, nullable=false)
     */
    protected $name;

    public function setId($id){
        $this->id = $id;
    }

    public function setName($name){
        $this->name = $name;
    }

    public function displayInfo($fieldName){
        $values = array(
            'id'=>$this->id,
            'name'=>$this->name
        );
        return $values[$fieldName];
    }

    public static function toArray($status){
        return array(
            'id'=>$status->displayInfo('id'),
            'name'=>$status->displayInfo('name')
        );
    }

    public static function toJson($_status){
        return json_encode(Status::toArray($_status));
    }

    public static function serialize($statuses){
        $status_array = array();
        foreach($statuses as $status){
            array_push($status_array, array(
                $status->id=>$status->name
            ));
        }
        return $status_array;
    }

}