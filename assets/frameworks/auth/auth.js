$(function(){
    $('input').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%'
    });
});

$("#btEnviarNovoUsuario").bind("click", function() {
    if ($("#email").val() != $("#email2").val()) {
        alert("Os dois e-mails devem ser iguais");
        event.preventDefault();
    }
    if ($("#password").val() != $("#password2").val()) {
        alert("As duas senhas devem ser iguais");
        event.preventDefault();
    }
    if (!validarCPF($("#cpf").val())) {
        alert("Digite um CPF válido");
        event.preventDefault();
    }
});

$(document).ready(function ($) { 
    $.backstretch(dir_base+'public/images/auth/fundo.png');  
});    