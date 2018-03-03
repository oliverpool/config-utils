<?php namespace Oliverpool\Config\Tests;

use Oliverpool\Config\Stored;
use Oliverpool\Config\Factory;
use Oliverpool\Config\Storage\JsonFile;

class StoredTest extends Basetest
{
    public function testGets()
    {
        $file = tempnam(sys_get_temp_dir(), 'config.json');
        $content = ['test' => rand()];

        $store = new Stored(new JsonFile($file), new Factory());
        $this->assertEquals([], $store->all());
        $store->set('test', 42);
        $this->assertEquals(42, $store->get('test'));
        $this->assertEquals(42, $store->get('test', 404));
        $this->assertEquals(404, $store->get('not_found', 404));
        unlink($file);
    }

    public function testSets()
    {
        $file = tempnam(sys_get_temp_dir(), 'config.json');
        $content = ['test' => rand()];

        $jFile = new JsonFile($file);

        $store = new Stored($jFile, new Factory());
        $store->set('test', 42);

        $store2 = new Stored($jFile, new Factory());
        $this->assertEquals(42, $store2->get('test'));


        // the config is not read again from disk
        $store->set('test', 43);
        $this->assertEquals(42, $store2->get('test'));

        // the whole config is written
        $store2->set('found', 200);
        $store3 = new Stored($jFile, new Factory());
        $this->assertEquals(42, $store2->get('test'));
        $this->assertEquals(200, $store2->get('found'));
        // and store1 didn't see it
        $this->assertEquals(43, $store->get('test'));
        unlink($file);
    }
}
