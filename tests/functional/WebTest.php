<?php

class WebTest extends PHPUnit_Extensions_Selenium2TestCase{

    protected function setUp(){
        $this->setBrowser('chrome');
        $this->setBrowserUrl('http://localhost:9515/index.php/users/');
    }

    public function testTitle(){
        $this->url('http://localhost:9515/index.php/users/');
        $this->assertEquals('Bug Tracker', $this->title());
    }

}