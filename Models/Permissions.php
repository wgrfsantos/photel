<?php
namespace Models;

use \Core\Model;

class Permissions extends Model {

	//Contagem geral de Grupos de Permissões
	public function getTotalGroup() {

        $sql = $this->db->query("SELECT COUNT(*) as c FROM permission_groups");
        $row = $sql->fetch();
        return $row['c'];
	}
	
	//Contagem geral de items
	public function getTotalItems() {

        $sql = $this->db->query("SELECT COUNT(*) as c FROM permission_items");
        $row = $sql->fetch();
        return $row['c'];
    }

	
	public function getPermissionGroupName($id_permission) {
		$sql = "SELECT name FROM permission_groups WHERE id = :id";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(':id', $id_permission);
		$sql->execute();

		if($sql->rowCount() > 0) {
			$data = $sql->fetch();

			return $data['name'];
		} else {
			return '';
		}
	}

	public function getPermissions($id_permission) {
		$array = array();

		$sql = "SELECT id_permission_item FROM permission_links WHERE id_permission_group = :id_permission";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(':id_permission', $id_permission);
		$sql->execute();

		if($sql->rowCount() > 0) {
			$data = $sql->fetchAll();
			$ids = array();

			foreach($data as $data_item) {
				$ids[] = $data_item['id_permission_item'];
			}

			$sql = "SELECT slug FROM permission_items WHERE id IN (".implode(',', $ids).")";
			$sql = $this->db->query($sql);

			if($sql->rowCount() > 0) {
				$data = $sql->fetchAll();

				foreach($data as $data_item) {
					$array[] = $data_item['slug'];
				}

			}
		}

		return $array;
	}

	public function getAllGroups() {
		$array = array();

		$sql = "SELECT
					permission_groups.*,
					(
						select
							count(users.id)
						from users where users.id_permission = permission_groups.id
					) as total_users,
					(
						select
							count(permission_links.id)
						from permission_links where permission_links.id_permission_group = permission_groups.id
					) as total_permissions
					FROM permission_groups";
		$sql = $this->db->query($sql);

		if($sql->rowCount() > 0) {
			$array = $sql->fetchAll(\PDO::FETCH_ASSOC);
		}

		return $array;
	}

	public function editName($new_name, $id) {
		$sql = "UPDATE permission_groups SET name = :name WHERE id = :id";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(':name', $new_name);
		$sql->bindValue(':id', $id);
		$sql->execute();
	}

	public function clearLinks($id) {
		$sql = "DELETE FROM permission_links WHERE id_permission_group = :id";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(':id', $id);
		$sql->execute();
	}

	public function deleteGroup($id_group) {

		$sql = "SELECT id FROM users WHERE id_permission = :id_group";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(':id_group', $id_group);
		$sql->execute();

		if($sql->rowCount() === 0) {

			$sql = "DELETE FROM permission_links WHERE id_permission_group = :id_group";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(':id_group', $id_group);
			$sql->execute();

			$sql = "DELETE FROM permission_groups WHERE id = :id_group";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(':id_group', $id_group);
			$sql->execute();

		}

	}

	public function addGroup($name) {
		$sql = "INSERT INTO permission_groups (name) VALUES (:name)";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(':name', $name);
		$sql->execute();

		return $this->db->lastInsertId();
	}

	public function linkItemToGroup($id_item, $id_group) {
		$sql = "INSERT INTO permission_links (id_permission_group, id_permission_item) VALUES (:id_group, :id_item)";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(':id_item', $id_item);
		$sql->bindValue(':id_group', $id_group);
		$sql->execute();
	}

	#--------------------Ínicio Models do CRUD Items de Permissões----------------------

	 public function getPermissionItems($id) {
		$array = array();

		$sql = "SELECT * FROM permission_items WHERE id = :id";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(':id', $id);
		$sql->execute();

		if($sql->rowCount() > 0) {
			$array = $sql->fetch(\PDO::FETCH_ASSOC);
		}

		return $array;
	}

	public function getAllItems() {
		$array = array();

		$sql = "SELECT
					permission_items.*,
					(
						select
							count(permission_links.id)
						from permission_links where permission_links.id_permission_item = permission_items.id
					) as total_links
		 			FROM permission_items";
		$sql = $this->db->query($sql);

		if($sql->rowCount() > 0) {
			$array = $sql->fetchAll(\PDO::FETCH_ASSOC);
		}

		return $array;
	}

	public function getAllItemsView() {
		$array = array();

		$sql = "SELECT * FROM permission_items WHERE type = 1";
		$sql = $this->db->query($sql);

		if($sql->rowCount() > 0) {
			$array = $sql->fetchAll(\PDO::FETCH_ASSOC);
		}

		return $array;
	}

	public function getAllItemsAdd() {
		$array = array();

		$sql = "SELECT * FROM permission_items WHERE type = 2";
		$sql = $this->db->query($sql);

		if($sql->rowCount() > 0) {
			$array = $sql->fetchAll(\PDO::FETCH_ASSOC);
		}

		return $array;
	}

	public function getAllItemsEdit() {
		$array = array();

		$sql = "SELECT * FROM permission_items WHERE type = 3";
		$sql = $this->db->query($sql);

		if($sql->rowCount() > 0) {
			$array = $sql->fetchAll(\PDO::FETCH_ASSOC);
		}

		return $array;
	}

	public function getAllItemsDel() {
		$array = array();

		$sql = "SELECT * FROM permission_items WHERE type = 4";
		$sql = $this->db->query($sql);

		if($sql->rowCount() > 0) {
			$array = $sql->fetchAll(\PDO::FETCH_ASSOC);
		}

		return $array;
	}

	public function addItem($name, $slug, $type) {
		$sql = "INSERT INTO permission_items (name, slug, type) VALUES (:name, :slug, :type)";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(':name', $name);
		$sql->bindValue(':slug', $slug);
		$sql->bindValue(':type', $type);
		$sql->execute();
	}

	public function editItem($name, $slug, $type, $id) {
		$sql = "UPDATE permission_items SET name = :name, slug = :slug, type = :type WHERE id = :id";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(':name', $name);
		$sql->bindValue(':slug', $slug);
		$sql->bindValue(':type', $type);
		$sql->bindValue(':id', $id);
		$sql->execute();
	}

	public function deleteItem($id_item) {
		$sql = "SELECT id FROM permission_links WHERE id_permission_item = :id_item";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(':id_item', $id_item);
		$sql->execute();

		if($sql->rowCount() === 0) {

			$sql = "DELETE FROM permission_items WHERE id = :id_item";
			$sql = $this->db->prepare($sql);
			$sql->bindValue(':id_item', $id_item);
			$sql->execute();

		}

	}
	#--------------------Fim Models do CRUD Items de Permissões----------------------

}