<?
if (!defined('LIKE_HOME')) {
  define('LIKE_HOME', 'N');
}
?>
<? if (!$isHomePage && !$isSearchPage && LIKE_HOME != 'Y') { ?>
  <?
  if (!defined('PAGE_TYPE')) {
    define('PAGE_TYPE', 1);
  }
  if (!defined('MENU_TYPE')) {
    define('MENU_TYPE', 1);
  }
  if (!defined('PAGE_COLUMNS_COUNT')) {
    define('PAGE_COLUMNS_COUNT', 2);
  }
  if (!defined('SHOW_COLUMNS_IN_HEADER')) {
    define('SHOW_COLUMNS_IN_HEADER', 'Y');
  }
  if (!defined('SHOW_TELEGRAM_SUBSCRIBE')) {
    define('SHOW_TELEGRAM_SUBSCRIBE', 'Y');
  }
  ?>
  <? if (PAGE_COLUMNS_COUNT == 1) { ?>
    </div>
    </div>
    </section>
  <? } ?>
  <? if (PAGE_COLUMNS_COUNT == 2) { ?>
    <? if (MENU_TYPE == 1) { ?>
      <div class="dp-content-aside">
        <div class="dp-aside-menu">
          <? $APPLICATION->IncludeComponent(
            "bitrix:menu",
            "leftside",
            array(
              "ROOT_MENU_TYPE" => "leftside",
              "MAX_LEVEL" => "1",
              "CHILD_MENU_TYPE" => "",
              "USE_EXT" => "N",
              "DELAY" => "N",
              "ALLOW_MULTI_SELECT" => "Y",
              "MENU_CACHE_TYPE" => "N",
              "MENU_CACHE_TIME" => "3600",
              "MENU_CACHE_USE_GROUPS" => "Y",
              "MENU_CACHE_GET_VARS" => ""
            )
          ); ?>
        </div>
      </div>
    <? } ?>

    <? if (SHOW_TELEGRAM_SUBSCRIBE == 'Y') { ?>
      <? $APPLICATION->IncludeComponent(
        "bitrix:main.include",
        "",
        array(
          "AREA_FILE_SHOW" => "file",
          "PATH" => SITE_TEMPLATE_PATH . "/include/blocks/common/telegram_subscribe.php"
        )
      ); ?>
    <? } ?>

    <? if (SHOW_COLUMNS_IN_HEADER == 'Y') { ?>
      </div>
      </div>
      </div>
    <? } ?>
    </div>
    </div>
  <? } ?>
  </main>
<? } ?>

<footer class="dp-footer">
  <div class="container">
    <div class="dp-footer-top">
      <div class="dp-footer-company">МАФ маркет</div>
      <nav class="dp-footer-menu">
        <? $APPLICATION->IncludeComponent(
          "bitrix:menu",
          "footer_top",
          array(
            "ROOT_MENU_TYPE" => "footer_top",
            "MAX_LEVEL" => "1",
            "CHILD_MENU_TYPE" => "",
            "USE_EXT" => "N",
            "DELAY" => "N",
            "ALLOW_MULTI_SELECT" => "Y",
            "MENU_CACHE_TYPE" => "N",
            "MENU_CACHE_TIME" => "3600",
            "MENU_CACHE_USE_GROUPS" => "Y",
            "MENU_CACHE_GET_VARS" => ""
          )
        ); ?>
      </nav>
      <div class="dp-footer-image"><img src="<?= SITE_TEMPLATE_PATH ?>/img/design/footer-image.png" alt="МАФ маркет" width="866" height="400"></div>
    </div>
    <div class="dp-footer-middle">
      <div class="row">
        <div class="col-sm-12 col-lg-8">
          <div class="dp-footer-address">119571, Москва, Ленинский проспект,<br>121/1, строение 2, офис 218,<br>метро Тропарёво</div>
        </div>
        <div class="col-lg-8 dp-footer-col_social">
          <div class="dp-footer-social">
            <? $APPLICATION->IncludeComponent(
              "bitrix:menu",
              "footer_social",
              array(
                "ROOT_MENU_TYPE" => "footer_social",
                "MAX_LEVEL" => "1",
                "CHILD_MENU_TYPE" => "",
                "USE_EXT" => "N",
                "DELAY" => "N",
                "ALLOW_MULTI_SELECT" => "Y",
                "MENU_CACHE_TYPE" => "N",
                "MENU_CACHE_TIME" => "3600",
                "MENU_CACHE_USE_GROUPS" => "Y",
                "MENU_CACHE_GET_VARS" => ""
              )
            ); ?>
          </div>
        </div>
        <div class="col-sm-12 col-lg-8">
          <div class="dp-footer-contacts"><a class="dp-footer-contacts__link" href="tel:+74999689608 ">+7 499 968 96 08</a><br><a class="dp-footer-contacts__link" href="mailto:info77@mafmarket.ru">info77@mafmarket.ru</a></div>
        </div>
      </div>
    </div>
    <div class="dp-footer-bottom">
      <div class="row">
        <div class="col-sm-auto">
          <div class="dp-footer-copyright">© 2023 ООО «Светосила М»</div>
        </div>
        <div class="col-sm-auto">
          <div class="dp-footer-privacy"><a href="#">Политика конфиденциальности</a></div>
        </div>
        <div class="col-sm-auto">
          <div class="dp-footer-developer">Разработано в <a href="https://indexis.ru/" target="_blank">Indexis</a>
          </div>
        </div>
        <div class="col-24">
          <div class="dp-footer-info">Обращаем Ваше внимание на то, что вся представленная на сайте информация носит информационный характер и ни при каких условиях не является офертой, определяемой положениями Гражданского кодекса Российской Федерации.<br>Опубликованная на страницах данного сайта информация, продукция и её изображения являются объектом прав интеллектуальной собственности ООО «Светосила М».<br>Использование изображений, фотографий и текстов, а также прочей информации с сайта, возможно только с письменного согласия ООО «Светосила М». Случаи незаконного использования информации будут преследоваться по закону.<br>Изображение товара на сайте может отличаться от фактического изображения товара.</div>
        </div>
      </div>
    </div>
  </div>
</footer>
</div>
<div class="dp-modals">
  <div class="display-none" id="modal-search">
    <div class="dp-header">
      <div class="container">
        <div class="dp-header__inner">
          <a class="dp-header-logo" href="/">
            <img class="dp-header-logo__img" src="<?= SITE_TEMPLATE_PATH ?>/img/design/logo.svg" alt="МАФ маркет" width="240" height="50">
          </a>
          <button class="search__wrapper_close"></button>
        </div>
      </div>
    </div>
    <div class="dp-page">
      <div class="container">
        <div class="dp-section__body">
          <div class="search__wrapper">
            <form action="/search/" method="get">
              <input class="search__input" name="q" type="search" placeholder="Искать изделия, коллекции, ...">
              <button class="search__button" type="submit">
                <svg width="56" height="56">
                  <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/img/icons/sprite/svg-sprite.svg#search"></use>
                </svg>
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <? $APPLICATION->IncludeComponent(
    "bitrix:system.auth.form",
    "mafmarket",
    array(
      "FORGOT_PASSWORD_URL" => "/auth/forget.php",
      "PROFILE_URL" => "/profile/",
      "REGISTER_URL" => "/auth/registration.php",
      "SHOW_ERRORS" => "N"
    )
  ); ?>

  <? $APPLICATION->IncludeComponent(
    "bitrix:main.register",
    "mafmarket",
    array(
      "AUTH" => "Y",
      "REQUIRED_FIELDS" => array("EMAIL", "NAME"),
      "SET_TITLE" => "N",
      "SHOW_FIELDS" => array("NAME", 'LAST_NAME', "EMAIL", 'PERSONAL_MOBILE', "PASSWORD", "CONFIRM_PASSWORD"),
      //"SUCCESS_PAGE" => "/profile/",
      "SUCCESS_PAGE" => '',
      "USER_PROPERTY" => array(),
      "USER_PROPERTY_NAME" => "",
      "USE_BACKURL" => "N"
    )
  ); ?>

  <? $APPLICATION->IncludeComponent(
    "bitrix:system.auth.forgotpasswd",
    "mafmarket",
    array("SHOW_ERRORS" => 'Y')
  ); ?>

  <? $APPLICATION->IncludeComponent(
    "bitrix:system.auth.changepasswd",
    "mafmarket",
    array("SHOW_ERRORS" => 'Y')
  ); ?>

  <div class="dp-modal" id="modal-mega">
    <div class="dp-modal__overlay"></div>
    <div class="mega">
      <div class="mega__wrapper">
        <button class="mega__close" type="button">
          <svg class="icon icon-cross ">
            <use xlink:href="#cross"></use>
          </svg>
        </button>
        <div class="mega__menu">
          <div class="mega__contacts"><a href="tel:+74999689608">+7 499 968 96 08</a><a href="mailto:info77@mafmarket.ru">info77@mafmarket.ru</a></div>
          <? $APPLICATION->IncludeComponent(
            "bitrix:menu",
            "mega_left",
            array(
              "ROOT_MENU_TYPE" => "mega_left",
              "MAX_LEVEL" => "1",
              "CHILD_MENU_TYPE" => "",
              "USE_EXT" => "N",
              "DELAY" => "N",
              "ALLOW_MULTI_SELECT" => "Y",
              "MENU_CACHE_TYPE" => "N",
              "MENU_CACHE_TIME" => "3600",
              "MENU_CACHE_USE_GROUPS" => "Y",
              "MENU_CACHE_GET_VARS" => ""
            )
          ); ?>
        </div>
        <div class="mega__menus">
          <div class="mega__name-enters">
            <a class="mega__name-enter js_open_login_popup" href="/profile/">
              <svg class="icon icon-account ">
                <use xlink:href="#account"></use>
              </svg><? if (!($USER->IsAuthorized())) { ?>Вход<? } else { ?>Личный кабинет<? } ?>
            </a>
          </div>
          <? $APPLICATION->IncludeComponent(
            "bitrix:menu",
            "mega_right_about",
            array(
              "ROOT_MENU_TYPE" => "mega_right_about",
              "MAX_LEVEL" => "1",
              "CHILD_MENU_TYPE" => "",
              "USE_EXT" => "N",
              "DELAY" => "N",
              "ALLOW_MULTI_SELECT" => "Y",
              "MENU_CACHE_TYPE" => "N",
              "MENU_CACHE_TIME" => "3600",
              "MENU_CACHE_USE_GROUPS" => "Y",
              "MENU_CACHE_GET_VARS" => ""
            )
          ); ?>
          <? $APPLICATION->IncludeComponent(
            "bitrix:menu",
            "mega_right_service",
            array(
              "ROOT_MENU_TYPE" => "mega_right_service",
              "MAX_LEVEL" => "1",
              "CHILD_MENU_TYPE" => "",
              "USE_EXT" => "N",
              "DELAY" => "N",
              "ALLOW_MULTI_SELECT" => "Y",
              "MENU_CACHE_TYPE" => "N",
              "MENU_CACHE_TIME" => "3600",
              "MENU_CACHE_USE_GROUPS" => "Y",
              "MENU_CACHE_GET_VARS" => ""
            )
          ); ?>
        </div>
      </div>
    </div>
  </div>
</div>
</body>

</html>