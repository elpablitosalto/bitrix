<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
use Bitrix\Main\Application;

/**
 * @var CBitrixComponentTemplate $this
 * @var CatalogSectionComponent $component
 */

$component = $this->getComponent();
$arParams = $component->applyTemplateModifications();
$application = Application::getInstance();
$session = Application::getInstance()->getSession();

$arResult['FAVORITES'] = [];

if(!$USER->IsAuthorized()) {
	// Для неавторизованного
	$favorites = unserialize($session->get('favorites'));
}
else {
     $idUser = $USER->GetID();
     $rsUser = CUser::GetByID($idUser);
     $arUser = $rsUser->Fetch();
     $favorites = $arUser['UF_FAVORITES'];
}

if(!empty($favorites)) {
    $arResult['FAVORITES'] = $favorites;
}
