<div class="container">
    <h1 class="center teal-text"><?= $titulo_pagina ?></h1>

    <div class="fixed-action-btn">
        <a class="btn-floating btn-large" href="<?= base_url('pacientes/add') ?>">
            <i class="large material-icons">add</i>
        </a>
    </div>


    <table id="minhaTabela" class="display">
        <thead>
            <tr>
                <th>Foto</th>
                <th>Nome</th>
                <th>Data de Nascimento</th>
                <th>CPF</th>
                <th>CNS</th>
                <th>Editar</th>
                <th>Deletar</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($pacientes as $paciente) : ?>
                <tr>
                    <td><img class="circle" height="48px" src="<?= isset($paciente['foto']) ? base_url('public/uploads/' . $paciente['foto']) : '/public/assets/imgs/paciente_foto_placeholder.jpg' ?>" alt="foto_de_perfil"></td>
                    <td><?= $paciente['nome'] ?></td>
                    <td><?= date("d/m/Y", strtotime($paciente['data_nasc'])); ?></td>
                    <td><?= $paciente['cpf'] ?></td>
                    <td><?= $paciente['cns'] ?></td>
                    <td>
                        <a href="<?= base_url('/pacientes/edit/' . $paciente['id']) ?>" class="btn waves-effect waves-light amber">
                            <i class="material-icons">edit</i>
                        </a>
                    </td>
                    <td>
                        <a href="#modal<?= $paciente['id'] ?>" class="btn waves-effect waves-light red modal-trigger">
                            <i class="material-icons">delete</i>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php foreach ($pacientes as $paciente) : ?>
    <div id="modal<?= $paciente['id'] ?>" class="modal">
        <div class="modal-content">
            <h4>Confirmar Exclusão</h4>
            <p>Deseja mesmo escluir o paciente "<b><?= $paciente['nome'] ?></b>"?</p>
        </div>
        <div class="modal-footer">
            <div class="center">
                <div class="divider"></div>
                <a class="modal-close waves-effect waves-light btn-flat red white-text" href="<?= base_url('/pacientes/delete/' . $paciente['id']) ?>">Excluir</a>
                <a class="modal-close waves-effect waves-light btn-flat grey white-text" href="#!">Cancelar</a>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<script src="<?= base_url('public/assets/js/custom/pacientes-index.js') ?>"></script>