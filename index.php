<?php

class DepedencyInjector implements ArrayAccess
{

    protected $container = [];

    public function __construct()
    {

    }

    public function registerService($service, callable $callable)
    {
        $this->container[$service] = $callable;
    }

    public function getService($service)
    {
        if(!array_key_exists($service, $this->container)){
            throw new Exception("Error Processing Request", 1);
        }
        return $this->container[$service]($this);
    }

    public function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            $this->container[] = $value;
        } else {
            $this->container[$offset] = $value;
        }
    }

    public function offsetExists($offset)
    {
        return isset($this->container[$offset]);
    }

    public function offsetUnset($offset)
    {
        unset($this->container[$offset]);
    }

    public function offsetGet($offset)
    {
        return isset($this->container[$offset]) ? $this->container[$offset] : null;
    }

}

$DI = new \DepedencyInjector();

$DI->registerService('db', function($di){
    var_dump(['here' => $di]);
    $obj = new stdClass();
    $obj->name = 'DI_Database';
    return $obj;
});
echo '<pre>';
var_dump($DI->getService('db'));