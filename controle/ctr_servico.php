<?php 

    require_once '../modelo/servicoDAO.php';
    $objServicos = new Servicos();

    if(isset($_POST['insert']))
    {
        $nome = $_POST['txtNome'];
        if($objServicos->insert($nome))
        {
            $objServicos->redirect('../servicos.php');
        }
    }

    if(isset($_POST['editar']))
    {
        $nome = $_POST['txtNome'];
        $id = $_POST['txtID'];
        if($objServicos->update($nome, $id))
        {
            $objServicos->redirect("../servicos.php");
        }
    }
    
    if(isset($_POST['delete']))
    {
        $id = $_POST['txtId'];
        if($objServicos->delete($id))
        {
            $objServicos->redirect("../servicos.php");
        }
    }

    
