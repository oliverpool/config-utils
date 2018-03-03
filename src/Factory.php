<?php namespace Oliverpool\Config;

use Illuminate\Config\Repository;
use Illuminate\Contracts\Config\Repository as ConfigContract;

/**
*  Config Factory interface
*
*  @author oliverpool
*/
class Factory implements IFactory
{
    public function make($items) : ConfigContract
    {
        return new Repository($items);
    }
}
