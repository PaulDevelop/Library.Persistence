<?php

namespace Com\PaulDevelop\Library\Persistence\PathQuery;

use Com\PaulDevelop\Library\Common\GenericCollection;

/**
 * FilterCollection
 *
 * @package  Com\PaulDevelop\Library\Persistence
 * @category Application
 * @author   Rüdiger Scheumann <code@pauldevelop.com>
 * @license  http://opensource.org/licenses/MIT MIT
 */
class FilterCollection extends GenericCollection
{
    #region constructor
    public function __construct()
    {
        parent::__construct('\Com\PaulDevelop\Library\Persistence\PathQuery\Filter');
    }
    #endregion
}
