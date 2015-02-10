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
use Table\Model\Categoria as ChildCategoria;
use Table\Model\CategoriaQuery as ChildCategoriaQuery;
use Table\Model\Map\CategoriaTableMap;

/**
 * Base class that represents a query for the 'categoria' table.
 *
 *
 *
 * @method     ChildCategoriaQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildCategoriaQuery orderByNome($order = Criteria::ASC) Order by the nome column
 * @method     ChildCategoriaQuery orderByUrl($order = Criteria::ASC) Order by the url column
 * @method     ChildCategoriaQuery orderByDescricao($order = Criteria::ASC) Order by the descricao column
 *
 * @method     ChildCategoriaQuery groupById() Group by the id column
 * @method     ChildCategoriaQuery groupByNome() Group by the nome column
 * @method     ChildCategoriaQuery groupByUrl() Group by the url column
 * @method     ChildCategoriaQuery groupByDescricao() Group by the descricao column
 *
 * @method     ChildCategoriaQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildCategoriaQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildCategoriaQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildCategoriaQuery leftJoinPostHasCategoria($relationAlias = null) Adds a LEFT JOIN clause to the query using the PostHasCategoria relation
 * @method     ChildCategoriaQuery rightJoinPostHasCategoria($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PostHasCategoria relation
 * @method     ChildCategoriaQuery innerJoinPostHasCategoria($relationAlias = null) Adds a INNER JOIN clause to the query using the PostHasCategoria relation
 *
 * @method     \Table\Model\PostHasCategoriaQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildCategoria findOne(ConnectionInterface $con = null) Return the first ChildCategoria matching the query
 * @method     ChildCategoria findOneOrCreate(ConnectionInterface $con = null) Return the first ChildCategoria matching the query, or a new ChildCategoria object populated from the query conditions when no match is found
 *
 * @method     ChildCategoria findOneById(int $id) Return the first ChildCategoria filtered by the id column
 * @method     ChildCategoria findOneByNome(string $nome) Return the first ChildCategoria filtered by the nome column
 * @method     ChildCategoria findOneByUrl(string $url) Return the first ChildCategoria filtered by the url column
 * @method     ChildCategoria findOneByDescricao(string $descricao) Return the first ChildCategoria filtered by the descricao column *

 * @method     ChildCategoria requirePk($key, ConnectionInterface $con = null) Return the ChildCategoria by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCategoria requireOne(ConnectionInterface $con = null) Return the first ChildCategoria matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCategoria requireOneById(int $id) Return the first ChildCategoria filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCategoria requireOneByNome(string $nome) Return the first ChildCategoria filtered by the nome column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCategoria requireOneByUrl(string $url) Return the first ChildCategoria filtered by the url column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCategoria requireOneByDescricao(string $descricao) Return the first ChildCategoria filtered by the descricao column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCategoria[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildCategoria objects based on current ModelCriteria
 * @method     ChildCategoria[]|ObjectCollection findById(int $id) Return ChildCategoria objects filtered by the id column
 * @method     ChildCategoria[]|ObjectCollection findByNome(string $nome) Return ChildCategoria objects filtered by the nome column
 * @method     ChildCategoria[]|ObjectCollection findByUrl(string $url) Return ChildCategoria objects filtered by the url column
 * @method     ChildCategoria[]|ObjectCollection findByDescricao(string $descricao) Return ChildCategoria objects filtered by the descricao column
 * @method     ChildCategoria[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class CategoriaQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Table\Model\Base\CategoriaQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Table\\Model\\Categoria', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildCategoriaQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildCategoriaQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildCategoriaQuery) {
            return $criteria;
        }
        $query = new ChildCategoriaQuery();
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
     * @return ChildCategoria|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = CategoriaTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(CategoriaTableMap::DATABASE_NAME);
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
     * @return ChildCategoria A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, nome, url, descricao FROM categoria WHERE id = :p0';
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
            /** @var ChildCategoria $obj */
            $obj = new ChildCategoria();
            $obj->hydrate($row);
            CategoriaTableMap::addInstanceToPool($obj, (string) $key);
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
     * @return ChildCategoria|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildCategoriaQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(CategoriaTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildCategoriaQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(CategoriaTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildCategoriaQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(CategoriaTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(CategoriaTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CategoriaTableMap::COL_ID, $id, $comparison);
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
     * @return $this|ChildCategoriaQuery The current query, for fluid interface
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

        return $this->addUsingAlias(CategoriaTableMap::COL_NOME, $nome, $comparison);
    }

    /**
     * Filter the query on the url column
     *
     * Example usage:
     * <code>
     * $query->filterByUrl('fooValue');   // WHERE url = 'fooValue'
     * $query->filterByUrl('%fooValue%'); // WHERE url LIKE '%fooValue%'
     * </code>
     *
     * @param     string $url The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCategoriaQuery The current query, for fluid interface
     */
    public function filterByUrl($url = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($url)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $url)) {
                $url = str_replace('*', '%', $url);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CategoriaTableMap::COL_URL, $url, $comparison);
    }

    /**
     * Filter the query on the descricao column
     *
     * Example usage:
     * <code>
     * $query->filterByDescricao('fooValue');   // WHERE descricao = 'fooValue'
     * $query->filterByDescricao('%fooValue%'); // WHERE descricao LIKE '%fooValue%'
     * </code>
     *
     * @param     string $descricao The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCategoriaQuery The current query, for fluid interface
     */
    public function filterByDescricao($descricao = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($descricao)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $descricao)) {
                $descricao = str_replace('*', '%', $descricao);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(CategoriaTableMap::COL_DESCRICAO, $descricao, $comparison);
    }

    /**
     * Filter the query by a related \Table\Model\PostHasCategoria object
     *
     * @param \Table\Model\PostHasCategoria|ObjectCollection $postHasCategoria the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildCategoriaQuery The current query, for fluid interface
     */
    public function filterByPostHasCategoria($postHasCategoria, $comparison = null)
    {
        if ($postHasCategoria instanceof \Table\Model\PostHasCategoria) {
            return $this
                ->addUsingAlias(CategoriaTableMap::COL_ID, $postHasCategoria->getCategoriaId(), $comparison);
        } elseif ($postHasCategoria instanceof ObjectCollection) {
            return $this
                ->usePostHasCategoriaQuery()
                ->filterByPrimaryKeys($postHasCategoria->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByPostHasCategoria() only accepts arguments of type \Table\Model\PostHasCategoria or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the PostHasCategoria relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildCategoriaQuery The current query, for fluid interface
     */
    public function joinPostHasCategoria($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('PostHasCategoria');

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
            $this->addJoinObject($join, 'PostHasCategoria');
        }

        return $this;
    }

    /**
     * Use the PostHasCategoria relation PostHasCategoria object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Table\Model\PostHasCategoriaQuery A secondary query class using the current class as primary query
     */
    public function usePostHasCategoriaQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPostHasCategoria($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'PostHasCategoria', '\Table\Model\PostHasCategoriaQuery');
    }

    /**
     * Filter the query by a related Post object
     * using the post_has_categoria table as cross reference
     *
     * @param Post $post the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildCategoriaQuery The current query, for fluid interface
     */
    public function filterByPost($post, $comparison = Criteria::EQUAL)
    {
        return $this
            ->usePostHasCategoriaQuery()
            ->filterByPost($post, $comparison)
            ->endUse();
    }

    /**
     * Exclude object from result
     *
     * @param   ChildCategoria $categoria Object to remove from the list of results
     *
     * @return $this|ChildCategoriaQuery The current query, for fluid interface
     */
    public function prune($categoria = null)
    {
        if ($categoria) {
            $this->addUsingAlias(CategoriaTableMap::COL_ID, $categoria->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the categoria table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CategoriaTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            CategoriaTableMap::clearInstancePool();
            CategoriaTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(CategoriaTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(CategoriaTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            CategoriaTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            CategoriaTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // CategoriaQuery
