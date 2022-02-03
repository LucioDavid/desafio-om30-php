<div class="container">
    <h1 class="center"><?= $titulo_pagina ?></h1>

    <p>
        <?= isset($erros_upload) ? $erros_upload : '' ?>
        <?= validation_errors(); ?>
    </p>

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
                        <span>Foto</span>
                        <input type="file" name="foto" id="foto_input" accept=".jpg, .jpeg, .png" value="<?= isset($paciente['foto']) ? $paciente['foto'] : '' ?>">
                    </div>
                </div>
                <div class="input-field col s12 m9 l7">
                    <label for="nome">Nome Completo do Paciente</label>
                    <input type="text" name="nome" id="nome" maxlength="100" class="validate" required value="<?= isset($paciente['nome']) ? $paciente['nome'] : '' ?>">
                    <span class="helper-text" data-error="obrigatório" data-success=""></span>
                </div>
                <div class="input-field col s12 m3 l3">
                    <label for="data_nasc">Data de Nascimento</label>
                    <input type="date" placeholder=" " name="data_nasc" id="data_nasc" class="validate" required  value="<?= isset($paciente['data_nasc']) ? $paciente['data_nasc'] : '' ?>">
                    <span class="helper-text" data-error="obrigatório" data-success=""></span>
                </div>
                <div class="input-field col s12 m3 l5">
                    <label for="cpf">CPF</label>
                    <input type="text" name="cpf" id="cpf" class="cpf validate" maxlength="14" required value="<?= isset($paciente['cpf']) ? $paciente['cpf'] : '' ?>">
                    <span class="helper-text" data-error="obrigatório" data-success=""></span>
                </div>
                <div class="input-field col s12 m3 l5">
                    <label for="cns">CNS</label>
                    <input title="Cartão Nacional de Saúde" type="text" name="cns" id="cns" class="cns validate" maxlength="18" required value="<?= isset($paciente['cns']) ? $paciente['cns'] : '' ?>">
                    <span class="helper-text" data-error="obrigatório" data-success=""></span>
                </div>
            </div>
        </div>

        <h4>Dados da Mãe</h4>
        <div class="card-panel">
            <div class="row">
                <div class="input-field col s12">
                    <label for="nome_mae">Nome Completo da Mãe</label>
                    <input type="text" name="nome_mae" id="nome_mae" class="validate" maxlength="100" required value="<?= isset($paciente['nome_mae']) ? $paciente['nome_mae'] : '' ?>">
                    <span class="helper-text" data-error="obrigatório" data-success=""></span>
                </div>
            </div>
        </div>

        <h4>Endereço</h4>
        <div class="card-panel">
            <div class="row">
                <div class="input-field col s12">
                    <label for="cep">CEP</label>
                    <input type="text" name="cep" id="cep" class="cep validate" maxlength="10" required value="<?= isset($endereco['cep']) ? $endereco['cep'] : '' ?>">
                    <span class="helper-text" data-error="obrigatório" data-success=""></span>
                </div>
                <div class="input-field col s12">
                    <label for="logradouro">Logradouro</label>
                    <input type="text" name="logradouro" id="logradouro" class="validate" maxlength="100" required value="<?= isset($endereco['logradouro']) ? $endereco['logradouro'] : '' ?>">
                    <span class="helper-text" data-error="obrigatório" data-success=""></span>
                </div>
                <div class="input-field col s12">
                    <label for="numero">Número</label>
                    <input type="number" name="numero" id="numero" min="1" value="<?= isset($endereco['numero']) ? $endereco['numero'] : '' ?>">
                    <span class="helper-text"><i>preencha se houver</i></span>
                </div>
                <div class="input-field col s12">
                    <label for="complemento">Complemento</label>
                    <input type="text" name="complemento" id="complemento" maxlength="100" value="<?= isset($endereco['complemento']) ? $endereco['complemento'] : '' ?>">
                    <span class="helper-text"><i>preencha se houver</i></span>
                </div>
                <div class="input-field col s12">
                    <label for="bairro">Bairro</label>
                    <input type="text" name="bairro" id="bairro" class="grey-text text-darken-1" maxlength="100" required readonly value="<?= isset($endereco['bairro']) ? $endereco['bairro'] : '' ?>">
                </div>
                <div class="input-field col s12">
                    <label for="cidade">Cidade</label>
                    <input type="text" name="cidade" id="cidade" class="grey-text text-darken-1" maxlength="100" required readonly value="<?= isset($endereco['cidade']) ? $endereco['cidade'] : '' ?>">
                </div>
                <div class="input-field col s12">
                    <select name="estado_id">
                        <option value="" disabled <?= isset($estado['id']) ? '' : 'selected' ?>>Selecione o Estado</option>
                        <?php foreach($estados as $estado) { ?>
                            <option value="<?= $estado['id'] ?>" <?= isset($estado['id'], $endereco['estado_id']) && $estado['id'] == $endereco['estado_id'] ? 'selected' : '' ?>><?= $estado['uf'] ?></option>
                        <?php }?>
                    </select>
                    <label>Estado</label>
                </div>
            </div>
        </div>

        <a class="btn waves-effect waves-light" href="/pacientes">Voltar
            <i class="material-icons right">keyboard_arrow_left</i>
        </a>

        <button class="btn waves-effect waves-light right" type="submit" name="action">Cadastrar
            <i class="material-icons right">send</i>
        </button>
    </form>
</div>

<script src="<?= base_url('public/assets/js/custom/pacientes-add.js') ?>"></script>