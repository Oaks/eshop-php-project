<?php

namespace ishop\base;

abstract class Controller {
  public $route;
  public $controller;
  public $model;
  public $view;
  public $prefix;
  public $layout;
  public $data = [];
  public $meta = ['title'=>'', 'desc'=>'', 'keywords'=>''];

  public function __construct($route) {
    $this->route = $route;
    $this->controller = $route['controller'];
    $this->model = $route['controller'];
    $this->view = $route['action'];
    $this->prefix = $route['prefix'];
  }

  public function set($data) {
    $this->data = $data;
  }

  public function setMeta( $title = '', $desc = '', $keywords = '' ) {
  $this->meta['title'] = $title;
  $this->meta['desc'] = $desc;
  $this->meta['keywords'] = $keywords;
  }

  public function getView() {
    $view = new View($this->route, $this->layout, $this->view,$this->meta);
    $view->render($this->data);
  }
}
