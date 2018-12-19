<?php

namespace app\models;

use ishop\App;
use Swift_SmtpTransport;
use Swift_Mailer;
use Swift_Message;

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
    $order_id = $this->save();
    Order::saveOrderProduct($order_id);
  }

  public static function saveOrderProduct($order_id) {
    $sql_part = '';
    foreach ( $_SESSION['cart'] as $product_id => $product) {
      $product_id = (int) $product_id;
      $sql_part .= "($order_id, $product_id, {$product['qty']}, '{$product['title']}', {$product['price']}),";
    }
    $sql_part = rtrim($sql_part, ',');
    \R::exec("INSERT INTO order_product (order_id, product_id, qty, title, price) VALUES $sql_part");
  }

  public static function mailOrder($order_id, $user_email){
//    // Create the Transport
//    $transport = (new Swift_SmtpTransport(App::$app->getProperty('smtp_host'), App::$app->getProperty('smtp_port'), App::$app->getProperty('smtp_protocol')))
//        ->setUsername(App::$app->getProperty('smtp_login'))
//        ->setPassword(App::$app->getProperty('smtp_password'))
//    ;
//    // Create the Mailer using your created Transport
//    $mailer = new Swift_Mailer($transport);
//
//    // Create a message
//    ob_start();
//    require APP . '/views/mail/mail_order.php';
//    $body = ob_get_clean();
//
//    $message_client = (new Swift_Message("Вы совершили заказ №{$order_id} на сайте " . App::$app->getProperty('shop_name')))
//        ->setFrom([App::$app->getProperty('smtp_login') => App::$app->getProperty('shop_name')])
//        ->setTo($user_email)
//        ->setBody($body, 'text/html')
//    ;
//
//    $message_admin = (new Swift_Message("Сделан заказ №{$order_id}"))
//        ->setFrom([App::$app->getProperty('smtp_login') => App::$app->getProperty('shop_name')])
//        ->setTo(App::$app->getProperty('admin_email'))
//        ->setBody($body, 'text/html')
//    ;
//
//    // Send the message
//    $result = $mailer->send($message_client);
//    $result = $mailer->send($message_admin);
  }
}
