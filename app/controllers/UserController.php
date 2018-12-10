<?php

namespace app\controllers;

use app\models\User;

class UserController extends AppController {
  public function signupAction() {
    $post = $_POST;
    if (!empty($post)) {
      $user = new User($post);
      if (!$user->validate() || !$user->checkUnique()) {
        $user->getErrors();
        $_SESSION['form_data'] = $post;
        redirect();
        return;
      }
      $user->attributes['password'] = password_hash($user->attributes['password'], PASSWORD_DEFAULT);
      if ($user->save('user')) {
        $_SESSION['success'] = 'Вы зарегистрированы';
      } else {
        $_SESSION['error'] = 'Ошибка!';
      }
      redirect();
      return;
    }
    $this->setMeta('Регистрация');
  }

  public function loginAction() {
    if (!empty($_POST)) {
      $user = new User();
      if ($user->login()) {
        $_SESSION['success'] = 'Вы успешно авторизованы';
      } else {
        $_SESSION['error'] = 'Логин/пароль введенны неверно';
      }
      redirect();
    }
    $this->setMeta('Вход');
  }

  public function logoutAction() {
    if (isset($_SESSION['user'])) unset($_SESSION['user']);
    redirect();
  }
}
