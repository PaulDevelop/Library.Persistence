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
     * @return IEntity
     */
    public function querySinglePath($path = '');

    /**
     * @param string $path
     *
     * @return int
     */
    public function queryCount($path = '');

    /**
     * @param string $keyword
     * @param string $path
     *
     * @return IEntityCollection
     */
    public function searchPath($keyword = '', $path = '');

    /**
     * @param string $keyword
     * @param string $path
     *
     * @return int
     */
    public function searchCount($keyword = '', $path = '');

    /**
     * @param string $path
     */
    public function removePath($path = '');
}
