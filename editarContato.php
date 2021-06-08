<?php 
    require_once "./layout/header.php"; 
    require "./classes/Contato.php";

    $contato = new Contato();

    $c = null;
    $id_contato = null;
    $telefones_count = 0;
    $enderecos_count = 0;

    if (isset($_GET['id'])) {
        $id_contato = $_GET['id'];
        $contatos = $contato->listarContatoId($id_contato);
        $telefones = $contato->listarTelefoneId($id_contato);
        $enderecos = $contato->listarEnderecoId($id_contato);

        //$telefones_count = count($telefones);
        //$enderecos_count = count($enderecos);
    }else{
        header("location: index.php");
        die();
    }
?>  
<section>
    <div class="container">
        <div class="container-cabecalho">
            <h1>Editar contato</h1>
        </div>
        <form method="post" action="editarContato.php?id=<?php echo $id_contato;?>" id="form-contato">
            <div class="campos">
                <input type="text" id="nome" name="nome" class="input-txt" placeholder="Insira um nome" maxlength="50" minlength="3" required value="<?php echo !empty($contatos['nome']) ? $contatos['nome'] : "";?>">
                <div id="div-telefone">
                    <input type="text" id="telefone" name="telefone" class="input-txt" placeholder="Número de telefone" maxlength="15" minlength="9" required value="<?php echo !empty($telefones[0]['telefone']) ? $telefones[0]['telefone'] : "";?>">
                </div>
                <a href="#" id="add-telefone" tel-id="1" type="button">Adicionar Telefone</a>
                <div id="div-endereco">
                    <input type="text" id="cep"    name="cep"    class="input-txt" placeholder="Cep"    maxlength="9"  value="<?php echo !empty($enderecos[0]['cep']) ? $enderecos[0]['cep'] : "";?>">
                    <input type="text" id="rua"    name="rua"    class="input-txt" placeholder="Rua"    maxlength="50" value="<?php echo !empty($enderecos[0]['rua']) ? $enderecos[0]['rua'] : "";?>">
                    <input type="text" id="bairro" name="bairro" class="input-txt" placeholder="Bairro" maxlength="50" value="<?php echo !empty($enderecos[0]['bairro']) ? $enderecos[0]['bairro'] : "";?>">
                    <input type="text" id="cidade" name="cidade" class="input-txt" placeholder="Cidade" maxlength="15" value="<?php echo !empty($enderecos[0]['cidade']) ? $enderecos[0]['cidade'] : "";?>">
                    <select id="estado" name="estado" pre-selected="<?php echo !empty($enderecos[0]['estado']) ? $enderecos[0]['estado'] : "";?>">
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
                    <br><a href="#" id="add-endereco" type="button">Adicionar Endereço</a>
                </div>
                <div class="botoes">
                    <a href="index.php"><input type="button" value="Voltar" class="btn-default"></a>
                    <input type="submit" value="Salvar" class="btn-default btn-sucess">
                </div>
            </div>
            <?php
                /*if(isset($_POST['nome'])){
                    $nome = $_POST['nome'];
                }*/
            
                $qtd_tel = 1;
                if(isset($_POST['quantidadeCampos'])){
                    $qtd_tel = $_POST['quantidadeCampos'];
                }

                //echo $qtd_tel != 1 ? "<div id='eu'>".$qtd_tel."</div>" : "<div id='eu'>1</div>";
                
                for($i=0; $i<$qtd_tel; $i++){
                    if($i == 1){
                        $telefone = $_POST['telefone'];    
                    }else{
                        $telefone = $_POST["telefone$qtd_tel"];
                        $contato->inserirTelefone($id_contato, $telefone);
                    }
                } 
            ?>
        </form>
    </div>
    </section>
    <script src="./assets/js/jQuery/jquery-3.5.1.js"></script>
    <script src="./assets/js/editarContatojQuery.js"></script>
    <script src="./assets/js/consulta-cep.js"></script>
    <script>
        // Atribuindo "selected" à option estado
        var estado = document.getElementById('estado');
        var preSelected = estado.getAttribute('pre-selected');

        var options = [];
        $('#estado').find('option').each(function() {
            var valor = $(this).val();

            if(valor == preSelected){
                $(this).prop('selected', true);
            }
        });
    </script>
    </body>
</html>

