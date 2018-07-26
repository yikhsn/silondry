<?php
namespace Acme\Engine;

use ReflectionClass;
use ReflectionMethod;

class Router
{
  public static function run(array $params)
  {
    $sNamespace   = 'Acme\Controller\\';
    $sDefaultCtrl = $sNamespace . 'Home';
    $sCtrlPath    = ROOT_PATH . 'app/Controller/';
    $sCtrl        = ucfirst($params['ctrl']);

    if (is_file($sCtrlPath . $sCtrl . '.php'))
    {
      $sCtrl = $sNamespace . $sCtrl;
      $oCtrl = new $sCtrl;
    
      if ( (new ReflectionClass($oCtrl) )->hasMethod($params['act']) && ( new ReflectionMethod($oCtrl, $params['act']) )->isPublic())
        call_user_func( array($oCtrl, $params['act']) );
      else
        call_user_func( array($oCtrl, 'notFound') );
    }
    else
      {
      call_user_func( array (new $sDefaultCtrl, 'notFound') );
      }
    }
}