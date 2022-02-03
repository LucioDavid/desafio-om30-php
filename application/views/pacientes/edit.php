<div class="container">
    <h1 class="center"><?= $titulo_pagina ?></h1>

    <p>
        <?= isset($erros_upload) ? $erros_upload : '' ?>
        <?= validation_errors(); ?>
    </p>

    <h4>Dados Pessoais</h4>
    <form action="<?= base_url('pacientes/update/'.$paciente['id']) ?>" method="post" enctype="multipart/form-data">
        <input type="hidden" name="<?= $csrf['name']; ?>" value="<?= $csrf['hash']; ?>" />
        <div class="card-panel">
            <div class="row">
                <div class="file-field input-field col s12 m3 l2">
                    <div>
                        <img id="foto" src="<?= isset($paciente['foto']) ? base_url('public/uploads/' . $paciente['foto']) : '/public/assets/imgs/paciente_foto_placeholder.jpg' ?>" alt="" class="responsive-img">
                    </div>
                    <div class="btn" style="width: 100%;">
                        <span>Foto</span>
                        <input type="file" name="foto" id="foto_input" accept=".jpg, .jpeg, .png">
                    </div>
                </div>
                <div class="input-field col s12 m9 l7">
                    <label for="nome">Nome Completo do Paciente</label>
                    <input type="text" name="nome" id="nome" maxlength="100" class="validate" required value="<?= $paciente['nome'] ?>">
                    <span class="helper-text" data-error="obrigatório" data-success=""></span>
                </div>
                <div class="input-field col s12 m3 l3">
                    <label for="data_nasc">Data de Nascimento</label>
                    <input type="date" placeholder=" " name="data_nasc" id="data_nasc" class="validate" required value="<?= $paciente['data_nasc'] ?>">
                    <span class="helper-text" data-error="obrigatório" data-success=""></span>
                </div>
                <div class="input-field col s12 m3 l5">
                    <label for="cpf">CPF</label>
                    <input type="text" name="cpf" id="cpf" class="cpf validate" maxlength="14" required value="<?= $paciente['cpf'] ?>">
                    <span class="helper-text" data-error="CPF inválido" data-success=""></span>
                </div>
                <div class="input-field col s12 m3 l5">
                    <label for="cns">CNS – Cartão Nacional de Saúde</label>
                    <input type="text" name="cns" id="cns" class="cns validate" maxlength="18" required value="<?= $paciente['cns'] ?>">
                    <span class="helper-text" data-error="CNS inválido" data-success=""></span>
                </div>
            </div>
        </div>

        <h4>Dados da Mãe</h4>
        <div class="card-panel">
            <div class="row">
                <div class="input-field col s12">
                    <label for="nome_mae">Nome Completo da Mãe</label>
                    <input type="text" name="nome_mae" id="nome_mae" class="validate" maxlength="100" required value="<?= $paciente['nome_mae'] ?>">
                    <span class="helper-text" data-error="obrigatório" data-success=""></span>
                </div>
            </div>
        </div>

        <h4>Endereço</h4>
        <div class="card-panel">
            <div class="row">
                <div class="input-field col s12">
                    <label for="cep">CEP</label>
                    <input type="text" name="cep" id="cep" class="cep validate" maxlength="10" required value="<?= $endereco['cep'] ?>">
                    <span class="helper-text" data-error="obrigatório" data-success=""></span>
                </div>
                <div class="input-field col s12">
                    <label for="logradouro">Logradouro</label>
                    <input type="text" name="logradouro" id="logradouro" class="validate" maxlength="100" required value="<?= $endereco['logradouro'] ?>">
                    <span class="helper-text" data-error="obrigatório" data-success=""></span>
                </div>
                <div class="input-field col s12">
                    <label for="numero">Número</label>
                    <input type="number" name="numero" id="numero" min="1" value="<?= $endereco['numero'] ?>">
                    <span class="helper-text"><i>preencha se houver</i></span>
                </div>
                <div class="input-field col s12">
                    <label for="complemento">Complemento</label>
                    <input type="text" name="complemento" id="complemento" maxlength="100" value="<?= $endereco['complemento'] ?>">
                    <span class="helper-text"><i>preencha se houver</i></span>
                </div>
                <div class="input-field col s12">
                    <label for="bairro">Bairro</label>
                    <input type="text" name="bairro" id="bairro" class="grey-text text-darken-1" maxlength="100" required readonly value="<?= $endereco['bairro'] ?>">
                </div>
                <div class="input-field col s12">
                    <label for="cidade">Cidade</label>
                    <input type="text" name="cidade" id="cidade" class="grey-text text-darken-1" maxlength="100" required readonly value="<?= $endereco['cidade'] ?>">
                </div>
                <div class="input-field col s12">
                    <select name="estado_id" class="validate" required>
                        <option value="" disabled>Selecione o Estado</option>
                        <?php foreach ($estados as $estado) { ?>
                            <option value="<?= $estado['id'] ?>" <?= $estado['id'] == $endereco['estado_id'] ? 'selected' : '' ?>><?= $estado['uf'] ?></option>
                        <?php } ?>
                    </select>
                    <label>Estado</label>
                </div>
            </div>
        </div>

        <a class="btn waves-effect waves-light" href="<?= base_url('pacientes') ?>">Voltar
            <i class="material-icons right">keyboard_arrow_left</i>
        </a>

        <button class="btn waves-effect waves-light right" type="submit" name="action">Salvar
            <i class="material-icons right">send</i>
        </button>
    </form>
</div>

<script src="<?= base_url('public/assets/js/custom/pacientes-edit.js') ?>"></script>