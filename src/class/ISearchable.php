<?php

namespace Com\PaulDevelop\Library\Persistence;

/**
 * ISearchable
 *
 * @package  Com\PaulDevelop\Library\Persistence
 * @category Application
 * @author   Rüdiger Scheumann <code@pauldevelop.com>
 * @license  http://opensource.org/licenses/MIT MIT
 */
interface ISearchable
{
    /**
     * @param string $keyword
     *
     * @return IEntityCollection
     */
    public function search($keyword = '');
}
