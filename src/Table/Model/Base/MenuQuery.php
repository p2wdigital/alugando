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
use Table\Model\Menu as ChildMenu;
use Table\Model\MenuQuery as ChildMenuQuery;
use Table\Model\Map\MenuTableMap;

/**
 * Base class that represents a query for the 'menu' table.
 *
 *
 *
 * @method     ChildMenuQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildMenuQuery orderByNome($order = Criteria::ASC) Order by the nome column
 * @method     ChildMenuQuery orderByPrincipal($order = Criteria::ASC) Order by the principal column
 * @method     ChildMenuQuery orderByDhInclusao($order = Criteria::ASC) Order by the dh_inclusao column
 * @method     ChildMenuQuery orderByDhAlteracao($order = Criteria::ASC) Order by the dh_alteracao column
 *
 * @method     ChildMenuQuery groupById() Group by the id column
 * @method     ChildMenuQuery groupByNome() Group by the nome column
 * @method     ChildMenuQuery groupByPrincipal() Group by the principal column
 * @method     ChildMenuQuery groupByDhInclusao() Group by the dh_inclusao column
 * @method     ChildMenuQuery groupByDhAlteracao() Group by the dh_alteracao column
 *
 * @method     ChildMenuQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildMenuQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildMenuQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildMenuQuery leftJoinMenuItem($relationAlias = null) Adds a LEFT JOIN clause to the query using the MenuItem relation
 * @method     ChildMenuQuery rightJoinMenuItem($relationAlias = null) Adds a RIGHT JOIN clause to the query using the MenuItem relation
 * @method     ChildMenuQuery innerJoinMenuItem($relationAlias = null) Adds a INNER JOIN clause to the query using the MenuItem relation
 *
 * @method     \Table\Model\MenuItemQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildMenu findOne(ConnectionInterface $con = null) Return the first ChildMenu matching the query
 * @method     ChildMenu findOneOrCreate(ConnectionInterface $con = null) Return the first ChildMenu matching the query, or a new ChildMenu object populated from the query conditions when no match is found
 *
 * @method     ChildMenu findOneById(int $id) Return the first ChildMenu filtered by the id column
 * @method     ChildMenu findOneByNome(string $nome) Return the first ChildMenu filtered by the nome column
 * @method     ChildMenu findOneByPrincipal(int $principal) Return the first ChildMenu filtered by the principal column
 * @method     ChildMenu findOneByDhInclusao(string $dh_inclusao) Return the first ChildMenu filtered by the dh_inclusao column
 * @method     ChildMenu findOneByDhAlteracao(string $dh_alteracao) Return the first ChildMenu filtered by the dh_alteracao column *

 * @method     ChildMenu requirePk($key, ConnectionInterface $con = null) Return the ChildMenu by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMenu requireOne(ConnectionInterface $con = null) Return the first ChildMenu matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildMenu requireOneById(int $id) Return the first ChildMenu filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMenu requireOneByNome(string $nome) Return the first ChildMenu filtered by the nome column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMenu requireOneByPrincipal(int $principal) Return the first ChildMenu filtered by the principal column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMenu requireOneByDhInclusao(string $dh_inclusao) Return the first ChildMenu filtered by the dh_inclusao column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMenu requireOneByDhAlteracao(string $dh_alteracao) Return the first ChildMenu filtered by the dh_alteracao column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildMenu[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildMenu objects based on current ModelCriteria
 * @method     ChildMenu[]|ObjectCollection findById(int $id) Return ChildMenu objects filtered by the id column
 * @method     ChildMenu[]|ObjectCollection findByNome(string $nome) Return ChildMenu objects filtered by the nome column
 * @method     ChildMenu[]|ObjectCollection findByPrincipal(int $principal) Return ChildMenu objects filtered by the principal column
 * @method     ChildMenu[]|ObjectCollection findByDhInclusao(string $dh_inclusao) Return ChildMenu objects filtered by the dh_inclusao column
 * @method     ChildMenu[]|ObjectCollection findByDhAlteracao(string $dh_alteracao) Return ChildMenu objects filtered by the dh_alteracao column
 * @method     ChildMenu[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class MenuQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Table\Model\Base\MenuQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Table\\Model\\Menu', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildMenuQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildMenuQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildMenuQuery) {
            return $criteria;
        }
        $query = new ChildMenuQuery();
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
     * @return ChildMenu|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = MenuTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(MenuTableMap::DATABASE_NAME);
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
     * @return ChildMenu A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, nome, principal, dh_inclusao, dh_alteracao FROM menu WHERE id = :p0';
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
            /** @var ChildMenu $obj */
            $obj = new ChildMenu();
            $obj->hydrate($row);
            MenuTableMap::addInstanceToPool($obj, (string) $key);
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
     * @return ChildMenu|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildMenuQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(MenuTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildMenuQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(MenuTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildMenuQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(MenuTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(MenuTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MenuTableMap::COL_ID, $id, $comparison);
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
     * @return $this|ChildMenuQuery The current query, for fluid interface
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

        return $this->addUsingAlias(MenuTableMap::COL_NOME, $nome, $comparison);
    }

    /**
     * Filter the query on the principal column
     *
     * Example usage:
     * <code>
     * $query->filterByPrincipal(1234); // WHERE principal = 1234
     * $query->filterByPrincipal(array(12, 34)); // WHERE principal IN (12, 34)
     * $query->filterByPrincipal(array('min' => 12)); // WHERE principal > 12
     * </code>
     *
     * @param     mixed $principal The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildMenuQuery The current query, for fluid interface
     */
    public function filterByPrincipal($principal = null, $comparison = null)
    {
        if (is_array($principal)) {
            $useMinMax = false;
            if (isset($principal['min'])) {
                $this->addUsingAlias(MenuTableMap::COL_PRINCIPAL, $principal['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($principal['max'])) {
                $this->addUsingAlias(MenuTableMap::COL_PRINCIPAL, $principal['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MenuTableMap::COL_PRINCIPAL, $principal, $comparison);
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
     * @return $this|ChildMenuQuery The current query, for fluid interface
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

        return $this->addUsingAlias(MenuTableMap::COL_DH_INCLUSAO, $dhInclusao, $comparison);
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
     * @return $this|ChildMenuQuery The current query, for fluid interface
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

        return $this->addUsingAlias(MenuTableMap::COL_DH_ALTERACAO, $dhAlteracao, $comparison);
    }

    /**
     * Filter the query by a related \Table\Model\MenuItem object
     *
     * @param \Table\Model\MenuItem|ObjectCollection $menuItem the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildMenuQuery The current query, for fluid interface
     */
    public function filterByMenuItem($menuItem, $comparison = null)
    {
        if ($menuItem instanceof \Table\Model\MenuItem) {
            return $this
                ->addUsingAlias(MenuTableMap::COL_ID, $menuItem->getMenuId(), $comparison);
        } elseif ($menuItem instanceof ObjectCollection) {
            return $this
                ->useMenuItemQuery()
                ->filterByPrimaryKeys($menuItem->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByMenuItem() only accepts arguments of type \Table\Model\MenuItem or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the MenuItem relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildMenuQuery The current query, for fluid interface
     */
    public function joinMenuItem($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('MenuItem');

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
            $this->addJoinObject($join, 'MenuItem');
        }

        return $this;
    }

    /**
     * Use the MenuItem relation MenuItem object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Table\Model\MenuItemQuery A secondary query class using the current class as primary query
     */
    public function useMenuItemQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinMenuItem($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'MenuItem', '\Table\Model\MenuItemQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildMenu $menu Object to remove from the list of results
     *
     * @return $this|ChildMenuQuery The current query, for fluid interface
     */
    public function prune($menu = null)
    {
        if ($menu) {
            $this->addUsingAlias(MenuTableMap::COL_ID, $menu->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the menu table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(MenuTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            MenuTableMap::clearInstancePool();
            MenuTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(MenuTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(MenuTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            MenuTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            MenuTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // MenuQuery
