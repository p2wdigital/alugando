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
    const NUM_COLUMNS = 19;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 19;

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
     * the column name for the email field
     */
    const COL_EMAIL = 'cliente.email';

    /**
     * the column name for the documento field
     */
    const COL_DOCUMENTO = 'cliente.documento';

    /**
     * the column name for the tipo_pessoa field
     */
    const COL_TIPO_PESSOA = 'cliente.tipo_pessoa';

    /**
     * the column name for the cep field
     */
    const COL_CEP = 'cliente.cep';

    /**
     * the column name for the endereco field
     */
    const COL_ENDERECO = 'cliente.endereco';

    /**
     * the column name for the numero field
     */
    const COL_NUMERO = 'cliente.numero';

    /**
     * the column name for the complemento field
     */
    const COL_COMPLEMENTO = 'cliente.complemento';

    /**
     * the column name for the bairro field
     */
    const COL_BAIRRO = 'cliente.bairro';

    /**
     * the column name for the cidade field
     */
    const COL_CIDADE = 'cliente.cidade';

    /**
     * the column name for the uf field
     */
    const COL_UF = 'cliente.uf';

    /**
     * the column name for the telefone field
     */
    const COL_TELEFONE = 'cliente.telefone';

    /**
     * the column name for the status field
     */
    const COL_STATUS = 'cliente.status';

    /**
     * the column name for the dh_inclusao field
     */
    const COL_DH_INCLUSAO = 'cliente.dh_inclusao';

    /**
     * the column name for the dh_alteracao field
     */
    const COL_DH_ALTERACAO = 'cliente.dh_alteracao';

    /**
     * the column name for the user_id_inclusao field
     */
    const COL_USER_ID_INCLUSAO = 'cliente.user_id_inclusao';

    /**
     * the column name for the user_id_alteracao field
     */
    const COL_USER_ID_ALTERACAO = 'cliente.user_id_alteracao';

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
        self::TYPE_PHPNAME       => array('Id', 'RazaoSocial', 'Contato', 'Email', 'Documento', 'TipoPessoa', 'Cep', 'Endereco', 'Numero', 'Complemento', 'Bairro', 'Cidade', 'Uf', 'Telefone', 'Status', 'DhInclusao', 'DhAlteracao', 'UserIdInclusao', 'UserIdAlteracao', ),
        self::TYPE_CAMELNAME     => array('id', 'razaoSocial', 'contato', 'email', 'documento', 'tipoPessoa', 'cep', 'endereco', 'numero', 'complemento', 'bairro', 'cidade', 'uf', 'telefone', 'status', 'dhInclusao', 'dhAlteracao', 'userIdInclusao', 'userIdAlteracao', ),
        self::TYPE_COLNAME       => array(ClienteTableMap::COL_ID, ClienteTableMap::COL_RAZAO_SOCIAL, ClienteTableMap::COL_CONTATO, ClienteTableMap::COL_EMAIL, ClienteTableMap::COL_DOCUMENTO, ClienteTableMap::COL_TIPO_PESSOA, ClienteTableMap::COL_CEP, ClienteTableMap::COL_ENDERECO, ClienteTableMap::COL_NUMERO, ClienteTableMap::COL_COMPLEMENTO, ClienteTableMap::COL_BAIRRO, ClienteTableMap::COL_CIDADE, ClienteTableMap::COL_UF, ClienteTableMap::COL_TELEFONE, ClienteTableMap::COL_STATUS, ClienteTableMap::COL_DH_INCLUSAO, ClienteTableMap::COL_DH_ALTERACAO, ClienteTableMap::COL_USER_ID_INCLUSAO, ClienteTableMap::COL_USER_ID_ALTERACAO, ),
        self::TYPE_FIELDNAME     => array('id', 'razao_social', 'contato', 'email', 'documento', 'tipo_pessoa', 'cep', 'endereco', 'numero', 'complemento', 'bairro', 'cidade', 'uf', 'telefone', 'status', 'dh_inclusao', 'dh_alteracao', 'user_id_inclusao', 'user_id_alteracao', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'RazaoSocial' => 1, 'Contato' => 2, 'Email' => 3, 'Documento' => 4, 'TipoPessoa' => 5, 'Cep' => 6, 'Endereco' => 7, 'Numero' => 8, 'Complemento' => 9, 'Bairro' => 10, 'Cidade' => 11, 'Uf' => 12, 'Telefone' => 13, 'Status' => 14, 'DhInclusao' => 15, 'DhAlteracao' => 16, 'UserIdInclusao' => 17, 'UserIdAlteracao' => 18, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'razaoSocial' => 1, 'contato' => 2, 'email' => 3, 'documento' => 4, 'tipoPessoa' => 5, 'cep' => 6, 'endereco' => 7, 'numero' => 8, 'complemento' => 9, 'bairro' => 10, 'cidade' => 11, 'uf' => 12, 'telefone' => 13, 'status' => 14, 'dhInclusao' => 15, 'dhAlteracao' => 16, 'userIdInclusao' => 17, 'userIdAlteracao' => 18, ),
        self::TYPE_COLNAME       => array(ClienteTableMap::COL_ID => 0, ClienteTableMap::COL_RAZAO_SOCIAL => 1, ClienteTableMap::COL_CONTATO => 2, ClienteTableMap::COL_EMAIL => 3, ClienteTableMap::COL_DOCUMENTO => 4, ClienteTableMap::COL_TIPO_PESSOA => 5, ClienteTableMap::COL_CEP => 6, ClienteTableMap::COL_ENDERECO => 7, ClienteTableMap::COL_NUMERO => 8, ClienteTableMap::COL_COMPLEMENTO => 9, ClienteTableMap::COL_BAIRRO => 10, ClienteTableMap::COL_CIDADE => 11, ClienteTableMap::COL_UF => 12, ClienteTableMap::COL_TELEFONE => 13, ClienteTableMap::COL_STATUS => 14, ClienteTableMap::COL_DH_INCLUSAO => 15, ClienteTableMap::COL_DH_ALTERACAO => 16, ClienteTableMap::COL_USER_ID_INCLUSAO => 17, ClienteTableMap::COL_USER_ID_ALTERACAO => 18, ),
        self::TYPE_FIELDNAME     => array('id' => 0, 'razao_social' => 1, 'contato' => 2, 'email' => 3, 'documento' => 4, 'tipo_pessoa' => 5, 'cep' => 6, 'endereco' => 7, 'numero' => 8, 'complemento' => 9, 'bairro' => 10, 'cidade' => 11, 'uf' => 12, 'telefone' => 13, 'status' => 14, 'dh_inclusao' => 15, 'dh_alteracao' => 16, 'user_id_inclusao' => 17, 'user_id_alteracao' => 18, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, )
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
        $this->addColumn('razao_social', 'RazaoSocial', 'VARCHAR', true, 100, null);
        $this->addColumn('contato', 'Contato', 'VARCHAR', true, 100, null);
        $this->addColumn('email', 'Email', 'VARCHAR', true, 80, null);
        $this->addColumn('documento', 'Documento', 'VARCHAR', true, 14, null);
        $this->addColumn('tipo_pessoa', 'TipoPessoa', 'VARCHAR', true, 1, null);
        $this->addColumn('cep', 'Cep', 'VARCHAR', true, 8, null);
        $this->addColumn('endereco', 'Endereco', 'VARCHAR', true, 100, null);
        $this->addColumn('numero', 'Numero', 'INTEGER', true, null, null);
        $this->addColumn('complemento', 'Complemento', 'VARCHAR', false, 80, null);
        $this->addColumn('bairro', 'Bairro', 'VARCHAR', true, 45, null);
        $this->addColumn('cidade', 'Cidade', 'VARCHAR', true, 80, null);
        $this->addColumn('uf', 'Uf', 'VARCHAR', true, 2, null);
        $this->addColumn('telefone', 'Telefone', 'LONGVARCHAR', false, null, null);
        $this->addColumn('status', 'Status', 'INTEGER', false, null, null);
        $this->addColumn('dh_inclusao', 'DhInclusao', 'TIMESTAMP', false, null, null);
        $this->addColumn('dh_alteracao', 'DhAlteracao', 'TIMESTAMP', false, null, null);
        $this->addForeignKey('user_id_inclusao', 'UserIdInclusao', 'INTEGER', 'user', 'id', true, null, null);
        $this->addForeignKey('user_id_alteracao', 'UserIdAlteracao', 'INTEGER', 'user', 'id', true, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('UserRelatedByUserIdInclusao', '\\Table\\Model\\User', RelationMap::MANY_TO_ONE, array('user_id_inclusao' => 'id', ), null, null);
        $this->addRelation('UserRelatedByUserIdAlteracao', '\\Table\\Model\\User', RelationMap::MANY_TO_ONE, array('user_id_alteracao' => 'id', ), null, null);
        $this->addRelation('Orcamento', '\\Table\\Model\\Orcamento', RelationMap::ONE_TO_MANY, array('id' => 'cliente_id', ), null, null, 'Orcamentos');
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
            $criteria->addSelectColumn(ClienteTableMap::COL_EMAIL);
            $criteria->addSelectColumn(ClienteTableMap::COL_DOCUMENTO);
            $criteria->addSelectColumn(ClienteTableMap::COL_TIPO_PESSOA);
            $criteria->addSelectColumn(ClienteTableMap::COL_CEP);
            $criteria->addSelectColumn(ClienteTableMap::COL_ENDERECO);
            $criteria->addSelectColumn(ClienteTableMap::COL_NUMERO);
            $criteria->addSelectColumn(ClienteTableMap::COL_COMPLEMENTO);
            $criteria->addSelectColumn(ClienteTableMap::COL_BAIRRO);
            $criteria->addSelectColumn(ClienteTableMap::COL_CIDADE);
            $criteria->addSelectColumn(ClienteTableMap::COL_UF);
            $criteria->addSelectColumn(ClienteTableMap::COL_TELEFONE);
            $criteria->addSelectColumn(ClienteTableMap::COL_STATUS);
            $criteria->addSelectColumn(ClienteTableMap::COL_DH_INCLUSAO);
            $criteria->addSelectColumn(ClienteTableMap::COL_DH_ALTERACAO);
            $criteria->addSelectColumn(ClienteTableMap::COL_USER_ID_INCLUSAO);
            $criteria->addSelectColumn(ClienteTableMap::COL_USER_ID_ALTERACAO);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.razao_social');
            $criteria->addSelectColumn($alias . '.contato');
            $criteria->addSelectColumn($alias . '.email');
            $criteria->addSelectColumn($alias . '.documento');
            $criteria->addSelectColumn($alias . '.tipo_pessoa');
            $criteria->addSelectColumn($alias . '.cep');
            $criteria->addSelectColumn($alias . '.endereco');
            $criteria->addSelectColumn($alias . '.numero');
            $criteria->addSelectColumn($alias . '.complemento');
            $criteria->addSelectColumn($alias . '.bairro');
            $criteria->addSelectColumn($alias . '.cidade');
            $criteria->addSelectColumn($alias . '.uf');
            $criteria->addSelectColumn($alias . '.telefone');
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
