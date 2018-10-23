<?php

namespace app\controllers;

use ishop\App;
use ishop\Cache;

class MainController extends AppController {
  public function indexAction() {
    $this->setMeta('Главная страница', 'Описание ...', 'Ключевики');
  }
}
