<?php

namespace Table\Model\Base;

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
use Table\Model\Autor as ChildAutor;
use Table\Model\AutorQuery as ChildAutorQuery;
use Table\Model\Page as ChildPage;
use Table\Model\PageQuery as ChildPageQuery;
use Table\Model\Post as ChildPost;
use Table\Model\PostQuery as ChildPostQuery;
use Table\Model\Map\AutorTableMap;

/**
 * Base class that represents a row from the 'autor' table.
 *
 * 
 *
* @package    propel.generator.Table.Model.Base
*/
abstract class Autor implements ActiveRecordInterface 
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\Table\\Model\\Map\\AutorTableMap';


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
     * The value for the nome field.
     * @var        string
     */
    protected $nome;

    /**
     * The value for the email field.
     * @var        string
     */
    protected $email;

    /**
     * The value for the usuario field.
     * @var        string
     */
    protected $usuario;

    /**
     * The value for the senha field.
     * @var        string
     */
    protected $senha;

    /**
     * The value for the salt field.
     * @var        string
     */
    protected $salt;

    /**
     * The value for the descricao field.
     * @var        string
     */
    protected $descricao;

    /**
     * The value for the dados field.
     * @var        string
     */
    protected $dados;

    /**
     * The value for the dh_inclusao field.
     * @var        string
     */
    protected $dh_inclusao;

    /**
     * The value for the dh_alteracao field.
     * @var        string
     */
    protected $dh_alteracao;

    /**
     * @var        ObjectCollection|ChildPage[] Collection to store aggregation of ChildPage objects.
     */
    protected $collPages;
    protected $collPagesPartial;

    /**
     * @var        ObjectCollection|ChildPost[] Collection to store aggregation of ChildPost objects.
     */
    protected $collPosts;
    protected $collPostsPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildPage[]
     */
    protected $pagesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildPost[]
     */
    protected $postsScheduledForDeletion = null;

    /**
     * Initializes internal state of Table\Model\Base\Autor object.
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
     * Compares this with another <code>Autor</code> instance.  If
     * <code>obj</code> is an instance of <code>Autor</code>, delegates to
     * <code>equals(Autor)</code>.  Otherwise, returns <code>false</code>.
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
     * @return $this|Autor The current object, for fluid interface
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
     * Get the [nome] column value.
     * 
     * @return string
     */
    public function getNome()
    {
        return $this->nome;
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
     * Get the [usuario] column value.
     * 
     * @return string
     */
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * Get the [senha] column value.
     * 
     * @return string
     */
    public function getSenha()
    {
        return $this->senha;
    }

    /**
     * Get the [salt] column value.
     * 
     * @return string
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * Get the [descricao] column value.
     * 
     * @return string
     */
    public function getDescricao()
    {
        return $this->descricao;
    }

    /**
     * Get the [dados] column value.
     * 
     * @return string
     */
    public function getDados()
    {
        return $this->dados;
    }

    /**
     * Get the [dh_inclusao] column value.
     * 
     * @return string
     */
    public function getDhInclusao()
    {
        return $this->dh_inclusao;
    }

    /**
     * Get the [dh_alteracao] column value.
     * 
     * @return string
     */
    public function getDhAlteracao()
    {
        return $this->dh_alteracao;
    }

    /**
     * Set the value of [id] column.
     * 
     * @param int $v new value
     * @return $this|\Table\Model\Autor The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[AutorTableMap::COL_ID] = true;
        }

        return $this;
    } // setId()

    /**
     * Set the value of [nome] column.
     * 
     * @param string $v new value
     * @return $this|\Table\Model\Autor The current object (for fluent API support)
     */
    public function setNome($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->nome !== $v) {
            $this->nome = $v;
            $this->modifiedColumns[AutorTableMap::COL_NOME] = true;
        }

        return $this;
    } // setNome()

    /**
     * Set the value of [email] column.
     * 
     * @param string $v new value
     * @return $this|\Table\Model\Autor The current object (for fluent API support)
     */
    public function setEmail($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->email !== $v) {
            $this->email = $v;
            $this->modifiedColumns[AutorTableMap::COL_EMAIL] = true;
        }

        return $this;
    } // setEmail()

    /**
     * Set the value of [usuario] column.
     * 
     * @param string $v new value
     * @return $this|\Table\Model\Autor The current object (for fluent API support)
     */
    public function setUsuario($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->usuario !== $v) {
            $this->usuario = $v;
            $this->modifiedColumns[AutorTableMap::COL_USUARIO] = true;
        }

        return $this;
    } // setUsuario()

    /**
     * Set the value of [senha] column.
     * 
     * @param string $v new value
     * @return $this|\Table\Model\Autor The current object (for fluent API support)
     */
    public function setSenha($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->senha !== $v) {
            $this->senha = $v;
            $this->modifiedColumns[AutorTableMap::COL_SENHA] = true;
        }

        return $this;
    } // setSenha()

    /**
     * Set the value of [salt] column.
     * 
     * @param string $v new value
     * @return $this|\Table\Model\Autor The current object (for fluent API support)
     */
    public function setSalt($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->salt !== $v) {
            $this->salt = $v;
            $this->modifiedColumns[AutorTableMap::COL_SALT] = true;
        }

        return $this;
    } // setSalt()

    /**
     * Set the value of [descricao] column.
     * 
     * @param string $v new value
     * @return $this|\Table\Model\Autor The current object (for fluent API support)
     */
    public function setDescricao($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->descricao !== $v) {
            $this->descricao = $v;
            $this->modifiedColumns[AutorTableMap::COL_DESCRICAO] = true;
        }

        return $this;
    } // setDescricao()

    /**
     * Set the value of [dados] column.
     * 
     * @param string $v new value
     * @return $this|\Table\Model\Autor The current object (for fluent API support)
     */
    public function setDados($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->dados !== $v) {
            $this->dados = $v;
            $this->modifiedColumns[AutorTableMap::COL_DADOS] = true;
        }

        return $this;
    } // setDados()

    /**
     * Set the value of [dh_inclusao] column.
     * 
     * @param string $v new value
     * @return $this|\Table\Model\Autor The current object (for fluent API support)
     */
    public function setDhInclusao($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->dh_inclusao !== $v) {
            $this->dh_inclusao = $v;
            $this->modifiedColumns[AutorTableMap::COL_DH_INCLUSAO] = true;
        }

        return $this;
    } // setDhInclusao()

    /**
     * Set the value of [dh_alteracao] column.
     * 
     * @param string $v new value
     * @return $this|\Table\Model\Autor The current object (for fluent API support)
     */
    public function setDhAlteracao($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->dh_alteracao !== $v) {
            $this->dh_alteracao = $v;
            $this->modifiedColumns[AutorTableMap::COL_DH_ALTERACAO] = true;
        }

        return $this;
    } // setDhAlteracao()

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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : AutorTableMap::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : AutorTableMap::translateFieldName('Nome', TableMap::TYPE_PHPNAME, $indexType)];
            $this->nome = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : AutorTableMap::translateFieldName('Email', TableMap::TYPE_PHPNAME, $indexType)];
            $this->email = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : AutorTableMap::translateFieldName('Usuario', TableMap::TYPE_PHPNAME, $indexType)];
            $this->usuario = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : AutorTableMap::translateFieldName('Senha', TableMap::TYPE_PHPNAME, $indexType)];
            $this->senha = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : AutorTableMap::translateFieldName('Salt', TableMap::TYPE_PHPNAME, $indexType)];
            $this->salt = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : AutorTableMap::translateFieldName('Descricao', TableMap::TYPE_PHPNAME, $indexType)];
            $this->descricao = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : AutorTableMap::translateFieldName('Dados', TableMap::TYPE_PHPNAME, $indexType)];
            $this->dados = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : AutorTableMap::translateFieldName('DhInclusao', TableMap::TYPE_PHPNAME, $indexType)];
            $this->dh_inclusao = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : AutorTableMap::translateFieldName('DhAlteracao', TableMap::TYPE_PHPNAME, $indexType)];
            $this->dh_alteracao = (null !== $col) ? (string) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 10; // 10 = AutorTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Table\\Model\\Autor'), 0, $e);
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
            $con = Propel::getServiceContainer()->getReadConnection(AutorTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildAutorQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collPages = null;

            $this->collPosts = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see Autor::setDeleted()
     * @see Autor::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(AutorTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildAutorQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(AutorTableMap::DATABASE_NAME);
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
                AutorTableMap::addInstanceToPool($this);
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

            if ($this->pagesScheduledForDeletion !== null) {
                if (!$this->pagesScheduledForDeletion->isEmpty()) {
                    \Table\Model\PageQuery::create()
                        ->filterByPrimaryKeys($this->pagesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->pagesScheduledForDeletion = null;
                }
            }

            if ($this->collPages !== null) {
                foreach ($this->collPages as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->postsScheduledForDeletion !== null) {
                if (!$this->postsScheduledForDeletion->isEmpty()) {
                    \Table\Model\PostQuery::create()
                        ->filterByPrimaryKeys($this->postsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->postsScheduledForDeletion = null;
                }
            }

            if ($this->collPosts !== null) {
                foreach ($this->collPosts as $referrerFK) {
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

        $this->modifiedColumns[AutorTableMap::COL_ID] = true;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . AutorTableMap::COL_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(AutorTableMap::COL_ID)) {
            $modifiedColumns[':p' . $index++]  = 'id';
        }
        if ($this->isColumnModified(AutorTableMap::COL_NOME)) {
            $modifiedColumns[':p' . $index++]  = 'nome';
        }
        if ($this->isColumnModified(AutorTableMap::COL_EMAIL)) {
            $modifiedColumns[':p' . $index++]  = 'email';
        }
        if ($this->isColumnModified(AutorTableMap::COL_USUARIO)) {
            $modifiedColumns[':p' . $index++]  = 'usuario';
        }
        if ($this->isColumnModified(AutorTableMap::COL_SENHA)) {
            $modifiedColumns[':p' . $index++]  = 'senha';
        }
        if ($this->isColumnModified(AutorTableMap::COL_SALT)) {
            $modifiedColumns[':p' . $index++]  = 'salt';
        }
        if ($this->isColumnModified(AutorTableMap::COL_DESCRICAO)) {
            $modifiedColumns[':p' . $index++]  = 'descricao';
        }
        if ($this->isColumnModified(AutorTableMap::COL_DADOS)) {
            $modifiedColumns[':p' . $index++]  = 'dados';
        }
        if ($this->isColumnModified(AutorTableMap::COL_DH_INCLUSAO)) {
            $modifiedColumns[':p' . $index++]  = 'dh_inclusao';
        }
        if ($this->isColumnModified(AutorTableMap::COL_DH_ALTERACAO)) {
            $modifiedColumns[':p' . $index++]  = 'dh_alteracao';
        }

        $sql = sprintf(
            'INSERT INTO autor (%s) VALUES (%s)',
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
                    case 'nome':                        
                        $stmt->bindValue($identifier, $this->nome, PDO::PARAM_STR);
                        break;
                    case 'email':                        
                        $stmt->bindValue($identifier, $this->email, PDO::PARAM_STR);
                        break;
                    case 'usuario':                        
                        $stmt->bindValue($identifier, $this->usuario, PDO::PARAM_STR);
                        break;
                    case 'senha':                        
                        $stmt->bindValue($identifier, $this->senha, PDO::PARAM_STR);
                        break;
                    case 'salt':                        
                        $stmt->bindValue($identifier, $this->salt, PDO::PARAM_STR);
                        break;
                    case 'descricao':                        
                        $stmt->bindValue($identifier, $this->descricao, PDO::PARAM_STR);
                        break;
                    case 'dados':                        
                        $stmt->bindValue($identifier, $this->dados, PDO::PARAM_STR);
                        break;
                    case 'dh_inclusao':                        
                        $stmt->bindValue($identifier, $this->dh_inclusao, PDO::PARAM_STR);
                        break;
                    case 'dh_alteracao':                        
                        $stmt->bindValue($identifier, $this->dh_alteracao, PDO::PARAM_STR);
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
        $pos = AutorTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getNome();
                break;
            case 2:
                return $this->getEmail();
                break;
            case 3:
                return $this->getUsuario();
                break;
            case 4:
                return $this->getSenha();
                break;
            case 5:
                return $this->getSalt();
                break;
            case 6:
                return $this->getDescricao();
                break;
            case 7:
                return $this->getDados();
                break;
            case 8:
                return $this->getDhInclusao();
                break;
            case 9:
                return $this->getDhAlteracao();
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

        if (isset($alreadyDumpedObjects['Autor'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Autor'][$this->hashCode()] = true;
        $keys = AutorTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getNome(),
            $keys[2] => $this->getEmail(),
            $keys[3] => $this->getUsuario(),
            $keys[4] => $this->getSenha(),
            $keys[5] => $this->getSalt(),
            $keys[6] => $this->getDescricao(),
            $keys[7] => $this->getDados(),
            $keys[8] => $this->getDhInclusao(),
            $keys[9] => $this->getDhAlteracao(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }
        
        if ($includeForeignObjects) {
            if (null !== $this->collPages) {
                
                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'pages';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'pages';
                        break;
                    default:
                        $key = 'Pages';
                }
        
                $result[$key] = $this->collPages->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collPosts) {
                
                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'posts';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'posts';
                        break;
                    default:
                        $key = 'Posts';
                }
        
                $result[$key] = $this->collPosts->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
     * @return $this|\Table\Model\Autor
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = AutorTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\Table\Model\Autor
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setId($value);
                break;
            case 1:
                $this->setNome($value);
                break;
            case 2:
                $this->setEmail($value);
                break;
            case 3:
                $this->setUsuario($value);
                break;
            case 4:
                $this->setSenha($value);
                break;
            case 5:
                $this->setSalt($value);
                break;
            case 6:
                $this->setDescricao($value);
                break;
            case 7:
                $this->setDados($value);
                break;
            case 8:
                $this->setDhInclusao($value);
                break;
            case 9:
                $this->setDhAlteracao($value);
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
        $keys = AutorTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setNome($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setEmail($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setUsuario($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setSenha($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setSalt($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setDescricao($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setDados($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setDhInclusao($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setDhAlteracao($arr[$keys[9]]);
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
     * @return $this|\Table\Model\Autor The current object, for fluid interface
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
        $criteria = new Criteria(AutorTableMap::DATABASE_NAME);

        if ($this->isColumnModified(AutorTableMap::COL_ID)) {
            $criteria->add(AutorTableMap::COL_ID, $this->id);
        }
        if ($this->isColumnModified(AutorTableMap::COL_NOME)) {
            $criteria->add(AutorTableMap::COL_NOME, $this->nome);
        }
        if ($this->isColumnModified(AutorTableMap::COL_EMAIL)) {
            $criteria->add(AutorTableMap::COL_EMAIL, $this->email);
        }
        if ($this->isColumnModified(AutorTableMap::COL_USUARIO)) {
            $criteria->add(AutorTableMap::COL_USUARIO, $this->usuario);
        }
        if ($this->isColumnModified(AutorTableMap::COL_SENHA)) {
            $criteria->add(AutorTableMap::COL_SENHA, $this->senha);
        }
        if ($this->isColumnModified(AutorTableMap::COL_SALT)) {
            $criteria->add(AutorTableMap::COL_SALT, $this->salt);
        }
        if ($this->isColumnModified(AutorTableMap::COL_DESCRICAO)) {
            $criteria->add(AutorTableMap::COL_DESCRICAO, $this->descricao);
        }
        if ($this->isColumnModified(AutorTableMap::COL_DADOS)) {
            $criteria->add(AutorTableMap::COL_DADOS, $this->dados);
        }
        if ($this->isColumnModified(AutorTableMap::COL_DH_INCLUSAO)) {
            $criteria->add(AutorTableMap::COL_DH_INCLUSAO, $this->dh_inclusao);
        }
        if ($this->isColumnModified(AutorTableMap::COL_DH_ALTERACAO)) {
            $criteria->add(AutorTableMap::COL_DH_ALTERACAO, $this->dh_alteracao);
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
        $criteria = ChildAutorQuery::create();
        $criteria->add(AutorTableMap::COL_ID, $this->id);

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
     * @param      object $copyObj An object of \Table\Model\Autor (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setNome($this->getNome());
        $copyObj->setEmail($this->getEmail());
        $copyObj->setUsuario($this->getUsuario());
        $copyObj->setSenha($this->getSenha());
        $copyObj->setSalt($this->getSalt());
        $copyObj->setDescricao($this->getDescricao());
        $copyObj->setDados($this->getDados());
        $copyObj->setDhInclusao($this->getDhInclusao());
        $copyObj->setDhAlteracao($this->getDhAlteracao());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getPages() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addPage($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getPosts() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addPost($relObj->copy($deepCopy));
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
     * @return \Table\Model\Autor Clone of current object.
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
     * Initializes a collection based on the name of a relation.
     * Avoids crafting an 'init[$relationName]s' method name
     * that wouldn't work when StandardEnglishPluralizer is used.
     *
     * @param      string $relationName The name of the relation to initialize
     * @return void
     */
    public function initRelation($relationName)
    {
        if ('Page' == $relationName) {
            return $this->initPages();
        }
        if ('Post' == $relationName) {
            return $this->initPosts();
        }
    }

    /**
     * Clears out the collPages collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addPages()
     */
    public function clearPages()
    {
        $this->collPages = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collPages collection loaded partially.
     */
    public function resetPartialPages($v = true)
    {
        $this->collPagesPartial = $v;
    }

    /**
     * Initializes the collPages collection.
     *
     * By default this just sets the collPages collection to an empty array (like clearcollPages());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initPages($overrideExisting = true)
    {
        if (null !== $this->collPages && !$overrideExisting) {
            return;
        }
        $this->collPages = new ObjectCollection();
        $this->collPages->setModel('\Table\Model\Page');
    }

    /**
     * Gets an array of ChildPage objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildAutor is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildPage[] List of ChildPage objects
     * @throws PropelException
     */
    public function getPages(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collPagesPartial && !$this->isNew();
        if (null === $this->collPages || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collPages) {
                // return empty collection
                $this->initPages();
            } else {
                $collPages = ChildPageQuery::create(null, $criteria)
                    ->filterByAutor($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collPagesPartial && count($collPages)) {
                        $this->initPages(false);

                        foreach ($collPages as $obj) {
                            if (false == $this->collPages->contains($obj)) {
                                $this->collPages->append($obj);
                            }
                        }

                        $this->collPagesPartial = true;
                    }

                    return $collPages;
                }

                if ($partial && $this->collPages) {
                    foreach ($this->collPages as $obj) {
                        if ($obj->isNew()) {
                            $collPages[] = $obj;
                        }
                    }
                }

                $this->collPages = $collPages;
                $this->collPagesPartial = false;
            }
        }

        return $this->collPages;
    }

    /**
     * Sets a collection of ChildPage objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $pages A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildAutor The current object (for fluent API support)
     */
    public function setPages(Collection $pages, ConnectionInterface $con = null)
    {
        /** @var ChildPage[] $pagesToDelete */
        $pagesToDelete = $this->getPages(new Criteria(), $con)->diff($pages);

        
        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->pagesScheduledForDeletion = clone $pagesToDelete;

        foreach ($pagesToDelete as $pageRemoved) {
            $pageRemoved->setAutor(null);
        }

        $this->collPages = null;
        foreach ($pages as $page) {
            $this->addPage($page);
        }

        $this->collPages = $pages;
        $this->collPagesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Page objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Page objects.
     * @throws PropelException
     */
    public function countPages(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collPagesPartial && !$this->isNew();
        if (null === $this->collPages || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collPages) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getPages());
            }

            $query = ChildPageQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByAutor($this)
                ->count($con);
        }

        return count($this->collPages);
    }

    /**
     * Method called to associate a ChildPage object to this object
     * through the ChildPage foreign key attribute.
     *
     * @param  ChildPage $l ChildPage
     * @return $this|\Table\Model\Autor The current object (for fluent API support)
     */
    public function addPage(ChildPage $l)
    {
        if ($this->collPages === null) {
            $this->initPages();
            $this->collPagesPartial = true;
        }

        if (!$this->collPages->contains($l)) {
            $this->doAddPage($l);
        }

        return $this;
    }

    /**
     * @param ChildPage $page The ChildPage object to add.
     */
    protected function doAddPage(ChildPage $page)
    {
        $this->collPages[]= $page;
        $page->setAutor($this);
    }

    /**
     * @param  ChildPage $page The ChildPage object to remove.
     * @return $this|ChildAutor The current object (for fluent API support)
     */
    public function removePage(ChildPage $page)
    {
        if ($this->getPages()->contains($page)) {
            $pos = $this->collPages->search($page);
            $this->collPages->remove($pos);
            if (null === $this->pagesScheduledForDeletion) {
                $this->pagesScheduledForDeletion = clone $this->collPages;
                $this->pagesScheduledForDeletion->clear();
            }
            $this->pagesScheduledForDeletion[]= clone $page;
            $page->setAutor(null);
        }

        return $this;
    }

    /**
     * Clears out the collPosts collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addPosts()
     */
    public function clearPosts()
    {
        $this->collPosts = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collPosts collection loaded partially.
     */
    public function resetPartialPosts($v = true)
    {
        $this->collPostsPartial = $v;
    }

    /**
     * Initializes the collPosts collection.
     *
     * By default this just sets the collPosts collection to an empty array (like clearcollPosts());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initPosts($overrideExisting = true)
    {
        if (null !== $this->collPosts && !$overrideExisting) {
            return;
        }
        $this->collPosts = new ObjectCollection();
        $this->collPosts->setModel('\Table\Model\Post');
    }

    /**
     * Gets an array of ChildPost objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildAutor is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildPost[] List of ChildPost objects
     * @throws PropelException
     */
    public function getPosts(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collPostsPartial && !$this->isNew();
        if (null === $this->collPosts || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collPosts) {
                // return empty collection
                $this->initPosts();
            } else {
                $collPosts = ChildPostQuery::create(null, $criteria)
                    ->filterByAutor($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collPostsPartial && count($collPosts)) {
                        $this->initPosts(false);

                        foreach ($collPosts as $obj) {
                            if (false == $this->collPosts->contains($obj)) {
                                $this->collPosts->append($obj);
                            }
                        }

                        $this->collPostsPartial = true;
                    }

                    return $collPosts;
                }

                if ($partial && $this->collPosts) {
                    foreach ($this->collPosts as $obj) {
                        if ($obj->isNew()) {
                            $collPosts[] = $obj;
                        }
                    }
                }

                $this->collPosts = $collPosts;
                $this->collPostsPartial = false;
            }
        }

        return $this->collPosts;
    }

    /**
     * Sets a collection of ChildPost objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $posts A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildAutor The current object (for fluent API support)
     */
    public function setPosts(Collection $posts, ConnectionInterface $con = null)
    {
        /** @var ChildPost[] $postsToDelete */
        $postsToDelete = $this->getPosts(new Criteria(), $con)->diff($posts);

        
        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->postsScheduledForDeletion = clone $postsToDelete;

        foreach ($postsToDelete as $postRemoved) {
            $postRemoved->setAutor(null);
        }

        $this->collPosts = null;
        foreach ($posts as $post) {
            $this->addPost($post);
        }

        $this->collPosts = $posts;
        $this->collPostsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Post objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Post objects.
     * @throws PropelException
     */
    public function countPosts(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collPostsPartial && !$this->isNew();
        if (null === $this->collPosts || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collPosts) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getPosts());
            }

            $query = ChildPostQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByAutor($this)
                ->count($con);
        }

        return count($this->collPosts);
    }

    /**
     * Method called to associate a ChildPost object to this object
     * through the ChildPost foreign key attribute.
     *
     * @param  ChildPost $l ChildPost
     * @return $this|\Table\Model\Autor The current object (for fluent API support)
     */
    public function addPost(ChildPost $l)
    {
        if ($this->collPosts === null) {
            $this->initPosts();
            $this->collPostsPartial = true;
        }

        if (!$this->collPosts->contains($l)) {
            $this->doAddPost($l);
        }

        return $this;
    }

    /**
     * @param ChildPost $post The ChildPost object to add.
     */
    protected function doAddPost(ChildPost $post)
    {
        $this->collPosts[]= $post;
        $post->setAutor($this);
    }

    /**
     * @param  ChildPost $post The ChildPost object to remove.
     * @return $this|ChildAutor The current object (for fluent API support)
     */
    public function removePost(ChildPost $post)
    {
        if ($this->getPosts()->contains($post)) {
            $pos = $this->collPosts->search($post);
            $this->collPosts->remove($pos);
            if (null === $this->postsScheduledForDeletion) {
                $this->postsScheduledForDeletion = clone $this->collPosts;
                $this->postsScheduledForDeletion->clear();
            }
            $this->postsScheduledForDeletion[]= clone $post;
            $post->setAutor(null);
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
        $this->id = null;
        $this->nome = null;
        $this->email = null;
        $this->usuario = null;
        $this->senha = null;
        $this->salt = null;
        $this->descricao = null;
        $this->dados = null;
        $this->dh_inclusao = null;
        $this->dh_alteracao = null;
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
            if ($this->collPages) {
                foreach ($this->collPages as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collPosts) {
                foreach ($this->collPosts as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collPages = null;
        $this->collPosts = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(AutorTableMap::DEFAULT_STRING_FORMAT);
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
