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

  public function __construct()
  {
    if (empty($_SESSION))
      @session_start();
    
    $this->util = new Util;
    $this->model = new Model;
    $this->insight = new Insight;
  }

  /********** Front End *************/
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
    // $this->util->isActive = $this->model->isActive($page);

    $this->util->todayInsight = $this->insight->daily();
    $this->util->getView('barang');
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
      $this->util->barang = $this->model->getData(10);

      $aData = array(
        'kode'    => Input::get('kode'),
        'jumlah'  => Input::get('jumlah'),
        'berat'   => Input::get('berat'),
        'harga'   => Input::get('harga'),
        'masuk'   => date('Y-m-d H:i:s')
      );

      if ( $this->model->add($aData) )
        header( "location: ?p=barang" );
      else
        die( "Whoooops! An error has occured! Please try again." );
    }
    $this->util->code = $this->model->getNextCode();
    $this->util->getView( 'add_item' );
  }

  public function edit()
  {
    if ( !Session::exists('username') )
      header('location: ?p=admin&a=login');

    if ( Input::get('edit_submit') )
    {
      $aData = array(
        'jumlah' => Input::get('jumlah'),
        'berat' => Input::get('berat'),
        'harga' => Input::get('harga')
      );

      if ($this->model->update($aData, array( "kode" => Input::get("kode") ) ) )
        header("location: ?p=barang");
      else
        die("WHoops! An error has occures! Please try again later");
    }

    $this->util->data = $this->model->getById(array ( 'kode' => $_GET['kode'] ) );

    $this->util->getView('edit_item');
  }

  public function take()
  {
    if ( !Session::exists('username') )
      header('location: ?p=admin&a=login');

    if ( $this->model->take( array( 'kode' => Input::get('kode') ) ) )
      return header('location:' . ROOT_URL . '?p=barang');
    else
      exit('Kesalahan saat memasukkan data');
  }

  public function delete()
  {
    if ( !Session::exists('username') )
      header('location: ?p=admin&a=login');

    if ( $this->model->delete( array( 'kode' => Input::get('kode') ) ) )
      return header('location:' . ROOT_URL . '?p=barang');
    else
      exit('Kesalahan saat menghapus data');
  }
}