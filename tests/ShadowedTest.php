<?php namespace Oliverpool\Config\Tests;

use Oliverpool\Config\Shadowed;

use Illuminate\Config\Repository as IlluminateConfig;

class ShadowedTest extends Basetest
{
    public function testBasicShadow()
    {
        $primary = new IlluminateConfig(['p' => 1]);
        $secondary = new IlluminateConfig(['s' => 2]);

        $shadowed = new Shadowed($primary, $secondary);
        $this->assertEquals(1, $shadowed->get('p'));
        $this->assertEquals(2, $shadowed->get('s'));
        $this->assertNull($shadowed->get('t'));
        $this->assertEquals(3, $shadowed->get('t', 3));

        $shadowed->set('s', 3);
        $this->assertEquals(3, $shadowed->get('s'));
        $this->assertEquals(2, $secondary->get('s'));
    }

    public function testRecursiveSimpleMerge()
    {
        $primary = new IlluminateConfig(['a' => 1, 'c' => 'primary']);
        $secondary = new IlluminateConfig(['b' => 2, 'c' => 'secondary']);

        $shadowed = new Shadowed($primary, $secondary);
        $this->assertEquals(['a' => 1, 'b' => 2, 'c' => 'primary'], $shadowed->all());
    }

    public function testRecursiveDeepMerge()
    {
        $primary = new IlluminateConfig(['a' => 1, 'c' => ['a' => 10, 'c' => 30]]);
        $secondary = new IlluminateConfig(['b' => 2, 'c' => ['b' => 20, 'c' => 40]]);

        $shadowed = new Shadowed($primary, $secondary);
        $this->assertEquals(['a' => 1, 'b' => 2, 'c' => ['a' => 10, 'c' => 30, 'b' => 20]], $shadowed->all());
    }
}
