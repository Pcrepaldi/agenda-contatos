<?php
    header('Content-Type: application/json');

    require "./classes/Contato.php";

    $contato = new Contato();

    $mensagens = array();
    $mensagens[] = "Contato inserido com sucesso";
    $mensagens[] = "Erro: Nome NULL";
    $mensagens[] = "Erro: Telefone aceita somente números";
    $mensagens[] = "Erro: Falha ao cadastrar";

    $campos_contato = false;
    if(isset($_POST['nome']) && !empty($_POST['nome']) && isset($_POST['telefone']) && !empty($_POST['telefone'])){
        $nome = $_POST['nome'];
        $telefone = $_POST['telefone'];

        $campos_contato = true;
    }
    
    $campos_endereco = false;
    if(isset($_POST['cep']) || isset($_POST['rua']) || isset($_POST['bairro']) || isset($_POST['cidade']) || isset($_POST['estado'])){
        $cep = $_POST['cep'];
        $rua = $_POST['rua'];
        $bairro = $_POST['bairro'];
        $cidade = $_POST['cidade'];
        $estado = $_POST['estado'];

        $campos_endereco = true;
    }

    $cod = 3;

    if($campos_contato == true){
        $cod = $contato->inserirContato($nome, $telefone, $cep, $rua, $bairro, $cidade, $estado);
    }

    switch($cod){
        case 0:
            echo json_encode($mensagens[0]);
            break;
        case 1:
            echo json_encode($mensagens[1]);
            break;
        case 2:
            echo json_encode($mensagens[2]);
            break;
        case 3:
            echo json_encode($mensagens[3]);
            break;
    }
?>