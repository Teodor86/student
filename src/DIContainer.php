<?php

class DIContainer
{
    /** @var array */
    private $registered = [];

    /** @var array */
    private $services = [];

    /**
     * @param $name
     * @param callable $factory
     * @throws Exception
     */
    public function register($name, callable $factory)
    {
        if (!isset($this->registered[$name])) {
            $this->registered[$name] = $factory;
        } else {
            throw new Exception("Service {$name} already registered");
        }
    }

    /**
     * @param $name
     * @return mixed
     * @throws Exception
     */
    public function get($name)
    {
        if (!isset($this->registered[$name])) {
            throw new Exception("Unregistered service {$name}");
        } elseif (!isset($this->services[$name])) {
            $this->services[$name] = $this->registered[$name]($this);
        }
        return $this->services[$name];
    }
}