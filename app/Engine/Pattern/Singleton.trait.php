<?php

namespace Acme\Engine\Pattern;

trait Singleton{

  use Base;

  protected static $_instance = null;

  public static function getInstance(){
    return (null === static::$_instance) ? static::$_instance = new static : static::$_instance;
  }
}