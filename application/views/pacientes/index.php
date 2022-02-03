<div class="container">
    <h1 class="center"><?= $titulo_pagina ?></h1>

    <a href="/pacientes/add" class="btn waves-effect waves-light right">
        Cadastrar
        <i class="material-icons right">add</i>
    </a>

    <table id="minhaTabela" class="display">
        <thead>
            <tr>
                <th class="center">Id</th>
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
                    <td class="center"><?= $paciente['id'] ?></td>
                    <td><img height="48px" src="<?= isset($paciente['foto']) ? base_url('public/uploads/' . $paciente['foto']) : '/public/assets/imgs/paciente_foto_placeholder.jpg' ?>" alt="foto_de_perfil"></td>
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
                        <a href="<?= base_url('/pacientes/delete/' . $paciente['id']) ?>" class="btn waves-effect waves-light red">
                            <i class="material-icons">delete</i>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>