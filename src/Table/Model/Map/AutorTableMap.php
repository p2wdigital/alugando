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
use Table\Model\Autor;
use Table\Model\AutorQuery;


/**
 * This class defines the structure of the 'autor' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class AutorTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'Table.Model.Map.AutorTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'autor';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\Table\\Model\\Autor';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'Table.Model.Autor';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 10;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 10;

    /**
     * the column name for the id field
     */
    const COL_ID = 'autor.id';

    /**
     * the column name for the nome field
     */
    const COL_NOME = 'autor.nome';

    /**
     * the column name for the email field
     */
    const COL_EMAIL = 'autor.email';

    /**
     * the column name for the usuario field
     */
    const COL_USUARIO = 'autor.usuario';

    /**
     * the column name for the senha field
     */
    const COL_SENHA = 'autor.senha';

    /**
     * the column name for the salt field
     */
    const COL_SALT = 'autor.salt';

    /**
     * the column name for the descricao field
     */
    const COL_DESCRICAO = 'autor.descricao';

    /**
     * the column name for the dados field
     */
    const COL_DADOS = 'autor.dados';

    /**
     * the column name for the dh_inclusao field
     */
    const COL_DH_INCLUSAO = 'autor.dh_inclusao';

    /**
     * the column name for the dh_alteracao field
     */
    const COL_DH_ALTERACAO = 'autor.dh_alteracao';

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
        self::TYPE_PHPNAME       => array('Id', 'Nome', 'Email', 'Usuario', 'Senha', 'Salt', 'Descricao', 'Dados', 'DhInclusao', 'DhAlteracao', ),
        self::TYPE_CAMELNAME     => array('id', 'nome', 'email', 'usuario', 'senha', 'salt', 'descricao', 'dados', 'dhInclusao', 'dhAlteracao', ),
        self::TYPE_COLNAME       => array(AutorTableMap::COL_ID, AutorTableMap::COL_NOME, AutorTableMap::COL_EMAIL, AutorTableMap::COL_USUARIO, AutorTableMap::COL_SENHA, AutorTableMap::COL_SALT, AutorTableMap::COL_DESCRICAO, AutorTableMap::COL_DADOS, AutorTableMap::COL_DH_INCLUSAO, AutorTableMap::COL_DH_ALTERACAO, ),
        self::TYPE_FIELDNAME     => array('id', 'nome', 'email', 'usuario', 'senha', 'salt', 'descricao', 'dados', 'dh_inclusao', 'dh_alteracao', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'Nome' => 1, 'Email' => 2, 'Usuario' => 3, 'Senha' => 4, 'Salt' => 5, 'Descricao' => 6, 'Dados' => 7, 'DhInclusao' => 8, 'DhAlteracao' => 9, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'nome' => 1, 'email' => 2, 'usuario' => 3, 'senha' => 4, 'salt' => 5, 'descricao' => 6, 'dados' => 7, 'dhInclusao' => 8, 'dhAlteracao' => 9, ),
        self::TYPE_COLNAME       => array(AutorTableMap::COL_ID => 0, AutorTableMap::COL_NOME => 1, AutorTableMap::COL_EMAIL => 2, AutorTableMap::COL_USUARIO => 3, AutorTableMap::COL_SENHA => 4, AutorTableMap::COL_SALT => 5, AutorTableMap::COL_DESCRICAO => 6, AutorTableMap::COL_DADOS => 7, AutorTableMap::COL_DH_INCLUSAO => 8, AutorTableMap::COL_DH_ALTERACAO => 9, ),
        self::TYPE_FIELDNAME     => array('id' => 0, 'nome' => 1, 'email' => 2, 'usuario' => 3, 'senha' => 4, 'salt' => 5, 'descricao' => 6, 'dados' => 7, 'dh_inclusao' => 8, 'dh_alteracao' => 9, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, )
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
        $this->setName('autor');
        $this->setPhpName('Autor');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Table\\Model\\Autor');
        $this->setPackage('Table.Model');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('nome', 'Nome', 'VARCHAR', false, 100, null);
        $this->addColumn('email', 'Email', 'VARCHAR', false, 100, null);
        $this->addColumn('usuario', 'Usuario', 'VARCHAR', false, 45, null);
        $this->addColumn('senha', 'Senha', 'LONGVARCHAR', false, null, null);
        $this->addColumn('salt', 'Salt', 'LONGVARCHAR', false, null, null);
        $this->addColumn('descricao', 'Descricao', 'LONGVARCHAR', false, null, null);
        $this->addColumn('dados', 'Dados', 'LONGVARCHAR', false, null, null);
        $this->addColumn('dh_inclusao', 'DhInclusao', 'VARCHAR', false, 255, null);
        $this->addColumn('dh_alteracao', 'DhAlteracao', 'VARCHAR', false, 255, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Page', '\\Table\\Model\\Page', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':autor_id',
    1 => ':id',
  ),
), null, null, 'Pages', false);
        $this->addRelation('Post', '\\Table\\Model\\Post', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':autor_id',
    1 => ':id',
  ),
), null, null, 'Posts', false);
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
        return $withPrefix ? AutorTableMap::CLASS_DEFAULT : AutorTableMap::OM_CLASS;
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
     * @return array           (Autor object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = AutorTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = AutorTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + AutorTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = AutorTableMap::OM_CLASS;
            /** @var Autor $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            AutorTableMap::addInstanceToPool($obj, $key);
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
            $key = AutorTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = AutorTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Autor $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                AutorTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(AutorTableMap::COL_ID);
            $criteria->addSelectColumn(AutorTableMap::COL_NOME);
            $criteria->addSelectColumn(AutorTableMap::COL_EMAIL);
            $criteria->addSelectColumn(AutorTableMap::COL_USUARIO);
            $criteria->addSelectColumn(AutorTableMap::COL_SENHA);
            $criteria->addSelectColumn(AutorTableMap::COL_SALT);
            $criteria->addSelectColumn(AutorTableMap::COL_DESCRICAO);
            $criteria->addSelectColumn(AutorTableMap::COL_DADOS);
            $criteria->addSelectColumn(AutorTableMap::COL_DH_INCLUSAO);
            $criteria->addSelectColumn(AutorTableMap::COL_DH_ALTERACAO);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.nome');
            $criteria->addSelectColumn($alias . '.email');
            $criteria->addSelectColumn($alias . '.usuario');
            $criteria->addSelectColumn($alias . '.senha');
            $criteria->addSelectColumn($alias . '.salt');
            $criteria->addSelectColumn($alias . '.descricao');
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
        return Propel::getServiceContainer()->getDatabaseMap(AutorTableMap::DATABASE_NAME)->getTable(AutorTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(AutorTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(AutorTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new AutorTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Autor or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Autor object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(AutorTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Table\Model\Autor) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(AutorTableMap::DATABASE_NAME);
            $criteria->add(AutorTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = AutorQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            AutorTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                AutorTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the autor table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return AutorQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Autor or Criteria object.
     *
     * @param mixed               $criteria Criteria or Autor object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(AutorTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Autor object
        }

        if ($criteria->containsKey(AutorTableMap::COL_ID) && $criteria->keyContainsValue(AutorTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.AutorTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = AutorQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // AutorTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
AutorTableMap::buildTableMap();
