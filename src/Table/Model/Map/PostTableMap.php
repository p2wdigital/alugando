<?php

namespace Table\Model\Map;

use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\InstancePoolTrait;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\DataFetcher\DataFetcherInterface;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\RelationMap;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Map\TableMapTrait;
use Table\Model\Post;
use Table\Model\PostQuery;


/**
 * This class defines the structure of the 'post' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class PostTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'Table.Model.Map.PostTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'post';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\Table\\Model\\Post';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'Table.Model.Post';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 9;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 9;

    /**
     * the column name for the id field
     */
    const COL_ID = 'post.id';

    /**
     * the column name for the autor_id field
     */
    const COL_AUTOR_ID = 'post.autor_id';

    /**
     * the column name for the titulo field
     */
    const COL_TITULO = 'post.titulo';

    /**
     * the column name for the url field
     */
    const COL_URL = 'post.url';

    /**
     * the column name for the content field
     */
    const COL_CONTENT = 'post.content';

    /**
     * the column name for the status field
     */
    const COL_STATUS = 'post.status';

    /**
     * the column name for the data field
     */
    const COL_DATA = 'post.data';

    /**
     * the column name for the dh_inclusao field
     */
    const COL_DH_INCLUSAO = 'post.dh_inclusao';

    /**
     * the column name for the dh_alteracao field
     */
    const COL_DH_ALTERACAO = 'post.dh_alteracao';

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
        self::TYPE_PHPNAME       => array('Id', 'AutorId', 'Titulo', 'Url', 'Content', 'Status', 'Data', 'DhInclusao', 'DhAlteracao', ),
        self::TYPE_CAMELNAME     => array('id', 'autorId', 'titulo', 'url', 'content', 'status', 'data', 'dhInclusao', 'dhAlteracao', ),
        self::TYPE_COLNAME       => array(PostTableMap::COL_ID, PostTableMap::COL_AUTOR_ID, PostTableMap::COL_TITULO, PostTableMap::COL_URL, PostTableMap::COL_CONTENT, PostTableMap::COL_STATUS, PostTableMap::COL_DATA, PostTableMap::COL_DH_INCLUSAO, PostTableMap::COL_DH_ALTERACAO, ),
        self::TYPE_FIELDNAME     => array('id', 'autor_id', 'titulo', 'url', 'content', 'status', 'data', 'dh_inclusao', 'dh_alteracao', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'AutorId' => 1, 'Titulo' => 2, 'Url' => 3, 'Content' => 4, 'Status' => 5, 'Data' => 6, 'DhInclusao' => 7, 'DhAlteracao' => 8, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'autorId' => 1, 'titulo' => 2, 'url' => 3, 'content' => 4, 'status' => 5, 'data' => 6, 'dhInclusao' => 7, 'dhAlteracao' => 8, ),
        self::TYPE_COLNAME       => array(PostTableMap::COL_ID => 0, PostTableMap::COL_AUTOR_ID => 1, PostTableMap::COL_TITULO => 2, PostTableMap::COL_URL => 3, PostTableMap::COL_CONTENT => 4, PostTableMap::COL_STATUS => 5, PostTableMap::COL_DATA => 6, PostTableMap::COL_DH_INCLUSAO => 7, PostTableMap::COL_DH_ALTERACAO => 8, ),
        self::TYPE_FIELDNAME     => array('id' => 0, 'autor_id' => 1, 'titulo' => 2, 'url' => 3, 'content' => 4, 'status' => 5, 'data' => 6, 'dh_inclusao' => 7, 'dh_alteracao' => 8, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, )
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
        $this->setName('post');
        $this->setPhpName('Post');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Table\\Model\\Post');
        $this->setPackage('Table.Model');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addForeignPrimaryKey('autor_id', 'AutorId', 'INTEGER' , 'autor', 'id', true, null, null);
        $this->addColumn('titulo', 'Titulo', 'VARCHAR', true, 100, null);
        $this->addColumn('url', 'Url', 'VARCHAR', true, 100, null);
        $this->addColumn('content', 'Content', 'LONGVARCHAR', true, null, null);
        $this->addColumn('status', 'Status', 'INTEGER', true, null, null);
        $this->addColumn('data', 'Data', 'VARCHAR', true, 255, null);
        $this->addColumn('dh_inclusao', 'DhInclusao', 'VARCHAR', false, 255, null);
        $this->addColumn('dh_alteracao', 'DhAlteracao', 'VARCHAR', false, 255, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Autor', '\\Table\\Model\\Autor', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':autor_id',
    1 => ':id',
  ),
), null, null, null, false);
        $this->addRelation('PostData', '\\Table\\Model\\PostData', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':post_id',
    1 => ':id',
  ),
), null, null, 'PostDatas', false);
        $this->addRelation('PostHasCategoria', '\\Table\\Model\\PostHasCategoria', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':post_id',
    1 => ':id',
  ),
), null, null, 'PostHasCategorias', false);
        $this->addRelation('Categoria', '\\Table\\Model\\Categoria', RelationMap::MANY_TO_MANY, array(), null, null, 'Categorias');
    } // buildRelations()

    /**
     * Adds an object to the instance pool.
     *
     * Propel keeps cached copies of objects in an instance pool when they are retrieved
     * from the database. In some cases you may need to explicitly add objects
     * to the cache in order to ensure that the same objects are always returned by find*()
     * and findPk*() calls.
     *
     * @param \Table\Model\Post $obj A \Table\Model\Post object.
     * @param string $key             (optional) key to use for instance map (for performance boost if key was already calculated externally).
     */
    public static function addInstanceToPool($obj, $key = null)
    {
        if (Propel::isInstancePoolingEnabled()) {
            if (null === $key) {
                $key = serialize(array((string) $obj->getId(), (string) $obj->getAutorId()));
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
     * @param mixed $value A \Table\Model\Post object or a primary key value.
     */
    public static function removeInstanceFromPool($value)
    {
        if (Propel::isInstancePoolingEnabled() && null !== $value) {
            if (is_object($value) && $value instanceof \Table\Model\Post) {
                $key = serialize(array((string) $value->getId(), (string) $value->getAutorId()));

            } elseif (is_array($value) && count($value) === 2) {
                // assume we've been passed a primary key";
                $key = serialize(array((string) $value[0], (string) $value[1]));
            } elseif ($value instanceof Criteria) {
                self::$instances = [];

                return;
            } else {
                $e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or \Table\Model\Post object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value, true)));
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] === null && $row[TableMap::TYPE_NUM == $indexType ? 1 + $offset : static::translateFieldName('AutorId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return serialize(array((string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)], (string) $row[TableMap::TYPE_NUM == $indexType ? 1 + $offset : static::translateFieldName('AutorId', TableMap::TYPE_PHPNAME, $indexType)]));
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
                : self::translateFieldName('AutorId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? PostTableMap::CLASS_DEFAULT : PostTableMap::OM_CLASS;
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
     * @return array           (Post object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = PostTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = PostTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + PostTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = PostTableMap::OM_CLASS;
            /** @var Post $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            PostTableMap::addInstanceToPool($obj, $key);
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
            $key = PostTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = PostTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Post $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                PostTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(PostTableMap::COL_ID);
            $criteria->addSelectColumn(PostTableMap::COL_AUTOR_ID);
            $criteria->addSelectColumn(PostTableMap::COL_TITULO);
            $criteria->addSelectColumn(PostTableMap::COL_URL);
            $criteria->addSelectColumn(PostTableMap::COL_CONTENT);
            $criteria->addSelectColumn(PostTableMap::COL_STATUS);
            $criteria->addSelectColumn(PostTableMap::COL_DATA);
            $criteria->addSelectColumn(PostTableMap::COL_DH_INCLUSAO);
            $criteria->addSelectColumn(PostTableMap::COL_DH_ALTERACAO);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.autor_id');
            $criteria->addSelectColumn($alias . '.titulo');
            $criteria->addSelectColumn($alias . '.url');
            $criteria->addSelectColumn($alias . '.content');
            $criteria->addSelectColumn($alias . '.status');
            $criteria->addSelectColumn($alias . '.data');
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
        return Propel::getServiceContainer()->getDatabaseMap(PostTableMap::DATABASE_NAME)->getTable(PostTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(PostTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(PostTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new PostTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Post or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Post object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(PostTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Table\Model\Post) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(PostTableMap::DATABASE_NAME);
            // primary key is composite; we therefore, expect
            // the primary key passed to be an array of pkey values
            if (count($values) == count($values, COUNT_RECURSIVE)) {
                // array is not multi-dimensional
                $values = array($values);
            }
            foreach ($values as $value) {
                $criterion = $criteria->getNewCriterion(PostTableMap::COL_ID, $value[0]);
                $criterion->addAnd($criteria->getNewCriterion(PostTableMap::COL_AUTOR_ID, $value[1]));
                $criteria->addOr($criterion);
            }
        }

        $query = PostQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            PostTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                PostTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the post table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return PostQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Post or Criteria object.
     *
     * @param mixed               $criteria Criteria or Post object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PostTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Post object
        }

        if ($criteria->containsKey(PostTableMap::COL_ID) && $criteria->keyContainsValue(PostTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.PostTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = PostQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // PostTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
PostTableMap::buildTableMap();
