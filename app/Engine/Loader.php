<?php

namespace Acme\Engine;

use Acme\Engine\Pattern\Singleton;

require_once __DIR__  . '/Pattern/Base.trait.php';
require_once __DIR__  . '/Pattern/Singleton.trait.php';

class Loader
{
  use Singleton;

  // register the loader method
  public function init()
  {
    spl_autoload_register(array(__CLASS__, '_loadClasses'));
  }

  public function _loadClasses($classs){
    // remove namespace and backslash
    $classs = str_replace(array(__NAMESPACE__, 'Acme', '\\'), '/', $classs);

    if (is_file(__DIR__ . '/' . $classs . '.php'))
      require_once __DIR__ . '/' . $classs . '.php';

    if (is_file(ROOT_PATH . $classs . '.php'))
      require_once ROOT_PATH . $classs . '.php';
  }
}