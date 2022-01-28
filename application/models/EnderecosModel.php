<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EnderecosModel extends MY_Model
{
    protected $table = 'enderecos';
    protected $primaryKey = 'id';
    protected $timestamps = array('criado_em', 'modif_em');
}