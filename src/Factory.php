<?php namespace Oliverpool\Config;

use Illuminate\Contracts\Config\Repository as ConfigContract;

/**
*  Config Factory interface
*
*  @author oliverpool
*/
interface Factory
{
    public function make($items) : ConfigContract;
}
