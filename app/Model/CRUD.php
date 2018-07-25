<?php
namespace Acme\Model;

use Acme\Engine\Database;
use PDO;

class CRUD
{
  protected $db;

  public function __construct()
  {
    $this->db = new Database;
  }

  public function countAll($table)
  {
    $stmt = $this->db->prepare("SELECT * FROM $table");
    $stmt->execute();

    return $stmt->rowCount();
  }

  public function getAll($table)
  {
    $stmt = $this->db->prepare("SELECT * FROM $table");
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }

  public function getMaxColumn($table, $column)
  {
    $stmt = $this->db->prepare("SELECT max($column) as maxColumn FROM $table");
    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_OBJ);
  }

  public function getLimit($table, $offset, $limit)
  {
    $stmt = $this->db->prepare("SELECT * FROM $table LIMIT :offset, :limit");
    $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
    $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }

  public function getLimitWhere($table, $limit, $order)
  {
    $sql = "SELECT * FROM $table ORDER BY $order DESC LIMIT $limit";
    
    $stmt = $this->db->query($sql);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function getBy($table, array $where)
  {
    $sql = sprintf(
      "SELECT * FROM %s WHERE %s=%s",
      $table,
      implode( ", ", array_keys($where) ),
      ':' . implode( ", :", array_keys($where) )
    );

    $stmt = $this->db->prepare($sql);
    
    $stmt->execute($where);
    
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }

  public function getOneBy($table, array $where)
  {
    $sql = sprintf(
      "SELECT * FROM %s WHERE %s=%s;",
      $table,
      implode( ", ", array_keys($where) ),
      ':' . implode( ", :", array_keys($where) )
    );

    $stmt = $this->db->prepare($sql);
    
    $stmt->execute($where);
    
    return $stmt->fetch(PDO::FETCH_OBJ);
  }

  public function update($table, array $fields, array $where)
  {
    foreach ( $fields as $key=>$values ){
      $data[] = "$key = " . ":" . "$key";
    }

    $sql = sprintf(
      'UPDATE %s SET %s WHERE %s = %s',
      $table,
      implode(", ", $data),
      implode( ", ", array_keys($where) ),
      ':' . implode( ", :", array_keys($where) )
    );

    $stmt = $this->db->prepare($sql);
    
    return $stmt->execute(array_merge($fields, $where));
  }

  public function add($table, array $fields)
  {
    $sql = sprintf(
      "INSERT INTO %s (%s) VALUES (%s)",
      $table,
      implode( ", ", array_keys($fields) ),
      ':' . implode( ", :", array_keys($fields) )
    );

    $stmt = $this->db->prepare($sql);
    
    return $stmt->execute($fields);
  }

  public function delete($table, array $fields)
  {
    $sql = sprintf(
      "DELETE FROM %s WHERE %s = %s",
      $table,
      implode( ", ", array_keys($fields) ),
      ':' . implode( ", :", array_keys($fields) )
    );

    $stmt = $this->db->prepare($sql);
    
    return $stmt->execute($fields);
  }
}
?>