<?php
  include_once('../../Config/connection.php');
  // include('./copy_editor.php');

  $redacao = $_GET['redacao'];
  $comment = $_POST['content'];
  $grade = $_POST['grade'];
  $corretor = $_GET['corretor'];

  $sqlInsert = "INSERT INTO correcoes (id_corretor, conteudo, id_redacao) VALUES ('$corretor', '$comment', '$redacao');";
  $connection->query($sqlInsert);

  $sqlUpdate = "UPDATE redacoes SET nota = '$grade' WHERE id = $redacao";
  if($connection->query($sqlUpdate)) {
    echo "<script>alert('Comentário enviado com sucesso!');";
  } else {
    echo "<script>alert('Erro ao enviar comentário!');";
  }

  header('Location: requisitions.php');

  $connection->close();
?>