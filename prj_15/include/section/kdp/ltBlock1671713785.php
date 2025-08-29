<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die();
?>

<style>
    #ltBlock1671713785 .f-text {
        font-style: normal;
        font-weight: 500;
        font-size: 16px;
        line-height: 178.5%;
    }

    #ltBlock1671713785
    .f-header {
        font-style: normal;
        font-weight: 700;
        font-size: 48px;
        line-height: 100%;
        text-transform: uppercase;
        color: #000000;
    }

    #ltBlock1671713785
    .my-item {
        /* элемент будет иметь свойства блока, элементы располагаются на той же строке
последовательно */
        display: inline-block;
        max-width: 500px;
        margin: 0px 0px;
        padding-left: 60px;
        background: url(/local/templates/geropharm-tilda/images/2518.png) no-repeat left top;
        background-size: 30px;
        vertical-align: top;
    }

    @media (max-width: 800px) {
        #ltBlock1671713785
        .f-text {
            font-size: 12px;
        }
    }


    @media (max-width: 800px) {
        #ltBlock1671713785
        .f-header {
            font-size: 32px;
            text-align: center;
        }


</style>

<style>
    #ltBlock1671713785 .lt-block-wrapper {
        padding-top: 45px;
        padding-bottom: 0px;
        background-color: #F1F1F1
    }

    @media (max-width: 760px) {
        #ltBlock1671713785 {
            display: none;
        }
    }

</style>


<div id="ltBlock1671713785" data-block-id="1671720369"
     data-has-css="true" class="lt-block lt-view tcb-01 lt-twocolumn lt-twocolumn-standard"
     data-code="b-0562d"
>
    <div class="lt-block-wrapper">


        <div class="my-container flex-container wrap-col">
            <div
                id="builder9770570"
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
                    style="margin-bottom: 25px; border-radius: ; "
                    data-setting-editable="true"
                    class="builder-item part-header  text-left"
                >
                    <div data-editable=true data-param='column1/parts/header1/inner/text'
                         class='f-header f-header-36'><p>
                            <?$APPLICATION->IncludeComponent(
                                "bitrix:main.include",
                                "",
                                Array(
                                    "AREA_FILE_SHOW" => "file",
                                    "PATH" => SITE_DIR . "include/content/kdp/" . basename(__FILE__, '.php') . "_title.php",
                                )
                            );?>
                        </p>
                    </div>
                </div>
                <style>
                </style>
                <div
                    data-param="column1/parts/text1"
                    data-item-name="text1"
                    data-title="Элемент"
                    data-animation-mode="no"
                    style="margin-bottom: 10px; border-radius: ; "
                    data-setting-editable="true"
                    class="builder-item part-text  my-item text-left"
                >
                    <div style='' class='text-normal f-text' data-param='column1/parts/text1/inner/text'
                         data-editable='true'>
                        <p>
                            <?$APPLICATION->IncludeComponent(
                                "bitrix:main.include",
                                "",
                                Array(
                                    "AREA_FILE_SHOW" => "file",
                                    "PATH" => SITE_DIR . "include/content/kdp/" . basename(__FILE__, '.php') . "_text_1.php",
                                )
                            );?>
                        </p>
                    </div>
                </div>
                <style>
                </style>
                <div
                    data-param="column1/parts/field97720"
                    data-item-name="field97720"
                    data-title="Элемент"
                    data-animation-mode="no"
                    style="margin-bottom: 10px; border-radius: ; "
                    data-setting-editable="true"
                    class="builder-item part-text  my-item"
                >
                    <div style='' class='text-normal f-text'
                         data-param='column1/parts/field97720/inner/text'
                         data-editable='true'>
                        <?$APPLICATION->IncludeComponent(
                            "bitrix:main.include",
                            "",
                            Array(
                                "AREA_FILE_SHOW" => "file",
                                "PATH" => SITE_DIR . "include/content/kdp/" . basename(__FILE__, '.php') . "_text_2.php",
                            )
                        );?>
                       </div>
                </div>
                <style>
                </style>
                <div
                    data-param="column1/parts/field97720_46"
                    data-item-name="field97720_46"
                    data-title="Элемент"
                    data-animation-mode="no"
                    style="margin-bottom: 10px; border-radius: ; "
                    data-setting-editable="true"
                    class="builder-item part-text  my-item"
                >
                    <div style='' class='text-normal f-text'
                         data-param='column1/parts/field97720_46/inner/text'
                         data-editable='true'>
                        <?$APPLICATION->IncludeComponent(
                            "bitrix:main.include",
                            "",
                            Array(
                                "AREA_FILE_SHOW" => "file",
                                "PATH" => SITE_DIR . "include/content/kdp/" . basename(__FILE__, '.php') . "_text_3.php",
                            )
                        );?>
                    </div>
                </div>
                <style>
                </style>
                <div
                    data-param="column1/parts/field97720_65"
                    data-item-name="field97720_65"
                    data-title="Элемент"
                    data-animation-mode="no"
                    style="margin-bottom: 10px; border-radius: ; "
                    data-setting-editable="true"
                    class="builder-item part-text  my-item"
                >
                    <div style='' class='text-normal f-text'
                         data-param='column1/parts/field97720_65/inner/text'
                         data-editable='true'>
                        <?$APPLICATION->IncludeComponent(
                            "bitrix:main.include",
                            "",
                            Array(
                                "AREA_FILE_SHOW" => "file",
                                "PATH" => SITE_DIR . "include/content/kdp/" . basename(__FILE__, '.php') . "_text_4.php",
                            )
                        );?>
                    </div>
                </div>
                <style>
                </style>
                <div
                    data-param="column1/parts/field97720_83"
                    data-item-name="field97720_83"
                    data-title="Элемент"
                    data-animation-mode="no"
                    style="margin-bottom: 10px; border-radius: ; "
                    data-setting-editable="true"
                    class="builder-item part-text  my-item"
                >
                    <div style='' class='text-normal f-text'
                         data-param='column1/parts/field97720_83/inner/text'
                         data-editable='true'>
                        <?$APPLICATION->IncludeComponent(
                            "bitrix:main.include",
                            "",
                            Array(
                                "AREA_FILE_SHOW" => "file",
                                "PATH" => SITE_DIR . "include/content/kdp/" . basename(__FILE__, '.php') . "_text_5.php",
                            )
                        );?>
                    </div>
                </div>
                <style>
                </style>
                <div
                    data-param="column1/parts/field97720_83_56"
                    data-item-name="field97720_83_56"
                    data-title="Элемент"
                    data-animation-mode="no"
                    style="margin-bottom: 10px; border-radius: ; "
                    data-setting-editable="true"
                    class="builder-item part-text  my-item"
                >
                    <div style='' class='text-normal f-text'
                         data-param='column1/parts/field97720_83_56/inner/text' data-editable='true'>
                        <?$APPLICATION->IncludeComponent(
                            "bitrix:main.include",
                            "",
                            Array(
                                "AREA_FILE_SHOW" => "file",
                                "PATH" => SITE_DIR . "include/content/kdp/" . basename(__FILE__, '.php') . "_text_6.php",
                            )
                        );?>
                    </div>
                </div>
                <style>
                </style>
                <div
                    data-param="column1/parts/field97720_83_56_8"
                    data-item-name="field97720_83_56_8"
                    data-title="Элемент"
                    data-animation-mode="no"
                    style="margin-bottom: 25px; border-radius: ; "
                    data-setting-editable="true"
                    class="builder-item part-text  my-item"
                >
                    <div style='' class='text-normal f-text'
                         data-param='column1/parts/field97720_83_56_8/inner/text' data-editable='true'>
                        <?$APPLICATION->IncludeComponent(
                            "bitrix:main.include",
                            "",
                            Array(
                                "AREA_FILE_SHOW" => "file",
                                "PATH" => SITE_DIR . "include/content/kdp/" . basename(__FILE__, '.php') . "_text_7.php",
                            )
                        );?>
                    </div>
                </div>
                <style>
                </style>
            </div>

            <style>
                #builder9770570 {;
                }
            </style>


            <script>
                $(function () {

                    if ($('#builder9770570 input[type="radio"]').length == 1 && $('#builder9770570 input[type="radio"]').prop('checked')) {
                        $('#builder9770570 input[type="radio"]').hide();
                    }

                    if ($('.animated-block').animatedBlock) {
                        $('.animated-block').animatedBlock();
                    }
                });
            </script>

            <div
                id="builder3972923"
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
                    style="margin-bottom: 25px; margin-top: 10px; border-radius: ; "
                    data-setting-editable="true"
                    class="builder-item part-image  text-left"
                >

                    <div id="image7822872" class="image-box"
                         data-img-title=""
                         data-img-src="<?=SITE_TEMPLATE_PATH?>/images/254.png"
                    >
                        <img class="lazyload"
                             data-src="<?=SITE_TEMPLATE_PATH?>/images/254.png"
                             data-param="column2/parts/image1/inner/image"
                             data-hash="d0829d9ee0fddf1909de11941dd560f7.png"
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
                #builder3972923 {;
                }
            </style>


            <script>
                $(function () {

                    if ($('#builder3972923 input[type="radio"]').length == 1 && $('#builder3972923 input[type="radio"]').prop('checked')) {
                        $('#builder3972923 input[type="radio"]').hide();
                    }

                    if ($('.animated-block').animatedBlock) {
                        $('.animated-block').animatedBlock();
                    }
                });
            </script>
        </div>
    </div>
</div>
