<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Criando Novo Grupo
  </h1>
</section>

<!-- Main content -->
<section class="content container-fluid">

	<form method="POST" action="<?php echo BASE_URL; ?>permissions/add_action">
		<div class="shadow p-3 mb-5 bg-white rounded">
			<div class="box">
				<div class="box-header">
					<h4 class="box-title" align="center">Novo Grupo de Permissão</h4>
					<div class="box-tools" align="right">
						<a href="<?php echo BASE_URL.'permissions'; ?>" class="btn btn-primary"><i class="nav-icon fas fa-reply"></i> Voltar</a>
						<input type="submit" class="btn btn-success" value="Salvar" />
					</div>
				</div>
				<div class="box-body">

					<div class="form-group <?php echo(in_array('name', $errorItems))?'alert alert-danger':''; ?>">
						<label for="group_name">Nome do grupo</label>
						<input type="text" class="form-control" id="group_name" name="name" />
					</div>
					
					<hr/>
					<table class="table">
						<thead class="thead-light">
							<tr style="text-transform: uppercase;">
								<th class="bg-primary">Visualizar</th>
								<th class="bg-success">Adicionar</th>
								<th class="bg-warning">Editar</th>
								<th class="bg-danger">Excluir</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>
									<?php foreach($permission_items_view as $view): ?>
										<div class="form-group <?php echo (in_array('name', $errorItems))?'has-error':''; ?>">
											<input type="checkbox" name="items[]" value="<?php echo $view['id']; ?>" id="view-<?php echo $view['id']; ?>" />
											<label for="view-<?php echo $view['id']; ?>"><?php echo $view['name']; ?></label>
										</div>
									<?php endforeach; ?>
								</td>
								<td>
									<?php foreach($permission_items_add as $add): ?>
										<div class="form-group">
											<input type="checkbox" name="items[]" value="<?php echo $add['id']; ?>" id="add-<?php echo $add['id']; ?>" />
											<label for="add-<?php echo $add['id']; ?>"><?php echo $add['name']; ?></label>
										</div>
									<?php endforeach; ?>
								</td>
								<td>
									<?php foreach($permission_items_edit as $edit): ?>
										<div class="form-group">
											<input type="checkbox" name="items[]" value="<?php echo $edit['id']; ?>" id="edit-<?php echo $edit['id']; ?>" />
											<label for="edit-<?php echo $edit['id']; ?>"><?php echo $edit['name']; ?></label>
										</div>
									<?php endforeach; ?>
								</td>
								<td>
									<?php foreach($permission_items_del as $del): ?>
										<div class="form-group">
											<input type="checkbox" name="items[]" value="<?php echo $del['id']; ?>" id="del-<?php echo $del['id']; ?>" />
											<label for="del-<?php echo $del['id']; ?>"><?php echo $del['name']; ?></label>
										</div>
									<?php endforeach; ?>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</form>

</section>
<!-- /.content -->