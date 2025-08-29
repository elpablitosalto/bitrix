<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

/**
 * @global CMain $APPLICATION
 */

global $APPLICATION;

//delayed function must return a string
if(empty($arResult))
  return "";

$arItems = array();


$strReturn = '';
$siteName = SITE_SERVER_NAME;

$strReturn .= '<div class="breadcrumbs"><ul class="breadcrumbs__list">';

$itemSize = count($arResult);
for($index = 0; $index < $itemSize; $index++)
{
  $title = htmlspecialcharsex($arResult[$index]["TITLE"]);

  if($arResult[$index]["LINK"] <> "" && $index != $itemSize-1)
  {
    $arItems[] = array(
      "@type" => "ListItem",
      "position" => ($index + 1),
      "item" =>
        [
          "name" => $title,
          "@id" => "https://{$siteName}{$arResult[$index]['LINK']}" ,
        ]
    );
    $strReturn .= '
      <li class="breadcrumbs__item" id="bx_breadcrumb_'.$index.'">
        <a class="breadcrumbs__link" href="'.$arResult[$index]["LINK"].'" title="'.$title.'">
          <span>'.$title.'</span>
        </a>
      </li>';
  }
  else
  {
    $arItems[] = array(
      "@type" => "ListItem",
      "item" =>
        [
          "name" => $title,
        ]
    );
    $strReturn .= '
      <li class="breadcrumbs__item">
        <span class="breadcrumbs__label">'.$title.'</span>
      </li>';
  }
}

$strReturn .= '</ul></div>';

$strReturn .='<script type="application/ld+json">';

$arr = array(
  "@context" => "https://schema.org",
  "@type" => "BreadcrumbList",
  "itemListElement" => $arItems,
);

$strReturn .= json_encode($arr, JSON_UNESCAPED_UNICODE);

$strReturn .= '</script>';

return $strReturn;
