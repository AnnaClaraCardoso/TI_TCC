<?php
    // isset -> serve para saber se uma variável está definida
    include_once('Config/connection.php');
    if(isset($_POST['topic-title']))
    {
        $id = $_POST['id'];
        $perfil = $_POST['perfil'];
        $nivel_escolar = $_POST['nivel-escolar'];
        $estado = $_POST['estado'];
        $cidade = $_POST['cidade'];
        
        $sqlInsert = "UPDATE usuarios
        SET perfil='$perfil', nivel_escolar='$nivel_escolar', estado='$estado', cidade='$cidade'    
        WHERE id=$id";
        $result = $connection->query($sqlInsert);
        print_r($result);
    }
    header('Location: ./pages/admin.php');
?>