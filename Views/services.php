<section class="content-header">
	<div class="row">
		<div class="col-sm-6">
			<h5>Pesquisa de Serviços</h5>
		</div>
		<div class="col-sm-6">
			<div align="right">
				<?php if( $user->hasPermission('services_add') ): ?>
					<div class="btn-group btn-group-sm">					
						<?php if( $user->hasPermission('services_add') ): ?>
							<a href="<?php echo BASE_URL.'services/add'; ?>" class="btn btn-success">Cadastrar Serviço</a>
						<?php endif; ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>

<section class="content container-fluid">

	<div class="shadow p-3 mb-5 bg-white rounded">
			
		<div class="box-body">
			<form method="GET">

				<div class="row">

					<div class="col-sm-8">
						<div class="input-group mb-3 input-group-sm">
							<div class="input-group-prepend">
								<span class="input-group-text">Descrição:</span>
							</div>
							<input type="text" name="name" value="<?php echo $filter['name']; ?>" class="form-control">
						</div>
					</div>

					<div class="col-sm-2">
						<div class="btn-group btn-group-sm btn-block">
							<button type="submit" class="btn btn-primary"><i class="fas fa-filter"></i> Pesquisar</button>
						</div>
					</div>

					<div class="col-sm-2" align="right">						
						<div class="btn-group btn-group-sm">
							<a href="<?php echo BASE_URL.'services'; ?>" class="btn btn-secondary"><i class="fas fa-eraser"></i> Limpar Filtro</a>
						</div>						
					</div>

				</div>

			</form>
		</div>
	
	</div>


	<!--Tabela de produtos-->
	<div class="shadow p-3 mb-5 bg-white rounded table-responsive">
		<div class="box-header">
			<h6 class="box-title" align="center">Gerenciamento de Serviços</h6>			
		</div>
			<table class="table table-sm">
			<thead class="thead-light">
				<tr>
					<th>ID</th>
					<th>Descrição</th>					
					<th>Preço</th>
					<th>Status</th>
					<th width="130">Ações</th>
				</tr>
			</thead>

			<?php foreach($list as $item): ?>
			<tbody>
				<tr>
					<td><?php echo $item['id']; ?></td>
					<td><?php echo $item['description']; ?></td>					
					<td> R$ <?php echo number_format($item['price'], 2, ',', '.'); ?> </td>
					<?php
						switch($item['status']) {
							case '1';
								echo '<td><span class="right badge badge-success">Ativo</span></td>';
							break;
							case '2';
								echo '<td><span class="right badge badge-danger">Inativo</span></td>';
							break;
						}
					?>

					<td>
					<div class="btn-group">
						<?php if( $user->hasPermission('services_edit') ): ?>
						<a href="<?php echo BASE_URL.'services/edit/'.$item['id']; ?>" class="btn btn-xs btn-warning">Editar</a>
						<?php endif; ?>
						<?php if( $user->hasPermission('services_del') ): ?>
						<a href="<?php echo BASE_URL.'services/del/'.$item['id']; ?>" onclick="return confirm('Tem certeza que deseja EXCLUIR este produto?')" class="btn btn-xs btn-danger">Excluir</a>
						<?php endif; ?>
					</div>
					</td>
				</tr>
			</tbody>
			<?php endforeach; ?>

		</table>

		<hr/>

				<?php $total_pages = ceil($pag['total'] / $pag['per_page']); ?>
				<?php for($q=0;$q<$total_pages;$q++): ?>

				<a href="<?php 
				$items = $_GET;
				unset($items['url']);
				$items['p'] = ($q+1);

				echo BASE_URL.'services?'.http_build_query($items); 
				?>">
				<?php echo ($q==$pag['currentpage'])?'<span class="right badge badge-info"> '.($q+1).' </span>':' '.($q+1).' '; ?>
				</a>

				<?php endfor; ?>

		</div>
	</div>

</section>
<!-- /.content -->