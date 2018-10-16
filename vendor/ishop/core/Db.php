<?php

namespace ishop;

class Db {
  use TSingletone;

  protected function __construct() {
    $db = require_once CONF . '/config_db.php'; 
    class_alias('RedBeanPHP\R', '\R');
    \R::setup($db['dsn'], $db['user'], $db['pass']);
    if (!\R::testConnection()) {
      throw new \Exception('Нет соединения с БД');
    } else {
      echo 'Соединение установлено';
      \R::freeze(true);
      \R::debug(true, 1);
    }
  }
}
