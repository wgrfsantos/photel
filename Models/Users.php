<?php

namespace Models;

use Core\Model;
use PDO;
use PDOStatement;

class Users extends Model
{

    public const ADMIN = 1;

    private ?string $uid;

    /**
     * @var string[]|null $permissions
     */
    private ?array $permissions;
    private ?string $userName;
    private ?int $isAdmin;

    public function isLogged(): bool
    {
        if (empty($_SESSION['token'])) {
            return false;
        }

        $token = $_SESSION['token'];

        $sql = "SELECT 
                    users.id AS id, 
                    users.name AS name, 
                    users.admin AS 'admin', 
                    GROUP_CONCAT(p_items.slug SEPARATOR ',') AS permissions
                FROM
                    users
                LEFT JOIN
                    (permission_links AS p_links , permission_items AS p_items)
                ON
                    (p_links.id_permission_item = p_items.id AND p_links.id_permission_group = users.id_permission)
                WHERE
                    users.token = :token
                GROUP BY users.id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':token', $token);
        $sql->execute();

        if ($data = $sql->fetch(PDO::FETCH_ASSOC)) {
            $this->uid = $data['id'];
            $this->userName = $data['name'];
            $this->isAdmin = intval($data['admin']);
            $this->permissions = explode(',', $data['permissions']);
            return true;
        }
        return false;
    }

    public function getName(): ?string
    {
        return $this->userName;
    }



    public function isAdmin(): bool
    {
        return ($this->isAdmin === Users::ADMIN);
    }

    public function hasPermission(string $permission_slug): bool
    {
        return in_array($permission_slug, ($this->permissions) ?? array());
    }

    public function validateLogin(string $email, string $password): bool
    {

        $sql = "SELECT id FROM users WHERE email = :email AND password = :password AND users.admin = " . Users::ADMIN;
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':email', $email);
        $sql->bindValue(':password', md5($password));
        $sql->execute();

        if ($data = $sql->fetch(PDO::FETCH_ASSOC)) {
            $token = md5(time() . rand(0, 999) . $data['id'] . time());

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

    public function getId(): ?string
    {
        return $this->uid;
    }

    private function buildGetFilterSql(array $filter): array
    {
        $sqlfilter = array();

        if (!empty($filter['name'])) {
            $sqlfilter[] = '(users.name LIKE :name OR users.email LIKE :email)';
        }

        if (!empty($filter['permission'])) {
            $sqlfilter[] = 'users.id_permission = :permission';
        }

        return $sqlfilter;
    }

    private function buildGetFilterBind(array $filter, PDOStatement &$sql): void
    {
        if (!empty($filter['name'])) {
            $sql->bindValue(':name', '%' . $filter['name'] . '%');
            $sql->bindValue(':email', '%' . $filter['name'] . '%');
        }

        if (!empty($filter['permission'])) {
            $sql->bindValue(':permission', $filter['permission']);
        }
    }

    public function getTotal($filter = array()): int
    {
        $sqlfilter = $this->buildGetFilterSql($filter);

        $sql = "SELECT COUNT(*) as c FROM users";
        if (count($sqlfilter) > 0) {
            $sql .= " WHERE " . implode(' AND ', $sqlfilter);
        }

        $sql = $this->db->prepare($sql);

        $this->buildGetFilterBind($filter, $sql);

        $sql->execute();

        return intval($sql->fetchColumn());
    }

    //Contagem de usuários
    public function getAllUsersCount(): int
    {
        $sql = $this->db->query("SELECT COUNT(*) as c FROM users");
        return intval($sql->fetchColumn());
    }

    //Contagem de usuários ativos
    public function getAllUsersCountActive(): int
    {
        $sql = $this->db->query("SELECT COUNT(*) as c FROM users WHERE users.admin = " . Users::ADMIN);
        return intval($sql->fetchColumn());
    }

     //Puxando dados do usuários para edição
    public function getAllUsers($id)
    {
        $array = array();

        $sql = "SELECT * FROM users WHERE id = :id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':id', $id);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $array = $sql->fetch(\PDO::FETCH_ASSOC);
        }

        return $array;
    }

    public function getAll($filter = array(), $pag = array())
    {
        $array = array();

        $pagfilter = array(
            'offset' => 0,
            'limit' => 2
        );

        if (!empty($pag['per_page'])) {
            $pagfilter['limit'] = $pag['per_page'];
        }

        if (!empty($pag['currentpage'])) {
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

        if (count($sqlfilter) > 0) {
            $sql .= " WHERE " . implode(' AND ', $sqlfilter);
        }

        $sql .= " ORDER BY users.admin DESC, users.name ASC LIMIT " . $pagfilter['offset'] . ',' . $pagfilter['limit'];
        $sql = $this->db->prepare($sql);

        $this->buildGetFilterBind($filter, $sql);

        $sql->execute();

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll(\PDO::FETCH_ASSOC);
        }

        return $array;
    }

    public function addUser($name, $email, $id_permission, $admin, $password)
    {

        $sql = "SELECT id FROM users WHERE email = :email";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":email", $email);
        $sql->execute();

        if ($sql->rowCount() == 0) {
            $sql = "INSERT INTO users SET
                    name = :name,
                    email = :email,
                    id_permission = :id_permission,
                    users.admin = :admin,
                    password = :password";
            $sql = $this->db->prepare($sql);
            $sql->bindValue(":name", $name);
            $sql->bindValue(":email", $email);
            $sql->bindValue(":id_permission", $id_permission);
            $sql->bindValue(":admin", $admin);
            $sql->bindValue(":password", md5($password));
            $sql->execute();

            return true;
        } else {
            return false;
        }
    }

    public function editUser($name, $email, $id_permission, $admin, $id)
    {
        $sql = "UPDATE users SET
                name = :name,
                email = :email,
                id_permission = :id_permission,
                users.admin = :admin
                WHERE id = :id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":name", $name);
        $sql->bindValue(":email", $email);
        $sql->bindValue(":id_permission", $id_permission);
        $sql->bindValue(":admin", $admin);
        $sql->bindValue(':id', $id);
        $sql->execute();
    }

    public function deleteUser($id_user)
    {
        $sql = "DELETE FROM users WHERE id = :id_user";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(':id_user', $id_user);
        $sql->execute();
    }

    public function newPassUser($password, $id)
    {
        $sql = "UPDATE users SET password = :password WHERE id = :id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":password", md5($password));
        $sql->bindValue(':id', $id);
        $sql->execute();
    }
}
