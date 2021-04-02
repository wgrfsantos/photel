<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Trocar Senha do Usuário
  </h1>
</section>
<section class="content container-fluid">
    <h4  align="center">Nova Senha</h4>
    <div  align="right">
        <a href="<?php echo BASE_URL . 'users'; ?>" class="btn btn-primary"><i class="nav-icon fas fa-reply"></i> Voltar</a>      
    </div><br>  
    <div class="shadow p-3 mb-5 bg-white rounded">
        <div class="form-group">
            <label for="name">Nome do Usuário:</label>
            <input type="text" class="form-control" disabled value="<?php echo $users_list['name']; ?>"/>               
        </div>
        <form method="POST" action="<?php echo BASE_URL; ?>users/new_pass_action">
            <input type="hidden" name="id" value="<?php echo $users_list['id']; ?>">                
                <?php echo(in_array('aviso', $errorItems)) ? '
					<div class="alert alert-warning alert-dismissible" role="alert">
						 <strong>Ops!</strong> Este Usuário já existe.
						<button class="close" data-dismiss="alert" aria-label="Fechar">
							<samp aria-hidden="true">&times;</samp>
						</button>
					</div>' : ''
                ; ?>                        
            <div class="form-group">
                <label for="password">Nova Senha:</label>
                <input type="password" name="password" id="password" class="form-control" required placeholder="<?php echo(in_array('obs', $errorItems)) ? 'Preencha esta campo.' : ''; ?>"/>
            </div>
            <div  align="right">
                <input type="submit" class="btn btn-success" value="Salvar" />
            </div>      
        </form>
    </div>
</section>
<!-- /.content -->