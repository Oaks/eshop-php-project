<?php

namespace app\controllers\admin;

use ishop\base\Controller;
use app\models\User;
use app\models\AppModel;

class AppController extends Controller {
  public $layout = 'admin';
  protected $isAdminUserController = false;
  protected $pathUserLogin = '/user/login-admin';

  public function __construct($route) {
    parent::__construct($route);

    if (!User::isAdmin() && !$this->isAdminUserController) {
      redirect(ADMIN . $this->pathUserLogin);
    }
    new AppModel();
  }
}

