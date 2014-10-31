<?php

class UsersControllerTests extends CIUnit_TestCase{

    public $CI;

    public function setUp(){
        $this->CI = set_controller('users');
    }

    public function testIndexControllerMethod(){
        $this->CI->index();
        $out = output();
        $this->assertNotEmpty($out);
    }

}