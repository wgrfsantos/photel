<!-- Content Header (Page header) -->
<section class="content-header">
  <h1 >
    Grupos de Usuários
  </h1>
</section>

<!-- Main content -->
<section class="content container-fluid">

    <div class="shadow p-3 mb-5 bg-white rounded">

        <div class="box">
        <div class="box-header">
            <h4 class="box-title" align="center">Gerenciamento de Grupos e Permissões</h4>
            <div class="box-tools" align="right">
                <a href="<?php echo BASE_URL . 'permissions/items'; ?>" class="btn btn-primary">Permissões</a>
                <a href="<?php echo BASE_URL . 'permissions/add'; ?>" class="btn btn-success">Criar Grupo</a>
            </div>
        </div><br>
        <div class="box-body">

            <table class="table">
                <thead class="thead-light">
                    <tr>
                        <th width="50">ID</th>
                        <th>Nome do Grupo</th>
                        <th width="150">Ativos</th>
                        <th width="150">Permissões</th>
                        <th width="130">Ações</th>
                    </tr>
                </thead>

                <?php foreach ($list as $item) : ?>
                <tbody>
                    <tr>
                        <td><?php echo $item['id']; ?></td>
                        <td><?php echo $item['name']; ?></td>
                        <td><?php echo $item['total_users']; ?></td>
                        <td><?php echo $item['total_permissions']; ?></td>
                        <td>
                            <div class="btn-group">
                                <a href="<?php echo BASE_URL . 'permissions/edit/' . $item['id']; ?>" class="btn btn-xs btn-primary">Editar</a>
                                <a href="<?php echo BASE_URL . 'permissions/del/' . $item['id']; ?>" class="btn btn-xs btn-danger <?php echo ($item['total_users'] != '0') ? 'disabled' : ''; ?>">Excluir</a>
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
