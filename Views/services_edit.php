<!-- Content Header (Page header) -->
<section class="content-header">
  <h1 >
    Edição de Serviços
  </h1>
</section>

<!-- Main content -->
<section class="content container-fluid">

    <form method="POST" action="<?php echo BASE_URL; ?>services/edit_action">
        <input type="hidden" name="id" value="<?php echo $product_data['id']; ?>">

        <div class="shadow p-3 mb-5 bg-white rounded">			
                
            <h4  align="center">Editar Serviço</h4>
            <div  align="right">
                <a href="<?php echo BASE_URL.'services'; ?>" class="btn btn-primary"><i class="nav-icon fas fa-reply"></i> Voltar</a>
                <input type="submit" class="btn btn-success" value="Salvar Alterações" />
            </div><br>

				<div class="input-group mb-3 input-group-sm">
					<div class="input-group-prepend">
						<span class="input-group-text">Descrição:</span>
					</div>
					<input type="texte" name="description" id="description" class="form-control" value="<?php echo $product_data['description']; ?>" required placeholder="Preenchimento Obrigatório.">
				</div>

				<div class="input-group mb-3 input-group-sm">
					<div class="input-group-prepend">
						<span class="input-group-text">Preço:</span>
					</div>
					<input type="text" name="price" id="price" class="form-control" value="<?php echo $product_data['price']; ?>" required placeholder="Preenchimento Obrigatório.">
				</div>

				<div class="input-group mb-3 input-group-sm">
					<div class="input-group-prepend">
						<span class="input-group-text">Status:</span>
					</div>
					<select class="form-control" name="status" id="status" required>	
						<option value="1" <?php echo ($product_data['status'] == 1 ? "selected='selected'" : "");?>>Ativo</option>
						<option value="2" <?php echo ($product_data['status'] == 2 ? "selected='selected'" : "");?>>Inativo</option>
					</select>
				</div>                       
            
        </div>
    </form>

</section>
<!-- /.content -->