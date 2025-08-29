<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die();
?>

<style>
    #ltBlock1718449968 .lt-block-wrapper {
        padding-top: 60px;
        padding-bottom: 15px
    }


    @media (min-width: 761px) {
        #ltBlock1718449968 {
            display: none;
        }
    }
</style>

<div id="ltBlock1718449968" data-block-id="1718450105"
     class="lt-block lt-view bld01 lt-onecolumn lt-onecolumn-common"
     data-code="b-488e4"
>
    <div class="lt-block-wrapper">
        <div class="container">
            <div class="row">
                <div class="modal-block-content block-box col-md-8 col-md-offset-2 text-center" style="">
                    <div
                        id="builder7057798"
                        class="builder  animated-block"
                        data-path="items"
                        data-animation-order="in-turn">

                        <div
                            data-param="items/parts/field11510"
                            data-item-name="field11510"
                            data-title="Элемент"
                            data-animation-mode="no"
                            style="margin-bottom: 21px; border-radius: ; "
                            data-setting-editable="true"
                            class="builder-item part-subheader  text-center"
                        >
                            <div data-editable=true data-param='items/parts/field11510/inner/text'
                                 class='f-subheader f-subheader-md f-text-transform-uppercase'><p><strong>
                                        <?$APPLICATION->IncludeComponent(
                                            "bitrix:main.include",
                                            "",
                                            Array(
                                                "AREA_FILE_SHOW" => "file",
                                                "PATH" => SITE_DIR . "include/content/gnv/" . basename(__FILE__, '.php') . "_title.php",
                                            )
                                        );?>
                                        </strong></p>

								<?/*<p><strong>Дата <span style="color:#9C201F;">13.10.2023&nbsp;</span> в 15:00 по мск</strong></p>*/?>
							</div>
                        </div>

                        <div
                            data-param="items/parts/field70261"
                            data-item-name="field70261"
                            data-title="Элемент"
                            data-animation-mode="no"
                            style="margin-bottom: 25px; border-radius: ; "
                            data-setting-editable="true"
                            class="builder-item part-image "
                        >

                            <div id="image361367" class="image-box"
                                 data-img-title=""
                                 data-img-src="//fs-thb02.getcourse.ru/fileservice/file/thumbnail/h/ba8e31864807ed23f0c7bd0dcebc2504.png/s/s1200x/a/561799/sc/277"
                            >
                                <img class="lazyload"
                                     data-src="//fs-thb02.getcourse.ru/fileservice/file/thumbnail/h/ba8e31864807ed23f0c7bd0dcebc2504.png/s/s1200x/a/561799/sc/277"
                                     data-param="items/parts/field70261/inner/image"
                                     data-hash="ba8e31864807ed23f0c7bd0dcebc2504.png"
                                     data-image-editable="true"
                                     title=""
                                     alt=""
                                     style="border-radius:  !important; "
                                />
                                <div data-editable="true"
                                     data-param="items/parts/field70261/inner/image/caption"
                                     class="lt-image-caption">
                                </div>
                            </div>

                        </div>
                    </div>

                    <script>
                        $(function () {

                            if ($('#builder7057798 input[type="radio"]').length == 1 && $('#builder7057798 input[type="radio"]').prop('checked')) {
                                $('#builder7057798 input[type="radio"]').hide();
                            }

                            if ($('.animated-block').animatedBlock) {
                                $('.animated-block').animatedBlock();
                            }
                        });
                    </script>
                </div>
            </div>
        </div>

        <style>
            #ltBlock1718449968 .block-box {;
                padding-left: 50px;
                padding-right: 50px;
                padding-top: 0px;
                padding-bottom: 0px;
                border: 0px solid #999999;
            }
        </style>
    </div>
</div>


