<?php 
        
class dataBase{
    private $userName = "root";
    private $senha = "";
    public $connexao;
    
    public function dbConnection(){
        $this->connexao = null;
        try{
            $this->connexao = new PDO('mysql:host=localhost; dbname=gestaomdc_db;',$this->userName, $this->senha);
            $this->connexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Conectado";
        }catch(PDOException $e){
            echo $e->getMessage();
        }
        return $this->connexao;
    }
}