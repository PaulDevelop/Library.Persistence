<?php

namespace Com\PaulDevelop\Library\Persistance;

use Com\PaulDevelop\Library\Modeling\Entities\IEntity;
use Com\PaulDevelop\Library\Modeling\Entities\IModel;
use Com\PaulDevelop\Library\Modeling\Entities\EntityCollection;
use Com\PaulDevelop\Library\Modeling\Entities\PropertyCollection;

/**
 * Mysql
 *
 * @package  Com\PaulDevelop\Library\Persistance
 * @category Persistance
 * @author   Rüdiger Scheumann <code@pauldevelop.com>
 * @license  http://opensource.org/licenses/MIT MIT
 */
class Mysql implements IStorage
{
    #region member
    private $host;
    private $port;
    private $user;
    private $password;
    private $database;
    private $model;
    /**
     * Connection to MySql server.
     */
    private $connection;
    #endregion

    #region constructor
    /**
     * Constructor.
     *
     * @param string $host
     * @param string $port
     * @param string $user
     * @param string $password
     * @param string $database
     * @param IModel $model
     *
     * @throws \Exception
     */
    public function __construct(
        $host = '',
        $port = '',
        $user = '',
        $password = '',
        $database = '',
        IModel $model = null
    ) {
        $this->host = $host;
        $this->port = $port;
        $this->user = $user;
        $this->password = $password;
        $this->database = $database;
        $this->model = $model;
        $this->connection = null;

        // check, if php extension mysql or mysqli is installed
        /*
        $isMysqlExtensionInstalled = false;
        $isMysqliExtensionInstalled = false;
        De_PaulDevelop_Library_Tool::IncludeClass('De.PaulDevelop.Library.Model', 'Driver_System');
        $system = De_PaulDevelop_Library_Model_Driver_System::factory('phpinfo', array());
        $installedModules = $system->getAllInstalledModules();
        //TODO: also think about pdo-modules
        foreach ( $installedModules as $moduleName => $value ) {
            if ( $moduleName == 'mysql' ) {
                $isMysqlExtensionInstalled = true;
            }
            else if ( $moduleName == 'mysqli' ) {
                $isMysqliExtensionInstalled = true;
            }
        }
        echo $isMysqlExtensionInstalled;
        echo $isMysqliExtensionInstalled;
        */
        $this->connection = new \mysqli(
            $this->host,
            $this->user,
            $this->password,
            $this->database
        );
        if (mysqli_connect_errno()) {
            throw new \Exception(
                'Com.PaulDevelop.Library.Persistance.Constructor: Can\'t connect to mysql database server. Reason: '.
                mysqli_connect_error().''
            );
        }
    }
    #endregion

    #region methods
    public function get($key = '')
    {
        // init
        $return = null;

        // action
        $getSingleDataset = true;
        $chunks = preg_split('/\./', $key);

        // get single datset info
        if (sizeof($chunks) > 1
            && $chunks[sizeof($chunks) - 1] == '*'
        ) {
            $getSingleDataset = false;
            $key = substr($key, 0, strlen($key) - 2);
        }
        $sql = $this->convertXPath2Sql($key);
        $result = $this->query($sql, $getSingleDataset);

        // return
        return $result;
    }

    public function set($key = '', $value = null)
    {
        // init
        $result = null;

        // action
        // check if entity exists
        $foundEntity = false;
        $chunks = preg_split('/\./', $key);
        foreach ($this->getEntities() as $entity) {
            if ($entity->Name == lcfirst($chunks[sizeof($chunks) - 1])) {
                $foundEntity = $entity;
                break;
            }
        }

        if ($foundEntity == null) {
            throw new \Exception('Entity "'.$chunks[sizeof($chunks) - 1].'" does not exist.');
        }

        $sql = '';
        $sql .= 'UPDATE `'.lcfirst($entity->Name).'`'."\n";
        $sql .= '   SET ';
        $count = 0;
        foreach ($entity->Properties as $property) {
            if ($count > 0) {
                $sql .= '   AND ';
            }
            $sql .= '`'.lcfirst($property->Name).'` = \'\''."\n";
            $count++;
        }

        // return
        return $result;
    }

    public function add($key = '', $value = null)
    {
        // init
        $result = null;

        // action
        // check if entity exists
        $foundEntity = false;
        $chunks = preg_split('/\./', $key);
        foreach ($this->getEntities() as $entity) {
            if ($entity->Name == lcfirst($chunks[sizeof($chunks) - 1])) {
                $foundEntity = $entity;
                break;
            }
        }

        if ($foundEntity == null) {
            throw new \Exception('Entity "'.$chunks[sizeof($chunks) - 1].'" does not exist.');
        }

        $sql = '';
        $sql .= 'INSERT INTO `'.lcfirst($entity->Name).'`'."\n";
        $sql .= '   (';
        $count = 0;
        foreach ($entity->Properties as $property) {
            if ($count > 0) {
                $sql .= ', ';
            }
            $sql .= '`'.lcfirst($property->Name).'`';
            $count++;
        }
        $sql .= ')'."\n";
        $sql .= 'VALUES'."\n";
        $sql .= '   (';
        $count = 0;
        foreach ($entity->Properties as $property) {
            if ($count > 0) {
                $sql .= ', ';
            }
            $sql .= '\'\'';
            $count++;
        }
        $sql .= ')'."\n";

        echo $sql."\n";

        // return
        return $result;
    }

    public function remove($key = '')
    {

    }

    /**
     * Get all entities.
     *
     * @return EntityCollection
     */
    public function getEntities()
    {
        // init
        $result = new EntityCollection();

        // action
        if (!$this->model == null) {
            $result = $this->model->Entities;
        } else {
            $sql = "SHOW TABLES FROM `".$this->database."`;";
            $entities = $this->query($sql, false);

            foreach ($entities as $entity) {
                $entityName = $entity->{'Tables_in_'.$this->database};
                $sql = "SHOW COLUMNS FROM `".$entityName."`;";
                $properties = $this->query($sql, false);

                $propertyCollection = new PropertyCollection();
                foreach ($properties as $property) {
                    $propertyCollection->Add(
                        new Property(
                            $property->Field,
                            $property->Type,
                            $property->Null,
                            $property->Key,
                            $property->Default,
                            $property->Extra
                        )
                    );
                }

                $result->Add(
                    new Entity(
                        '',
                        $entityName,
                        $propertyCollection
                    )
                );
            }
        }

        // return
        return $result;
    }

    /**
     * Get entity.
     *
     * @param string $name Name of entity.
     *
     * @return IEntity
     */
    public function getEntity($name)
    {
        return $this->model->GetEntity($name);
//            // init
//            $result = null;
//
//            // action
//            foreach ( $this->_model as $entity ) {
//                if ( $entity->Name == $name ) {
//                    $result = $entity;
//                    break;
//                }
//            }
//
//            // return
//            return $result;
    }

    private function convertXPath2Sql($xpath)
    {
        // error
        if ($this->model == null) {
            throw new \Exception(
                "Mysql._convertXPath2Sql: Non-existent model. Can't convert xpath to sql with model being null."
            );
        }

        // --- init
        $sqlSelect = '';
        $sqlFrom = '';
        $sqlWhere = '';
        $result = '';

        //echo $xpath."<br />\n";

        // --- action ---
        //$chunks = split("/", $xpath);
        $chunks = preg_split('/\./', $xpath);
        //var_dump($chunks);

        $entityNamespace = '';
        $entityName = '';
        $getSingleDataset = true;

        // get single datset info
        if (sizeof($chunks) > 1
            && $chunks[sizeof($chunks) - 1] == '*'
        ) {
            $getSingleDataset = false;
            array_pop($chunks);
        }

        if (sizeof($chunks) > 0) {
            $entityName = $chunks[sizeof($chunks) - 1];
            array_pop($chunks);
        }

        //var_dump($chunks);

        foreach ($chunks as $chunk) {
            $entityNamespace .= ($entityNamespace == '' ? '' : '.').$chunk;
        }


        $curObj = null;

        if (sizeof($chunks) > 0) {
            // $chunks[0] is empty

            // get entity name (contains attribute definitions)
            //$entityName = $chunks[0];

            // check, if attributes exist and reset entity name
            $regs = array();
            preg_match('/^([a-z\_]+)(?:\[(.*)\])?$/i', $entityName, $regs);

            // if there are attributes, store them in array
            $entityAttributes = array();
            // echo sizeof($regs)."<br />\n";
            if (sizeof($regs) > 2) {
                // get chunk name without attributes
                $entityName = $regs[1];

                // get attributes
                $tmpAttributes = preg_split('/\,/', $regs[2]);
                for ($i = 0; $i < sizeof($tmpAttributes); $i++) {
                    list($key, $value) = preg_split('/\=/', $tmpAttributes[$i]); // split into key = value
                    if (substr($key, 0, 1) == '@') {
                        $key = substr($key, 1, strlen($key) - 1); // remove @
                    }
                    // TODO check value, see datatype in entity definition
                    $entityAttributes[$key] = $value; // add to attributes list
                }
            }

            // build SELECT
            //echo $entityName."<br />\n";
            //echo 'application.entities.entity[@name='.$entityName.'].properties'."<br />\n";
            // get entity
            //$entity = De_PaulDevelop_Library_Configuration::getInstance()->get(
            //    'application.entities.entity[@name='.$entityName.'].properties'
            //);
//echo $entityName;die;

            // find entity
            // TODO: Done. outsource finding entity in entity collection to class EntityCollection
//                $entity = null;
//                foreach ( $this->_model as $e ) {
//                    //var_dump($e);
//                    //echo $e->Name." = ".$entityName."<br />\n";
//                    if ( $e->Name == $entityName ) {
//                        $entity = $e;
//                        break;
//                    }
//                }

            //echo "entityName: ".$entityName."<br />";
            $entity = $this->model->GetEntity($entityNamespace, $entityName);

            //$parser = new \Com\PaulDevelop\Library\Processing\CodersPill\Project\Parser();
            //$parser->LoadFromFile('/home/rscheumann/Projekte/Eu.IndigoMagazine.Application.Frontend/
            //  php/model/website.model.xml');
            //$parser->LoadFromFile($this->_modelFile);
            //$model = $parser->Parse();
            //$entity = $model->GetNode('Model[@name=20091209_1805].Entity[@name='.$entityName.']');

//echo $entity->Name;
//var_dump($entity);//die;

            foreach ($entity->Properties as $propertyNode) {
                //var_dump($entity);
                //echo get_class($propertyNode); die;
                $implementsInterface = false;
                foreach (class_implements($propertyNode) as $interface) {
                    if ($interface == 'Com\PaulDevelop\Library\Modeling\Entities\IProperty') {
                        $implementsInterface = true;
                        break;
                    }
                }

                //get_declared_interfaces
                if (gettype($propertyNode) == 'object'
                    //&& get_class($propertyNode) == 'Com\PaulDevelop\Library\Modeling\Xml\Tag' ) {
                    //&& get_class($propertyNode) == 'Com\PaulDevelop\Library\Modeling\Entities\IEntity' ) {
                    && $implementsInterface
                ) {
                    //var_dump($propertyNode);
                    //echo $propertyNode->Attributes['name']."<br />\n";
                    //$propertyName = $propertyNode['name']->Value;
                    $propertyName = $propertyNode->Name;
                    //$sqlSelect .= ( ( $sqlSelect == '' ) ? '' : ', ' ).strtolower($propertyName);
                    //$sqlSelect .= ( ( $sqlSelect == '' ) ? '' : ', ' )
                    //  .( $propertyNode['type']->Value == 'xsd:string' ? '`' : '').strtolower($propertyName).(
                    //  $propertyNode['type']->Value == 'xsd:string' ? '`' : '');
                    $sqlSelect .= (($sqlSelect == '') ? '' : ', ').'`'.strtolower($propertyName).'`';
                }
            }

            //var_dump($entityAttributes);
            //foreach ( $entityAttributes as $key => $value ) {
            //  $sqlSelect .= ( ( $sqlSelect == '' ) ? '' : ', ' ).$key;
            //}
            $sqlSelect = 'SELECT '.$sqlSelect;
            //$sqlSelect = 'SELECT *';

            // build FROM
            $sqlFrom = 'FROM '.strtolower($entityName);
            //echo 'name: '.$entityName.'<br />\n';

            // build WHERE
            if (sizeof($entityAttributes) > 0) {
                foreach ($entityAttributes as $key => $value) {
                    $sqlWhere .= (($sqlWhere == '') ? '' : ' AND ').strtolower($key).' = '.$value;
                }
                $sqlWhere = 'WHERE '.$sqlWhere;
            }

            $result = $sqlSelect.' '.$sqlFrom.' '.$sqlWhere.';';
            //echo $result; die;

            /*
            if ( ( $curObj = $curObj->GetChildNode($chunk, $entityAttributes) ) != null ) {
                // zuweisung schon oben in if-block schon erfolgt
            }
            else {
                throw new ChildDoesNotExistException('Child node "'.$chunk.'" does not exist.');
            }
            */
        } else { // > 2
            // deal with relationships
        }
        // --- return ---

        // --- return ---
        //echo $result."<br />\n";
        return $result;
    }
    #endregion

    /**
     * Query database.
     */
    public function query($sql, $getSingleDataset = false)
    {
        // --- init ---
        $result = null;

        // --- action ---
        //if ( $this->_configuration->Extension == 'Mysql' ) {
        //    // TODO: implement method query for extension mysql
        //}
        //else if ( $this->_configuration->Extension == 'Mysqli' ) {
        //echo $sql;
        $queryResult = $this->connection->query($sql);
        if ($queryResult) {
            //echo $queryResult->num_rows;
            if ($getSingleDataset == true) {
                $row = $queryResult->fetch_object();
                $result = $row;
            } else {
                $result = array();
                while ($row = $queryResult->fetch_object()) {
                    array_push($result, $row);
                }
            }
        }
        //}

        // --- result ---
        return $result;
    }
}
