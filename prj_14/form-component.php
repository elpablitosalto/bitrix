<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Компонент формы | VATE");
?>


<div class="page__container">
	<div class="page__section">
		<div class="section section_style_filled">
			<div class="section__main">
				<div class="section__content">
					<? $APPLICATION->IncludeComponent(
						"waim:feedback.form",
						".default",
						array(
							"FORM_ID" => "1",
							"RECAPTCHA_SITE_KEY" => RECAPTCHA_SITE_KEY,
							"RECAPTCHA_SECRET_KEY" => RECAPTCHA_SECRET_KEY,
							"RECAPTCHA_SCORE" => RECAPTCHA_SCORE,
							"SUCCESS_TITLE" => "Успешный успех",
							"SUCCESS_TEXT" => "Описание успешного успеха",
							"COMPONENT_TEMPLATE" => ".default",
							"BUTTON_TEXT" => "Отправить",
							"SUCCESS_DESCRIPTION" => "Наш менеджер свяжется с вами",
							"ERROR_TITLE" => "Произошла ошибка :(",
							"ERROR_DESCRIPTION" => "Попробуйте повторить отправку позднее",
							"TITLE" => "Остались вопросы?",
							"DESCRIPTION" => "Описание формы",
							"USE_RECAPTCHA" => "Y"
						),
						$component
					); ?>
				</div>
			</div>
		</div>
	</div>
</div>


<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>