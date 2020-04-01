$(document).ready(function () {
    var pagina = 1; //página inicial
    listar_usuario(pagina);
});

function listar_usuario(pagina, varcomp = null) {
    var dados = {
        pagina: pagina
    };
    $.post('../../adm/carregar-usuarios-js/listar/' + pagina + '?tiporesult=1', dados, function (retorna) {
        $("#conteudo").html(retorna);
    });
}

$(function () {
    //Verificado se o usuário digitou algum valor no campo
    $("#pesqUser").keyup(function () {
        var pesqUser = $(this).val();

        //Verificar se há valor na variável "pesqUser".
        if (pesqUser !== '') {
            var dados = {
                palavraPesq: pesqUser
            };
            $.post('../../adm/carregar-usuarios-js/listar/1?tiporesult=2', dados, function (retorna) {
                //Carregar o conteúdo para o usuário
                $("#conteudo").html(retorna);
            });
        } else {
            var pagina = 1; //página inicial
            listar_usuario(pagina);
        }
    });
});
// visualizar usuario modal
$(document).ready(function () {
    $(document).on('click', '.view_data', function () {
        var user_id = $(this).attr('id');
        //alert(user_id);
        if (user_id !== '') {
            var dados = {
                user_id: user_id
            };
            $.post('../../adm/ver-usuario-modal/ver-usuario/' + user_id, dados, function (retorna) {
                //Carregar o conteúdo para o usuário
                $("#visul_usuario").html(retorna);
                $('#visulUsuarioModal').modal('show');
            });
        }
    });
});
// apagar usuario modal
$(document).ready(function () {
    $(document).on('click', 'del_data', function () {
        var user_id = $(this).attr('id');
        //alert(user_id);
        $.post('../../adm/apagar-usuario-modal/apagar-usuario/' + user_id, function (retorna) {
            alert(user_id)
            //$('#visulUsuarioModal').modal('show');
        });
    });
});
//Cadastro genérico
$("#insert_form").on("submit", function (event) {
    event.preventDefault();

    var enderecocad = jQuery('.enderecocad').attr("data-enderecocad");
    //console.log(enderecocad);
    $.ajax({
        method: "POST",
        url: enderecocad,
        data: new FormData(this),
        contentType: false,
        processData: false,
        success: function (retorna) {
            if (retorna['erro']) {
                //console.log(retorna);
                //console.log("Sucesso");
                //$('#msgCad').html(retorna['msg']);
                $('.addModal').modal('hide');
                $('#addSucessoModal').modal('show');
                listar_usuario(1);
            } else {
                //console.log(retorna);
                //console.log("Erro");
                $('#msgCad').html(retorna['msg']);
            }
        }
    });
});
