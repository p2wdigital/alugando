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
use Table\Model\Cliente;
use Table\Model\ClienteQuery;


/**
 * This class defines the structure of the 'cliente' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class ClienteTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'Table.Model.Map.ClienteTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'cliente';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\Table\\Model\\Cliente';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'Table.Model.Cliente';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 7;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 7;

    /**
     * the column name for the id field
     */
    const COL_ID = 'cliente.id';

    /**
     * the column name for the razao_social field
     */
    const COL_RAZAO_SOCIAL = 'cliente.razao_social';

    /**
     * the column name for the contato field
     */
    const COL_CONTATO = 'cliente.contato';

    /**
     * the column name for the cep field
     */
    const COL_CEP = 'cliente.cep';

    /**
     * the column name for the descricao field
     */
    const COL_DESCRICAO = 'cliente.descricao';

    /**
     * the column name for the dh_inclusao field
     */
    const COL_DH_INCLUSAO = 'cliente.dh_inclusao';

    /**
     * the column name for the dh_alteracao field
     */
    const COL_DH_ALTERACAO = 'cliente.dh_alteracao';

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
        self::TYPE_PHPNAME       => array('Id', 'RazaoSocial', 'Contato', 'Cep', 'Descricao', 'DhInclusao', 'DhAlteracao', ),
        self::TYPE_CAMELNAME     => array('id', 'razaoSocial', 'contato', 'cep', 'descricao', 'dhInclusao', 'dhAlteracao', ),
        self::TYPE_COLNAME       => array(ClienteTableMap::COL_ID, ClienteTableMap::COL_RAZAO_SOCIAL, ClienteTableMap::COL_CONTATO, ClienteTableMap::COL_CEP, ClienteTableMap::COL_DESCRICAO, ClienteTableMap::COL_DH_INCLUSAO, ClienteTableMap::COL_DH_ALTERACAO, ),
        self::TYPE_FIELDNAME     => array('id', 'razao_social', 'contato', 'cep', 'descricao', 'dh_inclusao', 'dh_alteracao', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'RazaoSocial' => 1, 'Contato' => 2, 'Cep' => 3, 'Descricao' => 4, 'DhInclusao' => 5, 'DhAlteracao' => 6, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'razaoSocial' => 1, 'contato' => 2, 'cep' => 3, 'descricao' => 4, 'dhInclusao' => 5, 'dhAlteracao' => 6, ),
        self::TYPE_COLNAME       => array(ClienteTableMap::COL_ID => 0, ClienteTableMap::COL_RAZAO_SOCIAL => 1, ClienteTableMap::COL_CONTATO => 2, ClienteTableMap::COL_CEP => 3, ClienteTableMap::COL_DESCRICAO => 4, ClienteTableMap::COL_DH_INCLUSAO => 5, ClienteTableMap::COL_DH_ALTERACAO => 6, ),
        self::TYPE_FIELDNAME     => array('id' => 0, 'razao_social' => 1, 'contato' => 2, 'cep' => 3, 'descricao' => 4, 'dh_inclusao' => 5, 'dh_alteracao' => 6, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, )
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
        $this->setName('cliente');
        $this->setPhpName('Cliente');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Table\\Model\\Cliente');
        $this->setPackage('Table.Model');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('razao_social', 'RazaoSocial', 'VARCHAR', true, 80, null);
        $this->addColumn('contato', 'Contato', 'VARCHAR', true, 80, null);
        $this->addColumn('cep', 'Cep', 'VARCHAR', true, 8, null);
        $this->addColumn('descricao', 'Descricao', 'LONGVARCHAR', true, null, null);
        $this->addColumn('dh_inclusao', 'DhInclusao', 'TIMESTAMP', false, null, null);
        $this->addColumn('dh_alteracao', 'DhAlteracao', 'TIMESTAMP', false, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('User', '\\Table\\Model\\User', RelationMap::ONE_TO_ONE, array('id' => 'cliente_id', ), null, null);
    } // buildRelations()

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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
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
        return (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)
        ];
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
        return $withPrefix ? ClienteTableMap::CLASS_DEFAULT : ClienteTableMap::OM_CLASS;
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
     * @return array           (Cliente object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = ClienteTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = ClienteTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + ClienteTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = ClienteTableMap::OM_CLASS;
            /** @var Cliente $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            ClienteTableMap::addInstanceToPool($obj, $key);
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
            $key = ClienteTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = ClienteTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Cliente $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                ClienteTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(ClienteTableMap::COL_ID);
            $criteria->addSelectColumn(ClienteTableMap::COL_RAZAO_SOCIAL);
            $criteria->addSelectColumn(ClienteTableMap::COL_CONTATO);
            $criteria->addSelectColumn(ClienteTableMap::COL_CEP);
            $criteria->addSelectColumn(ClienteTableMap::COL_DESCRICAO);
            $criteria->addSelectColumn(ClienteTableMap::COL_DH_INCLUSAO);
            $criteria->addSelectColumn(ClienteTableMap::COL_DH_ALTERACAO);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.razao_social');
            $criteria->addSelectColumn($alias . '.contato');
            $criteria->addSelectColumn($alias . '.cep');
            $criteria->addSelectColumn($alias . '.descricao');
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
        return Propel::getServiceContainer()->getDatabaseMap(ClienteTableMap::DATABASE_NAME)->getTable(ClienteTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(ClienteTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(ClienteTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new ClienteTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Cliente or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Cliente object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(ClienteTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Table\Model\Cliente) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(ClienteTableMap::DATABASE_NAME);
            $criteria->add(ClienteTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = ClienteQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            ClienteTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                ClienteTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the cliente table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return ClienteQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Cliente or Criteria object.
     *
     * @param mixed               $criteria Criteria or Cliente object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ClienteTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Cliente object
        }

        if ($criteria->containsKey(ClienteTableMap::COL_ID) && $criteria->keyContainsValue(ClienteTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.ClienteTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = ClienteQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // ClienteTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
ClienteTableMap::buildTableMap();
