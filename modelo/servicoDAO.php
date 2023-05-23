<?php 

require_once 'connection.php';

class Servicos{
    private $conn;

    public function __construct()
    {   
        $dataBase = new dataBase();
        $this->conn = $dataBase->dbConnection();
    }

    public function runQuery($sql)
    {
        try
        {
            $stmt = $this->conn->prepare($sql);

            return $stmt;
        }
        catch(PDOException $ex)
        {
            echo $ex->getMessage();
        }
    }

    public function insert($nome)
    {
        try
        {
            $sql = "INSERT INTO servicos (nome) VALUES (:nome)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(":nome", $nome);
            $stmt->execute();

            return $stmt;
        }
        catch(PDOException $ex)
        {
            echo $ex->getMessage();
        }
    }

    public function read()
    {
        try
        {
            $sql = "SELECT * FROM servicos";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();

            return $stmt;
        }
        catch (PDOException $ex)
        {
            echo $ex->getMessage();
        }
    }

    public function update($nome, $id)
    {
        try
        {
            $sql = "UPDATE servicos SET nome = :nome WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(":nome", $nome);
            $stmt->bindParam(":id", $id);
            $stmt->execute();

            return $stmt;
        }
        catch(PDOException $ex)
        {
            echo $ex->getMessage();
        }
    }

    public function delete($id)
    {
        try
        {
            $sql = "DELETE FROM servicos WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(":id", $id);
            $stmt->execute();

            return $stmt;
        }
        catch(PDOException $ex)
        {
            echo $ex->getMessage();
        }
    }

    public function redirect($url)
    {  
        header("Location: $url");
    }
}