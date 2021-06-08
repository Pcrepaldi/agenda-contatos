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

        $telefones_count = count($telefones);
        $enderecos_count = count($enderecos);
        
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
        <form method="post" id="form-contato">
            <div class="campos" id_contato="<?php echo $id_contato;?>">
                <h5><?php echo !empty($contatos['nome']) ? $contatos['nome'] : "";?></h5>
                <div id="div-telefone">
                    <?php
                        echo "<hr>";
                        for($i=0; $i < $telefones_count; $i++){    
                            if($i == 0){
                                echo "<div>#".($i+1)." Telefone: ".$telefones[$i]['telefone']."</div>";
                            }else{
                                echo "<div>#".($i+1)." Telefone: ".$telefones[$i]['telefone']."</div>";
                            }
                        }
                    ?>
                </div>
                <a href="#" id="add-telefone" tel-id="1" type="button" data-toggle="modal" data-target="#myModal">Adicionar Telefone</a>
                <!-- The Modal -->
                <div class="modal fade" id="myModal">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title">Novo telefone</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <!-- Modal body -->
                            <div class="modal-body">
                                <input type="text" id="telefone2" name="telefone2" class="input-txt"
                                    placeholder="Número de telefone" maxlength="15" minlength="9" required
                                    style="padding:0 10 0 0; margin: 0;">
                            </div>
                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <button type="submit" id="novo-telefone" class="btn btn-success"
                                    data-dismiss="modal" style="color: white;">Novo</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="div-endereco">
                    <?php
                        for($i=0; $i < $enderecos_count; $i++){
                            echo "<hr>";
                            echo "<h5>#".($i+1)." Endereço</h5>";
                            echo "<div>Cep: ".$enderecos[$i]['cep']."</div>";
                            echo "<div>Rua: ".$enderecos[$i]['rua']."</div>";
                            echo "<div>Bairro: ".$enderecos[$i]['bairro']."</div>";
                            echo "<div>Cep: ".$enderecos[$i]['cidade']."</div>";
                            echo "<div>Estado: ".$enderecos[$i]['estado']."</div>";
                        }
                    ?>
                    <a href="#" id="add-endereco" tel-id="1" type="button" data-toggle="modal" data-target="#myModal2">Adicionar Endereço</a>
                </div>
                <!-- The Modal -->
                <div class="modal fade" id="myModal2">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title">Novo Endereço</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <!-- Modal body -->
                            <div class="modal-body">
                                <input type="text" id="cep"    name="cep2"    class="input-txt" placeholder="Cep"    maxlength="9" >
                                <input type="text" id="rua"    name="rua2"    class="input-txt" placeholder="Rua"    maxlength="50">
                                <input type="text" id="bairro" name="bairro2" class="input-txt" placeholder="Bairro" maxlength="50">
                                <input type="text" id="cidade" name="cidade2" class="input-txt" placeholder="Cidade" maxlength="15">
                                <select id="estado" name="estado2">
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
                            </div>
                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <button type="submit" id="novo-endereco" class="btn btn-success"
                                    data-dismiss="modal" style="color: white;">Novo</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="botoes">
                    <a href="index.php"><input type="button" value="Voltar" class="btn-default"></a>
                </div>
            </div>
        </form>
    </div>
</section>
<script src="./assets/js/jQuery/jquery-3.5.1.js"></script>
<script src="./assets/js/editarContatojQuery.js"></script>
<script src="./assets/js/consulta-cep.js"></script>
<script>
// Atribuindo "selected" à option estado
/*var estado = document.getElementById('estado');
var preSelected = estado.getAttribute('pre-selected');

var options = [];
$('#estado').find('option').each(function() {
    var valor = $(this).val();

    if(valor == preSelected){
        $(this).prop('selected', true);
    }
});*/
</script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>