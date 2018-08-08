<?php
namespace Acme\Model\Activities;

use Acme\Model\CRUD;
use Helper\TimeFormatter;

class In implements Activities{
  private $db;

  public function __construct(){
    $this->db = new CRUD;
  }

  public function getData($limit){
    $data = $this->db->getLimitBy("barang", $limit, 'masuk');

    $array = array_map(function($data) {
      return array(
          'waktu'       => TimeFormatter::elapsed($data['masuk']),
          'aktivitas'   => $data['masuk'],
          'kode'        => $data['kode'],
          'diambil'     => $data['diambil'],
          'keterangan'  => 'Masuk'
      );
    }, $data);

    return $array;
  }
}