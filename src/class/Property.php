<?php

namespace Com\PaulDevelop\Library\Persistance;

use Com\PaulDevelop\Library\Common\Base;
use Com\PaulDevelop\Library\Modeling\Entities\IProperty;

/**
 * Property
 *
 * @package  Com\PaulDevelop\Library\Persistance
 * @category Persistance
 * @author   Rüdiger Scheumann <code@pauldevelop.com>
 * @license  http://opensource.org/licenses/MIT MIT
 *
 * @property string $Name
 * @property string $Type
 * @property string $Null
 * @property string $Key
 * @property string $Default
 * @property string $Extra
 * @property string $IsPrimaryKey
 * @property string $IsForeignKey
 */
class Property extends Base implements IProperty
{
    #region member
    /**
     * Name.
     *
     * @var string
     */
    private $name;
    /**
     * Type.
     *
     * @var string
     */
    private $type;
    /**
     * Null.
     *
     * @var boolean
     */
    private $null;
    /**
     * Key.
     *
     * @var string
     */
    private $key;
    /**
     * Default.
     *
     * @var string
     */
    private $default;
    /**
     * Extra.
     *
     * @var string
     */
    private $extra;
    #endregion

    #region constructor
    /**
     * Constructor.
     *
     * @param string $name
     * @param string $type
     * @param string $null
     * @param string $key
     * @param string $default
     * @param string $extra
     */
    public function __construct($name = '', $type = '', $null = '', $key = '', $default = '', $extra = '')
    {
        $this->name = $name;
        $this->type = $type;
        $this->null = $null;
        $this->key = $key;
        $this->default = $default;
        $this->extra = $extra;
    }
    #endregion

    #region methods
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
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string
     */
    public function setType($value = '')
    {
        $this->type = $value;
    }

    /**
     * @return string
     */
    public function getNull()
    {
        return $this->null;
    }

    /**
     * @param string $value
     */
    public function setNull($value = '')
    {
        $this->null = $value;
    }

//    /**
//     * @return boolean
//     */
//    public function getIsOptional()
//    {
//        return ($this->_optional != 'NO') ? true : false;
//    }

    /**
     * @return string
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * @param string $value
     */
    public function setKey($value = '')
    {
        $this->key = $value;
    }

    /**
     * @return boolean
     */
    public function getIsPrimaryKey()
    {
        return ($this->key == 'PRI') ? true : false;
    }

    /**
     * @return boolean
     */
    public function getIsForeignKey()
    {
        return ($this->key != '' && $this->key != 'PRI') ? true : false;
    }

    /**
     * @return string
     */
    public function getDefault()
    {
        return $this->default;
    }

    /**
     * @param string $value
     */
    public function setDefault($value = '')
    {
        $this->default = $value;
    }

    /**
     * @return string
     */
    public function getExtra()
    {
        return $this->extra;
    }

    /**
     * @param string $value
     */
    public function setExtra($value = '')
    {
        $this->extra = $value;
    }
    #endregion
}
