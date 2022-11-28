<?php
    // Verifica se o usuário foi submetido corretmente
    if(isset($_POST['submit']))
    {
        // Conecta com o banco de dados
        include_once('../../Config/connection.php');

        // Armazena o valor dos inputs
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $senha = md5($_POST['senha']);
        $nivel_escolar = $_POST['nivel-escolar'];
        $estado = $_POST['estado'];
        $cidade = $_POST['cidade'];

        // Verifica se o usuário já existe
        $sqlSelect = "SELECT * FROM usuarios WHERE email='$email'";
        $result = $connection->query($sqlSelect);
        if($result->num_rows > 0)
        {
            echo "<script>alert('Usuário já cadastrado!')</script>";
        }
        else
        {
            // Insere os dados no banco de dados
            $sqlInsert = "INSERT INTO usuarios (nome, email, senha, perfil, nivel_escolar, estado, cidade) VALUES ('$nome', '$email', '$senha', 1, '$nivel_escolar', '$estado', '$cidade')";
            $resultInsert = $connection->query($sqlInsert);
            if($resultInsert)
            {
                echo "<script>alert('Usuário cadastrado com sucesso!')</script>";
            }
            else
            {
                echo "<script>alert('Erro ao cadastrar usuário!')</script>";
            }
            // Reencaminha para a página de login
            header('Location: ../../index.php');
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário | GN</title>
    
    <link rel="stylesheet" href="../../styles/global.css">
    <link rel="stylesheet" href="./styles/signup.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        <main>
            <form action="signup.php" method="POST">
                <h1><strong>Criar uma conta</strong></h1>
                <div class="row">
                    <div class="col-md-5">
                        <input type="text" name="nome" placeholder="Nome completo" id="nome" required>
                        <input type="email" name="email" placeholder="E-mail" id="email" required>
                        <input type="password" name="senha" placeholder="Senha" id="senha" required>
                        <input type="password" oninput="confirmPassword()" placeholder="Confirme sua senha" id="confirmar-senha" required>
                        <span class="help-text"></span>
                    </div>
                    <div class="col-md-5">
                        <?php
                            $niveis = array(
                                'Concluindo o ensino médio',
                                'Ensino médio completo',
                                'Iniciando o ensino superior',
                            );

                            echo "<select id='nivel-escolar' name='nivel-escolar' class='form-select'>";
                                foreach($niveis as $nivel) {
                                    echo "<option value='$nivel'>$nivel</option>";
                                }
                            echo "</select>";
                        ?>

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
                                    echo "<option value='$uf'>$nome</option>";
                                }
                            echo "</select>";
                        ?>
                        <input type="text" placeholder="Cidade" name="cidade" id="cidade">
                        <button type="submit" onclick="return confirmPassword()" name="submit" id="submit"><span>Cadastrar</span></button>
                    </div>
                </div>
            </form>
        </main>
        <a href="../../index.php">Voltar</a>
    </div>

    <script>
        const helpTextSpan = document.querySelector('.help-text');
        function confirmPassword() {
            let password = document.querySelector('#senha').value;
            let confirm_password = document.querySelector('#confirmar-senha').value;

            if(password != '' && confirm_password != '') {
                if (password !== confirm_password) {
                    helpTextSpan.innerHTML = 'As senhas não condisem.';
                    helpTextSpan.style.color = 'red';
                    return false;
                } else {
                    helpTextSpan.innerHTML = '';
                    return true;
                }
            } else {
                helpTextSpan.innerHTML = '';
            }
        }
    </script>
</body>
</html>