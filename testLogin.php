<?php
    if(!isset($_SESSION)) session_start();
    // print_r($_REQUEST);
    if(isset($_POST['submit']) && !empty($_POST['email']) && !empty($_POST['senha']) && !empty($_POST['perfil']))
    {
        // Acessa o banco de dados e armazena o valor dos inputs do form de login
        include_once('dbConfig.php');
        $email = $_POST['email'];
        $senha = md5($_POST['senha']);
        $perfil = $_POST['perfil'];

        // SQL para verificar se o usuário existe no banco de dados
        $sql = "SELECT * FROM usuarios WHERE email = '$email' and senha = '$senha'";

        $result = $conexao->query($sql);

        
        if(mysqli_num_rows($result) < 1)
        {
            // Se não existir pelo menos 1 usuário, então desvincula a variável 'user' da sessão e redireciona para o login
            unset($_SESSION['user']);
            header('Location: index.php');
        }
        
        else if (mysqli_num_rows($result))
        {
            // Se existir pelo menos 1 usuário, então transforma o resultado da pesquisa em um vetor de registros
            $usuario = mysqli_fetch_row($result);

            $_SESSION['user'] = array(
                'id' => $usuario[0], 
                'user-name' => $usuario[1], 
                'email' => $usuario[2], 
                'access-level' => $usuario[4]
            );
            print_r($_SESSION['user']);
            // Verica o nível de acesso do usuário, se é estudante ou admin
            if($_SESSION['user']['access-level'] == 1) {
                header('Location: ./pages/essay_topics.php');
            } else {
                header('Location: ./pages/admin.php');
            }
        }
    }
    else
    {
        // Se não preencheu corretamente o form, não acessa
        header('Location: index.php');
    }
?>