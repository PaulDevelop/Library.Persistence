<?php

namespace Com\PaulDevelop\Library\Persistence;

use Com\PaulDevelop\Library\Common\GenericCollection;

/**
 * IEntityCollection
 *
 * @package  Com\PaulDevelop\Library\Persistence
 * @category Application
 * @author   Rüdiger Scheumann <code@pauldevelop.com>
 * @license  http://opensource.org/licenses/MIT MIT
 */
class IEntityCollection extends GenericCollection
{
    /**
     * @param array  $initialValues
     * @param string $keyFieldName
     *
     * @throws \Exception
     */
    public function __construct($initialValues = array(), $keyFieldName = '')
    {
        parent::__construct('Com\PaulDevelop\Library\Persistence\IEntity', $initialValues, $keyFieldName);
    }
}
