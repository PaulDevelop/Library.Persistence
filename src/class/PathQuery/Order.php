<?php

namespace Com\PaulDevelop\Library\Persistence\PathQuery;

use Com\PaulDevelop\Library\Common\Base;

/**
 * Order
 *
 * @package  Com\PaulDevelop\Library\Persistence
 * @category Application
 * @author   Rüdiger Scheumann <code@pauldevelop.com>
 * @license  http://opensource.org/licenses/MIT MIT
 *
 * @property string $Order
 * @property string $OrderBy
 */
class Order extends Base
{
    #region member
    /**
     * Order.
     *
     * @var string
     */
    private $order;
    /**
     * Order by.
     *
     * @var string
     */
    private $orderBy;
    #endregion

    #region constructor
    public function __construct($order = '', $orderBy = '')
    {
        $this->order = $order;
        $this->orderBy = $orderBy;
    }
    #endregion

    #region methods
    #endregion

    #region properties
    protected function getOrder()
    {
        return $this->order;
    }

    protected function getOrderBy()
    {
        return $this->orderBy;
    }
    #endregion
}
