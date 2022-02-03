<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MY_Form_validation extends CI_Form_validation
{
    protected $CI;

    public function __construct($rules = array())
    {
        parent::__construct($rules);
    }

    public function valida_nome_completo($nome)
    {
        $this->CI->form_validation->set_message('valida_nome_completo', 'O %s deve conter somente letras, com iniciais maiúsculas.');
        
        if (! preg_match("/^([A-ZÀ-Ü]{1}[a-zà-ü]+)(((\s|\-){1}([a-zà-ü]{1,3}))?(\s|\-){1}[A-ZÀ-Ü]{1}(([a-zà-ü]+)?'[A-ZÀ-Ü]{1})?[a-zà-ü]+)+$/u", $nome)) {
            return FALSE;
        }
        return TRUE;
    }

    // public function valida_data($data)
    // {
    //     $this->CI->form_validation->set_message('valida_data', 'A %s é inválida.');
    //     // if ($data) { // do your validations
    //     //     return TRUE;
    //     // } else {
    //     //     return FALSE;
    //     // }
    //     return FALSE;
    // }

    public function valida_cpf($cpf)
    {
        $this->CI->form_validation->set_message('valida_cpf', 'O %s é inválido.');

        $cpf = preg_replace('/[^0-9]/', '', $cpf);

        if (strlen($cpf) != 11) {
            return FALSE;
        }

        if (preg_match('/(\d)\1{10}/', $cpf)) {
            return FALSE;
        }

        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) {
                return FALSE;
            }
        }

        return TRUE;
    }

    public function valida_cns($cns)
    {
        $this->CI->form_validation->set_message('valida_cns', 'O %s é inválido.');

        $cns = preg_replace('/[^\d]/', '', $cns);
        if (preg_match("/[1-2][0-9]{10}00[0-1][0-9]/", $cns) || preg_match("/[7-9][0-9]{14}/", $cns)) {
            return $this->soma_ponderada($cns) % 11 == 0;
        }
        return false;
    }

    private function soma_ponderada($value)
    {
        $soma = 0;
        for ($i = 0; $i < mb_strlen($value); $i++) {
            $soma += $value[$i] * (15 - $i);
        }
        return $soma;
    }
}
