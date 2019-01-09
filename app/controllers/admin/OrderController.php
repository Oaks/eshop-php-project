<?php

namespace app\controllers\admin;

use ishop\libs\Pagination;
use ishop\App;

class OrderController extends AppController {
  public function indexAction() {
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $perpage = App::$app->getProperty('pagination');
    $count = \R::count('order');
    $pagination = new Pagination($page, $perpage, $count);
    $offset = $pagination->getstart();

    $orders = \R::getAll("SELECT `order`.id, `user`.name , `order`.status"
      .", `order`.date, `order`.update_at, `order`.currency"
      .", ROUND(SUM(`order_product`.price), 2) AS `sum`"
      ." FROM `order`"
      ." JOIN `user`          ON `order`.user_id            = `user`.id"
      ." JOIN `order_product` ON `order`.id                 = `order_product`.order_id"
      ." GROUP BY `order`.id ORDER BY `order`.status, `order`.id LIMIT $offset, $perpage"
    );

    $this->set(compact('orders', 'pagination', 'count'));
    $this->setMeta('Список заказов');
  }

  public function viewAction() {
    $id = $this->getOrderId();
    $order = \R::getRow("SELECT `order`.id, `user`.name , `order`.status"
      .", `order`.date, `order`.update_at, `order`.currency"
      .", ROUND(SUM(`order_product`.price), 2) AS `sum`"
      ." FROM `order`"
      ." JOIN `user`          ON `order`.user_id            = `user`.id"
      ." JOIN `order_product` ON `order`.id                 = `order_product`.order_id"
      ." WHERE `order`.id=? "
      ." GROUP BY `order`.id ORDER BY `order`.status, `order`.id LIMIT 1", [$id]
    );

    if (!$order) {
      throw new Exception('Страница не найдена', 404);
    }

    $order_products = \R::findAll('order_product', 'order_id = ?', [$id]);

    $this->set(compact('order', 'order_products'));
    $this->setMeta('Заказ');
  }
}
