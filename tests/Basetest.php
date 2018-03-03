<?php namespace Oliverpool\Config\Tests;

class Basetest extends \PHPUnit_Framework_TestCase
{
    protected function debug($var)
    {
        fwrite(STDERR, print_r($var, true));
    }
}
