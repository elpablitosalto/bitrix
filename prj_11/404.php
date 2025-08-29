<?
include_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/urlrewrite.php');

CHTTP::SetStatus("404 Not Found");
@define("ERROR_404","Y");

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

$APPLICATION->SetTitle("Страница не найдена");
?>

<div class="page__holder">
  <!-- begin .not-found-->
  <div class="not-found page__not-found">
    <div class="not-found__content">
      <div class="not-found__heading">
        <h1 class="not-found__title">
          404
        </h1>
        <? $APPLICATION->IncludeFile(
          SITE_TEMPLATE_PATH . "/include/404/label.php",
          Array(),
          Array(
            "MODE" => "html",
            "NAME" => "404_LABEL"
          )
        ); ?>
      </div>
      <div class="not-found__text">
        <? $APPLICATION->IncludeFile(
          SITE_TEMPLATE_PATH . "/include/404/text.php",
          Array(),
          Array(
            "MODE" => "html",
            "NAME" => "404_TEXT"
          )
        ); ?>
      </div>
      <div class="not-found__controls">
        <div class="not-found__control">
          <!-- begin .button-->
          <a class="button" href="/">
            <span class="button__holder">
              <span class="button__text">
                <? $APPLICATION->IncludeFile(
                  SITE_TEMPLATE_PATH . "/include/404/button-text.php",
                  Array(),
                  Array(
                    "MODE" => "html",
                    "NAME" => "404_BUTTON_TEXT"
                  )
                ); ?>
              </span>
            </span>
          </a>
          <!-- end .button-->
        </div>
      </div>
    </div>
    <? $APPLICATION->IncludeFile(
      SITE_TEMPLATE_PATH . "/include/404/image.php",
      Array(),
      Array(
        "MODE" => "html",
        "NAME" => "404_IMAGE"
      )
    ); ?>
  </div>
  <!-- end .not-found-->
</div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>