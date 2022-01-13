<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Add_enderecos extends CI_Migration {

    public function up()
    {
        $this->load->dbforge();

        $this->db->query(
            "CREATE TYPE UF AS ENUM ('AC', 'AL', 'AM', 'AP', 'BA', 'CE', 'DF', 'ES', 'GO', 'MA', 'MG', 'MS', 'MT', 'PA', 'PB', 'PE', 'PI', 'PR', 'RJ', 'RN', 'RO', 'RR', 'RS', 'SC', 'SE', 'SP', 'TO');"
        );

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
            'estado' => array(
                'type' => 'UF',
            ),
            'CEP' => array(
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
    }

    public function down()
    {
        $this->dbforge->drop_table('enderecos', TRUE);
    }
}
