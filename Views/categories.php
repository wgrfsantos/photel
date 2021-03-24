<section class="content-header">
	<div class="row">
		<div class="col-sm-6">
			<h1>Gerenciamento de Categorias</h1>
		</div>
		<div class="col-sm-6">
			<div align="right">
				<?php if( $user->hasPermission('categories_add') ): ?>
					<div class="btn-group btn-group-sm">
						<a href="<?php echo BASE_URL.'categories/add'; ?>" class="btn btn-success">Cadastrar Categoria</a>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>

<!-- Main content -->
<section class="content container-fluid">
	<div class="shadow p-3 mb-5 bg-white rounded table-responsive">
		<table class="table table-sm">
			<thead class="thead-light">
				<tr>
					<th>Categorias e Sub</th>
					<th width="130">Ações</th>
				</tr>
			</thead>

        <?php $this->loadView('categories_item', array(
          'itens' => $list,
          'level' => 0
        )); ?>

      </table>

  </div>

</section>
<!-- /.content -->