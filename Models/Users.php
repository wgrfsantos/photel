<?php
namespace Models;

use \Core\Model;
use \Models\Permissions;

class Users extends Model {

	private $uid;
	private $permissions;
	private $userName;
	private $isAdmin;	

	public function isLogged() {

		if(!empty($_SESSION['token'])) {
			$token = $_SESSION['token'];

			$sql = "SELECT * FROM users WHERE token = :token";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(':token', $token);
			$sql->execute();

			if($sql->rowCount() > 0) {
				$p = new Permissions();

				$data = $sql->fetch();
				$this->uid = $data['id'];
				$this->userName = $data['name'];
				$this->isAdmin = $data['admin'];
				$this->permissions = $p->getPermissions($data['id_permission']);

				return true;
			}

		}

		return false;
	}

	public function getName() {
		return $this->userName;
	}

	

	public function isAdmin() {
		if($this->isAdmin == '1') {
			return true;
		} else {
			return false;
		}
	}

	public function hasPermission($permission_slug) {

		if(in_array($permission_slug, $this->permissions)) {
			return true;
		} else {
			return false;
		}

	}	

	public function validateLogin($email, $password) {

		$sql = "SELECT id FROM users WHERE email = :email AND password = :password AND admin = 1";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(':email', $email);
		$sql->bindValue(':password', md5($password));
		$sql->execute();

		if($sql->rowCount() > 0) {
			$data = $sql->fetch();

			$token = md5(time().rand(0,999).$data['id'].time());

			$sql = "UPDATE users SET token = :token WHERE id = :id";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(':token', $token);
			$sql->bindValue(':id', $data['id']);
			$sql->execute();

			$_SESSION['token'] = $token;

			return true;
		}

		return false;
	}

	public function getId() {
		return $this->uid;
	}

	private function buildGetFilterSql($filter) {
		$sqlfilter = array();

		if(!empty($filter['name'])) {
			$sqlfilter[] = '(users.name LIKE :name OR users.email LIKE :email)';
		}

		if(!empty($filter['permission'])) {
			$sqlfilter[] = 'users.id_permission = :permission';
		}

		return $sqlfilter;
	}

	private function buildGetFilterBind($filter, &$sql) {
		if(!empty($filter['name'])) {
			$sql->bindValue(':name', '%'.$filter['name'].'%');
			$sql->bindValue(':email', '%'.$filter['name'].'%');
		}

		if(!empty($filter['permission'])) {
			$sql->bindValue(':permission', $filter['permission']);
		}
	}

	public function getTotal($filter = array()) {
		$array = array();

		$sqlfilter = $this->buildGetFilterSql($filter);		

		$sql = "SELECT COUNT(*) as c FROM users";
		if(count($sqlfilter) > 0) {
			$sql .= " WHERE ".implode(' AND ', $sqlfilter);
		}

		$sql = $this->db->prepare($sql);

		$this->buildGetFilterBind($filter, $sql);

		$sql->execute();
		$data = $sql->fetch();

		return $data['c'];
	}

	//Contagem de usuários
	public function getAllUsersCount() {

        $sql = $this->db->query("SELECT COUNT(*) as c FROM users");
        $row = $sql->fetch();
        return $row['c'];
    }

	//Contagem de usuários ativos
	public function getAllUsersCountActive() {

		$sql = $this->db->query("SELECT COUNT(*) as c FROM users WHERE admin = 1");
		$row = $sql->fetch();
		return $row['c'];
    }

     //Puxando dados do usuários para edição
	 public function getAllUsers($id) {
		$array = array();

		$sql = "SELECT * FROM users WHERE id = :id";		
		$sql = $this->db->prepare($sql);
		$sql->bindValue(':id', $id);
		$sql->execute();		

		if($sql->rowCount() > 0) {
			$array = $sql->fetch(\PDO::FETCH_ASSOC);
		}

		return $array;
	}

	public function getAll($filter = array(), $pag = array()) {
		$array = array();

		$pagfilter = array(
			'offset' => 0,
			'limit' => 2
		);

		if(!empty($pag['per_page'])) {
			$pagfilter['limit'] = $pag['per_page'];
		}

		if(!empty($pag['currentpage'])) {
			$pagfilter['offset'] = $pag['currentpage'] * $pagfilter['limit'];
		}

		$sqlfilter = $this->buildGetFilterSql($filter);

		$sql = "SELECT
					users.id,
					users.name,
					users.email,
					users.admin,
					permission_groups.name as permission_name
				FROM users
				LEFT JOIN permission_groups
				ON permission_groups.id = users.id_permission";

		if(count($sqlfilter) > 0) {
			$sql .= " WHERE ".implode(' AND ', $sqlfilter);
		}

		$sql .= " ORDER BY users.admin DESC, users.name ASC LIMIT ".$pagfilter['offset'].','.$pagfilter['limit'];
		$sql = $this->db->prepare($sql);

		$this->buildGetFilterBind($filter, $sql);

		$sql->execute();

		if($sql->rowCount() > 0) {
			$array = $sql->fetchAll(\PDO::FETCH_ASSOC);
		}

		return $array;
	}

	 public function addUser($name, $email, $id_permission, $admin, $password) {

        $sql = "SELECT id FROM users WHERE email = :email";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":email",$email);
        $sql->execute();

        if($sql->rowCount() == 0) {
            $sql = "INSERT INTO users SET name = :name, email = :email, id_permission = :id_permission, admin = :admin, password = :password";
            $sql = $this->db->prepare($sql);
            $sql->bindValue(":name", $name);
            $sql->bindValue(":email", $email);
            $sql->bindValue(":id_permission", $id_permission);
            $sql->bindValue(":admin", $admin);
            $sql->bindValue(":password",md5($password));
            $sql->execute();

         return true;
        } else {
            return false;
        }

    }

     public function editUser($name, $email, $id_permission, $admin, $id) {
        $sql = "UPDATE users SET name = :name, email = :email, id_permission = :id_permission, admin = :admin WHERE id = :id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":name", $name);
        $sql->bindValue(":email", $email);
        $sql->bindValue(":id_permission", $id_permission);
        $sql->bindValue(":admin", $admin);
        $sql->bindValue(':id', $id);
        $sql->execute();

	}
	
	public function deleteUser($id_user) {
		$sql = "DELETE FROM users WHERE id = :id_user";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(':id_user', $id_user);
		$sql->execute();		

	}

	public function newPassUser($password, $id) {
		 $sql = "UPDATE users SET password = :password WHERE id = :id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":password", md5($password));
        $sql->bindValue(':id', $id);
        $sql->execute();
	}

}