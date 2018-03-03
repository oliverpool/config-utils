<?php namespace Oliverpool\Config;

/**
*  Storage interface
*
*  @author oliverpool
*/
interface Storage
{
    public function load();
    public function store($array);
}
