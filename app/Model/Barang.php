<?php
namespace Acme\Model;

use Acme\Model\CRUD as CRUD;

class Barang
{
  protected $db,
            $totalRecord,
            $currentPage,
            $limit;

  public function __construct()
  {
    $this->db = new CRUD;
    
    $this->setTotalRecord();
  }

  public function getNextCode()
  {
    return "ITM" . sprintf( '%05s', (int) substr( 
      ( $this->getMaxCode() )->maxColumn, 3, 5 ) + 1
    );
  }

  public function getMaxCode()
  {
    return $this->db->getMaxColumn("barang", "kode");
  }

  public function setCurrentPage($page)
  {
    $this->currentPage = $page;
  }

  public function setLimit($limit)
  {
    $this->limit = $limit;
  }

  public function setTotalRecord()
  {
    $this->totalRecord = $this->db->countAll("barang");
  }

  public function getPages()
  {
    return ceil($this->totalRecord / $this->limit);
  }

  public function prevPage()
  {
    return ($this->currentPage > 1) ? $this->currentPage - 1 : 1;
  }

  public function nextPage()
  {
    if ($this->currentPage < $this->getPages() )
      return $this->currentPage + 1;
    else
      return $this->getPages();
  }

  public function isActive($page)
  {
    return ( $page == $this->currentPage ) ? 'disabled' : '';
  }

  public function getData($limit)
  {
    $this->setLimit($limit);

    $start = 0;

    if ($this->currentPage > 1)
      $start = ($this->currentPage * $this->limit) - $this->limit;
    
    return $this->db->getLimit("barang", $start, $this->limit);
  }

  public function add(array $data)
  {
    return $this->db->add("barang", $data);
  }

  public function getById(array $kode)
  {
   return $this->db->getBy("barang", $kode);
  }

  public function update(array $data, array $where)
  {
    return $this->db->update("barang", $data, $where);
  }

  public function delete(array $kode)
  {
   return $this->db->delete("barang", $kode);
  }

  public function take(array $kode)
  {
    $fields = array ("diambil" => 1, 'keluar' => date('Y-m-d H:i:s'));

    return $this->db->update("barang", $fields, $kode);
  }
}