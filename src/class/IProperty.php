<?php

namespace Com\PaulDevelop\Library\Persistence;

interface IProperty
{
    /**
     * @return string
     */
    public function getName();

    /**
     * @return string
     */
    public function getValue();
}
