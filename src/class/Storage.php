<?php

namespace Com\PaulDevelop\Library\Persistence;

use Com\PaulDevelop\Library\Modeling\Entities\IModel;

/**
 * Storage
 *
 * @package  Com\PaulDevelop\Library\Persistence
 * @category Persistence
 * @author   Rüdiger Scheumann <code@pauldevelop.com>
 * @license  http://opensource.org/licenses/MIT MIT
 */
abstract class Storage
{
    #region methods
    /**
     * Factory function.
     *
     * @param string $dsn
     * @param IModel $model
     *
     * @return IStorage
     */
    public static function factory($dsn = '', IModel $model = null)
    {
        // init
        $result = null;

        // action
        $matches = array();

        // mysql
        preg_match(
            '/([a-z0-9]+)\:\/\/(?:([a-z0-9\_\-]+(?:\:[a-z0-9]+)?)\@)?([a-z0-9\.]+(?:\:[0-9]+)?)\/(.*?)$/i',
            $dsn,
            $matches
        );
        if (sizeof($matches) > 0 && $matches[1] == 'mysql') {
            $hostPortChunks = preg_split('/:/', $matches[3]);
            $host = $hostPortChunks[0];
            $port = $hostPortChunks[1];
            $userPassChunks = preg_split('/:/', $matches[2]);
            $user = $userPassChunks[0];
            $password = $userPassChunks[1];
            $database = $matches[4];
            $result = new Mysql($host, $port, $user, $password, $database, $model);
        }

        // sqlite
        preg_match('/([a-z0-9]+)\:\/\/(.*)(?:\/([a-z0-9\.]+))$/i', $dsn, $matches);
        if (sizeof($matches) > 0 && $matches[1] == 'sqlite') {
            $path = $matches[2];
            $filename = $matches[3];
            $result = new Sqlite($path, $filename);
        }

        // return
        return $result;
    }
    #endregion
}
