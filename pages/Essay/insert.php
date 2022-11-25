<?php
  require('../../Config/connection.php');

  $topic = isset($_GET['tema']) ? $_GET['tema'] : '';
  $user = isset($_GET['usuario']) ? $_GET['usuario'] : '';
  $editor_data = isset($_POST['content']) ? $_POST['content'] : '';

  // print_r($editor_data);
  $sql = "INSERT INTO redacoes (id_usuario, id_tema, conteudo, status_correcao) VALUES ('$user', '$topic', '$editor_data', 'Aguardando correção')";
  
  $result = mysqli_query($connection, $sql);

  if($result){
    print_r("Redação inserida com sucesso!");
  }else{
    print_r("Erro ao inserir redação!");
  }

?>