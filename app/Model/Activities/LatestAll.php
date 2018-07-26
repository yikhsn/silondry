<?php
namespace Acme\Model\Activities;

use Acme\Model\Activities\LatestIn;

class LatestAll{
  private $activities;

  public function __construct(){
    $this->activities = new LatestIn;
  }

  public function show($limit){
    $latestIn   = $this->activities->in($limit, 'masuk');
    $latestOut  = $this->activities->out($limit, 'keluar');
    
    $array = array_merge($latestIn, $latestOut);

    foreach ($array as $key => $val) {
      $time[$key] = $val['aktivitas'];
    }
  
    array_multisort($time, SORT_DESC, $array);

    // MEMOTONG DATA SEJUMLAH LIMIT DARI SEBELUMNYA 20
    $array = array_slice($array, 0, $limit);
    
    return $array;
  }
}