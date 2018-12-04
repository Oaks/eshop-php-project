<?php

namespace app\models;

use ishop\App;

class Category extends AppModel {
  private $ids;

  public function getIds($id) {
    $cats = App::$app->getProperty('cats');

    foreach ($cats as $cat_id => $cat) {
      if ($cat['parent_id'] == $id) {
        $this->ids[] = $cat_id; 
        $this->getIds($cat_id);
      }
    }
    return $this->ids;
  }
}
