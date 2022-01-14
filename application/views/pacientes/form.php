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
        });

        function mascara_cpf(i) {

            var v = i.value;

            if (isNaN(v[v.length - 1])) { // impede entrar outro caractere que não seja número
                i.value = v.substring(0, v.length - 1);
                return;
            }

            i.setAttribute("maxlength", "14");
            if (v.length == 3 || v.length == 7) i.value += ".";
            if (v.length == 11) i.value += "-";

        }

        function mascara_cep(i) {

            var v = i.value;

            if (isNaN(v[v.length - 1])) { // impede entrar outro caractere que não seja número
                i.value = v.substring(0, v.length - 1);
                return;
            }

            i.setAttribute("maxlength", "14");
            if (v.length == 2) i.value += ".";
            if (v.length == 6) i.value += "-";

        }
    </script>
</head>

<body>
    <title><?= $titulo_pagina ?></title>

    <div class="container">
        <h1><?= $titulo_pagina ?></h1>

        <?= form_open_multipart('pacientes/armazenar'); ?>
        <div class="card-panel">
            <div class="row">
                <div class="input-field col s12 m8 l9">
                    <label for="nome">Nome Completo</label>
                    <input type="text" name="nome" id="nome">
                </div>
                <div class="input-field col s12 m4 l3">
                    <label for="data_nasc">Data de Nascimento</label>
                    <input type="date" name="data_nasc" id="data_nasc">
                </div>
                <div class="input-field col s12 m6">
                    <label for="cpf">CPF</label>
                    <input type="text" name="cpf" id="cpf" oninput="mascara_cpf(this)">
                </div>
                <div class="input-field col s12 m6">
                    <label for="cns">CNS – Cartão Nacional de Saúde</label>
                    <input type="text" name="cns" id="cns">
                </div>
            </div>
        </div>

        <h4>Dados da Mãe</h4>
        <div class="card-panel">
            <div class="row">
                <div class="input-field col s12">
                    <label for="nome_mae">Nome Completo da Mãe</label>
                    <input type="text" name="nome_mae" id="nome_mae">
                </div>
            </div>
        </div>

        <h4>Endereço</h4>
        <div class="card-panel">
            <div>
                <label for="cep">CEP</label>
                <input type="text" name="cep" id="cep" oninput="mascara_cep(this)">
            </div>
            <div>
                <label for="logradouro">Logradouro</label>
                <input type="text" name="logradouro" id="logradouro">
            </div>
            <div>
                <label for="numero">Número</label>
                <input type="text" name="numero" id="numero">
            </div>
            <div>
                <label for="complemento">Complemento</label>
                <input type="text" name="complemento" id="complemento">
            </div>
            <div>
                <label for="bairro">Bairro</label>
                <input type="text" name="bairro" id="bairro">
            </div>
            <div>
                <label for="cidade">Cidade</label>
                <input type="text" name="cidade" id="cidade">
            </div>
            <div>
                <label for="estado">Estado</label>
                <input type="text" name="estado" id="estado">
            </div>
        </div>
        <?= form_close(); ?>
    </div>
</body>

</html>