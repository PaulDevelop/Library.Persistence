<?php

namespace Com\PaulDevelop\Library\Persistence;

/**
 * IProperty
 *
 * @package Com\PaulDevelop\Library\Persistence
 * @category Application
 * @author   Rüdiger Scheumann <code@pauldevelop.com>
 * @license  http://opensource.org/licenses/MIT MIT
 */
interface IProperty
{
    /**
     * @return string
     */
    public function getName();

    /**
     * @return string
     */
    public function getValue();
}
