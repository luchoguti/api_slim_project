<?php

namespace Map;

use \Empleados;
use \EmpleadosQuery;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\InstancePoolTrait;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\DataFetcher\DataFetcherInterface;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\RelationMap;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Map\TableMapTrait;


/**
 * This class defines the structure of the 'empleados' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class EmpleadosTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.EmpleadosTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'empleados';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\Empleados';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'Empleados';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 8;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 8;

    /**
     * the column name for the idempledos field
     */
    const COL_IDEMPLEDOS = 'empleados.idempledos';

    /**
     * the column name for the nombre field
     */
    const COL_NOMBRE = 'empleados.nombre';

    /**
     * the column name for the ap_paterno field
     */
    const COL_AP_PATERNO = 'empleados.ap_paterno';

    /**
     * the column name for the ap_materno field
     */
    const COL_AP_MATERNO = 'empleados.ap_materno';

    /**
     * the column name for the edad field
     */
    const COL_EDAD = 'empleados.edad';

    /**
     * the column name for the sexo field
     */
    const COL_SEXO = 'empleados.sexo';

    /**
     * the column name for the numero_empleados field
     */
    const COL_NUMERO_EMPLEADOS = 'empleados.numero_empleados';

    /**
     * the column name for the depart_id field
     */
    const COL_DEPART_ID = 'empleados.depart_id';

    /**
     * The default string format for model objects of the related table
     */
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        self::TYPE_PHPNAME       => array('Idempledos', 'Nombre', 'ApPaterno', 'ApMaterno', 'Edad', 'Sexo', 'NumeroEmpleados', 'DepartId', ),
        self::TYPE_CAMELNAME     => array('idempledos', 'nombre', 'apPaterno', 'apMaterno', 'edad', 'sexo', 'numeroEmpleados', 'departId', ),
        self::TYPE_COLNAME       => array(EmpleadosTableMap::COL_IDEMPLEDOS, EmpleadosTableMap::COL_NOMBRE, EmpleadosTableMap::COL_AP_PATERNO, EmpleadosTableMap::COL_AP_MATERNO, EmpleadosTableMap::COL_EDAD, EmpleadosTableMap::COL_SEXO, EmpleadosTableMap::COL_NUMERO_EMPLEADOS, EmpleadosTableMap::COL_DEPART_ID, ),
        self::TYPE_FIELDNAME     => array('idempledos', 'nombre', 'ap_paterno', 'ap_materno', 'edad', 'sexo', 'numero_empleados', 'depart_id', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Idempledos' => 0, 'Nombre' => 1, 'ApPaterno' => 2, 'ApMaterno' => 3, 'Edad' => 4, 'Sexo' => 5, 'NumeroEmpleados' => 6, 'DepartId' => 7, ),
        self::TYPE_CAMELNAME     => array('idempledos' => 0, 'nombre' => 1, 'apPaterno' => 2, 'apMaterno' => 3, 'edad' => 4, 'sexo' => 5, 'numeroEmpleados' => 6, 'departId' => 7, ),
        self::TYPE_COLNAME       => array(EmpleadosTableMap::COL_IDEMPLEDOS => 0, EmpleadosTableMap::COL_NOMBRE => 1, EmpleadosTableMap::COL_AP_PATERNO => 2, EmpleadosTableMap::COL_AP_MATERNO => 3, EmpleadosTableMap::COL_EDAD => 4, EmpleadosTableMap::COL_SEXO => 5, EmpleadosTableMap::COL_NUMERO_EMPLEADOS => 6, EmpleadosTableMap::COL_DEPART_ID => 7, ),
        self::TYPE_FIELDNAME     => array('idempledos' => 0, 'nombre' => 1, 'ap_paterno' => 2, 'ap_materno' => 3, 'edad' => 4, 'sexo' => 5, 'numero_empleados' => 6, 'depart_id' => 7, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, )
    );

    /**
     * Initialize the table attributes and columns
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('empleados');
        $this->setPhpName('Empleados');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Empleados');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('idempledos', 'Idempledos', 'INTEGER', true, null, null);
        $this->addColumn('nombre', 'Nombre', 'VARCHAR', true, 45, null);
        $this->addColumn('ap_paterno', 'ApPaterno', 'VARCHAR', true, 45, null);
        $this->addColumn('ap_materno', 'ApMaterno', 'VARCHAR', true, 45, null);
        $this->addColumn('edad', 'Edad', 'INTEGER', false, null, null);
        $this->addColumn('sexo', 'Sexo', 'VARCHAR', false, 45, null);
        $this->addColumn('numero_empleados', 'NumeroEmpleados', 'VARCHAR', false, 45, null);
        $this->addForeignKey('depart_id', 'DepartId', 'INTEGER', 'departamentos', 'departid', true, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Departamentos', '\\Departamentos', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':depart_id',
    1 => ':departid',
  ),
), null, null, null, false);
    } // buildRelations()

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return string The primary key hash of the row
     */
    public static function getPrimaryKeyHashFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        // If the PK cannot be derived from the row, return NULL.
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Idempledos', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Idempledos', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Idempledos', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Idempledos', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Idempledos', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Idempledos', TableMap::TYPE_PHPNAME, $indexType)];
    }

    /**
     * Retrieves the primary key from the DB resultset row
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, an array of the primary key columns will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        return (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('Idempledos', TableMap::TYPE_PHPNAME, $indexType)
        ];
    }

    /**
     * The class that the tableMap will make instances of.
     *
     * If $withPrefix is true, the returned path
     * uses a dot-path notation which is translated into a path
     * relative to a location on the PHP include_path.
     * (e.g. path.to.MyClass -> 'path/to/MyClass.php')
     *
     * @param boolean $withPrefix Whether or not to return the path with the class name
     * @return string path.to.ClassName
     */
    public static function getOMClass($withPrefix = true)
    {
        return $withPrefix ? EmpleadosTableMap::CLASS_DEFAULT : EmpleadosTableMap::OM_CLASS;
    }

    /**
     * Populates an object of the default type or an object that inherit from the default.
     *
     * @param array  $row       row returned by DataFetcher->fetch().
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                 One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return array           (Empleados object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = EmpleadosTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = EmpleadosTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + EmpleadosTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = EmpleadosTableMap::OM_CLASS;
            /** @var Empleados $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            EmpleadosTableMap::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }

    /**
     * The returned array will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @param DataFetcherInterface $dataFetcher
     * @return array
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function populateObjects(DataFetcherInterface $dataFetcher)
    {
        $results = array();

        // set the class once to avoid overhead in the loop
        $cls = static::getOMClass(false);
        // populate the object(s)
        while ($row = $dataFetcher->fetch()) {
            $key = EmpleadosTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = EmpleadosTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Empleados $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                EmpleadosTableMap::addInstanceToPool($obj, $key);
            } // if key exists
        }

        return $results;
    }
    /**
     * Add all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be added to the select list and only loaded
     * on demand.
     *
     * @param Criteria $criteria object containing the columns to add.
     * @param string   $alias    optional table alias
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function addSelectColumns(Criteria $criteria, $alias = null)
    {
        if (null === $alias) {
            $criteria->addSelectColumn(EmpleadosTableMap::COL_IDEMPLEDOS);
            $criteria->addSelectColumn(EmpleadosTableMap::COL_NOMBRE);
            $criteria->addSelectColumn(EmpleadosTableMap::COL_AP_PATERNO);
            $criteria->addSelectColumn(EmpleadosTableMap::COL_AP_MATERNO);
            $criteria->addSelectColumn(EmpleadosTableMap::COL_EDAD);
            $criteria->addSelectColumn(EmpleadosTableMap::COL_SEXO);
            $criteria->addSelectColumn(EmpleadosTableMap::COL_NUMERO_EMPLEADOS);
            $criteria->addSelectColumn(EmpleadosTableMap::COL_DEPART_ID);
        } else {
            $criteria->addSelectColumn($alias . '.idempledos');
            $criteria->addSelectColumn($alias . '.nombre');
            $criteria->addSelectColumn($alias . '.ap_paterno');
            $criteria->addSelectColumn($alias . '.ap_materno');
            $criteria->addSelectColumn($alias . '.edad');
            $criteria->addSelectColumn($alias . '.sexo');
            $criteria->addSelectColumn($alias . '.numero_empleados');
            $criteria->addSelectColumn($alias . '.depart_id');
        }
    }

    /**
     * Returns the TableMap related to this object.
     * This method is not needed for general use but a specific application could have a need.
     * @return TableMap
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function getTableMap()
    {
        return Propel::getServiceContainer()->getDatabaseMap(EmpleadosTableMap::DATABASE_NAME)->getTable(EmpleadosTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(EmpleadosTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(EmpleadosTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new EmpleadosTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Empleados or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Empleados object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param  ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
     public static function doDelete($values, ConnectionInterface $con = null)
     {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(EmpleadosTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Empleados) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(EmpleadosTableMap::DATABASE_NAME);
            $criteria->add(EmpleadosTableMap::COL_IDEMPLEDOS, (array) $values, Criteria::IN);
        }

        $query = EmpleadosQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            EmpleadosTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                EmpleadosTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the empleados table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return EmpleadosQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Empleados or Criteria object.
     *
     * @param mixed               $criteria Criteria or Empleados object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(EmpleadosTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Empleados object
        }

        if ($criteria->containsKey(EmpleadosTableMap::COL_IDEMPLEDOS) && $criteria->keyContainsValue(EmpleadosTableMap::COL_IDEMPLEDOS) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.EmpleadosTableMap::COL_IDEMPLEDOS.')');
        }


        // Set the correct dbName
        $query = EmpleadosQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // EmpleadosTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
EmpleadosTableMap::buildTableMap();
