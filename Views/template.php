<!DOCTYPE html>

<html lang="pt-BR">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>Projeto | Hotel</title>
    <link rel="icon" type="imagem/png" href="<?= BASE_URL; ?>assets/img/ph.jpg" />
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="<?= BASE_URL; ?>assets/adminlte/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= BASE_URL; ?>assets/adminlte/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="<?= BASE_URL; ?>assets/css/template.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  </head>

  <body class="hold-transition sidebar-mini">
    <div class="wrapper">

      <!-- Navbar -->
      <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Links da barra de navegação esquerda -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="<?php echo BASE_URL; ?>"><i class="fas fa-bars"></i></a>
          </li>
          <li class="nav-item d-none d-sm-inline-block">
            <a href="<?php echo BASE_URL; ?>" class="nav-link">Home</a>
          </li>
        </ul>

        <!-- Links da barra de navegação direita -->
        <ul class="navbar-nav ml-auto">
          <!-- Messages Dropdown Menu -->
          <li class="nav-item">
            <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="<?php echo BASE_URL; ?>"><p>Olá,  <?php echo $viewData['user']->getName() ;?>!</p></a>
          </li>     
          <li class="nav-item">
            <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="">
              <i class="fas fa-bell"></i></a>
          </li>
          <li class=" nav-item">
            <a href="<?php echo BASE_URL; ?>login/logout" class="nav-link">
              <i class="nav-icon fas fa-sign-in-alt"> Sair</i>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.navbar -->

      <!-- Main Sidebar Container -->
      <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="<?php echo BASE_URL; ?>" class="brand-link">
          <img src="<?php echo BASE_URL; ?>assets/img/ph.jpg" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
          <span class="brand-text font-weight-light">Projeto-Hotel</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
          <!-- Sidebar user panel (optional) -->
          <div class="user-panel mt-3 pb-3 mb-3 d-flex">              
              <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                  <a href="<?php echo BASE_URL; ?>" class="nav-link">
                    <i class="nav-icon fas fa-indent"></i>
                    <p>Home</p>
                  </a>
                </li>
              </ul>              
          </div>

          <!-- Sidebar Menu -->
          <nav class="mt-2">
              <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Adicione ícones aos links usando o .nav-icon class com font-awesome ou qualquer outra biblioteca de fontes de ícones -->

                <?php if( $viewData['user']->hasPermission('calendar_view') ): ?>
                  <li class="nav-item">
                    <a href="<?php echo BASE_URL; ?>calendar" class="nav-link">
                    <i class="nav-icon fas fa-project-diagram"></i>
                      <p>Agenda</p>
                      <span class="right badge badge-danger">Novo</span>
                    </a>
                  </li>
                <?php endif; ?>

                <?php if( $viewData['user']->hasPermission('hosting_view') ): ?>
                  <li class="nav-item">
                    <a href="<?php echo BASE_URL; ?>hosting" class="nav-link">
                    <i class="nav-icon fas fa-bed"></i>
                      <p>Reservar/Hospedar</p>
                      <span class="right badge badge-danger">Novo</span>
                    </a>
                  </li>
                <?php endif; ?>

                <li class="nav-item has-treeview">
                  <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-chart-pie"></i>
                    <p>
                      Gerenciamento
                      <i class="right fas fa-angle-left"></i>
                    </p>
                  </a>
                  <ul class="nav nav-treeview">
                    <?php if( $viewData['user']->hasPermission('management_view') ): ?>
                      <li class="nav-item">
                        <a href="<?php echo BASE_URL; ?>management" class="nav-link">
                        <i class="nav-icon fas fa-hotel"></i>
                          <p>Administrativo</p>
                          <span class="right badge badge-danger">Novo</span>
                        </a>
                      </li>
                    <?php endif; ?>
                    <?php if( $viewData['user']->hasPermission('bedrooms_view') ): ?>
                      <li class="nav-item">
                        <a href="<?php echo BASE_URL; ?>bedrooms" class="nav-link">
                        <i class="nav-icon fas fa-door-open"></i>                        
                          <p>Quartos</p>
                          <span class="right badge badge-danger">Novo</span>
                        </a>
                      </li>
                    <?php endif; ?>

                    <?php if( $viewData['user']->hasPermission('products_view') ): ?>
                      <li class="nav-item">
                        <a href="<?php echo BASE_URL; ?>products" class="nav-link">
                        <i class="nav-icon fas fa-cubes"></i>
                          <p>Produtos</p>
                        </a>
                      </li>
                    <?php endif; ?>

                    <?php if( $viewData['user']->hasPermission('services_view') ): ?>
                      <li class="nav-item">
                        <a href="<?php echo BASE_URL; ?>services" class="nav-link">
                        <i class="nav-icon fas fa-concierge-bell"></i>
                          <p>Serviços</p>
                        </a>
                      </li>
                    <?php endif; ?>

                    <?php if( $viewData['user']->hasPermission('users_view') ): ?>
                      <li class="nav-item">
                        <a href="<?php echo BASE_URL; ?>users" class="nav-link">
                          <i class="nav-icon fas fa-users"></i>
                          <p>Usuários</p>
                        </a>
                      </li>
                    <?php endif; ?>

                    <?php if( $viewData['user']->hasPermission('permissions_view') ): ?>
                      <li class="nav-item">
                        <a href="<?php echo BASE_URL; ?>permissions" class="nav-link">
                          <i class="nav-icon fas fa-lock"></i>
                          <p>Permissões</p>
                        </a>
                      </li>
                    <?php endif; ?>
                  </ul>
                </li>
              </ul>
          </nav>
          <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
      </aside>

      <!-- Contém conteúdo da página -->
      <div class="content-wrapper">
          <?php $this->loadViewInTemplate($viewName, $viewData); ?>        
        
      </div>
      

      <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-dark">
        <!-- O conteúdo da barra lateral de controle está aqui -->
        <div class="p-3">
          <h5>Quadro de Avisos</h5>
          <p>Nenhum aviso por enquanto</p>
        </div>
      </aside>
      <!-- /.control-sidebar -->

      <!-- Rodapé -->
      <footer class="main-footer">
        <!-- conteúdo da direita -->
        <div class="float-right d-none d-sm-inline">
          <b>Versão</b> 0.0.1
        </div>
        <!-- conteúdo da esquerda -->
        <strong>Copyright &copy; 2019-<?php echo date('Y'); ?> <a href="https://www.wvsoft.com.br">WVsoft</a>.</strong> Todos os direitos reservados.
      </footer>
    </div>
 
  <!-- SCRIPTS NECESSÁRIOS -->

  <!-- jQuery -->
  <script src="<?php echo BASE_URL; ?>assets/adminlte/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="<?php echo BASE_URL; ?>assets/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?php echo BASE_URL; ?>assets/adminlte/dist/js/adminlte.min.js"></script>
  <script src="<?php echo BASE_URL; ?>assets/js/script.js"></script>
  </body>
</html>