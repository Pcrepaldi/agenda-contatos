<?php
header('Content-Type: application/json');

require "./classes/Contato.php";

$contato = new Contato();

    if(isset($_POST['id_contato']) && isset($_POST['telefone'])){
        $id_contato = $_POST['id_contato'];
        $telefone = $_POST['telefone'];

        echo "<h1>$id_contato e $telefone</h1>";

        $contato->inserirTelefone($id_contato, $telefone);    
    }


