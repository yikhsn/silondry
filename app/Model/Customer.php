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
   * method to generate next id_pelanggan would be given to the next data
   * @return string id_pelanggan
   */
  public function getNextId()
  {
    return "CTM" . sprintf( '%05s', (int) substr( 
      ( $this->getMaxId() )->maxColumn, 3, 5 ) + 1
    );
  }

  /**
   * method to get the last id by getting the max id in the table
   * @return array object
   */
  public function getMaxId()
  {
    return $this->db->getMaxColumn("pelanggan", "id_pelanggan");
  }

  /**
   * method to set the current page
   */
  public function setCurrentPage($page)
  {
    $this->currentPage = $page;
  }

  /**
   * method to set the limit data for every single page (request)
   */
  public function setLimit($limit)
  {
    $this->limit = $limit;
  }

  /**
   * method to count and set all the total record in table
   */
  public function setTotalRecord()
  {
    $this->totalRecord = $this->db->countAll("pelanggan");
  }

  /**
   * method to set how much pages by counting record and limit per page
   * @return int total pages
   */
  public function getPages()
  {
    return ceil($this->totalRecord / $this->limit);
  }

  /**
   * method to set the prev page button link on the pagination
   * @return int 
   */
  public function prevPage()
  {
    return ($this->currentPage > 1) ? $this->currentPage - 1 : 1;
  }

  /**
   * method to set the next page button link on the pagination
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
   * method to determine the current page to make it non-clickable
   * @return string
   */
  public function isActive($page)
  {
    return ( $page == $this->currentPage ) ? 'disabled' : '';
  }

  /**
   * method to get data by limit
   * @param int limit
   * @return array
   */
  public function getData($limit)
  {
    $this->setLimit($limit);

    $start = 0;

    if ($this->currentPage > 1)
      $start = ($this->currentPage * $this->limit) - $this->limit;
        
    return $this->db->getLimit("pelanggan", $start, $this->limit);
  }

  /**
   * method to add new customer data into database
   * @param array assoc $data
   * @return boolean
   */
  public function add(array $data)
  {
    return $this->db->add("pelanggan", $data);
  }

  /**
   * method to get one row data by the specific id
   * @param array assoc kode
   * @return array
   */
  public function getById(array $kode)
  {
    return $this->db->getBy("pelanggan", $kode);
  }

  /**
   * method to update the existing data in the database
   * @param array assoc data
   * @param array assoc where column
   * @return array
   */
  public function update(array $data, array $where)
  {
    return $this->db->update("pelanggan", $data, $where);
  }

  /**
   * method to delete the existing data in the database
   * @param array assoc id_pelanggan
   * @return boolean
   */
  public function delete(array $id)
  {
    return $this->db->delete("pelanggan", $id);
  }
}