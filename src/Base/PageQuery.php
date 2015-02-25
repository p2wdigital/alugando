<?php

namespace Base;

use \Page as ChildPage;
use \PageQuery as ChildPageQuery;
use \Exception;
use \PDO;
use Map\PageTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'page' table.
 *
 * 
 *
 * @method     ChildPageQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildPageQuery orderByAutorId($order = Criteria::ASC) Order by the autor_id column
 * @method     ChildPageQuery orderByTitulo($order = Criteria::ASC) Order by the titulo column
 * @method     ChildPageQuery orderByUrl($order = Criteria::ASC) Order by the url column
 * @method     ChildPageQuery orderByContent($order = Criteria::ASC) Order by the content column
 * @method     ChildPageQuery orderByParent($order = Criteria::ASC) Order by the parent column
 * @method     ChildPageQuery orderByOrdem($order = Criteria::ASC) Order by the ordem column
 * @method     ChildPageQuery orderByStatus($order = Criteria::ASC) Order by the status column
 * @method     ChildPageQuery orderByTipo($order = Criteria::ASC) Order by the tipo column
 * @method     ChildPageQuery orderByDhInclusao($order = Criteria::ASC) Order by the dh_inclusao column
 * @method     ChildPageQuery orderByDhAlteracao($order = Criteria::ASC) Order by the dh_alteracao column
 *
 * @method     ChildPageQuery groupById() Group by the id column
 * @method     ChildPageQuery groupByAutorId() Group by the autor_id column
 * @method     ChildPageQuery groupByTitulo() Group by the titulo column
 * @method     ChildPageQuery groupByUrl() Group by the url column
 * @method     ChildPageQuery groupByContent() Group by the content column
 * @method     ChildPageQuery groupByParent() Group by the parent column
 * @method     ChildPageQuery groupByOrdem() Group by the ordem column
 * @method     ChildPageQuery groupByStatus() Group by the status column
 * @method     ChildPageQuery groupByTipo() Group by the tipo column
 * @method     ChildPageQuery groupByDhInclusao() Group by the dh_inclusao column
 * @method     ChildPageQuery groupByDhAlteracao() Group by the dh_alteracao column
 *
 * @method     ChildPageQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildPageQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildPageQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildPageQuery leftJoinAutor($relationAlias = null) Adds a LEFT JOIN clause to the query using the Autor relation
 * @method     ChildPageQuery rightJoinAutor($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Autor relation
 * @method     ChildPageQuery innerJoinAutor($relationAlias = null) Adds a INNER JOIN clause to the query using the Autor relation
 *
 * @method     ChildPageQuery leftJoinPageData($relationAlias = null) Adds a LEFT JOIN clause to the query using the PageData relation
 * @method     ChildPageQuery rightJoinPageData($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PageData relation
 * @method     ChildPageQuery innerJoinPageData($relationAlias = null) Adds a INNER JOIN clause to the query using the PageData relation
 *
 * @method     \AutorQuery|\PageDataQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildPage findOne(ConnectionInterface $con = null) Return the first ChildPage matching the query
 * @method     ChildPage findOneOrCreate(ConnectionInterface $con = null) Return the first ChildPage matching the query, or a new ChildPage object populated from the query conditions when no match is found
 *
 * @method     ChildPage findOneById(int $id) Return the first ChildPage filtered by the id column
 * @method     ChildPage findOneByAutorId(int $autor_id) Return the first ChildPage filtered by the autor_id column
 * @method     ChildPage findOneByTitulo(string $titulo) Return the first ChildPage filtered by the titulo column
 * @method     ChildPage findOneByUrl(string $url) Return the first ChildPage filtered by the url column
 * @method     ChildPage findOneByContent(string $content) Return the first ChildPage filtered by the content column
 * @method     ChildPage findOneByParent(int $parent) Return the first ChildPage filtered by the parent column
 * @method     ChildPage findOneByOrdem(int $ordem) Return the first ChildPage filtered by the ordem column
 * @method     ChildPage findOneByStatus(int $status) Return the first ChildPage filtered by the status column
 * @method     ChildPage findOneByTipo(string $tipo) Return the first ChildPage filtered by the tipo column
 * @method     ChildPage findOneByDhInclusao(string $dh_inclusao) Return the first ChildPage filtered by the dh_inclusao column
 * @method     ChildPage findOneByDhAlteracao(string $dh_alteracao) Return the first ChildPage filtered by the dh_alteracao column *

 * @method     ChildPage requirePk($key, ConnectionInterface $con = null) Return the ChildPage by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPage requireOne(ConnectionInterface $con = null) Return the first ChildPage matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPage requireOneById(int $id) Return the first ChildPage filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPage requireOneByAutorId(int $autor_id) Return the first ChildPage filtered by the autor_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPage requireOneByTitulo(string $titulo) Return the first ChildPage filtered by the titulo column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPage requireOneByUrl(string $url) Return the first ChildPage filtered by the url column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPage requireOneByContent(string $content) Return the first ChildPage filtered by the content column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPage requireOneByParent(int $parent) Return the first ChildPage filtered by the parent column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPage requireOneByOrdem(int $ordem) Return the first ChildPage filtered by the ordem column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPage requireOneByStatus(int $status) Return the first ChildPage filtered by the status column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPage requireOneByTipo(string $tipo) Return the first ChildPage filtered by the tipo column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPage requireOneByDhInclusao(string $dh_inclusao) Return the first ChildPage filtered by the dh_inclusao column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPage requireOneByDhAlteracao(string $dh_alteracao) Return the first ChildPage filtered by the dh_alteracao column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPage[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildPage objects based on current ModelCriteria
 * @method     ChildPage[]|ObjectCollection findById(int $id) Return ChildPage objects filtered by the id column
 * @method     ChildPage[]|ObjectCollection findByAutorId(int $autor_id) Return ChildPage objects filtered by the autor_id column
 * @method     ChildPage[]|ObjectCollection findByTitulo(string $titulo) Return ChildPage objects filtered by the titulo column
 * @method     ChildPage[]|ObjectCollection findByUrl(string $url) Return ChildPage objects filtered by the url column
 * @method     ChildPage[]|ObjectCollection findByContent(string $content) Return ChildPage objects filtered by the content column
 * @method     ChildPage[]|ObjectCollection findByParent(int $parent) Return ChildPage objects filtered by the parent column
 * @method     ChildPage[]|ObjectCollection findByOrdem(int $ordem) Return ChildPage objects filtered by the ordem column
 * @method     ChildPage[]|ObjectCollection findByStatus(int $status) Return ChildPage objects filtered by the status column
 * @method     ChildPage[]|ObjectCollection findByTipo(string $tipo) Return ChildPage objects filtered by the tipo column
 * @method     ChildPage[]|ObjectCollection findByDhInclusao(string $dh_inclusao) Return ChildPage objects filtered by the dh_inclusao column
 * @method     ChildPage[]|ObjectCollection findByDhAlteracao(string $dh_alteracao) Return ChildPage objects filtered by the dh_alteracao column
 * @method     ChildPage[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class PageQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\PageQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Page', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildPageQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildPageQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildPageQuery) {
            return $criteria;
        }
        $query = new ChildPageQuery();
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
     * @param array[$id, $autor_id] $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildPage|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = PageTableMap::getInstanceFromPool(serialize(array((string) $key[0], (string) $key[1]))))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(PageTableMap::DATABASE_NAME);
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
     * @return ChildPage A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, autor_id, titulo, url, content, parent, ordem, status, tipo, dh_inclusao, dh_alteracao FROM page WHERE id = :p0 AND autor_id = :p1';
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
            /** @var ChildPage $obj */
            $obj = new ChildPage();
            $obj->hydrate($row);
            PageTableMap::addInstanceToPool($obj, serialize(array((string) $key[0], (string) $key[1])));
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
     * @return ChildPage|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildPageQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(PageTableMap::COL_ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(PageTableMap::COL_AUTOR_ID, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildPageQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(PageTableMap::COL_ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(PageTableMap::COL_AUTOR_ID, $key[1], Criteria::EQUAL);
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
     * @return $this|ChildPageQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(PageTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(PageTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PageTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the autor_id column
     *
     * Example usage:
     * <code>
     * $query->filterByAutorId(1234); // WHERE autor_id = 1234
     * $query->filterByAutorId(array(12, 34)); // WHERE autor_id IN (12, 34)
     * $query->filterByAutorId(array('min' => 12)); // WHERE autor_id > 12
     * </code>
     *
     * @see       filterByAutor()
     *
     * @param     mixed $autorId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPageQuery The current query, for fluid interface
     */
    public function filterByAutorId($autorId = null, $comparison = null)
    {
        if (is_array($autorId)) {
            $useMinMax = false;
            if (isset($autorId['min'])) {
                $this->addUsingAlias(PageTableMap::COL_AUTOR_ID, $autorId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($autorId['max'])) {
                $this->addUsingAlias(PageTableMap::COL_AUTOR_ID, $autorId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PageTableMap::COL_AUTOR_ID, $autorId, $comparison);
    }

    /**
     * Filter the query on the titulo column
     *
     * Example usage:
     * <code>
     * $query->filterByTitulo('fooValue');   // WHERE titulo = 'fooValue'
     * $query->filterByTitulo('%fooValue%'); // WHERE titulo LIKE '%fooValue%'
     * </code>
     *
     * @param     string $titulo The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPageQuery The current query, for fluid interface
     */
    public function filterByTitulo($titulo = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($titulo)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $titulo)) {
                $titulo = str_replace('*', '%', $titulo);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(PageTableMap::COL_TITULO, $titulo, $comparison);
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
     * @return $this|ChildPageQuery The current query, for fluid interface
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

        return $this->addUsingAlias(PageTableMap::COL_URL, $url, $comparison);
    }

    /**
     * Filter the query on the content column
     *
     * Example usage:
     * <code>
     * $query->filterByContent('fooValue');   // WHERE content = 'fooValue'
     * $query->filterByContent('%fooValue%'); // WHERE content LIKE '%fooValue%'
     * </code>
     *
     * @param     string $content The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPageQuery The current query, for fluid interface
     */
    public function filterByContent($content = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($content)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $content)) {
                $content = str_replace('*', '%', $content);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(PageTableMap::COL_CONTENT, $content, $comparison);
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
     * @return $this|ChildPageQuery The current query, for fluid interface
     */
    public function filterByParent($parent = null, $comparison = null)
    {
        if (is_array($parent)) {
            $useMinMax = false;
            if (isset($parent['min'])) {
                $this->addUsingAlias(PageTableMap::COL_PARENT, $parent['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($parent['max'])) {
                $this->addUsingAlias(PageTableMap::COL_PARENT, $parent['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PageTableMap::COL_PARENT, $parent, $comparison);
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
     * @return $this|ChildPageQuery The current query, for fluid interface
     */
    public function filterByOrdem($ordem = null, $comparison = null)
    {
        if (is_array($ordem)) {
            $useMinMax = false;
            if (isset($ordem['min'])) {
                $this->addUsingAlias(PageTableMap::COL_ORDEM, $ordem['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($ordem['max'])) {
                $this->addUsingAlias(PageTableMap::COL_ORDEM, $ordem['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PageTableMap::COL_ORDEM, $ordem, $comparison);
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
     * @return $this|ChildPageQuery The current query, for fluid interface
     */
    public function filterByStatus($status = null, $comparison = null)
    {
        if (is_array($status)) {
            $useMinMax = false;
            if (isset($status['min'])) {
                $this->addUsingAlias(PageTableMap::COL_STATUS, $status['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($status['max'])) {
                $this->addUsingAlias(PageTableMap::COL_STATUS, $status['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PageTableMap::COL_STATUS, $status, $comparison);
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
     * @return $this|ChildPageQuery The current query, for fluid interface
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

        return $this->addUsingAlias(PageTableMap::COL_TIPO, $tipo, $comparison);
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
     * @return $this|ChildPageQuery The current query, for fluid interface
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

        return $this->addUsingAlias(PageTableMap::COL_DH_INCLUSAO, $dhInclusao, $comparison);
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
     * @return $this|ChildPageQuery The current query, for fluid interface
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

        return $this->addUsingAlias(PageTableMap::COL_DH_ALTERACAO, $dhAlteracao, $comparison);
    }

    /**
     * Filter the query by a related \Autor object
     *
     * @param \Autor|ObjectCollection $autor The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildPageQuery The current query, for fluid interface
     */
    public function filterByAutor($autor, $comparison = null)
    {
        if ($autor instanceof \Autor) {
            return $this
                ->addUsingAlias(PageTableMap::COL_AUTOR_ID, $autor->getId(), $comparison);
        } elseif ($autor instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(PageTableMap::COL_AUTOR_ID, $autor->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByAutor() only accepts arguments of type \Autor or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Autor relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildPageQuery The current query, for fluid interface
     */
    public function joinAutor($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Autor');

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
            $this->addJoinObject($join, 'Autor');
        }

        return $this;
    }

    /**
     * Use the Autor relation Autor object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \AutorQuery A secondary query class using the current class as primary query
     */
    public function useAutorQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinAutor($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Autor', '\AutorQuery');
    }

    /**
     * Filter the query by a related \PageData object
     *
     * @param \PageData|ObjectCollection $pageData the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildPageQuery The current query, for fluid interface
     */
    public function filterByPageData($pageData, $comparison = null)
    {
        if ($pageData instanceof \PageData) {
            return $this
                ->addUsingAlias(PageTableMap::COL_ID, $pageData->getPageId(), $comparison);
        } elseif ($pageData instanceof ObjectCollection) {
            return $this
                ->usePageDataQuery()
                ->filterByPrimaryKeys($pageData->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByPageData() only accepts arguments of type \PageData or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the PageData relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildPageQuery The current query, for fluid interface
     */
    public function joinPageData($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('PageData');

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
            $this->addJoinObject($join, 'PageData');
        }

        return $this;
    }

    /**
     * Use the PageData relation PageData object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \PageDataQuery A secondary query class using the current class as primary query
     */
    public function usePageDataQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPageData($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'PageData', '\PageDataQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildPage $page Object to remove from the list of results
     *
     * @return $this|ChildPageQuery The current query, for fluid interface
     */
    public function prune($page = null)
    {
        if ($page) {
            $this->addCond('pruneCond0', $this->getAliasedColName(PageTableMap::COL_ID), $page->getId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(PageTableMap::COL_AUTOR_ID), $page->getAutorId(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

    /**
     * Deletes all rows from the page table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PageTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            PageTableMap::clearInstancePool();
            PageTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(PageTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(PageTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            
            PageTableMap::removeInstanceFromPool($criteria);
        
            $affectedRows += ModelCriteria::delete($con);
            PageTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // PageQuery
