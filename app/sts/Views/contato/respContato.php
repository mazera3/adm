<?php
if (!defined('URL')) {
    header("Location: /");
    exit();
}
//var_dump($this->Dados['dados_Contato'][0]);
if (!empty($this->Dados['dados_Contato'][0])) {
    extract($this->Dados['dados_Contato'][0]);
?>
<div class="content p-1">
    <div class="list-group-item">
        <div class="d-flex">
            <div class="mr-auto p-2">
                <h2 class="display-4 titulo">Responder Contato</h2>
            </div>
            <div class="p-2">
                <span class="d-none d-md-block">
                    <?php
                    if ($this->Dados['botao']['vis_contato']) {
                        echo "<a href='" . URLADM . "ver-contato/ver-contato/$id' class='btn btn-outline-info btn-sm'>Visualizar</a> ";
                    }
                    if ($this->Dados['botao']['list_contato']) {
                        echo "<a href='" . URLADM . "contato/listar' class='btn btn-outline-info btn-sm'>Listar</a> ";
                    }
                    ?>
                </span>
            </div>
        </div><hr>
        <?php
        if (isset($_SESSION['msg'])) {
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }
        if (isset($this->Dados['form'])) {
            $valorForm = $this->Dados['form'];
        }
        ?>
        <form method="POST" action="">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>Nome</label>
                    <input name="nome" type="text" class="form-control" value="Resposta para: <?php echo $nome; ?>">
                </div>
                <div class="form-group col-md-6">
                    <label>E-mail</label>
                    <input name="email" type="email" class="form-control" value="<?php echo $email; ?>">
                </div>
            </div>
            <div class="form-group">
                <label>Assunto</label>
                <input name="assunto" type="text" class="form-control" value="<?php echo $assunto; ?>">
            </div>
            <div class="form-group">
                <label>Mensagem</label>
                <textarea name="mensagem" class="form-control" rows="6"></textarea>
            </div>
            <input name="created" type="hidden" value="<?php echo date("Y-m-d H:i:s"); ?>">
            <input name="RespCont" type="submit" class="btn btn-danger" value="Enviar">
        </form>
    </div>	
</div>
<?php

} else {
    $_SESSION['msg'] = "<div class='alert alert-danger'>Erro: contato não encontrado!</div>";
    $UrlDestino = URLADM . 'contato/listar';
    header("Location: $UrlDestino");
}