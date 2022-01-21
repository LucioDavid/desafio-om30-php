<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Add_estados extends CI_Migration {

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
            'uf' => array(
                'type' => 'VARCHAR',
                'constraint' => '2',
            ),
            'nome' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
            ),
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('estados', TRUE);
    }

    public function down()
    {
        $this->dbforge->drop_table('estados', TRUE);
    }
}
