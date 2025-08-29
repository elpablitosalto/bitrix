<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die();
?>
<style>
    #ltBlock1672495404 .f-header {
        font-style: normal;
        font-weight: 700;
        font-size: 32px;
        line-height: 48px;
        color: #000;
        text-align: center;
    }    </style>

<style>
    #ltBlock1672495404 .lt-block-wrapper {
        padding-top: 60px;
        padding-bottom: 15px
    }


    @media (min-width: 761px) {
        #ltBlock1672495404 {
            display: none;
        }
    }
</style>


<div id="ltBlock1672495404" data-block-id="1672495749"
     data-has-css="true" class="lt-block lt-view bld01 lt-onecolumn lt-onecolumn-common"
     data-code="b-fd577"
>
    <div class="lt-block-wrapper">
        <div class="container">
            <div class="row">
                <div class="modal-block-content block-box col-md-8 col-md-offset-2 text-center" style="">
                    <div
                        id="builder2228903"
                        class="builder  animated-block"
                        data-path="items"
                        data-animation-order="in-turn">

                        <div
                            data-param="items/parts/header1"
                            data-item-name="header1"
                            data-title="Элемент"
                            data-animation-mode="no"
                            style="margin-bottom: 0px; border-radius: ; "
                            data-setting-editable="true"
                            class="builder-item part-header  text-left"
                        >
                            <div data-editable=true data-param='items/parts/header1/inner/text'
                                 class='f-header f-header-36'><p>
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
                    </div>


                    <script>
                        $(function () {

                            if ($('#builder2228903 input[type="radio"]').length == 1 && $('#builder2228903 input[type="radio"]').prop('checked')) {
                                $('#builder2228903 input[type="radio"]').hide();
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
