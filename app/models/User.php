<?php

namespace app\models;

class User extends AppModel {
  protected $attributes = [
    'login' => '',
    'password' => '',
    'name' => '',
    'email' => '',
    'address' => ''
  ];

  protected $rules = [
    'required' => [
      ['login'],
      ['password'],
      ['name'],
      ['email'],
      ['address'],
    ],
    'email' => [
      ['email'],
    ],
    'lengthMin' => [
      ['password', 6],
    ],
  ];
}
