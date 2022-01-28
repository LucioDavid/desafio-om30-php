<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EstadosModel extends MY_Model
{
    protected $table = 'estados';
    protected $primaryKey = 'id';
    protected $timestamps = FALSE;
}