<?php
  // isset -> serve para saber se uma variável está definida
  include_once('../../dbConfig.php');
  $id = !empty($_GET['id']) ? $_GET['id'] : null;

  $register = mysqli_query($conexao, "SELECT * FROM `temas` WHERE `temas`.`id` = $id;");
  if (mysqli_num_rows($register) > 0) {
    while($rowData = mysqli_fetch_array($register)) {
      if($rowData['banner_path'] != null) unlink($rowData["banner_path"]);
      if($rowData['material_path'] != null) unlink($rowData["material_path"]);
    }
  }
     
  $sqlDelete = "DELETE FROM `temas` WHERE `temas`.`id` = $id;";
  print_r($sqlDelete);
  $result = mysqli_query($conexao, $sqlDelete);
  if($result) {
    $return = ['erro' => false, 'msg' => 'Tema excluído com sucesso!'];
  }
  else {
    $return = ['erro' => true, 'msg' => 'Erro ao excluir tema.']; 
  }

  echo json_encode($return);
?>