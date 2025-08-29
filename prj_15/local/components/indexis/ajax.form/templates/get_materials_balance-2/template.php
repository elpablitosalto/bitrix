<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
?>


<div class="dp-get-course-program-section">
    <div class="dp-get-course-program">
        <div class="container">
            <p class="dp-get-course-program__title">Запишитесь на курс</p>
            <div class="row align-items-md-center">
                <div class="col-md-6">
                    <div class="dp-get-course-program__img"><img src="<?=SITE_TEMPLATE_PATH?>/img/content/tilda/get-course-program-img.png" alt=""></div>
                </div>
                <div class="col-md-6">
                    <form class="dp-form dp-get-course-program-form ajax-form" action="">
                        <input type="hidden" name="form_id" value="<?= $arParams["FORM_ID"] ?>">
                        <?= bitrix_sessid_post() ?>
                        <div class="dp-get-course-program-form__inner">
                            <div class="dp-form__body">
                                <div class="dp-field">
                                    <input type="text" name="NAME" placeholder="Имя Отчество" required="">
                                </div>
                                <div class="dp-field">
                                    <input type="email" name="PROPERTY_EMAIL" placeholder="E-mail" required="">
                                </div>
                            </div>
                            <div class="dp-form__footer">
                                <button class="dp-btn dp-form__submit" type="submit">Получить программу</button>
                            </div>
                            <div class="main_error"></div>
                            <div class="msg"></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>