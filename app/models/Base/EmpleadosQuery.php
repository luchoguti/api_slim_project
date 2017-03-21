<?php

namespace Base;

use \Empleados as ChildEmpleados;
use \EmpleadosQuery as ChildEmpleadosQuery;
use \Exception;
use \PDO;
use Map\EmpleadosTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'empleados' table.
 *
 *
 *
 * @method     ChildEmpleadosQuery orderByIdempledos($order = Criteria::ASC) Order by the idempledos column
 * @method     ChildEmpleadosQuery orderByNombre($order = Criteria::ASC) Order by the nombre column
 * @method     ChildEmpleadosQuery orderByApPaterno($order = Criteria::ASC) Order by the ap_paterno column
 * @method     ChildEmpleadosQuery orderByApMaterno($order = Criteria::ASC) Order by the ap_materno column
 * @method     ChildEmpleadosQuery orderByEdad($order = Criteria::ASC) Order by the edad column
 * @method     ChildEmpleadosQuery orderBySexo($order = Criteria::ASC) Order by the sexo column
 * @method     ChildEmpleadosQuery orderByNumeroEmpleados($order = Criteria::ASC) Order by the numero_empleados column
 * @method     ChildEmpleadosQuery orderByDepartId($order = Criteria::ASC) Order by the depart_id column
 *
 * @method     ChildEmpleadosQuery groupByIdempledos() Group by the idempledos column
 * @method     ChildEmpleadosQuery groupByNombre() Group by the nombre column
 * @method     ChildEmpleadosQuery groupByApPaterno() Group by the ap_paterno column
 * @method     ChildEmpleadosQuery groupByApMaterno() Group by the ap_materno column
 * @method     ChildEmpleadosQuery groupByEdad() Group by the edad column
 * @method     ChildEmpleadosQuery groupBySexo() Group by the sexo column
 * @method     ChildEmpleadosQuery groupByNumeroEmpleados() Group by the numero_empleados column
 * @method     ChildEmpleadosQuery groupByDepartId() Group by the depart_id column
 *
 * @method     ChildEmpleadosQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildEmpleadosQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildEmpleadosQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildEmpleadosQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildEmpleadosQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildEmpleadosQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildEmpleadosQuery leftJoinDepartamentos($relationAlias = null) Adds a LEFT JOIN clause to the query using the Departamentos relation
 * @method     ChildEmpleadosQuery rightJoinDepartamentos($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Departamentos relation
 * @method     ChildEmpleadosQuery innerJoinDepartamentos($relationAlias = null) Adds a INNER JOIN clause to the query using the Departamentos relation
 *
 * @method     ChildEmpleadosQuery joinWithDepartamentos($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Departamentos relation
 *
 * @method     ChildEmpleadosQuery leftJoinWithDepartamentos() Adds a LEFT JOIN clause and with to the query using the Departamentos relation
 * @method     ChildEmpleadosQuery rightJoinWithDepartamentos() Adds a RIGHT JOIN clause and with to the query using the Departamentos relation
 * @method     ChildEmpleadosQuery innerJoinWithDepartamentos() Adds a INNER JOIN clause and with to the query using the Departamentos relation
 *
 * @method     \DepartamentosQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildEmpleados findOne(ConnectionInterface $con = null) Return the first ChildEmpleados matching the query
 * @method     ChildEmpleados findOneOrCreate(ConnectionInterface $con = null) Return the first ChildEmpleados matching the query, or a new ChildEmpleados object populated from the query conditions when no match is found
 *
 * @method     ChildEmpleados findOneByIdempledos(int $idempledos) Return the first ChildEmpleados filtered by the idempledos column
 * @method     ChildEmpleados findOneByNombre(string $nombre) Return the first ChildEmpleados filtered by the nombre column
 * @method     ChildEmpleados findOneByApPaterno(string $ap_paterno) Return the first ChildEmpleados filtered by the ap_paterno column
 * @method     ChildEmpleados findOneByApMaterno(string $ap_materno) Return the first ChildEmpleados filtered by the ap_materno column
 * @method     ChildEmpleados findOneByEdad(int $edad) Return the first ChildEmpleados filtered by the edad column
 * @method     ChildEmpleados findOneBySexo(string $sexo) Return the first ChildEmpleados filtered by the sexo column
 * @method     ChildEmpleados findOneByNumeroEmpleados(string $numero_empleados) Return the first ChildEmpleados filtered by the numero_empleados column
 * @method     ChildEmpleados findOneByDepartId(int $depart_id) Return the first ChildEmpleados filtered by the depart_id column *

 * @method     ChildEmpleados requirePk($key, ConnectionInterface $con = null) Return the ChildEmpleados by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmpleados requireOne(ConnectionInterface $con = null) Return the first ChildEmpleados matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildEmpleados requireOneByIdempledos(int $idempledos) Return the first ChildEmpleados filtered by the idempledos column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmpleados requireOneByNombre(string $nombre) Return the first ChildEmpleados filtered by the nombre column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmpleados requireOneByApPaterno(string $ap_paterno) Return the first ChildEmpleados filtered by the ap_paterno column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmpleados requireOneByApMaterno(string $ap_materno) Return the first ChildEmpleados filtered by the ap_materno column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmpleados requireOneByEdad(int $edad) Return the first ChildEmpleados filtered by the edad column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmpleados requireOneBySexo(string $sexo) Return the first ChildEmpleados filtered by the sexo column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmpleados requireOneByNumeroEmpleados(string $numero_empleados) Return the first ChildEmpleados filtered by the numero_empleados column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildEmpleados requireOneByDepartId(int $depart_id) Return the first ChildEmpleados filtered by the depart_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildEmpleados[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildEmpleados objects based on current ModelCriteria
 * @method     ChildEmpleados[]|ObjectCollection findByIdempledos(int $idempledos) Return ChildEmpleados objects filtered by the idempledos column
 * @method     ChildEmpleados[]|ObjectCollection findByNombre(string $nombre) Return ChildEmpleados objects filtered by the nombre column
 * @method     ChildEmpleados[]|ObjectCollection findByApPaterno(string $ap_paterno) Return ChildEmpleados objects filtered by the ap_paterno column
 * @method     ChildEmpleados[]|ObjectCollection findByApMaterno(string $ap_materno) Return ChildEmpleados objects filtered by the ap_materno column
 * @method     ChildEmpleados[]|ObjectCollection findByEdad(int $edad) Return ChildEmpleados objects filtered by the edad column
 * @method     ChildEmpleados[]|ObjectCollection findBySexo(string $sexo) Return ChildEmpleados objects filtered by the sexo column
 * @method     ChildEmpleados[]|ObjectCollection findByNumeroEmpleados(string $numero_empleados) Return ChildEmpleados objects filtered by the numero_empleados column
 * @method     ChildEmpleados[]|ObjectCollection findByDepartId(int $depart_id) Return ChildEmpleados objects filtered by the depart_id column
 * @method     ChildEmpleados[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class EmpleadosQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\EmpleadosQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Empleados', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildEmpleadosQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildEmpleadosQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildEmpleadosQuery) {
            return $criteria;
        }
        $query = new ChildEmpleadosQuery();
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
     * @return ChildEmpleados|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(EmpleadosTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = EmpleadosTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
            // the object is already in the instance pool
            return $obj;
        }

        return $this->findPkSimple($key, $con);
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
     * @return ChildEmpleados A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT idempledos, nombre, ap_paterno, ap_materno, edad, sexo, numero_empleados, depart_id FROM empleados WHERE idempledos = :p0';
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
            /** @var ChildEmpleados $obj */
            $obj = new ChildEmpleados();
            $obj->hydrate($row);
            EmpleadosTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildEmpleados|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildEmpleadosQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(EmpleadosTableMap::COL_IDEMPLEDOS, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildEmpleadosQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(EmpleadosTableMap::COL_IDEMPLEDOS, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the idempledos column
     *
     * Example usage:
     * <code>
     * $query->filterByIdempledos(1234); // WHERE idempledos = 1234
     * $query->filterByIdempledos(array(12, 34)); // WHERE idempledos IN (12, 34)
     * $query->filterByIdempledos(array('min' => 12)); // WHERE idempledos > 12
     * </code>
     *
     * @param     mixed $idempledos The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEmpleadosQuery The current query, for fluid interface
     */
    public function filterByIdempledos($idempledos = null, $comparison = null)
    {
        if (is_array($idempledos)) {
            $useMinMax = false;
            if (isset($idempledos['min'])) {
                $this->addUsingAlias(EmpleadosTableMap::COL_IDEMPLEDOS, $idempledos['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idempledos['max'])) {
                $this->addUsingAlias(EmpleadosTableMap::COL_IDEMPLEDOS, $idempledos['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EmpleadosTableMap::COL_IDEMPLEDOS, $idempledos, $comparison);
    }

    /**
     * Filter the query on the nombre column
     *
     * Example usage:
     * <code>
     * $query->filterByNombre('fooValue');   // WHERE nombre = 'fooValue'
     * $query->filterByNombre('%fooValue%', Criteria::LIKE); // WHERE nombre LIKE '%fooValue%'
     * </code>
     *
     * @param     string $nombre The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEmpleadosQuery The current query, for fluid interface
     */
    public function filterByNombre($nombre = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($nombre)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EmpleadosTableMap::COL_NOMBRE, $nombre, $comparison);
    }

    /**
     * Filter the query on the ap_paterno column
     *
     * Example usage:
     * <code>
     * $query->filterByApPaterno('fooValue');   // WHERE ap_paterno = 'fooValue'
     * $query->filterByApPaterno('%fooValue%', Criteria::LIKE); // WHERE ap_paterno LIKE '%fooValue%'
     * </code>
     *
     * @param     string $apPaterno The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEmpleadosQuery The current query, for fluid interface
     */
    public function filterByApPaterno($apPaterno = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($apPaterno)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EmpleadosTableMap::COL_AP_PATERNO, $apPaterno, $comparison);
    }

    /**
     * Filter the query on the ap_materno column
     *
     * Example usage:
     * <code>
     * $query->filterByApMaterno('fooValue');   // WHERE ap_materno = 'fooValue'
     * $query->filterByApMaterno('%fooValue%', Criteria::LIKE); // WHERE ap_materno LIKE '%fooValue%'
     * </code>
     *
     * @param     string $apMaterno The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEmpleadosQuery The current query, for fluid interface
     */
    public function filterByApMaterno($apMaterno = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($apMaterno)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EmpleadosTableMap::COL_AP_MATERNO, $apMaterno, $comparison);
    }

    /**
     * Filter the query on the edad column
     *
     * Example usage:
     * <code>
     * $query->filterByEdad(1234); // WHERE edad = 1234
     * $query->filterByEdad(array(12, 34)); // WHERE edad IN (12, 34)
     * $query->filterByEdad(array('min' => 12)); // WHERE edad > 12
     * </code>
     *
     * @param     mixed $edad The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEmpleadosQuery The current query, for fluid interface
     */
    public function filterByEdad($edad = null, $comparison = null)
    {
        if (is_array($edad)) {
            $useMinMax = false;
            if (isset($edad['min'])) {
                $this->addUsingAlias(EmpleadosTableMap::COL_EDAD, $edad['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($edad['max'])) {
                $this->addUsingAlias(EmpleadosTableMap::COL_EDAD, $edad['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EmpleadosTableMap::COL_EDAD, $edad, $comparison);
    }

    /**
     * Filter the query on the sexo column
     *
     * Example usage:
     * <code>
     * $query->filterBySexo('fooValue');   // WHERE sexo = 'fooValue'
     * $query->filterBySexo('%fooValue%', Criteria::LIKE); // WHERE sexo LIKE '%fooValue%'
     * </code>
     *
     * @param     string $sexo The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEmpleadosQuery The current query, for fluid interface
     */
    public function filterBySexo($sexo = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($sexo)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EmpleadosTableMap::COL_SEXO, $sexo, $comparison);
    }

    /**
     * Filter the query on the numero_empleados column
     *
     * Example usage:
     * <code>
     * $query->filterByNumeroEmpleados('fooValue');   // WHERE numero_empleados = 'fooValue'
     * $query->filterByNumeroEmpleados('%fooValue%', Criteria::LIKE); // WHERE numero_empleados LIKE '%fooValue%'
     * </code>
     *
     * @param     string $numeroEmpleados The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEmpleadosQuery The current query, for fluid interface
     */
    public function filterByNumeroEmpleados($numeroEmpleados = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($numeroEmpleados)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EmpleadosTableMap::COL_NUMERO_EMPLEADOS, $numeroEmpleados, $comparison);
    }

    /**
     * Filter the query on the depart_id column
     *
     * Example usage:
     * <code>
     * $query->filterByDepartId(1234); // WHERE depart_id = 1234
     * $query->filterByDepartId(array(12, 34)); // WHERE depart_id IN (12, 34)
     * $query->filterByDepartId(array('min' => 12)); // WHERE depart_id > 12
     * </code>
     *
     * @see       filterByDepartamentos()
     *
     * @param     mixed $departId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildEmpleadosQuery The current query, for fluid interface
     */
    public function filterByDepartId($departId = null, $comparison = null)
    {
        if (is_array($departId)) {
            $useMinMax = false;
            if (isset($departId['min'])) {
                $this->addUsingAlias(EmpleadosTableMap::COL_DEPART_ID, $departId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($departId['max'])) {
                $this->addUsingAlias(EmpleadosTableMap::COL_DEPART_ID, $departId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(EmpleadosTableMap::COL_DEPART_ID, $departId, $comparison);
    }

    /**
     * Filter the query by a related \Departamentos object
     *
     * @param \Departamentos|ObjectCollection $departamentos The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildEmpleadosQuery The current query, for fluid interface
     */
    public function filterByDepartamentos($departamentos, $comparison = null)
    {
        if ($departamentos instanceof \Departamentos) {
            return $this
                ->addUsingAlias(EmpleadosTableMap::COL_DEPART_ID, $departamentos->getDepartid(), $comparison);
        } elseif ($departamentos instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(EmpleadosTableMap::COL_DEPART_ID, $departamentos->toKeyValue('PrimaryKey', 'Departid'), $comparison);
        } else {
            throw new PropelException('filterByDepartamentos() only accepts arguments of type \Departamentos or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Departamentos relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildEmpleadosQuery The current query, for fluid interface
     */
    public function joinDepartamentos($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Departamentos');

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
            $this->addJoinObject($join, 'Departamentos');
        }

        return $this;
    }

    /**
     * Use the Departamentos relation Departamentos object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \DepartamentosQuery A secondary query class using the current class as primary query
     */
    public function useDepartamentosQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinDepartamentos($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Departamentos', '\DepartamentosQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildEmpleados $empleados Object to remove from the list of results
     *
     * @return $this|ChildEmpleadosQuery The current query, for fluid interface
     */
    public function prune($empleados = null)
    {
        if ($empleados) {
            $this->addUsingAlias(EmpleadosTableMap::COL_IDEMPLEDOS, $empleados->getIdempledos(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the empleados table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(EmpleadosTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            EmpleadosTableMap::clearInstancePool();
            EmpleadosTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(EmpleadosTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(EmpleadosTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            EmpleadosTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            EmpleadosTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // EmpleadosQuery
