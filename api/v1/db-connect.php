<?php

// DB Settings
$DB_FILE = __DIR__ . "/db/sensor.sqlite";
$DB_DSN = "sqlite:$DB_FILE";

// Establish database connection.
try
{
    $dbh = new PDO($DB_DSN);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e)
{
    exit("Error: " . $e->getMessage());
}

?>