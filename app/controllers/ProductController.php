<?php

namespace app\controllers;

use app\models\Product;
use app\models\Breadcrumbs;

class ProductController extends AppController{
  public function viewAction() {
    $alias = $this->route['alias'];
    $product = \R::findOne('product', "alias = ? AND status = '1'", [$alias]);
    if (!$product) {
      throw new \Exception('Страница не найдена', 404);
    }

    // хлебные крошки
    $breadcrumbs = Breadcrumbs::getBreadcrumbs($product->category_id, $product->title);
    // связанные товары
    $related = \R::getAll("SELECT * FROM related_product JOIN product ON related_product.related_id=product.id WHERE related_product.product_id=?", [$product->id]);
    // запись в куки запрошенные товары
    $p_model = new Product();
    $p_model->setRecentlyViewed($product->id);
    // просмотренные  товары
    $arr_recently = $p_model->getRecentlyViewed();
    $recentlyViewed = null;
    if ($arr_recently) {
      $recentlyViewed = \R::find('product', 'id IN (' . \R::genSlots($arr_recently) . ') LIMIT 3', $arr_recently);
    }
    // галерея 
    $gallery = \R::findAll('gallery', 'product_id=?', [$product->id]);
    // модификации

    $this->setMeta($product->title, $product->description, $product->keywords);
    $this->set(compact('product', 'related', 'gallery', 'recentlyViewed', 'breadcrumbs'));
  }

}
