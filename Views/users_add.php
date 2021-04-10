<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Adicionando Usuário
  </h1>
</section>

<!-- Main content -->
<section class="content container-fluid">

    <form method="POST" action="<?php echo BASE_URL; ?>users/add_action">

        <div class="shadow p-3 mb-5 bg-white rounded">          
                
            <h4  align="center">Novo Usuário</h4>
            <div  align="right">
                <a href="<?php echo BASE_URL . 'users'; ?>" class="btn btn-primary"><i class="nav-icon fas fa-reply"></i> Voltar</a>
                <input type="submit" class="btn btn-success" value="Salvar" />
            </div><br>
            <?php echo(in_array('aviso', $errorItems)) ? '
			<div class="alert alert-warning alert-dismissible" role="alert">
				 <strong>Ops!</strong> Este Usuário já existe.
				<button class="close" data-dismiss="alert" aria-label="Fechar">
					<samp aria-hidden="true">&times;</samp>
				</button>
			</div>' : ''; ?>  

            <div class="form-group">
                <label for="name">Nome</label>
                <input type="text" class="form-control" id="name" name="name" required placeholder="<?php echo(in_array('obs', $errorItems)) ? 'Preencha este campo.' : ''; ?>" />
                
            </div>
            <div class="form-group">
                <label for="email">E-mail:</label>
                <input type="email" name="email" id="email" class="form-control" required placeholder="<?php echo(in_array('obs', $errorItems)) ? 'Preencha este campo.' : ''; ?>" />
            </div>
            <div class="form-group">
                <label for="id_permission">Grupo</label>
                <select name="id_permission" class="form-control" id="id_permission">
                    <option></option>
                      <?php foreach ($permission_list as $item) : ?>
                       <option value="<?php echo $item['id']; ?>"><?php echo $item['name']; ?></option>
                      <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="admin">Status</label>
                <select name="admin" class="form-control" id="admin">
                    <option value="1">Ativo</option>
                    <option value="0">Inativo</option>
                </select>
            </div>
            <div class="form-group">
                <label for="password">Senha:</label>
                <input type="password" name="password" id="password" class="form-control" required placeholder="<?php echo(in_array('obs', $errorItems)) ? 'Preencha este campo.' : ''; ?>"/>
            </div>              
                
            
        </div>
    </form>

</section>
<!-- /.content -->
