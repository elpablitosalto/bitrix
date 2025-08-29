<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die();
?>

<style>
    #ltBlock1672007379 .rounded-image-wrapper {
        display: none;
    }

    #ltBlock1672007379
    .f-description.lt-tsr-text-part.description {
        font-size: 16px;
    }    </style>
<style>
    #ltBlock1672007379 .lt-tsr-block {;
        padding-left: 40px;
        padding-right: 40px;
        padding-top: 20px;
        padding-bottom: 20px;
        border: 2px solid #E3E3E3;
        -webkit-flex: 1 0 200px;
        -ms-flex: 1 0 200px;
        -moz-flex: 1 0 200px;
        flex: 1 0 200px;
        margin: 10px;
    }

    #ltBlock1672007379
    .lt-tsr-block .image-wrapper {
        height: 200px;
    }

    #ltBlock1672007379

    ;
    .lt-stsr-block {;
        padding-left: 40px;
        padding-right: 40px;
        padding-top: 20px;
        padding-bottom: 20px;
        border: 2px solid #E3E3E3;
        -webkit-flex: 1 0 200px;
        -ms-flex: 1 0 200px;
        -moz-flex: 1 0 200px;
        flex: 1 0 200px;
        margin: 10px;
    }

    #ltBlock1672007379
    .lt-stsr-block .rounded-image {
        width: 150px;
        max-width: 150px;
        height: 150px;
        margin: 10px auto;
    }    </style>

<style>
    #ltBlock1672007379 .lt-block-wrapper {
        padding-top: 15px;
        padding-bottom: 45px
    }

    #ltBlock1672007379 .block-set,
    #ltBlock1672007379 .f-text,
    #ltBlock1672007379 .description,
    #ltBlock1672007379 .text,
    #ltBlock1672007379 .image-box,
    #ltBlock1672007379 .lt-form .f-input,
    #ltBlock1672007379 .lt-form .field-label,
    #ltBlock1672007379 .lt-form,
    #ltBlock1672007379 .lt-block .f-btn,
    #ltBlock1672007379,
    #ltBlock1672007379 .lt-menu .right-descr,
    #ltBlock1672007379 .stsr05 .description,
    #ltBlock1672007379 .comment-form-wrapper,
    #ltBlock1672007379 .tag-editor,
    #ltBlock1672007379 .comments-tree a,
    #ltBlock1672007379 div.juxtapose,
    #ltBlock1672007379 .fotorama__caption,
    #ltBlock1672007379 .lt-column-with-icons .column .title,
    #ltBlock1672007379 .stsr05 {
        font-family: 'Montserrat', serif !important
    }


</style>


<div id="ltBlock1672007379" data-block-id="1672010993"
     data-has-css="true" class="lt-block lt-view stsr05 lt-tsr lt-stsr"
     data-code="b-3773b"
>
    <div class="lt-block-wrapper">
        <div class="container">
            <div class="row">
                <div class="modal-block-content block-box col-md-8 col-md-offset-2 text-left" style="">

                    <?
                    $APPLICATION->IncludeComponent(
                        "bitrix:news.list",
                        "slider_kdp",
                        Array(
                            "ACTIVE_DATE_FORMAT" => "d.m.Y",
                            "ADD_SECTIONS_CHAIN" => "N",
                            "AJAX_MODE" => "N",
                            "AJAX_OPTION_ADDITIONAL" => "",
                            "AJAX_OPTION_HISTORY" => "N",
                            "AJAX_OPTION_JUMP" => "N",
                            "AJAX_OPTION_STYLE" => "Y",
                            "CACHE_FILTER" => "N",
                            "CACHE_GROUPS" => "N",
                            "CACHE_TIME" => "36000000",
                            "CACHE_TYPE" => "A",
                            "CHECK_DATES" => "Y",
                            "DETAIL_URL" => "",
                            "DISPLAY_BOTTOM_PAGER" => "Y",
                            "DISPLAY_DATE" => "Y",
                            "DISPLAY_NAME" => "Y",
                            "DISPLAY_PICTURE" => "Y",
                            "DISPLAY_PREVIEW_TEXT" => "Y",
                            "DISPLAY_TOP_PAGER" => "N",
                            "FIELD_CODE" => array("PREVIEW_PICTURE","PREVIEW_TEXT"),
                            "FILTER_NAME" => "",
                            "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                            "IBLOCK_ID" => 1,
                            "IBLOCK_TYPE" => "content",
                            "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                            "INCLUDE_SUBSECTIONS" => "Y",
                            "MESSAGE_404" => "",
                            "NEWS_COUNT" => "36",
                            "PAGER_BASE_LINK_ENABLE" => "Y",
                            "PAGER_DESC_NUMBERING" => "N",
                            "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                            "PAGER_SHOW_ALL" => "Y",
                            "PAGER_SHOW_ALWAYS" => "N",
                            "PAGER_TEMPLATE" => "",
                            "PAGER_TITLE" => "",
                            "PARENT_SECTION" => "1",
                            "PARENT_SECTION_CODE" => "",
                            "PREVIEW_TRUNCATE_LEN" => "",
                            "PROPERTY_CODE" => array(""),
                            "SET_BROWSER_TITLE" => "N",
                            "SET_LAST_MODIFIED" => "N",
                            "SET_META_DESCRIPTION" => "N",
                            "SET_META_KEYWORDS" => "N",
                            "SET_STATUS_404" => "N",
                            "SET_TITLE" => "N",
                            "SHOW_404" => "N",
                            "SORT_BY1" => "SORT",
                            "SORT_BY2" => "NAME",
                            "SORT_ORDER1" => "ASC",
                            "SORT_ORDER2" => "ASC",
                            "STRICT_SECTION_CHECK" => "N"
                        )
                    );?>

                    <script>
                        $(function () {

                            function catchFrame(fotorama, $frame) {
                                $('#blockCover1672010993 .container').width($(window).width() * 0.8 - 30);
                                fotorama.resize({height: $('.fotorama__html > *', $frame).height()}, 100);
                            }

                            function resizeFotorama() {
                                var fotorama = $('#st1672010993').data('fotorama');
                                if (fotorama) {
                                    var $frame = fotorama.activeFrame.$stageFrame;
                                    catchFrame(fotorama, $frame);
                                }
                            }

                            $('#st1672010993')
                                .on('fotorama:showend', function (e, fotorama) {
                                    var $frame = fotorama.activeFrame.$stageFrame;
                                    if (!$frame.data('state')) {
                                        $frame.on('f:load f:error', function () {
                                            fotorama.activeFrame.$stageFrame === $frame && catchFrame(fotorama, $frame);
                                        });
                                    } else {
                                        catchFrame(fotorama, $frame);
                                    }
                                })
                                .on('fotorama:load', function (e, fotorama) {
                                    if ($('#st1672010993 .fotorama_custom__arr').length == 0) {
                                        $blockBox = $('#st1672010993').parent();
                                        jQuery("<div class='fotorama_custom__arr fotorama_custom__arr--prev fa fa-chevron-left'></div>").appendTo($blockBox);
                                        jQuery("<div class='fotorama_custom__arr fotorama_custom__arr--next fa fa-chevron-right'></div>").appendTo($blockBox);

                                        // навешиваем листание
                                        jQuery('.fotorama_custom__arr--prev').click(function () {
                                            fotorama.show('<');
                                        });
                                        jQuery('.fotorama_custom__arr--next').click(function () {
                                            fotorama.show('>');
                                        });
                                        resizeFotorama();
                                    }
                                });

                            $(window).resize(function () {
                                resizeFotorama();
                            })


                            $('#st1672010993')
                                .fotorama({
                                    "ratio": "16\/9",
                                    "width": "100%",
                                    "loop": true,
                                    "nav": "dots",
                                    "arrows": false
                                });

                        });
                    </script>
                </div>
            </div>
        </div>

        <style>
            #ltBlock1672007379 .block-box {
                background-color: #FFF;
                padding-left: 60px;
                padding-right: 60px;
                padding-top: 30px;
                padding-bottom: 30px;
                border: 2px solid #E3E3E3;
            }
        </style>
    </div>
</div>
