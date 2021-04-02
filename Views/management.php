 
<div class="content-header">

    <div class="container-fluid">

        <h1 class="m-0 text-dark" align="center">Gerenciamento Administrativo</h1>
        <br>
        <div class="row">

            <?php if ($user->hasPermission('permissions_view')) : ?>
            <div class="col-lg-3 col-4">
                <div class="small-box bg-danger">
                <div class="inner">            
                    <h6><strong>Total de Grupos e Permissões</strong></h6>
                    <h6>Grupos: <?=$total_group?></h6>
                    <h6>Permissões: <?=$total_permissions?></h6>
                </div>
                <div class="icon">
                    <i class="fas fa-lock"></i>
                </div>
                <a href="<?php echo BASE_URL; ?>permissions" class="small-box-footer">Mais informações <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <?php endif; ?>

            <?php if ($user->hasPermission('users_view')) : ?>
            <div class="col-lg-3 col-4">
                <div class="small-box bg-warning">
                <div class="inner">      
                    <h6><strong>Usuários</strong></h6>
                    <h6>Total: <?=$total_users?></h6>
                    <h6>Ativos: <?=$total_active?></h6>         
                </div>
                <div class="icon">
                    <i class="fas fa-users"></i>
                </div>
                <a href="<?php echo BASE_URL; ?>users" class="small-box-footer">Mais informações <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <?php endif; ?>

            <?php if ($user->hasPermission('hosting_view')) : ?>
            <div class="col-lg-3 col-4">
                <div class="small-box bg-dark">
                    <div class="inner">            
                    <h6><strong>Reservar/Hospedar</strong></h6>
                    <h6>Total: </h6>
                    <h6>.</h6>
                    </div>
                    <div class="icon">
                    <i class="fas fa-bed"></i>
                    </div>
                    <a href="<?php echo BASE_URL; ?>" class="small-box-footer">Mais informações <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <?php endif; ?>

        </div>
            

        <div class="row">

            <?php if ($user->hasPermission('services_view')) : ?>
                <div class="col-lg-3 col-4">
                    <div class="small-box bg-success">
                    <div class="inner">            
                        <h6><strong>Serviços</strong></h6>
                        <h6>Total: <?=$total_services?></h6>
                        <h6>Ativos: <?=$total_ativoss?></h6>
                    </div>
                    <div class="icon">
                        <i class="fas fa-concierge-bell"></i>
                    </div>
                    <a href="<?php echo BASE_URL; ?>services" class="small-box-footer">Mais informações <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            <?php endif; ?>

            <?php if ($user->hasPermission('products_view')) : ?>
            <div class="col-lg-3 col-4">
                <div class="small-box bg-primary">
                    <div class="inner">            
                    <h6><strong>Produtos</strong></h6>
                    <h6>Total: <?=$total_products?></h6>
                    <h6>Ativos: <?=$total_ativos?></h6>
                    </div>
                    <div class="icon">
                    <i class="fas fa-cubes"></i>
                    </div>
                    <a href="<?php echo BASE_URL; ?>products" class="small-box-footer">Mais informações <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <?php endif; ?>

            <?php if ($user->hasPermission('bedrooms_view')) : ?>
            <div class="col-lg-3 col-4">
                <div class="small-box bg-info">
                <div class="inner">
                    <h6><strong>Quartos</strong></h6>
                    <h6>Total: </h6>
                    <h6>.</h6>
                </div>
                <div class="icon">
                    <i class="fas fa-door-open"></i>
                </div>
                <a href="<?php echo BASE_URL; ?>" class="small-box-footer">Mais informações <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <?php endif; ?>

        </div>


    </div>

</div>
  