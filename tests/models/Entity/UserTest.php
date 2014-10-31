<?php

class UserTest extends CIUnit_TestCase{

    private $user;

    public function __construct($name = NULL, array $data = array(), $dataName = ''){
        parent::__construct($name, $data, $dataName);
        $this->user = new Entity\User;
    }

    public function setUp(){
        parent::setUp();
        $this->user->setName("Sebuuma Daniel");
        $this->user->setUsername("admin");
        $this->user->setPassword("admin");
        $this->user->setEmail("sedzsoft@gmail.com");
    }

    public function testReturnsCorrectName(){
        $this->assertEquals("Sebuuma Daniel", $this->user->displayInfo('name'));
    }

    public function testReturnsCorrectEmail(){
        $this->assertEquals("sedzsoft@gmail.com", $this->user->displayInfo('email'));
    }

    public function tearDown(){
        parent::tearDown();
    }

}