<?php namespace Oliverpool\Config;

use Illuminate\Contracts\Config\Repository as ConfigContract;

/**
*  Config Factory interface
*
*  @author oliverpool
*/
interface IFactory
{
    public function make($items) : ConfigContract;
}
