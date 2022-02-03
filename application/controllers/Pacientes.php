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
        $this->load->model('EnderecosModel');
        $this->load->model('EstadosModel');
    }

    public function index()
    {
        $this->dados['pacientes'] = $this->PacientesModel->findAll();

        $this->dados['titulo_pagina'] = "Pacientes";
        $this->load->view('templates/head', $this->dados);
        $this->load->view('pacientes/index', $this->dados);
        $this->load->view('templates/footer', $this->dados);
    }

    public function add()
    {
        $this->dados['estados'] = $this->EstadosModel->findAll();

        $this->dados['titulo_pagina'] = "Cadastrar Paciente";

        $this->load->view('templates/head', $this->dados);
        $this->load->view('pacientes/add', $this->dados);
        $this->load->view('templates/footer', $this->dados);
    }

    public function create()
    {
        $this->form_validation->set_rules('nome', 'Nome Completo do Paciente', 'required|trim|max_length[100]|valida_nome_completo');
        $this->form_validation->set_rules('data_nasc', 'Data de Nascimento', 'required');
        $this->form_validation->set_rules('cpf', 'CPF', 'required|exact_length[14]|valida_cpf|is_unique[pacientes.cpf]');
        $this->form_validation->set_rules('cns', 'CNS', 'required|exact_length[18]|valida_cns|is_unique[pacientes.cns]');
        $this->form_validation->set_rules('nome_mae', 'Nome Completo da Mãe', 'required|trim|max_length[100]|valida_nome_completo');
        $this->form_validation->set_rules('cep', 'CEP', 'required|exact_length[10]');
        $this->form_validation->set_rules('logradouro', 'Logradouro', 'required|max_length[100]');
        $this->form_validation->set_rules('numero', 'Número do Endereço', 'numeric');
        $this->form_validation->set_rules('complemento', 'Complemento', 'max_length[100]');
        $this->form_validation->set_rules('bairro', 'Bairro', 'required|max_length[100]');
        $this->form_validation->set_rules('cidade', 'Cidade', 'required|max_length[100]');
        $this->form_validation->set_rules('estado_id', 'Estado', 'required|in_list[' . $this->listarEstadosId() . ']');

        $paciente = [
            'foto' => null,
            'nome' => $this->input->post('nome'),
            'nome_mae' => $this->input->post('nome_mae'),
            'data_nasc' => $this->input->post('data_nasc'),
            'cpf' => $this->input->post('cpf'),
            'cns' => $this->input->post('cns'),
        ];

        $endereco = [
            'logradouro' => $this->input->post('logradouro'),
            'numero' => !empty($this->input->post('numero')) ? $this->input->post('numero') : null,
            'complemento' => !empty($this->input->post('complemento')) ? $this->input->post('complemento') : null,
            'bairro' => $this->input->post('bairro'),
            'cidade' => $this->input->post('cidade'),
            'estado_id' => $this->input->post('estado_id'),
            'cep' => $this->input->post('cep'),
        ];

        if ($this->form_validation->run()) {
            $idEndereco = $this->EnderecosModel->insert($endereco);
            $paciente['endereco_id'] = $idEndereco;

            $this->PacientesModel->insert($paciente);

            redirect('pacientes');
        } else {
            $this->dados['estados'] = $this->EstadosModel->findAll();
            $this->dados['paciente'] = $paciente;
            $this->dados['endereco'] = $endereco;

            $this->dados['titulo_pagina'] = "Cadastrar Paciente";
            $this->load->view('templates/head', $this->dados);
            $this->load->view('pacientes/add', $this->dados);
            $this->load->view('templates/footer', $this->dados);
        }
    }

    public function edit($id)
    {
        $this->dados['paciente'] = $this->PacientesModel->findById($id);
        if(isset($this->dados['paciente'])){
            $this->dados['estados'] = $this->EstadosModel->findAll();
            $this->dados['endereco'] = $this->EnderecosModel->findById($this->dados['paciente']['endereco_id']);
    
            $this->dados['titulo_pagina'] = "Editar Paciente";
    
            $this->load->view('templates/head', $this->dados);
            $this->load->view('pacientes/edit', $this->dados);
            $this->load->view('templates/footer', $this->dados);
            return;
        }
        
        show_404();
    }

    public function update($id)
    {
        $paciente = $this->PacientesModel->findById($id);
        if(isset($paciente)){
            $this->form_validation->set_rules('nome', 'Nome Completo do Paciente', 'required|trim|max_length[100]|valida_nome_completo');
            $this->form_validation->set_rules('data_nasc', 'Data de Nascimento', 'required');
            
            $is_unique = $this->input->post('cpf') == $paciente['cpf'] ? '' : '|is_unique[pacientes.cpf]';
            $this->form_validation->set_rules('cpf', 'CPF', 'required|exact_length[14]|valida_cpf' . $is_unique);
            
            $is_unique = $this->input->post('cns') == $paciente['cns'] ? '' : '|is_unique[pacientes.cns]';
            $this->form_validation->set_rules('cns', 'CNS', 'required|exact_length[18]|valida_cns' . $is_unique);
            
            $this->form_validation->set_rules('nome_mae', 'Nome Completo da Mãe', 'required|trim|max_length[100]|valida_nome_completo');
            $this->form_validation->set_rules('cep', 'CEP', 'required|exact_length[10]');
            $this->form_validation->set_rules('logradouro', 'Logradouro', 'required|max_length[100]');
            $this->form_validation->set_rules('numero', 'Número do Endereço', 'numeric');
            $this->form_validation->set_rules('complemento', 'Complemento', 'max_length[100]');
            $this->form_validation->set_rules('bairro', 'Bairro', 'required|max_length[100]');
            $this->form_validation->set_rules('cidade', 'Cidade', 'required|max_length[100]');
            $this->form_validation->set_rules('estado_id', 'Estado', 'required|in_list[' . $this->listarEstadosId() . ']');

            if ($this->form_validation->run()) {
                $this->PacientesModel->update($paciente['id'], [
                    'foto' => null,
                    'nome' => $this->input->post('nome'),
                    'nome_mae' => $this->input->post('nome_mae'),
                    'data_nasc' => $this->input->post('data_nasc'),
                    'cpf' => $this->input->post('cpf'),
                    'cns' => $this->input->post('cns'),
                ]);

                $this->EnderecosModel->update($paciente['endereco_id'], [
                    'logradouro' => $this->input->post('logradouro'),
                    'numero' => !empty($this->input->post('numero')) ? $this->input->post('numero') : null,
                    'complemento' => !empty($this->input->post('complemento')) ? $this->input->post('complemento') : null,
                    'bairro' => $this->input->post('bairro'),
                    'cidade' => $this->input->post('cidade'),
                    'estado_id' => $this->input->post('estado_id'),
                    'cep' => $this->input->post('cep'),
                ]);

                redirect('pacientes');
            } else {
                $this->dados['estados'] = $this->EstadosModel->findAll();
                $this->dados['paciente'] = $this->PacientesModel->findById($id);
                $this->dados['endereco'] = $this->EnderecosModel->findById($this->dados['paciente']['endereco_id']);

                $this->dados['titulo_pagina'] = "Editar Paciente";
                $this->load->view('templates/head', $this->dados);
                $this->load->view('pacientes/edit', $this->dados);
                $this->load->view('templates/footer', $this->dados);
            }
            return;
        }

        show_404();
    }

    public function delete($id)
    {
        $paciente = $this->PacientesModel->findById($id);
        if(isset($paciente)){
            $this->PacientesModel->delete($paciente['id']) || redirect('pacientes');
            $this->EnderecosModel->delete($paciente['endereco_id']) || redirect('pacientes');
            return redirect('pacientes');
        }

        show_404();
    }

    private function listarEstadosId()
    {
        $estados = $this->EstadosModel->findAll();
        
        foreach ($estados as $estado) {
            $estados_array[] = $estado['id'];
        }

        return implode(',', $estados_array);
    }
}
