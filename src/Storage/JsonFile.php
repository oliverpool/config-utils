<?php namespace Oliverpool\Config\Storage;

use Oliverpool\Config\Storage;

/**
*  Json file Storage
*
*  @author oliverpool
*/
class JsonFile implements Storage
{
    protected $filename;

    public function __construct($filename)
    {
        $this->filename = $filename;
    }

    public function load()
    {
        return json_decode(@file_get_contents($this->filename), true);
    }

    public function store($settings)
    {
        return file_put_contents($this->filename, json_encode($settings), LOCK_EX);
    }
}
