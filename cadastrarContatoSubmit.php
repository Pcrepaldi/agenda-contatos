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
<?php
    require_once "./layout/header.php";
?>
    <section>
        <div class="container">
            <div class="container-cabecalho">
                <h1>Criar novo contato Submit</h1>
            </div>
            <form method="post" action="cadastrarContatoSubmit.php" id="form-contato">
                <div class="campos">
                    <input type="text" id="nome"     name="nome"     class="input-txt" placeholder="Insira um nome"     maxlength="50" minlength="3" required>
                    <input type="text" id="telefone" name="telefone" class="input-txt" placeholder="Número de telefone" maxlength="15" minlength="9" required>
                    <input type="text" id="cep"      name="cep"      class="input-txt" placeholder="Cep"                maxlength="9">
                    <input type="text" id="rua"      name="rua"      class="input-txt" placeholder="Rua"                maxlength="50">
                    <input type="text" id="bairro"   name="bairro"   class="input-txt" placeholder="Bairro"             maxlength="50">
                    <input type="text" id="cidade"   name="cidade"   class="input-txt" placeholder="Cidade"             maxlength="15">
                    <select id="estado" name="estado">
                        <option value="">Selecione...</option>
                        <option value="AC">AC</option>
                        <option value="AL">AL</option>
                        <option value="AP">AP</option>
                        <option value="AM">AM</option>
                        <option value="BA">BA</option>
                        <option value="CE">CE</option>
                        <option value="DF">DF</option>
                        <option value="ES">ES</option>
                        <option value="GO">GO</option>
                        <option value="MA">MA</option>
                        <option value="MS">MS</option>
                        <option value="MT">MT</option>
                        <option value="MG">MG</option>
                        <option value="PA">PA</option>
                        <option value="PB">PB</option>
                        <option value="PR">PR</option>
                        <option value="PE">PE</option>
                        <option value="PI">PI</option>
                        <option value="RJ">RJ</option>
                        <option value="RN">RN</option>
                        <option value="RS">RS</option>
                        <option value="RO">RO</option>
                        <option value="RR">RR</option>
                        <option value="SC">SC</option>
                        <option value="SP">SP</option>
                        <option value="SE">SE</option>
                        <option value="TO">TO</option>
                    </select>

                    <a href="#" id="mais-campos" type="button">Mais Campos</a>
                    <div class="botoes">
                        <a href="index.php"><input type="button" value="Voltar" class="btn-default"></a>
                        <input type="submit" value="Novo" class="btn-default btn-sucess">
                    </div>
                </div>
                
                <?php
                    require "./inserirContatoSubmit.php";
                ?>
            </form>
        </div>
        </section>

        <script src="./assets/js/jQuery/jquery-3.5.1.js"></script>
        <script src="./assets/js/cadastrarContatojQuery.js"></script>
        <script src="./assets/js/consulta-cep.js"></script>

    </body>
</html>