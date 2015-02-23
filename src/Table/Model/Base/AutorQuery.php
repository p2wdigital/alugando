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
use Table\Model\Autor as ChildAutor;
use Table\Model\AutorQuery as ChildAutorQuery;
use Table\Model\Map\AutorTableMap;

/**
 * Base class that represents a query for the 'autor' table.
 *
 * 
 *
 * @method     ChildAutorQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildAutorQuery orderByNome($order = Criteria::ASC) Order by the nome column
 * @method     ChildAutorQuery orderByEmail($order = Criteria::ASC) Order by the email column
 * @method     ChildAutorQuery orderByUsuario($order = Criteria::ASC) Order by the usuario column
 * @method     ChildAutorQuery orderBySenha($order = Criteria::ASC) Order by the senha column
 * @method     ChildAutorQuery orderBySalt($order = Criteria::ASC) Order by the salt column
 * @method     ChildAutorQuery orderByDescricao($order = Criteria::ASC) Order by the descricao column
 * @method     ChildAutorQuery orderByDados($order = Criteria::ASC) Order by the dados column
 * @method     ChildAutorQuery orderByDhInclusao($order = Criteria::ASC) Order by the dh_inclusao column
 * @method     ChildAutorQuery orderByDhAlteracao($order = Criteria::ASC) Order by the dh_alteracao column
 *
 * @method     ChildAutorQuery groupById() Group by the id column
 * @method     ChildAutorQuery groupByNome() Group by the nome column
 * @method     ChildAutorQuery groupByEmail() Group by the email column
 * @method     ChildAutorQuery groupByUsuario() Group by the usuario column
 * @method     ChildAutorQuery groupBySenha() Group by the senha column
 * @method     ChildAutorQuery groupBySalt() Group by the salt column
 * @method     ChildAutorQuery groupByDescricao() Group by the descricao column
 * @method     ChildAutorQuery groupByDados() Group by the dados column
 * @method     ChildAutorQuery groupByDhInclusao() Group by the dh_inclusao column
 * @method     ChildAutorQuery groupByDhAlteracao() Group by the dh_alteracao column
 *
 * @method     ChildAutorQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildAutorQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildAutorQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildAutorQuery leftJoinPage($relationAlias = null) Adds a LEFT JOIN clause to the query using the Page relation
 * @method     ChildAutorQuery rightJoinPage($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Page relation
 * @method     ChildAutorQuery innerJoinPage($relationAlias = null) Adds a INNER JOIN clause to the query using the Page relation
 *
 * @method     ChildAutorQuery leftJoinPost($relationAlias = null) Adds a LEFT JOIN clause to the query using the Post relation
 * @method     ChildAutorQuery rightJoinPost($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Post relation
 * @method     ChildAutorQuery innerJoinPost($relationAlias = null) Adds a INNER JOIN clause to the query using the Post relation
 *
 * @method     \Table\Model\PageQuery|\Table\Model\PostQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildAutor findOne(ConnectionInterface $con = null) Return the first ChildAutor matching the query
 * @method     ChildAutor findOneOrCreate(ConnectionInterface $con = null) Return the first ChildAutor matching the query, or a new ChildAutor object populated from the query conditions when no match is found
 *
 * @method     ChildAutor findOneById(int $id) Return the first ChildAutor filtered by the id column
 * @method     ChildAutor findOneByNome(string $nome) Return the first ChildAutor filtered by the nome column
 * @method     ChildAutor findOneByEmail(string $email) Return the first ChildAutor filtered by the email column
 * @method     ChildAutor findOneByUsuario(string $usuario) Return the first ChildAutor filtered by the usuario column
 * @method     ChildAutor findOneBySenha(string $senha) Return the first ChildAutor filtered by the senha column
 * @method     ChildAutor findOneBySalt(string $salt) Return the first ChildAutor filtered by the salt column
 * @method     ChildAutor findOneByDescricao(string $descricao) Return the first ChildAutor filtered by the descricao column
 * @method     ChildAutor findOneByDados(string $dados) Return the first ChildAutor filtered by the dados column
 * @method     ChildAutor findOneByDhInclusao(string $dh_inclusao) Return the first ChildAutor filtered by the dh_inclusao column
 * @method     ChildAutor findOneByDhAlteracao(string $dh_alteracao) Return the first ChildAutor filtered by the dh_alteracao column *

 * @method     ChildAutor requirePk($key, ConnectionInterface $con = null) Return the ChildAutor by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAutor requireOne(ConnectionInterface $con = null) Return the first ChildAutor matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildAutor requireOneById(int $id) Return the first ChildAutor filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAutor requireOneByNome(string $nome) Return the first ChildAutor filtered by the nome column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAutor requireOneByEmail(string $email) Return the first ChildAutor filtered by the email column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAutor requireOneByUsuario(string $usuario) Return the first ChildAutor filtered by the usuario column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAutor requireOneBySenha(string $senha) Return the first ChildAutor filtered by the senha column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAutor requireOneBySalt(string $salt) Return the first ChildAutor filtered by the salt column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAutor requireOneByDescricao(string $descricao) Return the first ChildAutor filtered by the descricao column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAutor requireOneByDados(string $dados) Return the first ChildAutor filtered by the dados column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAutor requireOneByDhInclusao(string $dh_inclusao) Return the first ChildAutor filtered by the dh_inclusao column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAutor requireOneByDhAlteracao(string $dh_alteracao) Return the first ChildAutor filtered by the dh_alteracao column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildAutor[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildAutor objects based on current ModelCriteria
 * @method     ChildAutor[]|ObjectCollection findById(int $id) Return ChildAutor objects filtered by the id column
 * @method     ChildAutor[]|ObjectCollection findByNome(string $nome) Return ChildAutor objects filtered by the nome column
 * @method     ChildAutor[]|ObjectCollection findByEmail(string $email) Return ChildAutor objects filtered by the email column
 * @method     ChildAutor[]|ObjectCollection findByUsuario(string $usuario) Return ChildAutor objects filtered by the usuario column
 * @method     ChildAutor[]|ObjectCollection findBySenha(string $senha) Return ChildAutor objects filtered by the senha column
 * @method     ChildAutor[]|ObjectCollection findBySalt(string $salt) Return ChildAutor objects filtered by the salt column
 * @method     ChildAutor[]|ObjectCollection findByDescricao(string $descricao) Return ChildAutor objects filtered by the descricao column
 * @method     ChildAutor[]|ObjectCollection findByDados(string $dados) Return ChildAutor objects filtered by the dados column
 * @method     ChildAutor[]|ObjectCollection findByDhInclusao(string $dh_inclusao) Return ChildAutor objects filtered by the dh_inclusao column
 * @method     ChildAutor[]|ObjectCollection findByDhAlteracao(string $dh_alteracao) Return ChildAutor objects filtered by the dh_alteracao column
 * @method     ChildAutor[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class AutorQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Table\Model\Base\AutorQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Table\\Model\\Autor', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildAutorQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildAutorQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildAutorQuery) {
            return $criteria;
        }
        $query = new ChildAutorQuery();
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
     * @return ChildAutor|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = AutorTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(AutorTableMap::DATABASE_NAME);
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
     * @return ChildAutor A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, nome, email, usuario, senha, salt, descricao, dados, dh_inclusao, dh_alteracao FROM autor WHERE id = :p0';
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
            /** @var ChildAutor $obj */
            $obj = new ChildAutor();
            $obj->hydrate($row);
            AutorTableMap::addInstanceToPool($obj, (string) $key);
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
     * @return ChildAutor|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildAutorQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(AutorTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildAutorQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(AutorTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildAutorQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(AutorTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(AutorTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AutorTableMap::COL_ID, $id, $comparison);
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
     * @return $this|ChildAutorQuery The current query, for fluid interface
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

        return $this->addUsingAlias(AutorTableMap::COL_NOME, $nome, $comparison);
    }

    /**
     * Filter the query on the email column
     *
     * Example usage:
     * <code>
     * $query->filterByEmail('fooValue');   // WHERE email = 'fooValue'
     * $query->filterByEmail('%fooValue%'); // WHERE email LIKE '%fooValue%'
     * </code>
     *
     * @param     string $email The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAutorQuery The current query, for fluid interface
     */
    public function filterByEmail($email = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($email)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $email)) {
                $email = str_replace('*', '%', $email);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(AutorTableMap::COL_EMAIL, $email, $comparison);
    }

    /**
     * Filter the query on the usuario column
     *
     * Example usage:
     * <code>
     * $query->filterByUsuario('fooValue');   // WHERE usuario = 'fooValue'
     * $query->filterByUsuario('%fooValue%'); // WHERE usuario LIKE '%fooValue%'
     * </code>
     *
     * @param     string $usuario The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAutorQuery The current query, for fluid interface
     */
    public function filterByUsuario($usuario = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($usuario)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $usuario)) {
                $usuario = str_replace('*', '%', $usuario);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(AutorTableMap::COL_USUARIO, $usuario, $comparison);
    }

    /**
     * Filter the query on the senha column
     *
     * Example usage:
     * <code>
     * $query->filterBySenha('fooValue');   // WHERE senha = 'fooValue'
     * $query->filterBySenha('%fooValue%'); // WHERE senha LIKE '%fooValue%'
     * </code>
     *
     * @param     string $senha The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAutorQuery The current query, for fluid interface
     */
    public function filterBySenha($senha = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($senha)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $senha)) {
                $senha = str_replace('*', '%', $senha);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(AutorTableMap::COL_SENHA, $senha, $comparison);
    }

    /**
     * Filter the query on the salt column
     *
     * Example usage:
     * <code>
     * $query->filterBySalt('fooValue');   // WHERE salt = 'fooValue'
     * $query->filterBySalt('%fooValue%'); // WHERE salt LIKE '%fooValue%'
     * </code>
     *
     * @param     string $salt The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAutorQuery The current query, for fluid interface
     */
    public function filterBySalt($salt = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($salt)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $salt)) {
                $salt = str_replace('*', '%', $salt);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(AutorTableMap::COL_SALT, $salt, $comparison);
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
     * @return $this|ChildAutorQuery The current query, for fluid interface
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

        return $this->addUsingAlias(AutorTableMap::COL_DESCRICAO, $descricao, $comparison);
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
     * @return $this|ChildAutorQuery The current query, for fluid interface
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

        return $this->addUsingAlias(AutorTableMap::COL_DADOS, $dados, $comparison);
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
     * @return $this|ChildAutorQuery The current query, for fluid interface
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

        return $this->addUsingAlias(AutorTableMap::COL_DH_INCLUSAO, $dhInclusao, $comparison);
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
     * @return $this|ChildAutorQuery The current query, for fluid interface
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

        return $this->addUsingAlias(AutorTableMap::COL_DH_ALTERACAO, $dhAlteracao, $comparison);
    }

    /**
     * Filter the query by a related \Table\Model\Page object
     *
     * @param \Table\Model\Page|ObjectCollection $page the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildAutorQuery The current query, for fluid interface
     */
    public function filterByPage($page, $comparison = null)
    {
        if ($page instanceof \Table\Model\Page) {
            return $this
                ->addUsingAlias(AutorTableMap::COL_ID, $page->getAutorId(), $comparison);
        } elseif ($page instanceof ObjectCollection) {
            return $this
                ->usePageQuery()
                ->filterByPrimaryKeys($page->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByPage() only accepts arguments of type \Table\Model\Page or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Page relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildAutorQuery The current query, for fluid interface
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
     * @return \Table\Model\PageQuery A secondary query class using the current class as primary query
     */
    public function usePageQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPage($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Page', '\Table\Model\PageQuery');
    }

    /**
     * Filter the query by a related \Table\Model\Post object
     *
     * @param \Table\Model\Post|ObjectCollection $post the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildAutorQuery The current query, for fluid interface
     */
    public function filterByPost($post, $comparison = null)
    {
        if ($post instanceof \Table\Model\Post) {
            return $this
                ->addUsingAlias(AutorTableMap::COL_ID, $post->getAutorId(), $comparison);
        } elseif ($post instanceof ObjectCollection) {
            return $this
                ->usePostQuery()
                ->filterByPrimaryKeys($post->getPrimaryKeys())
                ->endUse();
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
     * @return $this|ChildAutorQuery The current query, for fluid interface
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
     * Exclude object from result
     *
     * @param   ChildAutor $autor Object to remove from the list of results
     *
     * @return $this|ChildAutorQuery The current query, for fluid interface
     */
    public function prune($autor = null)
    {
        if ($autor) {
            $this->addUsingAlias(AutorTableMap::COL_ID, $autor->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the autor table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(AutorTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            AutorTableMap::clearInstancePool();
            AutorTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(AutorTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(AutorTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            
            AutorTableMap::removeInstanceFromPool($criteria);
        
            $affectedRows += ModelCriteria::delete($con);
            AutorTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // AutorQuery
