<?php namespace Oliverpool\Config;

use Oliverpool\Config\Storage\JsonFile;
use Illuminate\Config\Repository as IlluminateConfig;

class Helper
{
    public static function jsonIlluminateConfig($filename)
    {
        $jf = new JsonFile($filename);
        return new Stored($jf, new IlluminateConfig($jf->load() ?? []));
    }

    public static function jsonShadowedIlluminateConfig($filename, $initial)
    {
        $jsonConf = static::jsonIlluminateConfig($filename);
        return new Shadowed($jsonConf, new IlluminateConfig($initial));
    }
}
