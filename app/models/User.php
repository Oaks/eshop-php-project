<?php

namespace app\models;

class User extends AppModel {
  public $attributes = [
    'login' => '',
    'password' => '',
    'name' => '',
    'email' => '',
    'address' => ''
  ];

  protected $rules = [
    'required' => [
      ['login'],
      ['password'],
      ['name'],
      ['email'],
      ['address'],
    ],
    'email' => [
      ['email'],
    ],
    'lengthMin' => [
      ['password', 6],
    ],
  ];

  public function __construct($data = null) {
    parent::__construct();
    if (!empty($data)) {
      $this->load($data);
    }
  }

  public function checkUnique() {
    $user = \R::findOne('user', 'login = ? OR email = ?',[
      $this->attributes['login'], $this->attributes['email']
    ]);
    if ($user) {
      if ($user->login == $this->attributes['login']) {
        $this->errors['unique'][] = 'Этот логин уже занят';
      }
      if ($user->email == $this->attributes['email']) {
        $this->errors['unique'][] = 'Этот email уже занят';
      }
      return false;
    }
    return true;
  }
}
