<?php

namespace app\controllers;

use app\models\Breadcrumbs;
use app\models\Category;
use ishop\App;
use ishop\libs\Pagination;

class CategoryController extends AppController {

    public function viewAction(){
        $alias = $this->route['alias'];
        $category = \R::findOne('category', 'alias = ?', [$alias]);
        if(!$category){
            throw new \Exception('Страница не найдена', 404);
        }

        $breadcrumbs = Breadcrumbs::getBreadcrumbs($category->id);

        $cat_model = new Category();
        $ids = $cat_model->getIds($category->id);
        $ids[] = $category->id;
        $ids = implode(",", $ids);

        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $perpage = App::$app->getProperty('pagination');
        $total = \R::count('product', "category_id IN ($ids)");
        $pagination = new Pagination($page, $perpage, $total);
        $offset = $pagination->getStart();

        $products = \R::find('product', "category_id IN ($ids) LIMIT $offset, $perpage");
        $this->setMeta($category->title, $category->description, $category->keywords);
        $this->set(compact('products', 'breadcrumbs', 'pagination', 'total'));
    }

}
