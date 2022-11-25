<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de login</title>

    <link rel="stylesheet" href="./styles/global.css">
    <link rel="stylesheet" href="index.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>

</head>
<body>
    <div class='container'>
        <main class='row'>
            <div class="col-md-6 mb-5">
                <h1><strong>Tenha  todas as ferramentas para melhorar a sua escrita</strong></h1>
                <br>
                <p>
                    In laborum fugiat do aute tempor mollit qui tempor. Aliquip est nulla velit magna elit voluptate nisi officia consequat. Pariatur ad fugiat sint proident reprehenderit dolore qui minim.
                </p>
                <br>
                <a href="./pages/SignUp/signup.php">
                    <button class="goto-signUp-btn"><span>Criar uma conta</span></button>
                </a>
                <br>
                <br>
            </div>
            <div class="col-md-4">
                <form action="./testLogin.php" method="POST">
                    <h2>Login</h2>
                    <br><br>
                    <input type="email" name="email" placeholder="E-mail">
                    <br>
                    <input type="password" name="senha" placeholder="Senha">
                    <br>
                    <?php
                        $perfis = array(
                            1 => 'Visitante',
                            2 => 'Administrador',
                        );

                        echo "<select name='perfil' id='perfil' class='form-select'>
                                <option selected disabled>Selecione o tipo de usuário</option>
                        ";
                            foreach($perfis as $cod => $descricao) {
                                echo "<option value='$cod'>$descricao</option>";
                            }
                        echo "</select>";
                    ?>
                    <br>
                    <button class="signin-btn" type="submit" name="submit"><span>Enviar</span></button>
                </form>
            </div>
        </main>
    </div>
</body>
</html>