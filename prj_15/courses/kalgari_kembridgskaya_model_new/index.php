<?
define('SET_OG_MARKING', 'Y');
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$title = "Курс | Общение с пациентом по Калгари-Кембриджской модели";
$APPLICATION->SetPageProperty("description", 'Дистанционный курс по эффективной медицинской коммуникации с пациентом поможет вам структурировать медицинскую консультацию по Калгари-Кембриджской модели. Познакомитесь с программой курса. Пройдите бесплатный урок и получите скрипт, как начать консультацию.');
$APPLICATION->SetPageProperty("keywords", 'калгари кембриджская, калгари кембриджская модель консультации, калгари кембриджская система, кембриджская модель медицинской консультации, калгари кембриджская модель общения, калгари кембриджская модель коммуникации, калгари кембриджская модель с пациентами, калгари, кембриджское руководство, калгари кембриджская система, кембриджская модель общения врач пациент');
$GLOBALS['OG_TMP']['OG_TITLE'] = $title;
$APPLICATION->SetTitle($title);

?>
<script>
    $(function() {
        mindboxViewProduct("GetCourse_4665137");
    });
</script>

<?
$APPLICATION->IncludeFile(
    SITE_DIR . 'include/section/kkm_new/block_01.php',
    array(),
    array('SHOW_BORDER' => false)
);
?>
<?
$APPLICATION->IncludeFile(
    SITE_DIR . 'include/section/kkm_new/block_02.php',
    array(),
    array('SHOW_BORDER' => false)
);
?>
<?
$APPLICATION->IncludeFile(
    SITE_DIR . 'include/section/kkm_new/block_03.php',
    array(),
    array('SHOW_BORDER' => false)
);
?>
<?
$APPLICATION->IncludeFile(
    SITE_DIR . 'include/section/kkm_new/block_04.php',
    array(),
    array('SHOW_BORDER' => false)
);
?>
<?
$APPLICATION->IncludeFile(
    SITE_DIR . 'include/section/kkm_new/block_05.php',
    array(),
    array('SHOW_BORDER' => false)
);
?>
<?
$APPLICATION->IncludeFile(
    SITE_DIR . 'include/section/kkm_new/block_06.php',
    array(),
    array('SHOW_BORDER' => false)
);
?>
<?
$APPLICATION->IncludeFile(
    SITE_DIR . 'include/section/kkm_new/block_07.php',
    array(),
    array('SHOW_BORDER' => false)
);
?>
<?
$APPLICATION->IncludeFile(
    SITE_DIR . 'include/section/kkm_new/block_08.php',
    array(),
    array('SHOW_BORDER' => false)
);
?>
<?
$APPLICATION->IncludeFile(
    SITE_DIR . 'include/section/kkm_new/block_09.php',
    array(),
    array('SHOW_BORDER' => false)
);
?>
<?
$APPLICATION->IncludeFile(
    SITE_DIR . 'include/section/kkm_new/block_10.php',
    array(),
    array('SHOW_BORDER' => false)
);
?>
<?
$APPLICATION->IncludeFile(
    SITE_DIR . 'include/section/kkm_new/block_11.php',
    array(),
    array('SHOW_BORDER' => false)
);
?>
<?
$APPLICATION->IncludeFile(
    SITE_DIR . 'include/section/kkm_new/block_12.php',
    array(),
    array('SHOW_BORDER' => false)
);
?>
<?
$APPLICATION->IncludeFile(
    SITE_DIR . 'include/section/kkm_new/block_13.php',
    array(),
    array('SHOW_BORDER' => false)
);
?>
<?
$APPLICATION->IncludeFile(
    SITE_DIR . 'include/section/kkm_new/block_14.php',
    array(),
    array('SHOW_BORDER' => false)
);
?>
<?
$APPLICATION->IncludeFile(
    SITE_DIR . 'include/section/kkm_new/block_15.php',
    array(),
    array('SHOW_BORDER' => false)
);
?>
<?/*?>
<?
$APPLICATION->IncludeFile(
    SITE_DIR . 'include/section/kkm_new/block_16.php',
    array(),
    array('SHOW_BORDER' => false)
);
?>
<?*/?>
<?
$APPLICATION->IncludeFile(
    SITE_DIR . 'include/section/kkm_new/block_17.php',
    array(),
    array('SHOW_BORDER' => false)
);
?>
<?
$APPLICATION->IncludeFile(
    SITE_DIR . 'include/section/kkm_new/block_18.php',
    array(),
    array('SHOW_BORDER' => false)
);
?>
<?
$APPLICATION->IncludeFile(
    SITE_DIR . 'include/section/kkm_new/block_19.php',
    array(),
    array('SHOW_BORDER' => false)
);
?>
<?
$APPLICATION->IncludeFile(
    SITE_DIR . 'include/section/kkm_new/block_20.php',
    array(),
    array('SHOW_BORDER' => false)
);
?>
<?
$APPLICATION->IncludeFile(
    SITE_DIR . 'include/section/kkm_new/block_21.php',
    array(),
    array('SHOW_BORDER' => false)
);
?>
<?
# Модалка - Оставьте заявку на получение консультации
$APPLICATION->IncludeFile(
    SITE_DIR . 'include/section/kkm_new/block_22.php',
    array(),
    array('SHOW_BORDER' => false)
);
?>
<?
# Модалка - Оставьте заявку в блоке Предложение клиникам
$APPLICATION->IncludeFile(
    SITE_DIR . 'include/section/kkm_new/block_25.php',
    array(),
    array('SHOW_BORDER' => false)
);
?>
<?
# Модалка - Программа курса
$APPLICATION->IncludeFile(
    SITE_DIR . 'include/section/kkm_new/block_23.php',
    array(),
    array('SHOW_BORDER' => false)
);
?>
<?
# Модалка - Отзыв
$APPLICATION->IncludeFile(
    SITE_DIR . 'include/section/kkm_new/block_24.php',
    array(),
    array('SHOW_BORDER' => false)
);
?>

<?
// 3. Добавлен шаблон модалки, в которую можно встроить скрипт формы: -->
?>
<div class="dp-modal dp-get-course-modal" id="widget-modal-template">
    <div class="dp-modal__overlay"></div>
    <div class="dp-modal__dialog">
        <button class="dp-modal__close" type="button">
            <svg class="icon icon-cross ">
                <use xlink:href="#cross"></use>
            </svg>
        </button>
        <!-- dp-modal__header на программинге можно убирать-->
        <div class="dp-modal__header">
            <p class="dp-modal__title">Шаблон под форму</p>
        </div>
        <div class="dp-modal__body">
            <!-- сюда добавить скрипт с формой-->
        </div>
    </div>
</div>
<?
// <-- 3. Добавлен шаблон модалки, в которую можно встроить скрипт формы:
?>

<?
// Скрипты со старого лендинга -->
?>
<?
$APPLICATION->IncludeFile(
    SITE_DIR . 'include/section/kkm/js_scripts.php',
    array(),
    array('SHOW_BORDER' => false)
);
?>
<?
// <-- Скрипты со старого лендинга
?>


<?/*?>
<?
// Попап-окна -->
?>
<?
$APPLICATION->IncludeFile(
    SITE_DIR . 'include/section/kkm/clinic-request-modal.php',
    array(),
    array('SHOW_BORDER' => false)
);
?>

<?
$APPLICATION->IncludeFile(
    SITE_DIR . 'include/section/kkm/kalgari-free-modal.php',
    array(),
    array('SHOW_BORDER' => false)
);
?>

<?
$APPLICATION->IncludeFile(
    SITE_DIR . 'include/section/kkm/kalgari-tariff-base-installment-modal.php',
    array(),
    array('SHOW_BORDER' => false)
);
?>

<?
$APPLICATION->IncludeFile(
    SITE_DIR . 'include/section/kkm/kalgari-tariff-optima-installment-modal.php',
    array(),
    array('SHOW_BORDER' => false)
);
?>

<?
$APPLICATION->IncludeFile(
    SITE_DIR . 'include/section/kkm/kalgari-tariff-optima-pay-modal.php',
    array(),
    array('SHOW_BORDER' => false)
);
?>

<?
$APPLICATION->IncludeFile(
    SITE_DIR . 'include/section/kkm/kalgari-tariff-base-pay-modal.php',
    array(),
    array('SHOW_BORDER' => false)
);
?>
<?
// <-- Попап-окна
?>
<?*/ ?>

<?
// Разметка OG -->
//if ($arParams['OG']['SET'] == 'Y') {
if (TRUE) {
    $arResultFunc = CMarkingOG::getSetGlobalData(array(
        "OG_TITLE" => $GLOBALS['OG_TMP']['OG_TITLE'],
        //"OG_URL" => $arResult['OG']['OG_URL'],
        "OG_DESCRIPTION" => $GLOBALS['OG_TMP']['OG_DESCRIPTION'],
        "OG_IMAGE" => $GLOBALS['OG_TMP']['OG_IMAGE'],
    ));
}
// <-- Разметка OG
?>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>