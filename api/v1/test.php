<?php 

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include "Database/DbGateway.php";
include "Database/DbConnector.php";

use Database\DbGateway;
use Database\DbConnector;

$dbh = (new DbConnector())->getConnection();

$dbConnection = new DbGateway($dbh);

print_r($dbConnection->findAll());