<?php

    if(!empty($_GET['id']))
    {
        include_once('../../Config/connection.php');

        $id = $_GET['id'];

        $sqlSelect = "SELECT *  FROM usuarios WHERE id=$id";

        $result = $connection->query($sqlSelect);

        if($result->num_rows > 0)
        {
            $sqlDelete = "DELETE FROM usuarios WHERE id=$id";
            $resultDelete = $connection->query($sqlDelete);
        }
    }
    header('Location: ./admin.php');
?>