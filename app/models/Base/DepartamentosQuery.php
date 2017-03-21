<?php

namespace Base;

use \Departamentos as ChildDepartamentos;
use \DepartamentosQuery as ChildDepartamentosQuery;
use \Exception;
use \PDO;
use Map\DepartamentosTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'departamentos' table.
 *
 *
 *
 * @method     ChildDepartamentosQuery orderByDepartid($order = Criteria::ASC) Order by the departid column
 * @method     ChildDepartamentosQuery orderByDescripcion($order = Criteria::ASC) Order by the descripcion column
 *
 * @method     ChildDepartamentosQuery groupByDepartid() Group by the departid column
 * @method     ChildDepartamentosQuery groupByDescripcion() Group by the descripcion column
 *
 * @method     ChildDepartamentosQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildDepartamentosQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildDepartamentosQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildDepartamentosQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildDepartamentosQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildDepartamentosQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildDepartamentosQuery leftJoinEmpleados($relationAlias = null) Adds a LEFT JOIN clause to the query using the Empleados relation
 * @method     ChildDepartamentosQuery rightJoinEmpleados($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Empleados relation
 * @method     ChildDepartamentosQuery innerJoinEmpleados($relationAlias = null) Adds a INNER JOIN clause to the query using the Empleados relation
 *
 * @method     ChildDepartamentosQuery joinWithEmpleados($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Empleados relation
 *
 * @method     ChildDepartamentosQuery leftJoinWithEmpleados() Adds a LEFT JOIN clause and with to the query using the Empleados relation
 * @method     ChildDepartamentosQuery rightJoinWithEmpleados() Adds a RIGHT JOIN clause and with to the query using the Empleados relation
 * @method     ChildDepartamentosQuery innerJoinWithEmpleados() Adds a INNER JOIN clause and with to the query using the Empleados relation
 *
 * @method     \EmpleadosQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildDepartamentos findOne(ConnectionInterface $con = null) Return the first ChildDepartamentos matching the query
 * @method     ChildDepartamentos findOneOrCreate(ConnectionInterface $con = null) Return the first ChildDepartamentos matching the query, or a new ChildDepartamentos object populated from the query conditions when no match is found
 *
 * @method     ChildDepartamentos findOneByDepartid(int $departid) Return the first ChildDepartamentos filtered by the departid column
 * @method     ChildDepartamentos findOneByDescripcion(string $descripcion) Return the first ChildDepartamentos filtered by the descripcion column *

 * @method     ChildDepartamentos requirePk($key, ConnectionInterface $con = null) Return the ChildDepartamentos by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDepartamentos requireOne(ConnectionInterface $con = null) Return the first ChildDepartamentos matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildDepartamentos requireOneByDepartid(int $departid) Return the first ChildDepartamentos filtered by the departid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDepartamentos requireOneByDescripcion(string $descripcion) Return the first ChildDepartamentos filtered by the descripcion column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildDepartamentos[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildDepartamentos objects based on current ModelCriteria
 * @method     ChildDepartamentos[]|ObjectCollection findByDepartid(int $departid) Return ChildDepartamentos objects filtered by the departid column
 * @method     ChildDepartamentos[]|ObjectCollection findByDescripcion(string $descripcion) Return ChildDepartamentos objects filtered by the descripcion column
 * @method     ChildDepartamentos[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class DepartamentosQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\DepartamentosQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Departamentos', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildDepartamentosQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildDepartamentosQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildDepartamentosQuery) {
            return $criteria;
        }
        $query = new ChildDepartamentosQuery();
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
     * @return ChildDepartamentos|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(DepartamentosTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = DepartamentosTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildDepartamentos A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT departid, descripcion FROM departamentos WHERE departid = :p0';
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
            /** @var ChildDepartamentos $obj */
            $obj = new ChildDepartamentos();
            $obj->hydrate($row);
            DepartamentosTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildDepartamentos|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildDepartamentosQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(DepartamentosTableMap::COL_DEPARTID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildDepartamentosQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(DepartamentosTableMap::COL_DEPARTID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the departid column
     *
     * Example usage:
     * <code>
     * $query->filterByDepartid(1234); // WHERE departid = 1234
     * $query->filterByDepartid(array(12, 34)); // WHERE departid IN (12, 34)
     * $query->filterByDepartid(array('min' => 12)); // WHERE departid > 12
     * </code>
     *
     * @param     mixed $departid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildDepartamentosQuery The current query, for fluid interface
     */
    public function filterByDepartid($departid = null, $comparison = null)
    {
        if (is_array($departid)) {
            $useMinMax = false;
            if (isset($departid['min'])) {
                $this->addUsingAlias(DepartamentosTableMap::COL_DEPARTID, $departid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($departid['max'])) {
                $this->addUsingAlias(DepartamentosTableMap::COL_DEPARTID, $departid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DepartamentosTableMap::COL_DEPARTID, $departid, $comparison);
    }

    /**
     * Filter the query on the descripcion column
     *
     * Example usage:
     * <code>
     * $query->filterByDescripcion('fooValue');   // WHERE descripcion = 'fooValue'
     * $query->filterByDescripcion('%fooValue%', Criteria::LIKE); // WHERE descripcion LIKE '%fooValue%'
     * </code>
     *
     * @param     string $descripcion The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildDepartamentosQuery The current query, for fluid interface
     */
    public function filterByDescripcion($descripcion = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($descripcion)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DepartamentosTableMap::COL_DESCRIPCION, $descripcion, $comparison);
    }

    /**
     * Filter the query by a related \Empleados object
     *
     * @param \Empleados|ObjectCollection $empleados the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildDepartamentosQuery The current query, for fluid interface
     */
    public function filterByEmpleados($empleados, $comparison = null)
    {
        if ($empleados instanceof \Empleados) {
            return $this
                ->addUsingAlias(DepartamentosTableMap::COL_DEPARTID, $empleados->getDepartId(), $comparison);
        } elseif ($empleados instanceof ObjectCollection) {
            return $this
                ->useEmpleadosQuery()
                ->filterByPrimaryKeys($empleados->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByEmpleados() only accepts arguments of type \Empleados or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Empleados relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildDepartamentosQuery The current query, for fluid interface
     */
    public function joinEmpleados($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Empleados');

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
            $this->addJoinObject($join, 'Empleados');
        }

        return $this;
    }

    /**
     * Use the Empleados relation Empleados object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \EmpleadosQuery A secondary query class using the current class as primary query
     */
    public function useEmpleadosQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinEmpleados($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Empleados', '\EmpleadosQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildDepartamentos $departamentos Object to remove from the list of results
     *
     * @return $this|ChildDepartamentosQuery The current query, for fluid interface
     */
    public function prune($departamentos = null)
    {
        if ($departamentos) {
            $this->addUsingAlias(DepartamentosTableMap::COL_DEPARTID, $departamentos->getDepartid(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the departamentos table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(DepartamentosTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            DepartamentosTableMap::clearInstancePool();
            DepartamentosTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(DepartamentosTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(DepartamentosTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            DepartamentosTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            DepartamentosTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // DepartamentosQuery
