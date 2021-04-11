<?php

namespace Controllers;

use Controllers\PrivateRoute;
use Models\Users;
use Models\Permissions;

class UsersController extends PrivateRoute
{

    public function __construct()
    {
        parent::__construct();

        $this->arrayInfo['menuActive'] = 'users';
    }

    public function index()
    {
        if ($this->user->hasPermission('users_view')) {
            $users = new Users();
            $permissions = new Permissions();

            // FILTRO
            $this->arrayInfo['filter'] = array('name' => '', 'permission' => '');

            if (!empty($_GET['name'])) {
                $this->arrayInfo['filter']['name'] = $_GET['name'];
            }
            if (!empty($_GET['permission'])) {
                $this->arrayInfo['filter']['permission'] = $_GET['permission'];
            }

            // PAGINAÇÃO
            $this->arrayInfo['pag'] = array('currentpage' => 0, 'total' => 0, 'per_page' => 3);
            if (!empty($_GET['p'])) {
                $this->arrayInfo['pag']['currentpage'] = intval($_GET['p']) - 1;
            }

            $this->arrayInfo['permission_list'] = $permissions->getAllGroups();

            $this->arrayInfo['list'] = $users->getAll($this->arrayInfo['filter'], $this->arrayInfo['pag']);
            $this->arrayInfo['pag']['total'] = $users->getTotal($this->arrayInfo['filter']);

            $this->loadTemplate('users', $this->arrayInfo);
        } else {
            header("Location: " . BASE_URL);
            exit;
        }
    }

    public function add()
    {
        if ($this->user->hasPermission('users_add')) {
            $this->arrayInfo['errorItems'] = array();

            if (isset($_SESSION['formError']) && count($_SESSION['formError']) > 0) {
                $this->arrayInfo['errorItems'] = $_SESSION['formError'];
                unset($_SESSION['formError']);
            }

            $users = new Users();
            $permissions = new Permissions();
            $this->arrayInfo['permission_list'] = $permissions->getAllGroups();
            $this->loadTemplate('users_add', $this->arrayInfo);
        } else {
            header("Location: " . BASE_URL);
            exit;
        }
    }

    public function add_action()
    {
        if ($this->user->hasPermission('users_add')) {
            $users = new Users();
            $permissions = new Permissions();

            if (isset($_POST['email']) && !empty($_POST['email'])) {
                $name = $_POST['name'];
                $email = $_POST['email'];
                $id_permission = $_POST['id_permission'];
                $admin = $_POST['admin'];
                $password = $_POST['password'];


                #if(!empty($name) && !empty($email) && !empty($id_permission) && !empty($admin) && !empty($password)){
                if ($users->addUser($name, $email, $id_permission, $admin, $password)) {
                    header("Location: " . BASE_URL . "users");
                    exit;
                } else {
                    //OBS de já cadastrado.
                    $_SESSION['formError'] = array('aviso');
                    header("Location: " . BASE_URL . "users/add");
                    exit;
                }
            } else {
                // OBS: preencha todos os campos.
                $_SESSION['formError'] = array('obs');
                header("Location: " . BASE_URL . "users/add");
                exit;

                #}
            }
        } else {
            header("Location: " . BASE_URL);
            exit;
        }
    }

    public function edit($id)
    {
        if ($this->user->hasPermission('users_edit')) {
            if (!empty($id)) {
                $this->arrayInfo['errorItems'] = array();

                if (isset($_SESSION['formError']) && count($_SESSION['formError']) > 0) {
                    $this->arrayInfo['errorItems'] = $_SESSION['formError'];
                    unset($_SESSION['formError']);
                }

                $users = new Users();
                $permissions = new Permissions();

                $this->arrayInfo['users_list'] = $users->getAllUsers($id);
                $this->arrayInfo['permission_list'] = $permissions->getAllGroups();

                $this->loadTemplate('users_edit', $this->arrayInfo);
            } else {
                header("Location: " . BASE_URL . 'users');
                exit;
            }
        } else {
            header("Location: " . BASE_URL);
            exit;
        }
    }

    public function edit_action()
    {
        if ($this->user->hasPermission('users_edit')) {
            $users = new Users();
            $permissions = new Permissions();
            if (!empty($_POST['id'])) {
                if (isset($_POST['email']) && !empty($_POST['email'])) {
                    $name = $_POST['name'];
                    $email = $_POST['email'];
                    $id_permission = $_POST['id_permission'];
                    $admin = $_POST['admin'];
                    $id = $_POST['id'];

                    if ($users->editUser($name, $email, $id_permission, $admin, $id)) {
                        header("Location: " . BASE_URL . "users");
                        exit;
                    } else {
                        // OBS: preencha todos os campos.
                        $_SESSION['formError'] = array('obs');
                        header("Location: " . BASE_URL . "users");
                        exit;
                    }
                }
            } else {
                /** @todo Review this redirection */
                header("Location: " . BASE_URL . 'users/');
                exit;
            }
        } else {
            header("Location: " . BASE_URL);
            exit;
        }
    }

    public function del($id_user)
    {
        if ($this->user->hasPermission('users_del')) {
            if (!empty($id_user)) {
                $users = new Users();
                $users->deleteUser($id_user);
            }
            header("Location: " . BASE_URL . "users");
            exit;
        } else {
            header("Location: " . BASE_URL);
            exit;
        }
    }

    public function new_pass($id)
    {
        if ($this->user->hasPermission('users_edit')) {
            if (!empty($id)) {
                $this->arrayInfo['errorItems'] = array();
                if (isset($_SESSION['formError']) && count($_SESSION['formError']) > 0) {
                    $this->arrayInfo['errorItems'] = $_SESSION['formError'];
                    unset($_SESSION['formError']);
                }
                $users = new Users();
                $this->arrayInfo['users_list'] = $users->getAllUsers($id);
                $this->loadTemplate('users_new_pass', $this->arrayInfo);
            } else {
                header("Location: " . BASE_URL . 'users');
                exit;
            }
        } else {
            header("Location: " . BASE_URL);
            exit;
        }
    }

    public function new_pass_action()
    {
        if ($this->user->hasPermission('users_edit')) {
            $users = new Users();
            if (!empty($_POST['id'])) {
                if (isset($_POST['password']) && !empty($_POST['password'])) {
                    $password = $_POST['password'];
                    $id = $_POST['id'];

                    if ($users->newPassUser($password, $id)) {
                        header("Location: " . BASE_URL . "users");
                        exit;
                    } else {
                        // OBS: preencha todos os campos.
                        $_SESSION['formError'] = array('obs');
                        header("Location: " . BASE_URL . "users");
                        exit;
                    }
                }
            } else {
                /** @todo Review this redirection */
                header("Location: " . BASE_URL . 'users/');
                exit;
            }
        } else {
            header("Location: " . BASE_URL);
            exit;
        }
    }
}
