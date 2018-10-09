<?php

namespace app\controllers;

use ishop\App;

class MainController extends AppController {
  public function indexAction() {
    $this->setMeta('Главная страница', 'Описание ...', 'Ключевики ');
    $name = 'John';
    $age = 30;
    $this->set(compact('name', 'age'));
  }
}
