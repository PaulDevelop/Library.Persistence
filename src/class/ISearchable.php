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
     * @param string   $keyword
     *
     * @param int      $from
     * @param int      $count
     * @param Property $orderBy
     * @param string   $order
     *
     * @return IEntityCollection
     */
    public function search($keyword = '', $from = 0, $count = 0, Property $orderBy = null, $order = '');
}
