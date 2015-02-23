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
use Table\Model\Post as ChildPost;
use Table\Model\PostData as ChildPostData;
use Table\Model\PostDataQuery as ChildPostDataQuery;
use Table\Model\PostHasCategoria as ChildPostHasCategoria;
use Table\Model\PostHasCategoriaQuery as ChildPostHasCategoriaQuery;
use Table\Model\PostQuery as ChildPostQuery;
use Table\Model\Map\PostTableMap;

/**
 * Base class that represents a row from the 'post' table.
 *
 * 
 *
* @package    propel.generator.Table.Model.Base
*/
abstract class Post implements ActiveRecordInterface 
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\Table\\Model\\Map\\PostTableMap';


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
     * The value for the autor_id field.
     * @var        int
     */
    protected $autor_id;

    /**
     * The value for the titulo field.
     * @var        string
     */
    protected $titulo;

    /**
     * The value for the url field.
     * @var        string
     */
    protected $url;

    /**
     * The value for the content field.
     * @var        string
     */
    protected $content;

    /**
     * The value for the status field.
     * @var        int
     */
    protected $status;

    /**
     * The value for the data field.
     * @var        string
     */
    protected $data;

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
     * @var        ChildAutor
     */
    protected $aAutor;

    /**
     * @var        ObjectCollection|ChildPostData[] Collection to store aggregation of ChildPostData objects.
     */
    protected $collPostDatas;
    protected $collPostDatasPartial;

    /**
     * @var        ObjectCollection|ChildPostHasCategoria[] Collection to store aggregation of ChildPostHasCategoria objects.
     */
    protected $collPostHasCategorias;
    protected $collPostHasCategoriasPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildPostData[]
     */
    protected $postDatasScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildPostHasCategoria[]
     */
    protected $postHasCategoriasScheduledForDeletion = null;

    /**
     * Initializes internal state of Table\Model\Base\Post object.
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
     * Compares this with another <code>Post</code> instance.  If
     * <code>obj</code> is an instance of <code>Post</code>, delegates to
     * <code>equals(Post)</code>.  Otherwise, returns <code>false</code>.
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
     * @return $this|Post The current object, for fluid interface
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
     * Get the [autor_id] column value.
     * 
     * @return int
     */
    public function getAutorId()
    {
        return $this->autor_id;
    }

    /**
     * Get the [titulo] column value.
     * 
     * @return string
     */
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * Get the [url] column value.
     * 
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Get the [content] column value.
     * 
     * @return string
     */
    public function getContent()
    {
        return $this->content;
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
     * Get the [data] column value.
     * 
     * @return string
     */
    public function getData()
    {
        return $this->data;
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
     * @return $this|\Table\Model\Post The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[PostTableMap::COL_ID] = true;
        }

        return $this;
    } // setId()

    /**
     * Set the value of [autor_id] column.
     * 
     * @param int $v new value
     * @return $this|\Table\Model\Post The current object (for fluent API support)
     */
    public function setAutorId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->autor_id !== $v) {
            $this->autor_id = $v;
            $this->modifiedColumns[PostTableMap::COL_AUTOR_ID] = true;
        }

        if ($this->aAutor !== null && $this->aAutor->getId() !== $v) {
            $this->aAutor = null;
        }

        return $this;
    } // setAutorId()

    /**
     * Set the value of [titulo] column.
     * 
     * @param string $v new value
     * @return $this|\Table\Model\Post The current object (for fluent API support)
     */
    public function setTitulo($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->titulo !== $v) {
            $this->titulo = $v;
            $this->modifiedColumns[PostTableMap::COL_TITULO] = true;
        }

        return $this;
    } // setTitulo()

    /**
     * Set the value of [url] column.
     * 
     * @param string $v new value
     * @return $this|\Table\Model\Post The current object (for fluent API support)
     */
    public function setUrl($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->url !== $v) {
            $this->url = $v;
            $this->modifiedColumns[PostTableMap::COL_URL] = true;
        }

        return $this;
    } // setUrl()

    /**
     * Set the value of [content] column.
     * 
     * @param string $v new value
     * @return $this|\Table\Model\Post The current object (for fluent API support)
     */
    public function setContent($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->content !== $v) {
            $this->content = $v;
            $this->modifiedColumns[PostTableMap::COL_CONTENT] = true;
        }

        return $this;
    } // setContent()

    /**
     * Set the value of [status] column.
     * 
     * @param int $v new value
     * @return $this|\Table\Model\Post The current object (for fluent API support)
     */
    public function setStatus($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->status !== $v) {
            $this->status = $v;
            $this->modifiedColumns[PostTableMap::COL_STATUS] = true;
        }

        return $this;
    } // setStatus()

    /**
     * Set the value of [data] column.
     * 
     * @param string $v new value
     * @return $this|\Table\Model\Post The current object (for fluent API support)
     */
    public function setData($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->data !== $v) {
            $this->data = $v;
            $this->modifiedColumns[PostTableMap::COL_DATA] = true;
        }

        return $this;
    } // setData()

    /**
     * Set the value of [dh_inclusao] column.
     * 
     * @param string $v new value
     * @return $this|\Table\Model\Post The current object (for fluent API support)
     */
    public function setDhInclusao($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->dh_inclusao !== $v) {
            $this->dh_inclusao = $v;
            $this->modifiedColumns[PostTableMap::COL_DH_INCLUSAO] = true;
        }

        return $this;
    } // setDhInclusao()

    /**
     * Set the value of [dh_alteracao] column.
     * 
     * @param string $v new value
     * @return $this|\Table\Model\Post The current object (for fluent API support)
     */
    public function setDhAlteracao($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->dh_alteracao !== $v) {
            $this->dh_alteracao = $v;
            $this->modifiedColumns[PostTableMap::COL_DH_ALTERACAO] = true;
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : PostTableMap::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : PostTableMap::translateFieldName('AutorId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->autor_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : PostTableMap::translateFieldName('Titulo', TableMap::TYPE_PHPNAME, $indexType)];
            $this->titulo = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : PostTableMap::translateFieldName('Url', TableMap::TYPE_PHPNAME, $indexType)];
            $this->url = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : PostTableMap::translateFieldName('Content', TableMap::TYPE_PHPNAME, $indexType)];
            $this->content = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : PostTableMap::translateFieldName('Status', TableMap::TYPE_PHPNAME, $indexType)];
            $this->status = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : PostTableMap::translateFieldName('Data', TableMap::TYPE_PHPNAME, $indexType)];
            $this->data = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : PostTableMap::translateFieldName('DhInclusao', TableMap::TYPE_PHPNAME, $indexType)];
            $this->dh_inclusao = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : PostTableMap::translateFieldName('DhAlteracao', TableMap::TYPE_PHPNAME, $indexType)];
            $this->dh_alteracao = (null !== $col) ? (string) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 9; // 9 = PostTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Table\\Model\\Post'), 0, $e);
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
        if ($this->aAutor !== null && $this->autor_id !== $this->aAutor->getId()) {
            $this->aAutor = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(PostTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildPostQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aAutor = null;
            $this->collPostDatas = null;

            $this->collPostHasCategorias = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see Post::setDeleted()
     * @see Post::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(PostTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildPostQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(PostTableMap::DATABASE_NAME);
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
                PostTableMap::addInstanceToPool($this);
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

            if ($this->aAutor !== null) {
                if ($this->aAutor->isModified() || $this->aAutor->isNew()) {
                    $affectedRows += $this->aAutor->save($con);
                }
                $this->setAutor($this->aAutor);
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

            if ($this->postDatasScheduledForDeletion !== null) {
                if (!$this->postDatasScheduledForDeletion->isEmpty()) {
                    \Table\Model\PostDataQuery::create()
                        ->filterByPrimaryKeys($this->postDatasScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->postDatasScheduledForDeletion = null;
                }
            }

            if ($this->collPostDatas !== null) {
                foreach ($this->collPostDatas as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->postHasCategoriasScheduledForDeletion !== null) {
                if (!$this->postHasCategoriasScheduledForDeletion->isEmpty()) {
                    \Table\Model\PostHasCategoriaQuery::create()
                        ->filterByPrimaryKeys($this->postHasCategoriasScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->postHasCategoriasScheduledForDeletion = null;
                }
            }

            if ($this->collPostHasCategorias !== null) {
                foreach ($this->collPostHasCategorias as $referrerFK) {
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

        $this->modifiedColumns[PostTableMap::COL_ID] = true;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . PostTableMap::COL_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(PostTableMap::COL_ID)) {
            $modifiedColumns[':p' . $index++]  = 'id';
        }
        if ($this->isColumnModified(PostTableMap::COL_AUTOR_ID)) {
            $modifiedColumns[':p' . $index++]  = 'autor_id';
        }
        if ($this->isColumnModified(PostTableMap::COL_TITULO)) {
            $modifiedColumns[':p' . $index++]  = 'titulo';
        }
        if ($this->isColumnModified(PostTableMap::COL_URL)) {
            $modifiedColumns[':p' . $index++]  = 'url';
        }
        if ($this->isColumnModified(PostTableMap::COL_CONTENT)) {
            $modifiedColumns[':p' . $index++]  = 'content';
        }
        if ($this->isColumnModified(PostTableMap::COL_STATUS)) {
            $modifiedColumns[':p' . $index++]  = 'status';
        }
        if ($this->isColumnModified(PostTableMap::COL_DATA)) {
            $modifiedColumns[':p' . $index++]  = 'data';
        }
        if ($this->isColumnModified(PostTableMap::COL_DH_INCLUSAO)) {
            $modifiedColumns[':p' . $index++]  = 'dh_inclusao';
        }
        if ($this->isColumnModified(PostTableMap::COL_DH_ALTERACAO)) {
            $modifiedColumns[':p' . $index++]  = 'dh_alteracao';
        }

        $sql = sprintf(
            'INSERT INTO post (%s) VALUES (%s)',
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
                    case 'autor_id':                        
                        $stmt->bindValue($identifier, $this->autor_id, PDO::PARAM_INT);
                        break;
                    case 'titulo':                        
                        $stmt->bindValue($identifier, $this->titulo, PDO::PARAM_STR);
                        break;
                    case 'url':                        
                        $stmt->bindValue($identifier, $this->url, PDO::PARAM_STR);
                        break;
                    case 'content':                        
                        $stmt->bindValue($identifier, $this->content, PDO::PARAM_STR);
                        break;
                    case 'status':                        
                        $stmt->bindValue($identifier, $this->status, PDO::PARAM_INT);
                        break;
                    case 'data':                        
                        $stmt->bindValue($identifier, $this->data, PDO::PARAM_STR);
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
        $pos = PostTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getAutorId();
                break;
            case 2:
                return $this->getTitulo();
                break;
            case 3:
                return $this->getUrl();
                break;
            case 4:
                return $this->getContent();
                break;
            case 5:
                return $this->getStatus();
                break;
            case 6:
                return $this->getData();
                break;
            case 7:
                return $this->getDhInclusao();
                break;
            case 8:
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

        if (isset($alreadyDumpedObjects['Post'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Post'][$this->hashCode()] = true;
        $keys = PostTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getAutorId(),
            $keys[2] => $this->getTitulo(),
            $keys[3] => $this->getUrl(),
            $keys[4] => $this->getContent(),
            $keys[5] => $this->getStatus(),
            $keys[6] => $this->getData(),
            $keys[7] => $this->getDhInclusao(),
            $keys[8] => $this->getDhAlteracao(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }
        
        if ($includeForeignObjects) {
            if (null !== $this->aAutor) {
                
                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'autor';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'autor';
                        break;
                    default:
                        $key = 'Autor';
                }
        
                $result[$key] = $this->aAutor->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collPostDatas) {
                
                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'postDatas';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'post_datas';
                        break;
                    default:
                        $key = 'PostDatas';
                }
        
                $result[$key] = $this->collPostDatas->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collPostHasCategorias) {
                
                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'postHasCategorias';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'post_has_categorias';
                        break;
                    default:
                        $key = 'PostHasCategorias';
                }
        
                $result[$key] = $this->collPostHasCategorias->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
     * @return $this|\Table\Model\Post
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = PostTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\Table\Model\Post
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setId($value);
                break;
            case 1:
                $this->setAutorId($value);
                break;
            case 2:
                $this->setTitulo($value);
                break;
            case 3:
                $this->setUrl($value);
                break;
            case 4:
                $this->setContent($value);
                break;
            case 5:
                $this->setStatus($value);
                break;
            case 6:
                $this->setData($value);
                break;
            case 7:
                $this->setDhInclusao($value);
                break;
            case 8:
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
        $keys = PostTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setAutorId($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setTitulo($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setUrl($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setContent($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setStatus($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setData($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setDhInclusao($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setDhAlteracao($arr[$keys[8]]);
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
     * @return $this|\Table\Model\Post The current object, for fluid interface
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
        $criteria = new Criteria(PostTableMap::DATABASE_NAME);

        if ($this->isColumnModified(PostTableMap::COL_ID)) {
            $criteria->add(PostTableMap::COL_ID, $this->id);
        }
        if ($this->isColumnModified(PostTableMap::COL_AUTOR_ID)) {
            $criteria->add(PostTableMap::COL_AUTOR_ID, $this->autor_id);
        }
        if ($this->isColumnModified(PostTableMap::COL_TITULO)) {
            $criteria->add(PostTableMap::COL_TITULO, $this->titulo);
        }
        if ($this->isColumnModified(PostTableMap::COL_URL)) {
            $criteria->add(PostTableMap::COL_URL, $this->url);
        }
        if ($this->isColumnModified(PostTableMap::COL_CONTENT)) {
            $criteria->add(PostTableMap::COL_CONTENT, $this->content);
        }
        if ($this->isColumnModified(PostTableMap::COL_STATUS)) {
            $criteria->add(PostTableMap::COL_STATUS, $this->status);
        }
        if ($this->isColumnModified(PostTableMap::COL_DATA)) {
            $criteria->add(PostTableMap::COL_DATA, $this->data);
        }
        if ($this->isColumnModified(PostTableMap::COL_DH_INCLUSAO)) {
            $criteria->add(PostTableMap::COL_DH_INCLUSAO, $this->dh_inclusao);
        }
        if ($this->isColumnModified(PostTableMap::COL_DH_ALTERACAO)) {
            $criteria->add(PostTableMap::COL_DH_ALTERACAO, $this->dh_alteracao);
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
        $criteria = ChildPostQuery::create();
        $criteria->add(PostTableMap::COL_ID, $this->id);
        $criteria->add(PostTableMap::COL_AUTOR_ID, $this->autor_id);

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
        $validPk = null !== $this->getId() &&
            null !== $this->getAutorId();

        $validPrimaryKeyFKs = 1;
        $primaryKeyFKs = [];

        //relation fk_post_autor1 to table autor
        if ($this->aAutor && $hash = spl_object_hash($this->aAutor)) {
            $primaryKeyFKs[] = $hash;
        } else {
            $validPrimaryKeyFKs = false;
        }

        if ($validPk) {
            return crc32(json_encode($this->getPrimaryKey(), JSON_UNESCAPED_UNICODE));
        } elseif ($validPrimaryKeyFKs) {
            return crc32(json_encode($primaryKeyFKs, JSON_UNESCAPED_UNICODE));
        }

        return spl_object_hash($this);
    }
        
    /**
     * Returns the composite primary key for this object.
     * The array elements will be in same order as specified in XML.
     * @return array
     */
    public function getPrimaryKey()
    {
        $pks = array();
        $pks[0] = $this->getId();
        $pks[1] = $this->getAutorId();

        return $pks;
    }

    /**
     * Set the [composite] primary key.
     *
     * @param      array $keys The elements of the composite key (order must match the order in XML file).
     * @return void
     */
    public function setPrimaryKey($keys)
    {
        $this->setId($keys[0]);
        $this->setAutorId($keys[1]);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {
        return (null === $this->getId()) && (null === $this->getAutorId());
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of \Table\Model\Post (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setAutorId($this->getAutorId());
        $copyObj->setTitulo($this->getTitulo());
        $copyObj->setUrl($this->getUrl());
        $copyObj->setContent($this->getContent());
        $copyObj->setStatus($this->getStatus());
        $copyObj->setData($this->getData());
        $copyObj->setDhInclusao($this->getDhInclusao());
        $copyObj->setDhAlteracao($this->getDhAlteracao());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getPostDatas() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addPostData($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getPostHasCategorias() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addPostHasCategoria($relObj->copy($deepCopy));
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
     * @return \Table\Model\Post Clone of current object.
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
     * Declares an association between this object and a ChildAutor object.
     *
     * @param  ChildAutor $v
     * @return $this|\Table\Model\Post The current object (for fluent API support)
     * @throws PropelException
     */
    public function setAutor(ChildAutor $v = null)
    {
        if ($v === null) {
            $this->setAutorId(NULL);
        } else {
            $this->setAutorId($v->getId());
        }

        $this->aAutor = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildAutor object, it will not be re-added.
        if ($v !== null) {
            $v->addPost($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildAutor object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildAutor The associated ChildAutor object.
     * @throws PropelException
     */
    public function getAutor(ConnectionInterface $con = null)
    {
        if ($this->aAutor === null && ($this->autor_id !== null)) {
            $this->aAutor = ChildAutorQuery::create()->findPk($this->autor_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aAutor->addPosts($this);
             */
        }

        return $this->aAutor;
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
        if ('PostData' == $relationName) {
            return $this->initPostDatas();
        }
        if ('PostHasCategoria' == $relationName) {
            return $this->initPostHasCategorias();
        }
    }

    /**
     * Clears out the collPostDatas collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addPostDatas()
     */
    public function clearPostDatas()
    {
        $this->collPostDatas = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collPostDatas collection loaded partially.
     */
    public function resetPartialPostDatas($v = true)
    {
        $this->collPostDatasPartial = $v;
    }

    /**
     * Initializes the collPostDatas collection.
     *
     * By default this just sets the collPostDatas collection to an empty array (like clearcollPostDatas());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initPostDatas($overrideExisting = true)
    {
        if (null !== $this->collPostDatas && !$overrideExisting) {
            return;
        }
        $this->collPostDatas = new ObjectCollection();
        $this->collPostDatas->setModel('\Table\Model\PostData');
    }

    /**
     * Gets an array of ChildPostData objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildPost is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildPostData[] List of ChildPostData objects
     * @throws PropelException
     */
    public function getPostDatas(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collPostDatasPartial && !$this->isNew();
        if (null === $this->collPostDatas || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collPostDatas) {
                // return empty collection
                $this->initPostDatas();
            } else {
                $collPostDatas = ChildPostDataQuery::create(null, $criteria)
                    ->filterByPost($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collPostDatasPartial && count($collPostDatas)) {
                        $this->initPostDatas(false);

                        foreach ($collPostDatas as $obj) {
                            if (false == $this->collPostDatas->contains($obj)) {
                                $this->collPostDatas->append($obj);
                            }
                        }

                        $this->collPostDatasPartial = true;
                    }

                    return $collPostDatas;
                }

                if ($partial && $this->collPostDatas) {
                    foreach ($this->collPostDatas as $obj) {
                        if ($obj->isNew()) {
                            $collPostDatas[] = $obj;
                        }
                    }
                }

                $this->collPostDatas = $collPostDatas;
                $this->collPostDatasPartial = false;
            }
        }

        return $this->collPostDatas;
    }

    /**
     * Sets a collection of ChildPostData objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $postDatas A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildPost The current object (for fluent API support)
     */
    public function setPostDatas(Collection $postDatas, ConnectionInterface $con = null)
    {
        /** @var ChildPostData[] $postDatasToDelete */
        $postDatasToDelete = $this->getPostDatas(new Criteria(), $con)->diff($postDatas);

        
        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->postDatasScheduledForDeletion = clone $postDatasToDelete;

        foreach ($postDatasToDelete as $postDataRemoved) {
            $postDataRemoved->setPost(null);
        }

        $this->collPostDatas = null;
        foreach ($postDatas as $postData) {
            $this->addPostData($postData);
        }

        $this->collPostDatas = $postDatas;
        $this->collPostDatasPartial = false;

        return $this;
    }

    /**
     * Returns the number of related PostData objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related PostData objects.
     * @throws PropelException
     */
    public function countPostDatas(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collPostDatasPartial && !$this->isNew();
        if (null === $this->collPostDatas || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collPostDatas) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getPostDatas());
            }

            $query = ChildPostDataQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByPost($this)
                ->count($con);
        }

        return count($this->collPostDatas);
    }

    /**
     * Method called to associate a ChildPostData object to this object
     * through the ChildPostData foreign key attribute.
     *
     * @param  ChildPostData $l ChildPostData
     * @return $this|\Table\Model\Post The current object (for fluent API support)
     */
    public function addPostData(ChildPostData $l)
    {
        if ($this->collPostDatas === null) {
            $this->initPostDatas();
            $this->collPostDatasPartial = true;
        }

        if (!$this->collPostDatas->contains($l)) {
            $this->doAddPostData($l);
        }

        return $this;
    }

    /**
     * @param ChildPostData $postData The ChildPostData object to add.
     */
    protected function doAddPostData(ChildPostData $postData)
    {
        $this->collPostDatas[]= $postData;
        $postData->setPost($this);
    }

    /**
     * @param  ChildPostData $postData The ChildPostData object to remove.
     * @return $this|ChildPost The current object (for fluent API support)
     */
    public function removePostData(ChildPostData $postData)
    {
        if ($this->getPostDatas()->contains($postData)) {
            $pos = $this->collPostDatas->search($postData);
            $this->collPostDatas->remove($pos);
            if (null === $this->postDatasScheduledForDeletion) {
                $this->postDatasScheduledForDeletion = clone $this->collPostDatas;
                $this->postDatasScheduledForDeletion->clear();
            }
            $this->postDatasScheduledForDeletion[]= clone $postData;
            $postData->setPost(null);
        }

        return $this;
    }

    /**
     * Clears out the collPostHasCategorias collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addPostHasCategorias()
     */
    public function clearPostHasCategorias()
    {
        $this->collPostHasCategorias = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collPostHasCategorias collection loaded partially.
     */
    public function resetPartialPostHasCategorias($v = true)
    {
        $this->collPostHasCategoriasPartial = $v;
    }

    /**
     * Initializes the collPostHasCategorias collection.
     *
     * By default this just sets the collPostHasCategorias collection to an empty array (like clearcollPostHasCategorias());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initPostHasCategorias($overrideExisting = true)
    {
        if (null !== $this->collPostHasCategorias && !$overrideExisting) {
            return;
        }
        $this->collPostHasCategorias = new ObjectCollection();
        $this->collPostHasCategorias->setModel('\Table\Model\PostHasCategoria');
    }

    /**
     * Gets an array of ChildPostHasCategoria objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildPost is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildPostHasCategoria[] List of ChildPostHasCategoria objects
     * @throws PropelException
     */
    public function getPostHasCategorias(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collPostHasCategoriasPartial && !$this->isNew();
        if (null === $this->collPostHasCategorias || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collPostHasCategorias) {
                // return empty collection
                $this->initPostHasCategorias();
            } else {
                $collPostHasCategorias = ChildPostHasCategoriaQuery::create(null, $criteria)
                    ->filterByPost($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collPostHasCategoriasPartial && count($collPostHasCategorias)) {
                        $this->initPostHasCategorias(false);

                        foreach ($collPostHasCategorias as $obj) {
                            if (false == $this->collPostHasCategorias->contains($obj)) {
                                $this->collPostHasCategorias->append($obj);
                            }
                        }

                        $this->collPostHasCategoriasPartial = true;
                    }

                    return $collPostHasCategorias;
                }

                if ($partial && $this->collPostHasCategorias) {
                    foreach ($this->collPostHasCategorias as $obj) {
                        if ($obj->isNew()) {
                            $collPostHasCategorias[] = $obj;
                        }
                    }
                }

                $this->collPostHasCategorias = $collPostHasCategorias;
                $this->collPostHasCategoriasPartial = false;
            }
        }

        return $this->collPostHasCategorias;
    }

    /**
     * Sets a collection of ChildPostHasCategoria objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $postHasCategorias A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildPost The current object (for fluent API support)
     */
    public function setPostHasCategorias(Collection $postHasCategorias, ConnectionInterface $con = null)
    {
        /** @var ChildPostHasCategoria[] $postHasCategoriasToDelete */
        $postHasCategoriasToDelete = $this->getPostHasCategorias(new Criteria(), $con)->diff($postHasCategorias);

        
        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->postHasCategoriasScheduledForDeletion = clone $postHasCategoriasToDelete;

        foreach ($postHasCategoriasToDelete as $postHasCategoriaRemoved) {
            $postHasCategoriaRemoved->setPost(null);
        }

        $this->collPostHasCategorias = null;
        foreach ($postHasCategorias as $postHasCategoria) {
            $this->addPostHasCategoria($postHasCategoria);
        }

        $this->collPostHasCategorias = $postHasCategorias;
        $this->collPostHasCategoriasPartial = false;

        return $this;
    }

    /**
     * Returns the number of related PostHasCategoria objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related PostHasCategoria objects.
     * @throws PropelException
     */
    public function countPostHasCategorias(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collPostHasCategoriasPartial && !$this->isNew();
        if (null === $this->collPostHasCategorias || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collPostHasCategorias) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getPostHasCategorias());
            }

            $query = ChildPostHasCategoriaQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByPost($this)
                ->count($con);
        }

        return count($this->collPostHasCategorias);
    }

    /**
     * Method called to associate a ChildPostHasCategoria object to this object
     * through the ChildPostHasCategoria foreign key attribute.
     *
     * @param  ChildPostHasCategoria $l ChildPostHasCategoria
     * @return $this|\Table\Model\Post The current object (for fluent API support)
     */
    public function addPostHasCategoria(ChildPostHasCategoria $l)
    {
        if ($this->collPostHasCategorias === null) {
            $this->initPostHasCategorias();
            $this->collPostHasCategoriasPartial = true;
        }

        if (!$this->collPostHasCategorias->contains($l)) {
            $this->doAddPostHasCategoria($l);
        }

        return $this;
    }

    /**
     * @param ChildPostHasCategoria $postHasCategoria The ChildPostHasCategoria object to add.
     */
    protected function doAddPostHasCategoria(ChildPostHasCategoria $postHasCategoria)
    {
        $this->collPostHasCategorias[]= $postHasCategoria;
        $postHasCategoria->setPost($this);
    }

    /**
     * @param  ChildPostHasCategoria $postHasCategoria The ChildPostHasCategoria object to remove.
     * @return $this|ChildPost The current object (for fluent API support)
     */
    public function removePostHasCategoria(ChildPostHasCategoria $postHasCategoria)
    {
        if ($this->getPostHasCategorias()->contains($postHasCategoria)) {
            $pos = $this->collPostHasCategorias->search($postHasCategoria);
            $this->collPostHasCategorias->remove($pos);
            if (null === $this->postHasCategoriasScheduledForDeletion) {
                $this->postHasCategoriasScheduledForDeletion = clone $this->collPostHasCategorias;
                $this->postHasCategoriasScheduledForDeletion->clear();
            }
            $this->postHasCategoriasScheduledForDeletion[]= clone $postHasCategoria;
            $postHasCategoria->setPost(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Post is new, it will return
     * an empty collection; or if this Post has previously
     * been saved, it will retrieve related PostHasCategorias from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Post.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildPostHasCategoria[] List of ChildPostHasCategoria objects
     */
    public function getPostHasCategoriasJoinCategoria(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildPostHasCategoriaQuery::create(null, $criteria);
        $query->joinWith('Categoria', $joinBehavior);

        return $this->getPostHasCategorias($query, $con);
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        if (null !== $this->aAutor) {
            $this->aAutor->removePost($this);
        }
        $this->id = null;
        $this->autor_id = null;
        $this->titulo = null;
        $this->url = null;
        $this->content = null;
        $this->status = null;
        $this->data = null;
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
            if ($this->collPostDatas) {
                foreach ($this->collPostDatas as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collPostHasCategorias) {
                foreach ($this->collPostHasCategorias as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collPostDatas = null;
        $this->collPostHasCategorias = null;
        $this->aAutor = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(PostTableMap::DEFAULT_STRING_FORMAT);
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
