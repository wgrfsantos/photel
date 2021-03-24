<?php
namespace Models;

use \Core\Model;

class Services extends Model {

  private function buildGetFilterSql($filter) {
    $sqlfilter = array();
    
    if(!empty($filter['name'])) {
		$sqlfilter[] = '(services.description LIKE :description)';
	  }
    
    return $sqlfilter;
  }

  private function buildGetFilterBind($filter, &$sql) {
    if(!empty($filter['name'])) {
      $sql->bindValue(':description', '%'.$filter['name'].'%');
    }
  }

  public function getTotal($filter = array()) {
    $array = array();

    $sqlfilter = $this->buildGetFilterSql($filter);

		$sql = "SELECT COUNT(*) as c FROM services";

        if(count($sqlfilter) > 0) {
          $sql .= " WHERE ".implode(' AND ', $sqlfilter);
        }
    
		$sql = $this->db->prepare($sql);

    $this->buildGetFilterBind($filter, $sql);

    $sql->execute();
    $data = $sql->fetch();

    return $data['c'];

  }

  #LISTAGEM
  public function getAllServices($filter = array(), $pag = array()) {
    $array = array();

    $pagfilter = array(
      'offset' => 0,
      'limit' => 7
    );

    if(!empty($pag['per_page'])) {
      $pagfilter['limit'] = $pag['per_page'];
    }

    if(!empty($pag['currentpage'])) {
      $pagfilter['offset'] = $pag['currentpage'] * $pagfilter['limit'];
    }

    $sqlfilter = $this->buildGetFilterSql($filter);

    $sql = "SELECT * FROM services";

      if(count($sqlfilter) > 0) {
        $sql .= " WHERE ".implode(' AND ', $sqlfilter);
      }
        
    $sql .=" ORDER BY description ASC LIMIT ".$pagfilter['offset'].','.$pagfilter['limit'];

    
    $sql = $this->db->prepare($sql);

    $this->buildGetFilterBind($filter, $sql);

    $sql->execute();

    if($sql->rowCount() > 0) {
      $array = $sql->fetchAll(\PDO::FETCH_ASSOC);
    }

    return $array;
  }

  #LISTAGEM SIMPLES
  public function getAll() {
    $array = array();
    $sql = "SELECT * FROM services ORDER BY  description ASC";
    $sql = $this->db->query($sql);

    if($sql->rowCount() > 0) {
        $array = $sql->fetchAll(\PDO::FETCH_ASSOC);
    }
    return $array;
  }

  #CONTAGEM GERAL
  public function getTotalServices() {

      $sql = $this->db->query("SELECT COUNT(*) as c FROM services");
      $row = $sql->fetch();
      return $row['c'];
  }

   #CONTAGEM DE ATIVOS
   public function getTotalServicesAtivos() {

    $sql = $this->db->query("SELECT COUNT(*) as c FROM services WHERE status = 1");
    $row = $sql->fetch();
    return $row['c'];
  }


  #PEGANDO ITEM PARA EDIÇÃO
  public function getServices($id) {
    $array = array();

    $sql = "SELECT * FROM services WHERE id = :id";		
    $sql = $this->db->prepare($sql);
    $sql->bindValue(':id', $id);
    $sql->execute();		

    if($sql->rowCount() > 0) {
      $array = $sql->fetch(\PDO::FETCH_ASSOC);
    }

    return $array;
  }
  
  public function addServices($description, $price, $status) {
    $sql = "INSERT INTO services SET description = :description, price = :price, status = :status";
    $sql = $this->db->prepare($sql);
    $sql->bindValue(':description', $description);
    $sql->bindValue(':price', $price);
    $sql->bindValue(':status', $status);
    $sql->execute();
  }

  public function editServices($description, $price, $status, $id) {
      $sql = "UPDATE services SET description = :description, price = :price, status = :status WHERE id = :id";
      $sql = $this->db->prepare($sql);
      $sql->bindValue(':description', $description);
      $sql->bindValue(':price', $price);
      $sql->bindValue(':status', $status);
      $sql->bindValue(':id', $id);
      $sql->execute();
  }

  public function delServices($id) {
    $sql = "DELETE FROM services WHERE id = :id";
    $sql = $this->db->prepare($sql);
    $sql->bindValue(':id', $id);
    $sql->execute();		

  }

}