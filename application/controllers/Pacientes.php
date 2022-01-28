<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pacientes extends CI_Controller
{
    private $dados;

    public function __construct()
    {
        parent::__construct();
        $this->dados['csrf'] = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        );
        $this->load->model('PacientesModel');
    }

    public function index()
    {
        $this->dados['pacientes'] = $this->PacientesModel->findAll();

        $this->dados['titulo_pagina'] = "Pacientes";
        $this->load->view('pacientes/index', $this->dados);
    }

    public function add()
    {
        $this->dados['titulo_pagina'] = "Criar Paciente";
        $this->dados['scripts'] = array(
            '/public/assets/js/form.js',
        );

        $this->load->view('templates/head', $this->dados);
        $this->load->view('pacientes/form', $this->dados);
        $this->load->view('templates/footer', $this->dados);
    }
}
