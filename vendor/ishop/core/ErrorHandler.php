<?php

namespace ishop;

class ErrorHandler {
  public function __construct() {
    if (DEBUG) {
      error_reporting(-1);
    } else {
      error_reporting(0);
    }
    set_exception_handler([$this, 'exceptionHandler']);
  }

  public function exceptionHandler($e) {
    $this->logErrors($e->getMessage(), $e->getFile(), $e->getLine(), $e->getCode());
    $this->displayError('Исключение', $e->getMessage(), $e->getFile(), $e->getLine(), $e->getCode());
  }

  protected function logErrors($message='', $file='', $line='', $code) {
    error_log("[" . date('Y-m-d H:i:s') . "] Текст ошибки: {$message} | Файл: {$file} | Строка: {$line} | Код: {$code}\n--------------------\n", 3, ROOT . '/tmp/error.log');
  }

  protected function displayError($errno, $errstr, $errfile, $errline, $response=404) {
    http_response_code($response);
    if ($response == 404 && PROD) {
      require WWW . '/errors/404.php';
      die;
    }
    if (DEV) {
      require WWW . '/errors/dev.php';
    }else {
      require WWW . '/errors/prod.php';
    }
    die;
  }

}
