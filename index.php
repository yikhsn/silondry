<?php
namespace Acme;

require_once "vendor/autoload.php";

use Acme\Engine;

/**
 * define all constant of all path that needed
 * root server path & root URL
 */
define( 'PROT', ( !empty($_SERVER['HTTPS']) && strtolower( $_SERVER['HTTPS'] ) == 'on') ? 'https://' : 'http://' );
define( 'ROOT_URL', PROT . $_SERVER['HTTP_HOST'] . str_replace('\\', '', dirname(htmlspecialchars($_SERVER['PHP_SELF'], ENT_QUOTES))) . '/');
define('ROOT_PATH', __DIR__ . '/');

/**
 * get all data from request handling (global variable $_GET)
 * then convert it as params in associative array to pass it 
 * to the router for call the right controller (class) and the right method
 */
try
{
  $params = [
    'ctrl'  =>  $_GET['p'] ?? $_GET['p'] ?? 'home', 
    'act'   =>  $_GET['a'] ?? $_GET['a'] ?? 'index'
  ];
  
  Engine\Router::run($params);
}
catch(Exception $e)
{
  echo $e->getMessage();
}