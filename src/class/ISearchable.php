<?php

namespace Com\PaulDevelop\Library\Persistence;

use Com\PaulDevelop\Library\Persistence\Search\SortOrder;

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
     * @param string    $keyword
     *
     * @param int       $from
     * @param int       $count
     * @param Property  $orderBy
     * @param SortOrder $order
     *
     * @return IEntityCollection
     */
    public function search($keyword = '', $from = 0, $count = 0, Property $orderBy = null, SortOrder $order = null);
}
