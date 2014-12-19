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
use Table\Model\Estoque as ChildEstoque;
use Table\Model\EstoqueQuery as ChildEstoqueQuery;
use Table\Model\Map\EstoqueTableMap;

/**
 * Base class that represents a query for the 'estoque' table.
 *
 * 
 *
 * @method     ChildEstoqueQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildEstoqueQuery orderByProdutoId($order = Criteria::ASC) Order by the produto_id column
 * @method     ChildEstoqueQuery orderByNs($order = Criteria::ASC) Order by the ns column
 * @method     ChildEstoqueQuery orderByPatrimonio($order = Criteria::ASC) Order by the patrimonio column
 * @method     ChildEstoqueQuery orderByInternet($order = Criteria::ASC) Order by the internet column
 * @method     ChildEstoqueQuery orderByCodigoBarras($order = Criteria::ASC) Order by the codigo_barras column
 * @method     ChildEstoqueQuery orderByDataCompra($order = Criteria::ASC) Order by the data_compra column
 * @method     ChildEstoqueQuery orderByValor($order = Criteria::ASC) Order by the valor column
 * @method     ChildEstoqueQuery orderByNumeroNf($order = Criteria::ASC) Order by the numero_nf column
 * @method     ChildEstoqueQuery orderByHistorico($order = Criteria::ASC) Order by the historico column
 * @method     ChildEstoqueQuery orderByStatus($order = Criteria::ASC) Order by the status column
 * @method     ChildEstoqueQuery orderByMotivo($order = Criteria::ASC) Order by the motivo column
 * @method     ChildEstoqueQuery orderByDhInclusao($order = Criteria::ASC) Order by the dh_inclusao column
 * @method     ChildEstoqueQuery orderByDhAlteracao($order = Criteria::ASC) Order by the dh_alteracao column
 * @method     ChildEstoqueQuery orderByUserIdInclusao($order = Criteria::ASC) Order by the user_id_inclusao column
 * @method     ChildEstoqueQuery orderByUserIdAlteracao($order = Criteria::ASC) Order by the user_id_alteracao column
 *
 * @method     ChildEstoqueQuery groupById() Group by the id column
 * @method     ChildEstoqueQuery groupByProdutoId() Group by the produto_id column
 * @method     ChildEstoqueQuery groupByNs() Group by the ns column
 * @method     ChildEstoqueQuery groupByPatrimonio() Group by the patrimonio column
 * @method     ChildEstoqueQuery groupByInternet() Group by the internet column
 * @method     ChildEstoqueQuery groupByCodigoBarras() Group by the codigo_barras column
 * @method     ChildEstoqueQuery groupByDataCompra() Group by the data_compra column
 * @method     ChildEstoqueQuery groupByValor() Group by the valor column
 * @method     ChildEstoqueQuery groupByNumeroNf() Group by the numero_nf column
 * @method     ChildEstoqueQuery groupByHistorico() Group by the historico column
 * @method     ChildEstoqueQuery groupByStatus() Group by the status column
 * @method     ChildEstoqueQuery groupByMotivo() Group by the motivo column
 * @method     ChildEstoqueQuery groupByDhInclusao() Group by the dh_inclusao column
 * @method     ChildEstoqueQuery groupByDhAlteracao() Group by the dh_alteracao column
 * @method     ChildEstoqueQuery groupByUserIdInclusao() Group by the user_id_inclusao column
 * @method     ChildEstoqueQuery groupByUserIdAlteracao() Group by the user_id_alteracao column
 *
 * @method     ChildEstoqueQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildEstoqueQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildEstoqueQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildEstoqueQuery leftJoinProduto($relationAlias = null) Adds a LEFT JOIN clause to the query using the Produto relation
 * @method     ChildEstoqueQuery rightJoinProduto($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Produto relation
 * @method     ChildEstoqueQuery innerJoinProduto($relationAlias = null) Adds a INNER JOIN clause to the query using the Produto relation
 *
 * @method     \Table\Model\ProdutoQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildEstoque findOne(ConnectionInterface $con = null) Return the first ChildEstoque matching the query
 * @method     ChildEstoque findOneOrCreate(ConnectionInterface $con = null) Return the first ChildEstoque matching the query, or a new ChildEstoque object populated from the query conditions when no match is found
 *
 * @method     ChildEstoque findOneById(int $id) Return the first ChildEstoque filtered by the id column
 * @method     ChildEstoque findOneByProdutoId(int $produto_id) Return the first ChildEstoque filtered by the produto_id column
 * @method     ChildEstoque findOneByNs(string $ns) Return the first ChildEstoque filtered by the ns column
 * @method     ChildEstoque findOneByPatrimonio(int $patrimonio) Return the first ChildEstoque filtered by the patrimonio column
 * @method     ChildEstoque findOneByInternet(string $internet) Return the first ChildEstoque filtered by the internet column
 * @method     ChildEstoque findOneByCodigoBarras(int $codigo_barras) Return the first ChildEstoque filtered by the codigo_barras column
 * @method     ChildEstoque findOneByDataCompra(string $data_compra) Return the first ChildEstoque filtered by the data_compra column
 * @method     ChildEstoque findOneByValor(string $valor) Return the first ChildEstoque filtered by the valor column
 * @method     ChildEstoque findOneByNumeroNf(string $numero_nf) Return the first ChildEstoque filtered by the numero_nf column
 * @method     ChildEstoque findOneByHistorico(string $historico) Return the first ChildEstoque filtered by the historico column
 * @method     ChildEstoque findOneByStatus(int $status) Return the first ChildEstoque filtered by the status column
 * @method     ChildEstoque findOneByMotivo(int $motivo) Return the first ChildEstoque filtered by the motivo column
 * @method     ChildEstoque findOneByDhInclusao(string $dh_inclusao) Return the first ChildEstoque filtered by the dh_inclusao column
 * @method     ChildEstoque findOneByDhAlteracao(string $dh_alteracao) Return the first ChildEstoque filtered by the dh_alteracao column
 * @method     ChildEstoque findOneByUserIdInclusao(int $user_id_inclusao) Return the first ChildEstoque filtered by the user_id_inclusao column
 * @method     ChildEstoque findOneByUserIdAlteracao(int $user_id_alteracao) Return the first ChildEstoque filtered by the user_id_alteracao column
 *
 * @method     ChildEstoque[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildEstoque objects based on current ModelCriteria
 * @method     ChildEstoque[]|ObjectCollection findById(int $id) Return ChildEstoque objects filtered by the id column
 * @method     ChildEstoque[]|ObjectCollection findByProdutoId(int $produto_id) Return ChildEstoque objects filtered by the produto_id column
 * @method     ChildEstoque[]|ObjectCollection findByNs(string $ns) Return ChildEstoque objects filtered by the ns column
 * @method     ChildEstoque[]|ObjectCollection findByPatrimonio(int $patrimonio) Return ChildEstoque objects filtered by the patrimonio column
 * @method     ChildEstoque[]|ObjectCollection findByInternet(string $internet) Return ChildEstoque objects filtered by the internet column
 * @method     ChildEstoque[]|ObjectCollection findByCodigoBarras(int $codigo_barras) Return ChildEstoque objects filtered by the codigo_barras column
 * @method     ChildEstoque[]|ObjectCollection findByDataCompra(string $data_compra) Return ChildEstoque objects filtered by the data_compra column
 * @method     ChildEstoque[]|ObjectCollection findByValor(string $valor) Return ChildEstoque objects filtered by the valor column
 * @method     ChildEstoque[]|ObjectCollection findByNumeroNf(string $numero_nf) Return ChildEstoque objects filtered by the numero_nf column
 * @method     ChildEstoque[]|ObjectCollection findByHistorico(string $historico) Return ChildEstoque objects filtered by the historico column
 * @method     ChildEstoque[]|ObjectCollection findByStatus(int $status) Return ChildEstoque objects filtered by the status column
 * @method     ChildEstoque[]|ObjectCollection findByMotivo(int $motivo) Return ChildEstoque objects filtered by the motivo column
 * @method     ChildEstoque[]|ObjectCollection findByDhInclusao(string $dh_inclusao) Return ChildEstoque objects filtered by the dh_inclusao column
 * @method     ChildEstoque[]|ObjectCollection findByDhAlteracao(string $dh_alteracao) Return ChildEstoque objects filtered by the dh_alteracao column
 * @method     ChildEstoque[]|ObjectCollection findByUserIdInclusao(int $user_id_inclusao) Return ChildEstoque objects filtered by the user_id_inclusao column
 * @method     ChildEstoque[]|ObjectCollection findByUserIdAlteracao(int $user_id_alteracao) Return ChildEstoque objects filtered by the user_id_alteracao column
 * @method     ChildEstoque[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class EstoqueQuery extends ModelCriteria
{
    
    /**
     * Initializes internal state of \Table\Model\Base\EstoqueQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Table\\Model\\Estoque', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildEstoqueQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildEstoqueQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildEstoqueQuery) {
            return $criteria;
        }
        $query = new ChildEstoqueQuery();
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
     * $obj = $c->findPk(array(12, 34), $con);
     * </code>
     *
     * @param array[$id, $produto_id] $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildEstoque|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = EstoqueTableMap::getInstanceFromPool(serialize(array((string) $key[0], (string) $key[1]))))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(EstoqueTableMap::DATABASE_NAME);
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
     * @return ChildEstoque A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, produto_id, ns, patrimonio, internet, codigo_barras, data_compra, valor, numero_nf, historico, status, motivo, dh_inclusao, dh_alteracao, user_id_inclusao, user_id_alteracao FROM estoque WHERE id = :p0 AND produto_id = :p1';
        try {
            $stmt = $con->prepare($sql);            
            $stmt->bindValue(':p0', $key[0], PDO::PARAM_INT);            
            $stmt->bindValue(':p1', $key[1], PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildEstoque $obj */
            $obj = new ChildEstoque();
            $obj->hydrate($row);
            EstoqueTableMap::addInstanceToPool($obj, serialize(array((string) $key[0], (string) $key[1])));
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
     * @return ChildEstoque|array|mixed the result, formatted by the current formatter
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
     * $objs = $c->findPks(array(array(12, 56), array(832, 123), array(123, 456)), $con);
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
     * @return $this|ChildEstoqueQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(EstoqueTableMap::COL_ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(EstoqueTableMap::COL_PRODUTO_ID, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildEstoqueQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(EstoqueTableMap::COL_ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(EstoqueTableMap::COL_PRODUTO_ID, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
            $this->addOr($cton0);
        }

        return $this;
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
     * @return $this|ChildEstoqueQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(EstoqueTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(EstoqueTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EstoqueTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the produto_id column
     *
     * Example usage:
     * <code>
     * $query->filterByProdutoId(1234); // WHERE produto_id = 1234
     * $query->filterByProdutoId(array(12, 34)); // WHERE produto_id IN (12, 34)
     * $query->filterByProdutoId(array('min' => 12)); // WHERE produto_id > 12
     * </code>
     *
     * @see       filterByProduto()
     *
     * @param     mixed $produtoId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEstoqueQuery The current query, for fluid interface
     */
    public function filterByProdutoId($produtoId = null, $comparison = null)
    {
        if (is_array($produtoId)) {
            $useMinMax = false;
            if (isset($produtoId['min'])) {
                $this->addUsingAlias(EstoqueTableMap::COL_PRODUTO_ID, $produtoId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($produtoId['max'])) {
                $this->addUsingAlias(EstoqueTableMap::COL_PRODUTO_ID, $produtoId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EstoqueTableMap::COL_PRODUTO_ID, $produtoId, $comparison);
    }

    /**
     * Filter the query on the ns column
     *
     * Example usage:
     * <code>
     * $query->filterByNs('fooValue');   // WHERE ns = 'fooValue'
     * $query->filterByNs('%fooValue%'); // WHERE ns LIKE '%fooValue%'
     * </code>
     *
     * @param     string $ns The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEstoqueQuery The current query, for fluid interface
     */
    public function filterByNs($ns = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($ns)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $ns)) {
                $ns = str_replace('*', '%', $ns);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(EstoqueTableMap::COL_NS, $ns, $comparison);
    }

    /**
     * Filter the query on the patrimonio column
     *
     * Example usage:
     * <code>
     * $query->filterByPatrimonio(1234); // WHERE patrimonio = 1234
     * $query->filterByPatrimonio(array(12, 34)); // WHERE patrimonio IN (12, 34)
     * $query->filterByPatrimonio(array('min' => 12)); // WHERE patrimonio > 12
     * </code>
     *
     * @param     mixed $patrimonio The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEstoqueQuery The current query, for fluid interface
     */
    public function filterByPatrimonio($patrimonio = null, $comparison = null)
    {
        if (is_array($patrimonio)) {
            $useMinMax = false;
            if (isset($patrimonio['min'])) {
                $this->addUsingAlias(EstoqueTableMap::COL_PATRIMONIO, $patrimonio['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($patrimonio['max'])) {
                $this->addUsingAlias(EstoqueTableMap::COL_PATRIMONIO, $patrimonio['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EstoqueTableMap::COL_PATRIMONIO, $patrimonio, $comparison);
    }

    /**
     * Filter the query on the internet column
     *
     * Example usage:
     * <code>
     * $query->filterByInternet('fooValue');   // WHERE internet = 'fooValue'
     * $query->filterByInternet('%fooValue%'); // WHERE internet LIKE '%fooValue%'
     * </code>
     *
     * @param     string $internet The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEstoqueQuery The current query, for fluid interface
     */
    public function filterByInternet($internet = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($internet)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $internet)) {
                $internet = str_replace('*', '%', $internet);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(EstoqueTableMap::COL_INTERNET, $internet, $comparison);
    }

    /**
     * Filter the query on the codigo_barras column
     *
     * Example usage:
     * <code>
     * $query->filterByCodigoBarras(1234); // WHERE codigo_barras = 1234
     * $query->filterByCodigoBarras(array(12, 34)); // WHERE codigo_barras IN (12, 34)
     * $query->filterByCodigoBarras(array('min' => 12)); // WHERE codigo_barras > 12
     * </code>
     *
     * @param     mixed $codigoBarras The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEstoqueQuery The current query, for fluid interface
     */
    public function filterByCodigoBarras($codigoBarras = null, $comparison = null)
    {
        if (is_array($codigoBarras)) {
            $useMinMax = false;
            if (isset($codigoBarras['min'])) {
                $this->addUsingAlias(EstoqueTableMap::COL_CODIGO_BARRAS, $codigoBarras['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($codigoBarras['max'])) {
                $this->addUsingAlias(EstoqueTableMap::COL_CODIGO_BARRAS, $codigoBarras['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EstoqueTableMap::COL_CODIGO_BARRAS, $codigoBarras, $comparison);
    }

    /**
     * Filter the query on the data_compra column
     *
     * Example usage:
     * <code>
     * $query->filterByDataCompra('2011-03-14'); // WHERE data_compra = '2011-03-14'
     * $query->filterByDataCompra('now'); // WHERE data_compra = '2011-03-14'
     * $query->filterByDataCompra(array('max' => 'yesterday')); // WHERE data_compra > '2011-03-13'
     * </code>
     *
     * @param     mixed $dataCompra The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEstoqueQuery The current query, for fluid interface
     */
    public function filterByDataCompra($dataCompra = null, $comparison = null)
    {
        if (is_array($dataCompra)) {
            $useMinMax = false;
            if (isset($dataCompra['min'])) {
                $this->addUsingAlias(EstoqueTableMap::COL_DATA_COMPRA, $dataCompra['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($dataCompra['max'])) {
                $this->addUsingAlias(EstoqueTableMap::COL_DATA_COMPRA, $dataCompra['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EstoqueTableMap::COL_DATA_COMPRA, $dataCompra, $comparison);
    }

    /**
     * Filter the query on the valor column
     *
     * Example usage:
     * <code>
     * $query->filterByValor(1234); // WHERE valor = 1234
     * $query->filterByValor(array(12, 34)); // WHERE valor IN (12, 34)
     * $query->filterByValor(array('min' => 12)); // WHERE valor > 12
     * </code>
     *
     * @param     mixed $valor The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEstoqueQuery The current query, for fluid interface
     */
    public function filterByValor($valor = null, $comparison = null)
    {
        if (is_array($valor)) {
            $useMinMax = false;
            if (isset($valor['min'])) {
                $this->addUsingAlias(EstoqueTableMap::COL_VALOR, $valor['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($valor['max'])) {
                $this->addUsingAlias(EstoqueTableMap::COL_VALOR, $valor['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EstoqueTableMap::COL_VALOR, $valor, $comparison);
    }

    /**
     * Filter the query on the numero_nf column
     *
     * Example usage:
     * <code>
     * $query->filterByNumeroNf('fooValue');   // WHERE numero_nf = 'fooValue'
     * $query->filterByNumeroNf('%fooValue%'); // WHERE numero_nf LIKE '%fooValue%'
     * </code>
     *
     * @param     string $numeroNf The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEstoqueQuery The current query, for fluid interface
     */
    public function filterByNumeroNf($numeroNf = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($numeroNf)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $numeroNf)) {
                $numeroNf = str_replace('*', '%', $numeroNf);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(EstoqueTableMap::COL_NUMERO_NF, $numeroNf, $comparison);
    }

    /**
     * Filter the query on the historico column
     *
     * Example usage:
     * <code>
     * $query->filterByHistorico('fooValue');   // WHERE historico = 'fooValue'
     * $query->filterByHistorico('%fooValue%'); // WHERE historico LIKE '%fooValue%'
     * </code>
     *
     * @param     string $historico The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEstoqueQuery The current query, for fluid interface
     */
    public function filterByHistorico($historico = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($historico)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $historico)) {
                $historico = str_replace('*', '%', $historico);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(EstoqueTableMap::COL_HISTORICO, $historico, $comparison);
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
     * @return $this|ChildEstoqueQuery The current query, for fluid interface
     */
    public function filterByStatus($status = null, $comparison = null)
    {
        if (is_array($status)) {
            $useMinMax = false;
            if (isset($status['min'])) {
                $this->addUsingAlias(EstoqueTableMap::COL_STATUS, $status['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($status['max'])) {
                $this->addUsingAlias(EstoqueTableMap::COL_STATUS, $status['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EstoqueTableMap::COL_STATUS, $status, $comparison);
    }

    /**
     * Filter the query on the motivo column
     *
     * Example usage:
     * <code>
     * $query->filterByMotivo(1234); // WHERE motivo = 1234
     * $query->filterByMotivo(array(12, 34)); // WHERE motivo IN (12, 34)
     * $query->filterByMotivo(array('min' => 12)); // WHERE motivo > 12
     * </code>
     *
     * @param     mixed $motivo The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEstoqueQuery The current query, for fluid interface
     */
    public function filterByMotivo($motivo = null, $comparison = null)
    {
        if (is_array($motivo)) {
            $useMinMax = false;
            if (isset($motivo['min'])) {
                $this->addUsingAlias(EstoqueTableMap::COL_MOTIVO, $motivo['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($motivo['max'])) {
                $this->addUsingAlias(EstoqueTableMap::COL_MOTIVO, $motivo['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EstoqueTableMap::COL_MOTIVO, $motivo, $comparison);
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
     * @return $this|ChildEstoqueQuery The current query, for fluid interface
     */
    public function filterByDhInclusao($dhInclusao = null, $comparison = null)
    {
        if (is_array($dhInclusao)) {
            $useMinMax = false;
            if (isset($dhInclusao['min'])) {
                $this->addUsingAlias(EstoqueTableMap::COL_DH_INCLUSAO, $dhInclusao['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($dhInclusao['max'])) {
                $this->addUsingAlias(EstoqueTableMap::COL_DH_INCLUSAO, $dhInclusao['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EstoqueTableMap::COL_DH_INCLUSAO, $dhInclusao, $comparison);
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
     * @return $this|ChildEstoqueQuery The current query, for fluid interface
     */
    public function filterByDhAlteracao($dhAlteracao = null, $comparison = null)
    {
        if (is_array($dhAlteracao)) {
            $useMinMax = false;
            if (isset($dhAlteracao['min'])) {
                $this->addUsingAlias(EstoqueTableMap::COL_DH_ALTERACAO, $dhAlteracao['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($dhAlteracao['max'])) {
                $this->addUsingAlias(EstoqueTableMap::COL_DH_ALTERACAO, $dhAlteracao['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EstoqueTableMap::COL_DH_ALTERACAO, $dhAlteracao, $comparison);
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
     * @return $this|ChildEstoqueQuery The current query, for fluid interface
     */
    public function filterByUserIdInclusao($userIdInclusao = null, $comparison = null)
    {
        if (is_array($userIdInclusao)) {
            $useMinMax = false;
            if (isset($userIdInclusao['min'])) {
                $this->addUsingAlias(EstoqueTableMap::COL_USER_ID_INCLUSAO, $userIdInclusao['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($userIdInclusao['max'])) {
                $this->addUsingAlias(EstoqueTableMap::COL_USER_ID_INCLUSAO, $userIdInclusao['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EstoqueTableMap::COL_USER_ID_INCLUSAO, $userIdInclusao, $comparison);
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
     * @return $this|ChildEstoqueQuery The current query, for fluid interface
     */
    public function filterByUserIdAlteracao($userIdAlteracao = null, $comparison = null)
    {
        if (is_array($userIdAlteracao)) {
            $useMinMax = false;
            if (isset($userIdAlteracao['min'])) {
                $this->addUsingAlias(EstoqueTableMap::COL_USER_ID_ALTERACAO, $userIdAlteracao['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($userIdAlteracao['max'])) {
                $this->addUsingAlias(EstoqueTableMap::COL_USER_ID_ALTERACAO, $userIdAlteracao['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EstoqueTableMap::COL_USER_ID_ALTERACAO, $userIdAlteracao, $comparison);
    }

    /**
     * Filter the query by a related \Table\Model\Produto object
     *
     * @param \Table\Model\Produto|ObjectCollection $produto The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildEstoqueQuery The current query, for fluid interface
     */
    public function filterByProduto($produto, $comparison = null)
    {
        if ($produto instanceof \Table\Model\Produto) {
            return $this
                ->addUsingAlias(EstoqueTableMap::COL_PRODUTO_ID, $produto->getId(), $comparison);
        } elseif ($produto instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(EstoqueTableMap::COL_PRODUTO_ID, $produto->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByProduto() only accepts arguments of type \Table\Model\Produto or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Produto relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildEstoqueQuery The current query, for fluid interface
     */
    public function joinProduto($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Produto');

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
            $this->addJoinObject($join, 'Produto');
        }

        return $this;
    }

    /**
     * Use the Produto relation Produto object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Table\Model\ProdutoQuery A secondary query class using the current class as primary query
     */
    public function useProdutoQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinProduto($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Produto', '\Table\Model\ProdutoQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildEstoque $estoque Object to remove from the list of results
     *
     * @return $this|ChildEstoqueQuery The current query, for fluid interface
     */
    public function prune($estoque = null)
    {
        if ($estoque) {
            $this->addCond('pruneCond0', $this->getAliasedColName(EstoqueTableMap::COL_ID), $estoque->getId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(EstoqueTableMap::COL_PRODUTO_ID), $estoque->getProdutoId(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

    /**
     * Deletes all rows from the estoque table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(EstoqueTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            EstoqueTableMap::clearInstancePool();
            EstoqueTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(EstoqueTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(EstoqueTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            
            EstoqueTableMap::removeInstanceFromPool($criteria);
        
            $affectedRows += ModelCriteria::delete($con);
            EstoqueTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // EstoqueQuery
