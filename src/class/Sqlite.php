<?php

namespace Com\PaulDevelop\Library\Persistence;

/**
 * Sqlite
 *
 * @package  Com\PaulDevelop\Library\Persistence
 * @category Persistence
 * @author   Rüdiger Scheumann <code@pauldevelop.com>
 * @license  http://opensource.org/licenses/MIT MIT
 */
class Sqlite implements IStorage
{
    #region member
    private $path;
    private $filename;
    #endregion

    #region constructor
    public function __construct($path = '', $filename = '')
    {
        $this->path = $path;
        $this->filename = $filename;
    }
    #endregion

    #region methods
    public function get($key = '')
    {
        $file = $this->path."/".$this->filename;
        //echo $file;
        //if ( $db = sqlite_open($file, 0666, $sqliteerror) ) {
        //    $result = sqlite_query($db, 'SELECT id, filename, type FROM skyscraper;');
        //    var_dump(sqlite_fetch_array($result));
        //} else {
        //    die($sqliteerror);
        //}
//echo $key;
        preg_match('/([a-z0-9]+)(\[(?:\,?[a-z0-9\(\)]+(?:\=[a-z0-9\(\)\']+)?)*\])/', $key, $matches);
        //var_dump($matches);
        $table = $matches[1];

        //$orderBy = '';

        $random = false;
        $limit = 0;

        $chunks = preg_split('/,/', trim($matches[2], '[]'));
        foreach ($chunks as $setting) {
            //echo $setting;
            if ($setting == 'random()') {
                $random = true;
            } elseif (preg_match('/limit=([0-9]+)/', $setting, $matches)) {
                $limit = intval($matches[1]);
            }
        }

        // build sql statement
        $sql = 'SELECT * FROM '.$table;
        if ($random) {
            $sql .= ' ORDER BY RANDOM()';
        }
        if ($limit > 0) {
            $sql .= ' LIMIT '.$limit;
        }
        $sql .= ';';
//echo $sql;
        //try {
        if (!file_exists($file)) {
            throw new \Exception("Database file \"".$file."\" does not exist.");
        }
        $dbh = new \PDO('sqlite:'.$file); //  $user, $pass
        //foreach ( $dbh->query('SELECT id, filename, type FROM skyscraper ORDER BY RANDOM() LIMIT 1;') as $row ) {
        //    var_dump($row);
        //}
        $result = $dbh->query($sql);
        $result = $result->fetch(\PDO::FETCH_ASSOC);
        $dbh = null;
        //} catch (PDOException $e) {
        //    print "Error!: " . $e->getMessage() . "<br/>";
        //    die();
        //}

        //echo "[".$this->_path.":".$this->_filename."] Sqlite::Get(".$key.")<br />\n";
        $ad = new \stdClass();
        //$ad->filename = 'siemens.png';
        //$ad->type = 'image';
        //var_dump($result);
        foreach ($result as $key => $value) {
            $ad->$key = $value;
        }
        //$ad->filename = $result['filename'];
        //$ad->type = $result['type'];
        //var_dump($ad);
        return $ad;
    }

    public function set($key = '', $value = null)
    {

    }

    public function add($key = '', $value = null)
    {

    }

    public function remove($key = '')
    {

    }

    /**
     * Get all entities.
     *
     * @return \Com\PaulDevelop\Library\Modeling\Entities\EntityCollection
     */
    public function getEntities()
    {
        //return $this->_model;
    }

    /**
     * Get entity.
     *
     * @param string $name Name of entity.
     *
     * @return \Com\PaulDevelop\Library\Modeling\Entities\IEntity
     */
    public function getEntity($name)
    {
        // init
        //$result = null;

        // action
        //foreach ( $this->_model as $entity ) {
        //    if ( $entity->Name == $name ) {
        //        $result = $entity;
        //        break;
        //    }
        //}

        // return
        //return $result;
    }
    #endregion
}
