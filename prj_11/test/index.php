<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Тестовая страница");
?><div class="page__content-top">
	<div class="page__holder">
		<div class="page__top-wrapper">
			<div class="page__breadcrumbs">
				 <?$APPLICATION->IncludeComponent(
	"bitrix:breadcrumb",
	"main",
	Array(
		"SITE_ID" => "s1",
		"START_FROM" => "0"
	)
);?>
			</div>
		</div>
	</div>
</div>
<div class="page__section">
	<div class="page__holder">
		<div class="section section_space_much">
			<div class="section__header">
				<div class="section__title">
					<h1 class="title title_size_h2">Тестовая страница</h1>
				</div>
			</div>
		</div>
		<div class="section__content">
			<div class="article page__article">
				<div class="article__content">
					<div class="article__main">
						<?$APPLICATION->IncludeComponent(
	"waim:subscribe.form",
	".default",
	array(
		"WEB_FORM_ID" => "5",
		"BACKGROUND_COLOR" => "#E04D4D",
		"BUTTON_TEXT" => "Получить",
		"DESCRIPTION" => "Введите email для подписки на рассылку",
		"ERROR_DESCRIPTION" => "Попробуйте повторить отправку позднее",
		"ERROR_TITLE" => "Произошла ошибка :(",
		"IMAGE" => "/upload/medialibrary/6ec/vx2qd4k20cv3ca8appthc26f25n12zjs.png",
		"PLACEHOLDER" => "Введите ваш E-mail",
		"POLICY_LINK" => "/policy/",
		"POLICY_LINK_TEXT" => "политикой конфиденциальности",
		"POLICY_LINK_CLASS" => "link link_style_light",
		"POLICY_TEXT" => "Нажимая на кнопку, вы соглашаетесь с %s",
		"PRESET" => "A",
		"SUCCESS_DESCRIPTION" => "Материал летит к вам на почту",
		"SUCCESS_TITLE" => "Спасибо! Мы получили вашу заявку!",
		"TITLE" => "Подписаться",
		"COMPONENT_TEMPLATE" => ".default",
		"FORM_TYPE" => "Форма 1555"
	),
	false
);?>
	<?$APPLICATION->IncludeComponent(
		"waim:subscribe.form",
		".default",
		array(
			"WEB_FORM_ID" => "5",
			"BACKGROUND_COLOR" => "#E04D4D",
			"BUTTON_TEXT" => "Отправить",
			"DESCRIPTION" => "Введите email для подписки на рассылку",
			"ERROR_DESCRIPTION" => "Попробуйте повторить отправку позднее",
			"ERROR_TITLE" => "Произошла ошибка :(",
			"IMAGE" => "",
			"PLACEHOLDER" => "Введите ваш E-mail",
			"POLICY_LINK" => "/policy/",
			"POLICY_LINK_TEXT" => "политикой конфиденциальности",
			"POLICY_LINK_CLASS" => "link link_style_light",
			"POLICY_TEXT" => "Нажимая на кнопку, вы соглашаетесь с %s",
			"PRESET" => "B",
			"SUCCESS_DESCRIPTION" => "Материал летит к вам на почту",
			"SUCCESS_TITLE" => "Спасибо! Мы получили вашу заявку!",
			"TITLE" => "Подписаться на email рассылку",
			"COMPONENT_TEMPLATE" => ".default",
			"FORM_TYPE" => "Форма 1",
		),
		false
	);?>

<?$APPLICATION->IncludeComponent(
	"waim:subscribe.form", 
	".default", 
	array(
		"WEB_FORM_ID" => "5",
		"BACKGROUND_COLOR" => "#E04D4D",
		"BUTTON_TEXT" => "Отправить",
		"DESCRIPTION" => "Введите email для подписки на рассылку",
		"ERROR_DESCRIPTION" => "Попробуйте повторить отправку позднее",
		"ERROR_TITLE" => "Произошла ошибка :(",
		"IMAGE" => "",
		"PLACEHOLDER" => "Введите ваш E-mail",
		"POLICY_LINK" => "/policy/",
		"POLICY_LINK_TEXT" => "политикой конфиденциальности",
		"POLICY_LINK_CLASS" => "link link_style_light",
		"POLICY_TEXT" => "Нажимая на кнопку, вы соглашаетесь с %s",
		"PRESET" => "C",
		"SUCCESS_DESCRIPTION" => "Материал летит к вам на почту",
		"SUCCESS_TITLE" => "Спасибо! Мы получили вашу заявку!",
		"TITLE" => "Подписаться на email рассылку",
		"COMPONENT_TEMPLATE" => ".default",
		"FORM_TYPE" => "Шаблон ОПиУ"
	),
	false
);?>


<?$APPLICATION->IncludeComponent(
	"waim:subscribe.form",
	".default",
	array(
		"WEB_FORM_ID" => "5",
		"BACKGROUND_COLOR" => "#E04D4D",
		"BUTTON_TEXT" => "Отправить",
		"DESCRIPTION" => "Введите email для подписки на рассылку",
		"ERROR_DESCRIPTION" => "Попробуйте повторить отправку позднее",
		"ERROR_TITLE" => "Произошла ошибка :(",
		"IMAGE" => "",
		"PLACEHOLDER" => "Введите ваш E-mail",
		"POLICY_LINK" => "/policy/",
		"POLICY_LINK_TEXT" => "политикой конфиденциальности",
		"POLICY_LINK_CLASS" => "link link_style_light",
		"POLICY_TEXT" => "Нажимая на кнопку, вы соглашаетесь с %s",
		"PRESET" => "D",
		"SUCCESS_DESCRIPTION" => "Материал летит к вам на почту",
		"SUCCESS_TITLE" => "Спасибо! Мы получили вашу заявку!",
		"TITLE" => "Подписаться на email рассылку",
		"COMPONENT_TEMPLATE" => ".default",
		"FORM_TYPE" => "Форма 1"
	),
	false
);?>


<?$APPLICATION->IncludeComponent(
	"waim:subscribe.form",
	".default",
	array(
		"WEB_FORM_ID" => "5",
		"BACKGROUND_COLOR" => "#E04D4D",
		"BUTTON_TEXT" => "Отправить",
		"DESCRIPTION" => "Введите email для подписки на рассылку",
		"ERROR_DESCRIPTION" => "Попробуйте повторить отправку позднее",
		"ERROR_TITLE" => "Произошла ошибка :(",
		"IMAGE" => "",
		"PLACEHOLDER" => "Введите ваш E-mail",
		"POLICY_LINK" => "/policy/",
		"POLICY_LINK_TEXT" => "политикой конфиденциальности",
		"POLICY_LINK_CLASS" => "link link_style_light",
		"POLICY_TEXT" => "Нажимая на кнопку, вы соглашаетесь с %s",
		"PRESET" => "E",
		"SUCCESS_DESCRIPTION" => "Материал летит к вам на почту",
		"SUCCESS_TITLE" => "Спасибо! Мы получили вашу заявку!",
		"TITLE" => "Подписаться на email рассылку",
		"COMPONENT_TEMPLATE" => ".default",
		"FORM_TYPE" => "Форма 2"
	),
	false
);?>


<?$APPLICATION->IncludeComponent(
	"waim:subscribe.form",
	".default",
	array(
		"WEB_FORM_ID" => "5",
		"BACKGROUND_COLOR" => "#E04D4D",
		"BUTTON_TEXT" => "Отправить",
		"DESCRIPTION" => "Введите email для подписки на рассылку",
		"ERROR_DESCRIPTION" => "Попробуйте повторить отправку позднее",
		"ERROR_TITLE" => "Произошла ошибка :(",
		"IMAGE" => "",
		"PLACEHOLDER" => "Введите ваш E-mail",
		"POLICY_LINK" => "/policy/",
		"POLICY_LINK_TEXT" => "политикой конфиденциальности",
		"POLICY_TEXT" => "Нажимая на кнопку, вы соглашаетесь с %s",
		"PRESET" => "F",
		"SUCCESS_DESCRIPTION" => "Материал летит к вам на почту",
		"SUCCESS_TITLE" => "Спасибо! Мы получили вашу заявку!",
		"TITLE" => "Подписаться на email рассылку",
		"COMPONENT_TEMPLATE" => ".default",
		"FORM_TYPE" => "Форма 3"
	),
	false
);?>


<?$APPLICATION->IncludeComponent(
	"waim:subscribe.form",
	".default",
	array(
		"WEB_FORM_ID" => "5",
		"BACKGROUND_COLOR" => "#E04D4D",
		"BUTTON_TEXT" => "Отправить",
		"DESCRIPTION" => "Введите email для подписки на рассылку",
		"ERROR_DESCRIPTION" => "Попробуйте повторить отправку позднее",
		"ERROR_TITLE" => "Произошла ошибка :(",
		"IMAGE" => "",
		"PLACEHOLDER" => "Введите ваш E-mail",
		"POLICY_LINK" => "/policy/",
		"POLICY_LINK_TEXT" => "политикой конфиденциальности",
		"POLICY_TEXT" => "Нажимая на кнопку, вы соглашаетесь с %s",
		"PRESET" => "G",
		"SUCCESS_DESCRIPTION" => "Материал летит к вам на почту",
		"SUCCESS_TITLE" => "Спасибо! Мы получили вашу заявку!",
		"TITLE" => "Подписаться на email рассылку",
		"COMPONENT_TEMPLATE" => ".default",
		"FORM_TYPE" => "Форма 4"
	),
	false
);?>


<?$APPLICATION->IncludeComponent(
	"waim:subscribe.form",
	".default",
	array(
		"WEB_FORM_ID" => "5",
		"BACKGROUND_COLOR" => "#E04D4D",
		"BUTTON_TEXT" => "Отправить",
		"DESCRIPTION" => "Введите email для подписки на рассылку",
		"ERROR_DESCRIPTION" => "Попробуйте повторить отправку позднее",
		"ERROR_TITLE" => "Произошла ошибка :(",
		"IMAGE" => "",
		"PLACEHOLDER" => "Введите ваш E-mail",
		"POLICY_LINK" => "/policy/",
		"POLICY_LINK_TEXT" => "политикой конфиденциальности",
		"POLICY_TEXT" => "Нажимая на кнопку, вы соглашаетесь с %s",
		"PRESET" => "H",
		"SUCCESS_DESCRIPTION" => "Материал летит к вам на почту",
		"SUCCESS_TITLE" => "Спасибо! Мы получили вашу заявку!",
		"FORM_TYPE" => "Форма 5",
		"TITLE" => "Подписаться на email рассылку",
		"COMPONENT_TEMPLATE" => ".default"
	),
	false
);?>

<?$APPLICATION->IncludeComponent(
	"waim:subscribe.form",
	".default",
	array(
		"WEB_FORM_ID" => "5",
		"BACKGROUND_COLOR" => "#E04D4D",
		"BUTTON_TEXT" => "Отправить",
		"DESCRIPTION" => "Введите email для подписки на рассылку",
		"ERROR_DESCRIPTION" => "Попробуйте повторить отправку позднее",
		"ERROR_TITLE" => "Произошла ошибка :(",
		"IMAGE" => "",
		"PLACEHOLDER" => "Введите ваш E-mail",
		"POLICY_LINK" => "/policy/",
		"POLICY_LINK_TEXT" => "политикой конфиденциальности",
		"POLICY_TEXT" => "Нажимая на кнопку, вы соглашаетесь с %s",
		"PRESET" => "I",
		"SUCCESS_DESCRIPTION" => "Материал летит к вам на почту",
		"SUCCESS_TITLE" => "Спасибо! Мы получили вашу заявку!",
		"TITLE" => "Подписаться на email рассылку",
		"COMPONENT_TEMPLATE" => ".default",
		"FORM_TYPE" => "Форма 6"
	),
	false
);?>


<?$APPLICATION->IncludeComponent(
	"waim:subscribe.form",
	".default",
	array(
		"WEB_FORM_ID" => "5",
		"BACKGROUND_COLOR" => "#E04D4D",
		"BUTTON_TEXT" => "Отправить",
		"DESCRIPTION" => "Введите email для подписки на рассылку",
		"ERROR_DESCRIPTION" => "Попробуйте повторить отправку позднее",
		"ERROR_TITLE" => "Произошла ошибка :(",
		"IMAGE" => "",
		"PLACEHOLDER" => "Введите ваш E-mail",
		"POLICY_LINK" => "/policy/",
		"POLICY_LINK_TEXT" => "политикой конфиденциальности",
		"POLICY_TEXT" => "Нажимая на кнопку, вы соглашаетесь с %s",
		"PRESET" => "J",
		"SUCCESS_DESCRIPTION" => "Материал летит к вам на почту",
		"SUCCESS_TITLE" => "Спасибо! Мы получили вашу заявку!",
		"TITLE" => "Подписаться на email рассылку",
		"COMPONENT_TEMPLATE" => ".default",
		"FORM_TYPE" => "Форма 7"
	),
	false
);?>

<?$APPLICATION->IncludeComponent(
	"waim:subscribe.form",
	".default",
	array(
		"WEB_FORM_ID" => "5",
		"BACKGROUND_COLOR" => "#5CD1DF",
		"BUTTON_TEXT" => "Подписаться",
		"DESCRIPTION" => "Введите email для подписки на рассылку",
		"ERROR_DESCRIPTION" => "Попробуйте повторить отправку позднее",
		"ERROR_TITLE" => "Произошла ошибка :(",
		"IMAGE" => "",
		"PLACEHOLDER" => "E-mail",
		"POLICY_LINK" => "https://leads.noboring-finance.ru/policy ",
		"POLICY_LINK_TEXT" => "политикой",
		"POLICY_LINK_CLASS" => "link link_style_light",
		"POLICY_TEXT" => "Согласен с %s",
		"PRESET" => "NONE",
		"SUCCESS_DESCRIPTION" => "Материал летит к вам на почту",
		"SUCCESS_TITLE" => "Спасибо! Мы получили вашу заявку!",
		"TITLE" => "Подписаться на email рассылку",
		"COMPONENT_TEMPLATE" => ".default",
		"FORM_TYPE" => ""
	),
	false
);?>


<?$APPLICATION->IncludeComponent(
	"waim:subscribe.form",
	".default",
	array(
		"WEB_FORM_ID" => "5",
		"BACKGROUND_COLOR" => "#A6DC00",
		"BUTTON_TEXT" => "Подписаться",
		"DESCRIPTION" => "Введите email для подписки на рассылку",
		"ERROR_DESCRIPTION" => "Попробуйте повторить отправку позднее",
		"ERROR_TITLE" => "Произошла ошибка :(",
		"IMAGE" => "/upload/medialibrary/e0c/2qmerllhdyoqo3z3zf2q1ki362hs58ji.png",
		"PLACEHOLDER" => "E-mail",
		"POLICY_LINK" => "https://leads.noboring-finance.ru/policy ",
		"POLICY_LINK_TEXT" => "политикой",
		"POLICY_LINK_CLASS" => "link link_style_light",
		"POLICY_TEXT" => "Согласен с %s",
		"PRESET" => "C",
		"SUCCESS_DESCRIPTION" => "Материал летит к вам на почту",
		"SUCCESS_TITLE" => "Подписка оформлена!",
		"TITLE" => "Подписаться на email рассылку",
		"COMPONENT_TEMPLATE" => ".default",
		"FORM_TYPE" => "Форма 81"
	),
	false
);?>
					</div>
					<div class="article__aside"></div>
					<div class="article__banners"></div>
				</div>
			</div>
		</div>
	</div>
</div>
<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>