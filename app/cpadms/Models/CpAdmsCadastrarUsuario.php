<?php

namespace App\cpadms\Models;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of CpAdmsCadastrarUsuario
 *
 * @copyright (c) year, Cesar Szpak - Celke
 */
class CpAdmsCadastrarUsuario
{

    private $Dados;
    private $Resultado;
    
    function getResultado()
    {
        return $this->Resultado;
    }

    public function cadUsuario(array $Dados)
    {
        $this->Dados = $Dados;
        //var_dump($this->Dados);
        //$this->Foto = $this->Dados['imagem_nova'];
        //unset($this->Dados['imagem_nova']);

        $valCampoVazio = new \App\adms\Models\helper\AdmsCampoVazio;
        $valCampoVazio->validarDados($this->Dados);

        if ($valCampoVazio->getResultado()) {            
            $this->valCampos();
        } else {
            $this->Resultado = false;
        }
    }

    private function valCampos()
    {
        $valEmail = new \App\adms\Models\helper\AdmsEmail();
        $valEmail->valEmail($this->Dados['email']);

        $valEmailUnico = new \App\adms\Models\helper\AdmsEmailUnico();
        $valEmailUnico->valEmailUnico($this->Dados['email']);

        $valUsuario = new \App\adms\Models\helper\AdmsValUsuario();
        $valUsuario->valUsuario($this->Dados['usuario']);

        $valSenha = new \App\adms\Models\helper\AdmsValSenha();
        $valSenha->valSenha($this->Dados['senha']);

        if (($valSenha->getResultado()) AND ( $valUsuario->getResultado()) AND ( $valEmailUnico->getResultado()) AND ( $valEmail->getResultado())) {
            $this->inserirUsuario();            
        } else {
            $this->Resultado = false;
        }
    }
    
    private function inserirUsuario()
    {
        $this->Dados['senha'] = password_hash($this->Dados['senha'], PASSWORD_DEFAULT);
        $this->Dados['created'] = date("Y-m-d H:i:s");
        //$slugImg = new \App\adms\Models\helper\AdmsSlug();
        //$this->Dados['imagem'] = $slugImg->nomeSlug($this->Foto['name']);

        $cadUsuario = new \App\adms\Models\helper\AdmsCreate;
        $cadUsuario->exeCreate("adms_usuarios", $this->Dados);
        if ($cadUsuario->getResultado()) {
            $this->Resultado = true;
            $_SESSION['msg'] = "<div class='alert alert-success'>Usuário cadastrado com sucesso!</div>";
            
            /*if (empty($this->Foto['name'])) {
                $_SESSION['msg'] = "<div class='alert alert-success'>Usuário cadastrado com sucesso!</div>";
                $this->Resultado = true;
            } else {
                $this->Dados['id'] = $cadUsuario->getResultado();
                $this->valFoto();
            }*/
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: O usuario não foi cadastrado!</div>";
            $this->Resultado = false;
        }
    }
    

}
