<?php

namespace Base;

use \Departamentos as ChildDepartamentos;
use \DepartamentosQuery as ChildDepartamentosQuery;
use \EmpleadosQuery as ChildEmpleadosQuery;
use \Exception;
use \PDO;
use Map\EmpleadosTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveRecord\ActiveRecordInterface;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\BadMethodCallException;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Parser\AbstractParser;

/**
 * Base class that represents a row from the 'empleados' table.
 *
 *
 *
 * @package    propel.generator..Base
 */
abstract class Empleados implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\Map\\EmpleadosTableMap';


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
     * The value for the idempledos field.
     *
     * @var        int
     */
    protected $idempledos;

    /**
     * The value for the nombre field.
     *
     * @var        string
     */
    protected $nombre;

    /**
     * The value for the ap_paterno field.
     *
     * @var        string
     */
    protected $ap_paterno;

    /**
     * The value for the ap_materno field.
     *
     * @var        string
     */
    protected $ap_materno;

    /**
     * The value for the edad field.
     *
     * @var        int
     */
    protected $edad;

    /**
     * The value for the sexo field.
     *
     * @var        string
     */
    protected $sexo;

    /**
     * The value for the numero_empleados field.
     *
     * @var        string
     */
    protected $numero_empleados;

    /**
     * The value for the depart_id field.
     *
     * @var        int
     */
    protected $depart_id;

    /**
     * @var        ChildDepartamentos
     */
    protected $aDepartamentos;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * Initializes internal state of Base\Empleados object.
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
     * Compares this with another <code>Empleados</code> instance.  If
     * <code>obj</code> is an instance of <code>Empleados</code>, delegates to
     * <code>equals(Empleados)</code>.  Otherwise, returns <code>false</code>.
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
     * @return $this|Empleados The current object, for fluid interface
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

        $cls = new \ReflectionClass($this);
        $propertyNames = [];
        $serializableProperties = array_diff($cls->getProperties(), $cls->getProperties(\ReflectionProperty::IS_STATIC));

        foreach($serializableProperties as $property) {
            $propertyNames[] = $property->getName();
        }

        return $propertyNames;
    }

    /**
     * Get the [idempledos] column value.
     *
     * @return int
     */
    public function getIdempledos()
    {
        return $this->idempledos;
    }

    /**
     * Get the [nombre] column value.
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Get the [ap_paterno] column value.
     *
     * @return string
     */
    public function getApPaterno()
    {
        return $this->ap_paterno;
    }

    /**
     * Get the [ap_materno] column value.
     *
     * @return string
     */
    public function getApMaterno()
    {
        return $this->ap_materno;
    }

    /**
     * Get the [edad] column value.
     *
     * @return int
     */
    public function getEdad()
    {
        return $this->edad;
    }

    /**
     * Get the [sexo] column value.
     *
     * @return string
     */
    public function getSexo()
    {
        return $this->sexo;
    }

    /**
     * Get the [numero_empleados] column value.
     *
     * @return string
     */
    public function getNumeroEmpleados()
    {
        return $this->numero_empleados;
    }

    /**
     * Get the [depart_id] column value.
     *
     * @return int
     */
    public function getDepartId()
    {
        return $this->depart_id;
    }

    /**
     * Set the value of [idempledos] column.
     *
     * @param int $v new value
     * @return $this|\Empleados The current object (for fluent API support)
     */
    public function setIdempledos($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->idempledos !== $v) {
            $this->idempledos = $v;
            $this->modifiedColumns[EmpleadosTableMap::COL_IDEMPLEDOS] = true;
        }

        return $this;
    } // setIdempledos()

    /**
     * Set the value of [nombre] column.
     *
     * @param string $v new value
     * @return $this|\Empleados The current object (for fluent API support)
     */
    public function setNombre($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->nombre !== $v) {
            $this->nombre = $v;
            $this->modifiedColumns[EmpleadosTableMap::COL_NOMBRE] = true;
        }

        return $this;
    } // setNombre()

    /**
     * Set the value of [ap_paterno] column.
     *
     * @param string $v new value
     * @return $this|\Empleados The current object (for fluent API support)
     */
    public function setApPaterno($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->ap_paterno !== $v) {
            $this->ap_paterno = $v;
            $this->modifiedColumns[EmpleadosTableMap::COL_AP_PATERNO] = true;
        }

        return $this;
    } // setApPaterno()

    /**
     * Set the value of [ap_materno] column.
     *
     * @param string $v new value
     * @return $this|\Empleados The current object (for fluent API support)
     */
    public function setApMaterno($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->ap_materno !== $v) {
            $this->ap_materno = $v;
            $this->modifiedColumns[EmpleadosTableMap::COL_AP_MATERNO] = true;
        }

        return $this;
    } // setApMaterno()

    /**
     * Set the value of [edad] column.
     *
     * @param int $v new value
     * @return $this|\Empleados The current object (for fluent API support)
     */
    public function setEdad($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->edad !== $v) {
            $this->edad = $v;
            $this->modifiedColumns[EmpleadosTableMap::COL_EDAD] = true;
        }

        return $this;
    } // setEdad()

    /**
     * Set the value of [sexo] column.
     *
     * @param string $v new value
     * @return $this|\Empleados The current object (for fluent API support)
     */
    public function setSexo($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->sexo !== $v) {
            $this->sexo = $v;
            $this->modifiedColumns[EmpleadosTableMap::COL_SEXO] = true;
        }

        return $this;
    } // setSexo()

    /**
     * Set the value of [numero_empleados] column.
     *
     * @param string $v new value
     * @return $this|\Empleados The current object (for fluent API support)
     */
    public function setNumeroEmpleados($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->numero_empleados !== $v) {
            $this->numero_empleados = $v;
            $this->modifiedColumns[EmpleadosTableMap::COL_NUMERO_EMPLEADOS] = true;
        }

        return $this;
    } // setNumeroEmpleados()

    /**
     * Set the value of [depart_id] column.
     *
     * @param int $v new value
     * @return $this|\Empleados The current object (for fluent API support)
     */
    public function setDepartId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->depart_id !== $v) {
            $this->depart_id = $v;
            $this->modifiedColumns[EmpleadosTableMap::COL_DEPART_ID] = true;
        }

        if ($this->aDepartamentos !== null && $this->aDepartamentos->getDepartid() !== $v) {
            $this->aDepartamentos = null;
        }

        return $this;
    } // setDepartId()

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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : EmpleadosTableMap::translateFieldName('Idempledos', TableMap::TYPE_PHPNAME, $indexType)];
            $this->idempledos = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : EmpleadosTableMap::translateFieldName('Nombre', TableMap::TYPE_PHPNAME, $indexType)];
            $this->nombre = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : EmpleadosTableMap::translateFieldName('ApPaterno', TableMap::TYPE_PHPNAME, $indexType)];
            $this->ap_paterno = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : EmpleadosTableMap::translateFieldName('ApMaterno', TableMap::TYPE_PHPNAME, $indexType)];
            $this->ap_materno = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : EmpleadosTableMap::translateFieldName('Edad', TableMap::TYPE_PHPNAME, $indexType)];
            $this->edad = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : EmpleadosTableMap::translateFieldName('Sexo', TableMap::TYPE_PHPNAME, $indexType)];
            $this->sexo = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : EmpleadosTableMap::translateFieldName('NumeroEmpleados', TableMap::TYPE_PHPNAME, $indexType)];
            $this->numero_empleados = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : EmpleadosTableMap::translateFieldName('DepartId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->depart_id = (null !== $col) ? (int) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 8; // 8 = EmpleadosTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Empleados'), 0, $e);
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
        if ($this->aDepartamentos !== null && $this->depart_id !== $this->aDepartamentos->getDepartid()) {
            $this->aDepartamentos = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(EmpleadosTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildEmpleadosQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aDepartamentos = null;
        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see Empleados::setDeleted()
     * @see Empleados::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(EmpleadosTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildEmpleadosQuery::create()
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

        if ($this->alreadyInSave) {
            return 0;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(EmpleadosTableMap::DATABASE_NAME);
        }

        return $con->transaction(function () use ($con) {
            $ret = $this->preSave($con);
            $isInsert = $this->isNew();
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
                EmpleadosTableMap::addInstanceToPool($this);
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

            if ($this->aDepartamentos !== null) {
                if ($this->aDepartamentos->isModified() || $this->aDepartamentos->isNew()) {
                    $affectedRows += $this->aDepartamentos->save($con);
                }
                $this->setDepartamentos($this->aDepartamentos);
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

        $this->modifiedColumns[EmpleadosTableMap::COL_IDEMPLEDOS] = true;
        if (null !== $this->idempledos) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . EmpleadosTableMap::COL_IDEMPLEDOS . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(EmpleadosTableMap::COL_IDEMPLEDOS)) {
            $modifiedColumns[':p' . $index++]  = 'idempledos';
        }
        if ($this->isColumnModified(EmpleadosTableMap::COL_NOMBRE)) {
            $modifiedColumns[':p' . $index++]  = 'nombre';
        }
        if ($this->isColumnModified(EmpleadosTableMap::COL_AP_PATERNO)) {
            $modifiedColumns[':p' . $index++]  = 'ap_paterno';
        }
        if ($this->isColumnModified(EmpleadosTableMap::COL_AP_MATERNO)) {
            $modifiedColumns[':p' . $index++]  = 'ap_materno';
        }
        if ($this->isColumnModified(EmpleadosTableMap::COL_EDAD)) {
            $modifiedColumns[':p' . $index++]  = 'edad';
        }
        if ($this->isColumnModified(EmpleadosTableMap::COL_SEXO)) {
            $modifiedColumns[':p' . $index++]  = 'sexo';
        }
        if ($this->isColumnModified(EmpleadosTableMap::COL_NUMERO_EMPLEADOS)) {
            $modifiedColumns[':p' . $index++]  = 'numero_empleados';
        }
        if ($this->isColumnModified(EmpleadosTableMap::COL_DEPART_ID)) {
            $modifiedColumns[':p' . $index++]  = 'depart_id';
        }

        $sql = sprintf(
            'INSERT INTO empleados (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'idempledos':
                        $stmt->bindValue($identifier, $this->idempledos, PDO::PARAM_INT);
                        break;
                    case 'nombre':
                        $stmt->bindValue($identifier, $this->nombre, PDO::PARAM_STR);
                        break;
                    case 'ap_paterno':
                        $stmt->bindValue($identifier, $this->ap_paterno, PDO::PARAM_STR);
                        break;
                    case 'ap_materno':
                        $stmt->bindValue($identifier, $this->ap_materno, PDO::PARAM_STR);
                        break;
                    case 'edad':
                        $stmt->bindValue($identifier, $this->edad, PDO::PARAM_INT);
                        break;
                    case 'sexo':
                        $stmt->bindValue($identifier, $this->sexo, PDO::PARAM_STR);
                        break;
                    case 'numero_empleados':
                        $stmt->bindValue($identifier, $this->numero_empleados, PDO::PARAM_STR);
                        break;
                    case 'depart_id':
                        $stmt->bindValue($identifier, $this->depart_id, PDO::PARAM_INT);
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
        $this->setIdempledos($pk);

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
        $pos = EmpleadosTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getIdempledos();
                break;
            case 1:
                return $this->getNombre();
                break;
            case 2:
                return $this->getApPaterno();
                break;
            case 3:
                return $this->getApMaterno();
                break;
            case 4:
                return $this->getEdad();
                break;
            case 5:
                return $this->getSexo();
                break;
            case 6:
                return $this->getNumeroEmpleados();
                break;
            case 7:
                return $this->getDepartId();
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

        if (isset($alreadyDumpedObjects['Empleados'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Empleados'][$this->hashCode()] = true;
        $keys = EmpleadosTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getIdempledos(),
            $keys[1] => $this->getNombre(),
            $keys[2] => $this->getApPaterno(),
            $keys[3] => $this->getApMaterno(),
            $keys[4] => $this->getEdad(),
            $keys[5] => $this->getSexo(),
            $keys[6] => $this->getNumeroEmpleados(),
            $keys[7] => $this->getDepartId(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aDepartamentos) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'departamentos';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'departamentos';
                        break;
                    default:
                        $key = 'Departamentos';
                }

                $result[$key] = $this->aDepartamentos->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
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
     * @return $this|\Empleados
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = EmpleadosTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\Empleados
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setIdempledos($value);
                break;
            case 1:
                $this->setNombre($value);
                break;
            case 2:
                $this->setApPaterno($value);
                break;
            case 3:
                $this->setApMaterno($value);
                break;
            case 4:
                $this->setEdad($value);
                break;
            case 5:
                $this->setSexo($value);
                break;
            case 6:
                $this->setNumeroEmpleados($value);
                break;
            case 7:
                $this->setDepartId($value);
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
        $keys = EmpleadosTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setIdempledos($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setNombre($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setApPaterno($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setApMaterno($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setEdad($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setSexo($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setNumeroEmpleados($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setDepartId($arr[$keys[7]]);
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
     * @return $this|\Empleados The current object, for fluid interface
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
        $criteria = new Criteria(EmpleadosTableMap::DATABASE_NAME);

        if ($this->isColumnModified(EmpleadosTableMap::COL_IDEMPLEDOS)) {
            $criteria->add(EmpleadosTableMap::COL_IDEMPLEDOS, $this->idempledos);
        }
        if ($this->isColumnModified(EmpleadosTableMap::COL_NOMBRE)) {
            $criteria->add(EmpleadosTableMap::COL_NOMBRE, $this->nombre);
        }
        if ($this->isColumnModified(EmpleadosTableMap::COL_AP_PATERNO)) {
            $criteria->add(EmpleadosTableMap::COL_AP_PATERNO, $this->ap_paterno);
        }
        if ($this->isColumnModified(EmpleadosTableMap::COL_AP_MATERNO)) {
            $criteria->add(EmpleadosTableMap::COL_AP_MATERNO, $this->ap_materno);
        }
        if ($this->isColumnModified(EmpleadosTableMap::COL_EDAD)) {
            $criteria->add(EmpleadosTableMap::COL_EDAD, $this->edad);
        }
        if ($this->isColumnModified(EmpleadosTableMap::COL_SEXO)) {
            $criteria->add(EmpleadosTableMap::COL_SEXO, $this->sexo);
        }
        if ($this->isColumnModified(EmpleadosTableMap::COL_NUMERO_EMPLEADOS)) {
            $criteria->add(EmpleadosTableMap::COL_NUMERO_EMPLEADOS, $this->numero_empleados);
        }
        if ($this->isColumnModified(EmpleadosTableMap::COL_DEPART_ID)) {
            $criteria->add(EmpleadosTableMap::COL_DEPART_ID, $this->depart_id);
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
        $criteria = ChildEmpleadosQuery::create();
        $criteria->add(EmpleadosTableMap::COL_IDEMPLEDOS, $this->idempledos);

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
        $validPk = null !== $this->getIdempledos();

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
        return $this->getIdempledos();
    }

    /**
     * Generic method to set the primary key (idempledos column).
     *
     * @param       int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setIdempledos($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {
        return null === $this->getIdempledos();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of \Empleados (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setNombre($this->getNombre());
        $copyObj->setApPaterno($this->getApPaterno());
        $copyObj->setApMaterno($this->getApMaterno());
        $copyObj->setEdad($this->getEdad());
        $copyObj->setSexo($this->getSexo());
        $copyObj->setNumeroEmpleados($this->getNumeroEmpleados());
        $copyObj->setDepartId($this->getDepartId());
        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setIdempledos(NULL); // this is a auto-increment column, so set to default value
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
     * @return \Empleados Clone of current object.
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
     * Declares an association between this object and a ChildDepartamentos object.
     *
     * @param  ChildDepartamentos $v
     * @return $this|\Empleados The current object (for fluent API support)
     * @throws PropelException
     */
    public function setDepartamentos(ChildDepartamentos $v = null)
    {
        if ($v === null) {
            $this->setDepartId(NULL);
        } else {
            $this->setDepartId($v->getDepartid());
        }

        $this->aDepartamentos = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildDepartamentos object, it will not be re-added.
        if ($v !== null) {
            $v->addEmpleados($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildDepartamentos object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildDepartamentos The associated ChildDepartamentos object.
     * @throws PropelException
     */
    public function getDepartamentos(ConnectionInterface $con = null)
    {
        if ($this->aDepartamentos === null && ($this->depart_id !== null)) {
            $this->aDepartamentos = ChildDepartamentosQuery::create()->findPk($this->depart_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aDepartamentos->addEmpleadoss($this);
             */
        }

        return $this->aDepartamentos;
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        if (null !== $this->aDepartamentos) {
            $this->aDepartamentos->removeEmpleados($this);
        }
        $this->idempledos = null;
        $this->nombre = null;
        $this->ap_paterno = null;
        $this->ap_materno = null;
        $this->edad = null;
        $this->sexo = null;
        $this->numero_empleados = null;
        $this->depart_id = null;
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
        } // if ($deep)

        $this->aDepartamentos = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(EmpleadosTableMap::DEFAULT_STRING_FORMAT);
    }

    /**
     * Code to be run before persisting the object
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preSave(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preSave')) {
            return parent::preSave($con);
        }
        return true;
    }

    /**
     * Code to be run after persisting the object
     * @param ConnectionInterface $con
     */
    public function postSave(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postSave')) {
            parent::postSave($con);
        }
    }

    /**
     * Code to be run before inserting to database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preInsert(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preInsert')) {
            return parent::preInsert($con);
        }
        return true;
    }

    /**
     * Code to be run after inserting to database
     * @param ConnectionInterface $con
     */
    public function postInsert(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postInsert')) {
            parent::postInsert($con);
        }
    }

    /**
     * Code to be run before updating the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preUpdate(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preUpdate')) {
            return parent::preUpdate($con);
        }
        return true;
    }

    /**
     * Code to be run after updating the object in database
     * @param ConnectionInterface $con
     */
    public function postUpdate(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postUpdate')) {
            parent::postUpdate($con);
        }
    }

    /**
     * Code to be run before deleting the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preDelete(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preDelete')) {
            return parent::preDelete($con);
        }
        return true;
    }

    /**
     * Code to be run after deleting the object in database
     * @param ConnectionInterface $con
     */
    public function postDelete(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postDelete')) {
            parent::postDelete($con);
        }
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
