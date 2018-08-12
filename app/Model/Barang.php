<?php
namespace Acme\Model;

use Acme\Model\CRUD as CRUD;

class Barang
{
  protected $db,
            $totalRecord,
            $currentPage,
            $limit;

  /**
   * the constructor method to create an instance of the 
   * crud model and count total row record in the table 
   */
  public function __construct()
  {
    $this->db = new CRUD;
    $this->setTotalRecord();
  }

  /**
   * method to count the next id would be given to the next data
   * @return string kode
   */
  public function getNextCode()
  {
    return "ITM" . sprintf( '%05s', (int) substr( 
      ( $this->getMaxCode() )->maxColumn, 3, 5 ) + 1
    );
  }

  /**
   * method to get the last id in the data by getting max id the database
   * @return string kode
   */
  public function getMaxCode()
  {
    return $this->db->getMaxColumn("barang", "kode");
  }

  /**
   * method to set the current page where the user are, get it by the url 
   */
  public function setCurrentPage($page)
  {
    $this->currentPage = $page;
  }

  /**
   * method to set limit of data would be given for the request
   */
  public function setLimit($limit)
  {
    $this->limit = $limit;
  }

  /**
   * method to count and set all the total record in the table
   */
  public function setTotalRecord()
  {
    $this->totalRecord = $this->db->countAll("barang");
  }

  /** 
   * method to count how much pages by count record and limit per page
   * @return int total pages
   */
  public function getPages()
  {
    return ceil($this->totalRecord / $this->limit);
  }

  /**
   * method to count the prev page would be given in the pagination 
   * @return int
   */
  public function prevPage()
  {
    return ($this->currentPage > 1) ? $this->currentPage - 1 : 1;
  }

  /**
   * method to count the next page would be given in the pagination 
   * @return int
   */
  public function nextPage()
  {
    if ($this->currentPage < $this->getPages() )
      return $this->currentPage + 1;
    else
      return $this->getPages();
  }

  /**
   * method to determine current page to make it non-clickable 
   * @return string
   */
  public function isActive($page)
  {
    return ( $page == $this->currentPage ) ? 'disabled' : '';
  }

  /**
   * method to get data with limit
   * @param int limit
   * @return array obj
   */
  public function getData($limit)
  {
    $this->setLimit($limit);

    $start = 0;

    if ($this->currentPage > 1)
      $start = ($this->currentPage * $this->limit) - $this->limit;
    
    return $this->db->getLimit("barang", $start, $this->limit, 'kode');
  }

  /**
   * method to count how much was not taken yet
   * @return int item not taken
   */
  public function notTaken()
  {
    return $this->db->countBy( "barang", array( 'diambil' => 0 ) );
  }

  /**
   * method to add new item into the database item
   * @param array assoc data
   * @return boolean
   */
  public function add(array $data)
  {
    return $this->db->add("barang", $data);
  }

  /**
   * method to get the data by the specific code/id
   * @param array assoc kode
   * @return array obj
   */
  public function getById(array $kode)
  {
   return $this->db->getBy("barang", $kode);
  }

  /**
   * method to update/change the existing data
   * @param array assoc data
   * @param array assoc column
   * @return array obj
   */
  public function update(array $data, array $where)
  {
    return $this->db->update("barang", $data, $where);
  }

  /**
   * method to delete data from the existing data in the database
   * @param array assoc kode
   * @return boolean
   */
  public function delete(array $kode)
  {
   return $this->db->delete("barang", $kode);
  }

  /**
   * method to change status item to taken
   * @param array assoc kode
   * @return boolean
   */
  public function take(array $kode)
  {
    $fields = array ("diambil" => 1, 'keluar' => date('Y-m-d H:i:s'));

    return $this->db->update("barang", $fields, $kode);
  }
}