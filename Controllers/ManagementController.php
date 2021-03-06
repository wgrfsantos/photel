<?php

namespace Controllers;

use Controllers\PrivateRoute;
use Models\Users;
use Models\Permissions;
use Models\Products;
use Models\Services;

class ManagementController extends PrivateRoute
{


    public function __construct()
    {
        parent::__construct();

        $this->arrayInfo['menuActive'] = 'management';
    }

    public function index()
    {

        $services = new Services();
        $total_services = $services->getTotalServices();
        $this->arrayInfo['total_services'] = $total_services;
        $total_ativoss = $services->getTotalServicesAtivos();
        $this->arrayInfo['total_ativoss'] = $total_ativoss;

        $products = new Products();
        $total_products = $products->getTotalProducts();
        $this->arrayInfo['total_products'] = $total_products;
        $total_ativos = $products->getTotalProductsAtivos();
        $this->arrayInfo['total_ativos'] = $total_ativos;

        $p = new Permissions();
        $total_group = $p->getTotalGroup();
        $this->arrayInfo['total_group'] = $total_group;
        $total_permissions = $p->getTotalItems();
        $this->arrayInfo['total_permissions'] = $total_permissions;

        $users = new Users();
        $total_users = $users->getAllUsersCount();
        $this->arrayInfo['total_users'] = $total_users;
        $total_active = $users->getAllUsersCountActive();
        $this->arrayInfo['total_active'] = $total_active;

        $this->loadTemplate('management', $this->arrayInfo);
    }
}
