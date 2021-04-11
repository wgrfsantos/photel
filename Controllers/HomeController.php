<?php

namespace Controllers;

use Controllers\PrivateRoute;

class HomeController extends PrivateRoute
{


    public function __construct()
    {
        parent::__construct();

        $this->arrayInfo['menuActive'] = 'home';
    }

    public function index()
    {
        $this->loadTemplate('home', $this->arrayInfo);
    }
}
