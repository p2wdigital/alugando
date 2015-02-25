<?php

namespace Base;

use \PageData as ChildPageData;
use \PageDataQuery as ChildPageDataQuery;
use \Exception;
use \PDO;
use Map\PageDataTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'page_data' table.
 *
 * 
 *
 * @method     ChildPageDataQuery orderByPageId($order = Criteria::ASC) Order by the page_id column
 * @method     ChildPageDataQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildPageDataQuery orderByValue($order = Criteria::ASC) Order by the value column
 * @method     ChildPageDataQuery orderByDhInclusao($order = Criteria::ASC) Order by the dh_inclusao column
 * @method     ChildPageDataQuery orderByDhAlteracao($order = Criteria::ASC) Order by the dh_alteracao column
 *
 * @method     ChildPageDataQuery groupByPageId() Group by the page_id column
 * @method     ChildPageDataQuery groupByName() Group by the name column
 * @method     ChildPageDataQuery groupByValue() Group by the value column
 * @method     ChildPageDataQuery groupByDhInclusao() Group by the dh_inclusao column
 * @method     ChildPageDataQuery groupByDhAlteracao() Group by the dh_alteracao column
 *
 * @method     ChildPageDataQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildPageDataQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildPageDataQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildPageDataQuery leftJoinPage($relationAlias = null) Adds a LEFT JOIN clause to the query using the Page relation
 * @method     ChildPageDataQuery rightJoinPage($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Page relation
 * @method     ChildPageDataQuery innerJoinPage($relationAlias = null) Adds a INNER JOIN clause to the query using the Page relation
 *
 * @method     \PageQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildPageData findOne(ConnectionInterface $con = null) Return the first ChildPageData matching the query
 * @method     ChildPageData findOneOrCreate(ConnectionInterface $con = null) Return the first ChildPageData matching the query, or a new ChildPageData object populated from the query conditions when no match is found
 *
 * @method     ChildPageData findOneByPageId(int $page_id) Return the first ChildPageData filtered by the page_id column
 * @method     ChildPageData findOneByName(string $name) Return the first ChildPageData filtered by the name column
 * @method     ChildPageData findOneByValue(string $value) Return the first ChildPageData filtered by the value column
 * @method     ChildPageData findOneByDhInclusao(string $dh_inclusao) Return the first ChildPageData filtered by the dh_inclusao column
 * @method     ChildPageData findOneByDhAlteracao(string $dh_alteracao) Return the first ChildPageData filtered by the dh_alteracao column *

 * @method     ChildPageData requirePk($key, ConnectionInterface $con = null) Return the ChildPageData by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPageData requireOne(ConnectionInterface $con = null) Return the first ChildPageData matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPageData requireOneByPageId(int $page_id) Return the first ChildPageData filtered by the page_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPageData requireOneByName(string $name) Return the first ChildPageData filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPageData requireOneByValue(string $value) Return the first ChildPageData filtered by the value column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPageData requireOneByDhInclusao(string $dh_inclusao) Return the first ChildPageData filtered by the dh_inclusao column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPageData requireOneByDhAlteracao(string $dh_alteracao) Return the first ChildPageData filtered by the dh_alteracao column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPageData[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildPageData objects based on current ModelCriteria
 * @method     ChildPageData[]|ObjectCollection findByPageId(int $page_id) Return ChildPageData objects filtered by the page_id column
 * @method     ChildPageData[]|ObjectCollection findByName(string $name) Return ChildPageData objects filtered by the name column
 * @method     ChildPageData[]|ObjectCollection findByValue(string $value) Return ChildPageData objects filtered by the value column
 * @method     ChildPageData[]|ObjectCollection findByDhInclusao(string $dh_inclusao) Return ChildPageData objects filtered by the dh_inclusao column
 * @method     ChildPageData[]|ObjectCollection findByDhAlteracao(string $dh_alteracao) Return ChildPageData objects filtered by the dh_alteracao column
 * @method     ChildPageData[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class PageDataQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\PageDataQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\PageData', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildPageDataQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildPageDataQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildPageDataQuery) {
            return $criteria;
        }
        $query = new ChildPageDataQuery();
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
     * @param array[$page_id, $name] $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildPageData|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = PageDataTableMap::getInstanceFromPool(serialize(array((string) $key[0], (string) $key[1]))))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(PageDataTableMap::DATABASE_NAME);
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
     * @return ChildPageData A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT page_id, name, value, dh_inclusao, dh_alteracao FROM page_data WHERE page_id = :p0 AND name = :p1';
        try {
            $stmt = $con->prepare($sql);            
            $stmt->bindValue(':p0', $key[0], PDO::PARAM_INT);            
            $stmt->bindValue(':p1', $key[1], PDO::PARAM_STR);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildPageData $obj */
            $obj = new ChildPageData();
            $obj->hydrate($row);
            PageDataTableMap::addInstanceToPool($obj, serialize(array((string) $key[0], (string) $key[1])));
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
     * @return ChildPageData|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildPageDataQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(PageDataTableMap::COL_PAGE_ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(PageDataTableMap::COL_NAME, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildPageDataQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(PageDataTableMap::COL_PAGE_ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(PageDataTableMap::COL_NAME, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
            $this->addOr($cton0);
        }

        return $this;
    }

    /**
     * Filter the query on the page_id column
     *
     * Example usage:
     * <code>
     * $query->filterByPageId(1234); // WHERE page_id = 1234
     * $query->filterByPageId(array(12, 34)); // WHERE page_id IN (12, 34)
     * $query->filterByPageId(array('min' => 12)); // WHERE page_id > 12
     * </code>
     *
     * @see       filterByPage()
     *
     * @param     mixed $pageId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPageDataQuery The current query, for fluid interface
     */
    public function filterByPageId($pageId = null, $comparison = null)
    {
        if (is_array($pageId)) {
            $useMinMax = false;
            if (isset($pageId['min'])) {
                $this->addUsingAlias(PageDataTableMap::COL_PAGE_ID, $pageId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($pageId['max'])) {
                $this->addUsingAlias(PageDataTableMap::COL_PAGE_ID, $pageId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PageDataTableMap::COL_PAGE_ID, $pageId, $comparison);
    }

    /**
     * Filter the query on the name column
     *
     * Example usage:
     * <code>
     * $query->filterByName('fooValue');   // WHERE name = 'fooValue'
     * $query->filterByName('%fooValue%'); // WHERE name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $name The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPageDataQuery The current query, for fluid interface
     */
    public function filterByName($name = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($name)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $name)) {
                $name = str_replace('*', '%', $name);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(PageDataTableMap::COL_NAME, $name, $comparison);
    }

    /**
     * Filter the query on the value column
     *
     * Example usage:
     * <code>
     * $query->filterByValue('fooValue');   // WHERE value = 'fooValue'
     * $query->filterByValue('%fooValue%'); // WHERE value LIKE '%fooValue%'
     * </code>
     *
     * @param     string $value The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPageDataQuery The current query, for fluid interface
     */
    public function filterByValue($value = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($value)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $value)) {
                $value = str_replace('*', '%', $value);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(PageDataTableMap::COL_VALUE, $value, $comparison);
    }

    /**
     * Filter the query on the dh_inclusao column
     *
     * Example usage:
     * <code>
     * $query->filterByDhInclusao('fooValue');   // WHERE dh_inclusao = 'fooValue'
     * $query->filterByDhInclusao('%fooValue%'); // WHERE dh_inclusao LIKE '%fooValue%'
     * </code>
     *
     * @param     string $dhInclusao The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPageDataQuery The current query, for fluid interface
     */
    public function filterByDhInclusao($dhInclusao = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($dhInclusao)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $dhInclusao)) {
                $dhInclusao = str_replace('*', '%', $dhInclusao);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(PageDataTableMap::COL_DH_INCLUSAO, $dhInclusao, $comparison);
    }

    /**
     * Filter the query on the dh_alteracao column
     *
     * Example usage:
     * <code>
     * $query->filterByDhAlteracao('fooValue');   // WHERE dh_alteracao = 'fooValue'
     * $query->filterByDhAlteracao('%fooValue%'); // WHERE dh_alteracao LIKE '%fooValue%'
     * </code>
     *
     * @param     string $dhAlteracao The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPageDataQuery The current query, for fluid interface
     */
    public function filterByDhAlteracao($dhAlteracao = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($dhAlteracao)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $dhAlteracao)) {
                $dhAlteracao = str_replace('*', '%', $dhAlteracao);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(PageDataTableMap::COL_DH_ALTERACAO, $dhAlteracao, $comparison);
    }

    /**
     * Filter the query by a related \Page object
     *
     * @param \Page|ObjectCollection $page The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildPageDataQuery The current query, for fluid interface
     */
    public function filterByPage($page, $comparison = null)
    {
        if ($page instanceof \Page) {
            return $this
                ->addUsingAlias(PageDataTableMap::COL_PAGE_ID, $page->getId(), $comparison);
        } elseif ($page instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(PageDataTableMap::COL_PAGE_ID, $page->toKeyValue('Id', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByPage() only accepts arguments of type \Page or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Page relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildPageDataQuery The current query, for fluid interface
     */
    public function joinPage($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Page');

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
            $this->addJoinObject($join, 'Page');
        }

        return $this;
    }

    /**
     * Use the Page relation Page object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \PageQuery A secondary query class using the current class as primary query
     */
    public function usePageQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPage($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Page', '\PageQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildPageData $pageData Object to remove from the list of results
     *
     * @return $this|ChildPageDataQuery The current query, for fluid interface
     */
    public function prune($pageData = null)
    {
        if ($pageData) {
            $this->addCond('pruneCond0', $this->getAliasedColName(PageDataTableMap::COL_PAGE_ID), $pageData->getPageId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(PageDataTableMap::COL_NAME), $pageData->getName(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

    /**
     * Deletes all rows from the page_data table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PageDataTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            PageDataTableMap::clearInstancePool();
            PageDataTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(PageDataTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(PageDataTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            
            PageDataTableMap::removeInstanceFromPool($criteria);
        
            $affectedRows += ModelCriteria::delete($con);
            PageDataTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // PageDataQuery
