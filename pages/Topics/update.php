<?php
  // isset -> serve para saber se uma variável está definida
  include_once('../../dbConfig.php');
  $id = !empty($_GET['id']) ? $_GET['id'] : null;
  $topic_title = isset($_POST['topic-title']) ? $_POST['topic-title'] : null;
  $img_file = isset($_FILES['picture-input']) ? $_FILES['picture-input'] : null;
  $pdf_file = isset($_FILES['pdf-input']) ? $_FILES['pdf-input'] : null;

  if($img_file['size'] > 0)
  {
    // print_r($img_file);
    $current_file = mysqli_query($conexao, "SELECT * FROM `temas` WHERE `id` = '$id';");
    if (mysqli_num_rows($current_file) > 0) {
      while($rowData = mysqli_fetch_array($current_file)){
        if($rowData['banner_path'] != null) {
          unlink($rowData["banner_path"]);
        }
        
      }
    }
    if ($img_file['error']) {
      die('Erro ao enviar arquivo de imagem');
    }
    else
      $path_images = "../../files/topics/banners/";
      $img_name = $img_file['name'];
      $new_img_name = uniqid();
      $img_extension = strtolower(pathinfo($img_name, PATHINFO_EXTENSION));

      if($img_extension != 'jpg' && $img_extension != 'jpeg' && $img_extension != 'png')
        die('Formato de imagem inválido');
      else
        $img_path = $path_images . $new_img_name . '.' . $img_extension;
        if(move_uploaded_file($img_file['tmp_name'], $img_path))
          $imgSql = ", `banner_path`='$img_path', `nome_img`='$img_name'";
          // print_r($imgSql);
  }
  else $imgSql = "";
  
  if($pdf_file['size'] > 0) {
    $current_file = mysqli_query($conexao, "SELECT * FROM `temas` WHERE `id` = '$id';");
    if (mysqli_num_rows($current_file) > 0) {
      while($rowData = mysqli_fetch_array($current_file)){
        if($rowData['material_path'] != null) {
          unlink($rowData["material_path"]);
        }
      }
    }
    
    // print_r($pdf_file);
    if($pdf_file['error'])
      die('Erro ao enviar arquivo pdf');
    else
      $path_pdfs = "../../files/topics/support_texts/";
      $pdf_name = $pdf_file['name'];
      $new_pdf_name = uniqid();
      $pdf_extension = strtolower(pathinfo($pdf_name, PATHINFO_EXTENSION));

      if($pdf_extension != 'pdf')
        die('Formato de arquivo inválido');
      else
        $pdf_path = $path_pdfs . $new_pdf_name . '.' . $pdf_extension;
        if(move_uploaded_file($pdf_file['tmp_name'], $pdf_path))
          $pdfSql = ", `material_path`='$pdf_path', `nome_pdf`='$pdf_name'"; 
          // print_r($pdfSql);
  }
  else $pdfSql = "";
    
  $sqlUpdate = "UPDATE `temas` SET `titulo`='$topic_title'$imgSql$pdfSql
  WHERE `temas`.`id` = $id;";

  // print_r($sqlUpdate);
  $result = mysqli_query($conexao, $sqlUpdate);
  if($result) {
    $return = ['erro' => false, 'msg' => 'Tema atualizado com sucesso'];
  }
  else {
    $return = ['erro' => true, 'msg' => 'Erro ao atualizar tema']; 
  }

  echo json_encode($return);
?>