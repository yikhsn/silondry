<?php
namespace Acme\Model\Activities;

use Acme\Model\CRUD;

class In implements Activities{
  private $db;

  public function __construct(){
    $this->db = new CRUD;
  }

  public function getData($limit){
    $data = $this->db->getLimitBy("barang", $limit, 'masuk');

    $array = array_map(function($data) {
      return array(
          'aktivitas'   => $data['masuk'],
          'kode'        => $data['kode'],
          'diambil'     => $data['diambil'],
          'keterangan'  => 'Masuk'
      );
    }, $data);

    return $array;
  }
}