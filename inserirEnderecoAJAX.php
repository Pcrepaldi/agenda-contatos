<?php
header('Content-Type: application/json');

require "./classes/Contato.php";

$contato = new Contato();

    if(isset($_POST['cep']) || isset($_POST['rua']) || isset($_POST['bairro']) || isset($_POST['cidade']) || isset($_POST['estado'])){
        $id_contato = $_POST['id_contato'];
        $cep = $_POST['cep'];
        $rua = $_POST['rua'];
        $bairro = $_POST['bairro'];
        $cidade = $_POST['cidade'];
        $estado = $_POST['estado'];

        $contato->inserirEndereco($id_contato, $cep, $rua, $bairro, $cidade, $estado);    
    }


