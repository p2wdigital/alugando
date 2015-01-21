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
use Table\Model\Produto as ChildProduto;
use Table\Model\ProdutoQuery as ChildProdutoQuery;
use Table\Model\Map\ProdutoTableMap;

/**
 * Base class that represents a query for the 'produto' table.
 *
 *
 *
 * @method     ChildProdutoQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildProdutoQuery orderByCategoria($order = Criteria::ASC) Order by the categoria column
 * @method     ChildProdutoQuery orderByNome($order = Criteria::ASC) Order by the nome column
 * @method     ChildProdutoQuery orderByModelo($order = Criteria::ASC) Order by the modelo column
 *
 * @method     ChildProdutoQuery groupById() Group by the id column
 * @method     ChildProdutoQuery groupByCategoria() Group by the categoria column
 * @method     ChildProdutoQuery groupByNome() Group by the nome column
 * @method     ChildProdutoQuery groupByModelo() Group by the modelo column
 *
 * @method     ChildProdutoQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildProdutoQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildProdutoQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildProdutoQuery leftJoinOrcamentoItem($relationAlias = null) Adds a LEFT JOIN clause to the query using the OrcamentoItem relation
 * @method     ChildProdutoQuery rightJoinOrcamentoItem($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OrcamentoItem relation
 * @method     ChildProdutoQuery innerJoinOrcamentoItem($relationAlias = null) Adds a INNER JOIN clause to the query using the OrcamentoItem relation
 *
 * @method     ChildProdutoQuery leftJoinProdutoValor($relationAlias = null) Adds a LEFT JOIN clause to the query using the ProdutoValor relation
 * @method     ChildProdutoQuery rightJoinProdutoValor($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ProdutoValor relation
 * @method     ChildProdutoQuery innerJoinProdutoValor($relationAlias = null) Adds a INNER JOIN clause to the query using the ProdutoValor relation
 *
 * @method     \Table\Model\OrcamentoItemQuery|\Table\Model\ProdutoValorQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildProduto findOne(ConnectionInterface $con = null) Return the first ChildProduto matching the query
 * @method     ChildProduto findOneOrCreate(ConnectionInterface $con = null) Return the first ChildProduto matching the query, or a new ChildProduto object populated from the query conditions when no match is found
 *
 * @method     ChildProduto findOneById(int $id) Return the first ChildProduto filtered by the id column
 * @method     ChildProduto findOneByCategoria(string $categoria) Return the first ChildProduto filtered by the categoria column
 * @method     ChildProduto findOneByNome(string $nome) Return the first ChildProduto filtered by the nome column
 * @method     ChildProduto findOneByModelo(string $modelo) Return the first ChildProduto filtered by the modelo column *

 * @method     ChildProduto requirePk($key, ConnectionInterface $con = null) Return the ChildProduto by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProduto requireOne(ConnectionInterface $con = null) Return the first ChildProduto matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildProduto requireOneById(int $id) Return the first ChildProduto filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProduto requireOneByCategoria(string $categoria) Return the first ChildProduto filtered by the categoria column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProduto requireOneByNome(string $nome) Return the first ChildProduto filtered by the nome column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProduto requireOneByModelo(string $modelo) Return the first ChildProduto filtered by the modelo column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildProduto[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildProduto objects based on current ModelCriteria
 * @method     ChildProduto[]|ObjectCollection findById(int $id) Return ChildProduto objects filtered by the id column
 * @method     ChildProduto[]|ObjectCollection findByCategoria(string $categoria) Return ChildProduto objects filtered by the categoria column
 * @method     ChildProduto[]|ObjectCollection findByNome(string $nome) Return ChildProduto objects filtered by the nome column
 * @method     ChildProduto[]|ObjectCollection findByModelo(string $modelo) Return ChildProduto objects filtered by the modelo column
 * @method     ChildProduto[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class ProdutoQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Table\Model\Base\ProdutoQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Table\\Model\\Produto', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildProdutoQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildProdutoQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildProdutoQuery) {
            return $criteria;
        }
        $query = new ChildProdutoQuery();
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
     * @return ChildProduto|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = ProdutoTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ProdutoTableMap::DATABASE_NAME);
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
     * @return ChildProduto A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, categoria, nome, modelo FROM produto WHERE id = :p0';
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
            /** @var ChildProduto $obj */
            $obj = new ChildProduto();
            $obj->hydrate($row);
            ProdutoTableMap::addInstanceToPool($obj, (string) $key);
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
     * @return ChildProduto|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildProdutoQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(ProdutoTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildProdutoQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(ProdutoTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildProdutoQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(ProdutoTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(ProdutoTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProdutoTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the categoria column
     *
     * Example usage:
     * <code>
     * $query->filterByCategoria('fooValue');   // WHERE categoria = 'fooValue'
     * $query->filterByCategoria('%fooValue%'); // WHERE categoria LIKE '%fooValue%'
     * </code>
     *
     * @param     string $categoria The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProdutoQuery The current query, for fluid interface
     */
    public function filterByCategoria($categoria = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($categoria)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $categoria)) {
                $categoria = str_replace('*', '%', $categoria);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ProdutoTableMap::COL_CATEGORIA, $categoria, $comparison);
    }

    /**
     * Filter the query on the nome column
     *
     * Example usage:
     * <code>
     * $query->filterByNome('fooValue');   // WHERE nome = 'fooValue'
     * $query->filterByNome('%fooValue%'); // WHERE nome LIKE '%fooValue%'
     * </code>
     *
     * @param     string $nome The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProdutoQuery The current query, for fluid interface
     */
    public function filterByNome($nome = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($nome)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $nome)) {
                $nome = str_replace('*', '%', $nome);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ProdutoTableMap::COL_NOME, $nome, $comparison);
    }

    /**
     * Filter the query on the modelo column
     *
     * Example usage:
     * <code>
     * $query->filterByModelo('fooValue');   // WHERE modelo = 'fooValue'
     * $query->filterByModelo('%fooValue%'); // WHERE modelo LIKE '%fooValue%'
     * </code>
     *
     * @param     string $modelo The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProdutoQuery The current query, for fluid interface
     */
    public function filterByModelo($modelo = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($modelo)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $modelo)) {
                $modelo = str_replace('*', '%', $modelo);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ProdutoTableMap::COL_MODELO, $modelo, $comparison);
    }

    /**
     * Filter the query by a related \Table\Model\OrcamentoItem object
     *
     * @param \Table\Model\OrcamentoItem|ObjectCollection $orcamentoItem  the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildProdutoQuery The current query, for fluid interface
     */
    public function filterByOrcamentoItem($orcamentoItem, $comparison = null)
    {
        if ($orcamentoItem instanceof \Table\Model\OrcamentoItem) {
            return $this
                ->addUsingAlias(ProdutoTableMap::COL_ID, $orcamentoItem->getProdutoId(), $comparison);
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
     * @return $this|ChildProdutoQuery The current query, for fluid interface
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
     * Filter the query by a related \Table\Model\ProdutoValor object
     *
     * @param \Table\Model\ProdutoValor|ObjectCollection $produtoValor  the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildProdutoQuery The current query, for fluid interface
     */
    public function filterByProdutoValor($produtoValor, $comparison = null)
    {
        if ($produtoValor instanceof \Table\Model\ProdutoValor) {
            return $this
                ->addUsingAlias(ProdutoTableMap::COL_ID, $produtoValor->getProdutoId(), $comparison);
        } elseif ($produtoValor instanceof ObjectCollection) {
            return $this
                ->useProdutoValorQuery()
                ->filterByPrimaryKeys($produtoValor->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByProdutoValor() only accepts arguments of type \Table\Model\ProdutoValor or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ProdutoValor relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildProdutoQuery The current query, for fluid interface
     */
    public function joinProdutoValor($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ProdutoValor');

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
            $this->addJoinObject($join, 'ProdutoValor');
        }

        return $this;
    }

    /**
     * Use the ProdutoValor relation ProdutoValor object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Table\Model\ProdutoValorQuery A secondary query class using the current class as primary query
     */
    public function useProdutoValorQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinProdutoValor($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ProdutoValor', '\Table\Model\ProdutoValorQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildProduto $produto Object to remove from the list of results
     *
     * @return $this|ChildProdutoQuery The current query, for fluid interface
     */
    public function prune($produto = null)
    {
        if ($produto) {
            $this->addUsingAlias(ProdutoTableMap::COL_ID, $produto->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the produto table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ProdutoTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ProdutoTableMap::clearInstancePool();
            ProdutoTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(ProdutoTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ProdutoTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ProdutoTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ProdutoTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // ProdutoQuery
