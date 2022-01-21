<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Add_enderecos extends CI_Migration {

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
            'logradouro' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
            ),
            'numero' => array(
                'type' => 'INT',
                'null' => TRUE,
            ),
            'complemento' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => TRUE,
            ),
            'bairro' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
            ),
            'cidade' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
            ),
            'estado_id' => array(
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => TRUE,
            ),
            'cep' => array(
                'type' => 'VARCHAR',
                'constraint' => '8',
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
        $this->dbforge->create_table('enderecos', TRUE);

        $this->db->query(
            'ALTER TABLE enderecos ADD CONSTRAINT estado_id FOREIGN KEY (estado_id) REFERENCES estados(id);'
        );
    }

    public function down()
    {
        $this->dbforge->drop_table('enderecos', TRUE);
    }
}
