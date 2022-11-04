<?php
namespace Database;

use \PDO;

class DbConnector {

    private $dbConnection = null;

    public function __construct()
    {
        $DB_FILE = __DIR__ . "/../db/sensor.sqlite";
        $DB_DSN = "sqlite:$DB_FILE";
        
        // Establish database connection.
        try
        {
            $this->dbConnection = new PDO($DB_DSN);
            $this->dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        }
        catch (PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function getConnection()
    {
        return $this->dbConnection;
    }
}