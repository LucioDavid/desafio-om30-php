<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PacientesModel extends MY_Model
{
    protected $table = 'pacientes';
    protected $primaryKey = 'id';
    protected $timestamps = array('criado_em', 'modif_em');
}