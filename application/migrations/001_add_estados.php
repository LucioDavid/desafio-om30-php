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
                'unique' => TRUE,
            ),
            'nome' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
            ),
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('estados', TRUE);

        $this->_seed();
    }

    public function down()
    {
        $this->dbforge->drop_table('estados', TRUE);
    }

    private function _seed()
    {
        $this->db->query("INSERT INTO estados (uf, nome) VALUES ('AC', 'Acre');");
        $this->db->query("INSERT INTO estados (uf, nome) VALUES ('AL', 'Alagoas');");
        $this->db->query("INSERT INTO estados (uf, nome) VALUES ('AM', 'Amazonas');");
        $this->db->query("INSERT INTO estados (uf, nome) VALUES ('AP', 'Amapá');");
        $this->db->query("INSERT INTO estados (uf, nome) VALUES ('BA', 'Bahia');");
        $this->db->query("INSERT INTO estados (uf, nome) VALUES ('CE', 'Ceará');");
        $this->db->query("INSERT INTO estados (uf, nome) VALUES ('DF', 'Distrito Federal');");
        $this->db->query("INSERT INTO estados (uf, nome) VALUES ('ES', 'Espírito Santo');");
        $this->db->query("INSERT INTO estados (uf, nome) VALUES ('GO', 'Goiás');");
        $this->db->query("INSERT INTO estados (uf, nome) VALUES ('MA', 'Maranhão');");
        $this->db->query("INSERT INTO estados (uf, nome) VALUES ('MG', 'Minas Gerais');");
        $this->db->query("INSERT INTO estados (uf, nome) VALUES ('MS', 'Mato Grosso do Sul');");
        $this->db->query("INSERT INTO estados (uf, nome) VALUES ('MT', 'Mato Grosso');");
        $this->db->query("INSERT INTO estados (uf, nome) VALUES ('PA', 'Pará');");
        $this->db->query("INSERT INTO estados (uf, nome) VALUES ('PB', 'Paraíba');");
        $this->db->query("INSERT INTO estados (uf, nome) VALUES ('PE', 'Pernambuco');");
        $this->db->query("INSERT INTO estados (uf, nome) VALUES ('PI', 'Piauí');");
        $this->db->query("INSERT INTO estados (uf, nome) VALUES ('PR', 'Paraná');");
        $this->db->query("INSERT INTO estados (uf, nome) VALUES ('RJ', 'Rio de Janeiro');");
        $this->db->query("INSERT INTO estados (uf, nome) VALUES ('RN', 'Rio Grande do Norte');");
        $this->db->query("INSERT INTO estados (uf, nome) VALUES ('RO', 'Rondônia');");
        $this->db->query("INSERT INTO estados (uf, nome) VALUES ('RR', 'Roraima');");
        $this->db->query("INSERT INTO estados (uf, nome) VALUES ('RS', 'Rio Grande do Sul');");
        $this->db->query("INSERT INTO estados (uf, nome) VALUES ('SC', 'Santa Catarina');");
        $this->db->query("INSERT INTO estados (uf, nome) VALUES ('SE', 'Sergipe');");
        $this->db->query("INSERT INTO estados (uf, nome) VALUES ('SP', 'São Paulo');");
        $this->db->query("INSERT INTO estados (uf, nome) VALUES ('TO', 'Tocantins');");
    }
}
