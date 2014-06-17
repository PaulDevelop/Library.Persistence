<?php

namespace Com\PaulDevelop\Library\Persistence;

use Com\PaulDevelop\Library\Common\Base;

/**
 * Entity
 *
 * @package Com\PaulDevelop\Library\Persistence
 * @category Application
 * @author   Rüdiger Scheumann <code@pauldevelop.com>
 * @license  http://opensource.org/licenses/MIT MIT
 *
 * @property string $Key
 * @property IPropertyCollection $Properties
 */
class Entity extends Base implements IEntity
{
    private $key;
    private $properties;

    public function __construct($key = '', IPropertyCollection $properties = null)
    {
        $this->key = $key;
        $this->properties = $properties;
    }

    protected function setKey($key = '')
    {
        $this->key = $key;
    }

    public function getKey()
    {
        return $this->key;
    }

    protected function setProperties(IPropertyCollection $properties = null)
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
