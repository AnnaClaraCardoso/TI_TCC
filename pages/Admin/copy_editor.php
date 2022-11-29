<?php
  if (!isset($_SESSION)) session_start();
  include('../../Authentication/auth.php');
  include_once('../../Config/connection.php');
  $url = $_SERVER['REQUEST_URI'];
  $redacao = $_GET['id'];
  $name = $_GET['nome'];
  $topic = $_GET['tema'];
  $sql = "SELECT * FROM redacoes WHERE id = '$redacao'";
  $result = $connection->query($sql);
  $res = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Área de Correção</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>

  <link rel="stylesheet" href="../../styles/global.css">
  <link rel="stylesheet" href="./styles/copy_editor.css">
</head>

<body>
  <?php
  include('../../components/navbar.php');
  ?>
  <div class="container">
    <main class="mt-5 mb-5">
      <section class="reader">
        <h2>Corretor</h2>
        <br>
        <p><strong>Aluno(a):</strong> <?php echo $name ?></p>
        <p><strong>Tema:</strong> <?php echo $topic ?></p>
        <?php
          echo $res['conteudo'];
        ?>
      </section>
      <?php
        if($perfil == 2) {
          echo '
          <section class="comments-input">
            <form action="comment.php?redacao='. $redacao. '&corretor='. $id .'" method="post">
              <textarea name="content" id="editor" style="color=">
                &lt;p&gt;Insira aqui seus comentários acerca da redação, realçando trechos que deveram ser revisados e seus devidos motivos, bem como as notas para cada uma das competências consideradas pelo ENEM.&lt;/p&gt;
              </textarea>
              <br>
              <input class="form-control" type="number" name="grade" id="grade" placeholder="Nota final">
              <br>
              <p><input class="btn btn-primary" type="submit" value="Enviar"></p>
            </form>
          </section>';
        } else {
          include_once('../../Config/connection.php');
          $sql = "SELECT * FROM correcoes WHERE id_redacao = '$redacao';";
          $result = $connection->query($sql);
          if($result -> num_rows > 0) {
            $row = $result->fetch_assoc();
            $comment = $row['conteudo'];
          } else { $comment = 'Não há comentários para esta redação.'; }
          $grade = $res['nota'] != null ? $res['nota'] : 'Não avaliado';
          echo '
          <section class="comments">
            <br>
            <h2>Comentários</h2>
            <p><strong>Nota:</strong> '. $grade .'</p>
            '. $comment .'
          </section>';

          $connection->close();
        }
      ?>
    </main>
  </div>

  <script src="https://cdn.ckeditor.com/ckeditor5/35.3.0/classic/ckeditor.js"></script>

  <script type="module">
    ClassicEditor
      .create(document.querySelector('#editor'))
      .catch(error => {
        console.error(error);
      });
  </script>
</body>

</html>