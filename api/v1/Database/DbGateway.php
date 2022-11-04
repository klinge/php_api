<?php
namespace Database;

class DbGateway {

    private $db = null;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function findAll()
    {
        $statement = "SELECT * FROM data;";

        try {
            $statement = $this->db->query($statement);
            $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
            return array('status' => "1", "data" => $result);
        } catch (\PDOException $e) {
            return array('status' => "0", "error" => $e->getMessage());
        }
    }

    public function findLast()
    {
        $statement = "SELECT * FROM data ORDER BY id DESC LIMIT 0,1;";

        try {
            $statement = $this->db->query($statement);
            $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
            return array('status' => "1", "data" => $result);
        } catch (\PDOException $e) {
            return array('status' => "0", "error" => $e->getMessage());
        }
    }

    public function find($id)
    {
        $statement = "SELECT * FROM data WHERE id = ?;";

        try {
            $statement = $this->db->prepare($statement);
            $statement->execute(array($id));
            $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
            return array('status' => "1", "data" => $result);
        } catch (\PDOException $e) {
            return array('status' => "0", "error" => $e->getMessage());
        }    
    }

    public function insert($input)
    {
        $statement = "
            INSERT INTO data (tank_level) VALUES (:tankLevel);
        ";

        try {
            $statement = $this->db->prepare($statement);
            $statement->bindValue(':tankLevel', $input);
            $statement->execute();
            
            if($statement->rowCount() != 0) {
                return array('status' => "1", "data" => $statement->rowCount() . " rows updated");
            } 
            else {
                return array('status' => "0", "error" => "Something went wrong. No rows updated");
            }
        } catch (\PDOException $e) {
            return array('status' => "0", "error" => $e->getMessage());
        }    
    }

}