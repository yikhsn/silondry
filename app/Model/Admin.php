<?php
namespace Acme\Model;

use Acme\Model\CRUD;

class Admin
{
  private $db;

  public function __construct()
  {
    $this->db = new CRUD;
  }

  public function getNextId()
  {
    return "PGW" . sprintf( '%03s', (int) substr( 
      ( $this->getMaxId() )->maxColumn, 3, 3 ) + 1
    );
  }

  public function getMaxId()
  {
    return $this->db->getMaxColumn("pegawai", "id_pegawai");
  }

  public function registerUser( $fields = array() )
  {
    return $this->db->add("pegawai", $fields);
  }

  // menguji apakah password yang dimasukkan sesuai dengan data di database
  public function checkPassword($password, array $fields)
  {
    $data = $this->db->getOneBy('pegawai', $fields);

    return ( password_verify($password, $data->password ) ) ? true : false;
  }

  // menguji apapah username yang dimasukkan ada di database
  public function checkName(array $fields)
  {
    $data = (array) ($this->db->getOneBy("pegawai", $fields));

    return ( !empty($data) ) ? true : false;
  }

  public function updatePassword(array $fields, array $username)
  {
    return $this->db->update("pegawai", $fields, $username);
  }
}