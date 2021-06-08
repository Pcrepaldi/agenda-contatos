$(document).ready( function() {
    $('#cep').hide(0);
    $('#rua').hide(0);
    $('#bairro').hide(0);
    $('#cidade').hide(0);
    $('#estado').hide(0);

    $('#mais-campos').on('click', function() {
        $('#cep').toggle(0);
        $('#rua').toggle(0);
        $('#bairro').toggle(0);
        $('#cidade').toggle(0);
        $('#estado').toggle(0);        
    });

});