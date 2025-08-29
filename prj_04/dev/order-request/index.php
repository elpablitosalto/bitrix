<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "CONCEPT  | Профессиональная косметика для волос");
$APPLICATION->SetTitle("Форма оставить заявку");
?>
<section class="content">
	<br>
	<br>
	<br>
	<div class="container">
		<a href="#orderRequestWide" class="button button_type_enhanced button_caps_normal" data-popup>Широкая форма в модальном окне</a>
	</div>
	<br>
	<div class="container">
		<a href="#orderRequest" class="button button_type_enhanced button_caps_normal" data-popup>Форма в модальном окне</a>
	</div>
	<br>
	<br>
	<br>
	<div class="container">
		<div class="form-wrapper form-wrapper_type_enhanced panel-form">
			<div class="panel-form__inputs">
				<form>
					<div class="form-wrapper__header">
						<h3 class="form-wrapper__heading">ОСТАВИТЬ ЗАЯВКУ</h3>
						<p class="form-wrapper__description">Заполните форму, и наши специалисты ответят вам в течение 48 часов</p>
					</div>
					<div class="form-wrapper__inputs">
						<div class="form-wrapper__item">
							<label>Ваше имя*</label>
							<input type="text" required="">
							<span class="error"></span>
						</div>
						<div class="form-wrapper__item">
							<label>Телефон*</label>
							<input type="tel" required="">
							<span class="error"></span>
						</div>
						<div class="form-wrapper__item">
							<label>Город*</label>
							<input type="text" required="" placeholder="Начните вводить название города...">
							<span class="error"></span>
						</div>
						<div class="form-wrapper__item">
							<label>Адрес салона*</label>
							<input type="text" required="">
							<span class="error"></span>
						</div>
						<div class="form-wrapper__item form-wrapper__item-checkbox">
								<input id="suggestion" type="checkbox" name="suggestion" required="">
								<label for="suggestion">Нажимая на кнопку, вы соглашаетесь с <a href="#">условиями обработки персональных данных.</a>
								</label>
						</div>
					</div>
					<div class="form-wrapper__submit">
						<div class="form-wrapper__item _align-center">
							<button type="submit" class="button button_type_enhanced button_caps_normal">Отправить заявку</button>
						</div>
					</div>
				</form>
			</div>
			<div class="panel-form__illustration">
				<img src="../../images/dev/panel-form.jpg" alt="image" class="panel-form__image">
				<div class="panel-form__label">Насыщенный цвет <br>без вреда для волос</div>
			</div>
		</div>
	</div>
	<br>
	<br>
	<br>
	<div class="container">
		<div class="form-wrapper form-wrapper_type_enhanced form-wrapper_type_panel">
			<form>
				<div class="form-wrapper__header">
					<h3 class="form-wrapper__heading">ОСТАВИТЬ ЗАЯВКУ</h3>
					<p class="form-wrapper__description">Заполните форму, и наши специалисты ответят вам в течение 48 часов</p>
				</div>
				<div class="form-wrapper__inputs">
					<div class="form-wrapper__item">
						<label>Ваше имя*</label>
						<input type="text" required="">
						<span class="error"></span>
					</div>
					<div class="form-wrapper__item">
						<label>Телефон*</label>
						<input type="tel" required="">
						<span class="error"></span>
					</div>
					<div class="form-wrapper__item">
						<label>Город*</label>
						<input type="text" required="" placeholder="Начните вводить название города...">
						<span class="error"></span>
					</div>
					<div class="form-wrapper__item">
						<label>Адрес салона*</label>
						<input type="text" required="">
						<span class="error"></span>
					</div>
					<div class="form-wrapper__item form-wrapper__item-checkbox">
							<input id="suggestion" type="checkbox" name="suggestion" required="">
							<label for="suggestion">Нажимая на кнопку, вы соглашаетесь с <a href="#">условиями обработки персональных данных.</a>
							</label>
					</div>
				</div>
				<div class="form-wrapper__submit">
					<div class="form-wrapper__item _align-center">
						<button type="submit" class="button button_type_enhanced button_caps_normal">Отправить заявку</button>
					</div>
				</div>
			</form>
		</div>
	</div>
	<br>
	<br>
	<br>

<div id="orderRequestWide" class="popup popup_type_enhanced popup_width_l mfp-hide">
    <div class="form-wrapper form-wrapper_type_enhanced panel-form">
        <div class="panel-form__inputs">
            <form>
                <div class="form-wrapper__header">
                    <h3 class="form-wrapper__heading">ОСТАВИТЬ ЗАЯВКУ</h3>
                    <p class="form-wrapper__description">Заполните форму, и наши специалисты ответят вам в течение 48 часов</p>
                </div>
                <div class="form-wrapper__inputs">
                    <div class="form-wrapper__item">
                        <label>Ваше имя*</label>
                        <input type="text" required="">
                        <span class="error"></span>
                    </div>
                    <div class="form-wrapper__item">
                        <label>Телефон*</label>
                        <input type="tel" required="">
                        <span class="error"></span>
                    </div>
                    <div class="form-wrapper__item">
                        <label>Город*</label>
                        <input type="text" required="" placeholder="Начните вводить название города...">
                        <span class="error"></span>
                    </div>
                    <div class="form-wrapper__item">
                        <label>Адрес салона*</label>
                        <input type="text" required="">
                        <span class="error"></span>
                    </div>
                    <div class="form-wrapper__item form-wrapper__item-checkbox">
                            <input id="suggestion" type="checkbox" name="suggestion" required="">
                            <label for="suggestion">Нажимая на кнопку, вы соглашаетесь с <a href="#">условиями обработки персональных данных.</a>
                            </label>
                    </div>
                </div>
                <div class="form-wrapper__submit">
                    <div class="form-wrapper__item _align-center">
                        <button type="submit" class="button button_type_enhanced button_caps_normal">Отправить заявку</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="panel-form__illustration">
            <img src="../../images/dev/panel-form.jpg" alt="image" class="panel-form__image">
            <div class="panel-form__label">Насыщенный цвет <br>без вреда для волос</div>
        </div>
    </div>
</div>

<div id="orderRequest" class="popup popup_type_enhanced popup_width_m mfp-hide">
    <div class="form-wrapper form-wrapper_type_enhanced form-wrapper_type_panel">
        <form>
            <div class="form-wrapper__header">
                <h3 class="form-wrapper__heading">ОСТАВИТЬ ЗАЯВКУ</h3>
                <p class="form-wrapper__description">Заполните форму, и наши специалисты ответят вам в течение 48 часов</p>
            </div>
            <div class="form-wrapper__inputs">
                <div class="form-wrapper__item">
                    <label>Ваше имя*</label>
                    <input type="text" required="">
                    <span class="error"></span>
                </div>
                <div class="form-wrapper__item">
                    <label>Телефон*</label>
                    <input type="tel" required="">
                    <span class="error"></span>
                </div>
                <div class="form-wrapper__item">
                    <label>Город*</label>
                    <input type="text" required="" placeholder="Начните вводить название города...">
                    <span class="error"></span>
                </div>
                <div class="form-wrapper__item">
                    <label>Адрес салона*</label>
                    <input type="text" required="">
                    <span class="error"></span>
                </div>
                <div class="form-wrapper__item form-wrapper__item-checkbox">
                        <input id="suggestion" type="checkbox" name="suggestion" required="">
                        <label for="suggestion">Нажимая на кнопку, вы соглашаетесь с <a href="#">условиями обработки персональных данных.</a>
                        </label>
                </div>
            </div>
            <div class="form-wrapper__submit">
                <div class="form-wrapper__item _align-center">
                    <button type="submit" class="button button_type_enhanced button_caps_normal">Отправить заявку</button>
                </div>
            </div>
        </form>
    </div>
</div>
</section>
<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");
?>