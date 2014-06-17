<?php

namespace Com\PaulDevelop\Library\Persistence;

use Com\PaulDevelop\Library\Common\GenericCollection;

class IEntityCollection extends GenericCollection
{
    public function __construct()
    {
        parent::__construct('Com\PaulDevelop\Library\Persistence\IEntity');
    }
}
