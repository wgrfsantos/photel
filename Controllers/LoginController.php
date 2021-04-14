<?php

namespace Controllers;

use Core\Controller;
use Models\Users;

class LoginController extends Controller
{

    public function index(): void
    {
        $array = array(
            'error' => ''
        );

        if (!empty($_SESSION['errorMsg'])) {
            $array['error'] = $_SESSION['errorMsg'];
            $_SESSION['errorMsg'] = '';
        }

        $this->loadView('login', $array);
    }

    public function index_action(): void
    {
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $password = filter_input(INPUT_POST, 'password', FILTER_UNSAFE_RAW);
        $user = new Users();

        if ($email && $password && $user->validateLogin($email, $password)) {
            header('Location:' . BASE_URL);
            exit;
        }
        $_SESSION['errorMsg'] = ($email && $password) ?
                                'Usuário e/ou senha incorretos' :
                                'Preencha os campos adequadamente';
        header('Location:' . BASE_URL . 'login');
        exit;
    }

    /**
     * Desloga o usuário limpando a Sessão
     */
    public function logout(): void
    {
        $_SESSION = array();
        header("Location: " . BASE_URL);
        exit;
    }
}
