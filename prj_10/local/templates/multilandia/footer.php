<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die();
?>
<? if (!$isHomePage): ?>
    </div>
    <?php // .ml-page-body ?>
    </div>
    <?php // .row ?>
    <? if (!defined('CUSTOM_LAYOUT_PAGE')): ?>
        </div>
        <?php // .col-md-12 ?>
        </div>
        <?php // .row ?>
        </div>
    <?php // .container ?>
    <? endif; ?>
<? endif; ?>
</main>
<?php // .ml-main ?>
<footer class="ml-footer">
    <div class="container">
        <div class="row">
            <div class="col-4 col-xl-3 order-1 order-xl-0 ml-col-logo">
                <? if ($isHomePage) { ?>
                    <div class="ml-footer-logo">
                    <? } else { ?>
                        <a class="ml-footer-logo" href="<?= SITE_DIR ?>"><? } ?>
                        <img src="<?= SITE_TEMPLATE_PATH ?>/img/design/logo-footer.svg" alt="Мультиландия" width="207"
                            height="335" />
                        <? if (!$isHomePage) { ?>
                        </a>
                    <? } else { ?>
                    </div>
                <? } ?>
            </div>
            <div class="col-12 col-xl-9 order-0 order-xl-1">
                <div class="row">
                    <div class="col-6 col-md-4 ml-col-menu">
                        <? $APPLICATION->IncludeComponent(
                            "bitrix:menu",
                            "indexis_footer_menu",
                            array(
                                "COMPONENT_TEMPLATE" => "indexis_footer_menu",
                                "ROOT_MENU_TYPE" => "footer_menu",
                                "MENU_CACHE_TYPE" => "N",
                                "MENU_CACHE_TIME" => "3600",
                                "MENU_CACHE_USE_GROUPS" => "Y",
                                "MENU_CACHE_GET_VARS" => array(
                                ),
                                "MAX_LEVEL" => "1",
                                "CHILD_MENU_TYPE" => "",
                                "USE_EXT" => "Y",
                                "DELAY" => "N",
                                "ALLOW_MULTI_SELECT" => "N"
                            ),
                            false
                        ); ?>

                        <?/* if (!$isHomePage): ?>
                            <? $APPLICATION->IncludeComponent(
                                "bitrix:main.include",
                                ".default",
                                array(
                                    "AREA_FILE_SHOW" => "file",
                                    "AREA_FILE_SUFFIX" => "",
                                    "AREA_FILE_RECURSIVE" => "Y",
                                    "EDIT_TEMPLATE" => "standard.php",
                                    "COMPONENT_TEMPLATE" => ".default",
                                    "PATH" => "/include/footer/email.php"
                                ),
                                false
                            ); ?>
                        <? endif; */?>
                    </div>

                    <? $APPLICATION->IncludeComponent(
                        "bitrix:menu",
                        "indexis_about_footer_menu",
                        array(
                            "COMPONENT_TEMPLATE" => "indexis_about_footer_menu",
                            "ROOT_MENU_TYPE" => "about",
                            "MENU_CACHE_TYPE" => "N",
                            "MENU_CACHE_TIME" => "3600",
                            "MENU_CACHE_USE_GROUPS" => "Y",
                            "MENU_CACHE_GET_VARS" => array(
                            ),
                            "MAX_LEVEL" => "2",
                            "CHILD_MENU_TYPE" => "footer_sub_about",
                            "USE_EXT" => "Y",
                            "DELAY" => "N",
                            "ALLOW_MULTI_SELECT" => "N"
                        ),
                        false
                    ); ?>
                </div>
            </div>
            <div class="col-8 col-xl-3 offset-4 offset-xl-0 order-3 order-xl-2 col-copyright">
                <? $APPLICATION->IncludeComponent("bitrix:main.include", ".default", array(
                    "AREA_FILE_SHOW" => "file",
                    "AREA_FILE_SUFFIX" => "",
                    "AREA_FILE_RECURSIVE" => "Y",
                    "EDIT_TEMPLATE" => "standard.php",
                    "COMPONENT_TEMPLATE" => ".default",
                    "PATH" => "/include/footer/copyright.php"
                ), false); ?>
            </div>
            <div class="col-8 order-2 offset-4 offset-xl-0 order-xl-3 ml-col-social">
                <? $APPLICATION->IncludeComponent(
                    "bitrix:main.include",
                    ".default",
                    array(
                        "AREA_FILE_SHOW" => "file",
                        "AREA_FILE_SUFFIX" => "",
                        "AREA_FILE_RECURSIVE" => "Y",
                        "EDIT_TEMPLATE" => "standard.php",
                        "COMPONENT_TEMPLATE" => ".default",
                        "PATH" => "/include/footer/social_network.php"
                    ),
                    false
                ); ?>

                <? $APPLICATION->IncludeComponent(
                    "bitrix:main.include",
                    ".default",
                    array(
                        "AREA_FILE_SHOW" => "file",
                        "AREA_FILE_SUFFIX" => "",
                        "AREA_FILE_RECURSIVE" => "Y",
                        "EDIT_TEMPLATE" => "standard.php",
                        "COMPONENT_TEMPLATE" => ".default",
                        "PATH" => "/include/footer/developer.php"
                    ),
                    false
                ); ?>
            </div>
        </div>
    </div>
</footer>
</div>

<?php
/* PopUp Main */
$APPLICATION->IncludeFile(
    SITE_DIR . 'include/main_page/popups.php',
    [],
    ['SHOW_BORDER' => false]
);
/* End PopUp Main */
?>

<script>
    $(document).ready(function () {

        $(document).on('click', '.load-more-items', function () {

            var targetContainer = $('.timetable-items'),
                url = $('.load-more-items').attr('data-url');

            if (url !== undefined) {
                $.ajax({
                    type: 'GET',
                    url: url,
                    dataType: 'html',
                    success: function (data) {

                        $('.load-more-items').remove();

                        var elements = $(data).find('.timetable-item'),
                            pagination = $(data).find('.load-more-items');

                        targetContainer.append(elements);
                        $('#pag-timetable').append(pagination);

                    }
                });
            }

        });

    });
</script>

<?
// Hiddens -->
?>
<input type="hidden" id="FAVORITES_ADD_REMOVE_AJAX"
    value="<?= $GLOBALS["arSiteConfig"]["arPaths"]["FAVORITES_ADD_REMOVE_AJAX"]; ?>" />
<?
// <-- Hiddens
?>
</body>

</html>