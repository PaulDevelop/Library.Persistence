<?php

namespace Com\PaulDevelop\Library\Persistance;

use \Com\PaulDevelop\Library\Common\Base;
use \Com\PaulDevelop\Library\Modeling\Entities\IEntity;
use \Com\PaulDevelop\Library\Modeling\Entities\IProperty;
use \Com\PaulDevelop\Library\Modeling\Entities\PropertyCollection;

/**
 * Entity
 *
 * @package  Com\PaulDevelop\Library\Persistance
 * @category Persistance
 * @author   Rüdiger Scheumann <code@pauldevelop.com>
 * @license  http://opensource.org/licenses/MIT MIT
 */
class Entity extends Base implements IEntity
{
    #region member
    /**
     * Namespace.
     *
     * @var string
     */
    private $namespace;
    /**
     * Name.
     *
     * @var string
     */
    private $name;
    /**
     * Properties.
     *
     * @var PropertyCollection
     */
    private $properties;
    #endregion

    #region constructor
    /**
     * Constructor.
     *
     * @param string                                                        $namespace
     * @param string                                                        $name
     * @param \Com\PaulDevelop\Library\Modeling\Entities\PropertyCollection $properties
     *
     * @return Entity
     */
    public function __construct($namespace = '', $name = '', $properties = null)
    {
        $this->namespace = $namespace;
        $this->name = $name;
        $this->properties = $properties;
        if ($this->properties == null) {
            $this->properties = new PropertyCollection();
        }
    }
    #endregion

    #region methods
    /**
     * HasProperty.
     *
     * @param string $propertyName
     *
     * @return boolean
     */
    public function hasProperty($propertyName)
    {
        //     --- init ---
        $result = false;

        // --- action ---
        foreach ($this->properties as $property) {
            if ($property->Name == $propertyName) {
                $result = true;
                break;
            }
        }

        // --- return ---
        return $result;
    }

    /**
     * Get property.
     *
     * @param string $propertyName
     *
     * @return IProperty
     */
    public function getProperty($propertyName)
    {
        //     --- init ---
        $result = null;

        // --- action ---
        foreach ($this->properties as $property) {
            if ($property->Name == $propertyName) {
                $result = $property;
                break;
            }
        }

        // --- return ---
        return $result;
    }
    #endregion

    #region properties
    /**
     * Name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get namespace.
     */
    public function getNamespace()
    {
        return $this->namespace;
    }

    /**
     * Properties.
     *
     * @return PropertyCollection
     */
    public function getProperties()
    {
        return $this->properties;
    }

    /**
     * Properties.
     *
     * @param PropertyCollection $value
     */
    public function setProperties($value = null)
    {
        $this->properties = $value;
    }

//    /**
//     * Extends
//     *
//     * @return IEntity
//     */
//    public function getExtends()
//    {
//        return $this->_extends;
//    }
//
//    /**
//     * Extends.
//     *
//     * @param IEntity $value
//     */
//    public function setExtends($value = null)
//    {
//        $this->_extends = $value;
//    }
    #endregion
}
