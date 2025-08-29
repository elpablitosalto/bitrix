<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Личный кабинет");

/*global $USER;
if(!$USER->IsAuthorized()) {
    LocalRedirect("/personal/auth/");
    die();
}*/

?>
<section class="content">
	<div class="container _inside-page">
		<div class="breadcrumbs">
			<ul class="breadcrumbs-list">
				<li class="breadcrumbs-list__item"><a href="#">Главная</a></li>
				<li class="breadcrumbs-list__item">Личный кабинет</li>
			</ul>
		</div>
		<?$APPLICATION->IncludeComponent(
	"bitrix:main.profile", 
	".default", 
	array(
		"CHECK_RIGHTS" => "N",
		"SEND_INFO" => "N",
		"SET_TITLE" => "Y",
		"USER_PROPERTY" => array(
			0 => "UF_LOGO",
			1 => "UF_PHOTOS",
			2 => "UF_REGION",
			3 => "UF_ADDRESS",
			4 => "UF_BRAND_NAME",
		),
		"USER_PROPERTY_NAME" => "",
		"COMPONENT_TEMPLATE" => ".default"
	),
	false
);?>
	</div>
</section>
		
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>