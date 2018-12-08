<?php

namespace app\controllers;

use app\models\User;

class UserController extends AppController {
  public function signupAction() {
    if (!empty($_POST)) {
      $user = new User($_POST);
      if (!$user->validate() || !$user->checkUnique()) {
        $user->getErrors();
        redirect();
        return;
      }
      $user->attributes['password'] = password_hash($user->attributes['password'], PASSWORD_DEFAULT);
      if ($user->save('user')) {
        $_SESSION['success'] = 'Вы зарегестрированы';
      } else {
        $_SESSION['error'] = 'Ошибка!';
      }
      redirect();
      return;
    }
    $this->setMeta('Регистрация');
  }

  public function loginAction() {
  }

  public function logoutAction() {
  }
}
