<!-- Content Header (Page header) -->
<section class="content-header">
	<div class="row">
		<div class="col-sm-6">
			<h1>Usuários</h1>
		</div>
		<div class="col-sm-6">
			<div align="right">
				<?php if( $user->hasPermission('users_add') ): ?>
					<div class="btn-group btn-group-sm">
						<a href="<?php echo BASE_URL.'users/add'; ?>" class="btn btn-success">Criar Usuário</a>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>

<!-- Main content -->
<section class="content container-fluid">
	
		<div class="shadow p-3 mb-5 bg-white rounded">
			<div class="row">
				<div class="col-sm-6">
					<h5>Filtro</h5>
				</div>
				<div class="col-sm-6">
					<div align="right">
						<div class="btn-group btn-group-sm">
							<a href="<?php echo BASE_URL.'users'; ?>" class="btn btn-secondary"><i class="fas fa-eraser"></i> Limpar Filtro</a>
						</div>
					</div>
				</div>
			</div><br>
				<div class="box-body">
					<form method="GET">
						<div class="row">
							<div class="col-sm-5">
								<div class="input-group mb-3 input-group-sm">
								    <div class="input-group-prepend">
								       <span class="input-group-text">Nome ou Email:</span>
								    </div>
								    <input type="text" name="name"  value="<?php echo $filter['name']; ?>" id="form_user" class="form-control">
								</div>
							</div>
							<div class="col-sm-5">
								<div class="input-group mb-3 input-group-sm">
								    <div class="input-group-prepend">
								       <span class="input-group-text">Grupo:</span>
								    </div>
								    <select name="permission" class="form-control" id="form_permission">
										<option></option>
							              <?php foreach($permission_list as $item): ?>
							               <option <?php echo ($filter['permission']==$item['id'])?'selected':''; ?> value="<?php echo $item['id']; ?>"><?php echo $item['name']; ?></option>
							              <?php endforeach; ?>
									</select>
								</div>
							</div>
							<div class="col-sm-2" align="right">
								<div class="btn-group btn-group-sm btn-block">
									<button type="submit" class="btn btn-primary"><i class="fas fa-filter"></i> Filtrar</button>
								</div>
							</div>
						</div>
					</form>
				</div>
			
		</div>

	<div class="shadow p-3 mb-5 bg-white rounded table-responsive">
		<div class="box">
		<div class="box-header">
			<h5 class="box-title" align="center">Gerenciamento de Usuários</h5>
			
		</div><br>
		<div class="box-body">

			<table class="table table-sm">
				<thead class="thead-light">
					<tr>
						<th>Nome</th>
						<th>Email</th>
						<th>Grupo de Permissão</th>						
						<th width="130">Ações</th>					
					</tr>
				</thead>

				<?php foreach($list as $item): ?>
				<tbody>
					<tr>
						 <?php if($item['admin'] === '1'): ?>
			              	<td><span class="right badge badge-success"><?php echo $item['name']; ?></span></td>
			            <?php else: ?>
			          		<td><span class="right badge badge-danger"><?php echo $item['name']; ?></span></td>
			            <?php endif; ?>
						<td><?php echo $item['email']; ?></td>
						<td><?php echo $item['permission_name']; ?></td>
						
						<td>
							<div class="btn-group">
								<?php if( $user->hasPermission('users_edit') ): ?>
									<a href="<?php echo BASE_URL.'users/new_pass/'.$item['id']; ?>" class="btn btn-xs btn-primary">Trocar Senha</a>
									<a href="<?php echo BASE_URL.'users/edit/'.$item['id']; ?>" class="btn btn-xs btn-warning">Editar</a>
								<?php endif; ?>
								<?php if( $user->hasPermission('users_del') ): ?>
									<a href="<?php echo BASE_URL.'users/del/'.$item['id']; ?>" class="btn btn-xs btn-danger">Excluir</a>
								<?php endif; ?>
							</div>
						</td>
					</tr>
				</tbody>
				<?php endforeach; ?>				

			</table>

			<hr/>

		      <?php
		      $total_pages = ceil($pag['total'] / $pag['per_page']);
		      ?>
		      <?php for($q=0;$q<$total_pages;$q++): ?>
		        <a href="<?php
		        $items = $_GET;
		        unset($items['url']);
		        $items['p'] = ($q+1);

		        echo BASE_URL.'users?'.http_build_query($items);
		        ?>">
		          <?php echo ($q==$pag['currentpage'])?'<strong>[ '.($q+1).' ]</strong>':'[ '.($q+1).' ]'; ?>
		        </a>
		      <?php endfor; ?>

		</div>
	</div>	

</section>
<!-- /.content -->