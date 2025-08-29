<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();?>
<div class="dp-modal dp-get-course-modal" id="tariff-optima-pay-modal">
	<div class="dp-modal__overlay"></div>
	<div class="dp-modal__dialog">
		<button class="dp-modal__close" type="button">
			<svg class="icon icon-cross ">
				<use xlink:href="#cross"></use>
			</svg>
		</button>
		<div class="dp-modal__header">
			<p class="dp-modal__title">Курс «Эмоциональное выгорание. Основы баланса»</p>
			<p class="dp-modal__tariff">Тариф «Оптима»</p>
			<p class="dp-modal__price">5 990 ₽</p>
		</div>
		<div class="dp-modal__body">
			<form class="dp-form dp-form-get-course" id="form-tariff-optima-pay" method="post" action="#">
				<div class="dp-form__body">
					<input type="hidden" name="cource" value="Курс «Эмоциональное выгорание. Основы баланса»">
					<input type="hidden" name="url" value="https://vrachbudushego.ru/courses/vygoranie_osnovybalansa/">
					<input type="hidden" name="tariff" value="Оптима">
					<input type="hidden" name="paymentType" value="Полная оплата">
					<input type="hidden" name="price" value="5990">
					<div class="dp-field">
						<input type="email" name="email" placeholder="E-mail" required>
					</div>
					<div class="dp-field">
						<input type="text" name="name" placeholder="Имя" required>
					</div>
					<div class="dp-field">
						<input class="iti-input js-iti-input" type="tel" name="tel">
					</div>
				</div>
				<div class="dp-form__footer">
					<div class="dp-form__actions">
						<button class="dp-btn dp-form__submit" type="submit">Оплатить</button>
					</div>
					<div class="dp-field dp-field_agreement">
						<input id="ftop-agreement" type="checkbox" name="ftop-agreement">
						<label for="ftop-agreement"></label><span>Я согласен на&nbsp;обработку моих персональных данных в&nbsp;соответствии с&nbsp;<a href="#" target="_blank">Договором оферты</a> и&nbsp;<a href="/privacy/" target="_blank">Политикой Конфиденциальности</a></span>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>