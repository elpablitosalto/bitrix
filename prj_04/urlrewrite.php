<?php
$arUrlRewrite=array (
  6 => 
  array (
    'CONDITION' => '#^/press-center/events/([0-9a-zA-Z-_]+)/(\\?(.*))?#',
    'RULE' => 'CODE=$1',
    'ID' => '',
    'PATH' => '/press-center/events/detail.php',
    'SORT' => 100,
  ),
  8 => 
  array (
    'CONDITION' => '#^/infinity/lookbook/([0-9a-zA-Z-_]+)/?(\\?(.*))?#',
    'RULE' => 'CODE=$1',
    'ID' => '',
    'PATH' => '/infinity/lookbook/detail.php',
    'SORT' => 100,
  ),
  9 => 
  array (
    'CONDITION' => '#^/press-center/news/([0-9a-zA-Z-_]+)/(\\?(.*))?#',
    'RULE' => 'CODE=$1',
    'ID' => '',
    'PATH' => '/press-center/news/detail.php',
    'SORT' => 100,
  ),
  12 => 
  array (
    'CONDITION' => '#^/press-center/blog/([0-9a-zA-Z-_]+)/(\\?(.*))?#',
    'RULE' => 'CODE=$1',
    'ID' => '',
    'PATH' => '/press-center/blog/detail.php',
    'SORT' => 100,
  ),
  5 => 
  array (
    'CONDITION' => '#^/lookbook/([0-9a-zA-Z-_]+)/?(\\?(.*))?#',
    'RULE' => 'CODE=$1',
    'ID' => '',
    'PATH' => '/lookbook/detail.php',
    'SORT' => 100,
  ),
  14 => 
  array (
    'CONDITION' => '#^/infinity/catalog/#',
    'RULE' => '',
    'ID' => 'bitrix:catalog',
    'PATH' => '/infinity/catalog/index.php',
    'SORT' => 100,
  ),
  16 => 
  array (
    'CONDITION' => '#^/catalog/#',
    'RULE' => '',
    'ID' => 'bitrix:catalog',
    'PATH' => '/catalog/index.php',
    'SORT' => 100,
  ),
  3 => 
  array (
    'CONDITION' => '#^/photo/#',
    'RULE' => '',
    'ID' => 'bitrix:photogallery',
    'PATH' => '/photo.php',
    'SORT' => 100,
  ),
  1 => 
  array (
    'CONDITION' => '#^/rest/#',
    'RULE' => '',
    'ID' => NULL,
    'PATH' => '/bitrix/services/rest/index.php',
    'SORT' => 100,
  ),
  /*
  15 => 
  array (
    'CONDITION' => '#^/#',
    'RULE' => '',
    'ID' => 'bitrix:iblock.element.add.form',
    'PATH' => '/contacts/index.php',
    'SORT' => 100,
  ),
  */
  /*
  15 => 
  array (
    'CONDITION' => '#^/#',
    'RULE' => '',
    'ID' => 'bitrix:iblock.element.add.form',
    'PATH' => '/infinity/contacts/index.php',
    'SORT' => 100,
  ),
  */
);
