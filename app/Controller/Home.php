<?php
namespace Acme\Controller;

use Acme\Engine\Util;
use Acme\Model\Insight\Insight;
use Acme\Model\Activities\LatestIn;
use Acme\Model\Activities\LatestAll;
use Acme\Auth\Session;

class Home
{
  protected $util, $model;

  public function __construct()
  {
    if (empty($_SESSION))
      @session_start();

    $this->util = new Util;
    $this->insight = new Insight;
    $this->latestIn = new latestIn;
    $this->latestAll = new LatestAll;
  }

  public function index()
  {
    if ( !Session::exists('username') )
      header('location: ?p=admin&a=login');

    $this->util->todayInsight     = $this->insight->daily();
    $this->util->thisWeekInsight  = $this->insight->weekly();
    $this->util->latestIn         = $this->latestIn->show(10, 'masuk');
    $this->util->latestOut        = $this->latestIn->show(10, 'keluar');
    $this->util->latestAll        = $this->latestAll->show(10);
    $this->util->getView('index');
  }

  public function notFound()
  {
    if ( !Session::exists('username') )
      header('location: ?p=admin&a=login');

    exit('Halaman yang anda cari tidak ditemukan');
  }
}