<?php
namespace Acme\Controller;

use Acme\Engine\Util;
use Acme\Model\Customer as Model;
use Helper\Input;
use Acme\Auth\Session;

class Customer
{
  protected $util, $model;

  public function __construct()
  {
    if (empty($_SESSION))
      @session_start();

    $this->util = new Util;
    $this->model = new Model;
  }

  /********** Front End *************/
  public function index()
  {
    if ( !Session::exists('username') )
      header('location: ?p=admin&a=login');

    if ( Input::get('kode') )
      $this->model->setCurrentPage( Input::get('kode') );
    else
      $this->model->setCurrentPage(1);
    
    $this->util->customer = $this->model->getData(10);
    $this->util->pages = $this->model->getPages();
    $this->util->nextPage = $this->model->nextPage();
    $this->util->prevPage = $this->model->prevPage();

    $this->util->getView('customer');
  }

  public function notFound()
  {
    if ( !Session::exists('username') )
      header('location: ?p=admin&a=login');

    $this->util->getView('not_found');
  } 

  public function add()
  {
    if ( !Session::exists('username') )
      header('location: ?p=admin&a=login');

    if ( Input::get('submit') )
    {      
      $aData = array(
        'id_pelanggan'    => Input::get('id_pelanggan'),
        'nama'            => Input::get('nama'),
        'alamat'          => Input::get('alamat'),
        'nomor_telpon'    => Input::get('nomor_telpon'),
        'nomor_identitas' => Input::get('nomor_identitas')
      );

      if ( $this->model->add($aData))
        header('location: ?p=customer');
      else
        die("Kesalahan saat memasukkan data, periksa dan ulangi lagi!");
    }
    $this->util->id_pelanggan = $this->model->getNextId();
    $this->util->getView('add_customer');
  }

  public function edit()
  {
    if ( !Session::exists('username') )
      header('location: ?p=admin&a=login');

    if ( Input::get('edit_submit') )
    {
      $aData = array(
        'nama'            => Input::get('nama'),
        'alamat'          => Input::get('alamat'),
        'nomor_telpon'    => Input::get('nomor_telpon'),
        'nomor_identitas' => Input::get('nomor_identitas')
      );
    
      if ($this->model->update($aData, array('id_pelanggan' => Input::get('id_pelanggan') ) ) )
        header('location: ?p=customer');
      else
        die("Kesalahan saat memasukkan data, periksa dan ulangi lagi");
    }

    $this->util->customer = $this->model->getById(array (
      'id_pelanggan' => Input::get('id_pelanggan') 
    ));

    $this->util->getView('edit_customer');
  }

  public function delete()
  {
    if ( !Session::exists('username') )
      header('location: ?p=admin&a=login');

    if ( $this->model->delete( array( 
      'id_pelanggan' => $_GET['id_pelanggan'] 
    ) ) )
      return header('location:' . ROOT_URL . '?p=customer');
    else
      exit('Kesalahan saat menghapus data, periksa dan ulangi lagi');
  }
}