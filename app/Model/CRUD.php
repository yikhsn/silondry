<?php
namespace Acme\Model;

use Acme\Engine\Database;
use PDO;

class CRUD
{
  protected $db;

  /**
   * constructor method to create instance from the database class
   */
  public function __construct()
  {
    $this->db = new Database;
  }

  /**
   * method to count total row in the table
   * @param string table
   * @return int total row
   */
  public function countAll($table)
  {
    $stmt = $this->db->prepare("SELECT * FROM $table");
    $stmt->execute();

    return $stmt->rowCount();
  }

  /**
   * method to count data with the specific condititon
   * @param string table
   * @param array assoc condition
   * @return int total row
   */
  public function countBy($table, array $where)
  {
    $sql = sprintf(
      "SELECT * FROM %s WHERE %s=%s",
      $table,
      implode( ", ", array_keys($where) ),
      ':' . implode( ", :", array_keys($where) )
    );

    $stmt = $this->db->prepare($sql);
    $stmt->execute($where);
    
    return $stmt->rowCount();
  }

  /**
   * method to get all the data form the table
   * @param string table
   * @return object data
   */
  public function getAll($table)
  {
    $stmt = $this->db->prepare("SELECT * FROM $table");
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }

  /**
   * method to get the data with the specific condition
   * @param string table
   * @param array condition
   * @return object data
   */
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

  /**
   * method to get the only one data with the specific condition
   * @param string table
   * @param array condition
   * @return object one data
   */
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

  /**
   * method to get the maximal value on the specific column
   * @param string table
   * @param string column
   * @return object data
   */
  public function getMaxColumn($table, $column)
  {
    $stmt = $this->db->prepare("SELECT max($column) as maxColumn FROM $table");
    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_OBJ);
  }

  /**
   * method to get data by limit and offset value is set
   * @param string table
   * @param int offset
   * @param int limit
   * @return object data
   */
  public function getLimit($table, $offset, $limit, $order)
  {
    $stmt = $this->db->prepare("SELECT * FROM $table 
                                ORDER BY $order DESC 
                                LIMIT :offset, :limit"
                              );

    $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
    $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }

  /**
   * method to get data with limit and order it base on specific column
   * @param string table
   * @param int limit
   * @param string colum to order
   * @return object data
   */
  public function getLimitBy($table, $limit, $order)
  {
    $stmt = $this->db->query("SELECT * FROM $table 
                              ORDER BY $order DESC 
                              LIMIT $limit"
                            );
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
  
  /**
   * method to get data with limit in and order by specific column
   * @param string table
   * @param array condition
   * @param int limit
   * @param string order
   * @return object data   
   */
  public function getLimitWhere($table, array $where, $limit, $order)
  {
    $sql = sprintf(
      "SELECT * FROM %s WHERE %s = %s ORDER BY %s DESC LIMIT %s",
      $table,
      implode( ", ", array_keys($where) ),
      ':' . implode( ", :", array_keys($where) ),
      $order,
      $limit
    );
    
    $stmt = $this->db->prepare($sql);
    $stmt->execute($where);

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  /**
   * method to update/change the existing data in the database
   * @param string table
   * @param array assoc data
   * @param array assoc where
   * @return boolean
   */
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

  /**
   * method to add new data into the table
   * @param string table
   * @param array assoc data
   * @return boolean
   */
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

  /**
   * method to delele data in table
   * @param string table
   * @param array assoc data
   * @return boolean
   */
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