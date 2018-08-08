<?php
namespace Acme\Model\Activities;

use Acme\Model\CRUD;
use Helper\TimeFormatter;

class Out implements Activities{
  private $db;

  public function __construct(){
    $this->db = new CRUD;
  }

  public function getData($limit){

    $data = $this->db->getLimitWhere( "barang", array( 'diambil' => 1), $limit, 'keluar');

    $array = array_map(function($data) {
      return array(
          'waktu'       => TimeFormatter::elapsed($data['keluar']),
          'aktivitas'   => $data['keluar'],
          'kode'        => $data['kode'],
          'diambil'     => $data['diambil'],
          'keterangan'  => 'Keluar'
      );
    }, $data);

    return $array;
  }
}