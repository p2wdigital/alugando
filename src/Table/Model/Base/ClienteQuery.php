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
use Table\Model\Cliente as ChildCliente;
use Table\Model\ClienteQuery as ChildClienteQuery;
use Table\Model\Map\ClienteTableMap;

/**
 * Base class that represents a query for the 'cliente' table.
 *
 * 
 *
 * @method     ChildClienteQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildClienteQuery orderByRazaoSocial($order = Criteria::ASC) Order by the razao_social column
 * @method     ChildClienteQuery orderByContato($order = Criteria::ASC) Order by the contato column
 * @method     ChildClienteQuery orderByEmail($order = Criteria::ASC) Order by the email column
 * @method     ChildClienteQuery orderByDocumento($order = Criteria::ASC) Order by the documento column
 * @method     ChildClienteQuery orderByTipoPessoa($order = Criteria::ASC) Order by the tipo_pessoa column
 * @method     ChildClienteQuery orderByCep($order = Criteria::ASC) Order by the cep column
 * @method     ChildClienteQuery orderByEndereco($order = Criteria::ASC) Order by the endereco column
 * @method     ChildClienteQuery orderByNumero($order = Criteria::ASC) Order by the numero column
 * @method     ChildClienteQuery orderByComplemento($order = Criteria::ASC) Order by the complemento column
 * @method     ChildClienteQuery orderByBairro($order = Criteria::ASC) Order by the bairro column
 * @method     ChildClienteQuery orderByCidade($order = Criteria::ASC) Order by the cidade column
 * @method     ChildClienteQuery orderByUf($order = Criteria::ASC) Order by the uf column
 * @method     ChildClienteQuery orderByTelefone($order = Criteria::ASC) Order by the telefone column
 * @method     ChildClienteQuery orderByStatus($order = Criteria::ASC) Order by the status column
 * @method     ChildClienteQuery orderByDhInclusao($order = Criteria::ASC) Order by the dh_inclusao column
 * @method     ChildClienteQuery orderByDhAlteracao($order = Criteria::ASC) Order by the dh_alteracao column
 * @method     ChildClienteQuery orderByUserIdInclusao($order = Criteria::ASC) Order by the user_id_inclusao column
 * @method     ChildClienteQuery orderByUserIdAlteracao($order = Criteria::ASC) Order by the user_id_alteracao column
 *
 * @method     ChildClienteQuery groupById() Group by the id column
 * @method     ChildClienteQuery groupByRazaoSocial() Group by the razao_social column
 * @method     ChildClienteQuery groupByContato() Group by the contato column
 * @method     ChildClienteQuery groupByEmail() Group by the email column
 * @method     ChildClienteQuery groupByDocumento() Group by the documento column
 * @method     ChildClienteQuery groupByTipoPessoa() Group by the tipo_pessoa column
 * @method     ChildClienteQuery groupByCep() Group by the cep column
 * @method     ChildClienteQuery groupByEndereco() Group by the endereco column
 * @method     ChildClienteQuery groupByNumero() Group by the numero column
 * @method     ChildClienteQuery groupByComplemento() Group by the complemento column
 * @method     ChildClienteQuery groupByBairro() Group by the bairro column
 * @method     ChildClienteQuery groupByCidade() Group by the cidade column
 * @method     ChildClienteQuery groupByUf() Group by the uf column
 * @method     ChildClienteQuery groupByTelefone() Group by the telefone column
 * @method     ChildClienteQuery groupByStatus() Group by the status column
 * @method     ChildClienteQuery groupByDhInclusao() Group by the dh_inclusao column
 * @method     ChildClienteQuery groupByDhAlteracao() Group by the dh_alteracao column
 * @method     ChildClienteQuery groupByUserIdInclusao() Group by the user_id_inclusao column
 * @method     ChildClienteQuery groupByUserIdAlteracao() Group by the user_id_alteracao column
 *
 * @method     ChildClienteQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildClienteQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildClienteQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildClienteQuery leftJoinUserRelatedByUserIdInclusao($relationAlias = null) Adds a LEFT JOIN clause to the query using the UserRelatedByUserIdInclusao relation
 * @method     ChildClienteQuery rightJoinUserRelatedByUserIdInclusao($relationAlias = null) Adds a RIGHT JOIN clause to the query using the UserRelatedByUserIdInclusao relation
 * @method     ChildClienteQuery innerJoinUserRelatedByUserIdInclusao($relationAlias = null) Adds a INNER JOIN clause to the query using the UserRelatedByUserIdInclusao relation
 *
 * @method     ChildClienteQuery leftJoinUserRelatedByUserIdAlteracao($relationAlias = null) Adds a LEFT JOIN clause to the query using the UserRelatedByUserIdAlteracao relation
 * @method     ChildClienteQuery rightJoinUserRelatedByUserIdAlteracao($relationAlias = null) Adds a RIGHT JOIN clause to the query using the UserRelatedByUserIdAlteracao relation
 * @method     ChildClienteQuery innerJoinUserRelatedByUserIdAlteracao($relationAlias = null) Adds a INNER JOIN clause to the query using the UserRelatedByUserIdAlteracao relation
 *
 * @method     ChildClienteQuery leftJoinOrcamento($relationAlias = null) Adds a LEFT JOIN clause to the query using the Orcamento relation
 * @method     ChildClienteQuery rightJoinOrcamento($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Orcamento relation
 * @method     ChildClienteQuery innerJoinOrcamento($relationAlias = null) Adds a INNER JOIN clause to the query using the Orcamento relation
 *
 * @method     \Table\Model\UserQuery|\Table\Model\OrcamentoQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildCliente findOne(ConnectionInterface $con = null) Return the first ChildCliente matching the query
 * @method     ChildCliente findOneOrCreate(ConnectionInterface $con = null) Return the first ChildCliente matching the query, or a new ChildCliente object populated from the query conditions when no match is found
 *
 * @method     ChildCliente findOneById(int $id) Return the first ChildCliente filtered by the id column
 * @method     ChildCliente findOneByRazaoSocial(string $razao_social) Return the first ChildCliente filtered by the razao_social column
 * @method     ChildCliente findOneByContato(string $contato) Return the first ChildCliente filtered by the contato column
 * @method     ChildCliente findOneByEmail(string $email) Return the first ChildCliente filtered by the email column
 * @method     ChildCliente findOneByDocumento(string $documento) Return the first ChildCliente filtered by the documento column
 * @method     ChildCliente findOneByTipoPessoa(string $tipo_pessoa) Return the first ChildCliente filtered by the tipo_pessoa column
 * @method     ChildCliente findOneByCep(string $cep) Return the first ChildCliente filtered by the cep column
 * @method     ChildCliente findOneByEndereco(string $endereco) Return the first ChildCliente filtered by the endereco column
 * @method     ChildCliente findOneByNumero(int $numero) Return the first ChildCliente filtered by the numero column
 * @method     ChildCliente findOneByComplemento(string $complemento) Return the first ChildCliente filtered by the complemento column
 * @method     ChildCliente findOneByBairro(string $bairro) Return the first ChildCliente filtered by the bairro column
 * @method     ChildCliente findOneByCidade(string $cidade) Return the first ChildCliente filtered by the cidade column
 * @method     ChildCliente findOneByUf(string $uf) Return the first ChildCliente filtered by the uf column
 * @method     ChildCliente findOneByTelefone(string $telefone) Return the first ChildCliente filtered by the telefone column
 * @method     ChildCliente findOneByStatus(int $status) Return the first ChildCliente filtered by the status column
 * @method     ChildCliente findOneByDhInclusao(string $dh_inclusao) Return the first ChildCliente filtered by the dh_inclusao column
 * @method     ChildCliente findOneByDhAlteracao(string $dh_alteracao) Return the first ChildCliente filtered by the dh_alteracao column
 * @method     ChildCliente findOneByUserIdInclusao(int $user_id_inclusao) Return the first ChildCliente filtered by the user_id_inclusao column
 * @method     ChildCliente findOneByUserIdAlteracao(int $user_id_alteracao) Return the first ChildCliente filtered by the user_id_alteracao column
 *
 * @method     ChildCliente[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildCliente objects based on current ModelCriteria
 * @method     ChildCliente[]|ObjectCollection findById(int $id) Return ChildCliente objects filtered by the id column
 * @method     ChildCliente[]|ObjectCollection findByRazaoSocial(string $razao_social) Return ChildCliente objects filtered by the razao_social column
 * @method     ChildCliente[]|ObjectCollection findByContato(string $contato) Return ChildCliente objects filtered by the contato column
 * @method     ChildCliente[]|ObjectCollection findByEmail(string $email) Return ChildCliente objects filtered by the email column
 * @method     ChildCliente[]|ObjectCollection findByDocumento(string $documento) Return ChildCliente objects filtered by the documento column
 * @method     ChildCliente[]|ObjectCollection findByTipoPessoa(string $tipo_pessoa) Return ChildCliente objects filtered by the tipo_pessoa column
 * @method     ChildCliente[]|ObjectCollection findByCep(string $cep) Return ChildCliente objects filtered by the cep column
 * @method     ChildCliente[]|ObjectCollection findByEndereco(string $endereco) Return ChildCliente objects filtered by the endereco column
 * @method     ChildCliente[]|ObjectCollection findByNumero(int $numero) Return ChildCliente objects filtered by the numero column
 * @method     ChildCliente[]|ObjectCollection findByComplemento(string $complemento) Return ChildCliente objects filtered by the complemento column
 * @method     ChildCliente[]|ObjectCollection findByBairro(string $bairro) Return ChildCliente objects filtered by the bairro column
 * @method     ChildCliente[]|ObjectCollection findByCidade(string $cidade) Return ChildCliente objects filtered by the cidade column
 * @method     ChildCliente[]|ObjectCollection findByUf(string $uf) Return ChildCliente objects filtered by the uf column
 * @method     ChildCliente[]|ObjectCollection findByTelefone(string $telefone) Return ChildCliente objects filtered by the telefone column
 * @method     ChildCliente[]|ObjectCollection findByStatus(int $status) Return ChildCliente objects filtered by the status column
 * @method     ChildCliente[]|ObjectCollection findByDhInclusao(string $dh_inclusao) Return ChildCliente objects filtered by the dh_inclusao column
 * @method     ChildCliente[]|ObjectCollection findByDhAlteracao(string $dh_alteracao) Return ChildCliente objects filtered by the dh_alteracao column
 * @method     ChildCliente[]|ObjectCollection findByUserIdInclusao(int $user_id_inclusao) Return ChildCliente objects filtered by the user_id_inclusao column
 * @method     ChildCliente[]|ObjectCollection findByUserIdAlteracao(int $user_id_alteracao) Return ChildCliente objects filtered by the user_id_alteracao column
 * @method     ChildCliente[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class ClienteQuery extends ModelCriteria
{
    
    /**
     * Initializes internal state of \Table\Model\Base\ClienteQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Table\\Model\\Cliente', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildClienteQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildClienteQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildClienteQuery) {
            return $criteria;
        }
        $query = new ChildClienteQuery();
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
     * @return ChildCliente|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = ClienteTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ClienteTableMap::DATABASE_NAME);
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
     * @return ChildCliente A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, razao_social, contato, email, documento, tipo_pessoa, cep, endereco, numero, complemento, bairro, cidade, uf, telefone, status, dh_inclusao, dh_alteracao, user_id_inclusao, user_id_alteracao FROM cliente WHERE id = :p0';
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
            /** @var ChildCliente $obj */
            $obj = new ChildCliente();
            $obj->hydrate($row);
            ClienteTableMap::addInstanceToPool($obj, (string) $key);
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
     * @return ChildCliente|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildClienteQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(ClienteTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildClienteQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(ClienteTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildClienteQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(ClienteTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(ClienteTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ClienteTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the razao_social column
     *
     * Example usage:
     * <code>
     * $query->filterByRazaoSocial('fooValue');   // WHERE razao_social = 'fooValue'
     * $query->filterByRazaoSocial('%fooValue%'); // WHERE razao_social LIKE '%fooValue%'
     * </code>
     *
     * @param     string $razaoSocial The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildClienteQuery The current query, for fluid interface
     */
    public function filterByRazaoSocial($razaoSocial = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($razaoSocial)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $razaoSocial)) {
                $razaoSocial = str_replace('*', '%', $razaoSocial);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ClienteTableMap::COL_RAZAO_SOCIAL, $razaoSocial, $comparison);
    }

    /**
     * Filter the query on the contato column
     *
     * Example usage:
     * <code>
     * $query->filterByContato('fooValue');   // WHERE contato = 'fooValue'
     * $query->filterByContato('%fooValue%'); // WHERE contato LIKE '%fooValue%'
     * </code>
     *
     * @param     string $contato The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildClienteQuery The current query, for fluid interface
     */
    public function filterByContato($contato = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($contato)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $contato)) {
                $contato = str_replace('*', '%', $contato);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ClienteTableMap::COL_CONTATO, $contato, $comparison);
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
     * @return $this|ChildClienteQuery The current query, for fluid interface
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

        return $this->addUsingAlias(ClienteTableMap::COL_EMAIL, $email, $comparison);
    }

    /**
     * Filter the query on the documento column
     *
     * Example usage:
     * <code>
     * $query->filterByDocumento('fooValue');   // WHERE documento = 'fooValue'
     * $query->filterByDocumento('%fooValue%'); // WHERE documento LIKE '%fooValue%'
     * </code>
     *
     * @param     string $documento The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildClienteQuery The current query, for fluid interface
     */
    public function filterByDocumento($documento = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($documento)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $documento)) {
                $documento = str_replace('*', '%', $documento);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ClienteTableMap::COL_DOCUMENTO, $documento, $comparison);
    }

    /**
     * Filter the query on the tipo_pessoa column
     *
     * Example usage:
     * <code>
     * $query->filterByTipoPessoa('fooValue');   // WHERE tipo_pessoa = 'fooValue'
     * $query->filterByTipoPessoa('%fooValue%'); // WHERE tipo_pessoa LIKE '%fooValue%'
     * </code>
     *
     * @param     string $tipoPessoa The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildClienteQuery The current query, for fluid interface
     */
    public function filterByTipoPessoa($tipoPessoa = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($tipoPessoa)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $tipoPessoa)) {
                $tipoPessoa = str_replace('*', '%', $tipoPessoa);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ClienteTableMap::COL_TIPO_PESSOA, $tipoPessoa, $comparison);
    }

    /**
     * Filter the query on the cep column
     *
     * Example usage:
     * <code>
     * $query->filterByCep('fooValue');   // WHERE cep = 'fooValue'
     * $query->filterByCep('%fooValue%'); // WHERE cep LIKE '%fooValue%'
     * </code>
     *
     * @param     string $cep The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildClienteQuery The current query, for fluid interface
     */
    public function filterByCep($cep = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($cep)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $cep)) {
                $cep = str_replace('*', '%', $cep);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ClienteTableMap::COL_CEP, $cep, $comparison);
    }

    /**
     * Filter the query on the endereco column
     *
     * Example usage:
     * <code>
     * $query->filterByEndereco('fooValue');   // WHERE endereco = 'fooValue'
     * $query->filterByEndereco('%fooValue%'); // WHERE endereco LIKE '%fooValue%'
     * </code>
     *
     * @param     string $endereco The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildClienteQuery The current query, for fluid interface
     */
    public function filterByEndereco($endereco = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($endereco)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $endereco)) {
                $endereco = str_replace('*', '%', $endereco);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ClienteTableMap::COL_ENDERECO, $endereco, $comparison);
    }

    /**
     * Filter the query on the numero column
     *
     * Example usage:
     * <code>
     * $query->filterByNumero(1234); // WHERE numero = 1234
     * $query->filterByNumero(array(12, 34)); // WHERE numero IN (12, 34)
     * $query->filterByNumero(array('min' => 12)); // WHERE numero > 12
     * </code>
     *
     * @param     mixed $numero The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildClienteQuery The current query, for fluid interface
     */
    public function filterByNumero($numero = null, $comparison = null)
    {
        if (is_array($numero)) {
            $useMinMax = false;
            if (isset($numero['min'])) {
                $this->addUsingAlias(ClienteTableMap::COL_NUMERO, $numero['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($numero['max'])) {
                $this->addUsingAlias(ClienteTableMap::COL_NUMERO, $numero['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ClienteTableMap::COL_NUMERO, $numero, $comparison);
    }

    /**
     * Filter the query on the complemento column
     *
     * Example usage:
     * <code>
     * $query->filterByComplemento('fooValue');   // WHERE complemento = 'fooValue'
     * $query->filterByComplemento('%fooValue%'); // WHERE complemento LIKE '%fooValue%'
     * </code>
     *
     * @param     string $complemento The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildClienteQuery The current query, for fluid interface
     */
    public function filterByComplemento($complemento = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($complemento)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $complemento)) {
                $complemento = str_replace('*', '%', $complemento);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ClienteTableMap::COL_COMPLEMENTO, $complemento, $comparison);
    }

    /**
     * Filter the query on the bairro column
     *
     * Example usage:
     * <code>
     * $query->filterByBairro('fooValue');   // WHERE bairro = 'fooValue'
     * $query->filterByBairro('%fooValue%'); // WHERE bairro LIKE '%fooValue%'
     * </code>
     *
     * @param     string $bairro The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildClienteQuery The current query, for fluid interface
     */
    public function filterByBairro($bairro = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($bairro)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $bairro)) {
                $bairro = str_replace('*', '%', $bairro);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ClienteTableMap::COL_BAIRRO, $bairro, $comparison);
    }

    /**
     * Filter the query on the cidade column
     *
     * Example usage:
     * <code>
     * $query->filterByCidade('fooValue');   // WHERE cidade = 'fooValue'
     * $query->filterByCidade('%fooValue%'); // WHERE cidade LIKE '%fooValue%'
     * </code>
     *
     * @param     string $cidade The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildClienteQuery The current query, for fluid interface
     */
    public function filterByCidade($cidade = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($cidade)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $cidade)) {
                $cidade = str_replace('*', '%', $cidade);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ClienteTableMap::COL_CIDADE, $cidade, $comparison);
    }

    /**
     * Filter the query on the uf column
     *
     * Example usage:
     * <code>
     * $query->filterByUf('fooValue');   // WHERE uf = 'fooValue'
     * $query->filterByUf('%fooValue%'); // WHERE uf LIKE '%fooValue%'
     * </code>
     *
     * @param     string $uf The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildClienteQuery The current query, for fluid interface
     */
    public function filterByUf($uf = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($uf)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $uf)) {
                $uf = str_replace('*', '%', $uf);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ClienteTableMap::COL_UF, $uf, $comparison);
    }

    /**
     * Filter the query on the telefone column
     *
     * Example usage:
     * <code>
     * $query->filterByTelefone('fooValue');   // WHERE telefone = 'fooValue'
     * $query->filterByTelefone('%fooValue%'); // WHERE telefone LIKE '%fooValue%'
     * </code>
     *
     * @param     string $telefone The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildClienteQuery The current query, for fluid interface
     */
    public function filterByTelefone($telefone = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($telefone)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $telefone)) {
                $telefone = str_replace('*', '%', $telefone);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ClienteTableMap::COL_TELEFONE, $telefone, $comparison);
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
     * @return $this|ChildClienteQuery The current query, for fluid interface
     */
    public function filterByStatus($status = null, $comparison = null)
    {
        if (is_array($status)) {
            $useMinMax = false;
            if (isset($status['min'])) {
                $this->addUsingAlias(ClienteTableMap::COL_STATUS, $status['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($status['max'])) {
                $this->addUsingAlias(ClienteTableMap::COL_STATUS, $status['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ClienteTableMap::COL_STATUS, $status, $comparison);
    }

    /**
     * Filter the query on the dh_inclusao column
     *
     * Example usage:
     * <code>
     * $query->filterByDhInclusao('2011-03-14'); // WHERE dh_inclusao = '2011-03-14'
     * $query->filterByDhInclusao('now'); // WHERE dh_inclusao = '2011-03-14'
     * $query->filterByDhInclusao(array('max' => 'yesterday')); // WHERE dh_inclusao > '2011-03-13'
     * </code>
     *
     * @param     mixed $dhInclusao The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildClienteQuery The current query, for fluid interface
     */
    public function filterByDhInclusao($dhInclusao = null, $comparison = null)
    {
        if (is_array($dhInclusao)) {
            $useMinMax = false;
            if (isset($dhInclusao['min'])) {
                $this->addUsingAlias(ClienteTableMap::COL_DH_INCLUSAO, $dhInclusao['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($dhInclusao['max'])) {
                $this->addUsingAlias(ClienteTableMap::COL_DH_INCLUSAO, $dhInclusao['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ClienteTableMap::COL_DH_INCLUSAO, $dhInclusao, $comparison);
    }

    /**
     * Filter the query on the dh_alteracao column
     *
     * Example usage:
     * <code>
     * $query->filterByDhAlteracao('2011-03-14'); // WHERE dh_alteracao = '2011-03-14'
     * $query->filterByDhAlteracao('now'); // WHERE dh_alteracao = '2011-03-14'
     * $query->filterByDhAlteracao(array('max' => 'yesterday')); // WHERE dh_alteracao > '2011-03-13'
     * </code>
     *
     * @param     mixed $dhAlteracao The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildClienteQuery The current query, for fluid interface
     */
    public function filterByDhAlteracao($dhAlteracao = null, $comparison = null)
    {
        if (is_array($dhAlteracao)) {
            $useMinMax = false;
            if (isset($dhAlteracao['min'])) {
                $this->addUsingAlias(ClienteTableMap::COL_DH_ALTERACAO, $dhAlteracao['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($dhAlteracao['max'])) {
                $this->addUsingAlias(ClienteTableMap::COL_DH_ALTERACAO, $dhAlteracao['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ClienteTableMap::COL_DH_ALTERACAO, $dhAlteracao, $comparison);
    }

    /**
     * Filter the query on the user_id_inclusao column
     *
     * Example usage:
     * <code>
     * $query->filterByUserIdInclusao(1234); // WHERE user_id_inclusao = 1234
     * $query->filterByUserIdInclusao(array(12, 34)); // WHERE user_id_inclusao IN (12, 34)
     * $query->filterByUserIdInclusao(array('min' => 12)); // WHERE user_id_inclusao > 12
     * </code>
     *
     * @see       filterByUserRelatedByUserIdInclusao()
     *
     * @param     mixed $userIdInclusao The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildClienteQuery The current query, for fluid interface
     */
    public function filterByUserIdInclusao($userIdInclusao = null, $comparison = null)
    {
        if (is_array($userIdInclusao)) {
            $useMinMax = false;
            if (isset($userIdInclusao['min'])) {
                $this->addUsingAlias(ClienteTableMap::COL_USER_ID_INCLUSAO, $userIdInclusao['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($userIdInclusao['max'])) {
                $this->addUsingAlias(ClienteTableMap::COL_USER_ID_INCLUSAO, $userIdInclusao['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ClienteTableMap::COL_USER_ID_INCLUSAO, $userIdInclusao, $comparison);
    }

    /**
     * Filter the query on the user_id_alteracao column
     *
     * Example usage:
     * <code>
     * $query->filterByUserIdAlteracao(1234); // WHERE user_id_alteracao = 1234
     * $query->filterByUserIdAlteracao(array(12, 34)); // WHERE user_id_alteracao IN (12, 34)
     * $query->filterByUserIdAlteracao(array('min' => 12)); // WHERE user_id_alteracao > 12
     * </code>
     *
     * @see       filterByUserRelatedByUserIdAlteracao()
     *
     * @param     mixed $userIdAlteracao The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildClienteQuery The current query, for fluid interface
     */
    public function filterByUserIdAlteracao($userIdAlteracao = null, $comparison = null)
    {
        if (is_array($userIdAlteracao)) {
            $useMinMax = false;
            if (isset($userIdAlteracao['min'])) {
                $this->addUsingAlias(ClienteTableMap::COL_USER_ID_ALTERACAO, $userIdAlteracao['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($userIdAlteracao['max'])) {
                $this->addUsingAlias(ClienteTableMap::COL_USER_ID_ALTERACAO, $userIdAlteracao['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ClienteTableMap::COL_USER_ID_ALTERACAO, $userIdAlteracao, $comparison);
    }

    /**
     * Filter the query by a related \Table\Model\User object
     *
     * @param \Table\Model\User|ObjectCollection $user The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildClienteQuery The current query, for fluid interface
     */
    public function filterByUserRelatedByUserIdInclusao($user, $comparison = null)
    {
        if ($user instanceof \Table\Model\User) {
            return $this
                ->addUsingAlias(ClienteTableMap::COL_USER_ID_INCLUSAO, $user->getId(), $comparison);
        } elseif ($user instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ClienteTableMap::COL_USER_ID_INCLUSAO, $user->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByUserRelatedByUserIdInclusao() only accepts arguments of type \Table\Model\User or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the UserRelatedByUserIdInclusao relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildClienteQuery The current query, for fluid interface
     */
    public function joinUserRelatedByUserIdInclusao($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('UserRelatedByUserIdInclusao');

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
            $this->addJoinObject($join, 'UserRelatedByUserIdInclusao');
        }

        return $this;
    }

    /**
     * Use the UserRelatedByUserIdInclusao relation User object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Table\Model\UserQuery A secondary query class using the current class as primary query
     */
    public function useUserRelatedByUserIdInclusaoQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinUserRelatedByUserIdInclusao($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'UserRelatedByUserIdInclusao', '\Table\Model\UserQuery');
    }

    /**
     * Filter the query by a related \Table\Model\User object
     *
     * @param \Table\Model\User|ObjectCollection $user The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildClienteQuery The current query, for fluid interface
     */
    public function filterByUserRelatedByUserIdAlteracao($user, $comparison = null)
    {
        if ($user instanceof \Table\Model\User) {
            return $this
                ->addUsingAlias(ClienteTableMap::COL_USER_ID_ALTERACAO, $user->getId(), $comparison);
        } elseif ($user instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ClienteTableMap::COL_USER_ID_ALTERACAO, $user->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByUserRelatedByUserIdAlteracao() only accepts arguments of type \Table\Model\User or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the UserRelatedByUserIdAlteracao relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildClienteQuery The current query, for fluid interface
     */
    public function joinUserRelatedByUserIdAlteracao($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('UserRelatedByUserIdAlteracao');

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
            $this->addJoinObject($join, 'UserRelatedByUserIdAlteracao');
        }

        return $this;
    }

    /**
     * Use the UserRelatedByUserIdAlteracao relation User object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Table\Model\UserQuery A secondary query class using the current class as primary query
     */
    public function useUserRelatedByUserIdAlteracaoQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinUserRelatedByUserIdAlteracao($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'UserRelatedByUserIdAlteracao', '\Table\Model\UserQuery');
    }

    /**
     * Filter the query by a related \Table\Model\Orcamento object
     *
     * @param \Table\Model\Orcamento|ObjectCollection $orcamento  the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildClienteQuery The current query, for fluid interface
     */
    public function filterByOrcamento($orcamento, $comparison = null)
    {
        if ($orcamento instanceof \Table\Model\Orcamento) {
            return $this
                ->addUsingAlias(ClienteTableMap::COL_ID, $orcamento->getClienteId(), $comparison);
        } elseif ($orcamento instanceof ObjectCollection) {
            return $this
                ->useOrcamentoQuery()
                ->filterByPrimaryKeys($orcamento->getPrimaryKeys())
                ->endUse();
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
     * @return $this|ChildClienteQuery The current query, for fluid interface
     */
    public function joinOrcamento($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
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
    public function useOrcamentoQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinOrcamento($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Orcamento', '\Table\Model\OrcamentoQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildCliente $cliente Object to remove from the list of results
     *
     * @return $this|ChildClienteQuery The current query, for fluid interface
     */
    public function prune($cliente = null)
    {
        if ($cliente) {
            $this->addUsingAlias(ClienteTableMap::COL_ID, $cliente->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the cliente table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ClienteTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ClienteTableMap::clearInstancePool();
            ClienteTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(ClienteTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ClienteTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            
            ClienteTableMap::removeInstanceFromPool($criteria);
        
            $affectedRows += ModelCriteria::delete($con);
            ClienteTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // ClienteQuery
