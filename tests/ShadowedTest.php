<?php namespace Oliverpool\Config\Tests;

use Oliverpool\Config\Shadowed;
use Oliverpool\Config\Factory;

class ShadowedTest extends Basetest
{
    public function testBasicShadow()
    {
        $f = new Factory();
        $primary = $f->make(['p' => 1]);
        $secondary = $f->make(['s' => 2]);

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
        $f = new Factory();
        $primary = $f->make(['a' => 1, 'c' => 'primary']);
        $secondary = $f->make(['b' => 2, 'c' => 'secondary']);

        $shadowed = new Shadowed($primary, $secondary);
        $this->assertEquals(['a' => 1, 'b' => 2, 'c' => 'primary'], $shadowed->all());
    }

    public function testRecursiveDeepMerge()
    {
        $f = new Factory();
        $primary = $f->make(['a' => 1, 'c' => ['a' => 10, 'c' => 30]]);
        $secondary = $f->make(['b' => 2, 'c' => ['b' => 20, 'c' => 40]]);

        $shadowed = new Shadowed($primary, $secondary);
        $this->assertEquals(['a' => 1, 'b' => 2, 'c' => ['a' => 10, 'c' => 30, 'b' => 20]], $shadowed->all());
    }
}
