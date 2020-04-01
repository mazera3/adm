<?php

namespace App\sts\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of Responder
 *
 * @copyright (c) 
 */
class Responder
{

    private $Dados;
    private $DadosId;

    public function responderContato($DadosId = null)
    {        
        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $this->DadosId = (int) $DadosId;
        if (!empty($this->DadosId)) {
            $verContato = new \App\sts\Models\StsVerContato();
            $this->Dados['dados_Contato'] = $verContato->verContato($this->DadosId);
            
        
        if (!empty($this->Dados['RespCont'])) {
            unset($this->Dados['RespCont']);
            $repContato = new \Sts\Models\StsResponder();
            $repContato->respContato($this->Dados);
            if ($repContato->getResultado()) {
                $this->Dados['form'] = null;
            } else {
                $this->Dados['form'] = $this->Dados;
            }            
        }
        
        $botao = [
            'list_contato' => ['menu_controller' => 'contato', 'menu_metodo' => 'listar'],
            'vis_contato' => ['menu_controller' => 'ver-contato', 'menu_metodo' => 'ver-contato']
            ];
        $listarBotao = new \App\adms\Models\AdmsBotao();
        $this->Dados['botao'] = $listarBotao->valBotao($botao);
        
        $listarMenu = new \App\adms\Models\AdmsMenu();
        $this->Dados['menu'] = $listarMenu->itemMenu();
        
        $carregarView = new \Core\ConfigView('sts/Views/contato/respContato', $this->Dados);
        $carregarView->renderizar();
    }else {
            $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: contato ID não encontrado!</div>";
            $UrlDestino = URLADM . 'contato/listar';
            header("Location: $UrlDestino");
        }
    }
}
