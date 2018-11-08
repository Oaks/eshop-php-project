<?php

namespace app\models;

class Product extends AppModel {
  
  public function getRecentlyViewed() {
    if ($_COOKIE['recentlyViewed']) {
      $exploded = explode('.', $_COOKIE['recentlyViewed']);
      return array_slice($exploded, -3);
    } else {
      return false;
    }
  }
  
  public function setRecentlyViewed($id) {
    $recently = $this->getAllRecentlyViewed();
    if (empty($recently)) {
      setcookie('recentlyViewed',$id, time()+3600*24, '/');
    } else {
      $exploded = explode('.', $recently);
      if (!in_array($id,$exploded)) {
        $exploded[] = $id;
        setcookie('recentlyViewed', implode($exploded, '.'), time()+3600*24, '/');
      }
    }
  }
  
  public function getAllRecentlyViewed() {
    if ($_COOKIE['recentlyViewed']) {
      return $_COOKIE['recentlyViewed'];
    } else {
      return false;
    }
  }
}
