<?php 

require_once './modelo/agendamentoDAO.php';
$objAgendamentos = new Agendamento();

require_once './modelo/servicoDAO.php';
$objServicos = new Servicos();

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include './bs4.php' ?>
    <title>Lista Agendamentos</title>
    <style>
        .larguraInput{
            width: 300px;
        }

        .formAlign{
            display: flex;
            flex-direction: column;
            align-items: center;
        }
    </style>
</head>
<body>
    <header> <?php include './nav.php' ?> </header>
    <div class="container">
        <h2 class="my-3">Agendamentos</h2>
        <p>Lista de Agendamentos Realizados</p>
        <form action="ctr_agendamentos.php" method="get">
            <p>
                <label for="iDateChooser">Data:</label>
                <input type="date" name="txtDateChooser" id="iDateChooser" required>
                <input type="submit" value="Filtrar">
            </p>
        </form>
        <table class="table table-striped text-center">
            <thead>
                <tr>
                    <th class="text-center">Cliente</th>
                    <th class="text-center">Telefone</th>
                    <th class="text-center">Serviço</th>
                    <th class="text-center">Data</th>
                    <th class="text-center">Horário</th>
                    <th class="text-center">Editar</th>
                    <th class="text-center">Deletar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $sql = "SELECT a.id, a.cliente as 'Nome', a.telefone as 'Telefone', serv.nome as 'Servico', a.agendamentoData as 'Data', a.horario as 'Horario' from agendamento a inner join servicos serv on a.idServico = serv.id ORDER BY a.agendamentoData, a.horario" ;
                    $stmt = $objAgendamentos->runQuery($sql);
                    $stmt->execute();
                    while ($objAgendamentos = $stmt->fetch(PDO::FETCH_ASSOC)) {
                ?>
                        <tr>
                            <td>
                                <?php echo $objAgendamentos['Nome']; ?>
                            </td>
                            <td>
                                <?php echo $objAgendamentos['Telefone']; ?>
                            </td>
                            <td>
                                <?php echo $objAgendamentos['Servico']; ?>
                            </td>
                            <td>
                                <?php echo $objAgendamentos['Data']; ?>
                            </td>
                            <td>
                                <?php echo $objAgendamentos['Horario']; ?>
                            </td>
                            <td>
                                <button type="button" class="btn btn-warning"
                                data-toggle="modal" 
                                data-target="#myModalEditar" 
                                data-id="<?php echo $objAgendamentos['id']; ?>"
                                data-nome="<?php echo $objAgendamentos['Nome']; ?>"
                                data-telefone="<?php echo $objAgendamentos['Telefone']; ?>"
                                data-servico="<?php echo $objAgendamentos['Servico']; ?>"
                                data-agendamento="<?php echo $objAgendamentos['Data']; ?>"
                                data-horario="<?php echo $objAgendamentos['Horario']; ?>">
                                Editar</button> 
                            </td>
                            <td>
                                <button type="button" class="btn btn-danger" 
                                data-toggle="modal" 
                                data-target="#myModalDelete" 
                                data-id="<?php echo $objAgendamentos['id']; ?>"
                                data-nome="<?php echo $objAgendamentos['Nome']; ?>"> Deletar </button> 
                            </td>
                        </tr>
                <?php
                    }
                ?>
            </tbody>
        </table>
        

    <!-- Modal Cadastro -->
    <div class="modal" id="myModal">
            
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header bg-dark" style="color: #fff;">
                    <h4 class="modal-title">Novo Agendamento</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form action="./controle/ctr_agendamentos.php" method="post">
                        <input type="hidden" name="insert">
                        <p class="formAlign">
                            <label for="iNome">Nome Completo:</label>
                            <input class="text-center larguraInput" type="text" name="txtNome" id="iNome" placeholder="Digite seu nome aqui" required>
                        </p>
                        <p class="formAlign">
                            <label for="iNome">Telefone:</label>
                            <input class="text-center larguraInput" type="text" name="txtTelefone" id="iNome" placeholder="Digite seu telefone aqui" maxlength="15" OnKeyPress="formatar('(##) #####-####',this)" required>
                        </p>
                        <p class="formAlign">
                            <label for="iServico">Escolha Serviço:</label>
                            <select name="txtServico" id="iServico" class="text-center larguraInput" required>
                                <option value="">Selecione Serviço</option>
                                <?php 
                                    $sql = "SELECT id as 'Id', nome as 'Nome' from servicos";
                                    $stmt = $objServicos->runQuery($sql);
                                    $stmt->execute();
                                    while($objServicos = $stmt->fetch(PDO::FETCH_ASSOC))
                                    {
                                ?>
                                <option value="<?php echo $objServicos['Id']; ?>">
                                    <?php echo $objServicos['Nome']; ?>
                                </option>
                                <?php
                                    } 
                                ?>
                            </select>
                        </p>
                        <p class="formAlign">
                            <label for="iData">Selecione Data: </label>
                            <input class="text-center larguraInput" type="date" name="txtData" id="iData" required>
                        </p>
                        <p class="formAlign">
                            <label for="iHorario">Selecione Horário: </label>
                            <input class="text-center larguraInput" type="time" name="txtHorario" id="iHorario" required>
                        </p>
                        <div class="formAlign">
                            <input type="submit" class="btn btn-success larguraInput" value="Cadastrar">
                        </div>
                    </form>
                </div>


            </div>
        </div>
    </div>

    <!-- Modal Editar -->
    <div class="modal" id="myModalEditar">
            
        <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header bg-dark" style="color: #fff;">
                        <h4 class="modal-title">Editar</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <form action="./controle/ctr_agendamentos.php" method="post">
                            <input type="hidden" name="update">
                            <input type="hidden" name="txtId" id="iId">
                        <p class="formAlign">
                            <label for="iNome">Nome Completo:</label>
                            <input class="text-center larguraInput" type="text" name="txtNome" id="iNome" placeholder="Digite seu nome aqui" required>
                        </p>
                        <p class="formAlign">
                            <label for="iTelefone">Telefone:</label>
                            <input class="text-center larguraInput" type="text" name="txtTelefone" id="iTelefone" placeholder="Digite seu telefone aqui" maxlength="15" OnKeyPress="formatar('(##) #####-####',this)" required>
                        </p>     
                        <p class="formAlign">
                            <label for="iData">Selecione Data: </label>
                            <input class="text-center larguraInput" type="date" name="txtData" id="iData" required>
                        </p>
                        <p class="formAlign">
                            <label for="iHorario">Selecione Horário: </label>
                            <input class="text-center larguraInput" type="time" name="txtHorario" id="iHorario" required>
                        </p>
                        <div class="formAlign">
                            <input type="submit" class="btn btn-success larguraInput" value="Atualizar">
                        </div>
                    </form>
                    <!-- Modal footer -->
                    <div class="modal-footer"></div>
                </div>

                </div>
            </div>
        </div>
    </div>
        
    <!-- Modal Delete -->
    <div class="modal" id="myModalDelete">
        
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header bg-dark" style="color: #fff;">
                    <h4 class="modal-title">Deletar</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form action="./controle/ctr_agendamentos.php" method="post">
                        <input type="hidden" name="delete">
                        <input type="hidden" name="txtId" id="iId" readonly>
                        <div class="form-group">
                            <label for="nome">Tem certeza que deseja deletar este agendamento?</label>
                            <input type="hidden" name="nome" id="recipient-nome">
                        </div>
                        <div style="display: flex; justify-content: space-between;">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
                            <button type="submit" class="btn btn-primary">Deletar</button>
                        </div>
                    </form>
                    <!-- Modal footer -->
                    <div class="modal-footer"></div>
                </div>

            </div>
        </div>
    </div>
    
    <!-- JQuery Delete -->
    <script>
        $('#myModalDelete').on('show.bs.modal', function(event){
            var button = $(event.relatedTarget);
            var recipientId = button.data('id');

            var modal = $(this);
            modal.find('#iId').val(recipientId);
        });
    </script>

    <!-- JQuery Editar -->
    <script>
        $('#myModalEditar').on('show.bs.modal', function(event){
            var button = $(event.relatedTarget);
            var recipientId = button.data('id');
            var recipientNome = button.data('nome');
            var recipientTelefone = button.data('telefone');
            var recipientDataAgendamento = button.data('agendamento');
            var recipientHorarioAgendamento = button.data('horario');
            

            var modal = $(this);
            modal.find('#iNome').val(recipientNome);
            modal.find('#iTelefone').val(recipientTelefone);
            modal.find('#iData').val(recipientDataAgendamento);
            modal.find('#iHorario').val(recipientHorarioAgendamento);
            modal.find('#iId').val(recipientId);
        });
    </script>
    <script>  
        function formatar(mascara, documento) {
            let i = documento.value.length;
            let saida = '#';
            let texto = mascara.substring(i);
            while (texto.substring(0, 1) != saida && texto.length ) {
            documento.value += texto.substring(0, 1);
            i++;
            texto = mascara.substring(i);
            }
        }
    </script>
</body>
</html>