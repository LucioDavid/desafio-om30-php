<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pacientes extends CI_Controller {

    /**
     * Exibe uma listagem dos pacientes.
     *
     * @return	object
     */
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

    /**
     * Exibe o formulário para a criação de um novo paciente.
     *
     * @return object
     */
    public function criar()
    {
        $this->load->helper('form');

        $dados['titulo_pagina'] = "Criar Paciente";

        $this->load->view('pacientes/form', $dados);
    }

    /**
     * Armazena o novo paciente criado.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function armazenar(Request $request)
    // {
    //     //
    // }

    /**
     * Exibe o paciente especificado.
     *
     * @param  \{{ namespacedModel }}  ${{ modelVariable }}
     * @return \Illuminate\Http\Response
     */
    // public function exibir({{ model }} ${{ modelVariable }})
    // {
    //     //
    // }

    /**
     * Exibe o formulário para a edição do recurso especificado.
     *
     * @param  \{{ namespacedModel }}  ${{ modelVariable }}
     * @return \Illuminate\Http\Response
     */
    // public function editar({{ model }} ${{ modelVariable }})
    // {
    //     //
    // }

    /**
     * Atualiza no armazenamento o recurso especificado.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \{{ namespacedModel }}  ${{ modelVariable }}
     * @return \Illuminate\Http\Response
     */
    // public function atualizar(Request $request, {{ model }} ${{ modelVariable }})
    // {
    //     //
    // }

    /**
     * Remove do armazenamento o recurso especificado.
     *
     * @param  \{{ namespacedModel }}  ${{ modelVariable }}
     * @return \Illuminate\Http\Response
     */
    // public function destruir({{ model }} ${{ modelVariable }})
    // {
    //     //
    // }
}
