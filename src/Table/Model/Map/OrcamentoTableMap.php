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
use Table\Model\Orcamento;
use Table\Model\OrcamentoQuery;


/**
 * This class defines the structure of the 'orcamento' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class OrcamentoTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'Table.Model.Map.OrcamentoTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'orcamento';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\Table\\Model\\Orcamento';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'Table.Model.Orcamento';

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
    const COL_ID = 'orcamento.id';

    /**
     * the column name for the cliente_id field
     */
    const COL_CLIENTE_ID = 'orcamento.cliente_id';

    /**
     * the column name for the email field
     */
    const COL_EMAIL = 'orcamento.email';

    /**
     * the column name for the empresa field
     */
    const COL_EMPRESA = 'orcamento.empresa';

    /**
     * the column name for the contato field
     */
    const COL_CONTATO = 'orcamento.contato';

    /**
     * the column name for the telefone field
     */
    const COL_TELEFONE = 'orcamento.telefone';

    /**
     * the column name for the data field
     */
    const COL_DATA = 'orcamento.data';

    /**
     * the column name for the data_inicio field
     */
    const COL_DATA_INICIO = 'orcamento.data_inicio';

    /**
     * the column name for the data_fim field
     */
    const COL_DATA_FIM = 'orcamento.data_fim';

    /**
     * the column name for the prazo field
     */
    const COL_PRAZO = 'orcamento.prazo';

    /**
     * the column name for the carimbo_preco field
     */
    const COL_CARIMBO_PRECO = 'orcamento.carimbo_preco';

    /**
     * the column name for the status field
     */
    const COL_STATUS = 'orcamento.status';

    /**
     * the column name for the dh_inclusao field
     */
    const COL_DH_INCLUSAO = 'orcamento.dh_inclusao';

    /**
     * the column name for the dh_alteracao field
     */
    const COL_DH_ALTERACAO = 'orcamento.dh_alteracao';

    /**
     * the column name for the user_id_inclusao field
     */
    const COL_USER_ID_INCLUSAO = 'orcamento.user_id_inclusao';

    /**
     * the column name for the user_id_alteracao field
     */
    const COL_USER_ID_ALTERACAO = 'orcamento.user_id_alteracao';

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
        self::TYPE_PHPNAME       => array('Id', 'ClienteId', 'Email', 'Empresa', 'Contato', 'Telefone', 'Data', 'DataInicio', 'DataFim', 'Prazo', 'CarimboPreco', 'Status', 'DhInclusao', 'DhAlteracao', 'UserIdInclusao', 'UserIdAlteracao', ),
        self::TYPE_CAMELNAME     => array('id', 'clienteId', 'email', 'empresa', 'contato', 'telefone', 'data', 'dataInicio', 'dataFim', 'prazo', 'carimboPreco', 'status', 'dhInclusao', 'dhAlteracao', 'userIdInclusao', 'userIdAlteracao', ),
        self::TYPE_COLNAME       => array(OrcamentoTableMap::COL_ID, OrcamentoTableMap::COL_CLIENTE_ID, OrcamentoTableMap::COL_EMAIL, OrcamentoTableMap::COL_EMPRESA, OrcamentoTableMap::COL_CONTATO, OrcamentoTableMap::COL_TELEFONE, OrcamentoTableMap::COL_DATA, OrcamentoTableMap::COL_DATA_INICIO, OrcamentoTableMap::COL_DATA_FIM, OrcamentoTableMap::COL_PRAZO, OrcamentoTableMap::COL_CARIMBO_PRECO, OrcamentoTableMap::COL_STATUS, OrcamentoTableMap::COL_DH_INCLUSAO, OrcamentoTableMap::COL_DH_ALTERACAO, OrcamentoTableMap::COL_USER_ID_INCLUSAO, OrcamentoTableMap::COL_USER_ID_ALTERACAO, ),
        self::TYPE_FIELDNAME     => array('id', 'cliente_id', 'email', 'empresa', 'contato', 'telefone', 'data', 'data_inicio', 'data_fim', 'prazo', 'carimbo_preco', 'status', 'dh_inclusao', 'dh_alteracao', 'user_id_inclusao', 'user_id_alteracao', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'ClienteId' => 1, 'Email' => 2, 'Empresa' => 3, 'Contato' => 4, 'Telefone' => 5, 'Data' => 6, 'DataInicio' => 7, 'DataFim' => 8, 'Prazo' => 9, 'CarimboPreco' => 10, 'Status' => 11, 'DhInclusao' => 12, 'DhAlteracao' => 13, 'UserIdInclusao' => 14, 'UserIdAlteracao' => 15, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'clienteId' => 1, 'email' => 2, 'empresa' => 3, 'contato' => 4, 'telefone' => 5, 'data' => 6, 'dataInicio' => 7, 'dataFim' => 8, 'prazo' => 9, 'carimboPreco' => 10, 'status' => 11, 'dhInclusao' => 12, 'dhAlteracao' => 13, 'userIdInclusao' => 14, 'userIdAlteracao' => 15, ),
        self::TYPE_COLNAME       => array(OrcamentoTableMap::COL_ID => 0, OrcamentoTableMap::COL_CLIENTE_ID => 1, OrcamentoTableMap::COL_EMAIL => 2, OrcamentoTableMap::COL_EMPRESA => 3, OrcamentoTableMap::COL_CONTATO => 4, OrcamentoTableMap::COL_TELEFONE => 5, OrcamentoTableMap::COL_DATA => 6, OrcamentoTableMap::COL_DATA_INICIO => 7, OrcamentoTableMap::COL_DATA_FIM => 8, OrcamentoTableMap::COL_PRAZO => 9, OrcamentoTableMap::COL_CARIMBO_PRECO => 10, OrcamentoTableMap::COL_STATUS => 11, OrcamentoTableMap::COL_DH_INCLUSAO => 12, OrcamentoTableMap::COL_DH_ALTERACAO => 13, OrcamentoTableMap::COL_USER_ID_INCLUSAO => 14, OrcamentoTableMap::COL_USER_ID_ALTERACAO => 15, ),
        self::TYPE_FIELDNAME     => array('id' => 0, 'cliente_id' => 1, 'email' => 2, 'empresa' => 3, 'contato' => 4, 'telefone' => 5, 'data' => 6, 'data_inicio' => 7, 'data_fim' => 8, 'prazo' => 9, 'carimbo_preco' => 10, 'status' => 11, 'dh_inclusao' => 12, 'dh_alteracao' => 13, 'user_id_inclusao' => 14, 'user_id_alteracao' => 15, ),
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
        $this->setName('orcamento');
        $this->setPhpName('Orcamento');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Table\\Model\\Orcamento');
        $this->setPackage('Table.Model');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addForeignKey('cliente_id', 'ClienteId', 'INTEGER', 'cliente', 'id', false, null, null);
        $this->addColumn('email', 'Email', 'VARCHAR', true, 80, null);
        $this->addColumn('empresa', 'Empresa', 'VARCHAR', false, 80, null);
        $this->addColumn('contato', 'Contato', 'VARCHAR', true, 80, null);
        $this->addColumn('telefone', 'Telefone', 'LONGVARCHAR', false, null, null);
        $this->addColumn('data', 'Data', 'DATE', true, null, null);
        $this->addColumn('data_inicio', 'DataInicio', 'DATE', false, null, null);
        $this->addColumn('data_fim', 'DataFim', 'DATE', false, null, null);
        $this->addColumn('prazo', 'Prazo', 'INTEGER', true, null, null);
        $this->addColumn('carimbo_preco', 'CarimboPreco', 'INTEGER', true, null, null);
        $this->addColumn('status', 'Status', 'INTEGER', true, null, null);
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
        $this->addRelation('Cliente', '\\Table\\Model\\Cliente', RelationMap::MANY_TO_ONE, array('cliente_id' => 'id', ), null, null);
        $this->addRelation('OrcamentoItem', '\\Table\\Model\\OrcamentoItem', RelationMap::ONE_TO_MANY, array('id' => 'orcamento_id', ), 'CASCADE', null, 'OrcamentoItems');
    } // buildRelations()
    /**
     * Method to invalidate the instance pool of all tables related to orcamento     * by a foreign key with ON DELETE CASCADE
     */
    public static function clearRelatedInstancePool()
    {
        // Invalidate objects in related instance pools,
        // since one or more of them may be deleted by ON DELETE CASCADE/SETNULL rule.
        OrcamentoItemTableMap::clearInstancePool();
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
        return $withPrefix ? OrcamentoTableMap::CLASS_DEFAULT : OrcamentoTableMap::OM_CLASS;
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
     * @return array           (Orcamento object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = OrcamentoTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = OrcamentoTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + OrcamentoTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = OrcamentoTableMap::OM_CLASS;
            /** @var Orcamento $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            OrcamentoTableMap::addInstanceToPool($obj, $key);
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
            $key = OrcamentoTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = OrcamentoTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Orcamento $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                OrcamentoTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(OrcamentoTableMap::COL_ID);
            $criteria->addSelectColumn(OrcamentoTableMap::COL_CLIENTE_ID);
            $criteria->addSelectColumn(OrcamentoTableMap::COL_EMAIL);
            $criteria->addSelectColumn(OrcamentoTableMap::COL_EMPRESA);
            $criteria->addSelectColumn(OrcamentoTableMap::COL_CONTATO);
            $criteria->addSelectColumn(OrcamentoTableMap::COL_TELEFONE);
            $criteria->addSelectColumn(OrcamentoTableMap::COL_DATA);
            $criteria->addSelectColumn(OrcamentoTableMap::COL_DATA_INICIO);
            $criteria->addSelectColumn(OrcamentoTableMap::COL_DATA_FIM);
            $criteria->addSelectColumn(OrcamentoTableMap::COL_PRAZO);
            $criteria->addSelectColumn(OrcamentoTableMap::COL_CARIMBO_PRECO);
            $criteria->addSelectColumn(OrcamentoTableMap::COL_STATUS);
            $criteria->addSelectColumn(OrcamentoTableMap::COL_DH_INCLUSAO);
            $criteria->addSelectColumn(OrcamentoTableMap::COL_DH_ALTERACAO);
            $criteria->addSelectColumn(OrcamentoTableMap::COL_USER_ID_INCLUSAO);
            $criteria->addSelectColumn(OrcamentoTableMap::COL_USER_ID_ALTERACAO);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.cliente_id');
            $criteria->addSelectColumn($alias . '.email');
            $criteria->addSelectColumn($alias . '.empresa');
            $criteria->addSelectColumn($alias . '.contato');
            $criteria->addSelectColumn($alias . '.telefone');
            $criteria->addSelectColumn($alias . '.data');
            $criteria->addSelectColumn($alias . '.data_inicio');
            $criteria->addSelectColumn($alias . '.data_fim');
            $criteria->addSelectColumn($alias . '.prazo');
            $criteria->addSelectColumn($alias . '.carimbo_preco');
            $criteria->addSelectColumn($alias . '.status');
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
        return Propel::getServiceContainer()->getDatabaseMap(OrcamentoTableMap::DATABASE_NAME)->getTable(OrcamentoTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(OrcamentoTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(OrcamentoTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new OrcamentoTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Orcamento or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Orcamento object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(OrcamentoTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Table\Model\Orcamento) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(OrcamentoTableMap::DATABASE_NAME);
            $criteria->add(OrcamentoTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = OrcamentoQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            OrcamentoTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                OrcamentoTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the orcamento table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return OrcamentoQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Orcamento or Criteria object.
     *
     * @param mixed               $criteria Criteria or Orcamento object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(OrcamentoTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Orcamento object
        }

        if ($criteria->containsKey(OrcamentoTableMap::COL_ID) && $criteria->keyContainsValue(OrcamentoTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.OrcamentoTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = OrcamentoQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // OrcamentoTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
OrcamentoTableMap::buildTableMap();
