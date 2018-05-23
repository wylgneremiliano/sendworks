$(document).ready(function () {
    $("#butao1").click(function () {
        $.ajax({
            type: 'GET',
            url: '/texto.html',
            data: "",
            success: function (dados) {
                $("#div_retorno").html(dados);
            },
            beforeSend: function () {
                $("#processando").css({display: "block"});
            },
            complete: function () {
                setTimeout(function () {
                    $("#processando").css({display: "none"});
                }, 5000);
            },
            error: function () {
                $("#div_retorno").html("Erro em chamar a função.");
                setTimeout(function () {
                    $("#div_retorno").css({display: "none"});
                }, 5000);
            }
        });
    });
});
$(document).ready(function () {
    $("#formCadastro").submit(function (e) {
        e.preventDefault(); // evita que o formulário seja submetido
        $.ajax({
            type: 'POST',
            url: '/cadastro',
            data: $("#formCadastro").serializeArray(),
            success: function (dados) {
                $("#div_retorno").html(dados);
            },
            beforeSend: function () {
                $("#processando").css({display: "block"});
            },
            complete: function () {
                setTimeout(function () {
                    $("#processando").css({display: "none"});
                }, 5000);
            },
            error: function () {
                $("#div_retorno").html("Erro em chamar a função.");
                setTimeout(function () {
                    $("#div_retorno").css({display: "none"});
                }, 5000);
            }
        });
    });
});



function reapareceDiv() {
    document.getElementById("esqueci-senha").style.display = "block";
}
function tiraDiv() {
    document.getElementById("esqueci-senha").style.display = "none";
}
