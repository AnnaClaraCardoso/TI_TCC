<?php

    $dbHost = 'localhost';
    $dbUsername = 'root';
    $dbPassword = '';
    $dbName = 'pi';
    
    $connection = new mysqli($dbHost,$dbUsername,$dbPassword,$dbName);

    if($connection->connect_errno)
    {
        echo "Erro";
    }

?>