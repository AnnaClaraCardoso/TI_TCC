<?php

  include_once('../../dbConfig.php');
  // $topic_title = isset($_POST['topic-title']) ? $_POST['topic-title'] : '';
  // $img_file = isset($_FILES['picture-input']) ? $_FILES['picture-input'] : '';
  // $pdf_file = isset($_FILES['pdf-input']) ? $_FILES['pdf-input'] : '';

  if(isset($_POST['topic-title']) || isset($_FILES['picture-input']) || isset($_FILES['pdf-input']))
  {
    $topic_title = $_POST['topic-title'];
    $img_file = $_FILES['picture-input'];
    $pdf_file = $_FILES['pdf-input'];

    $path_images = "../../files/topics/banners/";
    $path_pdfs = "../../files/topics/support_texts/";

    $img_name = $img_file['name'];
    $pdf_name = $pdf_file['name'];

    $new_img_name = uniqid();
    $new_pdf_name = uniqid();

    $img_extension = strtolower(pathinfo($img_name, PATHINFO_EXTENSION));
    $pdf_extension = strtolower(pathinfo($pdf_name, PATHINFO_EXTENSION));

    if($img_extension != 'jpg' && $img_extension != 'jpeg' && $img_extension != 'png')
      die('Formato de imagem inválido');
    else if($pdf_extension != 'pdf')
      die('Formato de arquivo inválido');
    else {
      $img_path = $path_images . $new_img_name . '.' . $img_extension;
      $pdf_path = $path_pdfs . $new_pdf_name . '.' . $pdf_extension;

      if(move_uploaded_file($img_file['tmp_name'], $img_path) && move_uploaded_file($pdf_file['tmp_name'], $pdf_path)) {
        $sqlInsert = "INSERT INTO `temas` (`titulo`, `banner_path`, `nome_img`, `material_path`, `nome_pdf`) VALUES ('$topic_title', '$img_path', '$img_name', '$pdf_path', '$pdf_name')";
        $result = mysqli_query($conexao, $sqlInsert);
        if($result)
          $return = ['erro' => false, 'msg' => 'Tema adicionado com sucesso'];
        else
          $return = ['erro' => true, 'msg' => 'Erro ao adicionar tema'];

        echo json_encode($return);
      }
    } 
  }

?>