<?php
/**
 * Created by PhpStorm.
 * User: rscheumann
 * Date: 17/06/14
 * Time: 10:06
 */

namespace Com\PaulDevelop\Library\Persistence;

interface IPathQueryable {
    /**
     * @param string $path
     *
     * @return IEntityCollection
     */
    public function queryPath($path = '');
}
