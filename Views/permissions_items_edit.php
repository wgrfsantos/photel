<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Gerenciando Permissão
  </h1>
</section>

<!-- Main content -->
<section class="content container-fluid">

    <form method="POST" action="<?php echo BASE_URL; ?>permissions/items_edit_action">
        <input type="hidden" name="id" value="<?php echo $info['id']; ?>">
        <div class="shadow p-3 mb-5 bg-white rounded">
            <div class="box">
                <div class="box-header">
                    <h4 class="box-title" align="center">Editar Permissão</h4>
                    <div class="box-tools" align="right">
                        <a href="<?php echo BASE_URL . 'permissions/items'; ?>" class="btn btn-primary"><i class="nav-icon fas fa-reply"></i> Voltar</a>
                        <input type="submit" class="btn btn-success" value="Salvar" />
                    </div>
                </div>
                <div class="box-body">

                    <div class="form-group <?php echo(in_array('name', $errorItems)) ? 'has-error' : ''; ?>">
                        <label for="name">Nome da Permissão</label>
                        <input type="text" class="form-control" id="name" name="name" required value="<?php echo $info['name']; ?>" />
                    </div>
                    <br>
                    <div class="form-group <?php echo(in_array('slug', $errorItems)) ? 'has-error' : ''; ?>">
                        <label for="slug">Slug</label>
                        <input type="text" class="form-control" id="slug" name="slug" required value="<?php echo $info['slug']; ?>" />
                    </div>
                    <br>
                    <div class="form-group <?php echo(in_array('type', $errorItems)) ? 'has-error' : ''; ?>">                       
                        <label for="type">Tipo</label>
                        <select class="form-control" id="type" name="type" required >
                            <option value="1" <?php echo ($info['type'] == '1') ? 'selected="selected"' : ''; ?>>Visualização</option>
                            <option value="2" <?php echo ($info['type'] == '2') ? 'selected="selected"' : ''; ?>>Adição</option>
                            <option value="3" <?php echo ($info['type'] == '3') ? 'selected="selected"' : ''; ?>>Edição</option>
                            <option value="4" <?php echo ($info['type'] == '4') ? 'selected="selected"' : ''; ?>>Exclusão</option>
                            <option value="0" <?php echo ($info['type'] == '0') ? 'selected="selected"' : ''; ?>>Reservado</option>
                        </select>
                    </div>                  
                    
                </div>
            </div>
        </div>
    </form>

</section>
<!-- /.content -->
