<?php
namespace Ladecadanse\Manager;

use Doctrine\DBAL\Connection;

/**
 * Description of Manager
 *
 * @author michel
 */
abstract class Manager
{
    /**
     * Database connection
     *
     * @var \Doctrine\DBAL\Connection
     */
    protected $db;

    /**
     * Constructor
     *
     * @param \Doctrine\DBAL\Connection The database connection object
     */
    public function __construct(Connection $db) {
        $this->db = $db;
    }

    /**
     * Grants access to the database connection object
     *
     * @return \Doctrine\DBAL\Connection The database connection object
     */
    protected function getDb() {
        return $this->db;
    }

    /**
     * Builds a domain object from a DB row.
     * Must be overridden by child classes.
     */
    protected abstract function buildDomainObject(array $row);

}
