<?php namespace Oliverpool\Config\Tests;

use Oliverpool\Config\Shadowed;
use Oliverpool\Config\Stored;
use Oliverpool\Config\Helper;
use Oliverpool\Config\Storage\JsonFile;

use Illuminate\Config\Repository as IlluminateConfig;

class JsonShadowedTest extends Basetest
{
    public function testJsonShadow()
    {
        $file = tempnam(sys_get_temp_dir(), 'config.json');

        $shadowed = Helper::jsonShadowedIlluminateConfig($file, ['a' => 42]);
        $this->assertEquals(42, $shadowed->get('a'));
        $this->assertNull($shadowed->get('b'));
        $shadowed->set('a', 43);
        $this->assertEquals(43, $shadowed->get('a'));

        $jsonConf2 = Helper::jsonIlluminateConfig($file);
        $this->assertEquals(43, $jsonConf2->get('a'));
        unlink($file);
    }
}
