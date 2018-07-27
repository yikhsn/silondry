<?php
namespace Acme\Model\Activities;

use Acme\Model\CRUD;

class LatestIn
{
  private $db, $type;

  public function __construct(){
    $this->db = new CRUD;
  }

  /**
   * method to show the latest activity of come in item
   * @param int limit, @param string type
   * @return array assoc  
   */
  public function in($limit, $type)
  {
    $data = $this->db->getLimitBy( "barang", $limit, $type);

    return $this->remapData($data, $type);
  }

  /**
   * method to get the latest activity of come out item
   * @param int limit, @param string type
   * @return array assoc
   */
  public function out($limit, $type)
  {
    $cond = array( 'diambil' => 1);

    $data = $this->db->getLimitWhere( "barang", $cond, $limit, $type);

    return $this->remapData($data, $type);
  }

  /**
   * method to remap data of assoc array into format that needed
   * @param array assoc data, @param string type
   * @return array assoc
   */
  private function remapData(array $array, $type)
  {
    $this->type = $type;
    
    /** remap the data and add  a value to the format needed on the view */
    $array = array_map(function($data) {
      return array(
          'aktivitas'   => $data[$this->type],
          'kode'        => $data['kode'],
          'diambil'     => $data['diambil'],
          'keterangan'  => ucfirst($this->type)
      );
    }, $array);

    return $array;
  }
}