<?php

namespace app\controllers;

use ishop\App;
use app\models\Category;
use app\models\Breadcrumbs;

class CategoryController extends AppController {

  public function viewAction() {
    $alias = $this->route['alias'];
    $category = \R::findOne('category', 'alias = ?', [$alias]);
    if (!$category) {
      throw \Exception('Страница не найдена', 404);
    }

    // хлебные крошки
    $breadcrumbs = Breadcrumbs::getBreadcrumbs($category->id);;

    $cat_model = new Category();
    $ids = $cat_model->getIds($category->id);
    $ids[] = $category->id; 
    $ids = implode(',', $ids);

    $products = \R::find('product', "category_id IN ($ids)");
    $this->setMeta($category->title, $category->description, $category->keywords);
    $this->set(compact('products', 'breadcrumbs'));
  }
}
