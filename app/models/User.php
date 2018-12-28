<?php

namespace app\models;

class User extends AppModel {
  protected $table = 'user';

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

  public function login($isAdmin = false) {
//    $login = trim($_POST['login']) ? trim($_POST['login']) : null;
//    $password = trim($_POST['password']) ? trim($_POST['password']) : null;
    if ($this->attributes['login'] && $this->attributes['password']) {
      if ($isAdmin) {
        $user = \R::findOne('user', "login = ? AND role = 'admin'", [$this->attributes['login']]);
      } else {
        $user = \R::findOne('user', "login = ? ", [$this->attributes['login']]);
      }
    }
    if ($user) {
      if (password_verify($this->attributes['password'], $user->password)) {
        foreach ($user as $k => $v) {
          if ($k != 'password') {
            $_SESSION['user'][$k] = $v;
          }
        }
        return true;
      }
    }
    return false;
  }

  public static function checkAuth() {
    return isset($_SESSION['user']);
  }

  public static function isAdmin() {
    return isset($_SESSION['user']) && $_SESSION['user']['role'] == 'admin';
  }
}
