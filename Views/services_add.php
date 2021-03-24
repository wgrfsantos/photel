<!-- Content Header (Page header) -->
<section class="content-header">
  <h1 >
    Cadastro de Serviços
  </h1>
</section>

<!-- Main content -->
<section class="content container-fluid">

	<form method="POST" enctype="multipart/form-data" action="<?php echo BASE_URL; ?>services/add_action">
		<div class="shadow p-3 mb-5 bg-white rounded">

			<h4  align="center">Novo Serviço</h4>
			<div  align="right">
				<a href="<?php echo BASE_URL.'services'; ?>" class="btn btn-primary"><i class="nav-icon fas fa-reply"></i> Voltar</a>
				<input type="submit" class="btn btn-success" value="Salvar" />
			</div><br>				

			<div class="input-group mb-3 input-group-sm">
				<div class="input-group-prepend">
					<span class="input-group-text">Descrição:</span>
				</div>
				<input required type="text" class="form-control" id="description" name="description"  placeholder="Preenchimento Obrigatório." />
			</div>

			<div class="input-group mb-3 input-group-sm">
				<div class="input-group-prepend">
					<span class="input-group-text">Preço:</span>
				</div>
				<input required type="text" class="form-control" id="price" name="price" />
			</div>	

			<div class="input-group mb-3 input-group-sm">
				<div class="input-group-prepend">
					<span class="input-group-text">Status:</span>
				</div>
				<select required name="status" id="status" class="form-control">						
					<option value="1">Ativo</option>
					<option value="2">Inativo</option>			
				</select>
			</div>
			
		</div>
	</form>

</section>