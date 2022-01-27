<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EstadosModel extends MY_Model
{
    public function __construct()
    {
        $this->table = 'estados';
        $this->primary_key = 'id';
        $this->timestamps = FALSE;

        parent::__construct();
    }
}