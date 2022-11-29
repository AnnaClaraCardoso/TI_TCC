<?php
  require('../../Config/connection.php');

  $topic = isset($_GET['tema']) ? $_GET['tema'] : '';
  $user = isset($_GET['usuario']) ? $_GET['usuario'] : '';
  $editor_data = isset($_POST['content']) ? $_POST['content'] : '';

  // print_r($editor_data);
  $sql = "INSERT INTO redacoes (id_usuario, id_tema, conteudo) VALUES ('$user', '$topic', '$editor_data')";
  
  if(mysqli_query($connection, $sql)) {
    echo "<script>alert('Redação enviada com sucesso!');</script>";
  } else {
    echo "<script>alert('Erro ao enviar redação!');</script>";
  }

  header('Location: ./essay.php?tema='.$topic.'&titulo='.$_GET['titulo']);

  $connection->close();
?>