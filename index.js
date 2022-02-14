function validaForm(form)
{
    //console.log($(form));
    console.log($(form).find(':input').length);

    let inp, lab;
    let erros = [];

    for(let i = 0; i < $(form).find(':input').length; i++) {
        inp = $(form).find(':input').eq(i);
        lab = inp.siblings('label').text();

        
        // Valida se campo vazio.
        if(inp.val().trim().length == 0) {
            alert('Este campo não pode ficar vazio.');
            inp.focus();
            return;
        }

        // Valida campos personalizados.
        if(inp.data('tipo') == 'email') {
            if(!validaCampoEmail(inp.val().trim())){
                alert('E-mail inválido.');
                inp.focus();
                return;
            }
        } else if(inp.data('tipo') == 'cep') {
            if(!validaCampoCEP(inp.val().trim())){
                alert('CEP inválido: informe 8 digitos, somente números.');
                inp.focus();
                return;
            }
        }

        // Valida senha
        if(inp.attr('type') == 'password') {
            if(!validaCampoSenha(inp.val().trim())){
                alert('A senha precisa conter 8 caracteres no mínimo, com 1 letra e 1 número.');
                inp.focus();
                return;
            }
        }
    }

    //console.log('Validação OK');
}

function validaCampoEmail(valor) {
    let regex = /[a-z0-9_-]+@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/gi;
    return regex.test(valor);
}

function validaCampoSenha(valor) {
    // Valida 8 caracteres no minimo, com letra e numero obrigatório.
    // Permite caracteres especiais.
    let regex = /^(?=.*\d)(?=.*[a-zA-Z]).{8,}$/g;
    return regex.test(valor);
}

function validaCampoCEP(valor) {
    let regex = /^\d{8}$/g;
    return regex.test(valor);
}


$(document).ready(function(){

    // Disparo automático retardados.
    window.setTimeout(function(){
        $('#ex1_btn_refresh').click();
    }, 1000);


    $(document).on('click', '#submitEx1', function(ev){
        ev.stopPropagation();
        ev.preventDefault();
        validaForm($(ev.currentTarget).parents('form')[0]);

        $.post(
            './request.php?op=ex1-insert',
            $(ev.currentTarget).parents('form').serialize(),
            function(response){
                let rJson = JSON.parse(response);
            
                console.log(response);
                if(rJson.success == true) {
                    alert('Salvo!');
                    $('#ex1_btn_refresh').click();
                } else if(rJson.success == false) {
                    alert(rJson.mensagem);
                } else {
                    alert(response);
                }
        });
    });

    $(document).on('click', '#ex1_btn_refresh', function(ev){
        $.post(
            './request.php?op=ex1-select',
            function(response){
                let rJson = JSON.parse(response);

                if(rJson.success == true) {
                    let dados = rJson.dados;
                    let tabela = $('#ex1-table');

                    tabela.find('tbody').children().remove();
                    dados.forEach(function(d){
                        tabela.find('tbody').append('<tr>'+
                        '<td>'+d.id+'</td>'+
                        '<td>'+d.nome+'</td>'+
                        '<td>'+d.userName+'</td>'+
                        '<td>'+d.zipCode+'</td>'+
                        '<td>'+d.email+'</td>'+
                        '<td>'+d.password+'</td>'+
                        '<td>'+d.dt_criacao+'</td>'+
                        '</tr>');
                    });
                } else if(rJson.success == false) {
                    alert(rJson.mensagem);
                } else {
                    alert(response);
                }
        });
    });

});