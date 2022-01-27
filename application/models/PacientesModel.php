<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PacientesModel extends MY_Model
{
    public function __construct()
    {
        $this->table = 'pacientes';
        $this->primary_key = 'id';
        $this->timestamps = array('criado_em', 'modif_em');

        parent::__construct();
    }
}