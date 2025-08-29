<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();?>
<div class="dp-modal dp-get-course-modal" id="event-registration-modal-3">
	<div class="dp-modal__overlay"></div>
	<div class="dp-modal__dialog">
		<button class="dp-modal__close" type="button">
			<svg class="icon icon-cross ">
				<use xlink:href="#cross"></use>
			</svg>
		</button>
		<div class="dp-modal__header">
			<div class="dp-modal__title">Регистрация на&nbsp;мероприятие «Нейроэндокринная система и&nbsp;пептидная биорегуляция»</div>
		</div>
		<div class="dp-modal__body">
			<form class="dp-form dp-form-get-course" id="form-event-registration-3" method="post" action="#">
				<div class="dp-form__body">
					<input type="hidden" name="event" value="Код жизни. Вебинар «Нейроэндокринная система и пептидная биорегуляция»">
					<input type="hidden" name="url" value="https://vrachbudushego.ru/kodjizni/">
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
						<input type="text" name="firstName" placeholder="Имя" required>
					</div>
					<div class="dp-field">
						<input type="text" name="secondName" placeholder="Фамилия" required>
					</div>
					<div class="dp-field">
						<input class="iti-input js-iti-input" type="tel" name="tel">
					</div>
				</div>
				<div class="dp-form__footer">
					<div class="dp-form__actions">
						<button class="dp-btn dp-form__submit" type="submit">Зарегистрироваться</button>
					</div>
					<p class="dp-form__agreement-text">Нажимая на кнопку, я принимаю <a href="/licence/" target="_blank">Лицензионное соглашение</a>, подтверждаю, что ознакомлен с <a href="/privacy/" target="_blank">Политикой ООО ГЕРОФАРМ в отношении обработки персональных данных</a>, и даю <a href="/privacy/">Согласие</a> на их обработку.</p>
				</div>
			</form>
		</div>
	</div>
</div>