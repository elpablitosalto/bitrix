<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

$rootDomain = \Hair\Geo::getRootDomain();

$object = json_decode(json_encode($_REQUEST), FALSE);
setcookie("GEO_POSITION", serialize($object), time()+3600*24, "/", ".".$rootDomain);

// 41593
$request = \Bitrix\Main\Context::getCurrent()->getRequest();
$subDomain = \Hair\Geo::getSubDomainByName($_REQUEST["cityName"]);
if (!empty($rootDomain) && !empty($subDomain)) {
    $domain = $request->getServer()->getRequestScheme() . "://" . $subDomain["CODE"] . "." . $rootDomain;
}elseif (!empty($rootDomain)){
    $domain = $request->getServer()->getRequestScheme() . "://" . $rootDomain;
}
echo \Bitrix\Main\Web\Json::encode([
    "status" => 'success',
    "domain" => $domain,
]);