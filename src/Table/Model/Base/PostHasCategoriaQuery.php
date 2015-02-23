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
use Table\Model\PostHasCategoria as ChildPostHasCategoria;
use Table\Model\PostHasCategoriaQuery as ChildPostHasCategoriaQuery;
use Table\Model\Map\PostHasCategoriaTableMap;

/**
 * Base class that represents a query for the 'post_has_categoria' table.
 *
 * 
 *
 * @method     ChildPostHasCategoriaQuery orderByPostId($order = Criteria::ASC) Order by the post_id column
 * @method     ChildPostHasCategoriaQuery orderByCategoriaId($order = Criteria::ASC) Order by the categoria_id column
 *
 * @method     ChildPostHasCategoriaQuery groupByPostId() Group by the post_id column
 * @method     ChildPostHasCategoriaQuery groupByCategoriaId() Group by the categoria_id column
 *
 * @method     ChildPostHasCategoriaQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildPostHasCategoriaQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildPostHasCategoriaQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildPostHasCategoriaQuery leftJoinPost($relationAlias = null) Adds a LEFT JOIN clause to the query using the Post relation
 * @method     ChildPostHasCategoriaQuery rightJoinPost($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Post relation
 * @method     ChildPostHasCategoriaQuery innerJoinPost($relationAlias = null) Adds a INNER JOIN clause to the query using the Post relation
 *
 * @method     ChildPostHasCategoriaQuery leftJoinCategoria($relationAlias = null) Adds a LEFT JOIN clause to the query using the Categoria relation
 * @method     ChildPostHasCategoriaQuery rightJoinCategoria($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Categoria relation
 * @method     ChildPostHasCategoriaQuery innerJoinCategoria($relationAlias = null) Adds a INNER JOIN clause to the query using the Categoria relation
 *
 * @method     \Table\Model\PostQuery|\Table\Model\CategoriaQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildPostHasCategoria findOne(ConnectionInterface $con = null) Return the first ChildPostHasCategoria matching the query
 * @method     ChildPostHasCategoria findOneOrCreate(ConnectionInterface $con = null) Return the first ChildPostHasCategoria matching the query, or a new ChildPostHasCategoria object populated from the query conditions when no match is found
 *
 * @method     ChildPostHasCategoria findOneByPostId(int $post_id) Return the first ChildPostHasCategoria filtered by the post_id column
 * @method     ChildPostHasCategoria findOneByCategoriaId(int $categoria_id) Return the first ChildPostHasCategoria filtered by the categoria_id column *

 * @method     ChildPostHasCategoria requirePk($key, ConnectionInterface $con = null) Return the ChildPostHasCategoria by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPostHasCategoria requireOne(ConnectionInterface $con = null) Return the first ChildPostHasCategoria matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPostHasCategoria requireOneByPostId(int $post_id) Return the first ChildPostHasCategoria filtered by the post_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPostHasCategoria requireOneByCategoriaId(int $categoria_id) Return the first ChildPostHasCategoria filtered by the categoria_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPostHasCategoria[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildPostHasCategoria objects based on current ModelCriteria
 * @method     ChildPostHasCategoria[]|ObjectCollection findByPostId(int $post_id) Return ChildPostHasCategoria objects filtered by the post_id column
 * @method     ChildPostHasCategoria[]|ObjectCollection findByCategoriaId(int $categoria_id) Return ChildPostHasCategoria objects filtered by the categoria_id column
 * @method     ChildPostHasCategoria[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class PostHasCategoriaQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Table\Model\Base\PostHasCategoriaQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Table\\Model\\PostHasCategoria', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildPostHasCategoriaQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildPostHasCategoriaQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildPostHasCategoriaQuery) {
            return $criteria;
        }
        $query = new ChildPostHasCategoriaQuery();
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
     * @param array[$post_id, $categoria_id] $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildPostHasCategoria|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = PostHasCategoriaTableMap::getInstanceFromPool(serialize(array((string) $key[0], (string) $key[1]))))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(PostHasCategoriaTableMap::DATABASE_NAME);
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
     * @return ChildPostHasCategoria A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT post_id, categoria_id FROM post_has_categoria WHERE post_id = :p0 AND categoria_id = :p1';
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
            /** @var ChildPostHasCategoria $obj */
            $obj = new ChildPostHasCategoria();
            $obj->hydrate($row);
            PostHasCategoriaTableMap::addInstanceToPool($obj, serialize(array((string) $key[0], (string) $key[1])));
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
     * @return ChildPostHasCategoria|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildPostHasCategoriaQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(PostHasCategoriaTableMap::COL_POST_ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(PostHasCategoriaTableMap::COL_CATEGORIA_ID, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildPostHasCategoriaQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(PostHasCategoriaTableMap::COL_POST_ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(PostHasCategoriaTableMap::COL_CATEGORIA_ID, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
            $this->addOr($cton0);
        }

        return $this;
    }

    /**
     * Filter the query on the post_id column
     *
     * Example usage:
     * <code>
     * $query->filterByPostId(1234); // WHERE post_id = 1234
     * $query->filterByPostId(array(12, 34)); // WHERE post_id IN (12, 34)
     * $query->filterByPostId(array('min' => 12)); // WHERE post_id > 12
     * </code>
     *
     * @see       filterByPost()
     *
     * @param     mixed $postId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPostHasCategoriaQuery The current query, for fluid interface
     */
    public function filterByPostId($postId = null, $comparison = null)
    {
        if (is_array($postId)) {
            $useMinMax = false;
            if (isset($postId['min'])) {
                $this->addUsingAlias(PostHasCategoriaTableMap::COL_POST_ID, $postId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($postId['max'])) {
                $this->addUsingAlias(PostHasCategoriaTableMap::COL_POST_ID, $postId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PostHasCategoriaTableMap::COL_POST_ID, $postId, $comparison);
    }

    /**
     * Filter the query on the categoria_id column
     *
     * Example usage:
     * <code>
     * $query->filterByCategoriaId(1234); // WHERE categoria_id = 1234
     * $query->filterByCategoriaId(array(12, 34)); // WHERE categoria_id IN (12, 34)
     * $query->filterByCategoriaId(array('min' => 12)); // WHERE categoria_id > 12
     * </code>
     *
     * @see       filterByCategoria()
     *
     * @param     mixed $categoriaId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPostHasCategoriaQuery The current query, for fluid interface
     */
    public function filterByCategoriaId($categoriaId = null, $comparison = null)
    {
        if (is_array($categoriaId)) {
            $useMinMax = false;
            if (isset($categoriaId['min'])) {
                $this->addUsingAlias(PostHasCategoriaTableMap::COL_CATEGORIA_ID, $categoriaId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($categoriaId['max'])) {
                $this->addUsingAlias(PostHasCategoriaTableMap::COL_CATEGORIA_ID, $categoriaId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PostHasCategoriaTableMap::COL_CATEGORIA_ID, $categoriaId, $comparison);
    }

    /**
     * Filter the query by a related \Table\Model\Post object
     *
     * @param \Table\Model\Post|ObjectCollection $post The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildPostHasCategoriaQuery The current query, for fluid interface
     */
    public function filterByPost($post, $comparison = null)
    {
        if ($post instanceof \Table\Model\Post) {
            return $this
                ->addUsingAlias(PostHasCategoriaTableMap::COL_POST_ID, $post->getId(), $comparison);
        } elseif ($post instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(PostHasCategoriaTableMap::COL_POST_ID, $post->toKeyValue('Id', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByPost() only accepts arguments of type \Table\Model\Post or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Post relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildPostHasCategoriaQuery The current query, for fluid interface
     */
    public function joinPost($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Post');

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
            $this->addJoinObject($join, 'Post');
        }

        return $this;
    }

    /**
     * Use the Post relation Post object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Table\Model\PostQuery A secondary query class using the current class as primary query
     */
    public function usePostQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPost($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Post', '\Table\Model\PostQuery');
    }

    /**
     * Filter the query by a related \Table\Model\Categoria object
     *
     * @param \Table\Model\Categoria|ObjectCollection $categoria The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildPostHasCategoriaQuery The current query, for fluid interface
     */
    public function filterByCategoria($categoria, $comparison = null)
    {
        if ($categoria instanceof \Table\Model\Categoria) {
            return $this
                ->addUsingAlias(PostHasCategoriaTableMap::COL_CATEGORIA_ID, $categoria->getId(), $comparison);
        } elseif ($categoria instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(PostHasCategoriaTableMap::COL_CATEGORIA_ID, $categoria->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByCategoria() only accepts arguments of type \Table\Model\Categoria or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Categoria relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildPostHasCategoriaQuery The current query, for fluid interface
     */
    public function joinCategoria($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Categoria');

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
            $this->addJoinObject($join, 'Categoria');
        }

        return $this;
    }

    /**
     * Use the Categoria relation Categoria object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Table\Model\CategoriaQuery A secondary query class using the current class as primary query
     */
    public function useCategoriaQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinCategoria($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Categoria', '\Table\Model\CategoriaQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildPostHasCategoria $postHasCategoria Object to remove from the list of results
     *
     * @return $this|ChildPostHasCategoriaQuery The current query, for fluid interface
     */
    public function prune($postHasCategoria = null)
    {
        if ($postHasCategoria) {
            $this->addCond('pruneCond0', $this->getAliasedColName(PostHasCategoriaTableMap::COL_POST_ID), $postHasCategoria->getPostId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(PostHasCategoriaTableMap::COL_CATEGORIA_ID), $postHasCategoria->getCategoriaId(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

    /**
     * Deletes all rows from the post_has_categoria table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PostHasCategoriaTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            PostHasCategoriaTableMap::clearInstancePool();
            PostHasCategoriaTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(PostHasCategoriaTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(PostHasCategoriaTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            
            PostHasCategoriaTableMap::removeInstanceFromPool($criteria);
        
            $affectedRows += ModelCriteria::delete($con);
            PostHasCategoriaTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // PostHasCategoriaQuery
