<?php 

require_once '../modelo/agendamentoDAO.php';
$objAgendamentos = new Agendamento();

    if(isset($_POST['insert']))
    {
        $cliente = $_POST['txtNome'];
        $telefone = $_POST['txtTelefone'];
        $servico = $_POST['txtServico'];
        $agendamento = $_POST['txtData'];
        $horario = $_POST['txtHorario'];
        if($objAgendamentos->insert($cliente, $telefone, $servico, $agendamento, $horario))
        {
            $objAgendamentos->redirect('../novo-agendamento.php');
        }
    }

    if(isset($_POST['update']))
    {
        $cliente = $_POST['txtNome'];
        $telefone = $_POST['txtTelefone'];
        $agendamento = $_POST['txtData'];
        $horario = $_POST['txtHorario'];
        $id = $_POST['txtId'];
        if($objAgendamentos->update($cliente, $telefone, $agendamento, $horario, $id))
        {
            $objAgendamentos->redirect('../lista-agendamentos.php');
        }
    }

    if(isset($_POST['delete']))
    {
        $id = $_POST['txtId'];
        if($objAgendamentos->delete($id))
        {
            $objAgendamentos->redirect('../lista-agendamentos.php');
        }
    }
    
    if(isset($_POST['filter']))
    {
        $dataFiltro = $_POST['txtDateChooser'];
        if($objAgendamentos->filter($dataFiltro))
        {
            $objAgendamentos->redirect('../lista-agendamentos.php');
        }
    }



