<?php

namespace app\controllers;

class MainController extends AppController {
  public function indexAction() {
    echo 'Main controller';
    debug($this->route);
    debug($this->route['controller']);
    die;
  }
}
