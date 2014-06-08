<?php

namespace Com\PaulDevelop\Library\Persistence;

use \Com\PaulDevelop\Library\Modeling\Entities\IEntity;
use \Com\PaulDevelop\Library\Modeling\Entities\EntityCollection;

/**
 * IStorage
 *
 * @package  Com\PaulDevelop\Library\Persistence
 * @category Persistence
 * @author   Rüdiger Scheumann <code@pauldevelop.com>
 * @license  http://opensource.org/licenses/MIT MIT
 */
interface IStorage
{
    #region methods
    /**
     * Function Get.
     *
     * @param string $key String, which is XPath like
     *
     * @return mixed
     */
    public function get($key = '');

    public function set($key = '', $value = null);

    public function add($key = '', $value = null);

    public function remove($key = '');

    /**
     * Get all entities.
     *
     * @return EntityCollection
     */
    public function getEntities();

    /**
     * Get entity.
     *
     * @param string $name Name of entity.
     *
     * @return IEntity
     */
    public function getEntity($name);
    #endregion
}

/*
phptype(dbsyntax)://username:password@protocol+hostspec/database?option=value
phptype://username:password@protocol+hostspec:110//usr/db_file.db
phptype://username:password@hostspec/database
phptype://username:password@hostspec
phptype://username@hostspec
phptype://hostspec/database
phptype://hostspec
phptype:///database
phptype:///database?option=value&anotheroption=anothervalue
phptype(dbsyntax)
phptype

mysql://user@unix(/path/to/socket)/pear
pgsql://user:pass@tcp(localhost:5555)/pear
sqlite:////full/unix/path/to/file.db?mode=0666
sqlite:///c:/full/windows/path/to/file.db?mode=0666
mysqli://user:pass@localhost/pear?key=client-key.pem&cert=client-cert.pem
oci8://username:password@foo.example.com[:port]/?service=service
username/password@[//]host[:port][/service_name]
*/
