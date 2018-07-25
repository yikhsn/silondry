<?php
namespace Acme\Auth;

class Session{

  public static function set($nama, $nilai){
    return $_SESSION[$nama] = $nilai;
  }

  public static function get($nama){
    return $_SESSION[$nama];
  }

  public static function exists($nama){
    return ( isset($_SESSION[$nama]) ) ? true : false;
  }
}