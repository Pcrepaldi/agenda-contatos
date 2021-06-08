
$('#mensagem').hide(0);

$('#form-contato').submit(function(e){
    e.preventDefault();

    var nome = $('#nome').val();
    var telefone = $('#telefone').val();
    var cep = $('#cep').val();
    var rua = $('#rua').val();
    var bairro = $('#bairro').val();
    var cidade = $('#cidade').val();
    var estado = $('#estado').val();

    $.ajax({
        url: './inserirContatoAJAX.php',
        method: 'POST',
        data: {
            nome: nome,
            telefone: telefone,
            cep: cep,
            rua: rua,
            bairro: bairro,
            cidade: cidade,
            estado: estado
        },
        dataType: 'json'
    }).done(function(resposta){

        $('#nome').val('');
        $('#telefone').val('');
        $('#cep').val('');
        $('#rua').val('');
        $('#bairro').val('');
        $('#cidade').val('');
        $('#estado').val('');

        if(resposta != "Contato inserido com sucesso"){
            $('.message').removeClass("message-sucess");
            $('.message').addClass("message-error");
        }else{
            $('.message').addClass("message-sucess");
            $('.message').removeClass("message-error");
        }

        var m = document.getElementById('mensagem');
        m.innerHTML = resposta;
        $('#mensagem').show();

    })

});