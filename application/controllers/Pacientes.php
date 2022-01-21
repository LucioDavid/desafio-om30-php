<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pacientes extends CI_Controller {

    public function index()
    {
        // Código de exemplo/testes.
        $dados = array(
            "pacientes" => array(
                1   =>  "Maria",
                2   =>  "José",
            )
        );

        $this->load->view('pacientes/index', $dados);
    }

    public function criar()
    {
        $this->load->helper('form');

        $dados['titulo_pagina'] = "Criar Paciente";
        $dados['csrf'] = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        );

        $this->load->view('pacientes/form', $dados);
    }
}
