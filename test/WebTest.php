<?php

class WebTest extends PHPUnit_Extensions_Selenium2TestCase
{
    protected function setUp()
    {
        $this->setBrowser('firefox');
        $this->setBrowserUrl('http://www.google.co.jp/');
    }

    public function testTitle()
    {
        $this->url('http://www.google.co.jp/');
        $this->assertEquals('Google', $this->title());
    }
}
?>
