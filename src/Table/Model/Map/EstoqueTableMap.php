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
use Table\Model\Estoque;
use Table\Model\EstoqueQuery;


/**
 * This class defines the structure of the 'estoque' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class EstoqueTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'Table.Model.Map.EstoqueTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'estoque';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\Table\\Model\\Estoque';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'Table.Model.Estoque';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 16;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 16;

    /**
     * the column name for the id field
     */
    const COL_ID = 'estoque.id';

    /**
     * the column name for the produto_id field
     */
    const COL_PRODUTO_ID = 'estoque.produto_id';

    /**
     * the column name for the ns field
     */
    const COL_NS = 'estoque.ns';

    /**
     * the column name for the patrimonio field
     */
    const COL_PATRIMONIO = 'estoque.patrimonio';

    /**
     * the column name for the internet field
     */
    const COL_INTERNET = 'estoque.internet';

    /**
     * the column name for the codigo_barras field
     */
    const COL_CODIGO_BARRAS = 'estoque.codigo_barras';

    /**
     * the column name for the data_compra field
     */
    const COL_DATA_COMPRA = 'estoque.data_compra';

    /**
     * the column name for the valor field
     */
    const COL_VALOR = 'estoque.valor';

    /**
     * the column name for the numero_nf field
     */
    const COL_NUMERO_NF = 'estoque.numero_nf';

    /**
     * the column name for the historico field
     */
    const COL_HISTORICO = 'estoque.historico';

    /**
     * the column name for the status field
     */
    const COL_STATUS = 'estoque.status';

    /**
     * the column name for the motivo field
     */
    const COL_MOTIVO = 'estoque.motivo';

    /**
     * the column name for the dh_inclusao field
     */
    const COL_DH_INCLUSAO = 'estoque.dh_inclusao';

    /**
     * the column name for the dh_alteracao field
     */
    const COL_DH_ALTERACAO = 'estoque.dh_alteracao';

    /**
     * the column name for the user_id_inclusao field
     */
    const COL_USER_ID_INCLUSAO = 'estoque.user_id_inclusao';

    /**
     * the column name for the user_id_alteracao field
     */
    const COL_USER_ID_ALTERACAO = 'estoque.user_id_alteracao';

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
        self::TYPE_PHPNAME       => array('Id', 'ProdutoId', 'Ns', 'Patrimonio', 'Internet', 'CodigoBarras', 'DataCompra', 'Valor', 'NumeroNf', 'Historico', 'Status', 'Motivo', 'DhInclusao', 'DhAlteracao', 'UserIdInclusao', 'UserIdAlteracao', ),
        self::TYPE_CAMELNAME     => array('id', 'produtoId', 'ns', 'patrimonio', 'internet', 'codigoBarras', 'dataCompra', 'valor', 'numeroNf', 'historico', 'status', 'motivo', 'dhInclusao', 'dhAlteracao', 'userIdInclusao', 'userIdAlteracao', ),
        self::TYPE_COLNAME       => array(EstoqueTableMap::COL_ID, EstoqueTableMap::COL_PRODUTO_ID, EstoqueTableMap::COL_NS, EstoqueTableMap::COL_PATRIMONIO, EstoqueTableMap::COL_INTERNET, EstoqueTableMap::COL_CODIGO_BARRAS, EstoqueTableMap::COL_DATA_COMPRA, EstoqueTableMap::COL_VALOR, EstoqueTableMap::COL_NUMERO_NF, EstoqueTableMap::COL_HISTORICO, EstoqueTableMap::COL_STATUS, EstoqueTableMap::COL_MOTIVO, EstoqueTableMap::COL_DH_INCLUSAO, EstoqueTableMap::COL_DH_ALTERACAO, EstoqueTableMap::COL_USER_ID_INCLUSAO, EstoqueTableMap::COL_USER_ID_ALTERACAO, ),
        self::TYPE_FIELDNAME     => array('id', 'produto_id', 'ns', 'patrimonio', 'internet', 'codigo_barras', 'data_compra', 'valor', 'numero_nf', 'historico', 'status', 'motivo', 'dh_inclusao', 'dh_alteracao', 'user_id_inclusao', 'user_id_alteracao', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'ProdutoId' => 1, 'Ns' => 2, 'Patrimonio' => 3, 'Internet' => 4, 'CodigoBarras' => 5, 'DataCompra' => 6, 'Valor' => 7, 'NumeroNf' => 8, 'Historico' => 9, 'Status' => 10, 'Motivo' => 11, 'DhInclusao' => 12, 'DhAlteracao' => 13, 'UserIdInclusao' => 14, 'UserIdAlteracao' => 15, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'produtoId' => 1, 'ns' => 2, 'patrimonio' => 3, 'internet' => 4, 'codigoBarras' => 5, 'dataCompra' => 6, 'valor' => 7, 'numeroNf' => 8, 'historico' => 9, 'status' => 10, 'motivo' => 11, 'dhInclusao' => 12, 'dhAlteracao' => 13, 'userIdInclusao' => 14, 'userIdAlteracao' => 15, ),
        self::TYPE_COLNAME       => array(EstoqueTableMap::COL_ID => 0, EstoqueTableMap::COL_PRODUTO_ID => 1, EstoqueTableMap::COL_NS => 2, EstoqueTableMap::COL_PATRIMONIO => 3, EstoqueTableMap::COL_INTERNET => 4, EstoqueTableMap::COL_CODIGO_BARRAS => 5, EstoqueTableMap::COL_DATA_COMPRA => 6, EstoqueTableMap::COL_VALOR => 7, EstoqueTableMap::COL_NUMERO_NF => 8, EstoqueTableMap::COL_HISTORICO => 9, EstoqueTableMap::COL_STATUS => 10, EstoqueTableMap::COL_MOTIVO => 11, EstoqueTableMap::COL_DH_INCLUSAO => 12, EstoqueTableMap::COL_DH_ALTERACAO => 13, EstoqueTableMap::COL_USER_ID_INCLUSAO => 14, EstoqueTableMap::COL_USER_ID_ALTERACAO => 15, ),
        self::TYPE_FIELDNAME     => array('id' => 0, 'produto_id' => 1, 'ns' => 2, 'patrimonio' => 3, 'internet' => 4, 'codigo_barras' => 5, 'data_compra' => 6, 'valor' => 7, 'numero_nf' => 8, 'historico' => 9, 'status' => 10, 'motivo' => 11, 'dh_inclusao' => 12, 'dh_alteracao' => 13, 'user_id_inclusao' => 14, 'user_id_alteracao' => 15, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, )
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
        $this->setName('estoque');
        $this->setPhpName('Estoque');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Table\\Model\\Estoque');
        $this->setPackage('Table.Model');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addForeignPrimaryKey('produto_id', 'ProdutoId', 'INTEGER' , 'produto', 'id', true, null, null);
        $this->addColumn('ns', 'Ns', 'LONGVARCHAR', true, null, null);
        $this->addColumn('patrimonio', 'Patrimonio', 'INTEGER', true, null, null);
        $this->addColumn('internet', 'Internet', 'VARCHAR', true, 45, null);
        $this->addColumn('codigo_barras', 'CodigoBarras', 'INTEGER', false, null, null);
        $this->addColumn('data_compra', 'DataCompra', 'DATE', false, null, null);
        $this->addColumn('valor', 'Valor', 'DECIMAL', false, 8, null);
        $this->addColumn('numero_nf', 'NumeroNf', 'VARCHAR', false, 90, null);
        $this->addColumn('historico', 'Historico', 'LONGVARCHAR', false, null, null);
        $this->addColumn('status', 'Status', 'INTEGER', true, null, null);
        $this->addColumn('motivo', 'Motivo', 'INTEGER', false, null, null);
        $this->addColumn('dh_inclusao', 'DhInclusao', 'TIMESTAMP', false, null, null);
        $this->addColumn('dh_alteracao', 'DhAlteracao', 'TIMESTAMP', false, null, null);
        $this->addColumn('user_id_inclusao', 'UserIdInclusao', 'INTEGER', false, null, null);
        $this->addColumn('user_id_alteracao', 'UserIdAlteracao', 'INTEGER', false, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Produto', '\\Table\\Model\\Produto', RelationMap::MANY_TO_ONE, array('produto_id' => 'id', ), null, null);
    } // buildRelations()

    /**
     * Adds an object to the instance pool.
     *
     * Propel keeps cached copies of objects in an instance pool when they are retrieved
     * from the database. In some cases you may need to explicitly add objects
     * to the cache in order to ensure that the same objects are always returned by find*()
     * and findPk*() calls.
     *
     * @param \Table\Model\Estoque $obj A \Table\Model\Estoque object.
     * @param string $key             (optional) key to use for instance map (for performance boost if key was already calculated externally).
     */
    public static function addInstanceToPool($obj, $key = null)
    {
        if (Propel::isInstancePoolingEnabled()) {
            if (null === $key) {
                $key = serialize(array((string) $obj->getId(), (string) $obj->getProdutoId()));
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
     * @param mixed $value A \Table\Model\Estoque object or a primary key value.
     */
    public static function removeInstanceFromPool($value)
    {
        if (Propel::isInstancePoolingEnabled() && null !== $value) {
            if (is_object($value) && $value instanceof \Table\Model\Estoque) {
                $key = serialize(array((string) $value->getId(), (string) $value->getProdutoId()));

            } elseif (is_array($value) && count($value) === 2) {
                // assume we've been passed a primary key";
                $key = serialize(array((string) $value[0], (string) $value[1]));
            } elseif ($value instanceof Criteria) {
                self::$instances = [];

                return;
            } else {
                $e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or \Table\Model\Estoque object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value, true)));
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] === null && $row[TableMap::TYPE_NUM == $indexType ? 1 + $offset : static::translateFieldName('ProdutoId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return serialize(array((string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)], (string) $row[TableMap::TYPE_NUM == $indexType ? 1 + $offset : static::translateFieldName('ProdutoId', TableMap::TYPE_PHPNAME, $indexType)]));
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
                : self::translateFieldName('ProdutoId', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? EstoqueTableMap::CLASS_DEFAULT : EstoqueTableMap::OM_CLASS;
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
     * @return array           (Estoque object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = EstoqueTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = EstoqueTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + EstoqueTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = EstoqueTableMap::OM_CLASS;
            /** @var Estoque $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            EstoqueTableMap::addInstanceToPool($obj, $key);
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
            $key = EstoqueTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = EstoqueTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Estoque $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                EstoqueTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(EstoqueTableMap::COL_ID);
            $criteria->addSelectColumn(EstoqueTableMap::COL_PRODUTO_ID);
            $criteria->addSelectColumn(EstoqueTableMap::COL_NS);
            $criteria->addSelectColumn(EstoqueTableMap::COL_PATRIMONIO);
            $criteria->addSelectColumn(EstoqueTableMap::COL_INTERNET);
            $criteria->addSelectColumn(EstoqueTableMap::COL_CODIGO_BARRAS);
            $criteria->addSelectColumn(EstoqueTableMap::COL_DATA_COMPRA);
            $criteria->addSelectColumn(EstoqueTableMap::COL_VALOR);
            $criteria->addSelectColumn(EstoqueTableMap::COL_NUMERO_NF);
            $criteria->addSelectColumn(EstoqueTableMap::COL_HISTORICO);
            $criteria->addSelectColumn(EstoqueTableMap::COL_STATUS);
            $criteria->addSelectColumn(EstoqueTableMap::COL_MOTIVO);
            $criteria->addSelectColumn(EstoqueTableMap::COL_DH_INCLUSAO);
            $criteria->addSelectColumn(EstoqueTableMap::COL_DH_ALTERACAO);
            $criteria->addSelectColumn(EstoqueTableMap::COL_USER_ID_INCLUSAO);
            $criteria->addSelectColumn(EstoqueTableMap::COL_USER_ID_ALTERACAO);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.produto_id');
            $criteria->addSelectColumn($alias . '.ns');
            $criteria->addSelectColumn($alias . '.patrimonio');
            $criteria->addSelectColumn($alias . '.internet');
            $criteria->addSelectColumn($alias . '.codigo_barras');
            $criteria->addSelectColumn($alias . '.data_compra');
            $criteria->addSelectColumn($alias . '.valor');
            $criteria->addSelectColumn($alias . '.numero_nf');
            $criteria->addSelectColumn($alias . '.historico');
            $criteria->addSelectColumn($alias . '.status');
            $criteria->addSelectColumn($alias . '.motivo');
            $criteria->addSelectColumn($alias . '.dh_inclusao');
            $criteria->addSelectColumn($alias . '.dh_alteracao');
            $criteria->addSelectColumn($alias . '.user_id_inclusao');
            $criteria->addSelectColumn($alias . '.user_id_alteracao');
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
        return Propel::getServiceContainer()->getDatabaseMap(EstoqueTableMap::DATABASE_NAME)->getTable(EstoqueTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(EstoqueTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(EstoqueTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new EstoqueTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Estoque or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Estoque object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(EstoqueTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Table\Model\Estoque) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(EstoqueTableMap::DATABASE_NAME);
            // primary key is composite; we therefore, expect
            // the primary key passed to be an array of pkey values
            if (count($values) == count($values, COUNT_RECURSIVE)) {
                // array is not multi-dimensional
                $values = array($values);
            }
            foreach ($values as $value) {
                $criterion = $criteria->getNewCriterion(EstoqueTableMap::COL_ID, $value[0]);
                $criterion->addAnd($criteria->getNewCriterion(EstoqueTableMap::COL_PRODUTO_ID, $value[1]));
                $criteria->addOr($criterion);
            }
        }

        $query = EstoqueQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            EstoqueTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                EstoqueTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the estoque table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return EstoqueQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Estoque or Criteria object.
     *
     * @param mixed               $criteria Criteria or Estoque object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(EstoqueTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Estoque object
        }

        if ($criteria->containsKey(EstoqueTableMap::COL_ID) && $criteria->keyContainsValue(EstoqueTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.EstoqueTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = EstoqueQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // EstoqueTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
EstoqueTableMap::buildTableMap();
