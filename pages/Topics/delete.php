<?php
  // isset -> serve para saber se uma variável está definida
  include_once('../../Config/connection.php');
  $id = !empty($_GET['id']) ? $_GET['id'] : null;

  $register = mysqli_query($connection, "SELECT * FROM `temas` WHERE `temas`.`id` = $id;");
  if (mysqli_num_rows($register) > 0) {
    while($rowData = mysqli_fetch_array($register)) {
      if($rowData['banner_path'] != null) unlink($rowData["banner_path"]);
      if($rowData['material_path'] != null) unlink($rowData["material_path"]);
    }
  }
     
  $sqlDelete = "DELETE FROM temas WHERE `temas`.id = $id;";
  print_r($sqlDelete);
  $result = mysqli_query($connection, $sqlDelete);
  
  if($result) {
    echo "<script>alert('Tema deletado com sucesso!')</script>";
  } else {
    echo "<script>alert('Erro ao deletar tema!')</script>";
  }

  header('Location: ./essay_topics.php');
?>