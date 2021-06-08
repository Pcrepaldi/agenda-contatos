<?php

declare(strict_types=1);

class Contato{
    public function inserirContato($nome, $telefone, $cep=null, $rua=null, $bairro=null, $cidade=null, $estado=null) : int
    {
        $pdo = require "conexao.php";

        $telefone = str_replace(" ", "", $telefone);
        
        try{
            if($nome == null){
                return 1;
            }else if($telefone == null || !is_numeric($telefone)){
                return 2;
            }else{
                $sql = "INSERT INTO contato (id_contato, nome) values 
                (null, :nome);";

                $stm = $pdo->prepare($sql);
                $stm->bindValue(":nome", $nome);
                $stm->execute();

                $sql = "SELECT MAX(id_contato) from contato LIMIT 1;";

                $stm = $pdo->prepare($sql);
                $stm->execute();

                // Pega o id do último contato cadastrado
                $maximo = $stm->fetchAll();

                $sql = "INSERT INTO telefone (id_telefone, id_contato, telefone) values 
                (null, :id_contato, :telefone);";

                $stm = $pdo->prepare($sql);
                $stm->bindValue(":id_contato", $maximo[0][0]);
                $stm->bindValue(":telefone", $telefone);
                $stm->execute();
                
                if($rua != null || $bairro != null || $cidade || null || $estado != null)
                {
                    $sql = "INSERT INTO endereco (id_endereco, id_contato, cep, rua, bairro, cidade, estado) values 
                    (null, :id_contato, :cep, :rua, :bairro, :cidade, :estado);";

                    $stm = $pdo->prepare($sql);
                    $stm->bindValue(":id_contato", $maximo[0][0]);
                    $stm->bindValue(":cep", $cep);
                    $stm->bindValue(":rua", $rua);
                    $stm->bindValue(":bairro", $bairro);
                    $stm->bindValue(":cidade", $cidade);
                    $stm->bindValue(":estado", $estado);
                    $stm->execute();
                }
                return 0;
            }
        }catch(PDOException $e){
            echo $e->getMessage();
            return 3;
        }
    }

    public function inserirTelefone($id_contato, $telefone)
    {
        $pdo = require "conexao.php";

        $telefone = str_replace(" ", "", $telefone);
        
        try{
            if($telefone == null || !is_numeric($telefone)){
                return 1;
            }else{
                $sql = "INSERT INTO telefone (id_telefone, id_contato, telefone) values 
                (null, :id_contato, :telefone);";

                $stm = $pdo->prepare($sql);
                $stm->bindValue(":id_contato", $id_contato);
                $stm->bindValue(":telefone", $telefone);
                $stm->execute();

                return 0;
            }
        }catch(PDOException $e){
            echo $e->getMessage();
            return 2;
        }
    }

    public function inserirEndereco($id_contato, $cep=null, $rua=null, $bairro=null, $cidade=null, $estado=null)
    {
        $pdo = require "conexao.php";
        
        try{
            if($rua != null || $bairro != null || $cidade || null || $estado != null)
            {
                $sql = "INSERT INTO endereco (id_endereco, id_contato, cep, rua, bairro, cidade, estado) values 
                (null, :id_contato, :cep, :rua, :bairro, :cidade, :estado)";

                $stm = $pdo->prepare($sql);

                $stm->bindValue(":id_contato", $id_contato);
                $stm->bindValue(":cep", $cep);
                $stm->bindValue(":rua", $rua);
                $stm->bindValue(":bairro", $bairro);
                $stm->bindValue(":cidade", $cidade);
                $stm->bindValue(":estado", $estado);

                $stm->execute();

                return 0;
            }else{
                return 1;
            }    
        }catch(PDOException $e){
            echo $e->getMessage();
            return 3;
        }
    }

    public function listarTodosContatos($filtrar)
    {
        try{
            $pdo = require "conexao.php";

            $sql = "SELECT
            c.id_contato as id_contato, 
            c.nome as nome
            FROM contato c";

            if(!empty($filtrar)){
                $filtrar = "%$filtrar%";
                $sql .= " WHERE c.nome LIKE ? ORDER BY c.nome ASC";
                $stm = $pdo->prepare($sql);
                $stm->bindValue(1, $filtrar);
                $stm->execute();
            }else{
                $sql .= " ORDER BY c.nome ASC";
                $stm = $pdo->query($sql);
            }

            return $stm->fetchAll();
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }

    public function listarContatoId($id)
    {
        try{
            $pdo = require "conexao.php";

            $sql = "SELECT
            id_contato, nome
            FROM contato
            WHERE id_contato = ?;";

            $stm = $pdo->prepare($sql);
            $stm->bindValue(1, $id);
            $stm->execute();

            if($stm->rowCount() != 0){
                return $stm->fetch(PDO::FETCH_ASSOC);
            }else{
                return 0;
            }
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }

    public function listarTelefoneId($id)
    {
        try{
            $pdo = require "conexao.php";

            $sql = "SELECT
            id_contato, telefone
            FROM telefone
            WHERE id_contato = ?;";

            $stm = $pdo->prepare($sql);
            $stm->bindValue(1, $id);
            $stm->execute();

            if($stm->rowCount() != 0){
                return $stm->fetchAll(PDO::FETCH_ASSOC);
            }else{
                return 0;
            }
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }

    public function listarEnderecoId($id)
    {
        try{
            $pdo = require "conexao.php";

            $sql = "SELECT
            id_contato, cep, rua, bairro, cidade, estado
            FROM endereco
            WHERE id_contato = ?;";

            $stm = $pdo->prepare($sql);
            $stm->bindValue(1, $id);
            $stm->execute();

            if($stm->rowCount() != 0){
                return $stm->fetchAll(PDO::FETCH_ASSOC);
            }else{
                return 0;
            }
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    } 

    public function editarContato($id_contato, $nome, $telefones, $enderecos)
    {
        try{
            if(!empty($id_contato) && !empty($nome) && !empty($telefones)){
                $pdo = require "conexao.php";

                // Contato
                $sql = "UPDATE contato SET nome = ? WHERE id_contato = ?;";
                $stm = $pdo->prepare($sql);
                $stm->bindValue(1, $nome);
                $stm->bindValue(2, $id_contato);
                $stm->execute();

                // Telefone
                $countTel = count($telefones);
                if($countTel > 1){
                    // IMPLEMENTAR
                    for($i=0; $i<$countTel; $i++){
    
                    }
                }else{
                    $sql = "UPDATE telefone SET telefone = ? WHERE id_contato = ?;";

                    $stm = $pdo->prepare($sql);
                    $stm->bindValue(1, $telefone);
                    $stm->bindValue(2, $id_contato);
                    $stm->execute();
                }

                // Endereco
                $countEnd = count($enderecos);
                if($countEnd > 1){
                    // IMPLEMENTAR
                    for($i=0; $i<$countEnd; $i++){
    
                    }
                }else{
                    $sql = "UPDATE endereco SET cep = ?, rua = ?, bairro = ?, cidade = ?, estado = ? WHERE id_contato = ?;";

                    $stm = $pdo->prepare($sql);
                    $stm->bindValue(1, $cep);
                    $stm->bindValue(2, $rua);
                    $stm->bindValue(3, $bairro);
                    $stm->bindValue(4, $cidade);
                    $stm->bindValue(5, $estado);
                    $stm->bindValue(6, $id_contato);
                    $stm->execute();
                }
                return true;
            }else{
                return false;
            }
        }catch(PDOException $e){
            $e->getMessage();
        }

    }
}