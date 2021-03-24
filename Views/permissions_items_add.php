<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Criando Permissão
  </h1>
</section>

<!-- Main content -->
<section class="content container-fluid">

	<form method="POST" action="<?php echo BASE_URL; ?>permissions/items_add_action">
		<div class="shadow p-3 mb-5 bg-white rounded">
			<div class="box">
				<div class="box-header">
					<h4 class="box-title" align="center">Nova Permissão</h4>
					<div class="box-tools" align="right">
						<a href="<?php echo BASE_URL.'permissions/items'; ?>" class="btn btn-primary"><i class="nav-icon fas fa-reply"></i> Voltar</a>
						<input type="submit" class="btn btn-success" value="Salvar" />
					</div>
				</div>
				<div class="box-body">

					<div class="form-group <?php echo(in_array('name', $errorItems))?'has-error':''; ?>">
						<label for="name">Nome da Permissão</label>
						<input type="text" class="form-control" id="name" name="name" required />
					</div>
					<br>
					<div class="form-group <?php echo(in_array('slug', $errorItems))?'has-error':''; ?>">
						<label for="slug">Slug</label>
						<input type="text" class="form-control" id="slug" name="slug" required placeholder="Exemplo: cliente_view" />
					</div>
					<br>
					<div class="form-group <?php echo(in_array('type', $errorItems))?'has-error':''; ?>">						
						<label for="type">Tipo</label>
						<select class="form-control" id="type" name="type" required>
							<option></option>
							<option value="1">Visualização</option>
							<option value="2">Adição</option>
							<option value="3">Edição</option>
							<option value="4">Exclusão</option>
							<option value="0">Reservado</option>
						</select>
					</div>					
					
				</div>
			</div>
		</div>
	</form>

</section>
<!-- /.content -->