<?php
namespace Acme\Model\Activities;

use Acme\Model\CRUD;
use Helper\TimeFormatter;

class LatestIn
{
  private $db, $type;

  public function __construct(){
    $this->db = new CRUD;
  }

  public function show($limit, $type)
  {
    $data = $this->db->getLimitWhere( "barang", $limit, $type);

    return $this->remapData($data, $type);
  }

  private function remapData(array $array, $type)
  {
    $this->type = $type;
    
    /** remap the data and add  a value to the format needed on the view */
    $array = array_map(function($data) {
      return array(
          'aktivitas'   => $data['masuk'],
          'kode'        => $data['kode'],
          'diambil'     => $data['diambil'],
          'keterangan'  => ucfirst($this->type)
      );
    }, $array);

    return $array;
  }
}