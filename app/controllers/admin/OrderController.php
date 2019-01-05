<?php

namespace app\controllers\admin;

use ishop\libs\Pagination;

class OrderController extends AppController {
  public function indexAction() {
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $perpage = 1;
    $count = \R::count('order');
    $pagination = new Pagination($page, $perpage, $count);
    $start = $pagination->getstart();

    $orders = \R::getAll("SELECT `order`.id, `user`.name , `order`.status"
      .", `order`.date, `order`.update_at, `order`.currency"
      .", ROUND(SUM(`order_product`.price), 2) AS `sum`"
      ." FROM `order`"
      ." JOIN `user`          ON `order`.user_id            = `user`.id"
      ." JOIN `order_product` ON `order`.id                 = `order_product`.order_id"
      ." GROUP BY `order`.id ORDER BY `order`.status, `order`.id LIMIT $start, $perpage"
    );

    $this->set(compact('orders', 'pagination', 'count'));
    $this->setMeta('Список заказа');
  }
}
