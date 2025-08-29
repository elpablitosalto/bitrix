<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();?>
<div class="dp-modal dp-get-course-modal" id="free-lesson-modal">
	<div class="dp-modal__overlay"></div>
	<div class="dp-modal__dialog">
		<button class="dp-modal__close" type="button">
			<svg class="icon icon-cross ">
				<use xlink:href="#cross"></use>
			</svg>
		</button>
		<div class="dp-modal__header">
			<div class="dp-modal__title">Пробный урок курса «Трудный пациент»</div>
		</div>
		<div class="dp-modal__body">
			<form class="dp-form dp-form-get-course" id="form-tp-free" method="post" action="#">
				<div class="dp-form__body">
					<input type="hidden" name="cource" value="Курс «Трудный пациент»">
					<input type="hidden" name="url" value="https://vrachbudushego.ru/courses/trydnii_pacient/">
					<div class="dp-field">
						<input type="email" name="email" placeholder="E-mail" required>
					</div>
					<div class="dp-field">
						<p class="dp-field__title">Специальность</p>
						<select class="dp-form-select" name="specialisation" required>
							<option value="1" selected>Терапевт/ВОП</option>
							<option value="2">Гинеколог</option>
							<option value="3">Детский невролог</option>
							<option value="4">Офтальмолог</option>
							<option value="5">Прочие</option>
							<option value="6">Провизор/Фармацевт</option>
							<option value="7">Уролог</option>
							<option value="8">Эндокринолог</option>
							<option value="9">Детский психиатр</option>
						</select>
					</div>
					<div class="dp-field">
						<input class="iti-input js-iti-input" type="tel" name="tel">
					</div>
					<div class="dp-field">
						<input type="text" name="name" placeholder="Имя" required>
					</div>
				</div>
				<div class="dp-form__footer">
					<div class="dp-form__actions">
						<button class="dp-btn dp-form__submit" type="submit">Получить доступ</button>
					</div>
					<div class="dp-field dp-field_agreement">
						<input id="fсf-agreement" type="checkbox" name="fсf-agreement">
						<label for="fсf-agreement"></label><span>Я согласен на&nbsp;обработку моих персональных данных в&nbsp;соответствии с&nbsp;<a href="#" target="_blank">Договором оферты</a> и&nbsp;<a href="/privacy/" target="_blank">Политикой Конфиденциальности</a></span>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>