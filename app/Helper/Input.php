<?php
namespace Helper;

trait Input{

  public static function get($name){
    return $_POST[$name] ?? $_GET[$name] ?? false;
  }

}