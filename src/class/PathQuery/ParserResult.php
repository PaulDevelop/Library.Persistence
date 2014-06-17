<?php

namespace Com\PaulDevelop\Library\Persistence\PathQuery;

use Com\PaulDevelop\Library\Common\Base;

/**
 * ParserResult
 *
 * @package  Com\PaulDevelop\Library\Persistence
 * @category Application
 * @author   Rüdiger Scheumann <code@pauldevelop.com>
 * @license  http://opensource.org/licenses/MIT MIT
 *
 * @property string           $EntityName
 * @property FilterCollection $Filter
 * @property ViewParameter    $ViewParameter
 */
class ParserResult extends Base
{
    #region member
    /**
     * Entity name.
     *
     * @var string
     */
    private $entityName;
    /**
     * Query filter collection.
     *
     * @var FilterCollection
     */
    private $filter;
    /**
     * Query view parameter.
     *
     * @var ViewParameter
     */
    private $viewParameter;
    #endregion

    #region constructor
    public function __construct($entityName = '', $filter = null, $viewParameter = null)
    {
        $this->entityName = $entityName;
        $this->filter = $filter;
        $this->viewParameter = $viewParameter;
    }
    #endregion

    #region methods
    #endregion

    #region properties
    protected function getEntityName()
    {
        return $this->entityName;
    }

    protected function getFilter()
    {
        return $this->filter;
    }

    protected function getViewParameter()
    {
        return $this->viewParameter;
    }
    #endregion
}
