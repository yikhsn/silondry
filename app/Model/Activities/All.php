<?php
namespace Acme\Model\Activities;

use Acme\Model\CRUD;

class All implements Activities{
  private $in, $out;

  public function __construct(Activities $in, Activities $out){
    $this->in = $in;
    $this->out = $out;
  }

  public function getData($limit){

    $array = array_merge($this->in->getData(10), $this->out->getData(10));

    foreach ($array as $key => $val) {
      $time[$key] = $val['aktivitas'];
    }
  
    array_multisort($time, SORT_DESC, $array);

    // MEMOTONG DATA SEJUMLAH LIMIT DARI SEBELUMNYA 20
    $array = array_slice($array, 0, $limit);
    
    return $array;
  }
}