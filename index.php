<?php

namespace Acme;

require_once "vendor/autoload.php";

use Acme\Engine;

// set constants (root server path + root URL)
define( 'PROT', ( !empty($_SERVER['HTTPS']) && strtolower( $_SERVER['HTTPS'] ) == 'on') ? 'https://' : 'http://' );
define( 'ROOT_URL', PROT . $_SERVER['HTTP_HOST'] . str_replace('\\', '', dirname(htmlspecialchars($_SERVER['PHP_SELF'], ENT_QUOTES))) . '/');
define('ROOT_PATH', __DIR__ . '/');

try
{
  // require ROOT_PATH . 'Engine/Loader.php';
  // Engine\Loader::getInstance()->init(); //load necessary class
  $params = ['ctrl' => ( !empty($_GET['p']) ? $_GET['p'] : 'home'), 'act' => (!empty($_GET['a']) ? $_GET['a'] : 'index')];
  Engine\Router::run($params);
}
catch(Exception $e)
{
  echo $e->getMessage();
}