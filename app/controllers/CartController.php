<?php

namespace app\controllers;

use app\models\Cart;
use app\models\User;
use app\models\Order;

class CartController extends AppController {

  public function addAction() {
    $product_id = !empty($_GET['id']) ? (int) $_GET['id'] : null;
    $qty = !empty($_GET['qty']) ? (int) $_GET['qty'] : null;
    $mod_id = !empty($_GET['mod']) ? (int) $_GET['mod'] : null;
    $mod = null;
    if ($product_id) {
      $product = \R::findOne('product', 'id = ?', [$product_id]);
      if (!$product) {
        return false;
      }
      if ($mod_id) {
        $mod = \R::findOne('modification', 'id = ? AND product_id = ?', [$mod_id, $product_id]);
      }
    }
    $cart = new Cart();
    $cart->addToCart($product, $qty, $mod);
    if ($this->isAjax()) {
      $this->loadView('cart_modal');
    }
    redirect();
  }

  public function showAction() {
      $this->loadView('cart_modal');
  }

  public function deleteAction() {
    $id = !empty($_GET['id']) ? $_GET['id'] : null;
    if (isset($_SESSION['cart'][$id])) {
      $cart = new Cart();
      $cart->deleteItem($id);
    }
    if ($this->isAjax()) {
      $this->loadView('cart_modal');
    }
    redirect();
  }

  public function clearAction() {
    unset($_SESSION['cart.currency']);
    unset($_SESSION['cart']);
    unset($_SESSION['cart.qty']);
    unset($_SESSION['cart.sum']);

    $this->loadView('cart_modal');
  }

  public function viewAction() {
    $this->setMeta('Корзина');
  }

  public function checkoutAction() {
    $data = $_POST;
    if (!empty($post)) {
      // Registration
      if (!User::checkAuth()) {
        $user = new User($post);
        if (!$user->validate() || !$user->checkUnique()) {
          $user->getErrors();
          $_SESSION['form_data'] = $post;
          redirect();
          return;
        }
        $user->attributes['password'] = password_hash($user->attributes['password'], PASSWORD_DEFAULT);
        if (!$user_id = $user->save('user')) {
          $_SESSION['error'] = 'Ошибка!';
          redirect();
          return;
        }
      }

      // Сохранить заказ
      $data['user_id'] = isset($user_id) ? $user_id : $_SESSION['user']['id'];
      $data['note'] = !empty($_POST['note']) ? $_POST['note'] : '';
      $user_email = !empty($_SESSION['user']['email']) ? $_SESSION['user']['email'] : $_POST['email'];

      $order_id = Order::saveOrder($data);
      Order::mailOrder($order_id, $user_email);
    }
    redirect();
  }
}
