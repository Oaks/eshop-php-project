<?php

namespace app\controllers;

use app\models\User;

class UserController extends AppController {
  public function signupAction() {
    if (!empty($_POST)) {
      $user = new User();
      $user->load($_POST);
      if (!$user->validate()) {
        $user->getErrors();
        redirect();
      }
      $_SESSION['success'] = 'OK';
      redirect();
    }
    $this->setMeta('Регистрация');
  }

  public function loginAction() {
  }

  public function logoutAction() {
  }
}
