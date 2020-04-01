<?php

namespace App\adms\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of Professor
 *
 * @copyright (c) year, Édio Mazera - NEaD
 */
class Professor {

    private $Dados;

    public function index() {
        $listarMenu = new \App\adms\Models\AdmsMenu();
        $this->Dados['menu'] = $listarMenu->itemMenu();
        
        $carregarView = new \Core\ConfigView("adms/Views/professor/professor", $this->Dados);
        $carregarView->renderizar();
    }

}
