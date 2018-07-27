<?php
namespace Acme\Controller;

use Acme\Engine\Util;
use Acme\Model\Barang as Model;
use Acme\Model\Insight\Insight;
use Acme\Auth\Session;
use Helper\Input;

class Barang
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
    $this->insight = new Insight;
  }

  /**
   * the index page of the item page, show list of the item
   * @return View barang
   */
  public function index()
  {
    if ( !Session::exists('username') )
      header('location: ?p=admin&a=login');

    if ( Input::get('page') )
      $this->model->setCurrentPage( Input::get('page') );
    else
      $this->model->setCurrentPage(1);
   
    $this->util->barang = $this->model->getData(10);
    $this->util->pages = $this->model->getPages();
    $this->util->nextPage = $this->model->nextPage();
    $this->util->prevPage = $this->model->prevPage();
    $this->util->todayInsight = $this->insight->daily();

    $this->util->getView('barang');
  }

  /**
   * page to add new item into database
   * @return View add_barang
   */
  public function add()
  {
    if ( !Session::exists('username') )
      header('location: ?p=admin&a=login');

    if ( Input::get('submit') )
    {
      $this->util->barang = $this->model->getData(10);

      $data = array(
        'kode'    => Input::get('kode'),
        'jumlah'  => Input::get('jumlah'),
        'berat'   => Input::get('berat'),
        'harga'   => Input::get('harga'),
        'masuk'   => date('Y-m-d H:i:s')
      );

      if ( $this->model->add($data) )
        header( "location: ?p=barang" );
      else
        die( "Whoooops! An error has occured! Please try again." );
    }
    $this->util->code = $this->model->getNextCode();
    $this->util->getView( 'add_item' );
  }

  /**
   * page for edit/change the existing data
   * @return View edit_barang
   */
  public function edit()
  {
    if ( !Session::exists('username') )
      header('location: ?p=admin&a=login');

    if ( Input::get('edit_submit') )
    {
      $data = array(
        'jumlah' => Input::get('jumlah'),
        'berat' => Input::get('berat'),
        'harga' => Input::get('harga')
      );

      if ($this->model->update($data, array( "kode" => Input::get("kode") ) ) )
        header("location: ?p=barang");
      else
        die("WHoops! An error has occures! Please try again later");
    }

    $this->util->data = $this->model->getById(array ( 'kode' => $_GET['kode'] ) );
    $this->util->getView('edit_item');
  }

  /**
   * page for change status of the item from not taken into taken
   * @return null, will redirect it into index page of item page
   */
  public function take()
  {
    if ( !Session::exists('username') )
      header('location: ?p=admin&a=login');

    if ( $this->model->take( array( 'kode' => Input::get('kode') ) ) )
      return header('location:' . ROOT_URL . '?p=barang');
    else
      exit('Kesalahan saat memasukkan data');
  }

  /**
   * page for deleting the existing item on database
   * @return null, will redirect it into the index page of item page
   */
  public function delete()
  {
    if ( !Session::exists('username') )
      header('location: ?p=admin&a=login');

    if ( $this->model->delete( array( 'kode' => Input::get('kode') ) ) )
      return header('location:' . ROOT_URL . '?p=barang');
    else
      exit('Kesalahan saat menghapus data');
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