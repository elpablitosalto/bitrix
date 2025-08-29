<?php
$arUrlRewrite=array (
  40 => 
  array (
    'CONDITION' => '#^/support_doc/equipment/([0-9a-z-]+)/(\\?.*)?$#',
    'RULE' => 'ELEMENT_ID=$1',
    'ID' => '',
    'PATH' => '/support_doc/equipment/detail.php',
    'SORT' => 100,
  ),
  30 => 
  array (
    'CONDITION' => '#^/knowledge/articles/([0-9a-z-]+)/(\\?.*)?$#',
    'RULE' => 'ELEMENT_CODE=$1',
    'ID' => '',
    'PATH' => '/knowledge/articles/detail.php',
    'SORT' => 100,
  ),
  10 => 
  array (
    'CONDITION' => '#^/reagents/([0-9a-z-]+)/(\\?.*)?$#',
    'RULE' => 'IBLOCK_CODE=$1',
    'ID' => '',
    'PATH' => '/reagents/index.php',
    'SORT' => 100,
  ),
  50 => 
  array (
    'CONDITION' => '#^/news/([0-9a-z-]+)/(\\?.*)?$#',
    'RULE' => 'ELEMENT_CODE=$1',
    'ID' => '',
    'PATH' => '/news/detail.php',
    'SORT' => 100,
  ),
  20 => 
  array (
    'CONDITION' => '#^/catalog/#',
    'RULE' => '',
    'ID' => 'bitrix:catalog',
    'PATH' => '/catalog/index.php',
    'SORT' => 100,
  ),
);
