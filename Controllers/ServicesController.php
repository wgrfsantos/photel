<?php
namespace Controllers;

use \Core\Controller;
use \Models\Users;
use \Models\Services;

class ServicesController extends Controller {

	private $user;
	private $arrayInfo;

	public function __construct() {
		$this->user = new Users();

		if(!$this->user->isLogged()) {
			header("Location: ".BASE_URL."login");
			exit;
		}
		$this->arrayInfo = array(
			'user' => $this->user,
			'menuActive' => 'services'
		);

	}

	public function index() {
		if($this->user->hasPermission('services_view')) {
			$services = new Services();

			// FILTRO
			$this->arrayInfo['filter'] = array('name'=>'');

			if(!empty($_GET['name'])) {
				$this->arrayInfo['filter']['name'] = $_GET['name'];
			}

			//PAGINAÇÃO
			$this->arrayInfo['pag'] = array('currentpage'=>0, 'total'=>0, 'per_page'=>7);
			if(!empty($_GET['p'])) {
				$this->arrayInfo['pag']['currentpage'] = intval($_GET['p']) - 1;
			}
			
			$this->arrayInfo['list'] = $services->getAllServices($this->arrayInfo['filter'], $this->arrayInfo['pag']);
			$this->arrayInfo['pag']['total'] = $services->getTotal($this->arrayInfo['filter']);
           
			$this->loadTemplate('services', $this->arrayInfo);
		} else {
			header("Location: ".BASE_URL);
			exit;
		}
	}

	public function add() {
		if($this->user->hasPermission('services_add')) {
            $services = new Services();
            
			$this->loadTemplate('services_add', $this->arrayInfo);

		} else {
			header("Location: ".BASE_URL);
			exit;
		}
	}

	public function add_action() {
		if($this->user->hasPermission('services_add')) {
			$services = new Services();
			if(isset($_POST['description']) && !empty($_POST['description'])) {

				$description = $_POST['description'];
                $price = $_POST['price'];
                $status = $_POST['status'];
				
				$services->addServices($description, $price, $status);
				header("Location: ".BASE_URL."services");
				exit;
			}			
		} else {
			header("Location: ".BASE_URL);
			exit;
		}
	}

	public function edit($id) {
		if($this->user->hasPermission('services_edit')) {
            $services = new Services();

			if(!empty($id)) {

				$this->arrayInfo['product_data'] = $services->getServices($id);
				$this->loadTemplate('services_edit', $this->arrayInfo);

			} else {
				header("Location: ".BASE_URL.'services');
				exit;
			}
		} else {
			header("Location: ".BASE_URL);
			exit;
		}
	}

	public function edit_action() {
		if($this->user->hasPermission('services_edit')) {
			$services = new Services();
			if(!empty($_POST['id'])) {
				if(isset($_POST['description']) && !empty($_POST['description'])) {

					$description = $_POST['description'];
                    $price = $_POST['price'];
                    $status = $_POST['status'];
					$id = $_POST['id'];
					
					$services->editServices($description, $price, $status, $id);
					header("Location: ".BASE_URL."services");
					exit;
				}				
			} else {
			header("Location: ".BASE_URL.'services_edit/'.$id);
			exit;
		}
		} else {
			header("Location: ".BASE_URL);
			exit;
		}
	}

	public function del($id) {
		if($this->user->hasPermission('services_del')) {		
			if(!empty($id)) {
				$services = new Services();
				$services->delServices($id);				
			}
			header("Location: ".BASE_URL."services");
			exit;
		} else {
			header("Location: ".BASE_URL);
			exit;
		}	
	}
}