<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die();
?>

<style>
    #ltBlock1672029869 .f-header {
        font-style: normal;
        font-weight: 700;
        font-size: 48px;
        line-height: 100%;
        text-transform: uppercase;
        color: #000;
    }    </style>

<style>
    #ltBlock1672029869 .lt-block-wrapper {
        padding-top: 60px;
        padding-bottom: 15px
    }

    @media (max-width: 760px) {
        #ltBlock1672029869 {
            display: none;
        }
    }

</style>


<div id="ltBlock1672029869" data-block-id="1672029912"
     data-has-css="true" class="lt-block lt-view bld01 lt-onecolumn lt-onecolumn-common"
     data-code="b-d4bc7"
>
    <div class="lt-block-wrapper">
        <div class="container">
            <div class="row">
                <div class="modal-block-content block-box col-md-10 text-center" style="">
                    <div
                        id="builder458453"
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

                            if ($('#builder458453 input[type="radio"]').length == 1 && $('#builder458453 input[type="radio"]').prop('checked')) {
                                $('#builder458453 input[type="radio"]').hide();
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
