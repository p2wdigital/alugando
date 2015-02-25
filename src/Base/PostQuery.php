<?php

namespace Base;

use \Post as ChildPost;
use \PostQuery as ChildPostQuery;
use \Exception;
use \PDO;
use Map\PostTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'post' table.
 *
 * 
 *
 * @method     ChildPostQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildPostQuery orderByAutorId($order = Criteria::ASC) Order by the autor_id column
 * @method     ChildPostQuery orderByTitulo($order = Criteria::ASC) Order by the titulo column
 * @method     ChildPostQuery orderByUrl($order = Criteria::ASC) Order by the url column
 * @method     ChildPostQuery orderByContent($order = Criteria::ASC) Order by the content column
 * @method     ChildPostQuery orderByStatus($order = Criteria::ASC) Order by the status column
 * @method     ChildPostQuery orderByData($order = Criteria::ASC) Order by the data column
 * @method     ChildPostQuery orderByDhInclusao($order = Criteria::ASC) Order by the dh_inclusao column
 * @method     ChildPostQuery orderByDhAlteracao($order = Criteria::ASC) Order by the dh_alteracao column
 *
 * @method     ChildPostQuery groupById() Group by the id column
 * @method     ChildPostQuery groupByAutorId() Group by the autor_id column
 * @method     ChildPostQuery groupByTitulo() Group by the titulo column
 * @method     ChildPostQuery groupByUrl() Group by the url column
 * @method     ChildPostQuery groupByContent() Group by the content column
 * @method     ChildPostQuery groupByStatus() Group by the status column
 * @method     ChildPostQuery groupByData() Group by the data column
 * @method     ChildPostQuery groupByDhInclusao() Group by the dh_inclusao column
 * @method     ChildPostQuery groupByDhAlteracao() Group by the dh_alteracao column
 *
 * @method     ChildPostQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildPostQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildPostQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildPostQuery leftJoinAutor($relationAlias = null) Adds a LEFT JOIN clause to the query using the Autor relation
 * @method     ChildPostQuery rightJoinAutor($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Autor relation
 * @method     ChildPostQuery innerJoinAutor($relationAlias = null) Adds a INNER JOIN clause to the query using the Autor relation
 *
 * @method     ChildPostQuery leftJoinPostData($relationAlias = null) Adds a LEFT JOIN clause to the query using the PostData relation
 * @method     ChildPostQuery rightJoinPostData($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PostData relation
 * @method     ChildPostQuery innerJoinPostData($relationAlias = null) Adds a INNER JOIN clause to the query using the PostData relation
 *
 * @method     ChildPostQuery leftJoinPostHasCategoria($relationAlias = null) Adds a LEFT JOIN clause to the query using the PostHasCategoria relation
 * @method     ChildPostQuery rightJoinPostHasCategoria($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PostHasCategoria relation
 * @method     ChildPostQuery innerJoinPostHasCategoria($relationAlias = null) Adds a INNER JOIN clause to the query using the PostHasCategoria relation
 *
 * @method     \AutorQuery|\PostDataQuery|\PostHasCategoriaQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildPost findOne(ConnectionInterface $con = null) Return the first ChildPost matching the query
 * @method     ChildPost findOneOrCreate(ConnectionInterface $con = null) Return the first ChildPost matching the query, or a new ChildPost object populated from the query conditions when no match is found
 *
 * @method     ChildPost findOneById(int $id) Return the first ChildPost filtered by the id column
 * @method     ChildPost findOneByAutorId(int $autor_id) Return the first ChildPost filtered by the autor_id column
 * @method     ChildPost findOneByTitulo(string $titulo) Return the first ChildPost filtered by the titulo column
 * @method     ChildPost findOneByUrl(string $url) Return the first ChildPost filtered by the url column
 * @method     ChildPost findOneByContent(string $content) Return the first ChildPost filtered by the content column
 * @method     ChildPost findOneByStatus(int $status) Return the first ChildPost filtered by the status column
 * @method     ChildPost findOneByData(string $data) Return the first ChildPost filtered by the data column
 * @method     ChildPost findOneByDhInclusao(string $dh_inclusao) Return the first ChildPost filtered by the dh_inclusao column
 * @method     ChildPost findOneByDhAlteracao(string $dh_alteracao) Return the first ChildPost filtered by the dh_alteracao column *

 * @method     ChildPost requirePk($key, ConnectionInterface $con = null) Return the ChildPost by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPost requireOne(ConnectionInterface $con = null) Return the first ChildPost matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPost requireOneById(int $id) Return the first ChildPost filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPost requireOneByAutorId(int $autor_id) Return the first ChildPost filtered by the autor_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPost requireOneByTitulo(string $titulo) Return the first ChildPost filtered by the titulo column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPost requireOneByUrl(string $url) Return the first ChildPost filtered by the url column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPost requireOneByContent(string $content) Return the first ChildPost filtered by the content column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPost requireOneByStatus(int $status) Return the first ChildPost filtered by the status column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPost requireOneByData(string $data) Return the first ChildPost filtered by the data column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPost requireOneByDhInclusao(string $dh_inclusao) Return the first ChildPost filtered by the dh_inclusao column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPost requireOneByDhAlteracao(string $dh_alteracao) Return the first ChildPost filtered by the dh_alteracao column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPost[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildPost objects based on current ModelCriteria
 * @method     ChildPost[]|ObjectCollection findById(int $id) Return ChildPost objects filtered by the id column
 * @method     ChildPost[]|ObjectCollection findByAutorId(int $autor_id) Return ChildPost objects filtered by the autor_id column
 * @method     ChildPost[]|ObjectCollection findByTitulo(string $titulo) Return ChildPost objects filtered by the titulo column
 * @method     ChildPost[]|ObjectCollection findByUrl(string $url) Return ChildPost objects filtered by the url column
 * @method     ChildPost[]|ObjectCollection findByContent(string $content) Return ChildPost objects filtered by the content column
 * @method     ChildPost[]|ObjectCollection findByStatus(int $status) Return ChildPost objects filtered by the status column
 * @method     ChildPost[]|ObjectCollection findByData(string $data) Return ChildPost objects filtered by the data column
 * @method     ChildPost[]|ObjectCollection findByDhInclusao(string $dh_inclusao) Return ChildPost objects filtered by the dh_inclusao column
 * @method     ChildPost[]|ObjectCollection findByDhAlteracao(string $dh_alteracao) Return ChildPost objects filtered by the dh_alteracao column
 * @method     ChildPost[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class PostQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\PostQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Post', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildPostQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildPostQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildPostQuery) {
            return $criteria;
        }
        $query = new ChildPostQuery();
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
     * @return ChildPost|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = PostTableMap::getInstanceFromPool(serialize(array((string) $key[0], (string) $key[1]))))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(PostTableMap::DATABASE_NAME);
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
     * @return ChildPost A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, autor_id, titulo, url, content, status, data, dh_inclusao, dh_alteracao FROM post WHERE id = :p0 AND autor_id = :p1';
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
            /** @var ChildPost $obj */
            $obj = new ChildPost();
            $obj->hydrate($row);
            PostTableMap::addInstanceToPool($obj, serialize(array((string) $key[0], (string) $key[1])));
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
     * @return ChildPost|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildPostQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(PostTableMap::COL_ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(PostTableMap::COL_AUTOR_ID, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildPostQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(PostTableMap::COL_ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(PostTableMap::COL_AUTOR_ID, $key[1], Criteria::EQUAL);
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
     * @return $this|ChildPostQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(PostTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(PostTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PostTableMap::COL_ID, $id, $comparison);
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
     * @return $this|ChildPostQuery The current query, for fluid interface
     */
    public function filterByAutorId($autorId = null, $comparison = null)
    {
        if (is_array($autorId)) {
            $useMinMax = false;
            if (isset($autorId['min'])) {
                $this->addUsingAlias(PostTableMap::COL_AUTOR_ID, $autorId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($autorId['max'])) {
                $this->addUsingAlias(PostTableMap::COL_AUTOR_ID, $autorId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PostTableMap::COL_AUTOR_ID, $autorId, $comparison);
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
     * @return $this|ChildPostQuery The current query, for fluid interface
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

        return $this->addUsingAlias(PostTableMap::COL_TITULO, $titulo, $comparison);
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
     * @return $this|ChildPostQuery The current query, for fluid interface
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

        return $this->addUsingAlias(PostTableMap::COL_URL, $url, $comparison);
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
     * @return $this|ChildPostQuery The current query, for fluid interface
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

        return $this->addUsingAlias(PostTableMap::COL_CONTENT, $content, $comparison);
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
     * @return $this|ChildPostQuery The current query, for fluid interface
     */
    public function filterByStatus($status = null, $comparison = null)
    {
        if (is_array($status)) {
            $useMinMax = false;
            if (isset($status['min'])) {
                $this->addUsingAlias(PostTableMap::COL_STATUS, $status['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($status['max'])) {
                $this->addUsingAlias(PostTableMap::COL_STATUS, $status['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PostTableMap::COL_STATUS, $status, $comparison);
    }

    /**
     * Filter the query on the data column
     *
     * Example usage:
     * <code>
     * $query->filterByData('fooValue');   // WHERE data = 'fooValue'
     * $query->filterByData('%fooValue%'); // WHERE data LIKE '%fooValue%'
     * </code>
     *
     * @param     string $data The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPostQuery The current query, for fluid interface
     */
    public function filterByData($data = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($data)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $data)) {
                $data = str_replace('*', '%', $data);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(PostTableMap::COL_DATA, $data, $comparison);
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
     * @return $this|ChildPostQuery The current query, for fluid interface
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

        return $this->addUsingAlias(PostTableMap::COL_DH_INCLUSAO, $dhInclusao, $comparison);
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
     * @return $this|ChildPostQuery The current query, for fluid interface
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

        return $this->addUsingAlias(PostTableMap::COL_DH_ALTERACAO, $dhAlteracao, $comparison);
    }

    /**
     * Filter the query by a related \Autor object
     *
     * @param \Autor|ObjectCollection $autor The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildPostQuery The current query, for fluid interface
     */
    public function filterByAutor($autor, $comparison = null)
    {
        if ($autor instanceof \Autor) {
            return $this
                ->addUsingAlias(PostTableMap::COL_AUTOR_ID, $autor->getId(), $comparison);
        } elseif ($autor instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(PostTableMap::COL_AUTOR_ID, $autor->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return $this|ChildPostQuery The current query, for fluid interface
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
     * Filter the query by a related \PostData object
     *
     * @param \PostData|ObjectCollection $postData the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildPostQuery The current query, for fluid interface
     */
    public function filterByPostData($postData, $comparison = null)
    {
        if ($postData instanceof \PostData) {
            return $this
                ->addUsingAlias(PostTableMap::COL_ID, $postData->getPostId(), $comparison);
        } elseif ($postData instanceof ObjectCollection) {
            return $this
                ->usePostDataQuery()
                ->filterByPrimaryKeys($postData->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByPostData() only accepts arguments of type \PostData or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the PostData relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildPostQuery The current query, for fluid interface
     */
    public function joinPostData($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('PostData');

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
            $this->addJoinObject($join, 'PostData');
        }

        return $this;
    }

    /**
     * Use the PostData relation PostData object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \PostDataQuery A secondary query class using the current class as primary query
     */
    public function usePostDataQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPostData($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'PostData', '\PostDataQuery');
    }

    /**
     * Filter the query by a related \PostHasCategoria object
     *
     * @param \PostHasCategoria|ObjectCollection $postHasCategoria the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildPostQuery The current query, for fluid interface
     */
    public function filterByPostHasCategoria($postHasCategoria, $comparison = null)
    {
        if ($postHasCategoria instanceof \PostHasCategoria) {
            return $this
                ->addUsingAlias(PostTableMap::COL_ID, $postHasCategoria->getPostId(), $comparison);
        } elseif ($postHasCategoria instanceof ObjectCollection) {
            return $this
                ->usePostHasCategoriaQuery()
                ->filterByPrimaryKeys($postHasCategoria->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByPostHasCategoria() only accepts arguments of type \PostHasCategoria or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the PostHasCategoria relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildPostQuery The current query, for fluid interface
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
     * @return \PostHasCategoriaQuery A secondary query class using the current class as primary query
     */
    public function usePostHasCategoriaQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPostHasCategoria($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'PostHasCategoria', '\PostHasCategoriaQuery');
    }

    /**
     * Filter the query by a related Categoria object
     * using the post_has_categoria table as cross reference
     *
     * @param Categoria $categoria the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildPostQuery The current query, for fluid interface
     */
    public function filterByCategoria($categoria, $comparison = Criteria::EQUAL)
    {
        return $this
            ->usePostHasCategoriaQuery()
            ->filterByCategoria($categoria, $comparison)
            ->endUse();
    }

    /**
     * Exclude object from result
     *
     * @param   ChildPost $post Object to remove from the list of results
     *
     * @return $this|ChildPostQuery The current query, for fluid interface
     */
    public function prune($post = null)
    {
        if ($post) {
            $this->addCond('pruneCond0', $this->getAliasedColName(PostTableMap::COL_ID), $post->getId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(PostTableMap::COL_AUTOR_ID), $post->getAutorId(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

    /**
     * Deletes all rows from the post table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PostTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            PostTableMap::clearInstancePool();
            PostTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(PostTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(PostTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            
            PostTableMap::removeInstanceFromPool($criteria);
        
            $affectedRows += ModelCriteria::delete($con);
            PostTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // PostQuery
