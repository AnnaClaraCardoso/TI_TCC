<?php
    include_once('../../dbConfig.php');

    if(!empty($_GET['id']))
    {
        $id = $_GET['id'];
        $sqlSelect = "SELECT * FROM temas WHERE id=$id";
        $result = $conexao->query($sqlSelect);
        if($result->num_rows > 0)
        {
            while($topic_data = mysqli_fetch_assoc($result))
            {
                $id = $topic_data['id'];
                $titulo = $topic_data['titulo'];
                $banner_path = $topic_data['banner_path'];
                $material_path= $topic_data['material_path'];
                $nome_pdf = $topic_data['nome_pdf'];

                $return = ['id' => $id, 'titulo' => $titulo, 'banner_path' => $banner_path, 'material_path' => $material_path, 'nome_pdf' => $nome_pdf];
            }

            echo json_encode($return);
        }
        else
        {
            header('Location: /pages/admin.php');
        }
    }
    else
    {
        header('Location: /pages/admin.php');
    }
?>
