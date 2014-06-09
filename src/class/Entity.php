<?php

namespace Com\PaulDevelop\Library\Persistence;

class Entity implements IEntity
{
    private $key;
    private $properties;

    public function __construct($key = '', IPropertyCollection $properties = null)
    {
        $this->key = $key;
        $this->properties = $properties;
    }

    public function setKey($key = '')
    {
        $this->key = $key;
    }

    public function getKey()
    {
        return $this->key;
    }

    public function setProperties(IPropertyCollection $properties = null)
    {
        $this->properties = $properties;
    }

    public function getProperties()
    {
        return $this->properties;
    }

    /**
     * @param mixed $offset
     * @param mixed $value
     */
    public function offsetSet($offset = null, $value = null)
    {
        $this->properties[$offset] = $value;
    }

    /**
     * @param mixed $offset
     *
     * @return bool
     */
    public function offsetExists($offset = null)
    {
        return isset($this->properties[$offset]);
    }

    /**
     * @param mixed $offset
     */
    public function offsetUnset($offset = null)
    {
        unset($this->properties[$offset]);
    }

    /**
     * @param mixed $offset
     *
     * @return mixed|null
     */
    public function offsetGet($offset = null)
    {
        return isset($this->properties[$offset]) ? $this->properties[$offset] : null;
    }
}
