$(document).ready( function() {

    // TELEFONE
    var add_tel = $('#add-telefone[tel-id="1"]');
    var novo_tel = $('#novo-telefone');

    $(add_tel).click(function() {
        console.log("---Adicionar Telefone---");
        $(novo_tel).click(function(e){
            e.preventDefault();

            var id_contato = $('.campos').attr("id_contato");
            var telefone2 = $('#telefone2').val();
            console.log("id_contato - " + id_contato);
            console.log("telefone2 - " + telefone2);
    
            $.ajax({
                url: './inserirTelefoneAJAX.php',
                method: 'POST',
                data: {
                    id_contato: id_contato,
                    telefone: telefone2
                },
                dataType: 'json'
            }).done(function(resposta){
                console.log("Inserido com sucesso - "+resposta);
            })
            document.location.reload(true);
        });
    });

    // ENDERECO
    var add_end = $('#add-endereco[tel-id="1"]');
    var novo_end = $('#novo-endereco');

    $(add_end).click(function() {
        console.log("---Adicionar Endereco---");
        $(novo_end).click(function(e){
            e.preventDefault();

            var id_contato = $('.campos').attr("id_contato");
            var cep = $('#cep').val();
            var rua = $('#rua').val();
            var bairro = $('#bairro').val();
            var cidade = $('#cidade').val();
            var estado = $('#estado').val();

            console.log("id_contato - " + id_contato);
            console.log("cep - " + cep);
            console.log("rua - " + rua);
            console.log("bairro - " + bairro);
            console.log("cidade - " + cidade);
            console.log("estado - " + estado);

            $.ajax({
                url: './inserirEnderecoAJAX.php',
                method: 'POST',
                data: {
                    id_contato: id_contato,
                    cep: cep,
                    rua: rua,
                    bairro: bairro,
                    cidade: cidade,
                    estado: estado
                },
                dataType: 'json'
            }).done(function(resposta){
                console.log("Inserido com sucesso - "+resposta);
            })
            document.location.reload(true);
        });
});

});