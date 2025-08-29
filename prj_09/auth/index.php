<?
define('REMOVE_H1_TITLE', true);
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Авторизация");
if($GLOBALS["USER"]->IsAuthorized()){
  LocalRedirect(PROFILE_URL);
}
?>
<div class="page__content-panel">
	<!-- begin .content-panel -->
	<div class="content-panel">
		<div class="content-panel__header">
			<div class="content-panel__title">
					<!-- begin .title-->
					<h1 class="title title_size_h1"><?$APPLICATION->ShowTitle(false);?></h1>
					<!-- end .title-->
			</div>
		</div>

		<div class="content-panel__form">
			<!-- begin .auth-form-->
			<?$APPLICATION->IncludeComponent(
					"bitrix:system.auth.form",
					"main",
					Array(
							"REGISTER_URL" => REGISTER_URL,
							"PROFILE_URL" => PROFILE_URL
					)
			);?>
			<!-- end .auth-form-->
		</div>
	</div>
	<!-- end .content-panel -->
</div>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>