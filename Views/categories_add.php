<!-- Content Header (Page header) -->
<section class="content-header">
  <h1 >
    Cadastro de Categorias
  </h1>
</section>

<section class="content container-fluid">

    <form method="POST" action="<?php echo BASE_URL; ?>categories/add_action">

        <div class="shadow p-3 mb-5 bg-white rounded">			
                
            <h4  align="center">Nova Categoria</h4>
            <div  align="right">
                <a href="<?php echo BASE_URL.'categories'; ?>" class="btn btn-primary"><i class="nav-icon fas fa-reply"></i> Voltar</a>
                <input type="submit" class="btn btn-success" value="Salvar" />
            </div><br>
                

            <div class="form-group <?php echo (in_array('name', $errorItems))?'has-error':''; ?>">
                <label for="group_name">Nome da categoria</label>
                <input type="text" class="form-control" id="group_name" name="name" required placeholder="Preenchimento obrigatório." />                
            </div>

			<label for="cat_sub">Categoria pai</label>
				<select name="sub" id="cat_sub" class="form-control">
					<option value="">Nenhuma</option>
					<?php $this->loadView('categories_add_item', array(
			          'itens' => $list,
			          'level' => 0
			        )); ?>
				</select>   
            
        </div>
    </form>

</section>
<!-- /.content -->