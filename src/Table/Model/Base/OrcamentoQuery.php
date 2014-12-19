<?php

namespace Table\Model\Base;

use \Exception;
use \PDO;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;
use Table\Model\Orcamento as ChildOrcamento;
use Table\Model\OrcamentoQuery as ChildOrcamentoQuery;
use Table\Model\Map\OrcamentoTableMap;

/**
 * Base class that represents a query for the 'orcamento' table.
 *
 * 
 *
 * @method     ChildOrcamentoQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildOrcamentoQuery orderByClienteId($order = Criteria::ASC) Order by the cliente_id column
 * @method     ChildOrcamentoQuery orderByEmail($order = Criteria::ASC) Order by the email column
 * @method     ChildOrcamentoQuery orderByEmpresa($order = Criteria::ASC) Order by the empresa column
 * @method     ChildOrcamentoQuery orderByContato($order = Criteria::ASC) Order by the contato column
 * @method     ChildOrcamentoQuery orderByTelefone($order = Criteria::ASC) Order by the telefone column
 * @method     ChildOrcamentoQuery orderByData($order = Criteria::ASC) Order by the data column
 * @method     ChildOrcamentoQuery orderByDataInicio($order = Criteria::ASC) Order by the data_inicio column
 * @method     ChildOrcamentoQuery orderByDataFim($order = Criteria::ASC) Order by the data_fim column
 * @method     ChildOrcamentoQuery orderByPrazo($order = Criteria::ASC) Order by the prazo column
 * @method     ChildOrcamentoQuery orderByCarimboPreco($order = Criteria::ASC) Order by the carimbo_preco column
 * @method     ChildOrcamentoQuery orderByStatus($order = Criteria::ASC) Order by the status column
 * @method     ChildOrcamentoQuery orderByDhInclusao($order = Criteria::ASC) Order by the dh_inclusao column
 * @method     ChildOrcamentoQuery orderByDhAlteracao($order = Criteria::ASC) Order by the dh_alteracao column
 * @method     ChildOrcamentoQuery orderByUserIdInclusao($order = Criteria::ASC) Order by the user_id_inclusao column
 * @method     ChildOrcamentoQuery orderByUserIdAlteracao($order = Criteria::ASC) Order by the user_id_alteracao column
 *
 * @method     ChildOrcamentoQuery groupById() Group by the id column
 * @method     ChildOrcamentoQuery groupByClienteId() Group by the cliente_id column
 * @method     ChildOrcamentoQuery groupByEmail() Group by the email column
 * @method     ChildOrcamentoQuery groupByEmpresa() Group by the empresa column
 * @method     ChildOrcamentoQuery groupByContato() Group by the contato column
 * @method     ChildOrcamentoQuery groupByTelefone() Group by the telefone column
 * @method     ChildOrcamentoQuery groupByData() Group by the data column
 * @method     ChildOrcamentoQuery groupByDataInicio() Group by the data_inicio column
 * @method     ChildOrcamentoQuery groupByDataFim() Group by the data_fim column
 * @method     ChildOrcamentoQuery groupByPrazo() Group by the prazo column
 * @method     ChildOrcamentoQuery groupByCarimboPreco() Group by the carimbo_preco column
 * @method     ChildOrcamentoQuery groupByStatus() Group by the status column
 * @method     ChildOrcamentoQuery groupByDhInclusao() Group by the dh_inclusao column
 * @method     ChildOrcamentoQuery groupByDhAlteracao() Group by the dh_alteracao column
 * @method     ChildOrcamentoQuery groupByUserIdInclusao() Group by the user_id_inclusao column
 * @method     ChildOrcamentoQuery groupByUserIdAlteracao() Group by the user_id_alteracao column
 *
 * @method     ChildOrcamentoQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildOrcamentoQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildOrcamentoQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildOrcamentoQuery leftJoinCliente($relationAlias = null) Adds a LEFT JOIN clause to the query using the Cliente relation
 * @method     ChildOrcamentoQuery rightJoinCliente($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Cliente relation
 * @method     ChildOrcamentoQuery innerJoinCliente($relationAlias = null) Adds a INNER JOIN clause to the query using the Cliente relation
 *
 * @method     ChildOrcamentoQuery leftJoinOrcamentoItem($relationAlias = null) Adds a LEFT JOIN clause to the query using the OrcamentoItem relation
 * @method     ChildOrcamentoQuery rightJoinOrcamentoItem($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OrcamentoItem relation
 * @method     ChildOrcamentoQuery innerJoinOrcamentoItem($relationAlias = null) Adds a INNER JOIN clause to the query using the OrcamentoItem relation
 *
 * @method     \Table\Model\ClienteQuery|\Table\Model\OrcamentoItemQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildOrcamento findOne(ConnectionInterface $con = null) Return the first ChildOrcamento matching the query
 * @method     ChildOrcamento findOneOrCreate(ConnectionInterface $con = null) Return the first ChildOrcamento matching the query, or a new ChildOrcamento object populated from the query conditions when no match is found
 *
 * @method     ChildOrcamento findOneById(int $id) Return the first ChildOrcamento filtered by the id column
 * @method     ChildOrcamento findOneByClienteId(int $cliente_id) Return the first ChildOrcamento filtered by the cliente_id column
 * @method     ChildOrcamento findOneByEmail(string $email) Return the first ChildOrcamento filtered by the email column
 * @method     ChildOrcamento findOneByEmpresa(string $empresa) Return the first ChildOrcamento filtered by the empresa column
 * @method     ChildOrcamento findOneByContato(string $contato) Return the first ChildOrcamento filtered by the contato column
 * @method     ChildOrcamento findOneByTelefone(string $telefone) Return the first ChildOrcamento filtered by the telefone column
 * @method     ChildOrcamento findOneByData(string $data) Return the first ChildOrcamento filtered by the data column
 * @method     ChildOrcamento findOneByDataInicio(string $data_inicio) Return the first ChildOrcamento filtered by the data_inicio column
 * @method     ChildOrcamento findOneByDataFim(string $data_fim) Return the first ChildOrcamento filtered by the data_fim column
 * @method     ChildOrcamento findOneByPrazo(int $prazo) Return the first ChildOrcamento filtered by the prazo column
 * @method     ChildOrcamento findOneByCarimboPreco(int $carimbo_preco) Return the first ChildOrcamento filtered by the carimbo_preco column
 * @method     ChildOrcamento findOneByStatus(int $status) Return the first ChildOrcamento filtered by the status column
 * @method     ChildOrcamento findOneByDhInclusao(string $dh_inclusao) Return the first ChildOrcamento filtered by the dh_inclusao column
 * @method     ChildOrcamento findOneByDhAlteracao(string $dh_alteracao) Return the first ChildOrcamento filtered by the dh_alteracao column
 * @method     ChildOrcamento findOneByUserIdInclusao(int $user_id_inclusao) Return the first ChildOrcamento filtered by the user_id_inclusao column
 * @method     ChildOrcamento findOneByUserIdAlteracao(int $user_id_alteracao) Return the first ChildOrcamento filtered by the user_id_alteracao column
 *
 * @method     ChildOrcamento[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildOrcamento objects based on current ModelCriteria
 * @method     ChildOrcamento[]|ObjectCollection findById(int $id) Return ChildOrcamento objects filtered by the id column
 * @method     ChildOrcamento[]|ObjectCollection findByClienteId(int $cliente_id) Return ChildOrcamento objects filtered by the cliente_id column
 * @method     ChildOrcamento[]|ObjectCollection findByEmail(string $email) Return ChildOrcamento objects filtered by the email column
 * @method     ChildOrcamento[]|ObjectCollection findByEmpresa(string $empresa) Return ChildOrcamento objects filtered by the empresa column
 * @method     ChildOrcamento[]|ObjectCollection findByContato(string $contato) Return ChildOrcamento objects filtered by the contato column
 * @method     ChildOrcamento[]|ObjectCollection findByTelefone(string $telefone) Return ChildOrcamento objects filtered by the telefone column
 * @method     ChildOrcamento[]|ObjectCollection findByData(string $data) Return ChildOrcamento objects filtered by the data column
 * @method     ChildOrcamento[]|ObjectCollection findByDataInicio(string $data_inicio) Return ChildOrcamento objects filtered by the data_inicio column
 * @method     ChildOrcamento[]|ObjectCollection findByDataFim(string $data_fim) Return ChildOrcamento objects filtered by the data_fim column
 * @method     ChildOrcamento[]|ObjectCollection findByPrazo(int $prazo) Return ChildOrcamento objects filtered by the prazo column
 * @method     ChildOrcamento[]|ObjectCollection findByCarimboPreco(int $carimbo_preco) Return ChildOrcamento objects filtered by the carimbo_preco column
 * @method     ChildOrcamento[]|ObjectCollection findByStatus(int $status) Return ChildOrcamento objects filtered by the status column
 * @method     ChildOrcamento[]|ObjectCollection findByDhInclusao(string $dh_inclusao) Return ChildOrcamento objects filtered by the dh_inclusao column
 * @method     ChildOrcamento[]|ObjectCollection findByDhAlteracao(string $dh_alteracao) Return ChildOrcamento objects filtered by the dh_alteracao column
 * @method     ChildOrcamento[]|ObjectCollection findByUserIdInclusao(int $user_id_inclusao) Return ChildOrcamento objects filtered by the user_id_inclusao column
 * @method     ChildOrcamento[]|ObjectCollection findByUserIdAlteracao(int $user_id_alteracao) Return ChildOrcamento objects filtered by the user_id_alteracao column
 * @method     ChildOrcamento[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class OrcamentoQuery extends ModelCriteria
{
    
    /**
     * Initializes internal state of \Table\Model\Base\OrcamentoQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Table\\Model\\Orcamento', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildOrcamentoQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildOrcamentoQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildOrcamentoQuery) {
            return $criteria;
        }
        $query = new ChildOrcamentoQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildOrcamento|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = OrcamentoTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(OrcamentoTableMap::DATABASE_NAME);
        }
        $this->basePreSelect($con);
        if ($this->formatter || $this->modelAlias || $this->with || $this->select
         || $this->selectColumns || $this->asColumns || $this->selectModifiers
         || $this->map || $this->having || $this->joins) {
            return $this->findPkComplex($key, $con);
        } else {
            return $this->findPkSimple($key, $con);
        }
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildOrcamento A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, cliente_id, email, empresa, contato, telefone, data, data_inicio, data_fim, prazo, carimbo_preco, status, dh_inclusao, dh_alteracao, user_id_inclusao, user_id_alteracao FROM orcamento WHERE id = :p0';
        try {
            $stmt = $con->prepare($sql);            
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildOrcamento $obj */
            $obj = new ChildOrcamento();
            $obj->hydrate($row);
            OrcamentoTableMap::addInstanceToPool($obj, (string) $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @return ChildOrcamento|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, ConnectionInterface $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($dataFetcher);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return ObjectCollection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($dataFetcher);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return $this|ChildOrcamentoQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(OrcamentoTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildOrcamentoQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(OrcamentoTableMap::COL_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE id = 1234
     * $query->filterById(array(12, 34)); // WHERE id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE id > 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOrcamentoQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(OrcamentoTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(OrcamentoTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OrcamentoTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the cliente_id column
     *
     * Example usage:
     * <code>
     * $query->filterByClienteId(1234); // WHERE cliente_id = 1234
     * $query->filterByClienteId(array(12, 34)); // WHERE cliente_id IN (12, 34)
     * $query->filterByClienteId(array('min' => 12)); // WHERE cliente_id > 12
     * </code>
     *
     * @see       filterByCliente()
     *
     * @param     mixed $clienteId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOrcamentoQuery The current query, for fluid interface
     */
    public function filterByClienteId($clienteId = null, $comparison = null)
    {
        if (is_array($clienteId)) {
            $useMinMax = false;
            if (isset($clienteId['min'])) {
                $this->addUsingAlias(OrcamentoTableMap::COL_CLIENTE_ID, $clienteId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($clienteId['max'])) {
                $this->addUsingAlias(OrcamentoTableMap::COL_CLIENTE_ID, $clienteId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OrcamentoTableMap::COL_CLIENTE_ID, $clienteId, $comparison);
    }

    /**
     * Filter the query on the email column
     *
     * Example usage:
     * <code>
     * $query->filterByEmail('fooValue');   // WHERE email = 'fooValue'
     * $query->filterByEmail('%fooValue%'); // WHERE email LIKE '%fooValue%'
     * </code>
     *
     * @param     string $email The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOrcamentoQuery The current query, for fluid interface
     */
    public function filterByEmail($email = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($email)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $email)) {
                $email = str_replace('*', '%', $email);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(OrcamentoTableMap::COL_EMAIL, $email, $comparison);
    }

    /**
     * Filter the query on the empresa column
     *
     * Example usage:
     * <code>
     * $query->filterByEmpresa('fooValue');   // WHERE empresa = 'fooValue'
     * $query->filterByEmpresa('%fooValue%'); // WHERE empresa LIKE '%fooValue%'
     * </code>
     *
     * @param     string $empresa The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOrcamentoQuery The current query, for fluid interface
     */
    public function filterByEmpresa($empresa = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($empresa)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $empresa)) {
                $empresa = str_replace('*', '%', $empresa);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(OrcamentoTableMap::COL_EMPRESA, $empresa, $comparison);
    }

    /**
     * Filter the query on the contato column
     *
     * Example usage:
     * <code>
     * $query->filterByContato('fooValue');   // WHERE contato = 'fooValue'
     * $query->filterByContato('%fooValue%'); // WHERE contato LIKE '%fooValue%'
     * </code>
     *
     * @param     string $contato The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOrcamentoQuery The current query, for fluid interface
     */
    public function filterByContato($contato = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($contato)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $contato)) {
                $contato = str_replace('*', '%', $contato);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(OrcamentoTableMap::COL_CONTATO, $contato, $comparison);
    }

    /**
     * Filter the query on the telefone column
     *
     * Example usage:
     * <code>
     * $query->filterByTelefone('fooValue');   // WHERE telefone = 'fooValue'
     * $query->filterByTelefone('%fooValue%'); // WHERE telefone LIKE '%fooValue%'
     * </code>
     *
     * @param     string $telefone The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOrcamentoQuery The current query, for fluid interface
     */
    public function filterByTelefone($telefone = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($telefone)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $telefone)) {
                $telefone = str_replace('*', '%', $telefone);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(OrcamentoTableMap::COL_TELEFONE, $telefone, $comparison);
    }

    /**
     * Filter the query on the data column
     *
     * Example usage:
     * <code>
     * $query->filterByData('2011-03-14'); // WHERE data = '2011-03-14'
     * $query->filterByData('now'); // WHERE data = '2011-03-14'
     * $query->filterByData(array('max' => 'yesterday')); // WHERE data > '2011-03-13'
     * </code>
     *
     * @param     mixed $data The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOrcamentoQuery The current query, for fluid interface
     */
    public function filterByData($data = null, $comparison = null)
    {
        if (is_array($data)) {
            $useMinMax = false;
            if (isset($data['min'])) {
                $this->addUsingAlias(OrcamentoTableMap::COL_DATA, $data['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($data['max'])) {
                $this->addUsingAlias(OrcamentoTableMap::COL_DATA, $data['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OrcamentoTableMap::COL_DATA, $data, $comparison);
    }

    /**
     * Filter the query on the data_inicio column
     *
     * Example usage:
     * <code>
     * $query->filterByDataInicio('2011-03-14'); // WHERE data_inicio = '2011-03-14'
     * $query->filterByDataInicio('now'); // WHERE data_inicio = '2011-03-14'
     * $query->filterByDataInicio(array('max' => 'yesterday')); // WHERE data_inicio > '2011-03-13'
     * </code>
     *
     * @param     mixed $dataInicio The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOrcamentoQuery The current query, for fluid interface
     */
    public function filterByDataInicio($dataInicio = null, $comparison = null)
    {
        if (is_array($dataInicio)) {
            $useMinMax = false;
            if (isset($dataInicio['min'])) {
                $this->addUsingAlias(OrcamentoTableMap::COL_DATA_INICIO, $dataInicio['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($dataInicio['max'])) {
                $this->addUsingAlias(OrcamentoTableMap::COL_DATA_INICIO, $dataInicio['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OrcamentoTableMap::COL_DATA_INICIO, $dataInicio, $comparison);
    }

    /**
     * Filter the query on the data_fim column
     *
     * Example usage:
     * <code>
     * $query->filterByDataFim('2011-03-14'); // WHERE data_fim = '2011-03-14'
     * $query->filterByDataFim('now'); // WHERE data_fim = '2011-03-14'
     * $query->filterByDataFim(array('max' => 'yesterday')); // WHERE data_fim > '2011-03-13'
     * </code>
     *
     * @param     mixed $dataFim The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOrcamentoQuery The current query, for fluid interface
     */
    public function filterByDataFim($dataFim = null, $comparison = null)
    {
        if (is_array($dataFim)) {
            $useMinMax = false;
            if (isset($dataFim['min'])) {
                $this->addUsingAlias(OrcamentoTableMap::COL_DATA_FIM, $dataFim['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($dataFim['max'])) {
                $this->addUsingAlias(OrcamentoTableMap::COL_DATA_FIM, $dataFim['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OrcamentoTableMap::COL_DATA_FIM, $dataFim, $comparison);
    }

    /**
     * Filter the query on the prazo column
     *
     * Example usage:
     * <code>
     * $query->filterByPrazo(1234); // WHERE prazo = 1234
     * $query->filterByPrazo(array(12, 34)); // WHERE prazo IN (12, 34)
     * $query->filterByPrazo(array('min' => 12)); // WHERE prazo > 12
     * </code>
     *
     * @param     mixed $prazo The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOrcamentoQuery The current query, for fluid interface
     */
    public function filterByPrazo($prazo = null, $comparison = null)
    {
        if (is_array($prazo)) {
            $useMinMax = false;
            if (isset($prazo['min'])) {
                $this->addUsingAlias(OrcamentoTableMap::COL_PRAZO, $prazo['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($prazo['max'])) {
                $this->addUsingAlias(OrcamentoTableMap::COL_PRAZO, $prazo['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OrcamentoTableMap::COL_PRAZO, $prazo, $comparison);
    }

    /**
     * Filter the query on the carimbo_preco column
     *
     * Example usage:
     * <code>
     * $query->filterByCarimboPreco(1234); // WHERE carimbo_preco = 1234
     * $query->filterByCarimboPreco(array(12, 34)); // WHERE carimbo_preco IN (12, 34)
     * $query->filterByCarimboPreco(array('min' => 12)); // WHERE carimbo_preco > 12
     * </code>
     *
     * @param     mixed $carimboPreco The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOrcamentoQuery The current query, for fluid interface
     */
    public function filterByCarimboPreco($carimboPreco = null, $comparison = null)
    {
        if (is_array($carimboPreco)) {
            $useMinMax = false;
            if (isset($carimboPreco['min'])) {
                $this->addUsingAlias(OrcamentoTableMap::COL_CARIMBO_PRECO, $carimboPreco['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($carimboPreco['max'])) {
                $this->addUsingAlias(OrcamentoTableMap::COL_CARIMBO_PRECO, $carimboPreco['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OrcamentoTableMap::COL_CARIMBO_PRECO, $carimboPreco, $comparison);
    }

    /**
     * Filter the query on the status column
     *
     * Example usage:
     * <code>
     * $query->filterByStatus(1234); // WHERE status = 1234
     * $query->filterByStatus(array(12, 34)); // WHERE status IN (12, 34)
     * $query->filterByStatus(array('min' => 12)); // WHERE status > 12
     * </code>
     *
     * @param     mixed $status The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOrcamentoQuery The current query, for fluid interface
     */
    public function filterByStatus($status = null, $comparison = null)
    {
        if (is_array($status)) {
            $useMinMax = false;
            if (isset($status['min'])) {
                $this->addUsingAlias(OrcamentoTableMap::COL_STATUS, $status['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($status['max'])) {
                $this->addUsingAlias(OrcamentoTableMap::COL_STATUS, $status['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OrcamentoTableMap::COL_STATUS, $status, $comparison);
    }

    /**
     * Filter the query on the dh_inclusao column
     *
     * Example usage:
     * <code>
     * $query->filterByDhInclusao('2011-03-14'); // WHERE dh_inclusao = '2011-03-14'
     * $query->filterByDhInclusao('now'); // WHERE dh_inclusao = '2011-03-14'
     * $query->filterByDhInclusao(array('max' => 'yesterday')); // WHERE dh_inclusao > '2011-03-13'
     * </code>
     *
     * @param     mixed $dhInclusao The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOrcamentoQuery The current query, for fluid interface
     */
    public function filterByDhInclusao($dhInclusao = null, $comparison = null)
    {
        if (is_array($dhInclusao)) {
            $useMinMax = false;
            if (isset($dhInclusao['min'])) {
                $this->addUsingAlias(OrcamentoTableMap::COL_DH_INCLUSAO, $dhInclusao['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($dhInclusao['max'])) {
                $this->addUsingAlias(OrcamentoTableMap::COL_DH_INCLUSAO, $dhInclusao['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OrcamentoTableMap::COL_DH_INCLUSAO, $dhInclusao, $comparison);
    }

    /**
     * Filter the query on the dh_alteracao column
     *
     * Example usage:
     * <code>
     * $query->filterByDhAlteracao('2011-03-14'); // WHERE dh_alteracao = '2011-03-14'
     * $query->filterByDhAlteracao('now'); // WHERE dh_alteracao = '2011-03-14'
     * $query->filterByDhAlteracao(array('max' => 'yesterday')); // WHERE dh_alteracao > '2011-03-13'
     * </code>
     *
     * @param     mixed $dhAlteracao The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOrcamentoQuery The current query, for fluid interface
     */
    public function filterByDhAlteracao($dhAlteracao = null, $comparison = null)
    {
        if (is_array($dhAlteracao)) {
            $useMinMax = false;
            if (isset($dhAlteracao['min'])) {
                $this->addUsingAlias(OrcamentoTableMap::COL_DH_ALTERACAO, $dhAlteracao['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($dhAlteracao['max'])) {
                $this->addUsingAlias(OrcamentoTableMap::COL_DH_ALTERACAO, $dhAlteracao['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OrcamentoTableMap::COL_DH_ALTERACAO, $dhAlteracao, $comparison);
    }

    /**
     * Filter the query on the user_id_inclusao column
     *
     * Example usage:
     * <code>
     * $query->filterByUserIdInclusao(1234); // WHERE user_id_inclusao = 1234
     * $query->filterByUserIdInclusao(array(12, 34)); // WHERE user_id_inclusao IN (12, 34)
     * $query->filterByUserIdInclusao(array('min' => 12)); // WHERE user_id_inclusao > 12
     * </code>
     *
     * @param     mixed $userIdInclusao The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOrcamentoQuery The current query, for fluid interface
     */
    public function filterByUserIdInclusao($userIdInclusao = null, $comparison = null)
    {
        if (is_array($userIdInclusao)) {
            $useMinMax = false;
            if (isset($userIdInclusao['min'])) {
                $this->addUsingAlias(OrcamentoTableMap::COL_USER_ID_INCLUSAO, $userIdInclusao['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($userIdInclusao['max'])) {
                $this->addUsingAlias(OrcamentoTableMap::COL_USER_ID_INCLUSAO, $userIdInclusao['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OrcamentoTableMap::COL_USER_ID_INCLUSAO, $userIdInclusao, $comparison);
    }

    /**
     * Filter the query on the user_id_alteracao column
     *
     * Example usage:
     * <code>
     * $query->filterByUserIdAlteracao(1234); // WHERE user_id_alteracao = 1234
     * $query->filterByUserIdAlteracao(array(12, 34)); // WHERE user_id_alteracao IN (12, 34)
     * $query->filterByUserIdAlteracao(array('min' => 12)); // WHERE user_id_alteracao > 12
     * </code>
     *
     * @param     mixed $userIdAlteracao The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOrcamentoQuery The current query, for fluid interface
     */
    public function filterByUserIdAlteracao($userIdAlteracao = null, $comparison = null)
    {
        if (is_array($userIdAlteracao)) {
            $useMinMax = false;
            if (isset($userIdAlteracao['min'])) {
                $this->addUsingAlias(OrcamentoTableMap::COL_USER_ID_ALTERACAO, $userIdAlteracao['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($userIdAlteracao['max'])) {
                $this->addUsingAlias(OrcamentoTableMap::COL_USER_ID_ALTERACAO, $userIdAlteracao['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OrcamentoTableMap::COL_USER_ID_ALTERACAO, $userIdAlteracao, $comparison);
    }

    /**
     * Filter the query by a related \Table\Model\Cliente object
     *
     * @param \Table\Model\Cliente|ObjectCollection $cliente The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildOrcamentoQuery The current query, for fluid interface
     */
    public function filterByCliente($cliente, $comparison = null)
    {
        if ($cliente instanceof \Table\Model\Cliente) {
            return $this
                ->addUsingAlias(OrcamentoTableMap::COL_CLIENTE_ID, $cliente->getId(), $comparison);
        } elseif ($cliente instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(OrcamentoTableMap::COL_CLIENTE_ID, $cliente->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByCliente() only accepts arguments of type \Table\Model\Cliente or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Cliente relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildOrcamentoQuery The current query, for fluid interface
     */
    public function joinCliente($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Cliente');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Cliente');
        }

        return $this;
    }

    /**
     * Use the Cliente relation Cliente object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Table\Model\ClienteQuery A secondary query class using the current class as primary query
     */
    public function useClienteQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinCliente($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Cliente', '\Table\Model\ClienteQuery');
    }

    /**
     * Filter the query by a related \Table\Model\OrcamentoItem object
     *
     * @param \Table\Model\OrcamentoItem|ObjectCollection $orcamentoItem  the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildOrcamentoQuery The current query, for fluid interface
     */
    public function filterByOrcamentoItem($orcamentoItem, $comparison = null)
    {
        if ($orcamentoItem instanceof \Table\Model\OrcamentoItem) {
            return $this
                ->addUsingAlias(OrcamentoTableMap::COL_ID, $orcamentoItem->getOrcamentoId(), $comparison);
        } elseif ($orcamentoItem instanceof ObjectCollection) {
            return $this
                ->useOrcamentoItemQuery()
                ->filterByPrimaryKeys($orcamentoItem->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByOrcamentoItem() only accepts arguments of type \Table\Model\OrcamentoItem or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the OrcamentoItem relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildOrcamentoQuery The current query, for fluid interface
     */
    public function joinOrcamentoItem($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('OrcamentoItem');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'OrcamentoItem');
        }

        return $this;
    }

    /**
     * Use the OrcamentoItem relation OrcamentoItem object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Table\Model\OrcamentoItemQuery A secondary query class using the current class as primary query
     */
    public function useOrcamentoItemQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinOrcamentoItem($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'OrcamentoItem', '\Table\Model\OrcamentoItemQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildOrcamento $orcamento Object to remove from the list of results
     *
     * @return $this|ChildOrcamentoQuery The current query, for fluid interface
     */
    public function prune($orcamento = null)
    {
        if ($orcamento) {
            $this->addUsingAlias(OrcamentoTableMap::COL_ID, $orcamento->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the orcamento table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(OrcamentoTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            OrcamentoTableMap::clearInstancePool();
            OrcamentoTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    /**
     * Performs a DELETE on the database based on the current ModelCriteria
     *
     * @param ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public function delete(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(OrcamentoTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(OrcamentoTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            
            OrcamentoTableMap::removeInstanceFromPool($criteria);
        
            $affectedRows += ModelCriteria::delete($con);
            OrcamentoTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // OrcamentoQuery
