<?php

namespace Com\PaulDevelop\Library\Persistence;

use Com\PaulDevelop\Library\Common\Base;

/**
 * Property
 *
 * @package Com\PaulDevelop\Library\Persistence
 * @category Application
 * @author   Rüdiger Scheumann <code@pauldevelop.com>
 * @license  http://opensource.org/licenses/MIT MIT
 *
 * @property string $Name
 * @property string $Value
 */
class Property extends Base implements IProperty
{
    private $name;
    private $value;

    public function __construct($name = '', $value = '')
    {
        $this->name = $name;
        $this->value = $value;
    }

    protected function setName($name = '')
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    protected function setValue($value = '')
    {
        $this->value = $value;
    }

    public function getValue()
    {
        return $this->value;
    }
}
