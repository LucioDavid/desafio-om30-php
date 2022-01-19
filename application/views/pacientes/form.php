<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <!-- Adicionando Javascript -->
    <script>
        /**
         * Script por ViaCEP.
         * Original em:
         * https://viacep.com.br/exemplo/jquery/
         */
        $(document).ready(function() {

            function limpa_formulário_cep() {
                // Limpa valores do formulário de cep.
                $("#logradouro").val("");
                $("#bairro").val("");
                $("#cidade").val("");
                $("#estado").val("");
            }

            //Quando o campo cep perde o foco.
            $("#cep").blur(function() {

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
                            } //end if.
                            else {
                                //CEP pesquisado não foi encontrado.
                                limpa_formulário_cep();
                                alert("CEP não encontrado.");
                            }
                        });
                    } //end if.
                    else {
                        //cep é inválido.
                        limpa_formulário_cep();
                        alert("Formato de CEP inválido.");
                    }
                } //end if.
                else {
                    //cep sem valor, limpa formulário.
                    limpa_formulário_cep();
                }
            });

            $("#cpf").blur(function() {

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

            $("#cns").blur(function() {

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
        });
    </script>
    <script>
        /**
         * Script por Fernando Valler.
         * Original em:
         * https://gist.github.com/fernandovaller/b10a3be0e7b3b46e5895b0f0e75aada5
         */
        function mascara_cpf(i) {

            let v = i.value;
            v = v.replace(/\D/g, "") //Remove tudo o que não é dígito
            v = v.replace(/(\d{3})(\d)/, "$1.$2") //Coloca um ponto entre o terceiro e o quarto dígitos
            v = v.replace(/(\d{3})(\d)/, "$1.$2") //Coloca um ponto entre o terceiro e o quarto dígitos
            //de novo (para o segundo bloco de números)
            v = v.replace(/(\d{3})(\d{1,2})$/, "$1-$2") //Coloca um hífen entre o terceiro e o quarto dígitos
            i.value = v;
        }

        function mascara_cep(i) { // Inspirada na função anterior, "mascara_cpf".

            let v = i.value;

            v = v.replace(/\D/g, "") //Remove tudo o que não é dígito
            v = v.replace(/(\d{2})(\d)/, "$1.$2")
            v = v.replace(/(\d{3})(\d{1,3})$/, "$1-$2")
            i.value = v;
        }

        function mascara_cns(i) { // Inspirada na função anterior, "mascara_cpf".

            let v = i.value;

            v = v.replace(/\D/g, "") //Remove tudo o que não é dígito
            v = v.replace(/(\d{3})(\d)/, "$1 $2")
            v = v.replace(/(\d{4})(\d)/, "$1 $2")
            v = v.replace(/(\d{4})(\d{1,4})$/, "$1 $2")
            i.value = v;
        }
    </script>
</head>

<body>
    <title><?= $titulo_pagina ?></title>

    <div class="container">
        <h1 class="center"><?= $titulo_pagina ?></h1>

        <h4>Dados Pessoais</h4>
        <?= form_open_multipart('pacientes/armazenar'); ?>
        <div class="card-panel">
            <div class="row">
                <div class="input-field col s12 m8 l9">
                    <label for="nome">Nome Completo</label>
                    <input type="text" name="nome" id="nome" maxlength="100" class="validate" required>
                    <span class="helper-text" data-error="obrigatório" data-success=""></span>
                </div>
                <div class="input-field col s12 m4 l3">
                    <label for="data_nasc">Data de Nascimento</label>
                    <input type="date" placeholder=" " name="data_nasc" id="data_nasc" class="validate" required>
                    <span class="helper-text" data-error="obrigatório" data-success=""></span>
                </div>
                <div class="input-field col s12 m6">
                    <label for="cpf">CPF</label>
                    <input type="text" name="cpf" id="cpf" class="validate" oninput="mascara_cpf(this)" maxlength="14" required>
                    <span class="helper-text" data-error="CPF inválido" data-success=""></span>
                </div>
                <div class="input-field col s12 m6">
                    <label for="cns">CNS – Cartão Nacional de Saúde</label>
                    <input type="text" name="cns" id="cns" class="validate" oninput="mascara_cns(this)" maxlength="18" required>
                    <span class="helper-text" data-error="CNS inválido" data-success=""></span>
                </div>
            </div>
        </div>

        <h4>Dados da Mãe</h4>
        <div class="card-panel">
            <div class="row">
                <div class="input-field col s12">
                    <label for="nome_mae">Nome Completo da Mãe</label>
                    <input type="text" name="nome_mae" id="nome_mae" class="validate" maxlength="100" required>
                    <span class="helper-text" data-error="obrigatório" data-success=""></span>
                </div>
            </div>
        </div>

        <h4>Endereço</h4>
        <div class="card-panel">
            <div class="row">
                <div class="input-field col s12">
                    <label for="cep">CEP</label>
                    <input type="text" name="cep" id="cep" class="validate" oninput="mascara_cep(this)" maxlength="10" required>
                    <span class="helper-text" data-error="obrigatório" data-success=""></span>
                </div>
                <div class="input-field col s12">
                    <label for="logradouro">Logradouro</label>
                    <input type="text" name="logradouro" id="logradouro" class="validate" maxlength="100" required>
                    <span class="helper-text" data-error="obrigatório" data-success=""></span>
                </div>
                <div class="input-field col s12">
                    <label for="numero">Número</label>
                    <input type="number" name="numero" id="numero" min="1">
                </div>
                <div class="input-field col s12">
                    <label for="complemento">Complemento</label>
                    <input type="text" name="complemento" id="complemento" maxlength="100">
                </div>
                <div class="input-field col s12">
                    <label for="bairro">Bairro</label>
                    <input type="text" name="bairro" id="bairro" class="grey-text text-darken-1" maxlength="100" required readonly>
                </div>
                <div class="input-field col s12">
                    <label for="cidade">Cidade</label>
                    <input type="text" name="cidade" id="cidade" class="grey-text text-darken-1" maxlength="100" required readonly>
                </div>
                <div class="input-field col s12">
                    <label for="estado">Estado</label>
                    <input type="text" name="estado" id="estado" class="grey-text text-darken-1" required readonly>
                </div>
            </div>
        </div>
        <?= form_close(); ?>
    </div>
</body>

</html>