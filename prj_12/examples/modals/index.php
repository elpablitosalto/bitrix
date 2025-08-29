<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php"); ?>
<div class="nb-pages-list">
	<div class="container">
		<section class="nb-pages-list-section nb-pages-list-menu-section">
			<h2 class="nb-pages-list-section__title">Модалки</h2>
			<ol class="nb-pages-list-menu">
				<li><a href="#modal-call" data-modal>Окно с формой обратной связи</a></li>
				<li><a href="#modal-call-success" data-modal>Окно с тестом об успешной отправке</a></li>
			</ol>
		</section>
	</div>
</div>
<div class="nb-modal nb-modal_bg nb-modal-call" id="modal-call">
	<div class="nb-modal__overlay"></div>
	<div class="nb-modal__dialog">
		<button class="nb-modal__close" type="button">
			<svg class="icon icon-cross ">
				<use xlink:href="#cross"></use>
			</svg>
		</button>
		<div class="nb-modal__body">
			<div class="nb-modal-call__img">
				<div class="nb-modal-call__img-wrapper"><img src="<?=SITE_TEMPLATE_PATH?>/img/design/modal-operator-1.jpg" alt=""></div>
			</div>
			<div class="nb-modal-call__form">
				<form class="nb-form nb-modal-call-form" action="#">
					<div class="nb-form__body">
						<div class="nb-form__fields">
							<div class="nb-form-field">
								<input id="cf-2-name" type="text" name="name" placeholder="Как к вам обращаться">
								<label for="cf-2-name">Как к Вам обращаться</label>
							</div>
							<div class="nb-form-field">
								<input id="cf-2-phone" type="tel" name="tel" placeholder="+7 (999) 999-99-99">
								<label for="cf-2-phone">Укажите ваш номер</label>
							</div>
						</div>
						<div class="nb-form__actions">
							<button class="nb-btn nb-form__submit" type="submit">Записаться</button>
						</div>
					</div>
				</form>
				<div class="nb-modal-call__desc">
					<p>Вы также можете позвонить по телефону и уточнить любую интересующую вас информацию</p>
				</div>
				<div class="nb-modal-call__phone"><a href="tel:+74957836606">+7 (495) 783-66-06</a></div>
				<p class="nb-modal-call__agreement">Нажимая на&nbsp;кнопку «Записаться» вы соглашаетесь на&nbsp;обработку персональных данных</p>
			</div>
		</div>
	</div>
</div>
<div class="nb-modal nb-modal_bg nb-modal-call nb-modal-call-success" id="modal-call-success">
	<div class="nb-modal__overlay"></div>
	<div class="nb-modal__dialog">
		<button class="nb-modal__close" type="button">
			<svg class="icon icon-cross ">
				<use xlink:href="#cross"></use>
			</svg>
		</button>
		<div class="nb-modal__body">
			<p class="nb-modal-call__title nb-modal-call__title_mobile">Мысвяжемся с вами в&nbsp;ближайшее время для&nbsp;подтверждения записи на&nbsp;приём</p>
			<div class="nb-modal-call__img">
				<div class="nb-modal-call__img-wrapper"><img src="<?=SITE_TEMPLATE_PATH?>/img/design/modal-operator-2.jpg" alt=""></div>
			</div>
			<div class="nb-modal-call__form">
				<h3 class="nb-modal-call__title nb-modal-call__title_desktop">Мысвяжемся с вами в&nbsp;ближайшее время для&nbsp;подтверждения записи на&nbsp;приём</h3>
				<div class="nb-modal-call__phone">
					<p class="nb-modal-call__phone-title">Ещё больше информации вы можете узнать&nbsp;по&nbsp;телефону</p><a href="tel:+74957836606">+7 (495) 783-66-06</a>
				</div>
				<button class="nb-btn nb-modal__close-btn" type="button">Закрыть</button>
			</div>
		</div>
	</div>
</div>

<?
/*
$APPLICATION->SetTitle("nebolno");?><?$APPLICATION->IncludeComponent(
	"indexis:page.constructor",
	"",
	Array(
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"SECTION_ID" => "404"
	)
);
*/
?>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>