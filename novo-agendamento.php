<?php 

require_once ('./modelo/agendamentoDAO.php');
$objAgendamentos = new Agendamento();

require_once ('./modelo/servicoDAO.php');
$objServicos = new Servicos();

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include './bs4.php' ?>
    <title>Novo Agendamentos</title>
    <style>
        main{
            width: 450px;
            margin: 10px auto;
            border: 1px solid black;
            padding: 10px;
        }

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
    <main>
        <h1 class="mb-3 text-center" >Agendamento</h1>
        <form class="formAlign" action="./controle/ctr_agendamentos.php" method="post">
            <input type="hidden" name="insert">
            <p class="formAlign">
                <label for="iNome">Nome Completo:</label>
                <input class="text-center larguraInput" type="text" name="txtNome" id="iNome" placeholder="Digite seu nome aqui" required>
            </p>
            <p class="formAlign">
                <label for="iTelefone">Telefone:</label>
                <input class="text-center larguraInput" type="text" name="txtTelefone" id="iTelefone" placeholder="Digite seu telefone aqui" maxlength="15" OnKeyPress="formatar('(##) #####-####',this)" required>
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
            <div>
                <input type="submit" class="btn btn-success larguraInput" value="Cadastrar">
            </div>
        </form>
    </main>

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