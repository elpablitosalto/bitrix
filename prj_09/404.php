<?
define('REMOVE_H1_TITLE', true);
include_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/urlrewrite.php');

CHTTP::SetStatus("404 Not Found");
@define("ERROR_404","Y");

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

$APPLICATION->SetTitle("Страница не найдена");
$APPLICATION->SetPageProperty("keywords", "Страница не найдена");
$APPLICATION->SetPageProperty("description", "Страница не найдена");
?>

<div class="section__not-found">
	<!-- begin .not-found-->
	<div class="not-found">
			<div class="not-found__illustration">
					<picture class="not-found__picture">
							<img
									src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw=="
									data-src="<?= SITE_TEMPLATE_PATH ?>/mockup_bk/dist/assets/blocks/not-found/images/404.svg"
									width="150"
									height="175"
									alt="Страница не найдена"
									class="not-found__image lazyload"
							/>
					</picture>
			</div>
			<div class="not-found__content">
					<div class="not-found__title">
							<!-- begin .title-->
							<h1 class="title title_size_h1">Страница не найдена</h1>
							<!-- end .title-->
					</div>
					<div class="not-found__text">
							Мы сожалеем, но страница, на которую вы пытаетесь перейти, не существует.
							Пожалуйста вернитесь на главную страницу или воспользуйтесь меню сайта.
					</div>
					<div class="not-found__controls">
							<div class="not-found__control">
									<!-- begin .button-->
									<a
											class="button button_width_full button_text-size_l button_size_l"
											href="/"
									>
											<span class="button__holder">На главную</span>
									</a>
									<!-- end .button-->
							</div>
					</div>
			</div>
	</div>
	<!-- end .not-found-->
</div>

<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");
?>