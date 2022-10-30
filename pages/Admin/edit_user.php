<?php
    include_once('dbConfig.php');

    if(!empty($_GET['id']))
    {
        $id = $_GET['id'];
        $sqlSelect = "SELECT * FROM usuarios WHERE id=$id";
        $result = $conexao->query($sqlSelect);
        if($result->num_rows > 0)
        {
            while($user_data = mysqli_fetch_assoc($result))
            {
                $nome = $user_data['nome'];
                $perfil = $user_data['perfil'];
                $nivel_escolar = $user_data['nivel_escolar'];
                $estado = $user_data['estado'];
                $cidade = $user_data['cidade'];
            }
        }
        else
        {
            header('Location: /pages/admin.php');
        }
    }
    else
    {
        header('Location: /pages/admin.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário | GN</title>

    <link rel="stylesheet" href="../styles/global.css">
</head>
<body>
    <a href="admin.php">Voltar</a>
    <div class="box">
        <form action="user_update.php" method="POST">
            <input disabled type="text" name="nome" id="nome" value='<?php echo $nome;?>' required>
            <br>
            <?php

                $perfis = array(
                    1 => 'Visitante',
                    2 => 'Administrador',
                );

                echo "<select name='perfil' id='perfil' class='form-select'>";
                    foreach($perfis as $cod => $descricao) {
                        if($perfil == $cod) {
                            echo "<option selected='selected' value='$cod'>$descricao</option>";
                        } else {
                            echo "<option value='$cod'>$descricao</option>";
                        }
                    }
                echo "</select>";

            ?>
            <br>
            <?php
                $niveis = array(
                    'Concluindo o ensino médio',
                    'Ensino médio completo',
                    'Iniciando o ensino superior',
                );

                echo "<select id='nivel-escolar' name='nivel-escolar' class='form-select'>";
                    foreach($niveis as $nivel) {
                        if($nivel_escolar == $nivel) {
                            echo "<option selected='selected' value='$nivel'>$nivel</option>";
                        } else {
                            echo "<option value='$nivel'>$nivel</option>";
                        }
                    }
                echo "</select>";
            ?>
            <br>
            <?php
                $estados = array(
                    'AC' => 'Acre',
                    'AL' => 'Alagoas',
                    'AP' => 'Amapá',
                    'AM' => 'Amazonas',
                    'BA' => 'Bahia',
                    'CE' => 'Ceará',
                    'DF' => 'Distrito Federal',
                    'ES' => 'Espirito Santo',
                    'GO' => 'Goiás',
                    'MA' => 'Maranhão',
                    'MS' => 'Mato Grosso do Sul',
                    'MT' => 'Mato Grosso',
                    'MG' => 'Minas Gerais',
                    'PA' => 'Pará',
                    'PB' => 'Paraíba',
                    'PR' => 'Paraná',
                    'PE' => 'Pernambuco',
                    'PI' => 'Piauí',
                    'RJ' => 'Rio de Janeiro',
                    'RN' => 'Rio Grande do Norte',
                    'RS' => 'Rio Grande do Sul',
                    'RO' => 'Rondônia',
                    'RR' => 'Roraima',
                    'SC' => 'Santa Catarina',
                    'SP' => 'São Paulo',
                    'SE' => 'Sergipe',
                    'TO' => 'Tocantins',
                );

                echo "<select id='estado' name='estado' class='form-select'>";
                    foreach($estados as $uf => $nome) {
                        if($estado == $uf) {
                            echo "<option selected='selected' value='$uf'>$nome</option>";    
                        } else {
                            echo "<option value='$uf'>$nome</option>";
                        }
                    }
                echo "</select>";
            ?>
            <input type="text" name="cidade" id="cidade" value='<?php echo $cidade;?>' required>
            <input type="hidden" name="id" value=<?php echo $id;?>>
            <input type="submit" name="update" id="submit">
        </form>
    </div>
</body>
</html>