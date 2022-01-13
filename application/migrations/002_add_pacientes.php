<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Add_pacientes extends CI_Migration {

    public function up()
    {
        $this->load->dbforge();

        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => TRUE,
                'auto_increment' => TRUE,
            ),
            'foto' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => TRUE,
            ),
            'nome' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
            ),
            'nome_mae' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
            ),
            'data_nasc' => array(
                'type' => 'DATE',
            ),
            'cpf' => array(
                'type' => 'VARCHAR',
                'constraint' => '11',
            ),
            'cns' => array(
                'type' => 'VARCHAR',
                'constraint' => '15',
            ),
            'endereco_id' => array(
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => TRUE,
            ),
            'criado_em' => array(
                'type' => 'TIMESTAMP WITH TIME ZONE',
            ),
            'modif_em' => array(
                'type' => 'TIMESTAMP WITH TIME ZONE',
                'null' => TRUE,
            ),
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('pacientes', TRUE);

        $this->db->query(
            'ALTER TABLE pacientes ADD CONSTRAINT endereco_id FOREIGN KEY (endereco_id) REFERENCES enderecos(id);'
        );
    }

    public function down()
    {
        $this->dbforge->drop_table('pacientes', TRUE);
    }
}
