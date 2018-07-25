<?php

namespace Acme\Engine;

class Util
{
  public function getView($viewName)
  {
    $this->_get($viewName, 'View');
  }

  public function getModel($modelName)
  {
    $this->_get($modelName, 'Model');
  }

  /**
   * This method is useful in order to avoid the duplication of code
   * Because getView and getModel have the exact same function 
   */
  private function _get($fileName, $type)
  {
    $fullPath = ROOT_PATH . 'app/' .  $type . '/' . $fileName . '.php';
    if (is_file($fullPath))
      require $fullPath;
    else
      exit('The' . $fullPath . 'file doesnt exist');
  }

  /**
   * set variables for the template views
   * 
   * @return void
   */
  public function __set($key, $val){
    $this->$key = $val; 
  }  
}