<?php

namespace Com\PaulDevelop\Library\Persistence\PathQuery;

use Com\PaulDevelop\Library\Common\GenericCollection;

/**
 * OrderCollection
 *
 * @package  Com\PaulDevelop\Library\Persistence
 * @category Application
 * @author   Rüdiger Scheumann <code@pauldevelop.com>
 * @license  http://opensource.org/licenses/MIT MIT
 */
class OrderCollection extends GenericCollection
{
    #region constructor
    public function __construct()
    {
        parent::__construct('\Com\PaulDevelop\Library\Persistence\PathQuery\Order');
    }
    #endregion

    #region methods
    /**
     * @param string $path
     *
     * @return OrderCollection
     * @throws \Com\PaulDevelop\Library\Common\ArgumentException
     * @throws \Com\PaulDevelop\Library\Common\TypeCheckException
     */
    public static function factory($path = '')
    {
        // init
        $result = new OrderCollection();
        $order = '';
        $orderBy = '';

        // action
        preg_match('/^([a-z0-9]+)(\[.*?\])?(?:\#(.*?))?$/i', $path, $matches);
        if ($matches[3] != '') {
            $chunks = preg_split('/,/', $matches[3]);
            foreach ($chunks as $chunk) {
                list($key, $value) = preg_split('/\-/', $chunk);
                if ($key == 'order') {
                    if (strtolower($value) == strtolower(SortOrders::ASCENDING)) {
                        $order = SortOrders::ASCENDING;
                    } elseif (strtolower($value) == strtolower(SortOrders::DESCENDING)) {
                        $order = SortOrders::DESCENDING;
                    } else {
                        $order = $value;
                    }
                } elseif ($key == 'orderBy') {
                    $orderBy = $value;
                }

                if ($order != '' && $orderBy != '') {
                    $result->Add(
                        new Order($order, $orderBy)
                    );
                    $order = '';
                    $orderBy = '';
                }
            }
        }

        // return
        return $result;
    }
    #endregion
}
