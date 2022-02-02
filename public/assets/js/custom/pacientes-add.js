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

    $("#cpf").on("blur", function() {

        //Nova variável "cpf" somente com dígitos.
        let cpf = $(this).val().replace(/\D/g, '');

        //Verifica se campo cpf foi preenchido completamente
        if (cpf != "" && cpf.length == 11) {

            //Verifica se o cpf tem todos os dígitos repetidos (ignora os verificadores)
            if (cpf[0] == cpf[1] && cpf[1] == cpf[2] && cpf[2] == cpf[3] && cpf[3] == cpf[4] && cpf[4] == cpf[5] && cpf[5] == cpf[6] && cpf[6] == cpf[7] && cpf[7] == cpf[8]) {
                $(this).attr('class', 'validate invalid');
            } else {
                //Os digitos não são todos repetidos
                //Armazena digitos a serem verificados (primeiros nove), de trás para a frente
                let digitos = [];
                for (let i = 8; i >= 0; i--) {
                    digitos.push(cpf[i]);
                }

                //Cálculo do dígito verificador 'v1'
                let v1 = 0;
                for (let i = 0; i < 9; i++) {
                    v1 = v1 + digitos[i] * (9 - (i % 10));
                }
                v1 = (v1 % 11) % 10;

                // cálculo do dígito verificador 'v2'
                let v2 = 0;
                for (let i = 0; i < 9; i++) {
                    v2 = v2 + digitos[i] * (9 - ((i + 1) % 10));
                }
                v2 = (v2 + v1 * 9) % 11;
                v2 = v2 % 10;

                //Verifica se os dígitos verificadores calculados correspondem com os informados
                if (v1 == cpf[9] && v2 == cpf[10]) {
                    $(this).attr('class', 'validate valid');
                } else {
                    $(this).attr('class', 'validate invalid');
                }
            }
        } else {
            //Campo cpf incompleto
            $(this).attr('class', 'validate invalid');
        }
    });

    $("#cns").on("blur", function() {

        //Nova variável "cns" somente com dígitos.
        let cns = $(this).val().replace(/\D/g, '');

        if (cns.length != 15) {
            $(this).attr('class', 'validate invalid');
        } else {
            if (cns[0] == 1 || cns[0] == 2) {
                let soma = 0;
                let resto;
                let dv;
                let pis = new String("");
                let resultado = new String("");

                pis = cns.substr(0, 11);

                for (let i = 0; i < 11; i++) {
                    soma = soma + pis[i] * (15 - i);
                }

                resto = soma % 11;
                dv = 11 - resto;

                if (dv == 11) {
                    dv = 0;
                }

                if (dv == 10) {
                    soma = 0;
                    for (let i = 0; i < 11; i++) {
                        soma = soma + pis[i] * (15 - i);
                    }
                    soma = soma + 2;

                    resto = soma % 11;
                    dv = 11 - resto;
                    resultado = pis + "001" + String(dv);
                } else {
                    resultado = pis + "000" + String(dv);
                }

                if (cns != resultado) {
                    $(this).attr('class', 'validate invalid');
                } else {
                    $(this).attr('class', 'validate valid');
                }
            } else if (cns[0] == 7 || cns[0] == 8 || cns[0] == 9) {
                let soma = 0;
                let resto;
                let dv;

                for (let i = 0; i < 15; i++) {
                    soma = soma + cns[i] * (15 - i);
                }

                resto = soma % 11;

                if (resto != 0) {
                    $(this).attr('class', 'validate invalid');
                } else {
                    $(this).attr('class', 'validate valid');
                }
            } else {
                $(this).attr('class', 'validate invalid');
            }

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
        if (this.files[0].size > 1048576) {
            alert("Escolha uma foto de até 1MiB!");
            this.value = "";
        } else {
            readURL(this);
        }
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
