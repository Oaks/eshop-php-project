<?php

namespace app\controllers;

use ishop\App;
use ishop\Cache;

class MainController extends AppController {
  public function indexAction() {
    $brands = \R::find('brand', 'limit 3');
    $this->setMeta('Главная страница', 'Описание ...', 'Ключевики');
    $this->set(compact('brands'));
  }
}
