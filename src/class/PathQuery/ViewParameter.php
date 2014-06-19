<?php

namespace Com\PaulDevelop\Library\Persistence\PathQuery;

/**
 * Order
 *
 * @package  Com\PaulDevelop\Library\Persistence
 * @category Application
 * @author   Rüdiger Scheumann <code@pauldevelop.com>
 * @license  http://opensource.org/licenses/MIT MIT
 *
 * @property int From
 * @property int Count
 * @property OrderCollection $OrderCollection
 */
class ViewParameter
{
    #region member
    /**
     * Dataset start number.
     *
     * @var int
     */
    private $from;
    /**
     * Number of datasets.
     *
     * @var int
     */
    private $count;
    /**
     * @var OrderCollection
     */
    private $orderCollection;
    #endregion

    #region constructor
    public function __construct($from = 0, $count = 0, OrderCollection $orderCollection = null)
    {
        $this->from = $from;
        $this->count = $count;
        $this->orderCollection = $orderCollection;
    }
    #endregion

    #region methods
    public static function factory($path = '')
    {
        // init
        $result = null;
        $from = 0;
        $count = 0;

        // action
        preg_match('/^([a-z0-9]+)(\[.*?\])?(?:\#(.*?))?$/i', $path, $matches);
        if ($matches[3] != '') {
            $chunks = preg_split('/,/', $matches[3]);
            foreach ($chunks as $chunk) {
                list($key, $value) = preg_split('/\-/', $chunk);
                if ($key == 'from') {
                    $from = (int)$value;
                } elseif ($key == 'count') {
                    $count = (int)$value;
                }
            }
        }
        $result = new ViewParameter(
            $from,
            $count,
            OrderCollection::factory($path)
        );

        // return
        return $result;
    }
    #endregion

    #region properties
    protected function getFrom()
    {
        return $this->from;
    }

    protected function getCount()
    {
        return $this->count;
    }

    protected function getOrderCollection()
    {
        return $this->orderCollection;
    }
    #endregion
}
