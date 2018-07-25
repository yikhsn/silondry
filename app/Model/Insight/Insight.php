<?php

namespace Acme\Model\Insight;

use Acme\Engine\Database;

class Insight
{
  private $_db;

  public function __construct(){
    $this->_db = new Database;
  }
    
  // METODE UNTUK MENGITUNG TARGET DAN CAPAIAN DALAM SATU HARI
  public function counter($date)
  {
    $stmt = $this->_db->query("SELECT * FROM barang 
                      WHERE masuk BETWEEN '$date 00:00:00' 
                      AND '$date 23:59:59'");
    
    $stmt->execute();
    $today = $stmt->rowCount();
    
    $target = 250;
    $reach = ($today * 100) / $target;
    $minus = 100 - $reach;

    return compact("reach", "minus", "target", "today", "date");
  }

  public function daily()
  {
    return $this->counter( date("Y-m-d") );
  }

  public function weekly()
  {
    $fields = array();
    for($i=-7; $i <= -1; $i++)
    {
      $date = date("Y-m-d", strtotime($i . 'days'));
      $fields[] = $this->counter( $date ); 
    }
    return $fields;
  }
}

