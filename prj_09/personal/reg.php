<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("keywords", "Регистрация");
$APPLICATION->SetPageProperty("description", "Регистрация");
$APPLICATION->SetTitle("Регистрация");
?>
<div id="contents" role="main" class="col-lg-12 col-md-12 col-sm-12">
<div class="post-24 page type-page status-publish hentry">
<header>
<h1 class="entry-title">Регистрация</h1>
</header>
<div class="entry-content">
<?$APPLICATION->IncludeComponent(
	"bitrix:main.register", 
	"main.register.mv", 
	array(
		"COMPONENT_TEMPLATE" => "main.register.mv",
		"SHOW_FIELDS" => array(
			0 => "EMAIL",
			1 => "NAME",
			2 => "LAST_NAME",
			3 => "PERSONAL_PHONE",
		),
		"REQUIRED_FIELDS" => array(
			0 => "EMAIL",
			1 => "NAME",
		),
		"AUTH" => "Y",
		"USE_BACKURL" => "Y",
		"SUCCESS_PAGE" => "",
		"SET_TITLE" => "Y",
		"USER_PROPERTY" => array(
		),
		"USER_PROPERTY_NAME" => "",
		"USER_CONSENT" => "Y",
		"USER_CONSENT_ID" => "1",
		"USER_CONSENT_IS_CHECKED" => "N",
		"USER_CONSENT_IS_LOADED" => "Y"
	),
	false
);?>
</div></div></div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>