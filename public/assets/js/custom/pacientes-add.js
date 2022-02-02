/**
 * Script por ViaCEP.
 * Original em:
 * https://viacep.com.br/exemplo/jquery/
 */
$(function() {

    function limpa_formulário_cep() {
        // Limpa valores do formulário de cep.
        $("#logradouro").val("");
        $("#bairro").val("");
        $("#cidade").val("");
        $("#estado").val("");
    }

    //Quando o campo cep perde o foco.
    $("#cep").on('blur', function() {

        //Nova variável "cep" somente com dígitos.
        var cep = $(this).val().replace(/\D/g, '');

        //Verifica se campo cep possui valor informado.
        if (cep != "") {

            //Expressão regular para validar o CEP.
            var validacep = /^[0-9]{8}$/;

            //Valida o formato do CEP.
            if (validacep.test(cep)) {

                //Preenche os campos com "..." enquanto consulta webservice.
                $("#logradouro").val("...");
                $("#bairro").val("...");
                $("#cidade").val("...");
                $("#estado").val("...");
                M.updateTextFields();

                //Consulta o webservice viacep.com.br/
                $.getJSON("https://viacep.com.br/ws/" + cep + "/json/?callback=?", function(dados) {

                    if (!("erro" in dados)) {
                        //Atualiza os campos com os valores da consulta.
                        $("#logradouro").val(dados.logradouro);
                        $("#bairro").val(dados.bairro);
                        $("#cidade").val(dados.localidade);
                        $("#estado").val(dados.uf);
                        //Atualiza texto de ajuda/validação do campo "logradouro".
                        $("#logradouro").attr('class', 'validate valid');
                    } //end if.
                    else {
                        //CEP pesquisado não foi encontrado.
                        limpa_formulário_cep();
                        alert("CEP não encontrado.");
                        //Atualiza texto de ajuda/validação do campo "logradouro".
                        $("#logradouro").attr('class', 'validate invalid');
                    }
                });
            } //end if.
            else {
                //cep é inválido.
                limpa_formulário_cep();
                alert("Formato de CEP inválido.");
                //Atualiza texto de ajuda/validação do campo "logradouro".
                $("#logradouro").attr('class', 'validate invalid');
            }
        } //end if.
        else {
            //cep sem valor, limpa formulário.
            limpa_formulário_cep();
        }
    });

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#foto').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#foto_input").on("change", function() {
        readURL(this);
    });

    //Máscaras
    if ($('.cpf').length){
        $('.cpf').mask('000.000.000-00');
    }
    if ($('.cns').length){
        $('.cns').mask('000 0000 0000 0000');
    }
    if ($('.cep').length){
        $('.cep').mask('00.000-000');
    }

    $('select').formSelect();
});
