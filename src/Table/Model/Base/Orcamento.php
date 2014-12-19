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
use Table\Model\OrcamentoItem as ChildOrcamentoItem;
use Table\Model\OrcamentoItemQuery as ChildOrcamentoItemQuery;
use Table\Model\OrcamentoQuery as ChildOrcamentoQuery;
use Table\Model\Map\OrcamentoTableMap;

/**
 * Base class that represents a row from the 'orcamento' table.
 *
 * 
 *
* @package    propel.generator.Table.Model.Base
*/
abstract class Orcamento implements ActiveRecordInterface 
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\Table\\Model\\Map\\OrcamentoTableMap';


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
     * The value for the cliente_id field.
     * @var        int
     */
    protected $cliente_id;

    /**
     * The value for the email field.
     * @var        string
     */
    protected $email;

    /**
     * The value for the empresa field.
     * @var        string
     */
    protected $empresa;

    /**
     * The value for the contato field.
     * @var        string
     */
    protected $contato;

    /**
     * The value for the telefone field.
     * @var        string
     */
    protected $telefone;

    /**
     * The value for the data field.
     * @var        \DateTime
     */
    protected $data;

    /**
     * The value for the data_inicio field.
     * @var        \DateTime
     */
    protected $data_inicio;

    /**
     * The value for the data_fim field.
     * @var        \DateTime
     */
    protected $data_fim;

    /**
     * The value for the prazo field.
     * @var        int
     */
    protected $prazo;

    /**
     * The value for the carimbo_preco field.
     * @var        int
     */
    protected $carimbo_preco;

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
     * @var        ChildCliente
     */
    protected $aCliente;

    /**
     * @var        ObjectCollection|ChildOrcamentoItem[] Collection to store aggregation of ChildOrcamentoItem objects.
     */
    protected $collOrcamentoItems;
    protected $collOrcamentoItemsPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildOrcamentoItem[]
     */
    protected $orcamentoItemsScheduledForDeletion = null;

    /**
     * Initializes internal state of Table\Model\Base\Orcamento object.
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
     * Compares this with another <code>Orcamento</code> instance.  If
     * <code>obj</code> is an instance of <code>Orcamento</code>, delegates to
     * <code>equals(Orcamento)</code>.  Otherwise, returns <code>false</code>.
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
     * @return $this|Orcamento The current object, for fluid interface
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
     * Get the [cliente_id] column value.
     * 
     * @return int
     */
    public function getClienteId()
    {
        return $this->cliente_id;
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
     * Get the [empresa] column value.
     * 
     * @return string
     */
    public function getEmpresa()
    {
        return $this->empresa;
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
     * Get the [telefone] column value.
     * 
     * @return string
     */
    public function getTelefone()
    {
        return $this->telefone;
    }

    /**
     * Get the [optionally formatted] temporal [data] column value.
     * 
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getData($format = NULL)
    {
        if ($format === null) {
            return $this->data;
        } else {
            return $this->data instanceof \DateTime ? $this->data->format($format) : null;
        }
    }

    /**
     * Get the [optionally formatted] temporal [data_inicio] column value.
     * 
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getDataInicio($format = NULL)
    {
        if ($format === null) {
            return $this->data_inicio;
        } else {
            return $this->data_inicio instanceof \DateTime ? $this->data_inicio->format($format) : null;
        }
    }

    /**
     * Get the [optionally formatted] temporal [data_fim] column value.
     * 
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getDataFim($format = NULL)
    {
        if ($format === null) {
            return $this->data_fim;
        } else {
            return $this->data_fim instanceof \DateTime ? $this->data_fim->format($format) : null;
        }
    }

    /**
     * Get the [prazo] column value.
     * 
     * @return int
     */
    public function getPrazo()
    {
        return $this->prazo;
    }

    /**
     * Get the [carimbo_preco] column value.
     * 
     * @return int
     */
    public function getCarimboPreco()
    {
        return $this->carimbo_preco;
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
     * @return $this|\Table\Model\Orcamento The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[OrcamentoTableMap::COL_ID] = true;
        }

        return $this;
    } // setId()

    /**
     * Set the value of [cliente_id] column.
     * 
     * @param  int $v new value
     * @return $this|\Table\Model\Orcamento The current object (for fluent API support)
     */
    public function setClienteId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->cliente_id !== $v) {
            $this->cliente_id = $v;
            $this->modifiedColumns[OrcamentoTableMap::COL_CLIENTE_ID] = true;
        }

        if ($this->aCliente !== null && $this->aCliente->getId() !== $v) {
            $this->aCliente = null;
        }

        return $this;
    } // setClienteId()

    /**
     * Set the value of [email] column.
     * 
     * @param  string $v new value
     * @return $this|\Table\Model\Orcamento The current object (for fluent API support)
     */
    public function setEmail($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->email !== $v) {
            $this->email = $v;
            $this->modifiedColumns[OrcamentoTableMap::COL_EMAIL] = true;
        }

        return $this;
    } // setEmail()

    /**
     * Set the value of [empresa] column.
     * 
     * @param  string $v new value
     * @return $this|\Table\Model\Orcamento The current object (for fluent API support)
     */
    public function setEmpresa($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->empresa !== $v) {
            $this->empresa = $v;
            $this->modifiedColumns[OrcamentoTableMap::COL_EMPRESA] = true;
        }

        return $this;
    } // setEmpresa()

    /**
     * Set the value of [contato] column.
     * 
     * @param  string $v new value
     * @return $this|\Table\Model\Orcamento The current object (for fluent API support)
     */
    public function setContato($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->contato !== $v) {
            $this->contato = $v;
            $this->modifiedColumns[OrcamentoTableMap::COL_CONTATO] = true;
        }

        return $this;
    } // setContato()

    /**
     * Set the value of [telefone] column.
     * 
     * @param  string $v new value
     * @return $this|\Table\Model\Orcamento The current object (for fluent API support)
     */
    public function setTelefone($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->telefone !== $v) {
            $this->telefone = $v;
            $this->modifiedColumns[OrcamentoTableMap::COL_TELEFONE] = true;
        }

        return $this;
    } // setTelefone()

    /**
     * Sets the value of [data] column to a normalized version of the date/time value specified.
     * 
     * @param  mixed $v string, integer (timestamp), or \DateTime value.
     *               Empty strings are treated as NULL.
     * @return $this|\Table\Model\Orcamento The current object (for fluent API support)
     */
    public function setData($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->data !== null || $dt !== null) {
            if ($dt !== $this->data) {
                $this->data = $dt;
                $this->modifiedColumns[OrcamentoTableMap::COL_DATA] = true;
            }
        } // if either are not null

        return $this;
    } // setData()

    /**
     * Sets the value of [data_inicio] column to a normalized version of the date/time value specified.
     * 
     * @param  mixed $v string, integer (timestamp), or \DateTime value.
     *               Empty strings are treated as NULL.
     * @return $this|\Table\Model\Orcamento The current object (for fluent API support)
     */
    public function setDataInicio($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->data_inicio !== null || $dt !== null) {
            if ($dt !== $this->data_inicio) {
                $this->data_inicio = $dt;
                $this->modifiedColumns[OrcamentoTableMap::COL_DATA_INICIO] = true;
            }
        } // if either are not null

        return $this;
    } // setDataInicio()

    /**
     * Sets the value of [data_fim] column to a normalized version of the date/time value specified.
     * 
     * @param  mixed $v string, integer (timestamp), or \DateTime value.
     *               Empty strings are treated as NULL.
     * @return $this|\Table\Model\Orcamento The current object (for fluent API support)
     */
    public function setDataFim($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->data_fim !== null || $dt !== null) {
            if ($dt !== $this->data_fim) {
                $this->data_fim = $dt;
                $this->modifiedColumns[OrcamentoTableMap::COL_DATA_FIM] = true;
            }
        } // if either are not null

        return $this;
    } // setDataFim()

    /**
     * Set the value of [prazo] column.
     * 
     * @param  int $v new value
     * @return $this|\Table\Model\Orcamento The current object (for fluent API support)
     */
    public function setPrazo($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->prazo !== $v) {
            $this->prazo = $v;
            $this->modifiedColumns[OrcamentoTableMap::COL_PRAZO] = true;
        }

        return $this;
    } // setPrazo()

    /**
     * Set the value of [carimbo_preco] column.
     * 
     * @param  int $v new value
     * @return $this|\Table\Model\Orcamento The current object (for fluent API support)
     */
    public function setCarimboPreco($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->carimbo_preco !== $v) {
            $this->carimbo_preco = $v;
            $this->modifiedColumns[OrcamentoTableMap::COL_CARIMBO_PRECO] = true;
        }

        return $this;
    } // setCarimboPreco()

    /**
     * Set the value of [status] column.
     * 
     * @param  int $v new value
     * @return $this|\Table\Model\Orcamento The current object (for fluent API support)
     */
    public function setStatus($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->status !== $v) {
            $this->status = $v;
            $this->modifiedColumns[OrcamentoTableMap::COL_STATUS] = true;
        }

        return $this;
    } // setStatus()

    /**
     * Sets the value of [dh_inclusao] column to a normalized version of the date/time value specified.
     * 
     * @param  mixed $v string, integer (timestamp), or \DateTime value.
     *               Empty strings are treated as NULL.
     * @return $this|\Table\Model\Orcamento The current object (for fluent API support)
     */
    public function setDhInclusao($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->dh_inclusao !== null || $dt !== null) {
            if ($dt !== $this->dh_inclusao) {
                $this->dh_inclusao = $dt;
                $this->modifiedColumns[OrcamentoTableMap::COL_DH_INCLUSAO] = true;
            }
        } // if either are not null

        return $this;
    } // setDhInclusao()

    /**
     * Sets the value of [dh_alteracao] column to a normalized version of the date/time value specified.
     * 
     * @param  mixed $v string, integer (timestamp), or \DateTime value.
     *               Empty strings are treated as NULL.
     * @return $this|\Table\Model\Orcamento The current object (for fluent API support)
     */
    public function setDhAlteracao($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->dh_alteracao !== null || $dt !== null) {
            if ($dt !== $this->dh_alteracao) {
                $this->dh_alteracao = $dt;
                $this->modifiedColumns[OrcamentoTableMap::COL_DH_ALTERACAO] = true;
            }
        } // if either are not null

        return $this;
    } // setDhAlteracao()

    /**
     * Set the value of [user_id_inclusao] column.
     * 
     * @param  int $v new value
     * @return $this|\Table\Model\Orcamento The current object (for fluent API support)
     */
    public function setUserIdInclusao($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->user_id_inclusao !== $v) {
            $this->user_id_inclusao = $v;
            $this->modifiedColumns[OrcamentoTableMap::COL_USER_ID_INCLUSAO] = true;
        }

        return $this;
    } // setUserIdInclusao()

    /**
     * Set the value of [user_id_alteracao] column.
     * 
     * @param  int $v new value
     * @return $this|\Table\Model\Orcamento The current object (for fluent API support)
     */
    public function setUserIdAlteracao($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->user_id_alteracao !== $v) {
            $this->user_id_alteracao = $v;
            $this->modifiedColumns[OrcamentoTableMap::COL_USER_ID_ALTERACAO] = true;
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : OrcamentoTableMap::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : OrcamentoTableMap::translateFieldName('ClienteId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->cliente_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : OrcamentoTableMap::translateFieldName('Email', TableMap::TYPE_PHPNAME, $indexType)];
            $this->email = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : OrcamentoTableMap::translateFieldName('Empresa', TableMap::TYPE_PHPNAME, $indexType)];
            $this->empresa = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : OrcamentoTableMap::translateFieldName('Contato', TableMap::TYPE_PHPNAME, $indexType)];
            $this->contato = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : OrcamentoTableMap::translateFieldName('Telefone', TableMap::TYPE_PHPNAME, $indexType)];
            $this->telefone = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : OrcamentoTableMap::translateFieldName('Data', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00') {
                $col = null;
            }
            $this->data = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : OrcamentoTableMap::translateFieldName('DataInicio', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00') {
                $col = null;
            }
            $this->data_inicio = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : OrcamentoTableMap::translateFieldName('DataFim', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00') {
                $col = null;
            }
            $this->data_fim = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : OrcamentoTableMap::translateFieldName('Prazo', TableMap::TYPE_PHPNAME, $indexType)];
            $this->prazo = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : OrcamentoTableMap::translateFieldName('CarimboPreco', TableMap::TYPE_PHPNAME, $indexType)];
            $this->carimbo_preco = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : OrcamentoTableMap::translateFieldName('Status', TableMap::TYPE_PHPNAME, $indexType)];
            $this->status = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : OrcamentoTableMap::translateFieldName('DhInclusao', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->dh_inclusao = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 13 + $startcol : OrcamentoTableMap::translateFieldName('DhAlteracao', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->dh_alteracao = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 14 + $startcol : OrcamentoTableMap::translateFieldName('UserIdInclusao', TableMap::TYPE_PHPNAME, $indexType)];
            $this->user_id_inclusao = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 15 + $startcol : OrcamentoTableMap::translateFieldName('UserIdAlteracao', TableMap::TYPE_PHPNAME, $indexType)];
            $this->user_id_alteracao = (null !== $col) ? (int) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 16; // 16 = OrcamentoTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Table\\Model\\Orcamento'), 0, $e);
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
        if ($this->aCliente !== null && $this->cliente_id !== $this->aCliente->getId()) {
            $this->aCliente = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(OrcamentoTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildOrcamentoQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aCliente = null;
            $this->collOrcamentoItems = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see Orcamento::setDeleted()
     * @see Orcamento::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(OrcamentoTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildOrcamentoQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(OrcamentoTableMap::DATABASE_NAME);
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
                OrcamentoTableMap::addInstanceToPool($this);
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

            if ($this->aCliente !== null) {
                if ($this->aCliente->isModified() || $this->aCliente->isNew()) {
                    $affectedRows += $this->aCliente->save($con);
                }
                $this->setCliente($this->aCliente);
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

            if ($this->orcamentoItemsScheduledForDeletion !== null) {
                if (!$this->orcamentoItemsScheduledForDeletion->isEmpty()) {
                    \Table\Model\OrcamentoItemQuery::create()
                        ->filterByPrimaryKeys($this->orcamentoItemsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->orcamentoItemsScheduledForDeletion = null;
                }
            }

            if ($this->collOrcamentoItems !== null) {
                foreach ($this->collOrcamentoItems as $referrerFK) {
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

        $this->modifiedColumns[OrcamentoTableMap::COL_ID] = true;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . OrcamentoTableMap::COL_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(OrcamentoTableMap::COL_ID)) {
            $modifiedColumns[':p' . $index++]  = 'id';
        }
        if ($this->isColumnModified(OrcamentoTableMap::COL_CLIENTE_ID)) {
            $modifiedColumns[':p' . $index++]  = 'cliente_id';
        }
        if ($this->isColumnModified(OrcamentoTableMap::COL_EMAIL)) {
            $modifiedColumns[':p' . $index++]  = 'email';
        }
        if ($this->isColumnModified(OrcamentoTableMap::COL_EMPRESA)) {
            $modifiedColumns[':p' . $index++]  = 'empresa';
        }
        if ($this->isColumnModified(OrcamentoTableMap::COL_CONTATO)) {
            $modifiedColumns[':p' . $index++]  = 'contato';
        }
        if ($this->isColumnModified(OrcamentoTableMap::COL_TELEFONE)) {
            $modifiedColumns[':p' . $index++]  = 'telefone';
        }
        if ($this->isColumnModified(OrcamentoTableMap::COL_DATA)) {
            $modifiedColumns[':p' . $index++]  = 'data';
        }
        if ($this->isColumnModified(OrcamentoTableMap::COL_DATA_INICIO)) {
            $modifiedColumns[':p' . $index++]  = 'data_inicio';
        }
        if ($this->isColumnModified(OrcamentoTableMap::COL_DATA_FIM)) {
            $modifiedColumns[':p' . $index++]  = 'data_fim';
        }
        if ($this->isColumnModified(OrcamentoTableMap::COL_PRAZO)) {
            $modifiedColumns[':p' . $index++]  = 'prazo';
        }
        if ($this->isColumnModified(OrcamentoTableMap::COL_CARIMBO_PRECO)) {
            $modifiedColumns[':p' . $index++]  = 'carimbo_preco';
        }
        if ($this->isColumnModified(OrcamentoTableMap::COL_STATUS)) {
            $modifiedColumns[':p' . $index++]  = 'status';
        }
        if ($this->isColumnModified(OrcamentoTableMap::COL_DH_INCLUSAO)) {
            $modifiedColumns[':p' . $index++]  = 'dh_inclusao';
        }
        if ($this->isColumnModified(OrcamentoTableMap::COL_DH_ALTERACAO)) {
            $modifiedColumns[':p' . $index++]  = 'dh_alteracao';
        }
        if ($this->isColumnModified(OrcamentoTableMap::COL_USER_ID_INCLUSAO)) {
            $modifiedColumns[':p' . $index++]  = 'user_id_inclusao';
        }
        if ($this->isColumnModified(OrcamentoTableMap::COL_USER_ID_ALTERACAO)) {
            $modifiedColumns[':p' . $index++]  = 'user_id_alteracao';
        }

        $sql = sprintf(
            'INSERT INTO orcamento (%s) VALUES (%s)',
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
                    case 'cliente_id':                        
                        $stmt->bindValue($identifier, $this->cliente_id, PDO::PARAM_INT);
                        break;
                    case 'email':                        
                        $stmt->bindValue($identifier, $this->email, PDO::PARAM_STR);
                        break;
                    case 'empresa':                        
                        $stmt->bindValue($identifier, $this->empresa, PDO::PARAM_STR);
                        break;
                    case 'contato':                        
                        $stmt->bindValue($identifier, $this->contato, PDO::PARAM_STR);
                        break;
                    case 'telefone':                        
                        $stmt->bindValue($identifier, $this->telefone, PDO::PARAM_STR);
                        break;
                    case 'data':                        
                        $stmt->bindValue($identifier, $this->data ? $this->data->format("Y-m-d H:i:s") : null, PDO::PARAM_STR);
                        break;
                    case 'data_inicio':                        
                        $stmt->bindValue($identifier, $this->data_inicio ? $this->data_inicio->format("Y-m-d H:i:s") : null, PDO::PARAM_STR);
                        break;
                    case 'data_fim':                        
                        $stmt->bindValue($identifier, $this->data_fim ? $this->data_fim->format("Y-m-d H:i:s") : null, PDO::PARAM_STR);
                        break;
                    case 'prazo':                        
                        $stmt->bindValue($identifier, $this->prazo, PDO::PARAM_INT);
                        break;
                    case 'carimbo_preco':                        
                        $stmt->bindValue($identifier, $this->carimbo_preco, PDO::PARAM_INT);
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
        $pos = OrcamentoTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getClienteId();
                break;
            case 2:
                return $this->getEmail();
                break;
            case 3:
                return $this->getEmpresa();
                break;
            case 4:
                return $this->getContato();
                break;
            case 5:
                return $this->getTelefone();
                break;
            case 6:
                return $this->getData();
                break;
            case 7:
                return $this->getDataInicio();
                break;
            case 8:
                return $this->getDataFim();
                break;
            case 9:
                return $this->getPrazo();
                break;
            case 10:
                return $this->getCarimboPreco();
                break;
            case 11:
                return $this->getStatus();
                break;
            case 12:
                return $this->getDhInclusao();
                break;
            case 13:
                return $this->getDhAlteracao();
                break;
            case 14:
                return $this->getUserIdInclusao();
                break;
            case 15:
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

        if (isset($alreadyDumpedObjects['Orcamento'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Orcamento'][$this->hashCode()] = true;
        $keys = OrcamentoTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getClienteId(),
            $keys[2] => $this->getEmail(),
            $keys[3] => $this->getEmpresa(),
            $keys[4] => $this->getContato(),
            $keys[5] => $this->getTelefone(),
            $keys[6] => $this->getData(),
            $keys[7] => $this->getDataInicio(),
            $keys[8] => $this->getDataFim(),
            $keys[9] => $this->getPrazo(),
            $keys[10] => $this->getCarimboPreco(),
            $keys[11] => $this->getStatus(),
            $keys[12] => $this->getDhInclusao(),
            $keys[13] => $this->getDhAlteracao(),
            $keys[14] => $this->getUserIdInclusao(),
            $keys[15] => $this->getUserIdAlteracao(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }
        
        if ($includeForeignObjects) {
            if (null !== $this->aCliente) {
                
                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'cliente';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'cliente';
                        break;
                    default:
                        $key = 'Cliente';
                }
        
                $result[$key] = $this->aCliente->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collOrcamentoItems) {
                
                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'orcamentoItems';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'orcamento_items';
                        break;
                    default:
                        $key = 'OrcamentoItems';
                }
        
                $result[$key] = $this->collOrcamentoItems->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
     * @return $this|\Table\Model\Orcamento
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = OrcamentoTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\Table\Model\Orcamento
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setId($value);
                break;
            case 1:
                $this->setClienteId($value);
                break;
            case 2:
                $this->setEmail($value);
                break;
            case 3:
                $this->setEmpresa($value);
                break;
            case 4:
                $this->setContato($value);
                break;
            case 5:
                $this->setTelefone($value);
                break;
            case 6:
                $this->setData($value);
                break;
            case 7:
                $this->setDataInicio($value);
                break;
            case 8:
                $this->setDataFim($value);
                break;
            case 9:
                $this->setPrazo($value);
                break;
            case 10:
                $this->setCarimboPreco($value);
                break;
            case 11:
                $this->setStatus($value);
                break;
            case 12:
                $this->setDhInclusao($value);
                break;
            case 13:
                $this->setDhAlteracao($value);
                break;
            case 14:
                $this->setUserIdInclusao($value);
                break;
            case 15:
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
        $keys = OrcamentoTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setClienteId($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setEmail($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setEmpresa($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setContato($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setTelefone($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setData($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setDataInicio($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setDataFim($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setPrazo($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setCarimboPreco($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setStatus($arr[$keys[11]]);
        }
        if (array_key_exists($keys[12], $arr)) {
            $this->setDhInclusao($arr[$keys[12]]);
        }
        if (array_key_exists($keys[13], $arr)) {
            $this->setDhAlteracao($arr[$keys[13]]);
        }
        if (array_key_exists($keys[14], $arr)) {
            $this->setUserIdInclusao($arr[$keys[14]]);
        }
        if (array_key_exists($keys[15], $arr)) {
            $this->setUserIdAlteracao($arr[$keys[15]]);
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
     * @return $this|\Table\Model\Orcamento The current object, for fluid interface
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
        $criteria = new Criteria(OrcamentoTableMap::DATABASE_NAME);

        if ($this->isColumnModified(OrcamentoTableMap::COL_ID)) {
            $criteria->add(OrcamentoTableMap::COL_ID, $this->id);
        }
        if ($this->isColumnModified(OrcamentoTableMap::COL_CLIENTE_ID)) {
            $criteria->add(OrcamentoTableMap::COL_CLIENTE_ID, $this->cliente_id);
        }
        if ($this->isColumnModified(OrcamentoTableMap::COL_EMAIL)) {
            $criteria->add(OrcamentoTableMap::COL_EMAIL, $this->email);
        }
        if ($this->isColumnModified(OrcamentoTableMap::COL_EMPRESA)) {
            $criteria->add(OrcamentoTableMap::COL_EMPRESA, $this->empresa);
        }
        if ($this->isColumnModified(OrcamentoTableMap::COL_CONTATO)) {
            $criteria->add(OrcamentoTableMap::COL_CONTATO, $this->contato);
        }
        if ($this->isColumnModified(OrcamentoTableMap::COL_TELEFONE)) {
            $criteria->add(OrcamentoTableMap::COL_TELEFONE, $this->telefone);
        }
        if ($this->isColumnModified(OrcamentoTableMap::COL_DATA)) {
            $criteria->add(OrcamentoTableMap::COL_DATA, $this->data);
        }
        if ($this->isColumnModified(OrcamentoTableMap::COL_DATA_INICIO)) {
            $criteria->add(OrcamentoTableMap::COL_DATA_INICIO, $this->data_inicio);
        }
        if ($this->isColumnModified(OrcamentoTableMap::COL_DATA_FIM)) {
            $criteria->add(OrcamentoTableMap::COL_DATA_FIM, $this->data_fim);
        }
        if ($this->isColumnModified(OrcamentoTableMap::COL_PRAZO)) {
            $criteria->add(OrcamentoTableMap::COL_PRAZO, $this->prazo);
        }
        if ($this->isColumnModified(OrcamentoTableMap::COL_CARIMBO_PRECO)) {
            $criteria->add(OrcamentoTableMap::COL_CARIMBO_PRECO, $this->carimbo_preco);
        }
        if ($this->isColumnModified(OrcamentoTableMap::COL_STATUS)) {
            $criteria->add(OrcamentoTableMap::COL_STATUS, $this->status);
        }
        if ($this->isColumnModified(OrcamentoTableMap::COL_DH_INCLUSAO)) {
            $criteria->add(OrcamentoTableMap::COL_DH_INCLUSAO, $this->dh_inclusao);
        }
        if ($this->isColumnModified(OrcamentoTableMap::COL_DH_ALTERACAO)) {
            $criteria->add(OrcamentoTableMap::COL_DH_ALTERACAO, $this->dh_alteracao);
        }
        if ($this->isColumnModified(OrcamentoTableMap::COL_USER_ID_INCLUSAO)) {
            $criteria->add(OrcamentoTableMap::COL_USER_ID_INCLUSAO, $this->user_id_inclusao);
        }
        if ($this->isColumnModified(OrcamentoTableMap::COL_USER_ID_ALTERACAO)) {
            $criteria->add(OrcamentoTableMap::COL_USER_ID_ALTERACAO, $this->user_id_alteracao);
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
        $criteria = ChildOrcamentoQuery::create();
        $criteria->add(OrcamentoTableMap::COL_ID, $this->id);

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
     * @param      object $copyObj An object of \Table\Model\Orcamento (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setClienteId($this->getClienteId());
        $copyObj->setEmail($this->getEmail());
        $copyObj->setEmpresa($this->getEmpresa());
        $copyObj->setContato($this->getContato());
        $copyObj->setTelefone($this->getTelefone());
        $copyObj->setData($this->getData());
        $copyObj->setDataInicio($this->getDataInicio());
        $copyObj->setDataFim($this->getDataFim());
        $copyObj->setPrazo($this->getPrazo());
        $copyObj->setCarimboPreco($this->getCarimboPreco());
        $copyObj->setStatus($this->getStatus());
        $copyObj->setDhInclusao($this->getDhInclusao());
        $copyObj->setDhAlteracao($this->getDhAlteracao());
        $copyObj->setUserIdInclusao($this->getUserIdInclusao());
        $copyObj->setUserIdAlteracao($this->getUserIdAlteracao());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getOrcamentoItems() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addOrcamentoItem($relObj->copy($deepCopy));
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
     * @return \Table\Model\Orcamento Clone of current object.
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
     * Declares an association between this object and a ChildCliente object.
     *
     * @param  ChildCliente $v
     * @return $this|\Table\Model\Orcamento The current object (for fluent API support)
     * @throws PropelException
     */
    public function setCliente(ChildCliente $v = null)
    {
        if ($v === null) {
            $this->setClienteId(NULL);
        } else {
            $this->setClienteId($v->getId());
        }

        $this->aCliente = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildCliente object, it will not be re-added.
        if ($v !== null) {
            $v->addOrcamento($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildCliente object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildCliente The associated ChildCliente object.
     * @throws PropelException
     */
    public function getCliente(ConnectionInterface $con = null)
    {
        if ($this->aCliente === null && ($this->cliente_id !== null)) {
            $this->aCliente = ChildClienteQuery::create()->findPk($this->cliente_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aCliente->addOrcamentos($this);
             */
        }

        return $this->aCliente;
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
        if ('OrcamentoItem' == $relationName) {
            return $this->initOrcamentoItems();
        }
    }

    /**
     * Clears out the collOrcamentoItems collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addOrcamentoItems()
     */
    public function clearOrcamentoItems()
    {
        $this->collOrcamentoItems = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collOrcamentoItems collection loaded partially.
     */
    public function resetPartialOrcamentoItems($v = true)
    {
        $this->collOrcamentoItemsPartial = $v;
    }

    /**
     * Initializes the collOrcamentoItems collection.
     *
     * By default this just sets the collOrcamentoItems collection to an empty array (like clearcollOrcamentoItems());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initOrcamentoItems($overrideExisting = true)
    {
        if (null !== $this->collOrcamentoItems && !$overrideExisting) {
            return;
        }
        $this->collOrcamentoItems = new ObjectCollection();
        $this->collOrcamentoItems->setModel('\Table\Model\OrcamentoItem');
    }

    /**
     * Gets an array of ChildOrcamentoItem objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildOrcamento is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildOrcamentoItem[] List of ChildOrcamentoItem objects
     * @throws PropelException
     */
    public function getOrcamentoItems(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collOrcamentoItemsPartial && !$this->isNew();
        if (null === $this->collOrcamentoItems || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collOrcamentoItems) {
                // return empty collection
                $this->initOrcamentoItems();
            } else {
                $collOrcamentoItems = ChildOrcamentoItemQuery::create(null, $criteria)
                    ->filterByOrcamento($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collOrcamentoItemsPartial && count($collOrcamentoItems)) {
                        $this->initOrcamentoItems(false);

                        foreach ($collOrcamentoItems as $obj) {
                            if (false == $this->collOrcamentoItems->contains($obj)) {
                                $this->collOrcamentoItems->append($obj);
                            }
                        }

                        $this->collOrcamentoItemsPartial = true;
                    }

                    return $collOrcamentoItems;
                }

                if ($partial && $this->collOrcamentoItems) {
                    foreach ($this->collOrcamentoItems as $obj) {
                        if ($obj->isNew()) {
                            $collOrcamentoItems[] = $obj;
                        }
                    }
                }

                $this->collOrcamentoItems = $collOrcamentoItems;
                $this->collOrcamentoItemsPartial = false;
            }
        }

        return $this->collOrcamentoItems;
    }

    /**
     * Sets a collection of ChildOrcamentoItem objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $orcamentoItems A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildOrcamento The current object (for fluent API support)
     */
    public function setOrcamentoItems(Collection $orcamentoItems, ConnectionInterface $con = null)
    {
        /** @var ChildOrcamentoItem[] $orcamentoItemsToDelete */
        $orcamentoItemsToDelete = $this->getOrcamentoItems(new Criteria(), $con)->diff($orcamentoItems);

        
        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->orcamentoItemsScheduledForDeletion = clone $orcamentoItemsToDelete;

        foreach ($orcamentoItemsToDelete as $orcamentoItemRemoved) {
            $orcamentoItemRemoved->setOrcamento(null);
        }

        $this->collOrcamentoItems = null;
        foreach ($orcamentoItems as $orcamentoItem) {
            $this->addOrcamentoItem($orcamentoItem);
        }

        $this->collOrcamentoItems = $orcamentoItems;
        $this->collOrcamentoItemsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related OrcamentoItem objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related OrcamentoItem objects.
     * @throws PropelException
     */
    public function countOrcamentoItems(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collOrcamentoItemsPartial && !$this->isNew();
        if (null === $this->collOrcamentoItems || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collOrcamentoItems) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getOrcamentoItems());
            }

            $query = ChildOrcamentoItemQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByOrcamento($this)
                ->count($con);
        }

        return count($this->collOrcamentoItems);
    }

    /**
     * Method called to associate a ChildOrcamentoItem object to this object
     * through the ChildOrcamentoItem foreign key attribute.
     *
     * @param  ChildOrcamentoItem $l ChildOrcamentoItem
     * @return $this|\Table\Model\Orcamento The current object (for fluent API support)
     */
    public function addOrcamentoItem(ChildOrcamentoItem $l)
    {
        if ($this->collOrcamentoItems === null) {
            $this->initOrcamentoItems();
            $this->collOrcamentoItemsPartial = true;
        }

        if (!$this->collOrcamentoItems->contains($l)) {
            $this->doAddOrcamentoItem($l);
        }

        return $this;
    }

    /**
     * @param ChildOrcamentoItem $orcamentoItem The ChildOrcamentoItem object to add.
     */
    protected function doAddOrcamentoItem(ChildOrcamentoItem $orcamentoItem)
    {
        $this->collOrcamentoItems[]= $orcamentoItem;
        $orcamentoItem->setOrcamento($this);
    }

    /**
     * @param  ChildOrcamentoItem $orcamentoItem The ChildOrcamentoItem object to remove.
     * @return $this|ChildOrcamento The current object (for fluent API support)
     */
    public function removeOrcamentoItem(ChildOrcamentoItem $orcamentoItem)
    {
        if ($this->getOrcamentoItems()->contains($orcamentoItem)) {
            $pos = $this->collOrcamentoItems->search($orcamentoItem);
            $this->collOrcamentoItems->remove($pos);
            if (null === $this->orcamentoItemsScheduledForDeletion) {
                $this->orcamentoItemsScheduledForDeletion = clone $this->collOrcamentoItems;
                $this->orcamentoItemsScheduledForDeletion->clear();
            }
            $this->orcamentoItemsScheduledForDeletion[]= clone $orcamentoItem;
            $orcamentoItem->setOrcamento(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Orcamento is new, it will return
     * an empty collection; or if this Orcamento has previously
     * been saved, it will retrieve related OrcamentoItems from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Orcamento.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOrcamentoItem[] List of ChildOrcamentoItem objects
     */
    public function getOrcamentoItemsJoinProduto(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOrcamentoItemQuery::create(null, $criteria);
        $query->joinWith('Produto', $joinBehavior);

        return $this->getOrcamentoItems($query, $con);
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        if (null !== $this->aCliente) {
            $this->aCliente->removeOrcamento($this);
        }
        $this->id = null;
        $this->cliente_id = null;
        $this->email = null;
        $this->empresa = null;
        $this->contato = null;
        $this->telefone = null;
        $this->data = null;
        $this->data_inicio = null;
        $this->data_fim = null;
        $this->prazo = null;
        $this->carimbo_preco = null;
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
            if ($this->collOrcamentoItems) {
                foreach ($this->collOrcamentoItems as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collOrcamentoItems = null;
        $this->aCliente = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(OrcamentoTableMap::DEFAULT_STRING_FORMAT);
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
