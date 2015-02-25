<?php

namespace Map;

use \MenuItem;
use \MenuItemQuery;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\InstancePoolTrait;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\DataFetcher\DataFetcherInterface;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\RelationMap;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Map\TableMapTrait;


/**
 * This class defines the structure of the 'menu_item' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class MenuItemTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.MenuItemTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'menu_item';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\MenuItem';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'MenuItem';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 11;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 11;

    /**
     * the column name for the id field
     */
    const COL_ID = 'menu_item.id';

    /**
     * the column name for the menu_id field
     */
    const COL_MENU_ID = 'menu_item.menu_id';

    /**
     * the column name for the rotulo field
     */
    const COL_ROTULO = 'menu_item.rotulo';

    /**
     * the column name for the title field
     */
    const COL_TITLE = 'menu_item.title';

    /**
     * the column name for the parent field
     */
    const COL_PARENT = 'menu_item.parent';

    /**
     * the column name for the tipo field
     */
    const COL_TIPO = 'menu_item.tipo';

    /**
     * the column name for the tipo_id field
     */
    const COL_TIPO_ID = 'menu_item.tipo_id';

    /**
     * the column name for the ordem field
     */
    const COL_ORDEM = 'menu_item.ordem';

    /**
     * the column name for the dados field
     */
    const COL_DADOS = 'menu_item.dados';

    /**
     * the column name for the dh_inclusao field
     */
    const COL_DH_INCLUSAO = 'menu_item.dh_inclusao';

    /**
     * the column name for the dh_alteracao field
     */
    const COL_DH_ALTERACAO = 'menu_item.dh_alteracao';

    /**
     * The default string format for model objects of the related table
     */
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        self::TYPE_PHPNAME       => array('Id', 'MenuId', 'Rotulo', 'Title', 'Parent', 'Tipo', 'TipoId', 'Ordem', 'Dados', 'DhInclusao', 'DhAlteracao', ),
        self::TYPE_CAMELNAME     => array('id', 'menuId', 'rotulo', 'title', 'parent', 'tipo', 'tipoId', 'ordem', 'dados', 'dhInclusao', 'dhAlteracao', ),
        self::TYPE_COLNAME       => array(MenuItemTableMap::COL_ID, MenuItemTableMap::COL_MENU_ID, MenuItemTableMap::COL_ROTULO, MenuItemTableMap::COL_TITLE, MenuItemTableMap::COL_PARENT, MenuItemTableMap::COL_TIPO, MenuItemTableMap::COL_TIPO_ID, MenuItemTableMap::COL_ORDEM, MenuItemTableMap::COL_DADOS, MenuItemTableMap::COL_DH_INCLUSAO, MenuItemTableMap::COL_DH_ALTERACAO, ),
        self::TYPE_FIELDNAME     => array('id', 'menu_id', 'rotulo', 'title', 'parent', 'tipo', 'tipo_id', 'ordem', 'dados', 'dh_inclusao', 'dh_alteracao', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'MenuId' => 1, 'Rotulo' => 2, 'Title' => 3, 'Parent' => 4, 'Tipo' => 5, 'TipoId' => 6, 'Ordem' => 7, 'Dados' => 8, 'DhInclusao' => 9, 'DhAlteracao' => 10, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'menuId' => 1, 'rotulo' => 2, 'title' => 3, 'parent' => 4, 'tipo' => 5, 'tipoId' => 6, 'ordem' => 7, 'dados' => 8, 'dhInclusao' => 9, 'dhAlteracao' => 10, ),
        self::TYPE_COLNAME       => array(MenuItemTableMap::COL_ID => 0, MenuItemTableMap::COL_MENU_ID => 1, MenuItemTableMap::COL_ROTULO => 2, MenuItemTableMap::COL_TITLE => 3, MenuItemTableMap::COL_PARENT => 4, MenuItemTableMap::COL_TIPO => 5, MenuItemTableMap::COL_TIPO_ID => 6, MenuItemTableMap::COL_ORDEM => 7, MenuItemTableMap::COL_DADOS => 8, MenuItemTableMap::COL_DH_INCLUSAO => 9, MenuItemTableMap::COL_DH_ALTERACAO => 10, ),
        self::TYPE_FIELDNAME     => array('id' => 0, 'menu_id' => 1, 'rotulo' => 2, 'title' => 3, 'parent' => 4, 'tipo' => 5, 'tipo_id' => 6, 'ordem' => 7, 'dados' => 8, 'dh_inclusao' => 9, 'dh_alteracao' => 10, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, )
    );

    /**
     * Initialize the table attributes and columns
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('menu_item');
        $this->setPhpName('MenuItem');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\MenuItem');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addForeignPrimaryKey('menu_id', 'MenuId', 'INTEGER' , 'menu', 'id', true, null, null);
        $this->addColumn('rotulo', 'Rotulo', 'VARCHAR', true, 80, null);
        $this->addColumn('title', 'Title', 'LONGVARCHAR', false, null, null);
        $this->addColumn('parent', 'Parent', 'INTEGER', true, null, null);
        $this->addColumn('tipo', 'Tipo', 'VARCHAR', true, 45, null);
        $this->addColumn('tipo_id', 'TipoId', 'INTEGER', true, null, null);
        $this->addColumn('ordem', 'Ordem', 'INTEGER', true, null, null);
        $this->addColumn('dados', 'Dados', 'LONGVARCHAR', false, null, null);
        $this->addColumn('dh_inclusao', 'DhInclusao', 'VARCHAR', false, 255, null);
        $this->addColumn('dh_alteracao', 'DhAlteracao', 'VARCHAR', false, 255, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Menu', '\\Menu', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':menu_id',
    1 => ':id',
  ),
), null, null, null, false);
    } // buildRelations()

    /**
     * Adds an object to the instance pool.
     *
     * Propel keeps cached copies of objects in an instance pool when they are retrieved
     * from the database. In some cases you may need to explicitly add objects
     * to the cache in order to ensure that the same objects are always returned by find*()
     * and findPk*() calls.
     *
     * @param \MenuItem $obj A \MenuItem object.
     * @param string $key             (optional) key to use for instance map (for performance boost if key was already calculated externally).
     */
    public static function addInstanceToPool($obj, $key = null)
    {
        if (Propel::isInstancePoolingEnabled()) {
            if (null === $key) {
                $key = serialize(array((string) $obj->getId(), (string) $obj->getMenuId()));
            } // if key === null
            self::$instances[$key] = $obj;
        }
    }

    /**
     * Removes an object from the instance pool.
     *
     * Propel keeps cached copies of objects in an instance pool when they are retrieved
     * from the database.  In some cases -- especially when you override doDelete
     * methods in your stub classes -- you may need to explicitly remove objects
     * from the cache in order to prevent returning objects that no longer exist.
     *
     * @param mixed $value A \MenuItem object or a primary key value.
     */
    public static function removeInstanceFromPool($value)
    {
        if (Propel::isInstancePoolingEnabled() && null !== $value) {
            if (is_object($value) && $value instanceof \MenuItem) {
                $key = serialize(array((string) $value->getId(), (string) $value->getMenuId()));

            } elseif (is_array($value) && count($value) === 2) {
                // assume we've been passed a primary key";
                $key = serialize(array((string) $value[0], (string) $value[1]));
            } elseif ($value instanceof Criteria) {
                self::$instances = [];

                return;
            } else {
                $e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or \MenuItem object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value, true)));
                throw $e;
            }

            unset(self::$instances[$key]);
        }
    }

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return string The primary key hash of the row
     */
    public static function getPrimaryKeyHashFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        // If the PK cannot be derived from the row, return NULL.
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] === null && $row[TableMap::TYPE_NUM == $indexType ? 1 + $offset : static::translateFieldName('MenuId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return serialize(array((string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)], (string) $row[TableMap::TYPE_NUM == $indexType ? 1 + $offset : static::translateFieldName('MenuId', TableMap::TYPE_PHPNAME, $indexType)]));
    }

    /**
     * Retrieves the primary key from the DB resultset row
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, an array of the primary key columns will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
            $pks = [];
            
        $pks[] = (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)
        ];
        $pks[] = (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 1 + $offset
                : self::translateFieldName('MenuId', TableMap::TYPE_PHPNAME, $indexType)
        ];

        return $pks;
    }
    
    /**
     * The class that the tableMap will make instances of.
     *
     * If $withPrefix is true, the returned path
     * uses a dot-path notation which is translated into a path
     * relative to a location on the PHP include_path.
     * (e.g. path.to.MyClass -> 'path/to/MyClass.php')
     *
     * @param boolean $withPrefix Whether or not to return the path with the class name
     * @return string path.to.ClassName
     */
    public static function getOMClass($withPrefix = true)
    {
        return $withPrefix ? MenuItemTableMap::CLASS_DEFAULT : MenuItemTableMap::OM_CLASS;
    }

    /**
     * Populates an object of the default type or an object that inherit from the default.
     *
     * @param array  $row       row returned by DataFetcher->fetch().
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                 One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return array           (MenuItem object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = MenuItemTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = MenuItemTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + MenuItemTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = MenuItemTableMap::OM_CLASS;
            /** @var MenuItem $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            MenuItemTableMap::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }

    /**
     * The returned array will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @param DataFetcherInterface $dataFetcher
     * @return array
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function populateObjects(DataFetcherInterface $dataFetcher)
    {
        $results = array();
    
        // set the class once to avoid overhead in the loop
        $cls = static::getOMClass(false);
        // populate the object(s)
        while ($row = $dataFetcher->fetch()) {
            $key = MenuItemTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = MenuItemTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var MenuItem $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                MenuItemTableMap::addInstanceToPool($obj, $key);
            } // if key exists
        }

        return $results;
    }
    /**
     * Add all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be added to the select list and only loaded
     * on demand.
     *
     * @param Criteria $criteria object containing the columns to add.
     * @param string   $alias    optional table alias
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function addSelectColumns(Criteria $criteria, $alias = null)
    {
        if (null === $alias) {
            $criteria->addSelectColumn(MenuItemTableMap::COL_ID);
            $criteria->addSelectColumn(MenuItemTableMap::COL_MENU_ID);
            $criteria->addSelectColumn(MenuItemTableMap::COL_ROTULO);
            $criteria->addSelectColumn(MenuItemTableMap::COL_TITLE);
            $criteria->addSelectColumn(MenuItemTableMap::COL_PARENT);
            $criteria->addSelectColumn(MenuItemTableMap::COL_TIPO);
            $criteria->addSelectColumn(MenuItemTableMap::COL_TIPO_ID);
            $criteria->addSelectColumn(MenuItemTableMap::COL_ORDEM);
            $criteria->addSelectColumn(MenuItemTableMap::COL_DADOS);
            $criteria->addSelectColumn(MenuItemTableMap::COL_DH_INCLUSAO);
            $criteria->addSelectColumn(MenuItemTableMap::COL_DH_ALTERACAO);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.menu_id');
            $criteria->addSelectColumn($alias . '.rotulo');
            $criteria->addSelectColumn($alias . '.title');
            $criteria->addSelectColumn($alias . '.parent');
            $criteria->addSelectColumn($alias . '.tipo');
            $criteria->addSelectColumn($alias . '.tipo_id');
            $criteria->addSelectColumn($alias . '.ordem');
            $criteria->addSelectColumn($alias . '.dados');
            $criteria->addSelectColumn($alias . '.dh_inclusao');
            $criteria->addSelectColumn($alias . '.dh_alteracao');
        }
    }

    /**
     * Returns the TableMap related to this object.
     * This method is not needed for general use but a specific application could have a need.
     * @return TableMap
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function getTableMap()
    {
        return Propel::getServiceContainer()->getDatabaseMap(MenuItemTableMap::DATABASE_NAME)->getTable(MenuItemTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(MenuItemTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(MenuItemTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new MenuItemTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a MenuItem or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or MenuItem object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param  ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
     public static function doDelete($values, ConnectionInterface $con = null)
     {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(MenuItemTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \MenuItem) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(MenuItemTableMap::DATABASE_NAME);
            // primary key is composite; we therefore, expect
            // the primary key passed to be an array of pkey values
            if (count($values) == count($values, COUNT_RECURSIVE)) {
                // array is not multi-dimensional
                $values = array($values);
            }
            foreach ($values as $value) {
                $criterion = $criteria->getNewCriterion(MenuItemTableMap::COL_ID, $value[0]);
                $criterion->addAnd($criteria->getNewCriterion(MenuItemTableMap::COL_MENU_ID, $value[1]));
                $criteria->addOr($criterion);
            }
        }

        $query = MenuItemQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            MenuItemTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                MenuItemTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the menu_item table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return MenuItemQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a MenuItem or Criteria object.
     *
     * @param mixed               $criteria Criteria or MenuItem object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(MenuItemTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from MenuItem object
        }

        if ($criteria->containsKey(MenuItemTableMap::COL_ID) && $criteria->keyContainsValue(MenuItemTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.MenuItemTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = MenuItemQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // MenuItemTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
MenuItemTableMap::buildTableMap();
