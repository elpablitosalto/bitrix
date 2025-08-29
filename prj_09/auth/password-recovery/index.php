<?
define('REMOVE_H1_TITLE', true);
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Восстановление пароля");

$backURL = !empty($_GET['actionurl']) ? $_GET['actionurl'] : '';
$backURLParam = $backURL !== '' ? '?actionurl='.$backURL : '';
?>
<div class="page__content-panel">
	<!-- begin .content-panel -->
	<div class="content-panel" id="forgotPasswordFormPanel">
		<div class="content-panel__main content-panel__main_type_compact">
			<div class="content-panel__header">
				<div class="content-panel__title">
						<!-- begin .title-->
						<h1 class="title title_size_h1"><?$APPLICATION->ShowTitle(false);?></h1>
						<!-- end .title-->
				</div>
				<div class="content-panel__subtitle">Введите ваш e-mail ниже</div>
			</div>

			<div class="content-panel__form">
				<!-- begin .auth-form-->
				<?$APPLICATION->IncludeComponent(
						"bitrix:system.auth.forgotpasswd",
						"main",
						Array(
								"SHOW_ERRORS" => "Y",
								"AUTH_RESULT" => $APPLICATION->arAuthResult
						)
				);?>
				<!-- end .auth-form-->
			</div>
		</div>

		<div class="content-panel__result content-panel__result_type_status-message">
				<div class="content-panel__header">
						<div class="content-panel__title">
								<!-- begin .title-->
								<h1 class="title title_size_h1">Готово!</h1>
								<!-- end .title-->
						</div>
				</div>

				<div class="content-panel__section">
						<div class="content-panel__status-illust">
								<picture class="content-panel__picture">
										<img src="<?=SITE_TEMPLATE_PATH?>/mockup/dist/assets/blocks/content-panel/images/check.svg" data-src="assets/blocks/content-panel/images/check.svg" width="100" height="100" alt="Готово!" class="content-panel__image lazyload lazyload_entered lazyload_loaded" title="" data-ll-status="loaded">
								</picture>
						</div>
						<div class="content-panel__text">
								<p>
										На ваш e-mail отправлена ссылка для восстановления пароля
								</p>
						</div>
				</div>

				<div class="content-panel__controls">
						<div class="content-panel__control">
								<!-- begin .button-->
								<a class="button button_width_full button_size_s" href="<?=AUTH_URL.$backURLParam?>">
										<span class="button__holder">Вернуться ко входу</span>
								</a>
								<!-- end .button-->
						</div>
				</div>
		</div>
	</div>
	<!-- end .content-panel -->
</div>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>