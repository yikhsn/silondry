<?php
namespace Acme\Model;

use Acme\Model\CRUD;

class Admin
{
  private $db;

  /**
   * the constructor method would create an instance of the crud model
   */
  public function __construct()
  {
    $this->db = new CRUD;
  }

  /**
   * method to count the next id would be given to the next data 
   * @return string id_pegawai
   */
  public function getNextId()
  {
    return "PGW" . sprintf( '%03s', (int) substr( 
      ( $this->getMaxId() )->maxColumn, 3, 3 ) + 1
    );
  }

  /**
   * method to get the last id by getting the max data id in the database
   * @return string id_pegawai
   */
  public function getMaxId()
  {
    return $this->db->getMaxColumn("pegawai", "id_pegawai");
  }

  /**
   * method to register the new user by pass it to the db model to input it
   * @param array assoc data
   * @return boolean
   */
  public function registerUser( $fields = array() )
  {
    return $this->db->add("pegawai", $fields);
  }

  /**
   * method to verify the input password same with the data
   * @param string password, @param array assoc data
   * @return boolean 
   */
  public function checkPassword($password, array $fields)
  {
    $data = $this->db->getOneBy('pegawai', $fields);

    return ( password_verify($password, $data->password ) ) ? true : false;
  }

  /**
   * method to verify the input username from user is exist in the database
   * @param array assoc data
   * @return boolean
   */
  public function checkName(array $fields)
  {
    $data = (array) ($this->db->getOneBy("pegawai", $fields));

    return ( !empty($data) ) ? true : false;
  }

  /**
   * method to update the existing password of an username
   * @param array assoc data, @param array assoc username
   * @return boolean
   */
  public function updatePassword(array $fields, array $username)
  {
    return $this->db->update("pegawai", $fields, $username);
  }
}