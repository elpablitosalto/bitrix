<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Контакты");
?>
<script type="application/ld+json">
<?
$arr = array(
  "@context" => "https://schema.org",
  "@type" => "Organization",
  "url" => "https://{$_SERVER["SERVER_NAME"]}",
  "email" => "hello@noboring-finance.ru",
  "logo" => "https://{$_SERVER["SERVER_NAME"]}/local/templates/nfinance/assets/blocks/logo/images/main.svg",
  "telephone" => "+7 (800) 551-85-81",
  "contactPoint" =>
    [
      "@type" => "ContactPoint",
      "contactType" => "customer support",
      "telephone" => "+7 (800) 551-85-81",
      "email" => "hello@noboring-finance.ru"
    ],
  "sameAs" => array(
    "https://www.youtube.com/channel/UCrnbF6Vp5q1kg-Y4OgYckJQ",
    "https://t.me/noboring_finance",
    "https://t.me/findicommunity",
    "https://www.youtube.com/@predprinimatel22",
    "https://vk.com/noboring_finance"
  )
);

echo json_encode($arr, JSON_UNESCAPED_UNICODE);
?>
</script>
    <div class="page__content-top">
        <div class="page__holder">
            <div class="page__top-wrapper">
                <div class="page__breadcrumbs">
                    <!-- begin .breadcrumbs-->
                    <? $APPLICATION->IncludeComponent("bitrix:breadcrumb", "main",
                        Array(
                            "START_FROM" => "0",
                            "SITE_ID" => "s1"
                        )
                    ); ?>
                    <!-- end .breadcrumbs-->
                </div>
            </div>
        </div>
    </div>
    <div class="page__section">
        <div class="page__holder">
            <!-- begin .section-->
            <div class="section section_space_top-close">
                <div class="section__header">
                    <div class="section__title">
                        <!-- begin .title-->
                        <h1 class="title title_size_h2">
                            <?=$APPLICATION->ShowTitle()?>
                        </h1>
                        <!-- end .title-->
                    </div>
                </div>
                <div class="section__content">
                    <!-- begin .panel-group-->
                    <div class="panel-group section__panel-group">
                        <ul class="panel-group__list">
                            <li class="panel-group__item">
                                <!-- begin .panel-->
                                <? $APPLICATION->IncludeFile(SITE_TEMPLATE_PATH . "/include/contacts/sales.php",
                                    Array(),
                                    Array("MODE" => "html", "NAME" => "CONTACT_SALES")
                                ); ?>
                                <!-- end .panel-->
                            </li>
                            <li class="panel-group__item">
                                <!-- begin .panel-->
                                <? $APPLICATION->IncludeFile(SITE_TEMPLATE_PATH . "/include/contacts/quality.php",
                                    Array(),
                                    Array("MODE" => "html", "NAME" => "CONTACT_QUALITY")
                                ); ?>
                                <!-- end .panel-->
                            </li>
                            <li class="panel-group__item">
                                <!-- begin .panel-->
                                <? $APPLICATION->IncludeFile(SITE_TEMPLATE_PATH . "/include/contacts/hr.php",
                                    Array(),
                                    Array("MODE" => "html", "NAME" => "CONTACT_HR")
                                ); ?>
                                <!-- end .panel-->
                            </li>
                        </ul>
                        <div class="panel-group__main">
                            <!-- begin .panel-->
                            <div class="panel panel_size_l">
                                <div class="panel__title">Подпишитесь на нас
                                </div>
                                <div class="panel__content">
                                    <div class="panel__entry-grid">
                                        <!-- begin .entry-grid-->
                                        <? $APPLICATION->IncludeFile(SITE_TEMPLATE_PATH . "/include/contacts/follow_us.php",
                                            Array(),
                                            Array("MODE" => "html", "NAME" => "FOLLOW_US")
                                        ); ?>
                                        <!-- end .entry-grid-->
                                    </div>
                                </div>
                            </div>
                            <!-- end .panel-->
                        </div>
                    </div>
                    <!-- end .panel-group-->
                </div>
            </div>
            <!-- end .section-->
        </div>
    </div>
    <div class="page__section">
        <div class="page__holder">
            <!-- begin .section-->
            <div class="section section_space_top-close">
                <div class="section__content">
                    <div class="panel-form section__panel-form">
                        <div class="panel-form__content">
                            <div class="panel-form__illustration">
                                <div class="panel-form__icon-wrapper"><svg class="panel-form__icon" width="34" height="34" viewBox="0 0 34 34" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M12.0009 27.6667L15.4 32.2C16.2 33.2667 17.8 33.2667 18.6 32.2L21.9991 27.6667H27.6667C30.6124 27.6667 33 25.2791 33 22.3333V6.33333C33 3.38756 30.6124 1 27.6667 1H6.33333C3.38756 1 1 3.38756 1 6.33333V22.3333C1 25.2791 3.38756 27.6667 6.33333 27.6667H12.0009Z" stroke="#1D24CD" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path fill-rule="evenodd" clip-rule="evenodd" d="M17 9.63262C17.6347 8.91617 18.7333 8.11084 20.4062 8.11084C23.3342 8.11084 25.2969 10.758 25.2969 13.2255C25.2969 18.3811 18.6409 22.3331 17 22.3331C15.3591 22.3331 8.70312 18.3811 8.70312 13.2255C8.70312 10.758 10.6658 8.11084 13.5938 8.11084C15.2667 8.11084 16.3653 8.91617 17 9.63262Z" stroke="#1D24CD" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                </div>
                            </div>
                            <div class="panel-form__title">
                                <!-- begin .title-->
                                <h2 class="title title_size_h2">Остались вопросы?
                                </h2>
                                <!-- end .title-->
                            </div>
                            <div class="panel-form__text"><span class="highlight">Свяжитесь с нами,</span> мы с радостью ответим на ваши вопросы
                            </div>
                        </div>
                        <div class="panel-form__form">
                            <?$APPLICATION->IncludeComponent(
                                "waim:feedback.form",
                                "content",
                                array(
                                    "BACKGROUND_COLOR" => "#FFFFFF",
                                    "BUTTON_TEXT" => "Отправить",
                                    "DESCRIPTION" => "Наш менеджер свяжется с вами и проконсультирует по деталям записи!",
                                    "ERROR_DESCRIPTION" => "Попробуйте повторить отправку позднее",
                                    "ERROR_TITLE" => "Произошла ошибка :(",
                                    "FORM_TYPE" => "Запись на мероприятие",
                                    "POLICY_LINK" => "/policy/",
                                    "POLICY_LINK_CLASS" => "",
                                    "POLICY_LINK_TEXT" => "политикой конфиденциальности",
                                    "POLICY_TEXT" => "Нажимая на кнопку, вы соглашаетесь с %s",
                                    "SUCCESS_DESCRIPTION" => "Менеджер свяжется с вами в ближайшее время",
                                    "SUCCESS_TITLE" => "Спасибо! Данные отправлены успешно",
                                    "TITLE" => "Получить больше<br> информации об условиях",
                                    "TITLE_HIGHLIGHT" => "",
                                    "WEB_FORM_ID" => 4,
                                    "MODAL_ID" => "",
                                    "COMPONENT_TEMPLATE" => "content"
                                ),
                                false
                            );?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end .section-->
        </div>
    </div>
    <div class="page__section page__section_decoration_bottom">
        <!-- begin .section-->
        <div class="section section_space_close">
            <div class="section__content">
                <div class="section__following">
                    <!-- begin .following-->
                    <div class="following">
                        <div class="following__container swiper js-following-carousel">
                            <div class="following__wrapper swiper-wrapper">
                                <? $APPLICATION->IncludeFile(SITE_TEMPLATE_PATH . "/include/text_carousel/main.php",
                                    Array(),
                                    Array("MODE" => "html", "NAME" => "TEXT_CAROUSEL")
                                ); ?>
                            </div>
                        </div>
                    </div>
                    <!-- end .following-->
                </div>
            </div>
        </div>
        <!-- end .section-->
    </div>
<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>