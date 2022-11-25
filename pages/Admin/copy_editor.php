<?php
  if (!isset($_SESSION)) session_start();
  include('../../Authentication/auth.php');

  if($perfil == 1) {
    header("Location: ../../index.php");
    exit;
  } else {
    include_once('../../Config/connection.php');
    $id = $_GET['id'];
    $sql = "SELECT * FROM redacoes WHERE id = $id";
    $result = $connection->query($sql);
    $row = $result->fetch_assoc();
  }
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
  <main>
    <section class="reader">
      <?php
        echo $row['conteudo'];
      ?>
    </section>
    <section class="comments-input">
      <form action="insert.php?id=<?php echo $id?>" method="post">
        <textarea name="content" id="editor">
          &lt;p&gt;Insira aqui seus comentários acerca da redação, realçando trechos que deveram ser revisados e seus devidos motivos, bem como as notas para cada uma das competências consideradas pelo ENEM.&lt;/p&gt;
        </textarea>
        <p><input type="submit" value="Enviar"></p>
      </form>
    </section>
  </main>

  <script src="https://cdn.ckeditor.com/ckeditor5/35.3.0/classic/ckeditor.js"></script>

  <script type="module">
    ClassicEditor
      .create( document.querySelector( '#editor' ) )
      .catch( error => {
        console.error( error );
      } );
  </script>
</body>
</html>