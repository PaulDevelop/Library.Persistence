<?php

namespace Com\PaulDevelop\Library\Persistence;

use Com\PaulDevelop\Library\Common\GenericCollection;

/**
 * IPropertyCollection
 *
 * @package Com\PaulDevelop\Library\Persistence
 * @category Application
 * @author   Rüdiger Scheumann <code@pauldevelop.com>
 * @license  http://opensource.org/licenses/MIT MIT
 */
class IPropertyCollection extends GenericCollection
{
    public function __construct()
    {
        parent::__construct('Com\PaulDevelop\Library\Persistence\IProperty');
    }
}
