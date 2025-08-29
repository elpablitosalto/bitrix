<?php
$arUrlRewrite=array (
  31 => 
  array (
    'CONDITION' => '#^/gallery/projects/#',
    'RULE' => '',
    'ID' => 'bitrix:catalog',
    'PATH' => '/gallery/projects/index.php',
    'SORT' => 100,
  ),
  10 => 
  array (
    'CONDITION' => '#^/rest/#',
    'RULE' => '',
    'ID' => NULL,
    'PATH' => '/bitrix/services/rest/index.php',
    'SORT' => 100,
  ),
  20 => 
  array (
    'CONDITION' => '#^/about/news/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/about/news/index.php',
    'SORT' => 110,
  ),
  30 => 
  array (
    'CONDITION' => '#^/catalog/#',
    'RULE' => '',
    'ID' => 'bitrix:catalog',
    'PATH' => '/catalog/index.php',
    'SORT' => 120,
  ),
  40 => 
  array (
    'CONDITION' => '#^/tekhnologiya-stone-top/(\?.*)?$#',
    'RULE' => 'ELEMENT_CODE=tekhnologiya-stone-top',
    'ID' => '',
    'PATH' => '/colormix_stonetop/index.php',
    'SORT' => 130,
  ),
  50 => 
  array (
    'CONDITION' => '#^/tekhnologiya-color-mix/(\?.*)?$#',
    'RULE' => 'ELEMENT_CODE=tekhnologiya-color-mix',
    'ID' => '',
    'PATH' => '/colormix_stonetop/index.php',
    'SORT' => 140,
  ),
);
