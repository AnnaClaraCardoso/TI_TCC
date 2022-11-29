<?php
require_once '../php/conexao.php';


$conexao = novaConexao();

$sqlSelect = "SELECT * FROM postagem";

$resultado = mysqli_query($conexao, $sqlSelect);


?>
<!DOCTYPE html>
<html lang="pt-Br">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Rede</title>
  <link rel="shortcut icon" href="../imagens/favicon.ico" type="image/x-icon">
  <link rel="stylesheet" href="../style/style.css" />
  <link rel="stylesheet" href="../style/rede.css" />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@500&display=swap" rel="stylesheet" />
  <script src="https://kit.fontawesome.com/f18aeaea05.js" crossorigin="anonymous" defer></script>
  <style>
    p {
      font-family: Inter, sans-serif;
    }

    .first .inputContainer {
      background-color: #d7d5d5;
      display: flex;
      justify-content: space-around;
      align-items: center;
      padding-right: 15px;
    }

    .first .inputContainer i {
      color: #c50000;
      font-size: 25px;
    }

    .inputContainer button {
      border: 0;
      background-color: transparent;
    }

    .inputContainer form.formint {
      display: flex;
      justify-content: center;
      align-items: center;

    }
  </style>
</head>

<body>
  <?php
  session_start();
  $usuario = $_SESSION['usuario'];
  if (!isset($usuario)) {
    header('Location: ./index.php');
  }
  $id_usuario = $usuario['id'];

  $sql = "SELECT * from perfil WHERE idUsuario = $id_usuario order by idPerfil DESC";
  $query = mysqli_query($conexao, $sql);



  $perfil = [];
  $imageToView = '../imagens/perfil-inicial.png';
  $perfil['biografia'] = " Crie agora sua biografia";
  $perfil['radio'] = "Edite seu perfil";

  if ($query->num_rows > 0) {
    $row = mysqli_fetch_assoc($query);
    $perfil = $row;
    $imageToView = $row['foto'];
  }
  // $postagem = $_GET['postagem'];
  // $sql = "SELECT * FROM usuario ORDER BY idUsuario  DESC";

  // $resultado = $conexao->query($sql);

  // $sql = "SELECT nome FROM usuario ORDER BY idUsuario DESC";

  // $resultado = $conexao->query($sql);

  // $sql = "SELECT foto FROM perfil ORDER BY idUsuario DESC";

  // $resultado = $conexao->query($sql);

  // $postagem = $_GET['postagem'];
  // $sql = "SELECT conteudoTexto FROM postagem ORDER BY idUsuario DESC";
  // $resultado = $conexao->query($sql);

  // $posts = mysqli_fetch_assoc($resultado);

  // echo($sql);









  /**
   * PARA PEGAR A FOTO DO USUÁRIO DE CADA POST
   * 
   * - Armazer em uma variável o id do usuário do post
   * - Usar esse id para selecionar o registro do usuário correspondente
   * - Transformar o resultado em array com o mysqli_fetch_assoc()
   * - Dar echo na 'foto' contida no registro (ex: $imageToView = $row['foto'];)
   */

  ?>
  <header>
    <div class="navbar">
      <div class="titulo">
        <div class="t1">
          <h2>COMU<span>NIDADE</span></h2>
        </div>
        <div class="t2">
          <h2>DI<span>REITO</span></h2>
        </div>
      </div>
      <div class="navlist">

      </div>
      <a href="./index.php"><span>Sair</span></a>
    </div>
  </header>

  <div class="main">
    <div class="totperfil1">

      <div class="perfil1">

        <div class="perfil2">
          <div class="bx1">

            <img src="<?= $imageToView ?>" alt="<?= $usuario['nome'] ?>" class="perfil-inicial" style="border-radius: 50px; height: 80px; width: 80px;">

            <div class="title-bx1">
              <h1> <?= $usuario['nome'] ?></h1>
              <p><?= $perfil['radio'] ?></p>
            </div>
          </div>
          <div class="bx2">
            <h1>Biografia</h1>
            <p><?= $perfil['biografia'] ?></p>
          </div>
        </div>

      </div>
      <div class="edit-pf"><button class="btnOpen"><i class="fa-solid fa-pen"></i></button></div>
    </div>

    <div class="forum">
      <div class="bxx1">
        <div class="first">
          <img src="<?= $imageToView ?>" alt="<?= $usuario['nome'] ?>" class="perfil-inicial">
          <div class="inputContainer">
            <form action="../php/postt.php?postagem='.$postagem['conteudoTexto'].' " &id=".$usuario['id']." class="forminput" method="POST"><input type="text" placeholder="O que você deseja compartilhar?" name="postagem" /> <button type="submit"><i class="fa-brands fa-telegram"></i></button></form>
          </div>
        </div>
        <div class="container">
          <div class="container1">
            <i class="fa-regular fa-handshake"></i>
            <p>Experiências</p>
          </div>
          <div class="container2">
            <i class="fa-regular fa-face-smile-wink"></i>
            <p>Sentindo-se</p>
          </div>
        </div>
        <div class="posts">
          <ul class="posts-list">

          <?php
            $sqlSelectUsers = "SELECT idUsuario, conteudoTexto FROM postagem";
            $result = $conexao->query($sqlSelectUsers);
            if($result->num_rows > 0) {
              while($row = $result->fetch_assoc()) {
                $id = $row['idUsuario'];
                $sqlSelectUserImage = "SELECT foto FROM perfil WHERE idUsuario = '$id'";
                $sqlSelectUserName = "SELECT nome FROM usuario WHERE idUsuario = '$id'"; 
                $resultName = $conexao->query($sqlSelectUserName);
                $resultImage = $conexao->query($sqlSelectUserImage);
                if($resultName->num_rows > 0 && $resultImage->num_rows > 0) {
                  $rowName = $resultName->fetch_assoc();
                  $rowImage = $resultImage->fetch_assoc();
                  $nome = $rowName['nome'];
                  $foto = $rowImage['foto'];
                }
                echo '
                <li>
                  <div class="posts">
                    <div class="post">
                      <div class="post-head">
                        <img class="post-profile" src="' .$foto = $rowImage['foto']. '"/>
                        <span class="profile-name">' . $nome = $rowName['nome'] . '<span>';
                echo '
                      </div>
                      <div class="post-body">
                        <span>'.$row['conteudoTexto'].'</span>';
                echo '
                      </div>
                    </div>
                  </div>
                </li>'; 
              }
            }
          ?>
          </ul>
        </div>
      </div>

    </div>
  </div>
  <div class="modal">
    <div class="content">
      <form method="POST" enctype="multipart/form-data" action="../php/sistemarede.php">
        <div class="initial">
          <div class="seta">
            <i class="fas fa-arrow-left"></i>
          </div>
          <h3>Nos mostre você!</h3>
        </div>
        <div class="icon-image" onclick="abrirInputFile(this)">
          <input type="file" id="file" name="foto" accept="image/png, image/jpeg, image/jpg">
          <i class="fa-solid fa-image"></i>
          <p class="nomearquivo"></p>
        </div>

        <div class="label inputContainer">
          <i class="fa-solid fa-t"></i>
          <input type="text" placeholder="Como devemos te chamar?" name="nome" value="<?= $usuario['nome'] ?>" />
        </div>
        <div class="check data">
          <input type="radio" class="aluno" name="radio" value="Aluno" />
          <label for="">Aluno</label>
          <span></span>

          <input type="radio" class="futuro-ingressante" required name="radio" value="Ingressante" />
          <label for="">Futuro Ingressante</label>
          <span></span>


        </div>
        <div class="bio inputContainer">
          <textarea name="biografia" id="" cols="30" rows="10" placeholder="Nos conte sobre você..."></textarea>

        </div>
        <div class="butts">
          <button class="btnClose" type="submit" value="editar" name="update-perfil">Enviar</button>
          <button class="btnCancel" type="button">Cancelar</button>
        </div>
      </form>
    </div>
  </div>
  <script>
    const btnOpen = document.querySelector('.btnOpen')
    const btnClose = document.querySelector('.btnClose')
    const seta = document.querySelector('.seta')
    const btnCancel = document.querySelector('.btnCancel')
    const modal = document.querySelector('.modal')
    const inputArquivo = document.querySelector("#file");
    const exibirNomeDoAquivo = document.querySelector('.nomearquivo')
    btnOpen.addEventListener('click', () => {
      console.log("liga")
      modal.style.display = 'flex'
    })

    btnClose.addEventListener('click', () => {
      console.log("desliga")
      modal.style.display = 'none'
    })
    seta.addEventListener('click', () => {
      console.log("desliga")
      modal.style.display = 'none'
    })

    btnCancel.addEventListener('click', () => {
      console.log("desliga")
      modal.style.display = 'none'
    })

    function abrirInputFile(element) {
      const input = element.querySelector('input')
      input.click();
    }

    inputArquivo.addEventListener('change', event => {
      exibirNomeDoAquivo.innerHTML = event.target.value
    })
  </script>

</body>

</html>