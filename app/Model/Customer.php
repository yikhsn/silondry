<?php
namespace Acme\Model;

use Acme\Model\CRUD;
use PDO;

class Customer
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

  public function getNextId()
  {
    return "CTM" . sprintf( '%05s', (int) substr( 
      ( $this->getMaxId() )->maxColumn, 3, 5 ) + 1
    );
  }

  public function getMaxId()
  {
    return $this->db->getMaxColumn("pelanggan", "id_pelanggan");
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
    $this->totalRecord = $this->db->countAll("pelanggan");
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
        
    return $this->db->getLimit("pelanggan", $start, $this->limit);
  }

  public function add(array $data)
  {
    return $this->db->add("pelanggan", $data);
  }

  public function getById(array $kode)
  {
    return $this->db->getBy("pelanggan", $kode);
  }

  public function update(array $data, array $where)
  {
    return $this->db->update("pelanggan", $data, $where);
  }

  public function delete(array $id)
  {
    return $this->db->delete("pelanggan", $id);
  }
}