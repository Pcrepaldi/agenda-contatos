<?php

    declare(strict_types=1);

    $pdo = null;

    try{
        $DB_NAME = 'agenda';
        $dsn = "mysql:host=localhost;dbname=$DB_NAME";
        $USER = 'root';
        $PASSWORD = 'Pl@c123123';

        $pdo = new PDO($dsn, $USER, $PASSWORD);
    }catch(Exception $e){
        echo "Erro ao conectar no banco de dados: " . $e->getMessage();
        exit();
    }
return ($pdo);
    