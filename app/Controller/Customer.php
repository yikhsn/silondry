<?php
namespace Acme\Controller;

use Acme\Engine\Util;
use Acme\Model\Customer as Model;
use Helper\Input;
use Acme\Auth\Session;

class Customer
{
  protected $util, $model;

  /**
   * the constructor method 
   * load and define all the instances of model and engine that needed
   * start session 
   */
  public function __construct()
  {
    if (empty($_SESSION))
      @session_start();

    $this->util = new Util;
    $this->model = new Model;
  }

  /**
   * the index page of the customer page, will show the customer list
   * @return View customer
   */
  public function index()
  {
    if ( !Session::exists('username') )
      header('location: ?p=admin&a=login');

    if ( Input::get('page') )
      $this->model->setCurrentPage( Input::get('page') );
    else
      $this->model->setCurrentPage(1);
    
    $this->util->customer = $this->model->getData(10);
    $this->util->pages = $this->model->getPages();
    $this->util->nextPage = $this->model->nextPage();
    $this->util->prevPage = $this->model->prevPage();

    $this->util->getView('customer');
  }

  /**
   * page for adding a new customer data into database
   * @return View add_customer
   */
  public function add()
  {
    if ( !Session::exists('username') )
      header('location: ?p=admin&a=login');

    if ( Input::get('submit') )
    {      
      $data = array(
        'id_pelanggan'    => Input::get('id_pelanggan'),
        'nama'            => Input::get('nama'),
        'alamat'          => Input::get('alamat'),
        'nomor_telpon'    => Input::get('nomor_telpon'),
        'nomor_identitas' => Input::get('nomor_identitas')
      );

      if ( $this->model->add($data))
        header('location: ?p=customer');
      else
        die("Kesalahan saat memasukkan data, ulangi lagi!");
    }
    $this->util->id_pelanggan = $this->model->getNextId();
    $this->util->getView('add_customer');
  }

  /**
   * page for editing the existing customer form database
   * @return View edit_customer
   */
  public function edit()
  {
    if ( !Session::exists('username') )
      header('location: ?p=admin&a=login');

    $id = array ('id_pelanggan' => Input::get('id_pelanggan'));

    if ( Input::get('edit_submit') )
    {
      $data = array(
        'nama'            => Input::get('nama'),
        'alamat'          => Input::get('alamat'),
        'nomor_telpon'    => Input::get('nomor_telpon'),
        'nomor_identitas' => Input::get('nomor_identitas')
      );
    
      if ($this->model->update($data, $id) )
        header('location: ?p=customer');
      else
        die("Kesalahan saat memasukkan data, ulangi lagi");
    }

    $this->util->customer = $this->model->getById($id);
    $this->util->getView('edit_customer');
  }

  /**
   * page for deleting the existing customer in the database
   * @return null, will redirect user to index page
   */
  public function delete()
  {
    if ( !Session::exists('username') )
      header('location: ?p=admin&a=login');

    $id = array( 'id_pelanggan' => Input::get('id_pelanggan') );

    if ( $this->model->delete($id) )
      header('location: ?p=customer');
    else
      exit('Kesalahan saat menghapus data, periksa dan ulangi lagi');
  }

  /**
   * page to return for the user who accesing not available url
   * @return View not_found
   */
  public function notFound()
  {
    if ( !Session::exists('username') )
      header('location: ?p=admin&a=login');

    $this->util->getView('index');
  }
}