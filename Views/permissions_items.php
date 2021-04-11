<!-- Content Header (Page header) -->
<section class="content-header">
  <h1 >
    Permissões de Usuários
  </h1>
</section>

<!-- Main content -->
<section class="content container-fluid">

    <div class="shadow p-3 mb-5 bg-white rounded">

        <div class="box">
        <div class="box-header">
            <h4 class="box-title" align="center">Gerenciamento de Permissões</h4>
            <div class="box-tools" align="right">
                <a href="<?php echo BASE_URL . 'permissions'; ?>" class="btn btn-primary"> <i class="nav-icon fas fa-reply"></i> Voltar</a>
                <a href="<?php echo BASE_URL . 'permissions/items_add'; ?>" class="btn btn-success">Criar Permissão</a>
            </div>
        </div><br>
        <div class="box-body">
            

            <table class="table table-sm">
                <thead class="thead-light">
                    <tr>
                        <th>Nome da Permissão</th>
                        <th>Slug</th>
                        <th>Tipo</th>
                        <th>Link</th>
                        <th width="130">Ações</th>
                    </tr>
                </thead>

                <?php foreach ($list as $item) : ?>
                <tbody>
                    <tr>
                        <td><?php echo $item['name']; ?></td>
                        <td><?php echo $item['slug']; ?></td>
                        <td><?php echo $item['type']; ?></td>
                        <td><?php echo $item['total_links']; ?></td>
                        <td>
                            <div class="btn-group">
                                <a href="<?php echo BASE_URL . 'permissions/items_edit/' . $item['id']; ?>" class="btn btn-xs btn-primary">Editar</a>
                                <a href="<?php echo BASE_URL . 'permissions/items_del/' . $item['id']; ?>" class="btn btn-xs btn-danger <?php echo ($item['total_links'] != '0') ? 'disabled' : ''; ?>">Excluir</a>
                            </div>
                        </td>
                    </tr>
                </tbody>
                <?php endforeach; ?>                

            </table>


        </div>
    </div>  

</section>
<!-- /.content -->
