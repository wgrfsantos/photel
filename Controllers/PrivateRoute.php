<?php

namespace Controllers;

use Core\Controller;
use Models\Users;

abstract class PrivateRoute extends Controller
{
    protected Users $user;
    protected array $arrayInfo;

    public function __construct()
    {
        $this->user = new Users();

        if (!$this->user->isLogged()) {
            header('Location:' . BASE_URL . 'login');
            exit;
        }

        $this->arrayInfo = array(
            'user' => $this->user
        );
    }
}
