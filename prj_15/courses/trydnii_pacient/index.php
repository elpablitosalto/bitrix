<?
define('SET_OG_MARKING', 'Y');
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$title = "Навыки общения с трудным пациентом | Курсы для врачей";
$APPLICATION->SetPageProperty("description", 'Дистанционный курс для врачей всех специальностей. Кто хочет усилить навык общения с пациентом. Освоить техники работы с возражениями трудного пациента. Повысить приверженность к лечению. Убедитесь, что курс вам подходит. Пройдите бесплатный урок.');
$APPLICATION->SetPageProperty("keywords", 'общение с пациентом, коммуникация с пациентом, трудный пациент, агрессивный пациент, пациент ведет себя агрессивно, правила общения с трудным пациентом, работа с агрессивным пациентом, работа с трудными пациентами, токсичный пациент, трудный пациент в медицине');
$GLOBALS['OG_TMP']['OG_TITLE'] = $title;
$APPLICATION->SetTitle($title);
?>

    <script>
        $(function() {
            mindboxViewProduct("GetCourse_4061660");
        });
    </script>

    <div id="allrecords" data-tilda-export="yes" class="t-records" data-hook="blocks-collection-content-node"
         data-tilda-project-id="4232380" data-tilda-page-id="26910073" data-tilda-page-alias="courses/trudnyj_pacient"
         data-tilda-formskey="e9090ef6e5c9a81dd52ba3f7fd0ed0ff" data-tilda-lazy="yes" data-tilda-project-lang="RU"
         data-tilda-project-headcode="yes"><!--header-->

        <?/*
        $APPLICATION->IncludeFile(
            SITE_DIR . 'include/section/common/header.php',
            array(),
            array('SHOW_BORDER' => false)
        );
        */?>

        <?
        $APPLICATION->IncludeFile(
            SITE_DIR . 'include/section/tp/rec437623622.php',
            array(),
            array('SHOW_BORDER' => false)
        );
        ?>

        <?
        $APPLICATION->IncludeFile(
            SITE_DIR . 'include/section/tp/rec555995063.php',
            array(),
            array('SHOW_BORDER' => false)
        );
        ?>

        <?
        $APPLICATION->IncludeFile(
            SITE_DIR . 'include/section/tp/rec435756264.php',
            array(),
            array('SHOW_BORDER' => false)
        );
        ?>

        <?
        $APPLICATION->IncludeFile(
            SITE_DIR . 'include/section/tp/rec436667430.php',
            array(),
            array('SHOW_BORDER' => false)
        );
        ?>

        <?
        $APPLICATION->IncludeFile(
            SITE_DIR . 'include/section/tp/rec435821660.php',
            array(),
            array('SHOW_BORDER' => false)
        );
        ?>

        <?
        $APPLICATION->IncludeFile(
            SITE_DIR . 'include/section/tp/rec435415246.php',
            array(),
            array('SHOW_BORDER' => false)
        );
        ?>

        <?
        $APPLICATION->IncludeFile(
            SITE_DIR . 'include/section/tp/rec435830526.php',
            array(),
            array('SHOW_BORDER' => false)
        );
        ?>

        <?
        $APPLICATION->IncludeFile(
            SITE_DIR . 'include/section/tp/rec435872571.php',
            array(),
            array('SHOW_BORDER' => false)
        );
        ?>

        <?
        $APPLICATION->IncludeFile(
            SITE_DIR . 'include/section/tp/rec435147621.php',
            array(),
            array('SHOW_BORDER' => false)
        );
        ?>

        <?
        $APPLICATION->IncludeFile(
            SITE_DIR . 'include/section/tp/rec435264990.php',
            array(),
            array('SHOW_BORDER' => false)
        );
        ?>

        <?
        $APPLICATION->IncludeFile(
            SITE_DIR . 'include/section/tp/rec435414373.php',
            array(),
            array('SHOW_BORDER' => false)
        );
        ?>

        <?
        $APPLICATION->IncludeFile(
            SITE_DIR . 'include/section/tp/rec435707516.php',
            array(),
            array('SHOW_BORDER' => false)
        );
        ?>

        <?
        $APPLICATION->IncludeFile(
            SITE_DIR . 'include/section/tp/rec437194459.php',
            array(),
            array('SHOW_BORDER' => false)
        );
        ?>

        <?
        $APPLICATION->IncludeFile(
            SITE_DIR . 'include/section/tp/rec435805837.php',
            array(),
            array('SHOW_BORDER' => false)
        );
        ?>

        <?
        $APPLICATION->IncludeFile(
            SITE_DIR . 'include/section/tp/rec609812853.php',
            array(),
            array('SHOW_BORDER' => false)
        );
        ?>

        <?
        $APPLICATION->IncludeFile(
            SITE_DIR . 'include/section/tp/rec609827277.php',
            array(),
            array('SHOW_BORDER' => false)
        );
        ?>

        <?
        $APPLICATION->IncludeFile(
            SITE_DIR . 'include/section/tp/rec529810161.php',
            array(),
            array('SHOW_BORDER' => false)
        );
        ?>

        <?
        $APPLICATION->IncludeFile(
            SITE_DIR . 'include/section/tp/rec529810570.php',
            array(),
            array('SHOW_BORDER' => false)
        );
        ?>

        <?/*
        $APPLICATION->IncludeFile(
            SITE_DIR . 'include/section/common/footer.php',
            array(),
            array('SHOW_BORDER' => false)
        );
        */?>

    </div><!--/allrecords--><!-- Stat -->

	<?
	$APPLICATION->IncludeFile(
		SITE_DIR . 'include/section/tp/free-lesson-modal.php',
		array(),
		array('SHOW_BORDER' => false)
	);
	?>

	<?
	$APPLICATION->IncludeFile(
		SITE_DIR . 'include/section/tp/tariff-optima-modal.php',
		array(),
		array('SHOW_BORDER' => false)
	);
	?>

	<?
	$APPLICATION->IncludeFile(
		SITE_DIR . 'include/section/tp/tariff-base-modal.php',
		array(),
		array('SHOW_BORDER' => false)
	);
	?>

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