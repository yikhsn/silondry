<?php
namespace Acme\Controller;

use Acme\Engine\Util;
use Acme\Model\Insight\Insight;
use Acme\Model\Activities\{In, Out, All, Activities};
use Acme\Model\Barang;
use Acme\Auth\Session;

class Home
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
    $this->insight = new Insight;
    $this->latestIn = new In;
    $this->latestOut = new Out;
    $this->latestAll = new All(new In, new Out);
    $this->barang = new Barang;
  }

  /**
   * index page for the index app, will show the dashboard page app
   * @return View index
   */
  public function index()
  {
    if ( !Session::exists('username') )
      header('location: ?p=admin&a=login');

    $this->util->notTaken         = $this->barang->notTaken();
    $this->util->todayInsight     = $this->insight->daily();
    $this->util->thisWeekInsight  = $this->insight->weekly();
    $this->util->latestIn         = $this->latestIn->getData(10);
    $this->util->latestOut        = $this->latestOut->getData(10);
    $this->util->latestAll        = $this->latestAll->getData(10);
    $this->util->getView('index');
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