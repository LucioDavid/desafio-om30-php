<div class="container">
    <h1 class="center"><?= $titulo_pagina ?></h1>

    <h4>Dados Pessoais</h4>
    <form action="/pacientes/create" method="post" enctype="multipart/form-data">
        <input type="hidden" name="<?= $csrf['name']; ?>" value="<?= $csrf['hash']; ?>" />
        <div class="card-panel">
            <div class="row">
                <div class="file-field input-field col s12 m3 l2">
                    <div>
                        <img id="foto" src="/public/assets/imgs/paciente_foto_placeholder.jpg" alt="" class="responsive-img">
                    </div>
                    <div class="btn" style="width: 100%;">
                        <span>Carregar Foto</span>
                        <input type="file" name="foto" id="foto_input" accept=".jpg, .jpeg, .png">
                    </div>
                </div>
                <div class="input-field col s12 m9 l8">
                    <label for="nome">Nome Completo</label>
                    <input type="text" name="nome" id="nome" maxlength="100" class="validate" required>
                    <span class="helper-text" data-error="obrigatório" data-success=""></span>
                </div>
                <div class="input-field col s12 m3 l2">
                    <label for="data_nasc">Data de Nascimento</label>
                    <input type="date" placeholder=" " name="data_nasc" id="data_nasc" class="validate" required>
                    <span class="helper-text" data-error="obrigatório" data-success=""></span>
                </div>
                <div class="input-field col s12 m3 l5">
                    <label for="cpf">CPF</label>
                    <input type="text" name="cpf" id="cpf" class="cpf validate" maxlength="14" required>
                    <span class="helper-text" data-error="CPF inválido" data-success=""></span>
                </div>
                <div class="input-field col s12 m3 l5">
                    <label for="cns">CNS – Cartão Nacional de Saúde</label>
                    <input type="text" name="cns" id="cns" class="cns validate" maxlength="18" required>
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
                    <input type="text" name="cep" id="cep" class="cep validate" maxlength="10" required>
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
                    <span class="helper-text"><i>preencha se houver</i></span>
                </div>
                <div class="input-field col s12">
                    <label for="complemento">Complemento</label>
                    <input type="text" name="complemento" id="complemento" maxlength="100">
                    <span class="helper-text"><i>preencha se houver</i></span>
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


        <button class="btn waves-effect waves-light" type="submit" name="action">Submit
            <i class="material-icons right">send</i>
        </button>

    </form>
</div>
