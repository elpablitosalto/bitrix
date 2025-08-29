<?
 if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

 $arTemplateParameters = array(
     'TOP_BANNER_DESKTOP' =>  array(
         'NAME'      =>  'Верхний баннер десктоп',
         'TYPE'      =>  'FILE',
         'SORT'      =>  '10',
         'MULTIPLE'  =>  'N',
         "FD_TARGET" => "F",
         "FD_EXT" => 'png,jpg,jpeg',
         "FD_UPLOAD" => true,
         "FD_USE_MEDIALIB" => true,
     ),
     'TOP_BANNER_MOBILE' =>  array(
         'NAME'      =>  'Верхний баннер мобилка',
         'TYPE'      =>  'FILE',
         'SORT'      =>  '20',
         'MULTIPLE'  =>  'N',
         "FD_TARGET" => "F",
         "FD_EXT" => 'png,jpg,jpeg',
         "FD_UPLOAD" => true,
         "FD_USE_MEDIALIB" => true,
     ),
 );
?>