<?php

namespace Controllers;

use Controllers\PrivateRoute;
use Models\Permissions;

class PermissionsController extends PrivateRoute
{


    public function __construct()
    {
        parent::__construct();

        $this->arrayInfo['menuActive'] = 'permissions';
    }

    public function index()
    {
        $p = new Permissions();
        $this->arrayInfo['list'] = $p->getAllGroups();

        $this->loadTemplate('permissions', $this->arrayInfo);
    }

    public function add()
    {
        $this->arrayInfo['errorItems'] = array();

        $p = new Permissions();

        $this->arrayInfo['permission_items_view'] = $p->getAllItemsView();
        $this->arrayInfo['permission_items_add'] = $p->getAllItemsAdd();
        $this->arrayInfo['permission_items_edit'] = $p->getAllItemsEdit();
        $this->arrayInfo['permission_items_del'] = $p->getAllItemsDel();

        if (isset($_SESSION['formError']) && count($_SESSION['formError']) > 0) {
            $this->arrayInfo['errorItems'] = $_SESSION['formError'];
            unset($_SESSION['formError']);
        }


        $this->loadTemplate('permissions_add', $this->arrayInfo);
    }

    public function add_action()
    {
        $p = new Permissions();

        if (!empty($_POST['name'])) {
            $name = $_POST['name'];
            $id = $p->addGroup($name);

            if (isset($_POST['items']) && count($_POST['items']) > 0) {
                $items = $_POST['items'];

                foreach ($items as $item) {
                    $p->linkItemToGroup($item, $id);
                }
            }

            header("Location: " . BASE_URL . 'permissions');
            exit;
        } else {
            $_SESSION['formError'] = array('name');

            header("Location: " . BASE_URL . 'permissions/add');
            exit;
        }
    }

    public function edit($id)
    {
        if (!empty($id)) {
            $this->arrayInfo['errorItems'] = array();

            $p = new Permissions();

            $this->arrayInfo['permission_items_view'] = $p->getAllItemsView();
            $this->arrayInfo['permission_items_add'] = $p->getAllItemsAdd();
            $this->arrayInfo['permission_items_edit'] = $p->getAllItemsEdit();
            $this->arrayInfo['permission_items_del'] = $p->getAllItemsDel();

            $this->arrayInfo['permission_id'] = $id;
            $this->arrayInfo['permission_group_name'] = $p->getPermissionGroupName($id);
            $this->arrayInfo['permission_group_slugs'] = $p->getPermissions($id);

            if (isset($_SESSION['formError']) && count($_SESSION['formError']) > 0) {
                $this->arrayInfo['errorItems'] = $_SESSION['formError'];
                unset($_SESSION['formError']);
            }


            $this->loadTemplate('permissions_edit', $this->arrayInfo);
        } else {
            header("Location: " . BASE_URL . 'permissions');
            exit;
        }
    }

    public function edit_action($id)
    {
        if (!empty($id)) {
            $p = new Permissions();

            if (!empty($_POST['name'])) {
                $name = $_POST['name'];

                $p->editName($name, $id);

                $p->clearLinks($id);

                if (isset($_POST['items']) && count($_POST['items']) > 0) {
                    $items = $_POST['items'];

                    foreach ($items as $item) {
                        $p->linkItemToGroup($item, $id);
                    }
                }

                header("Location: " . BASE_URL . 'permissions');
                exit;
            } else {
                $_SESSION['formError'] = array('name');

                header("Location: " . BASE_URL . 'permissions/edit/' . $id);
                exit;
            }
        } else {
            header("Location: " . BASE_URL . 'permissions');
            exit;
        }
    }

    public function del($id_group)
    {
        $p = new Permissions();
        $p->deleteGroup($id_group);

        header("Location: " . BASE_URL . 'permissions');
        exit;
    }

    #--------------------Ínicio Controller do CRUD Items de Permissões----------------------

    public function items()
    {
        $p = new Permissions();
        $this->arrayInfo['list'] = $p->getAllItems();

        $this->loadTemplate('permissions_items', $this->arrayInfo);
    }

    public function items_add()
    {
        $this->arrayInfo['errorItems'] = array();
        $p = new Permissions();
        $this->arrayInfo['permission_items'] = $p->getAllItems();

        if (isset($_SESSION['formError']) && count($_SESSION['formError']) > 0) {
            $this->arrayInfo['errorItems'] = $_SESSION['formError'];
            unset($_SESSION['formError']);
        }

        $this->loadTemplate('permissions_items_add', $this->arrayInfo);
    }

    public function items_add_action()
    {
        $p = new Permissions();

        if (!empty($_POST['name']) && !empty($_POST['slug']) && !empty($_POST['type'])) {
            $name = $_POST['name'];
            $slug = $_POST['slug'];
            $type = $_POST['type'];
            $p->addItem($name, $slug, $type);

            header("Location: " . BASE_URL . 'permissions/items');
            exit;
        } else {
            $_SESSION['formError'] = array('name', 'slug', 'type');

            header("Location: " . BASE_URL . 'permissions/items_add');
            exit;
        }
    }

    public function items_edit($id)
    {
        if (!empty($id)) {
            $this->arrayInfo['errorItems'] = array();
            $p = new Permissions();
            $this->arrayInfo['permission_items'] = $p->getAllItems();
            $this->arrayInfo['info'] = $p->getPermissionItems($id);

            if (isset($_SESSION['formError']) && count($_SESSION['formError']) > 0) {
                $this->arrayInfo['errorItems'] = $_SESSION['formError'];
                unset($_SESSION['formError']);
            }

            $this->loadTemplate('permissions_items_edit', $this->arrayInfo);
        } else {
            header("Location: " . BASE_URL . 'permissions/items_edit');
            exit;
        }
    }

    public function items_edit_action()
    {
        $p = new Permissions();

        if (!empty($_POST['id'])) {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $slug = $_POST['slug'];
            $type = $_POST['type'];
            $p->editItem($name, $slug, $type, $id);

            header("Location: " . BASE_URL . 'permissions/items/');
            exit;
        } else {
            $_SESSION['formError'] = array();

            /** @todo Review this redirection */
            header("Location: " . BASE_URL . 'permissions/items/');
            exit;
        }
    }

    public function items_del($id_item)
    {
        $p = new Permissions();
        $p->deleteItem($id_item);
        header("Location: " . BASE_URL . 'permissions/items');
        exit;
    }
    #------------------Fim Controller do CRUD Items de Permissões--------------------------------
}
