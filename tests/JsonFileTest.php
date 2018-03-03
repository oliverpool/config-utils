<?php namespace Oliverpool\Config\Tests;

use Oliverpool\Config\Storage\JsonFile;

class JsonFileTest extends Basetest
{
    public function testIsThereAnySyntaxError()
    {
        $var = new JsonFile("");
        $this->assertTrue(is_object($var));
        unset($var);
    }

    public function testStoreAndLoad()
    {
        $file = tempnam(sys_get_temp_dir(), 'config.json');
        $content = ['test' => rand()];

        $store = new JsonFile($file);
        $store->store($content);
        $written = $store->load();
        $this->assertEquals($content, $written);
        unlink($file);
    }

    public function testStoreAndLoadFromAnotherInstance()
    {
        $file = tempnam(sys_get_temp_dir(), 'config.json');

        $store = new JsonFile($file);
        $content = ['test' => rand()];
        $store->store($content);

        $store2 = new JsonFile($file);
        $written = $store2->load();
        $this->assertEquals($content, $written);
        unlink($file);
    }

    public function testLoadNonExistentFile()
    {
        $file = tempnam(sys_get_temp_dir(), 'config.json');
        unlink($file);

        $store = new JsonFile($file);
        $this->assertNull($store->load());
        $store->store(42);
        $this->assertEquals($store->load(), 42);

        unlink($file);
        $this->assertNull($store->load());
    }
}
