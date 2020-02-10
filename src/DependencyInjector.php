<?php

namespace Src;

/**
 */
class DependencyInjector implements \ArrayAccess
{
    /**
     * The container
     */
    protected $container = [];

    /**
     * Constructor
     */
    public function __construct()
    {

    }

    /**
     * register/insert a service
     */
    public function registerService($service, callable $callable)
    {
        $this->container[$service] = $callable;
    }

    /**
     */
    public function getService($service)
    {
        if(!array_key_exists($service, $this->container)){
            throw new Exception("Error Processing Request", 1);
        }
        return $this->container[$service]($this);
    }

    /**
     * Assigns a value to the specified offset
     *
     * @param string The offset to assign the value to
     * @param mixed  The value to set
     * @access public
     * @abstracting ArrayAccess
     */
    public function offsetSet($offset,$value) {
        if (is_null($offset)) {
            $this->data[] = $value;
        } else {
            $this->data[$offset] = $value;
        }
    }

    /**
     * Whether or not an offset exists
     *
     * @param string An offset to check for
     * @access public
     * @return boolean
     * @abstracting ArrayAccess
     */
    public function offsetExists($offset) {
        return isset($this->data[$offset]);
    }

    /**
     * Unsets an offset
     *
     * @param string The offset to unset
     * @access public
     * @abstracting ArrayAccess
     */
    public function offsetUnset($offset) {
        if ($this->offsetExists($offset)) {
            unset($this->data[$offset]);
        }
    }

    /**
     * Returns the value at specified offset
     *
     * @param string The offset to retrieve
     * @access public
     * @return mixed
     * @abstracting ArrayAccess
     */
    public function offsetGet($offset) {
        return $this->offsetExists($offset) ? $this->data[$offset] : null;
    }

}