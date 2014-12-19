<?php

namespace Table\Model\Base;

use \DateTime;
use \Exception;
use \PDO;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveRecord\ActiveRecordInterface;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\BadMethodCallException;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Parser\AbstractParser;
use Propel\Runtime\Util\PropelDateTime;
use Table\Model\Cliente as ChildCliente;
use Table\Model\ClienteQuery as ChildClienteQuery;
use Table\Model\Orcamento as ChildOrcamento;
use Table\Model\OrcamentoQuery as ChildOrcamentoQuery;
use Table\Model\User as ChildUser;
use Table\Model\UserQuery as ChildUserQuery;
use Table\Model\Map\ClienteTableMap;

/**
 * Base class that represents a row from the 'cliente' table.
 *
 * 
 *
* @package    propel.generator.Table.Model.Base
*/
abstract class Cliente implements ActiveRecordInterface 
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\Table\\Model\\Map\\ClienteTableMap';


    /**
     * attribute to determine if this object has previously been saved.
     * @var boolean
     */
    protected $new = true;

    /**
     * attribute to determine whether this object has been deleted.
     * @var boolean
     */
    protected $deleted = false;

    /**
     * The columns that have been modified in current object.
     * Tracking modified columns allows us to only update modified columns.
     * @var array
     */
    protected $modifiedColumns = array();

    /**
     * The (virtual) columns that are added at runtime
     * The formatters can add supplementary columns based on a resultset
     * @var array
     */
    protected $virtualColumns = array();

    /**
     * The value for the id field.
     * @var        int
     */
    protected $id;

    /**
     * The value for the razao_social field.
     * @var        string
     */
    protected $razao_social;

    /**
     * The value for the contato field.
     * @var        string
     */
    protected $contato;

    /**
     * The value for the email field.
     * @var        string
     */
    protected $email;

    /**
     * The value for the documento field.
     * @var        string
     */
    protected $documento;

    /**
     * The value for the tipo_pessoa field.
     * @var        string
     */
    protected $tipo_pessoa;

    /**
     * The value for the cep field.
     * @var        string
     */
    protected $cep;

    /**
     * The value for the endereco field.
     * @var        string
     */
    protected $endereco;

    /**
     * The value for the numero field.
     * @var        int
     */
    protected $numero;

    /**
     * The value for the complemento field.
     * @var        string
     */
    protected $complemento;

    /**
     * The value for the bairro field.
     * @var        string
     */
    protected $bairro;

    /**
     * The value for the cidade field.
     * @var        string
     */
    protected $cidade;

    /**
     * The value for the uf field.
     * @var        string
     */
    protected $uf;

    /**
     * The value for the telefone field.
     * @var        string
     */
    protected $telefone;

    /**
     * The value for the status field.
     * @var        int
     */
    protected $status;

    /**
     * The value for the dh_inclusao field.
     * @var        \DateTime
     */
    protected $dh_inclusao;

    /**
     * The value for the dh_alteracao field.
     * @var        \DateTime
     */
    protected $dh_alteracao;

    /**
     * The value for the user_id_inclusao field.
     * @var        int
     */
    protected $user_id_inclusao;

    /**
     * The value for the user_id_alteracao field.
     * @var        int
     */
    protected $user_id_alteracao;

    /**
     * @var        ChildUser
     */
    protected $aUserRelatedByUserIdInclusao;

    /**
     * @var        ChildUser
     */
    protected $aUserRelatedByUserIdAlteracao;

    /**
     * @var        ObjectCollection|ChildOrcamento[] Collection to store aggregation of ChildOrcamento objects.
     */
    protected $collOrcamentos;
    protected $collOrcamentosPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildOrcamento[]
     */
    protected $orcamentosScheduledForDeletion = null;

    /**
     * Initializes internal state of Table\Model\Base\Cliente object.
     */
    public function __construct()
    {
    }

    /**
     * Returns whether the object has been modified.
     *
     * @return boolean True if the object has been modified.
     */
    public function isModified()
    {
        return !!$this->modifiedColumns;
    }

    /**
     * Has specified column been modified?
     *
     * @param  string  $col column fully qualified name (TableMap::TYPE_COLNAME), e.g. Book::AUTHOR_ID
     * @return boolean True if $col has been modified.
     */
    public function isColumnModified($col)
    {
        return $this->modifiedColumns && isset($this->modifiedColumns[$col]);
    }

    /**
     * Get the columns that have been modified in this object.
     * @return array A unique list of the modified column names for this object.
     */
    public function getModifiedColumns()
    {
        return $this->modifiedColumns ? array_keys($this->modifiedColumns) : [];
    }

    /**
     * Returns whether the object has ever been saved.  This will
     * be false, if the object was retrieved from storage or was created
     * and then saved.
     *
     * @return boolean true, if the object has never been persisted.
     */
    public function isNew()
    {
        return $this->new;
    }

    /**
     * Setter for the isNew attribute.  This method will be called
     * by Propel-generated children and objects.
     *
     * @param boolean $b the state of the object.
     */
    public function setNew($b)
    {
        $this->new = (boolean) $b;
    }

    /**
     * Whether this object has been deleted.
     * @return boolean The deleted state of this object.
     */
    public function isDeleted()
    {
        return $this->deleted;
    }

    /**
     * Specify whether this object has been deleted.
     * @param  boolean $b The deleted state of this object.
     * @return void
     */
    public function setDeleted($b)
    {
        $this->deleted = (boolean) $b;
    }

    /**
     * Sets the modified state for the object to be false.
     * @param  string $col If supplied, only the specified column is reset.
     * @return void
     */
    public function resetModified($col = null)
    {
        if (null !== $col) {
            if (isset($this->modifiedColumns[$col])) {
                unset($this->modifiedColumns[$col]);
            }
        } else {
            $this->modifiedColumns = array();
        }
    }

    /**
     * Compares this with another <code>Cliente</code> instance.  If
     * <code>obj</code> is an instance of <code>Cliente</code>, delegates to
     * <code>equals(Cliente)</code>.  Otherwise, returns <code>false</code>.
     *
     * @param  mixed   $obj The object to compare to.
     * @return boolean Whether equal to the object specified.
     */
    public function equals($obj)
    {
        if (!$obj instanceof static) {
            return false;
        }

        if ($this === $obj) {
            return true;
        }

        if (null === $this->getPrimaryKey() || null === $obj->getPrimaryKey()) {
            return false;
        }

        return $this->getPrimaryKey() === $obj->getPrimaryKey();
    }

    /**
     * Get the associative array of the virtual columns in this object
     *
     * @return array
     */
    public function getVirtualColumns()
    {
        return $this->virtualColumns;
    }

    /**
     * Checks the existence of a virtual column in this object
     *
     * @param  string  $name The virtual column name
     * @return boolean
     */
    public function hasVirtualColumn($name)
    {
        return array_key_exists($name, $this->virtualColumns);
    }

    /**
     * Get the value of a virtual column in this object
     *
     * @param  string $name The virtual column name
     * @return mixed
     *
     * @throws PropelException
     */
    public function getVirtualColumn($name)
    {
        if (!$this->hasVirtualColumn($name)) {
            throw new PropelException(sprintf('Cannot get value of inexistent virtual column %s.', $name));
        }

        return $this->virtualColumns[$name];
    }

    /**
     * Set the value of a virtual column in this object
     *
     * @param string $name  The virtual column name
     * @param mixed  $value The value to give to the virtual column
     *
     * @return $this|Cliente The current object, for fluid interface
     */
    public function setVirtualColumn($name, $value)
    {
        $this->virtualColumns[$name] = $value;

        return $this;
    }

    /**
     * Logs a message using Propel::log().
     *
     * @param  string  $msg
     * @param  int     $priority One of the Propel::LOG_* logging levels
     * @return boolean
     */
    protected function log($msg, $priority = Propel::LOG_INFO)
    {
        return Propel::log(get_class($this) . ': ' . $msg, $priority);
    }

    /**
     * Export the current object properties to a string, using a given parser format
     * <code>
     * $book = BookQuery::create()->findPk(9012);
     * echo $book->exportTo('JSON');
     *  => {"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * @param  mixed   $parser                 A AbstractParser instance, or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param  boolean $includeLazyLoadColumns (optional) Whether to include lazy load(ed) columns. Defaults to TRUE.
     * @return string  The exported data
     */
    public function exportTo($parser, $includeLazyLoadColumns = true)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        return $parser->fromArray($this->toArray(TableMap::TYPE_PHPNAME, $includeLazyLoadColumns, array(), true));
    }

    /**
     * Clean up internal collections prior to serializing
     * Avoids recursive loops that turn into segmentation faults when serializing
     */
    public function __sleep()
    {
        $this->clearAllReferences();

        return array_keys(get_object_vars($this));
    }

    /**
     * Get the [id] column value.
     * 
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the [razao_social] column value.
     * 
     * @return string
     */
    public function getRazaoSocial()
    {
        return $this->razao_social;
    }

    /**
     * Get the [contato] column value.
     * 
     * @return string
     */
    public function getContato()
    {
        return $this->contato;
    }

    /**
     * Get the [email] column value.
     * 
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Get the [documento] column value.
     * 
     * @return string
     */
    public function getDocumento()
    {
        return $this->documento;
    }

    /**
     * Get the [tipo_pessoa] column value.
     * 
     * @return string
     */
    public function getTipoPessoa()
    {
        return $this->tipo_pessoa;
    }

    /**
     * Get the [cep] column value.
     * 
     * @return string
     */
    public function getCep()
    {
        return $this->cep;
    }

    /**
     * Get the [endereco] column value.
     * 
     * @return string
     */
    public function getEndereco()
    {
        return $this->endereco;
    }

    /**
     * Get the [numero] column value.
     * 
     * @return int
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Get the [complemento] column value.
     * 
     * @return string
     */
    public function getComplemento()
    {
        return $this->complemento;
    }

    /**
     * Get the [bairro] column value.
     * 
     * @return string
     */
    public function getBairro()
    {
        return $this->bairro;
    }

    /**
     * Get the [cidade] column value.
     * 
     * @return string
     */
    public function getCidade()
    {
        return $this->cidade;
    }

    /**
     * Get the [uf] column value.
     * 
     * @return string
     */
    public function getUf()
    {
        return $this->uf;
    }

    /**
     * Get the [telefone] column value.
     * 
     * @return string
     */
    public function getTelefone()
    {
        return $this->telefone;
    }

    /**
     * Get the [status] column value.
     * 
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Get the [optionally formatted] temporal [dh_inclusao] column value.
     * 
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getDhInclusao($format = NULL)
    {
        if ($format === null) {
            return $this->dh_inclusao;
        } else {
            return $this->dh_inclusao instanceof \DateTime ? $this->dh_inclusao->format($format) : null;
        }
    }

    /**
     * Get the [optionally formatted] temporal [dh_alteracao] column value.
     * 
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getDhAlteracao($format = NULL)
    {
        if ($format === null) {
            return $this->dh_alteracao;
        } else {
            return $this->dh_alteracao instanceof \DateTime ? $this->dh_alteracao->format($format) : null;
        }
    }

    /**
     * Get the [user_id_inclusao] column value.
     * 
     * @return int
     */
    public function getUserIdInclusao()
    {
        return $this->user_id_inclusao;
    }

    /**
     * Get the [user_id_alteracao] column value.
     * 
     * @return int
     */
    public function getUserIdAlteracao()
    {
        return $this->user_id_alteracao;
    }

    /**
     * Set the value of [id] column.
     * 
     * @param  int $v new value
     * @return $this|\Table\Model\Cliente The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[ClienteTableMap::COL_ID] = true;
        }

        return $this;
    } // setId()

    /**
     * Set the value of [razao_social] column.
     * 
     * @param  string $v new value
     * @return $this|\Table\Model\Cliente The current object (for fluent API support)
     */
    public function setRazaoSocial($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->razao_social !== $v) {
            $this->razao_social = $v;
            $this->modifiedColumns[ClienteTableMap::COL_RAZAO_SOCIAL] = true;
        }

        return $this;
    } // setRazaoSocial()

    /**
     * Set the value of [contato] column.
     * 
     * @param  string $v new value
     * @return $this|\Table\Model\Cliente The current object (for fluent API support)
     */
    public function setContato($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->contato !== $v) {
            $this->contato = $v;
            $this->modifiedColumns[ClienteTableMap::COL_CONTATO] = true;
        }

        return $this;
    } // setContato()

    /**
     * Set the value of [email] column.
     * 
     * @param  string $v new value
     * @return $this|\Table\Model\Cliente The current object (for fluent API support)
     */
    public function setEmail($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->email !== $v) {
            $this->email = $v;
            $this->modifiedColumns[ClienteTableMap::COL_EMAIL] = true;
        }

        return $this;
    } // setEmail()

    /**
     * Set the value of [documento] column.
     * 
     * @param  string $v new value
     * @return $this|\Table\Model\Cliente The current object (for fluent API support)
     */
    public function setDocumento($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->documento !== $v) {
            $this->documento = $v;
            $this->modifiedColumns[ClienteTableMap::COL_DOCUMENTO] = true;
        }

        return $this;
    } // setDocumento()

    /**
     * Set the value of [tipo_pessoa] column.
     * 
     * @param  string $v new value
     * @return $this|\Table\Model\Cliente The current object (for fluent API support)
     */
    public function setTipoPessoa($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->tipo_pessoa !== $v) {
            $this->tipo_pessoa = $v;
            $this->modifiedColumns[ClienteTableMap::COL_TIPO_PESSOA] = true;
        }

        return $this;
    } // setTipoPessoa()

    /**
     * Set the value of [cep] column.
     * 
     * @param  string $v new value
     * @return $this|\Table\Model\Cliente The current object (for fluent API support)
     */
    public function setCep($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->cep !== $v) {
            $this->cep = $v;
            $this->modifiedColumns[ClienteTableMap::COL_CEP] = true;
        }

        return $this;
    } // setCep()

    /**
     * Set the value of [endereco] column.
     * 
     * @param  string $v new value
     * @return $this|\Table\Model\Cliente The current object (for fluent API support)
     */
    public function setEndereco($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->endereco !== $v) {
            $this->endereco = $v;
            $this->modifiedColumns[ClienteTableMap::COL_ENDERECO] = true;
        }

        return $this;
    } // setEndereco()

    /**
     * Set the value of [numero] column.
     * 
     * @param  int $v new value
     * @return $this|\Table\Model\Cliente The current object (for fluent API support)
     */
    public function setNumero($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->numero !== $v) {
            $this->numero = $v;
            $this->modifiedColumns[ClienteTableMap::COL_NUMERO] = true;
        }

        return $this;
    } // setNumero()

    /**
     * Set the value of [complemento] column.
     * 
     * @param  string $v new value
     * @return $this|\Table\Model\Cliente The current object (for fluent API support)
     */
    public function setComplemento($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->complemento !== $v) {
            $this->complemento = $v;
            $this->modifiedColumns[ClienteTableMap::COL_COMPLEMENTO] = true;
        }

        return $this;
    } // setComplemento()

    /**
     * Set the value of [bairro] column.
     * 
     * @param  string $v new value
     * @return $this|\Table\Model\Cliente The current object (for fluent API support)
     */
    public function setBairro($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->bairro !== $v) {
            $this->bairro = $v;
            $this->modifiedColumns[ClienteTableMap::COL_BAIRRO] = true;
        }

        return $this;
    } // setBairro()

    /**
     * Set the value of [cidade] column.
     * 
     * @param  string $v new value
     * @return $this|\Table\Model\Cliente The current object (for fluent API support)
     */
    public function setCidade($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->cidade !== $v) {
            $this->cidade = $v;
            $this->modifiedColumns[ClienteTableMap::COL_CIDADE] = true;
        }

        return $this;
    } // setCidade()

    /**
     * Set the value of [uf] column.
     * 
     * @param  string $v new value
     * @return $this|\Table\Model\Cliente The current object (for fluent API support)
     */
    public function setUf($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->uf !== $v) {
            $this->uf = $v;
            $this->modifiedColumns[ClienteTableMap::COL_UF] = true;
        }

        return $this;
    } // setUf()

    /**
     * Set the value of [telefone] column.
     * 
     * @param  string $v new value
     * @return $this|\Table\Model\Cliente The current object (for fluent API support)
     */
    public function setTelefone($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->telefone !== $v) {
            $this->telefone = $v;
            $this->modifiedColumns[ClienteTableMap::COL_TELEFONE] = true;
        }

        return $this;
    } // setTelefone()

    /**
     * Set the value of [status] column.
     * 
     * @param  int $v new value
     * @return $this|\Table\Model\Cliente The current object (for fluent API support)
     */
    public function setStatus($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->status !== $v) {
            $this->status = $v;
            $this->modifiedColumns[ClienteTableMap::COL_STATUS] = true;
        }

        return $this;
    } // setStatus()

    /**
     * Sets the value of [dh_inclusao] column to a normalized version of the date/time value specified.
     * 
     * @param  mixed $v string, integer (timestamp), or \DateTime value.
     *               Empty strings are treated as NULL.
     * @return $this|\Table\Model\Cliente The current object (for fluent API support)
     */
    public function setDhInclusao($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->dh_inclusao !== null || $dt !== null) {
            if ($dt !== $this->dh_inclusao) {
                $this->dh_inclusao = $dt;
                $this->modifiedColumns[ClienteTableMap::COL_DH_INCLUSAO] = true;
            }
        } // if either are not null

        return $this;
    } // setDhInclusao()

    /**
     * Sets the value of [dh_alteracao] column to a normalized version of the date/time value specified.
     * 
     * @param  mixed $v string, integer (timestamp), or \DateTime value.
     *               Empty strings are treated as NULL.
     * @return $this|\Table\Model\Cliente The current object (for fluent API support)
     */
    public function setDhAlteracao($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->dh_alteracao !== null || $dt !== null) {
            if ($dt !== $this->dh_alteracao) {
                $this->dh_alteracao = $dt;
                $this->modifiedColumns[ClienteTableMap::COL_DH_ALTERACAO] = true;
            }
        } // if either are not null

        return $this;
    } // setDhAlteracao()

    /**
     * Set the value of [user_id_inclusao] column.
     * 
     * @param  int $v new value
     * @return $this|\Table\Model\Cliente The current object (for fluent API support)
     */
    public function setUserIdInclusao($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->user_id_inclusao !== $v) {
            $this->user_id_inclusao = $v;
            $this->modifiedColumns[ClienteTableMap::COL_USER_ID_INCLUSAO] = true;
        }

        if ($this->aUserRelatedByUserIdInclusao !== null && $this->aUserRelatedByUserIdInclusao->getId() !== $v) {
            $this->aUserRelatedByUserIdInclusao = null;
        }

        return $this;
    } // setUserIdInclusao()

    /**
     * Set the value of [user_id_alteracao] column.
     * 
     * @param  int $v new value
     * @return $this|\Table\Model\Cliente The current object (for fluent API support)
     */
    public function setUserIdAlteracao($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->user_id_alteracao !== $v) {
            $this->user_id_alteracao = $v;
            $this->modifiedColumns[ClienteTableMap::COL_USER_ID_ALTERACAO] = true;
        }

        if ($this->aUserRelatedByUserIdAlteracao !== null && $this->aUserRelatedByUserIdAlteracao->getId() !== $v) {
            $this->aUserRelatedByUserIdAlteracao = null;
        }

        return $this;
    } // setUserIdAlteracao()

    /**
     * Indicates whether the columns in this object are only set to default values.
     *
     * This method can be used in conjunction with isModified() to indicate whether an object is both
     * modified _and_ has some values set which are non-default.
     *
     * @return boolean Whether the columns in this object are only been set with default values.
     */
    public function hasOnlyDefaultValues()
    {
        // otherwise, everything was equal, so return TRUE
        return true;
    } // hasOnlyDefaultValues()

    /**
     * Hydrates (populates) the object variables with values from the database resultset.
     *
     * An offset (0-based "start column") is specified so that objects can be hydrated
     * with a subset of the columns in the resultset rows.  This is needed, for example,
     * for results of JOIN queries where the resultset row includes columns from two or
     * more tables.
     *
     * @param array   $row       The row returned by DataFetcher->fetch().
     * @param int     $startcol  0-based offset column which indicates which restultset column to start with.
     * @param boolean $rehydrate Whether this object is being re-hydrated from the database.
     * @param string  $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                  One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                            TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @return int             next starting column
     * @throws PropelException - Any caught Exception will be rewrapped as a PropelException.
     */
    public function hydrate($row, $startcol = 0, $rehydrate = false, $indexType = TableMap::TYPE_NUM)
    {
        try {

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : ClienteTableMap::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : ClienteTableMap::translateFieldName('RazaoSocial', TableMap::TYPE_PHPNAME, $indexType)];
            $this->razao_social = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : ClienteTableMap::translateFieldName('Contato', TableMap::TYPE_PHPNAME, $indexType)];
            $this->contato = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : ClienteTableMap::translateFieldName('Email', TableMap::TYPE_PHPNAME, $indexType)];
            $this->email = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : ClienteTableMap::translateFieldName('Documento', TableMap::TYPE_PHPNAME, $indexType)];
            $this->documento = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : ClienteTableMap::translateFieldName('TipoPessoa', TableMap::TYPE_PHPNAME, $indexType)];
            $this->tipo_pessoa = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : ClienteTableMap::translateFieldName('Cep', TableMap::TYPE_PHPNAME, $indexType)];
            $this->cep = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : ClienteTableMap::translateFieldName('Endereco', TableMap::TYPE_PHPNAME, $indexType)];
            $this->endereco = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : ClienteTableMap::translateFieldName('Numero', TableMap::TYPE_PHPNAME, $indexType)];
            $this->numero = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : ClienteTableMap::translateFieldName('Complemento', TableMap::TYPE_PHPNAME, $indexType)];
            $this->complemento = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : ClienteTableMap::translateFieldName('Bairro', TableMap::TYPE_PHPNAME, $indexType)];
            $this->bairro = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : ClienteTableMap::translateFieldName('Cidade', TableMap::TYPE_PHPNAME, $indexType)];
            $this->cidade = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : ClienteTableMap::translateFieldName('Uf', TableMap::TYPE_PHPNAME, $indexType)];
            $this->uf = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 13 + $startcol : ClienteTableMap::translateFieldName('Telefone', TableMap::TYPE_PHPNAME, $indexType)];
            $this->telefone = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 14 + $startcol : ClienteTableMap::translateFieldName('Status', TableMap::TYPE_PHPNAME, $indexType)];
            $this->status = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 15 + $startcol : ClienteTableMap::translateFieldName('DhInclusao', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->dh_inclusao = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 16 + $startcol : ClienteTableMap::translateFieldName('DhAlteracao', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->dh_alteracao = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 17 + $startcol : ClienteTableMap::translateFieldName('UserIdInclusao', TableMap::TYPE_PHPNAME, $indexType)];
            $this->user_id_inclusao = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 18 + $startcol : ClienteTableMap::translateFieldName('UserIdAlteracao', TableMap::TYPE_PHPNAME, $indexType)];
            $this->user_id_alteracao = (null !== $col) ? (int) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 19; // 19 = ClienteTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Table\\Model\\Cliente'), 0, $e);
        }
    }

    /**
     * Checks and repairs the internal consistency of the object.
     *
     * This method is executed after an already-instantiated object is re-hydrated
     * from the database.  It exists to check any foreign keys to make sure that
     * the objects related to the current object are correct based on foreign key.
     *
     * You can override this method in the stub class, but you should always invoke
     * the base method from the overridden method (i.e. parent::ensureConsistency()),
     * in case your model changes.
     *
     * @throws PropelException
     */
    public function ensureConsistency()
    {
        if ($this->aUserRelatedByUserIdInclusao !== null && $this->user_id_inclusao !== $this->aUserRelatedByUserIdInclusao->getId()) {
            $this->aUserRelatedByUserIdInclusao = null;
        }
        if ($this->aUserRelatedByUserIdAlteracao !== null && $this->user_id_alteracao !== $this->aUserRelatedByUserIdAlteracao->getId()) {
            $this->aUserRelatedByUserIdAlteracao = null;
        }
    } // ensureConsistency

    /**
     * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
     *
     * This will only work if the object has been saved and has a valid primary key set.
     *
     * @param      boolean $deep (optional) Whether to also de-associated any related objects.
     * @param      ConnectionInterface $con (optional) The ConnectionInterface connection to use.
     * @return void
     * @throws PropelException - if this object is deleted, unsaved or doesn't have pk match in db
     */
    public function reload($deep = false, ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("Cannot reload a deleted object.");
        }

        if ($this->isNew()) {
            throw new PropelException("Cannot reload an unsaved object.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ClienteTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildClienteQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aUserRelatedByUserIdInclusao = null;
            $this->aUserRelatedByUserIdAlteracao = null;
            $this->collOrcamentos = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see Cliente::setDeleted()
     * @see Cliente::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(ClienteTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildClienteQuery::create()
                ->filterByPrimaryKey($this->getPrimaryKey());
            $ret = $this->preDelete($con);
            if ($ret) {
                $deleteQuery->delete($con);
                $this->postDelete($con);
                $this->setDeleted(true);
            }
        });
    }

    /**
     * Persists this object to the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All modified related objects will also be persisted in the doSave()
     * method.  This method wraps all precipitate database operations in a
     * single transaction.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see doSave()
     */
    public function save(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("You cannot save an object that has been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(ClienteTableMap::DATABASE_NAME);
        }

        return $con->transaction(function () use ($con) {
            $isInsert = $this->isNew();
            $ret = $this->preSave($con);
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
            } else {
                $ret = $ret && $this->preUpdate($con);
            }
            if ($ret) {
                $affectedRows = $this->doSave($con);
                if ($isInsert) {
                    $this->postInsert($con);
                } else {
                    $this->postUpdate($con);
                }
                $this->postSave($con);
                ClienteTableMap::addInstanceToPool($this);
            } else {
                $affectedRows = 0;
            }

            return $affectedRows;
        });
    }

    /**
     * Performs the work of inserting or updating the row in the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All related objects are also updated in this method.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see save()
     */
    protected function doSave(ConnectionInterface $con)
    {
        $affectedRows = 0; // initialize var to track total num of affected rows
        if (!$this->alreadyInSave) {
            $this->alreadyInSave = true;

            // We call the save method on the following object(s) if they
            // were passed to this object by their corresponding set
            // method.  This object relates to these object(s) by a
            // foreign key reference.

            if ($this->aUserRelatedByUserIdInclusao !== null) {
                if ($this->aUserRelatedByUserIdInclusao->isModified() || $this->aUserRelatedByUserIdInclusao->isNew()) {
                    $affectedRows += $this->aUserRelatedByUserIdInclusao->save($con);
                }
                $this->setUserRelatedByUserIdInclusao($this->aUserRelatedByUserIdInclusao);
            }

            if ($this->aUserRelatedByUserIdAlteracao !== null) {
                if ($this->aUserRelatedByUserIdAlteracao->isModified() || $this->aUserRelatedByUserIdAlteracao->isNew()) {
                    $affectedRows += $this->aUserRelatedByUserIdAlteracao->save($con);
                }
                $this->setUserRelatedByUserIdAlteracao($this->aUserRelatedByUserIdAlteracao);
            }

            if ($this->isNew() || $this->isModified()) {
                // persist changes
                if ($this->isNew()) {
                    $this->doInsert($con);
                    $affectedRows += 1;
                } else {
                    $affectedRows += $this->doUpdate($con);
                }
                $this->resetModified();
            }

            if ($this->orcamentosScheduledForDeletion !== null) {
                if (!$this->orcamentosScheduledForDeletion->isEmpty()) {
                    foreach ($this->orcamentosScheduledForDeletion as $orcamento) {
                        // need to save related object because we set the relation to null
                        $orcamento->save($con);
                    }
                    $this->orcamentosScheduledForDeletion = null;
                }
            }

            if ($this->collOrcamentos !== null) {
                foreach ($this->collOrcamentos as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            $this->alreadyInSave = false;

        }

        return $affectedRows;
    } // doSave()

    /**
     * Insert the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @throws PropelException
     * @see doSave()
     */
    protected function doInsert(ConnectionInterface $con)
    {
        $modifiedColumns = array();
        $index = 0;

        $this->modifiedColumns[ClienteTableMap::COL_ID] = true;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . ClienteTableMap::COL_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(ClienteTableMap::COL_ID)) {
            $modifiedColumns[':p' . $index++]  = 'id';
        }
        if ($this->isColumnModified(ClienteTableMap::COL_RAZAO_SOCIAL)) {
            $modifiedColumns[':p' . $index++]  = 'razao_social';
        }
        if ($this->isColumnModified(ClienteTableMap::COL_CONTATO)) {
            $modifiedColumns[':p' . $index++]  = 'contato';
        }
        if ($this->isColumnModified(ClienteTableMap::COL_EMAIL)) {
            $modifiedColumns[':p' . $index++]  = 'email';
        }
        if ($this->isColumnModified(ClienteTableMap::COL_DOCUMENTO)) {
            $modifiedColumns[':p' . $index++]  = 'documento';
        }
        if ($this->isColumnModified(ClienteTableMap::COL_TIPO_PESSOA)) {
            $modifiedColumns[':p' . $index++]  = 'tipo_pessoa';
        }
        if ($this->isColumnModified(ClienteTableMap::COL_CEP)) {
            $modifiedColumns[':p' . $index++]  = 'cep';
        }
        if ($this->isColumnModified(ClienteTableMap::COL_ENDERECO)) {
            $modifiedColumns[':p' . $index++]  = 'endereco';
        }
        if ($this->isColumnModified(ClienteTableMap::COL_NUMERO)) {
            $modifiedColumns[':p' . $index++]  = 'numero';
        }
        if ($this->isColumnModified(ClienteTableMap::COL_COMPLEMENTO)) {
            $modifiedColumns[':p' . $index++]  = 'complemento';
        }
        if ($this->isColumnModified(ClienteTableMap::COL_BAIRRO)) {
            $modifiedColumns[':p' . $index++]  = 'bairro';
        }
        if ($this->isColumnModified(ClienteTableMap::COL_CIDADE)) {
            $modifiedColumns[':p' . $index++]  = 'cidade';
        }
        if ($this->isColumnModified(ClienteTableMap::COL_UF)) {
            $modifiedColumns[':p' . $index++]  = 'uf';
        }
        if ($this->isColumnModified(ClienteTableMap::COL_TELEFONE)) {
            $modifiedColumns[':p' . $index++]  = 'telefone';
        }
        if ($this->isColumnModified(ClienteTableMap::COL_STATUS)) {
            $modifiedColumns[':p' . $index++]  = 'status';
        }
        if ($this->isColumnModified(ClienteTableMap::COL_DH_INCLUSAO)) {
            $modifiedColumns[':p' . $index++]  = 'dh_inclusao';
        }
        if ($this->isColumnModified(ClienteTableMap::COL_DH_ALTERACAO)) {
            $modifiedColumns[':p' . $index++]  = 'dh_alteracao';
        }
        if ($this->isColumnModified(ClienteTableMap::COL_USER_ID_INCLUSAO)) {
            $modifiedColumns[':p' . $index++]  = 'user_id_inclusao';
        }
        if ($this->isColumnModified(ClienteTableMap::COL_USER_ID_ALTERACAO)) {
            $modifiedColumns[':p' . $index++]  = 'user_id_alteracao';
        }

        $sql = sprintf(
            'INSERT INTO cliente (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'id':                        
                        $stmt->bindValue($identifier, $this->id, PDO::PARAM_INT);
                        break;
                    case 'razao_social':                        
                        $stmt->bindValue($identifier, $this->razao_social, PDO::PARAM_STR);
                        break;
                    case 'contato':                        
                        $stmt->bindValue($identifier, $this->contato, PDO::PARAM_STR);
                        break;
                    case 'email':                        
                        $stmt->bindValue($identifier, $this->email, PDO::PARAM_STR);
                        break;
                    case 'documento':                        
                        $stmt->bindValue($identifier, $this->documento, PDO::PARAM_STR);
                        break;
                    case 'tipo_pessoa':                        
                        $stmt->bindValue($identifier, $this->tipo_pessoa, PDO::PARAM_STR);
                        break;
                    case 'cep':                        
                        $stmt->bindValue($identifier, $this->cep, PDO::PARAM_STR);
                        break;
                    case 'endereco':                        
                        $stmt->bindValue($identifier, $this->endereco, PDO::PARAM_STR);
                        break;
                    case 'numero':                        
                        $stmt->bindValue($identifier, $this->numero, PDO::PARAM_INT);
                        break;
                    case 'complemento':                        
                        $stmt->bindValue($identifier, $this->complemento, PDO::PARAM_STR);
                        break;
                    case 'bairro':                        
                        $stmt->bindValue($identifier, $this->bairro, PDO::PARAM_STR);
                        break;
                    case 'cidade':                        
                        $stmt->bindValue($identifier, $this->cidade, PDO::PARAM_STR);
                        break;
                    case 'uf':                        
                        $stmt->bindValue($identifier, $this->uf, PDO::PARAM_STR);
                        break;
                    case 'telefone':                        
                        $stmt->bindValue($identifier, $this->telefone, PDO::PARAM_STR);
                        break;
                    case 'status':                        
                        $stmt->bindValue($identifier, $this->status, PDO::PARAM_INT);
                        break;
                    case 'dh_inclusao':                        
                        $stmt->bindValue($identifier, $this->dh_inclusao ? $this->dh_inclusao->format("Y-m-d H:i:s") : null, PDO::PARAM_STR);
                        break;
                    case 'dh_alteracao':                        
                        $stmt->bindValue($identifier, $this->dh_alteracao ? $this->dh_alteracao->format("Y-m-d H:i:s") : null, PDO::PARAM_STR);
                        break;
                    case 'user_id_inclusao':                        
                        $stmt->bindValue($identifier, $this->user_id_inclusao, PDO::PARAM_INT);
                        break;
                    case 'user_id_alteracao':                        
                        $stmt->bindValue($identifier, $this->user_id_alteracao, PDO::PARAM_INT);
                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), 0, $e);
        }

        try {
            $pk = $con->lastInsertId();
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', 0, $e);
        }
        $this->setId($pk);

        $this->setNew(false);
    }

    /**
     * Update the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @return Integer Number of updated rows
     * @see doSave()
     */
    protected function doUpdate(ConnectionInterface $con)
    {
        $selectCriteria = $this->buildPkeyCriteria();
        $valuesCriteria = $this->buildCriteria();

        return $selectCriteria->doUpdate($valuesCriteria, $con);
    }

    /**
     * Retrieves a field from the object by name passed in as a string.
     *
     * @param      string $name name
     * @param      string $type The type of fieldname the $name is of:
     *                     one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                     TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                     Defaults to TableMap::TYPE_PHPNAME.
     * @return mixed Value of field.
     */
    public function getByName($name, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = ClienteTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
        $field = $this->getByPosition($pos);

        return $field;
    }

    /**
     * Retrieves a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param      int $pos position in xml schema
     * @return mixed Value of field at $pos
     */
    public function getByPosition($pos)
    {
        switch ($pos) {
            case 0:
                return $this->getId();
                break;
            case 1:
                return $this->getRazaoSocial();
                break;
            case 2:
                return $this->getContato();
                break;
            case 3:
                return $this->getEmail();
                break;
            case 4:
                return $this->getDocumento();
                break;
            case 5:
                return $this->getTipoPessoa();
                break;
            case 6:
                return $this->getCep();
                break;
            case 7:
                return $this->getEndereco();
                break;
            case 8:
                return $this->getNumero();
                break;
            case 9:
                return $this->getComplemento();
                break;
            case 10:
                return $this->getBairro();
                break;
            case 11:
                return $this->getCidade();
                break;
            case 12:
                return $this->getUf();
                break;
            case 13:
                return $this->getTelefone();
                break;
            case 14:
                return $this->getStatus();
                break;
            case 15:
                return $this->getDhInclusao();
                break;
            case 16:
                return $this->getDhAlteracao();
                break;
            case 17:
                return $this->getUserIdInclusao();
                break;
            case 18:
                return $this->getUserIdAlteracao();
                break;
            default:
                return null;
                break;
        } // switch()
    }

    /**
     * Exports the object as an array.
     *
     * You can specify the key type of the array by passing one of the class
     * type constants.
     *
     * @param     string  $keyType (optional) One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     *                    TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                    Defaults to TableMap::TYPE_PHPNAME.
     * @param     boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to TRUE.
     * @param     array $alreadyDumpedObjects List of objects to skip to avoid recursion
     * @param     boolean $includeForeignObjects (optional) Whether to include hydrated related objects. Default to FALSE.
     *
     * @return array an associative array containing the field names (as keys) and field values
     */
    public function toArray($keyType = TableMap::TYPE_PHPNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array(), $includeForeignObjects = false)
    {

        if (isset($alreadyDumpedObjects['Cliente'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Cliente'][$this->hashCode()] = true;
        $keys = ClienteTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getRazaoSocial(),
            $keys[2] => $this->getContato(),
            $keys[3] => $this->getEmail(),
            $keys[4] => $this->getDocumento(),
            $keys[5] => $this->getTipoPessoa(),
            $keys[6] => $this->getCep(),
            $keys[7] => $this->getEndereco(),
            $keys[8] => $this->getNumero(),
            $keys[9] => $this->getComplemento(),
            $keys[10] => $this->getBairro(),
            $keys[11] => $this->getCidade(),
            $keys[12] => $this->getUf(),
            $keys[13] => $this->getTelefone(),
            $keys[14] => $this->getStatus(),
            $keys[15] => $this->getDhInclusao(),
            $keys[16] => $this->getDhAlteracao(),
            $keys[17] => $this->getUserIdInclusao(),
            $keys[18] => $this->getUserIdAlteracao(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }
        
        if ($includeForeignObjects) {
            if (null !== $this->aUserRelatedByUserIdInclusao) {
                
                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'user';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'user';
                        break;
                    default:
                        $key = 'User';
                }
        
                $result[$key] = $this->aUserRelatedByUserIdInclusao->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aUserRelatedByUserIdAlteracao) {
                
                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'user';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'user';
                        break;
                    default:
                        $key = 'User';
                }
        
                $result[$key] = $this->aUserRelatedByUserIdAlteracao->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collOrcamentos) {
                
                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'orcamentos';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'orcamentos';
                        break;
                    default:
                        $key = 'Orcamentos';
                }
        
                $result[$key] = $this->collOrcamentos->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
        }

        return $result;
    }

    /**
     * Sets a field from the object by name passed in as a string.
     *
     * @param  string $name
     * @param  mixed  $value field value
     * @param  string $type The type of fieldname the $name is of:
     *                one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                Defaults to TableMap::TYPE_PHPNAME.
     * @return $this|\Table\Model\Cliente
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = ClienteTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\Table\Model\Cliente
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setId($value);
                break;
            case 1:
                $this->setRazaoSocial($value);
                break;
            case 2:
                $this->setContato($value);
                break;
            case 3:
                $this->setEmail($value);
                break;
            case 4:
                $this->setDocumento($value);
                break;
            case 5:
                $this->setTipoPessoa($value);
                break;
            case 6:
                $this->setCep($value);
                break;
            case 7:
                $this->setEndereco($value);
                break;
            case 8:
                $this->setNumero($value);
                break;
            case 9:
                $this->setComplemento($value);
                break;
            case 10:
                $this->setBairro($value);
                break;
            case 11:
                $this->setCidade($value);
                break;
            case 12:
                $this->setUf($value);
                break;
            case 13:
                $this->setTelefone($value);
                break;
            case 14:
                $this->setStatus($value);
                break;
            case 15:
                $this->setDhInclusao($value);
                break;
            case 16:
                $this->setDhAlteracao($value);
                break;
            case 17:
                $this->setUserIdInclusao($value);
                break;
            case 18:
                $this->setUserIdAlteracao($value);
                break;
        } // switch()

        return $this;
    }

    /**
     * Populates the object using an array.
     *
     * This is particularly useful when populating an object from one of the
     * request arrays (e.g. $_POST).  This method goes through the column
     * names, checking to see whether a matching key exists in populated
     * array. If so the setByName() method is called for that column.
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param      array  $arr     An array to populate the object from.
     * @param      string $keyType The type of keys the array uses.
     * @return void
     */
    public function fromArray($arr, $keyType = TableMap::TYPE_PHPNAME)
    {
        $keys = ClienteTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setRazaoSocial($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setContato($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setEmail($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setDocumento($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setTipoPessoa($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setCep($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setEndereco($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setNumero($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setComplemento($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setBairro($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setCidade($arr[$keys[11]]);
        }
        if (array_key_exists($keys[12], $arr)) {
            $this->setUf($arr[$keys[12]]);
        }
        if (array_key_exists($keys[13], $arr)) {
            $this->setTelefone($arr[$keys[13]]);
        }
        if (array_key_exists($keys[14], $arr)) {
            $this->setStatus($arr[$keys[14]]);
        }
        if (array_key_exists($keys[15], $arr)) {
            $this->setDhInclusao($arr[$keys[15]]);
        }
        if (array_key_exists($keys[16], $arr)) {
            $this->setDhAlteracao($arr[$keys[16]]);
        }
        if (array_key_exists($keys[17], $arr)) {
            $this->setUserIdInclusao($arr[$keys[17]]);
        }
        if (array_key_exists($keys[18], $arr)) {
            $this->setUserIdAlteracao($arr[$keys[18]]);
        }
    }

     /**
     * Populate the current object from a string, using a given parser format
     * <code>
     * $book = new Book();
     * $book->importFrom('JSON', '{"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param mixed $parser A AbstractParser instance,
     *                       or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param string $data The source data to import from
     * @param string $keyType The type of keys the array uses.
     *
     * @return $this|\Table\Model\Cliente The current object, for fluid interface
     */
    public function importFrom($parser, $data, $keyType = TableMap::TYPE_PHPNAME)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        $this->fromArray($parser->toArray($data), $keyType);

        return $this;
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(ClienteTableMap::DATABASE_NAME);

        if ($this->isColumnModified(ClienteTableMap::COL_ID)) {
            $criteria->add(ClienteTableMap::COL_ID, $this->id);
        }
        if ($this->isColumnModified(ClienteTableMap::COL_RAZAO_SOCIAL)) {
            $criteria->add(ClienteTableMap::COL_RAZAO_SOCIAL, $this->razao_social);
        }
        if ($this->isColumnModified(ClienteTableMap::COL_CONTATO)) {
            $criteria->add(ClienteTableMap::COL_CONTATO, $this->contato);
        }
        if ($this->isColumnModified(ClienteTableMap::COL_EMAIL)) {
            $criteria->add(ClienteTableMap::COL_EMAIL, $this->email);
        }
        if ($this->isColumnModified(ClienteTableMap::COL_DOCUMENTO)) {
            $criteria->add(ClienteTableMap::COL_DOCUMENTO, $this->documento);
        }
        if ($this->isColumnModified(ClienteTableMap::COL_TIPO_PESSOA)) {
            $criteria->add(ClienteTableMap::COL_TIPO_PESSOA, $this->tipo_pessoa);
        }
        if ($this->isColumnModified(ClienteTableMap::COL_CEP)) {
            $criteria->add(ClienteTableMap::COL_CEP, $this->cep);
        }
        if ($this->isColumnModified(ClienteTableMap::COL_ENDERECO)) {
            $criteria->add(ClienteTableMap::COL_ENDERECO, $this->endereco);
        }
        if ($this->isColumnModified(ClienteTableMap::COL_NUMERO)) {
            $criteria->add(ClienteTableMap::COL_NUMERO, $this->numero);
        }
        if ($this->isColumnModified(ClienteTableMap::COL_COMPLEMENTO)) {
            $criteria->add(ClienteTableMap::COL_COMPLEMENTO, $this->complemento);
        }
        if ($this->isColumnModified(ClienteTableMap::COL_BAIRRO)) {
            $criteria->add(ClienteTableMap::COL_BAIRRO, $this->bairro);
        }
        if ($this->isColumnModified(ClienteTableMap::COL_CIDADE)) {
            $criteria->add(ClienteTableMap::COL_CIDADE, $this->cidade);
        }
        if ($this->isColumnModified(ClienteTableMap::COL_UF)) {
            $criteria->add(ClienteTableMap::COL_UF, $this->uf);
        }
        if ($this->isColumnModified(ClienteTableMap::COL_TELEFONE)) {
            $criteria->add(ClienteTableMap::COL_TELEFONE, $this->telefone);
        }
        if ($this->isColumnModified(ClienteTableMap::COL_STATUS)) {
            $criteria->add(ClienteTableMap::COL_STATUS, $this->status);
        }
        if ($this->isColumnModified(ClienteTableMap::COL_DH_INCLUSAO)) {
            $criteria->add(ClienteTableMap::COL_DH_INCLUSAO, $this->dh_inclusao);
        }
        if ($this->isColumnModified(ClienteTableMap::COL_DH_ALTERACAO)) {
            $criteria->add(ClienteTableMap::COL_DH_ALTERACAO, $this->dh_alteracao);
        }
        if ($this->isColumnModified(ClienteTableMap::COL_USER_ID_INCLUSAO)) {
            $criteria->add(ClienteTableMap::COL_USER_ID_INCLUSAO, $this->user_id_inclusao);
        }
        if ($this->isColumnModified(ClienteTableMap::COL_USER_ID_ALTERACAO)) {
            $criteria->add(ClienteTableMap::COL_USER_ID_ALTERACAO, $this->user_id_alteracao);
        }

        return $criteria;
    }

    /**
     * Builds a Criteria object containing the primary key for this object.
     *
     * Unlike buildCriteria() this method includes the primary key values regardless
     * of whether or not they have been modified.
     *
     * @throws LogicException if no primary key is defined
     *
     * @return Criteria The Criteria object containing value(s) for primary key(s).
     */
    public function buildPkeyCriteria()
    {
        $criteria = ChildClienteQuery::create();
        $criteria->add(ClienteTableMap::COL_ID, $this->id);

        return $criteria;
    }

    /**
     * If the primary key is not null, return the hashcode of the
     * primary key. Otherwise, return the hash code of the object.
     *
     * @return int Hashcode
     */
    public function hashCode()
    {
        $validPk = null !== $this->getId();

        $validPrimaryKeyFKs = 0;
        $primaryKeyFKs = [];

        if ($validPk) {
            return crc32(json_encode($this->getPrimaryKey(), JSON_UNESCAPED_UNICODE));
        } elseif ($validPrimaryKeyFKs) {
            return crc32(json_encode($primaryKeyFKs, JSON_UNESCAPED_UNICODE));
        }

        return spl_object_hash($this);
    }
        
    /**
     * Returns the primary key for this object (row).
     * @return int
     */
    public function getPrimaryKey()
    {
        return $this->getId();
    }

    /**
     * Generic method to set the primary key (id column).
     *
     * @param       int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {
        return null === $this->getId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of \Table\Model\Cliente (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setRazaoSocial($this->getRazaoSocial());
        $copyObj->setContato($this->getContato());
        $copyObj->setEmail($this->getEmail());
        $copyObj->setDocumento($this->getDocumento());
        $copyObj->setTipoPessoa($this->getTipoPessoa());
        $copyObj->setCep($this->getCep());
        $copyObj->setEndereco($this->getEndereco());
        $copyObj->setNumero($this->getNumero());
        $copyObj->setComplemento($this->getComplemento());
        $copyObj->setBairro($this->getBairro());
        $copyObj->setCidade($this->getCidade());
        $copyObj->setUf($this->getUf());
        $copyObj->setTelefone($this->getTelefone());
        $copyObj->setStatus($this->getStatus());
        $copyObj->setDhInclusao($this->getDhInclusao());
        $copyObj->setDhAlteracao($this->getDhAlteracao());
        $copyObj->setUserIdInclusao($this->getUserIdInclusao());
        $copyObj->setUserIdAlteracao($this->getUserIdAlteracao());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getOrcamentos() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addOrcamento($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setId(NULL); // this is a auto-increment column, so set to default value
        }
    }

    /**
     * Makes a copy of this object that will be inserted as a new row in table when saved.
     * It creates a new object filling in the simple attributes, but skipping any primary
     * keys that are defined for the table.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param  boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @return \Table\Model\Cliente Clone of current object.
     * @throws PropelException
     */
    public function copy($deepCopy = false)
    {
        // we use get_class(), because this might be a subclass
        $clazz = get_class($this);
        $copyObj = new $clazz();
        $this->copyInto($copyObj, $deepCopy);

        return $copyObj;
    }

    /**
     * Declares an association between this object and a ChildUser object.
     *
     * @param  ChildUser $v
     * @return $this|\Table\Model\Cliente The current object (for fluent API support)
     * @throws PropelException
     */
    public function setUserRelatedByUserIdInclusao(ChildUser $v = null)
    {
        if ($v === null) {
            $this->setUserIdInclusao(NULL);
        } else {
            $this->setUserIdInclusao($v->getId());
        }

        $this->aUserRelatedByUserIdInclusao = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildUser object, it will not be re-added.
        if ($v !== null) {
            $v->addClienteRelatedByUserIdInclusao($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildUser object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildUser The associated ChildUser object.
     * @throws PropelException
     */
    public function getUserRelatedByUserIdInclusao(ConnectionInterface $con = null)
    {
        if ($this->aUserRelatedByUserIdInclusao === null && ($this->user_id_inclusao !== null)) {
            $this->aUserRelatedByUserIdInclusao = ChildUserQuery::create()->findPk($this->user_id_inclusao, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aUserRelatedByUserIdInclusao->addClientesRelatedByUserIdInclusao($this);
             */
        }

        return $this->aUserRelatedByUserIdInclusao;
    }

    /**
     * Declares an association between this object and a ChildUser object.
     *
     * @param  ChildUser $v
     * @return $this|\Table\Model\Cliente The current object (for fluent API support)
     * @throws PropelException
     */
    public function setUserRelatedByUserIdAlteracao(ChildUser $v = null)
    {
        if ($v === null) {
            $this->setUserIdAlteracao(NULL);
        } else {
            $this->setUserIdAlteracao($v->getId());
        }

        $this->aUserRelatedByUserIdAlteracao = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildUser object, it will not be re-added.
        if ($v !== null) {
            $v->addClienteRelatedByUserIdAlteracao($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildUser object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildUser The associated ChildUser object.
     * @throws PropelException
     */
    public function getUserRelatedByUserIdAlteracao(ConnectionInterface $con = null)
    {
        if ($this->aUserRelatedByUserIdAlteracao === null && ($this->user_id_alteracao !== null)) {
            $this->aUserRelatedByUserIdAlteracao = ChildUserQuery::create()->findPk($this->user_id_alteracao, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aUserRelatedByUserIdAlteracao->addClientesRelatedByUserIdAlteracao($this);
             */
        }

        return $this->aUserRelatedByUserIdAlteracao;
    }


    /**
     * Initializes a collection based on the name of a relation.
     * Avoids crafting an 'init[$relationName]s' method name
     * that wouldn't work when StandardEnglishPluralizer is used.
     *
     * @param      string $relationName The name of the relation to initialize
     * @return void
     */
    public function initRelation($relationName)
    {
        if ('Orcamento' == $relationName) {
            return $this->initOrcamentos();
        }
    }

    /**
     * Clears out the collOrcamentos collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addOrcamentos()
     */
    public function clearOrcamentos()
    {
        $this->collOrcamentos = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collOrcamentos collection loaded partially.
     */
    public function resetPartialOrcamentos($v = true)
    {
        $this->collOrcamentosPartial = $v;
    }

    /**
     * Initializes the collOrcamentos collection.
     *
     * By default this just sets the collOrcamentos collection to an empty array (like clearcollOrcamentos());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initOrcamentos($overrideExisting = true)
    {
        if (null !== $this->collOrcamentos && !$overrideExisting) {
            return;
        }
        $this->collOrcamentos = new ObjectCollection();
        $this->collOrcamentos->setModel('\Table\Model\Orcamento');
    }

    /**
     * Gets an array of ChildOrcamento objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildCliente is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildOrcamento[] List of ChildOrcamento objects
     * @throws PropelException
     */
    public function getOrcamentos(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collOrcamentosPartial && !$this->isNew();
        if (null === $this->collOrcamentos || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collOrcamentos) {
                // return empty collection
                $this->initOrcamentos();
            } else {
                $collOrcamentos = ChildOrcamentoQuery::create(null, $criteria)
                    ->filterByCliente($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collOrcamentosPartial && count($collOrcamentos)) {
                        $this->initOrcamentos(false);

                        foreach ($collOrcamentos as $obj) {
                            if (false == $this->collOrcamentos->contains($obj)) {
                                $this->collOrcamentos->append($obj);
                            }
                        }

                        $this->collOrcamentosPartial = true;
                    }

                    return $collOrcamentos;
                }

                if ($partial && $this->collOrcamentos) {
                    foreach ($this->collOrcamentos as $obj) {
                        if ($obj->isNew()) {
                            $collOrcamentos[] = $obj;
                        }
                    }
                }

                $this->collOrcamentos = $collOrcamentos;
                $this->collOrcamentosPartial = false;
            }
        }

        return $this->collOrcamentos;
    }

    /**
     * Sets a collection of ChildOrcamento objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $orcamentos A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildCliente The current object (for fluent API support)
     */
    public function setOrcamentos(Collection $orcamentos, ConnectionInterface $con = null)
    {
        /** @var ChildOrcamento[] $orcamentosToDelete */
        $orcamentosToDelete = $this->getOrcamentos(new Criteria(), $con)->diff($orcamentos);

        
        $this->orcamentosScheduledForDeletion = $orcamentosToDelete;

        foreach ($orcamentosToDelete as $orcamentoRemoved) {
            $orcamentoRemoved->setCliente(null);
        }

        $this->collOrcamentos = null;
        foreach ($orcamentos as $orcamento) {
            $this->addOrcamento($orcamento);
        }

        $this->collOrcamentos = $orcamentos;
        $this->collOrcamentosPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Orcamento objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Orcamento objects.
     * @throws PropelException
     */
    public function countOrcamentos(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collOrcamentosPartial && !$this->isNew();
        if (null === $this->collOrcamentos || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collOrcamentos) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getOrcamentos());
            }

            $query = ChildOrcamentoQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByCliente($this)
                ->count($con);
        }

        return count($this->collOrcamentos);
    }

    /**
     * Method called to associate a ChildOrcamento object to this object
     * through the ChildOrcamento foreign key attribute.
     *
     * @param  ChildOrcamento $l ChildOrcamento
     * @return $this|\Table\Model\Cliente The current object (for fluent API support)
     */
    public function addOrcamento(ChildOrcamento $l)
    {
        if ($this->collOrcamentos === null) {
            $this->initOrcamentos();
            $this->collOrcamentosPartial = true;
        }

        if (!$this->collOrcamentos->contains($l)) {
            $this->doAddOrcamento($l);
        }

        return $this;
    }

    /**
     * @param ChildOrcamento $orcamento The ChildOrcamento object to add.
     */
    protected function doAddOrcamento(ChildOrcamento $orcamento)
    {
        $this->collOrcamentos[]= $orcamento;
        $orcamento->setCliente($this);
    }

    /**
     * @param  ChildOrcamento $orcamento The ChildOrcamento object to remove.
     * @return $this|ChildCliente The current object (for fluent API support)
     */
    public function removeOrcamento(ChildOrcamento $orcamento)
    {
        if ($this->getOrcamentos()->contains($orcamento)) {
            $pos = $this->collOrcamentos->search($orcamento);
            $this->collOrcamentos->remove($pos);
            if (null === $this->orcamentosScheduledForDeletion) {
                $this->orcamentosScheduledForDeletion = clone $this->collOrcamentos;
                $this->orcamentosScheduledForDeletion->clear();
            }
            $this->orcamentosScheduledForDeletion[]= $orcamento;
            $orcamento->setCliente(null);
        }

        return $this;
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        if (null !== $this->aUserRelatedByUserIdInclusao) {
            $this->aUserRelatedByUserIdInclusao->removeClienteRelatedByUserIdInclusao($this);
        }
        if (null !== $this->aUserRelatedByUserIdAlteracao) {
            $this->aUserRelatedByUserIdAlteracao->removeClienteRelatedByUserIdAlteracao($this);
        }
        $this->id = null;
        $this->razao_social = null;
        $this->contato = null;
        $this->email = null;
        $this->documento = null;
        $this->tipo_pessoa = null;
        $this->cep = null;
        $this->endereco = null;
        $this->numero = null;
        $this->complemento = null;
        $this->bairro = null;
        $this->cidade = null;
        $this->uf = null;
        $this->telefone = null;
        $this->status = null;
        $this->dh_inclusao = null;
        $this->dh_alteracao = null;
        $this->user_id_inclusao = null;
        $this->user_id_alteracao = null;
        $this->alreadyInSave = false;
        $this->clearAllReferences();
        $this->resetModified();
        $this->setNew(true);
        $this->setDeleted(false);
    }

    /**
     * Resets all references and back-references to other model objects or collections of model objects.
     *
     * This method is used to reset all php object references (not the actual reference in the database).
     * Necessary for object serialisation.
     *
     * @param      boolean $deep Whether to also clear the references on all referrer objects.
     */
    public function clearAllReferences($deep = false)
    {
        if ($deep) {
            if ($this->collOrcamentos) {
                foreach ($this->collOrcamentos as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collOrcamentos = null;
        $this->aUserRelatedByUserIdInclusao = null;
        $this->aUserRelatedByUserIdAlteracao = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(ClienteTableMap::DEFAULT_STRING_FORMAT);
    }

    /**
     * Code to be run before persisting the object
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preSave(ConnectionInterface $con = null)
    {
        return true;
    }

    /**
     * Code to be run after persisting the object
     * @param ConnectionInterface $con
     */
    public function postSave(ConnectionInterface $con = null)
    {

    }

    /**
     * Code to be run before inserting to database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preInsert(ConnectionInterface $con = null)
    {
        return true;
    }

    /**
     * Code to be run after inserting to database
     * @param ConnectionInterface $con
     */
    public function postInsert(ConnectionInterface $con = null)
    {

    }

    /**
     * Code to be run before updating the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preUpdate(ConnectionInterface $con = null)
    {
        return true;
    }

    /**
     * Code to be run after updating the object in database
     * @param ConnectionInterface $con
     */
    public function postUpdate(ConnectionInterface $con = null)
    {

    }

    /**
     * Code to be run before deleting the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preDelete(ConnectionInterface $con = null)
    {
        return true;
    }

    /**
     * Code to be run after deleting the object in database
     * @param ConnectionInterface $con
     */
    public function postDelete(ConnectionInterface $con = null)
    {

    }


    /**
     * Derived method to catches calls to undefined methods.
     *
     * Provides magic import/export method support (fromXML()/toXML(), fromYAML()/toYAML(), etc.).
     * Allows to define default __call() behavior if you overwrite __call()
     *
     * @param string $name
     * @param mixed  $params
     *
     * @return array|string
     */
    public function __call($name, $params)
    {
        if (0 === strpos($name, 'get')) {
            $virtualColumn = substr($name, 3);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }

            $virtualColumn = lcfirst($virtualColumn);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }
        }

        if (0 === strpos($name, 'from')) {
            $format = substr($name, 4);

            return $this->importFrom($format, reset($params));
        }

        if (0 === strpos($name, 'to')) {
            $format = substr($name, 2);
            $includeLazyLoadColumns = isset($params[0]) ? $params[0] : true;

            return $this->exportTo($format, $includeLazyLoadColumns);
        }

        throw new BadMethodCallException(sprintf('Call to undefined method: %s.', $name));
    }

}
