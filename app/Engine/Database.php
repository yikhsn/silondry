<?php
namespace Acme\Engine;

use PDO;

class Database extends PDO {
  public function __construct()
  {
    $aDriverOptions[PDO::MYSQL_ATTR_INIT_COMMAND] = 'SET NAMES UTF8';
    parent::__construct('mysql:host=127.0.0.1; dbname=silaundry', 'root', '', $aDriverOptions);
    $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }
}

