<?php

namespace app\models;

class Order extends AppModel {
  protected $table = 'order';

  public $attributes = [
    'user_id' => '',
    'note' => '',
    'currency' => '',
  ];

  public function __construct($data = null) {
    if ($data) {
      $this->load($data);
    }
  }

  public function saveOrder() {
    $this->saveX();
  }

  public static function saveOrderProduct($order_id) {
  }

  public static function mailOrder($order_id, $user_email) {
  }
}
