<?php

namespace Controllers;

use Core\Controller;
use Models\Users;
use Models\Products;

class ProductsController extends Controller
{

    private $user;
    private $arrayInfo;

    public function __construct()
    {
        $this->user = new Users();

        if (!$this->user->isLogged()) {
            header("Location: " . BASE_URL . "login");
            exit;
        }
        $this->arrayInfo = array(
            'user' => $this->user,
            'menuActive' => 'products'
        );
    }

    public function index()
    {
        if ($this->user->hasPermission('products_view')) {
            $products = new Products();

            // FILTRO
            $this->arrayInfo['filter'] = array('name' => '');

            if (!empty($_GET['name'])) {
                $this->arrayInfo['filter']['name'] = $_GET['name'];
            }

            //PAGINAÇÃO
            $this->arrayInfo['pag'] = array('currentpage' => 0, 'total' => 0, 'per_page' => 7);
            if (!empty($_GET['p'])) {
                $this->arrayInfo['pag']['currentpage'] = intval($_GET['p']) - 1;
            }

            $this->arrayInfo['list'] = $products->getAllProducts($this->arrayInfo['filter'], $this->arrayInfo['pag']);
            $this->arrayInfo['pag']['total'] = $products->getTotal($this->arrayInfo['filter']);

            $this->loadTemplate('products', $this->arrayInfo);
        } else {
            header("Location: " . BASE_URL);
            exit;
        }
    }

    public function add()
    {
        if ($this->user->hasPermission('products_add')) {
            $products = new Products();

            $this->loadTemplate('products_add', $this->arrayInfo);
        } else {
            header("Location: " . BASE_URL);
            exit;
        }
    }

    public function add_action()
    {
        if ($this->user->hasPermission('products_add')) {
            $products = new Products();
            if (isset($_POST['description']) && !empty($_POST['description'])) {
                $description = $_POST['description'];
                $price = $_POST['price'];
                $status = $_POST['status'];

                $products->addProducts($description, $price, $status);
                header("Location: " . BASE_URL . "products");
                exit;
            }
        } else {
            header("Location: " . BASE_URL);
            exit;
        }
    }

    public function edit($id)
    {
        if ($this->user->hasPermission('products_edit')) {
            $products = new Products();

            if (!empty($id)) {
                $this->arrayInfo['product_data'] = $products->getProducts($id);
                $this->loadTemplate('products_edit', $this->arrayInfo);
            } else {
                header("Location: " . BASE_URL . 'products');
                exit;
            }
        } else {
            header("Location: " . BASE_URL);
            exit;
        }
    }

    public function edit_action()
    {
        if ($this->user->hasPermission('products_edit')) {
            $products = new Products();
            if (!empty($_POST['id'])) {
                if (isset($_POST['description']) && !empty($_POST['description'])) {
                    $description = $_POST['description'];
                    $price = $_POST['price'];
                    $status = $_POST['status'];
                    $id = $_POST['id'];

                    $products->editProducts($description, $price, $status, $id);
                    header("Location: " . BASE_URL . "products");
                    exit;
                }
            } else {
                /** @todo Review this redirection */
                header("Location: " . BASE_URL . 'products/');
                exit;
            }
        } else {
            header("Location: " . BASE_URL);
            exit;
        }
    }

    public function del($id)
    {
        if ($this->user->hasPermission('products_del')) {
            if (!empty($id)) {
                $products = new Products();
                $products->delProducts($id);
            }
            header("Location: " . BASE_URL . "products");
            exit;
        } else {
            header("Location: " . BASE_URL);
            exit;
        }
    }
}
