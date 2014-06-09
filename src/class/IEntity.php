<?php

namespace Com\PaulDevelop\Library\Persistence;

interface IEntity extends \arrayaccess
{
    /**
     * @return string
     */
    public function getKey();

    /**
     * @return IPropertyCollection
     */
    public function getProperties();
}
