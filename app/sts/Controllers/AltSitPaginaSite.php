<?php

namespace App\sts\Controllers;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

/**
 * Description of AltSitPaginaSite
 *
 * @copyright (c) year, Cesar Szpak - Celke
 */
class AltSitPaginaSite
{

    private $DadosId;

    public function altSitPaginaSite($DadosId = null)
    {
        $this->DadosId = (int) $DadosId;
        if (!empty($this->DadosId)) {
            $altSitPaginaSite = new \App\sts\Models\StsAltSitPaginaSite();
            $altSitPaginaSite->altSitPaginaSite($this->DadosId);
        }

        $UrlDestino = URLADM . "pagina-site/listar";
        header("Location: $UrlDestino");
    }

}
