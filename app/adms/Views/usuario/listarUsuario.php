<?php
if (!defined('URL')) {
    header("Location: /");
    exit();
}
?>
<div class="content p-1">
    <div class="list-group-item">
        <div class="d-flex">
            <div class="mr-auto p-2">
                <h2 class="display-4 titulo">Listar Usuários</h2>
            </div>
            <?php
            if ($this->Dados['botao']['cad_usuario']) {
                ?>
                <a href="<?php echo URLADM . 'cadastrar-usuario/cad-usuario'; ?>">
                    <div class="p-2">
                        <button class="btn btn-outline-success btn-sm">
                            Cadastrar
                        </button>
                    </div>
                </a>
                <?php
            }
            ?>
        </div>
        <!-- pesquisar -->
        <form class="form-inline" method="POST" action="<?php echo URLADM . 'pesq-usuarios/listar'; ?>">
            <div class="form-group">
                <label>Nome</label>
                <input name="nome" type="text" id="nome" class="form-control mx-sm-3" placeholder="Nome do usuário">
            </div>
            <div class="form-group">
                <label>E-mail</label>
                <input name="email" type="text" id="email" class="form-control mx-sm-3" placeholder="E-mail do usuário">
            </div>
            <div class="form-group">
                <label>Filtro</label>
                <select name="filtro" id="filtro" class="form-control">
                        <option value='0' selected>OU</option>
                        <option value='1'>E</option>
                    </select>
            </div>
            <input name="PesqUsuario" type="submit" class="btn btn-outline-primary my-2" value="Pesquisar">
        </form><hr>
        
        <?php
        echo $this->Dados['paginacao'];
        if (empty($this->Dados['listUser'])) {
            ?>
            <div class="alert alert-danger" role="alert">
                Nenhum usuário encontrado!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php
        }
        if (isset($_SESSION['msg'])) {
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }
        ?>
        <div class="table-responsive">
            <table class="table table-striped table-hover table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th class="d-none d-sm-table-cell">E-mail</th>
                        <th class="d-none d-lg-table-cell">Situação</th>
                        <th class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($this->Dados['listUser'] as $usuario) {
                        extract($usuario);
                        ?>
                        <tr>
                            <th><?php echo $id; ?></th>
                            <td><?php echo $nome; ?></td>
                            <td class="d-none d-sm-table-cell"><?php echo $email; ?></td>
                            <td class="d-none d-lg-table-cell">
                                <span class="badge badge-<?php echo $cor_cr; ?>"><?php echo $nome_sit; ?></span>
                            </td>
                            <td class="text-center">
                                <span class="d-none d-md-block">
                                    <?php
                                    if ($this->Dados['botao']['vis_usuario']) {
                                        echo "<a href='". URLADM . "ver-usuario/ver-usuario/$id' class='btn btn-outline-primary btn-sm'>Visualizar</a> ";
                                    }
                                    if ($this->Dados['botao']['edit_usuario']) {
                                        echo "<a href='". URLADM . "editar-usuario/edit-usuario/$id' class='btn btn-outline-warning btn-sm'>Editar</a> ";
                                    }
                                    if ($this->Dados['botao']['del_usuario']) {
                                        echo "<a href='". URLADM . "apagar-usuario/apagar-usuario/$id' class='btn btn-outline-danger btn-sm' data-confirm='Tem certeza de que deseja excluir o item selecionado?'>Apagar</a> ";
                                    }
                                    ?>
                                </span>
                                <div class="dropdown d-block d-md-none">
                                    <button class="btn btn-primary dropdown-toggle btn-sm" type="button" id="acoesListar" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Ações
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="acoesListar">
                                        <?php
                                        if ($this->Dados['botao']['vis_usuario']) {
                                            echo "<a class='dropdown-item' href='". URLADM . "ver-usuario/ver-usuario/$id'>Visualizar</a>";
                                        }
                                        if ($this->Dados['botao']['edit_usuario']) {
                                            echo "<a class='dropdown-item' href='". URLADM . "editar-usuario/edit-usuario/$id'>Editar</a>";
                                        }
                                        if ($this->Dados['botao']['del_usuario']) {
                                            echo "<a class='dropdown-item' href='". URLADM . "apagar-usuario/apagar-usuario/$id' data-confirm='Tem certeza de que deseja excluir o item selecionado?'>Apagar</a>";                                           
                                        }
                                        ?>
                                        
                                       
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table> 
        </div>
    </div>
</div>