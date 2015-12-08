<?php

namespace Com\PaulDevelop\Library\Persistence\PathQuery;

use Com\PaulDevelop\Library\Common\Base;

/**
 * Filter
 *
 * @package  Com\PaulDevelop\Library\Persistence
 * @category Application
 * @author   Rüdiger Scheumann <code@pauldevelop.com>
 * @license  http://opensource.org/licenses/MIT MIT
 *
 * @property string $PropertyName
 * @property string $Operator
 * @property string $Value
 * @property string $Composition
 * @property string $IsNull
 */
class Filter extends Base
{
    #region member
    /**
     * Property name.
     *
     * @var string
     */
    private $propertyName;
    /**
     * Operator.
     *
     * @var string
     */
    private $operator;
    /**
     * Value.
     *
     * @var string
     */
    private $value;
    /**
     * Composition.
     *
     * @var string
     */
    private $composition;
    /**
     * Is null.
     *
     * @var bool
     */
    private $isNull;
    #endregion

    #region constructor
    public function __construct($propertyName = '', $operator = '', $value = '', $composition = '', $isNull = false)
    {
        $this->propertyName = $propertyName;
        $this->operator = $operator;
        $this->value = $value;
        $this->composition = $composition;
        $this->isNull = $isNull;
    }
    #endregion

    #region methods
    #endregion

    #region properties
    protected function getPropertyName()
    {
        return $this->propertyName;
    }

    protected function getOperator()
    {
        return $this->operator;
    }

    protected function getValue()
    {
        return $this->value;
    }

    protected function getComposition()
    {
        return $this->composition;
    }

    protected function getIsNull()
    {
        return $this->isNull;
    }
    #endregion
}
