<?php

namespace ishop\base;

use ishop\Db;
use Valitron\Validator;

abstract class Model {
  public $attributes = [];
  protected $rules = [];
  public $errors = [];

  public function __construct() {
    Db::instance();
  }

  public function load($data) {
    foreach( $this->attributes as $name => $value) {
      if (isset($data[$name])) {
        $this->attributes[$name] = trim($data[$name]);
      }
    }
  }

  public function validate() {
    Validator::langDir( WWW . '/validator/lang');
    Validator::lang('ru');
    $v = new Validator($this->attributes);
    $v->rules($this->rules);
    if ($v->validate()) {
      return true;
    }
    $this->errors = $v->errors();
    return false;
  }

  public function getErrors() {
    $errors = "<ul>";
    foreach ($this->errors as $error) {
      foreach ($error as $item) {
        $errors .= "<li>$item</li>";
      }
    }
    $errors .= "</ul>";

    $_SESSION['error'] = $errors;
  }

  public function save($table) {
    $tbl = \R::dispense($table);
    foreach ($this->attributes as $name => $value) {
      $tbl->$name = $value;
    }
    return \R::store($tbl);
  }

}
