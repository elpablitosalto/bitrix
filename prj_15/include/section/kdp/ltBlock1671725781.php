<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die();
?>

<style>
    #ltBlock1671725781 .f-header {
        font-style: normal;
        font-weight: 700;
        font-size: 48px;
        line-height: 100%;
        text-transform: uppercase;
        color: #000000;
    }    </style>

<style>
    #ltBlock1671725781 .lt-block-wrapper {
        padding-top: 45px;
        padding-bottom: 0px
    }

    @media (max-width: 760px) {
        #ltBlock1671725781 {
            display: none;
        }
    }

</style>


<div id="ltBlock1671725781" data-block-id="1671729686"
     data-has-css="true" class="lt-block lt-view tcb-01 lt-twocolumn lt-twocolumn-standard"
     data-code="b-9b078"
>
    <div class="lt-block-wrapper">


        <div class="my-container flex-container wrap-col">
            <div
                id="builder1205395"
                class="builder  flex-column col-md-6 col-md-offset-0"
                data-path="column2"
            >
                <div class="common-setting-link box-setting-link" data-icon-class="fa fa-adjust"
                     data-param="column2/box" data-title="Стиль блока" data-setting-editable="true"></div>

                <div
                    data-param="column2/parts/image1"
                    data-item-name="image1"
                    data-title="Элемент"
                    data-animation-mode="no"
                    style="margin-bottom: 10px; border-radius: ; "
                    data-setting-editable="true"
                    class="builder-item part-image  text-left"
                >

                    <div id="image406210" class="image-box"
                         data-img-title=""
                         data-img-src="<?=SITE_TEMPLATE_PATH?>/images/235.png"
                    >
                        <img class="lazyload"
                             data-src="<?=SITE_TEMPLATE_PATH?>/images/235.png"
                             data-param="column2/parts/image1/inner/image"
                             data-hash="0af157c66f919aaf2ffa2c131f5612e5.png"
                             data-image-editable="true"
                             title=""
                             alt=""
                             style=""
                        />
                        <div data-editable="true" data-param="column2/parts/image1/inner/image/caption"
                             class="lt-image-caption">
                        </div>
                    </div>

                </div>
                <style>
                </style>
            </div>

            <style>
                #builder1205395 {;
                }
            </style>


            <script>
                $(function () {

                    if ($('#builder1205395 input[type="radio"]').length == 1 && $('#builder1205395 input[type="radio"]').prop('checked')) {
                        $('#builder1205395 input[type="radio"]').hide();
                    }

                    if ($('.animated-block').animatedBlock) {
                        $('.animated-block').animatedBlock();
                    }
                });
            </script>

            <div
                id="builder547099"
                class="builder  flex-column col-md-6 col-md-offset-0"
                data-path="column1"
            >
                <div class="common-setting-link box-setting-link" data-icon-class="fa fa-adjust"
                     data-param="column1/box" data-title="Стиль блока" data-setting-editable="true"></div>

                <div
                    data-param="column1/parts/header1"
                    data-item-name="header1"
                    data-title="Элемент"
                    data-animation-mode="no"
                    style="margin-bottom: 33px; border-radius: ; "
                    data-setting-editable="true"
                    class="builder-item part-header  text-left"
                >
                    <div data-editable=true data-param='column1/parts/header1/inner/text'
                         class='f-header f-header-36'>
                        <?$APPLICATION->IncludeComponent(
                            "bitrix:main.include",
                            "",
                            Array(
                                "AREA_FILE_SHOW" => "file",
                                "PATH" => SITE_DIR . "include/content/kdp/" . basename(__FILE__, '.php') . "_title.php",
                            )
                        );?>
                    </div>
                </div>
                <style>
                </style>
                <div
                    data-param="column1/parts/field97851"
                    data-item-name="field97851"
                    data-title="Элемент"
                    data-animation-mode="no"
                    style="margin-bottom: 74px; border-radius: ; "
                    data-setting-editable="true"
                    class="builder-item part-text "
                >
                    <div style='font-size: 30px; ' class='text-accurate f-text'
                         data-param='column1/parts/field97851/inner/text' data-editable='true'>
                        <?$APPLICATION->IncludeComponent(
                            "bitrix:main.include",
                            "",
                            Array(
                                "AREA_FILE_SHOW" => "file",
                                "PATH" => SITE_DIR . "include/content/kdp/" . basename(__FILE__, '.php') . "_subtitle.php",
                            )
                        );?>
                    </div>
                </div>
                <style>
                </style>
                <div
                    data-param="column1/parts/text1"
                    data-item-name="text1"
                    data-title="Элемент"
                    data-animation-mode="no"
                    style="margin-bottom: 17px; border-radius: ; "
                    data-setting-editable="true"
                    class="builder-item part-text  text-left"
                >
                    <div style='font-size:  16px; ' class='text-accurate f-text'
                         data-param='column1/parts/text1/inner/text' data-editable='true'>
                        <?$APPLICATION->IncludeComponent(
                            "bitrix:main.include",
                            "",
                            Array(
                                "AREA_FILE_SHOW" => "file",
                                "PATH" => SITE_DIR . "include/content/kdp/" . basename(__FILE__, '.php') . "_desc.php",
                            )
                        );?>
                    </div>
                </div>
                <style>
                </style>
                <div
                    data-param="column1/parts/text1_44"
                    data-item-name="text1_44"
                    data-title="Элемент"
                    data-animation-mode="no"
                    style="margin-bottom: 17px; border-radius: ; "
                    data-setting-editable="true"
                    class="builder-item part-text  text-left"
                >
                    <div style='font-size:  16px; ' class='text-accurate f-text'
                         data-param='column1/parts/text1_44/inner/text' data-editable='true'>
                        <?$APPLICATION->IncludeComponent(
                            "bitrix:main.include",
                            "",
                            Array(
                                "AREA_FILE_SHOW" => "file",
                                "PATH" => SITE_DIR . "include/content/kdp/" . basename(__FILE__, '.php') . "_desc_1.php",
                            )
                        );?>
                    </div>
                </div>
                <style>
                </style>
                <div
                    data-param="column1/parts/text1_3"
                    data-item-name="text1_3"
                    data-title="Элемент"
                    data-animation-mode="no"
                    style="margin-bottom: 10px; border-radius: ; "
                    data-setting-editable="true"
                    class="builder-item part-text  text-left"
                >
                    <div style='font-size:  16px; ' class='text-accurate f-text'
                         data-param='column1/parts/text1_3/inner/text' data-editable='true'>
                        <?$APPLICATION->IncludeComponent(
                            "bitrix:main.include",
                            "",
                            Array(
                                "AREA_FILE_SHOW" => "file",
                                "PATH" => SITE_DIR . "include/content/kdp/" . basename(__FILE__, '.php') . "_desc_2.php",
                            )
                        );?>
                    </div>
                </div>
                <style>
                </style>
            </div>

            <style>
                #builder547099 {;
                }
            </style>


            <script>
                $(function () {

                    if ($('#builder547099 input[type="radio"]').length == 1 && $('#builder547099 input[type="radio"]').prop('checked')) {
                        $('#builder547099 input[type="radio"]').hide();
                    }

                    if ($('.animated-block').animatedBlock) {
                        $('.animated-block').animatedBlock();
                    }
                });
            </script>
        </div>
    </div>
</div>
