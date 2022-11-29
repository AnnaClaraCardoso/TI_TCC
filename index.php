<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de login</title>

    <link rel="stylesheet" href="./index.css">
    <link rel="stylesheet" href="./styles/global.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>

</head>
<body>
    <div class='container'>
        <main class='row'>
            <div class="col-md-6 mb-5">
                <h1><strong>Tenha  todas as ferramentas para melhorar a sua escrita</strong></h1>
                <br>
                <br>
                <a href="./pages/SignUp/signup.php">
                    <button class="btn btn-warning">Criar uma conta</button>
                </a>
                <br>
                <br>
            </div>
            <div class="col-md-4">
                <form action="./testLogin.php" method="POST">
                    <h2>Login</h2>
                    <br><br>
                    <input class="form-control" type="email" name="email" placeholder="E-mail">
                    <br>
                    <input class="form-control" type="password" name="senha" placeholder="Senha">
                    <br>
                    <?php
                        $perfis = array(
                            1 => 'Visitante',
                            2 => 'Administrador',
                        );

                        echo "<select class='form-select' name='perfil' id='perfil'>
                                <option selected disabled>Selecione o tipo de usuário</option>
                        ";
                            foreach($perfis as $cod => $descricao) {
                                echo "<option value='$cod'>$descricao</option>";
                            }
                        echo "</select>";
                    ?>
                    <br>
                    <button class="btn btn-primary" style="width: 100% !important;" type="submit" name="submit">Enviar</button>
                </form>
            </div>
        </main>
    </div>
</body>
</html>