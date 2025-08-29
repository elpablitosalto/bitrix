<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die();
?>

<style>
    #ltBlock1672481244 .mk {
        font-family: 'Inter';
        font-style: normal;
        font-weight: 400;
        font-size: 14px;
        line-height: 17px;

        color: #FFFFFF;

    }

    #ltBlock1672481244
    .f-header {
        font-style: normal;
        font-weight: 700;
        font-size: 32px;
        line-height: 48px;
        color: #000;
        text-align: center;
    }

    #ltBlock1672481244
    .f-subheader {
        font-style: normal;
        font-weight: 400;
        font-size: 40px;
        line-height: 110%;
        color: #000;

        text-align: center;
    }

    #ltBlock1672481244
    .f-text {
        text-align: center !important;
    }

    #ltBlock1672481244
    .cl {
        font-style: normal;
        font-weight: 500;
        font-size: 12px;
        line-height: 150%;
        text-align: center;

        color: #FFFFFF;
    }

    #ltBlock1672481244
    img {
        width: 395px;
        height: 402x;
    }    </style>

<style>
    #ltBlock1672481244 .lt-block-wrapper {
        padding-top: 45px;
        padding-bottom: 0px;
        background-color: #F1F1F1
    }


    @media (min-width: 761px) {
        #ltBlock1672481244 {
            display: none;
        }
    }
</style>


<div id="ltBlock1672481244" data-block-id="1672481247"
     data-has-css="true" class="lt-block lt-view bld01 lt-onecolumn lt-onecolumn-common"
     data-code="b-c01c2"
>
    <div class="lt-block-wrapper">
        <div class="container">
            <div class="row">
                <div class="modal-block-content block-box col-md-4 col-md-offset-4 text-center" style="">
                    <div
                        id="builder5794156"
                        class="builder  animated-block"
                        data-path="items"
                        data-animation-order="in-turn">

                        <div
                            data-param="items/parts/field14448"
                            data-item-name="field14448"
                            data-title="Элемент"
                            data-animation-mode="no"
                            style="margin-bottom: 20px; margin-top: 0px; border-radius: ; "
                            data-setting-editable="true"
                            class="builder-item part-header "
                        >
                            <div data-editable=true data-param='items/parts/field14448/inner/text'
                                 class='f-header f-header-72'><p>
                                    <?$APPLICATION->IncludeComponent(
                                        "bitrix:main.include",
                                        "",
                                        Array(
                                            "AREA_FILE_SHOW" => "file",
                                            "PATH" => SITE_DIR . "include/content/kdp/" . basename(__FILE__, '.php') . "_title.php",
                                        )
                                    );?>
                                </p></div>
                        </div>
                        <style>
                        </style>
                        <div
                            data-param="items/parts/text1"
                            data-item-name="text1"
                            data-title="Элемент"
                            data-animation-mode="no"
                            style="margin-bottom: 0px; color: #000; border-radius: ; "
                            data-setting-editable="true"
                            class="builder-item part-text  ci"
                        >
                            <div style='font-size:  13px; ' class='text-accurate f-text'
                                 data-param='items/parts/text1/inner/text' data-editable='true'>
                                <?$APPLICATION->IncludeComponent(
                                    "bitrix:main.include",
                                    "",
                                    Array(
                                        "AREA_FILE_SHOW" => "file",
                                        "PATH" => SITE_DIR . "include/content/kdp/" . basename(__FILE__, '.php') . "_text.php",
                                    )
                                );?>
                            </div>
                        </div>
                        <style>
                            [data-param="items/parts/text1"] div.f-header, [data-param="items/parts/text1"] div.f-text {
                                line-height: 25px;
                            }
                        </style>
                        <div
                            data-param="items/parts/field88435"
                            data-item-name="field88435"
                            data-title="Элемент"
                            data-animation-mode="no"
                            style="margin-bottom: 0px; border-radius: ; "
                            data-setting-editable="true"
                            class="builder-item part-image "
                        >

                            <div id="image4095893" class="image-box"
                                 data-img-title=""
                                 data-img-src="<?=SITE_TEMPLATE_PATH?>/images/254.png"
                            >
                                <img class="lazyload"
                                     data-src="<?=SITE_TEMPLATE_PATH?>/images/254.png"
                                     data-param="items/parts/field88435/inner/image"
                                     data-hash="d0829d9ee0fddf1909de11941dd560f7.png"
                                     data-image-editable="true"
                                     title=""
                                     alt=""
                                     style=""
                                />
                                <div data-editable="true"
                                     data-param="items/parts/field88435/inner/image/caption"
                                     class="lt-image-caption">
                                </div>
                            </div>

                        </div>
                        <style>
                        </style>
                    </div>


                    <script>
                        $(function () {

                            if ($('#builder5794156 input[type="radio"]').length == 1 && $('#builder5794156 input[type="radio"]').prop('checked')) {
                                $('#builder5794156 input[type="radio"]').hide();
                            }

                            if ($('.animated-block').animatedBlock) {
                                $('.animated-block').animatedBlock();
                            }
                        });
                    </script>
                </div>
            </div>
        </div>

    </div>
</div>
