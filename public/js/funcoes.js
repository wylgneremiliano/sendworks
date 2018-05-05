$(document).ready(function () {
    $("#bt1").click(function () {
        $.ajax({
            type: 'GET',
             url: '/texto.html',
            data: '',
            success: function(dados){
                $("#div_retorno").html(dados);
            },
            beforeSend: function(){
                $("#processando").css({display: "block"});
            },
            complete: function(){
                setTimeout(function() {
                $("#processando").css({display: "none"});    
                }, 5000);
                
            },
            erro: function(){
                $("#div_retorno").html("ERRO na função");
                setTimeout(function() {
                $("#div_retorno").css({display: "none"});    
                }, 5000);
            }
        });
    });
});