<?php 

require_once ('connection.php');

class Agendamento{
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

    
    public function insert($cliente, $telefone, $servico, $agendamento, $horario)
    {
        try
        {
            $sql = "INSERT INTO agendamento (cliente, telefone, idServico, agendamentoData, horario) VALUES (:cliente, :telefone, :idServico, :agendamentoData, :horario)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':cliente', $cliente);
            $stmt->bindParam(':telefone', $telefone);
            $stmt->bindParam(':idServico', $servico);
            $stmt->bindParam(':agendamentoData', $agendamento);
            $stmt->bindParam(':horario', $horario);
            $stmt->execute();

            return $stmt;
        }
        catch (PDOException $ex)
        {
            echo $ex->getMessage();
        }
    }
    
    public function read()
    {
        try
        {
            $sql = "SELECT id as 'Id', nome as 'Nome' from servicos";
            $stmt = $this->conn->prepare($sql);
            
            return $stmt;
        }
        catch (PDOException $ex)
        {
            echo $ex->getMessage();
        }
    }

    public function update($cliente, $telefone, $agendamentoData, $horario, $id)
    {
        try
        {
            $sql = "UPDATE agendamento SET cliente = :cliente, telefone = :telefone, agendamentoData = :agendamentoData, horario = :horario WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':cliente', $cliente);
            $stmt->bindParam(':telefone', $telefone);
            $stmt->bindParam(':agendamentoData', $agendamentoData);
            $stmt->bindParam(':horario', $horario);
            $stmt->bindParam(":id", $id);
            $stmt->execute();

            return $stmt;
        }
        catch (PDOException $ex)
        {
            echo $ex->getMessage();
        }
    }

    public function delete($id)
    {
        try
        {
            $sql = "DELETE FROM agendamento WHERE id = :id";
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