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
use Table\Model\OrcamentoItem as ChildOrcamentoItem;
use Table\Model\OrcamentoItemQuery as ChildOrcamentoItemQuery;
use Table\Model\Map\OrcamentoItemTableMap;

/**
 * Base class that represents a query for the 'orcamento_item' table.
 *
 * 
 *
 * @method     ChildOrcamentoItemQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildOrcamentoItemQuery orderByOrcamentoId($order = Criteria::ASC) Order by the orcamento_id column
 * @method     ChildOrcamentoItemQuery orderByProdutoId($order = Criteria::ASC) Order by the produto_id column
 * @method     ChildOrcamentoItemQuery orderByQtd($order = Criteria::ASC) Order by the qtd column
 * @method     ChildOrcamentoItemQuery orderByValor($order = Criteria::ASC) Order by the valor column
 * @method     ChildOrcamentoItemQuery orderByOrder($order = Criteria::ASC) Order by the order column
 *
 * @method     ChildOrcamentoItemQuery groupById() Group by the id column
 * @method     ChildOrcamentoItemQuery groupByOrcamentoId() Group by the orcamento_id column
 * @method     ChildOrcamentoItemQuery groupByProdutoId() Group by the produto_id column
 * @method     ChildOrcamentoItemQuery groupByQtd() Group by the qtd column
 * @method     ChildOrcamentoItemQuery groupByValor() Group by the valor column
 * @method     ChildOrcamentoItemQuery groupByOrder() Group by the order column
 *
 * @method     ChildOrcamentoItemQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildOrcamentoItemQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildOrcamentoItemQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildOrcamentoItemQuery leftJoinOrcamento($relationAlias = null) Adds a LEFT JOIN clause to the query using the Orcamento relation
 * @method     ChildOrcamentoItemQuery rightJoinOrcamento($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Orcamento relation
 * @method     ChildOrcamentoItemQuery innerJoinOrcamento($relationAlias = null) Adds a INNER JOIN clause to the query using the Orcamento relation
 *
 * @method     ChildOrcamentoItemQuery leftJoinProduto($relationAlias = null) Adds a LEFT JOIN clause to the query using the Produto relation
 * @method     ChildOrcamentoItemQuery rightJoinProduto($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Produto relation
 * @method     ChildOrcamentoItemQuery innerJoinProduto($relationAlias = null) Adds a INNER JOIN clause to the query using the Produto relation
 *
 * @method     \Table\Model\OrcamentoQuery|\Table\Model\ProdutoQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildOrcamentoItem findOne(ConnectionInterface $con = null) Return the first ChildOrcamentoItem matching the query
 * @method     ChildOrcamentoItem findOneOrCreate(ConnectionInterface $con = null) Return the first ChildOrcamentoItem matching the query, or a new ChildOrcamentoItem object populated from the query conditions when no match is found
 *
 * @method     ChildOrcamentoItem findOneById(int $id) Return the first ChildOrcamentoItem filtered by the id column
 * @method     ChildOrcamentoItem findOneByOrcamentoId(int $orcamento_id) Return the first ChildOrcamentoItem filtered by the orcamento_id column
 * @method     ChildOrcamentoItem findOneByProdutoId(int $produto_id) Return the first ChildOrcamentoItem filtered by the produto_id column
 * @method     ChildOrcamentoItem findOneByQtd(int $qtd) Return the first ChildOrcamentoItem filtered by the qtd column
 * @method     ChildOrcamentoItem findOneByValor(string $valor) Return the first ChildOrcamentoItem filtered by the valor column
 * @method     ChildOrcamentoItem findOneByOrder(int $order) Return the first ChildOrcamentoItem filtered by the order column
 *
 * @method     ChildOrcamentoItem[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildOrcamentoItem objects based on current ModelCriteria
 * @method     ChildOrcamentoItem[]|ObjectCollection findById(int $id) Return ChildOrcamentoItem objects filtered by the id column
 * @method     ChildOrcamentoItem[]|ObjectCollection findByOrcamentoId(int $orcamento_id) Return ChildOrcamentoItem objects filtered by the orcamento_id column
 * @method     ChildOrcamentoItem[]|ObjectCollection findByProdutoId(int $produto_id) Return ChildOrcamentoItem objects filtered by the produto_id column
 * @method     ChildOrcamentoItem[]|ObjectCollection findByQtd(int $qtd) Return ChildOrcamentoItem objects filtered by the qtd column
 * @method     ChildOrcamentoItem[]|ObjectCollection findByValor(string $valor) Return ChildOrcamentoItem objects filtered by the valor column
 * @method     ChildOrcamentoItem[]|ObjectCollection findByOrder(int $order) Return ChildOrcamentoItem objects filtered by the order column
 * @method     ChildOrcamentoItem[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class OrcamentoItemQuery extends ModelCriteria
{
    
    /**
     * Initializes internal state of \Table\Model\Base\OrcamentoItemQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Table\\Model\\OrcamentoItem', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildOrcamentoItemQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildOrcamentoItemQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildOrcamentoItemQuery) {
            return $criteria;
        }
        $query = new ChildOrcamentoItemQuery();
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
     * $obj = $c->findPk(array(12, 34, 56), $con);
     * </code>
     *
     * @param array[$id, $orcamento_id, $produto_id] $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildOrcamentoItem|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = OrcamentoItemTableMap::getInstanceFromPool(serialize(array((string) $key[0], (string) $key[1], (string) $key[2]))))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(OrcamentoItemTableMap::DATABASE_NAME);
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
     * @return ChildOrcamentoItem A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, orcamento_id, produto_id, qtd, valor, order FROM orcamento_item WHERE id = :p0 AND orcamento_id = :p1 AND produto_id = :p2';
        try {
            $stmt = $con->prepare($sql);            
            $stmt->bindValue(':p0', $key[0], PDO::PARAM_INT);            
            $stmt->bindValue(':p1', $key[1], PDO::PARAM_INT);            
            $stmt->bindValue(':p2', $key[2], PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildOrcamentoItem $obj */
            $obj = new ChildOrcamentoItem();
            $obj->hydrate($row);
            OrcamentoItemTableMap::addInstanceToPool($obj, serialize(array((string) $key[0], (string) $key[1], (string) $key[2])));
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
     * @return ChildOrcamentoItem|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildOrcamentoItemQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(OrcamentoItemTableMap::COL_ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(OrcamentoItemTableMap::COL_ORCAMENTO_ID, $key[1], Criteria::EQUAL);
        $this->addUsingAlias(OrcamentoItemTableMap::COL_PRODUTO_ID, $key[2], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildOrcamentoItemQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(OrcamentoItemTableMap::COL_ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(OrcamentoItemTableMap::COL_ORCAMENTO_ID, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
            $cton2 = $this->getNewCriterion(OrcamentoItemTableMap::COL_PRODUTO_ID, $key[2], Criteria::EQUAL);
            $cton0->addAnd($cton2);
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
     * @return $this|ChildOrcamentoItemQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(OrcamentoItemTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(OrcamentoItemTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OrcamentoItemTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the orcamento_id column
     *
     * Example usage:
     * <code>
     * $query->filterByOrcamentoId(1234); // WHERE orcamento_id = 1234
     * $query->filterByOrcamentoId(array(12, 34)); // WHERE orcamento_id IN (12, 34)
     * $query->filterByOrcamentoId(array('min' => 12)); // WHERE orcamento_id > 12
     * </code>
     *
     * @see       filterByOrcamento()
     *
     * @param     mixed $orcamentoId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOrcamentoItemQuery The current query, for fluid interface
     */
    public function filterByOrcamentoId($orcamentoId = null, $comparison = null)
    {
        if (is_array($orcamentoId)) {
            $useMinMax = false;
            if (isset($orcamentoId['min'])) {
                $this->addUsingAlias(OrcamentoItemTableMap::COL_ORCAMENTO_ID, $orcamentoId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($orcamentoId['max'])) {
                $this->addUsingAlias(OrcamentoItemTableMap::COL_ORCAMENTO_ID, $orcamentoId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OrcamentoItemTableMap::COL_ORCAMENTO_ID, $orcamentoId, $comparison);
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
     * @return $this|ChildOrcamentoItemQuery The current query, for fluid interface
     */
    public function filterByProdutoId($produtoId = null, $comparison = null)
    {
        if (is_array($produtoId)) {
            $useMinMax = false;
            if (isset($produtoId['min'])) {
                $this->addUsingAlias(OrcamentoItemTableMap::COL_PRODUTO_ID, $produtoId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($produtoId['max'])) {
                $this->addUsingAlias(OrcamentoItemTableMap::COL_PRODUTO_ID, $produtoId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OrcamentoItemTableMap::COL_PRODUTO_ID, $produtoId, $comparison);
    }

    /**
     * Filter the query on the qtd column
     *
     * Example usage:
     * <code>
     * $query->filterByQtd(1234); // WHERE qtd = 1234
     * $query->filterByQtd(array(12, 34)); // WHERE qtd IN (12, 34)
     * $query->filterByQtd(array('min' => 12)); // WHERE qtd > 12
     * </code>
     *
     * @param     mixed $qtd The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOrcamentoItemQuery The current query, for fluid interface
     */
    public function filterByQtd($qtd = null, $comparison = null)
    {
        if (is_array($qtd)) {
            $useMinMax = false;
            if (isset($qtd['min'])) {
                $this->addUsingAlias(OrcamentoItemTableMap::COL_QTD, $qtd['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($qtd['max'])) {
                $this->addUsingAlias(OrcamentoItemTableMap::COL_QTD, $qtd['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OrcamentoItemTableMap::COL_QTD, $qtd, $comparison);
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
     * @return $this|ChildOrcamentoItemQuery The current query, for fluid interface
     */
    public function filterByValor($valor = null, $comparison = null)
    {
        if (is_array($valor)) {
            $useMinMax = false;
            if (isset($valor['min'])) {
                $this->addUsingAlias(OrcamentoItemTableMap::COL_VALOR, $valor['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($valor['max'])) {
                $this->addUsingAlias(OrcamentoItemTableMap::COL_VALOR, $valor['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OrcamentoItemTableMap::COL_VALOR, $valor, $comparison);
    }

    /**
     * Filter the query on the order column
     *
     * Example usage:
     * <code>
     * $query->filterByOrder(1234); // WHERE order = 1234
     * $query->filterByOrder(array(12, 34)); // WHERE order IN (12, 34)
     * $query->filterByOrder(array('min' => 12)); // WHERE order > 12
     * </code>
     *
     * @param     mixed $order The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOrcamentoItemQuery The current query, for fluid interface
     */
    public function filterByOrder($order = null, $comparison = null)
    {
        if (is_array($order)) {
            $useMinMax = false;
            if (isset($order['min'])) {
                $this->addUsingAlias(OrcamentoItemTableMap::COL_ORDER, $order['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($order['max'])) {
                $this->addUsingAlias(OrcamentoItemTableMap::COL_ORDER, $order['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OrcamentoItemTableMap::COL_ORDER, $order, $comparison);
    }

    /**
     * Filter the query by a related \Table\Model\Orcamento object
     *
     * @param \Table\Model\Orcamento|ObjectCollection $orcamento The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildOrcamentoItemQuery The current query, for fluid interface
     */
    public function filterByOrcamento($orcamento, $comparison = null)
    {
        if ($orcamento instanceof \Table\Model\Orcamento) {
            return $this
                ->addUsingAlias(OrcamentoItemTableMap::COL_ORCAMENTO_ID, $orcamento->getId(), $comparison);
        } elseif ($orcamento instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(OrcamentoItemTableMap::COL_ORCAMENTO_ID, $orcamento->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByOrcamento() only accepts arguments of type \Table\Model\Orcamento or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Orcamento relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildOrcamentoItemQuery The current query, for fluid interface
     */
    public function joinOrcamento($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Orcamento');

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
            $this->addJoinObject($join, 'Orcamento');
        }

        return $this;
    }

    /**
     * Use the Orcamento relation Orcamento object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Table\Model\OrcamentoQuery A secondary query class using the current class as primary query
     */
    public function useOrcamentoQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinOrcamento($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Orcamento', '\Table\Model\OrcamentoQuery');
    }

    /**
     * Filter the query by a related \Table\Model\Produto object
     *
     * @param \Table\Model\Produto|ObjectCollection $produto The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildOrcamentoItemQuery The current query, for fluid interface
     */
    public function filterByProduto($produto, $comparison = null)
    {
        if ($produto instanceof \Table\Model\Produto) {
            return $this
                ->addUsingAlias(OrcamentoItemTableMap::COL_PRODUTO_ID, $produto->getId(), $comparison);
        } elseif ($produto instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(OrcamentoItemTableMap::COL_PRODUTO_ID, $produto->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return $this|ChildOrcamentoItemQuery The current query, for fluid interface
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
     * @param   ChildOrcamentoItem $orcamentoItem Object to remove from the list of results
     *
     * @return $this|ChildOrcamentoItemQuery The current query, for fluid interface
     */
    public function prune($orcamentoItem = null)
    {
        if ($orcamentoItem) {
            $this->addCond('pruneCond0', $this->getAliasedColName(OrcamentoItemTableMap::COL_ID), $orcamentoItem->getId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(OrcamentoItemTableMap::COL_ORCAMENTO_ID), $orcamentoItem->getOrcamentoId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond2', $this->getAliasedColName(OrcamentoItemTableMap::COL_PRODUTO_ID), $orcamentoItem->getProdutoId(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1', 'pruneCond2'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

    /**
     * Deletes all rows from the orcamento_item table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(OrcamentoItemTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            OrcamentoItemTableMap::clearInstancePool();
            OrcamentoItemTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(OrcamentoItemTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(OrcamentoItemTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            
            OrcamentoItemTableMap::removeInstanceFromPool($criteria);
        
            $affectedRows += ModelCriteria::delete($con);
            OrcamentoItemTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // OrcamentoItemQuery
