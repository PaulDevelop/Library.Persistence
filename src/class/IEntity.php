<?php

namespace Com\PaulDevelop\Library\Persistence;

/**
 * IEntity
 *
 * @package Com\PaulDevelop\Library\Persistence
 * @category Application
 * @author   Rüdiger Scheumann <code@pauldevelop.com>
 * @license  http://opensource.org/licenses/MIT MIT
 */
interface IEntity extends \arrayaccess
{
    /**
     * @return string
     */
    public function getKey();

    /**
     * @return IPropertyCollection
     */
    public function getProperties();
}
