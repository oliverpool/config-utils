<?php namespace Oliverpool\Config;

use Illuminate\Contracts\Config\Repository as ConfigContract;

class Stored implements ConfigContract
{
    protected $storage;
    protected $config;

    public function __construct(Storage $storage, ConfigContract $initial)
    {
        $this->storage = $storage;
        $this->config = $initial; // usually loaded via $this->storage->load() ?? []
    }

    protected function store()
    {
        $this->storage->store($this->all());
    }

    /**
     * Determine if the given configuration value exists.
     *
     * @param  string  $key
     * @return bool
     */
    public function has($key)
    {
        return $this->config->has($key);
    }

    /**
     * Get the specified configuration value.
     *
     * @param  string  $key
     * @param  mixed   $default
     * @return mixed
     */
    public function get($key, $default = null)
    {
        return $this->config->get($key, $default);
    }

    /**
     * Get all of the configuration items for the application.
     *
     * @return array
     */
    public function all()
    {
        return $this->config->all();
    }

    /**
     * Set a given configuration value.
     *
     * @param  array|string  $key
     * @param  mixed   $value
     * @return void
     */
    public function set($key, $value = null)
    {
        $this->config->set($key, $value);
        $this->store();
    }

    /**
     * Prepend a value onto an array configuration value.
     *
     * @param  string  $key
     * @param  mixed  $value
     * @return void
     */
    public function prepend($key, $value)
    {
        $this->config->prepend($key, $value);
        $this->store();
    }

    /**
     * Push a value onto an array configuration value.
     *
     * @param  string  $key
     * @param  mixed  $value
     * @return void
     */
    public function push($key, $value)
    {
        $this->config->push($key, $value);
        $this->store();
    }
}
