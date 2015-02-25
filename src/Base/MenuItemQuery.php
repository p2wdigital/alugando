<?php

namespace Base;

use \MenuItem as ChildMenuItem;
use \MenuItemQuery as ChildMenuItemQuery;
use \Exception;
use \PDO;
use Map\MenuItemTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'menu_item' table.
 *
 * 
 *
 * @method     ChildMenuItemQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildMenuItemQuery orderByMenuId($order = Criteria::ASC) Order by the menu_id column
 * @method     ChildMenuItemQuery orderByRotulo($order = Criteria::ASC) Order by the rotulo column
 * @method     ChildMenuItemQuery orderByTitle($order = Criteria::ASC) Order by the title column
 * @method     ChildMenuItemQuery orderByParent($order = Criteria::ASC) Order by the parent column
 * @method     ChildMenuItemQuery orderByTipo($order = Criteria::ASC) Order by the tipo column
 * @method     ChildMenuItemQuery orderByTipoId($order = Criteria::ASC) Order by the tipo_id column
 * @method     ChildMenuItemQuery orderByOrdem($order = Criteria::ASC) Order by the ordem column
 * @method     ChildMenuItemQuery orderByDados($order = Criteria::ASC) Order by the dados column
 * @method     ChildMenuItemQuery orderByDhInclusao($order = Criteria::ASC) Order by the dh_inclusao column
 * @method     ChildMenuItemQuery orderByDhAlteracao($order = Criteria::ASC) Order by the dh_alteracao column
 *
 * @method     ChildMenuItemQuery groupById() Group by the id column
 * @method     ChildMenuItemQuery groupByMenuId() Group by the menu_id column
 * @method     ChildMenuItemQuery groupByRotulo() Group by the rotulo column
 * @method     ChildMenuItemQuery groupByTitle() Group by the title column
 * @method     ChildMenuItemQuery groupByParent() Group by the parent column
 * @method     ChildMenuItemQuery groupByTipo() Group by the tipo column
 * @method     ChildMenuItemQuery groupByTipoId() Group by the tipo_id column
 * @method     ChildMenuItemQuery groupByOrdem() Group by the ordem column
 * @method     ChildMenuItemQuery groupByDados() Group by the dados column
 * @method     ChildMenuItemQuery groupByDhInclusao() Group by the dh_inclusao column
 * @method     ChildMenuItemQuery groupByDhAlteracao() Group by the dh_alteracao column
 *
 * @method     ChildMenuItemQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildMenuItemQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildMenuItemQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildMenuItemQuery leftJoinMenu($relationAlias = null) Adds a LEFT JOIN clause to the query using the Menu relation
 * @method     ChildMenuItemQuery rightJoinMenu($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Menu relation
 * @method     ChildMenuItemQuery innerJoinMenu($relationAlias = null) Adds a INNER JOIN clause to the query using the Menu relation
 *
 * @method     \MenuQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildMenuItem findOne(ConnectionInterface $con = null) Return the first ChildMenuItem matching the query
 * @method     ChildMenuItem findOneOrCreate(ConnectionInterface $con = null) Return the first ChildMenuItem matching the query, or a new ChildMenuItem object populated from the query conditions when no match is found
 *
 * @method     ChildMenuItem findOneById(int $id) Return the first ChildMenuItem filtered by the id column
 * @method     ChildMenuItem findOneByMenuId(int $menu_id) Return the first ChildMenuItem filtered by the menu_id column
 * @method     ChildMenuItem findOneByRotulo(string $rotulo) Return the first ChildMenuItem filtered by the rotulo column
 * @method     ChildMenuItem findOneByTitle(string $title) Return the first ChildMenuItem filtered by the title column
 * @method     ChildMenuItem findOneByParent(int $parent) Return the first ChildMenuItem filtered by the parent column
 * @method     ChildMenuItem findOneByTipo(string $tipo) Return the first ChildMenuItem filtered by the tipo column
 * @method     ChildMenuItem findOneByTipoId(int $tipo_id) Return the first ChildMenuItem filtered by the tipo_id column
 * @method     ChildMenuItem findOneByOrdem(int $ordem) Return the first ChildMenuItem filtered by the ordem column
 * @method     ChildMenuItem findOneByDados(string $dados) Return the first ChildMenuItem filtered by the dados column
 * @method     ChildMenuItem findOneByDhInclusao(string $dh_inclusao) Return the first ChildMenuItem filtered by the dh_inclusao column
 * @method     ChildMenuItem findOneByDhAlteracao(string $dh_alteracao) Return the first ChildMenuItem filtered by the dh_alteracao column *

 * @method     ChildMenuItem requirePk($key, ConnectionInterface $con = null) Return the ChildMenuItem by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMenuItem requireOne(ConnectionInterface $con = null) Return the first ChildMenuItem matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildMenuItem requireOneById(int $id) Return the first ChildMenuItem filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMenuItem requireOneByMenuId(int $menu_id) Return the first ChildMenuItem filtered by the menu_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMenuItem requireOneByRotulo(string $rotulo) Return the first ChildMenuItem filtered by the rotulo column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMenuItem requireOneByTitle(string $title) Return the first ChildMenuItem filtered by the title column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMenuItem requireOneByParent(int $parent) Return the first ChildMenuItem filtered by the parent column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMenuItem requireOneByTipo(string $tipo) Return the first ChildMenuItem filtered by the tipo column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMenuItem requireOneByTipoId(int $tipo_id) Return the first ChildMenuItem filtered by the tipo_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMenuItem requireOneByOrdem(int $ordem) Return the first ChildMenuItem filtered by the ordem column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMenuItem requireOneByDados(string $dados) Return the first ChildMenuItem filtered by the dados column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMenuItem requireOneByDhInclusao(string $dh_inclusao) Return the first ChildMenuItem filtered by the dh_inclusao column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMenuItem requireOneByDhAlteracao(string $dh_alteracao) Return the first ChildMenuItem filtered by the dh_alteracao column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildMenuItem[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildMenuItem objects based on current ModelCriteria
 * @method     ChildMenuItem[]|ObjectCollection findById(int $id) Return ChildMenuItem objects filtered by the id column
 * @method     ChildMenuItem[]|ObjectCollection findByMenuId(int $menu_id) Return ChildMenuItem objects filtered by the menu_id column
 * @method     ChildMenuItem[]|ObjectCollection findByRotulo(string $rotulo) Return ChildMenuItem objects filtered by the rotulo column
 * @method     ChildMenuItem[]|ObjectCollection findByTitle(string $title) Return ChildMenuItem objects filtered by the title column
 * @method     ChildMenuItem[]|ObjectCollection findByParent(int $parent) Return ChildMenuItem objects filtered by the parent column
 * @method     ChildMenuItem[]|ObjectCollection findByTipo(string $tipo) Return ChildMenuItem objects filtered by the tipo column
 * @method     ChildMenuItem[]|ObjectCollection findByTipoId(int $tipo_id) Return ChildMenuItem objects filtered by the tipo_id column
 * @method     ChildMenuItem[]|ObjectCollection findByOrdem(int $ordem) Return ChildMenuItem objects filtered by the ordem column
 * @method     ChildMenuItem[]|ObjectCollection findByDados(string $dados) Return ChildMenuItem objects filtered by the dados column
 * @method     ChildMenuItem[]|ObjectCollection findByDhInclusao(string $dh_inclusao) Return ChildMenuItem objects filtered by the dh_inclusao column
 * @method     ChildMenuItem[]|ObjectCollection findByDhAlteracao(string $dh_alteracao) Return ChildMenuItem objects filtered by the dh_alteracao column
 * @method     ChildMenuItem[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class MenuItemQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\MenuItemQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\MenuItem', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildMenuItemQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildMenuItemQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildMenuItemQuery) {
            return $criteria;
        }
        $query = new ChildMenuItemQuery();
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
     * @param array[$id, $menu_id] $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildMenuItem|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = MenuItemTableMap::getInstanceFromPool(serialize(array((string) $key[0], (string) $key[1]))))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(MenuItemTableMap::DATABASE_NAME);
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
     * @return ChildMenuItem A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, menu_id, rotulo, title, parent, tipo, tipo_id, ordem, dados, dh_inclusao, dh_alteracao FROM menu_item WHERE id = :p0 AND menu_id = :p1';
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
            /** @var ChildMenuItem $obj */
            $obj = new ChildMenuItem();
            $obj->hydrate($row);
            MenuItemTableMap::addInstanceToPool($obj, serialize(array((string) $key[0], (string) $key[1])));
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
     * @return ChildMenuItem|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildMenuItemQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(MenuItemTableMap::COL_ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(MenuItemTableMap::COL_MENU_ID, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildMenuItemQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(MenuItemTableMap::COL_ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(MenuItemTableMap::COL_MENU_ID, $key[1], Criteria::EQUAL);
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
     * @return $this|ChildMenuItemQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(MenuItemTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(MenuItemTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MenuItemTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the menu_id column
     *
     * Example usage:
     * <code>
     * $query->filterByMenuId(1234); // WHERE menu_id = 1234
     * $query->filterByMenuId(array(12, 34)); // WHERE menu_id IN (12, 34)
     * $query->filterByMenuId(array('min' => 12)); // WHERE menu_id > 12
     * </code>
     *
     * @see       filterByMenu()
     *
     * @param     mixed $menuId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildMenuItemQuery The current query, for fluid interface
     */
    public function filterByMenuId($menuId = null, $comparison = null)
    {
        if (is_array($menuId)) {
            $useMinMax = false;
            if (isset($menuId['min'])) {
                $this->addUsingAlias(MenuItemTableMap::COL_MENU_ID, $menuId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($menuId['max'])) {
                $this->addUsingAlias(MenuItemTableMap::COL_MENU_ID, $menuId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MenuItemTableMap::COL_MENU_ID, $menuId, $comparison);
    }

    /**
     * Filter the query on the rotulo column
     *
     * Example usage:
     * <code>
     * $query->filterByRotulo('fooValue');   // WHERE rotulo = 'fooValue'
     * $query->filterByRotulo('%fooValue%'); // WHERE rotulo LIKE '%fooValue%'
     * </code>
     *
     * @param     string $rotulo The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildMenuItemQuery The current query, for fluid interface
     */
    public function filterByRotulo($rotulo = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($rotulo)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $rotulo)) {
                $rotulo = str_replace('*', '%', $rotulo);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(MenuItemTableMap::COL_ROTULO, $rotulo, $comparison);
    }

    /**
     * Filter the query on the title column
     *
     * Example usage:
     * <code>
     * $query->filterByTitle('fooValue');   // WHERE title = 'fooValue'
     * $query->filterByTitle('%fooValue%'); // WHERE title LIKE '%fooValue%'
     * </code>
     *
     * @param     string $title The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildMenuItemQuery The current query, for fluid interface
     */
    public function filterByTitle($title = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($title)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $title)) {
                $title = str_replace('*', '%', $title);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(MenuItemTableMap::COL_TITLE, $title, $comparison);
    }

    /**
     * Filter the query on the parent column
     *
     * Example usage:
     * <code>
     * $query->filterByParent(1234); // WHERE parent = 1234
     * $query->filterByParent(array(12, 34)); // WHERE parent IN (12, 34)
     * $query->filterByParent(array('min' => 12)); // WHERE parent > 12
     * </code>
     *
     * @param     mixed $parent The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildMenuItemQuery The current query, for fluid interface
     */
    public function filterByParent($parent = null, $comparison = null)
    {
        if (is_array($parent)) {
            $useMinMax = false;
            if (isset($parent['min'])) {
                $this->addUsingAlias(MenuItemTableMap::COL_PARENT, $parent['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($parent['max'])) {
                $this->addUsingAlias(MenuItemTableMap::COL_PARENT, $parent['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MenuItemTableMap::COL_PARENT, $parent, $comparison);
    }

    /**
     * Filter the query on the tipo column
     *
     * Example usage:
     * <code>
     * $query->filterByTipo('fooValue');   // WHERE tipo = 'fooValue'
     * $query->filterByTipo('%fooValue%'); // WHERE tipo LIKE '%fooValue%'
     * </code>
     *
     * @param     string $tipo The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildMenuItemQuery The current query, for fluid interface
     */
    public function filterByTipo($tipo = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($tipo)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $tipo)) {
                $tipo = str_replace('*', '%', $tipo);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(MenuItemTableMap::COL_TIPO, $tipo, $comparison);
    }

    /**
     * Filter the query on the tipo_id column
     *
     * Example usage:
     * <code>
     * $query->filterByTipoId(1234); // WHERE tipo_id = 1234
     * $query->filterByTipoId(array(12, 34)); // WHERE tipo_id IN (12, 34)
     * $query->filterByTipoId(array('min' => 12)); // WHERE tipo_id > 12
     * </code>
     *
     * @param     mixed $tipoId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildMenuItemQuery The current query, for fluid interface
     */
    public function filterByTipoId($tipoId = null, $comparison = null)
    {
        if (is_array($tipoId)) {
            $useMinMax = false;
            if (isset($tipoId['min'])) {
                $this->addUsingAlias(MenuItemTableMap::COL_TIPO_ID, $tipoId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($tipoId['max'])) {
                $this->addUsingAlias(MenuItemTableMap::COL_TIPO_ID, $tipoId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MenuItemTableMap::COL_TIPO_ID, $tipoId, $comparison);
    }

    /**
     * Filter the query on the ordem column
     *
     * Example usage:
     * <code>
     * $query->filterByOrdem(1234); // WHERE ordem = 1234
     * $query->filterByOrdem(array(12, 34)); // WHERE ordem IN (12, 34)
     * $query->filterByOrdem(array('min' => 12)); // WHERE ordem > 12
     * </code>
     *
     * @param     mixed $ordem The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildMenuItemQuery The current query, for fluid interface
     */
    public function filterByOrdem($ordem = null, $comparison = null)
    {
        if (is_array($ordem)) {
            $useMinMax = false;
            if (isset($ordem['min'])) {
                $this->addUsingAlias(MenuItemTableMap::COL_ORDEM, $ordem['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($ordem['max'])) {
                $this->addUsingAlias(MenuItemTableMap::COL_ORDEM, $ordem['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MenuItemTableMap::COL_ORDEM, $ordem, $comparison);
    }

    /**
     * Filter the query on the dados column
     *
     * Example usage:
     * <code>
     * $query->filterByDados('fooValue');   // WHERE dados = 'fooValue'
     * $query->filterByDados('%fooValue%'); // WHERE dados LIKE '%fooValue%'
     * </code>
     *
     * @param     string $dados The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildMenuItemQuery The current query, for fluid interface
     */
    public function filterByDados($dados = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($dados)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $dados)) {
                $dados = str_replace('*', '%', $dados);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(MenuItemTableMap::COL_DADOS, $dados, $comparison);
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
     * @return $this|ChildMenuItemQuery The current query, for fluid interface
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

        return $this->addUsingAlias(MenuItemTableMap::COL_DH_INCLUSAO, $dhInclusao, $comparison);
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
     * @return $this|ChildMenuItemQuery The current query, for fluid interface
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

        return $this->addUsingAlias(MenuItemTableMap::COL_DH_ALTERACAO, $dhAlteracao, $comparison);
    }

    /**
     * Filter the query by a related \Menu object
     *
     * @param \Menu|ObjectCollection $menu The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildMenuItemQuery The current query, for fluid interface
     */
    public function filterByMenu($menu, $comparison = null)
    {
        if ($menu instanceof \Menu) {
            return $this
                ->addUsingAlias(MenuItemTableMap::COL_MENU_ID, $menu->getId(), $comparison);
        } elseif ($menu instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(MenuItemTableMap::COL_MENU_ID, $menu->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByMenu() only accepts arguments of type \Menu or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Menu relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildMenuItemQuery The current query, for fluid interface
     */
    public function joinMenu($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Menu');

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
            $this->addJoinObject($join, 'Menu');
        }

        return $this;
    }

    /**
     * Use the Menu relation Menu object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \MenuQuery A secondary query class using the current class as primary query
     */
    public function useMenuQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinMenu($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Menu', '\MenuQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildMenuItem $menuItem Object to remove from the list of results
     *
     * @return $this|ChildMenuItemQuery The current query, for fluid interface
     */
    public function prune($menuItem = null)
    {
        if ($menuItem) {
            $this->addCond('pruneCond0', $this->getAliasedColName(MenuItemTableMap::COL_ID), $menuItem->getId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(MenuItemTableMap::COL_MENU_ID), $menuItem->getMenuId(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

    /**
     * Deletes all rows from the menu_item table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(MenuItemTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            MenuItemTableMap::clearInstancePool();
            MenuItemTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(MenuItemTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(MenuItemTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            
            MenuItemTableMap::removeInstanceFromPool($criteria);
        
            $affectedRows += ModelCriteria::delete($con);
            MenuItemTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // MenuItemQuery
