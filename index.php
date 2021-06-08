<?php
    session_start();

    // Verifica se a variável de sessão existe
    if(!isset($_SESSION["usuario_logado"])){
        header("Location: login.php");
    }

    if(isset($_GET["sair"])){
        unset($_SESSION["usuario_logado"]); // "destrói" a variável de sessão
        header("Location: login.php"); // Redireciona para a página de login
    }

?>

<?php require_once "./layout/header-index.php" ?>

<section>
    <div class="container-index">
        <div style="width: 100%; color: white; text-align: left;
                    font-size: 34px; margin: 15px;">
            Contatos
        </div>
        <?php
            require_once "./classes/Contato.php";
            $contato = new Contato();

            $filtrar = null;
            if(isset($_GET['filtrar'])){
                $filtrar = $_GET['filtrar'];
            }

            $contatos = $contato->listarTodosContatos($filtrar);

            $total = count($contatos);
        ?>
        <div class="container-index container" style="min-width: 100%;">
            <table class="table table-hover">
                <tbody>
                    <?php if($total == 0): ?>
                    <h3>Nenhum contato encontrado</h3>
                    <?php endif; ?>
                    <?php foreach($contatos as $c): ?>
                    <tr onclick="document.location = './editarContatoModal.php?id=<?php echo $c['id_contato'];?>'">
                        <td id_contato="<?php echo $c['id_contato'];?>">
                            <?php echo $c['nome'];?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php require_once "./layout/footer.php";?>