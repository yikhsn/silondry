<?php
namespace Acme\Engine;

class Util
{
  /**
   * method to load view file
   */
  public function getView($view)
  {
    $fullPath = ROOT_PATH . 'app/View/' . $view . '.php';
    if (is_file($fullPath))
      require $fullPath;
    else
      exit('The' . $fullPath . 'file doesnt exist');
  }

  /**
   * set variables for the view
   */
  public function __set($key, $val){
    $this->$key = $val; 
  }  
}