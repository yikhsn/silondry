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

  public function register_user( $fields = array() ){
    return $this->db->add("pegawai", $fields);
  }

  // menguji apakah password yang dimasukkan sesuai dengan data di database
  public function login_user($password, array $fields){

    $data = $this->db->getOneBy('pegawai', $fields);

    if( password_verify($password, $data->password ))
      return true;
    else
      return false;
  }

  // menguji apapah username yang dimasukkan ada di database
  public function cek_nama(array $fields){

    $data = (array) ($this->db->getOneBy("pegawai", $fields));

    if( !empty($data) ) return true;
    else return false;
  }

  public function getUser(array $id)
  {
    $data = $this->db->getOneBy("pegawai", $id);
    var_dump($data);
    die();
  }

  public function change_password(array $fields, array $username)
  {
    $data = $this->db->getOneBy("pegawai", $username);
    
    if ( password_verify( $fields['old_pass'], $data->password ) )
      return true;
    else 
      return false;
  }

  public function update_password(array $fields, array $username)
  {
    return $this->db->update("pegawai", $fields, $username);
  }
}