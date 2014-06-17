<?php
/**
 * Created by PhpStorm.
 * User: rscheumann
 * Date: 17/06/14
 * Time: 10:06
 */

namespace Com\PaulDevelop\Library\Persistence;

/**
 * IPathQueryable
 *
 * @package Com\PaulDevelop\Library\Persistence
 * @category Application
 * @author   Rüdiger Scheumann <code@pauldevelop.com>
 * @license  http://opensource.org/licenses/MIT MIT
 */
interface IPathQueryable {
    /**
     * @param string $path
     *
     * @return IEntityCollection
     */
    public function queryPath($path = '');
}
