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

<div class="dp-modal dp-modal-questionnaire" id="modal-questionnaire">
    <div class="dp-modal__overlay"></div>
    <div class="dp-modal__dialog">
        <div class="dp-modal__header">
            <button class="dp-back-btn dp-form-questionnaire-back" type="button">
                <svg class="icon icon-back ">
                    <use xlink:href="#back"></use>
                </svg><span>Назад</span>
            </button>
            <div class="dp-form-questionnaire-progress">
                <div class="dp-form-questionnaire-progress__scale"><span class="dp-form-questionnaire-progress__percent">0%</span></div>
            </div>
            <button class="dp-modal__close" type="button">
                <svg class="icon icon-cross ">
                    <use xlink:href="#cross"></use>
                </svg>
            </button>
        </div>
        <div class="dp-modal__body">
            <form class="dp-form dp-form-questionnaire ajax-form" id="form-questionnaire" method="post" action="#">
                <input type="hidden" name="form_id" value="<?= $arParams["FORM_ID"] ?>">
                <?= bitrix_sessid_post() ?>
                <div class="dp-form-questionnaire-step" data-step="0">
                    <div class="dp-form-questionnaire-step__header">
                        <h3 class="dp-form-questionnaire-step__title">Получите бесплатно индивидуальную подборку материалов от Академии «Врач будущего»</h3>
                        <div class="dp-form-questionnaire-step__desc">
                            <p>Ответьте на 10 вопросов и получите доступ к&nbsp;персональной экспертной подборке на&nbsp;сайте — будет доступна в&nbsp;вашем личном кабинете.</p>
                        </div>
                    </div>
                    <div class="dp-form-questionnaire-step__footer">
                        <button class="dp-btn dp-btn_orange dp-form-questionnaire__next" type="button">Получить</button>
                    </div>
                </div>
                <div class="dp-form-questionnaire-step dp-form-questionnaire-step_required" data-step="1">
                    <div class="dp-form-questionnaire-step__header">
                        <h3 class="dp-form-questionnaire-step__title">Ваша трудовая деятельность связана с:</h3>
                        <div class="dp-form-questionnaire-step__desc">
                            <p>Вы можете выбрать несколько вариантов</p>
                        </div>
                    </div>
                    <div class="dp-form-questionnaire-step__body">
                        <div class="row justify-content-md-center">
                            <?foreach($arResult["ENUMS"]["WORK"] as $arEnum){?>
                                <div class="col-md-auto">
                                    <div class="dp-field dp-form-questionnaire-checkbox">
                                        <input id="dpfq-step-1-checkbox-<?=$arEnum["UF_XML_ID"]?>" type="checkbox" value="<?=$arEnum["UF_XML_ID"]?>" name="PROPERTY_WORK[]">
                                        <label for="dpfq-step-1-checkbox-<?=$arEnum["UF_XML_ID"]?>"><?=$arEnum["UF_NAME"]?></label>
                                    </div>
                                </div>
                            <?}?>
                        </div>
                    </div>
                    <div class="dp-form-questionnaire-step__footer">
                        <button class="dp-btn dp-btn_orange dp-form-questionnaire__next" type="button" disabled>Далее</button>
                    </div>
                </div>
                <div class="dp-form-questionnaire-step" data-step="2">
                    <div class="dp-form-questionnaire-step__header">
                        <h3 class="dp-form-questionnaire-step__title">Насколько вы считаете важным усилить у себя</h3>
                    </div>
                    <div class="dp-form-questionnaire-step__body">
						<p class="dp-form-questionnaire-field-title">Профессиональные знания по&nbsp;вашей специальности</p>
                        <div class="dp-field dp-form-questionnaire-range">
                            <input class="dp-form-range" type="text" name="PROPERTY_STR1" value="6" data-min="0" data-max="10">
                        </div>
                        <p class="dp-form-questionnaire-field-title">Непрофессиональные компетенции, такие как общение с&nbsp;пациентами, навыки публичных выступлений и&nbsp;навыки саморегуляции</p>
                        <div class="dp-field dp-form-questionnaire-range">
                            <input class="dp-form-range" type="text" name="PROPERTY_STR2" value="4" data-min="0" data-max="10">
                        </div>
                    </div>
                    <div class="dp-form-questionnaire-step__footer">
                        <button class="dp-btn dp-btn_orange dp-form-questionnaire__next" type="button">Далее</button>
                        <button class="dp-btn dp-btn_magnolia dp-form-questionnaire__skip" type="button">Пропустить</button>
                    </div>
                </div>
                <div class="dp-form-questionnaire-step" data-step="3">
                    <div class="dp-form-questionnaire-step__header">
                        <h3 class="dp-form-questionnaire-step__title">Для чего вам важно усилить профессиональные знания в первую очередь:</h3>
                        <div class="dp-form-questionnaire-step__desc">
                            <p>Вы можете выбрать несколько вариантов</p>
                        </div>
                    </div>
                    <div class="dp-form-questionnaire-step__body">
                        <div class="row">
                            <?foreach($arResult["ENUMS"]["REASON"] as $arEnum){?>
                            <div class="col-md-4">
                                <div class="dp-field dp-form-questionnaire-checkbox dp-form-questionnaire-checkbox-img">
                                    <input id="dpfq-step-3-checkbox-<?=$arEnum["UF_XML_ID"]?>" type="checkbox" value="<?=$arEnum["UF_XML_ID"]?>" name="PROPERTY_REASON[]">
                                    <label for="dpfq-step-3-checkbox-<?=$arEnum["UF_XML_ID"]?>"><span><img src="<?=CFile::GetPath($arEnum["UF_FILE"])?>" alt=""></span><span><?=$arEnum["UF_NAME"]?></span></label>
                                </div>
                            </div>
                            <?}?>
                        </div>
                    </div>
                    <div class="dp-form-questionnaire-step__footer">
                        <button class="dp-btn dp-btn_orange dp-form-questionnaire__next" type="button">Далее</button>
                        <button class="dp-btn dp-btn_magnolia dp-form-questionnaire__skip" type="button">Пропустить</button>
                    </div>
                </div>
                <div class="dp-form-questionnaire-step dp-form-questionnaire-step_required" data-step="4" data-nav="4">
                    <div class="dp-form-questionnaire-step__header">
                        <h3 class="dp-form-questionnaire-step__title">Для чего вам развивать надпрофессиональные компетенции в первую очередь:</h3>
                        <div class="dp-form-questionnaire-step__desc">
                            <p>Вы можете выбрать несколько вариантов</p>
                        </div>
                    </div>
                    <div class="dp-form-questionnaire-step__body">
                        <?foreach($arResult["ENUMS"]["REASON2"] as $arEnum){?>
                            <div class="dp-field dp-form-questionnaire-checkbox">
                                <input id="dpfq-step-4-checkbox-<?=$arEnum["UF_XML_ID"]?>" value="<?=$arEnum["UF_XML_ID"]?>" type="checkbox" name="PROPERTY_REASON2[]">
                                <label for="dpfq-step-4-checkbox-<?=$arEnum["UF_XML_ID"]?>"><?=$arEnum["UF_NAME"]?></label>
                            </div>
                        <?}?>
                    </div>
                    <div class="dp-form-questionnaire-step__footer">
                        <button class="dp-btn dp-btn_orange dp-form-questionnaire__next" type="button" disabled>Далее</button>
                    </div>
                </div>
                <div class="dp-form-questionnaire-step dp-form-questionnaire-step_required" data-step="5" data-nav="5">
                    <div class="dp-form-questionnaire-step__header">
                        <h3 class="dp-form-questionnaire-step__title">Представьте, что прямо сейчас вы овладели надпрофессиональными компетенциями в совершенстве. Какой результат вы увидите в первую очередь?</h3>
                        <div class="dp-form-questionnaire-step__desc">
                            <p>Вы можете выбрать несколько вариантов</p>
                        </div>
                    </div>
                    <div class="dp-form-questionnaire-step__body">
                        <?foreach($arResult["ENUMS"]["REASON_RESULT"] as $arEnum){?>
                            <div class="dp-field dp-form-questionnaire-checkbox">
                                <input id="dpfq-step-5-checkbox-<?=$arEnum["UF_XML_ID"]?>" value="<?=$arEnum["UF_XML_ID"]?>" type="checkbox" name="PROPERTY_REASON_RESULT[]">
                                <label for="dpfq-step-5-checkbox-<?=$arEnum["UF_XML_ID"]?>"><?=$arEnum["UF_NAME"]?></label>
                            </div>
                        <?}?>
                    </div>
                    <div class="dp-form-questionnaire-step__footer">
                        <button class="dp-btn dp-btn_orange dp-form-questionnaire__next" type="button" disabled>Далее</button>
                    </div>
                </div>
                <div class="dp-form-questionnaire-step" data-step="6">
                    <div class="dp-form-questionnaire-step__header">
                        <h3 class="dp-form-questionnaire-step__title">Как вы взаимодействуете с пациентом?</h3>
                        <div class="dp-form-questionnaire-step__desc">
                            <p>Вы можете выбрать только один вариант</p>
                        </div>
                    </div>
                    <div class="dp-form-questionnaire-step__body">
                        <div class="row">
                            <?foreach($arResult["ENUMS"]["PACIENT_TYPE"] as $arEnum){?>
                                <div class="col-sm-6">
                                    <div class="dp-field dp-form-questionnaire-checkbox dp-form-questionnaire-checkbox-img">
                                        <input id="dpfq-step-6-radio-<?=$arEnum["UF_XML_ID"]?>" type="radio" value="<?=$arEnum["UF_XML_ID"]?>" name="PROPERTY_PACIENT_TYPE">
                                        <label for="dpfq-step-6-radio-<?=$arEnum["UF_XML_ID"]?>"><span><img src="<?=CFile::GetPath($arEnum["UF_FILE"])?>" alt=""></span><span><?=$arEnum["UF_NAME"]?></span></label>
                                    </div>
                                </div>
                            <?}?>
                        </div>
                    </div>
                    <div class="dp-form-questionnaire-step__footer">
                        <button class="dp-btn dp-btn_orange dp-form-questionnaire__next" type="button">Далее</button>
                        <button class="dp-btn dp-btn_magnolia dp-form-questionnaire__skip" type="button">Пропустить</button>
                    </div>
                </div>
                <div class="dp-form-questionnaire-step dp-form-questionnaire-step_required" data-step="7" data-nav="7">
                    <div class="dp-form-questionnaire-step__header">
                        <h3 class="dp-form-questionnaire-step__title">Выберите темы, которые считаете наиболее полезными для себя прямо сейчас:</h3>
                        <div class="dp-form-questionnaire-step__desc">
                            <p>Вы можете выбрать несколько вариантов</p>
                        </div>
                    </div>
                    <div class="dp-form-questionnaire-step__body">
                        <div class="row justify-content-md-center">
                            <?foreach($arResult["ENUMS"]["THEMES"] as $arEnum){?>
                                <div class="col-md-auto">
                                    <div class="dp-field dp-form-questionnaire-checkbox">
                                        <input id="dpfq-step-7-checkbox-<?=$arEnum["UF_XML_ID"]?>" type="checkbox" value="<?=$arEnum["UF_XML_ID"]?>" name="PROPERTY_THEMES[]">
                                        <label for="dpfq-step-7-checkbox-<?=$arEnum["UF_XML_ID"]?>"><?=$arEnum["UF_NAME"]?></label>
                                    </div>
                                </div>
                            <?}?>
                        </div>
                    </div>
                    <div class="dp-form-questionnaire-step__footer">
                        <button class="dp-btn dp-btn_orange dp-form-questionnaire__next" type="button" disabled>Далее</button>
                    </div>
                </div>
                <div class="dp-form-questionnaire-step" data-step="8">
                    <div class="dp-form-questionnaire-step__header">
                        <h3 class="dp-form-questionnaire-step__title">Как вам сейчас удобнее получать новые знания?</h3>
                        <div class="dp-form-questionnaire-step__desc">
                            <p>Вы можете выбрать несколько вариантов</p>
                        </div>
                    </div>
                    <div class="dp-form-questionnaire-step__body">
                        <div class="row">
                            <?foreach($arResult["ENUMS"]["HOW_GET"] as $arEnum){?>
                            <div class="col-md-6">
                                <div class="dp-field dp-form-questionnaire-checkbox dp-form-questionnaire-checkbox-icon">
                                    <input id="dpfq-step-8-checkbox-<?=$arEnum["ID"]?>" value="<?=$arEnum["ID"]?>" type="checkbox" name="PROPERTY_HOW_GET[]">
                                    <label for="dpfq-step-8-checkbox-<?=$arEnum["ID"]?>">
                                        <svg class="icon icon-<?=$arEnum["XML_ID"]?> ">
                                            <use xlink:href="#<?=$arEnum["XML_ID"]?>"></use>
                                        </svg><span><?=$arEnum["VALUE"]?></span>
                                    </label>
                                </div>
                            </div>
                            <?}?>
                        </div>
                    </div>
                    <div class="dp-form-questionnaire-step__footer">
                        <button class="dp-btn dp-btn_orange dp-form-questionnaire__next" type="button">Далее</button>
                        <button class="dp-btn dp-btn_magnolia dp-form-questionnaire__skip" type="button">Пропустить</button>
                    </div>
                </div>
                <div class="dp-form-questionnaire-step" data-step="9">
                    <div class="dp-form-questionnaire-step__header">
                        <h3 class="dp-form-questionnaire-step__title">Вы хотите получать персонализированные материалы по e-mail?</h3>
                        <div class="dp-form-questionnaire-step__desc">
                            <p>Мы отправим вам на почту ссылки на статьи, курсы, которые соответствуют вашим интересам, сразу после завершения регистрации. А также мы будем отправлять вам подборки с новыми материалами по вашей специальности и по вашим интересам.</p>
                        </div>
                    </div>
                    <div class="dp-form-questionnaire-step__footer">
                        <button class="dp-btn dp-btn_orange dp-form-questionnaire__next" type="button" data-related-step="9-1">Да</button>
                        <button class="dp-btn dp-btn_magnolia dp-form-questionnaire__skip" type="button">Нет</button>
                    </div>
                </div>
                <div class="dp-form-questionnaire-step dp-form-questionnaire-step_required" data-master-step="9" data-related-step="9-1">
                    <div class="dp-form-questionnaire-step__header">
                        <h3 class="dp-form-questionnaire-step__title">Как часто хотите получать рассылку?</h3>
                    </div>
                    <div class="dp-form-questionnaire-step__body">
                        <?foreach($arResult["ENUMS"]["MATERISLAS_DATE"] as $arEnum){?>
                        <div class="dp-field dp-form-questionnaire-checkbox">
                            <input id="dpfq-step-9-1-checkbox-<?=$arEnum["ID"]?>" value="<?=$arEnum["ID"]?>" type="checkbox" name="PROPERTY_MATERISLAS_DATE[]">
                            <label for="dpfq-step-9-1-checkbox-<?=$arEnum["ID"]?>"><?=$arEnum["VALUE"]?></label>
                        </div>
                        <?}?>
                    </div>
                    <div class="dp-form-questionnaire-step__footer">
                        <button class="dp-btn dp-btn_orange dp-form-questionnaire__next" type="button" disabled>Далее</button>
                    </div>
                </div>
                <div class="dp-form-questionnaire-step" data-step="10">
                    <div class="dp-form-questionnaire-step__header">
                        <h3 class="dp-form-questionnaire-step__title">Готово!</h3>
                        <div class="dp-form-questionnaire-step__desc">
                            <p>Чтобы ознакомиться с персональными рекомендациями, перейдите  в личный кабинет</p>
                        </div>
                    </div>
                    <div class="dp-form-questionnaire-step__footer">
                        <button class="dp-btn dp-btn_orange dp-form-questionnaire__submit" type="submit">Перейти в личный кабинет</button>
                    </div>
                    <div class="main_error"></div>
                    <div class="msg"></div>
                </div>
            </form>
        </div>
    </div>
</div>
