<?php

namespace Com\PaulDevelop\Library\Persistence;

/**
 * IPathQueryable
 *
 * @package  Com\PaulDevelop\Library\Persistence
 * @category Application
 * @author   Rüdiger Scheumann <code@pauldevelop.com>
 * @license  http://opensource.org/licenses/MIT MIT
 */
interface IPathQueryable
{
    /**
     * @param string $path
     *
     * @return IEntityCollection
     */
    public function queryPath($path = '');

    /**
     * @param string $path
     *
     * @return int
     */
    public function queryCount($path = '');

    /**
     * @param string $path
     *
     * @return IEntityCollection
     */
    public function searchPath($path = '');

    /**
     * @param string $path
     *
     * @return int
     */
    public function searchCount($path = '');
}
