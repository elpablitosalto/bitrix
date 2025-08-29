<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die();
?>


<style>
    #ltBlock1717869130 .rounded-image-wrapper {
        display: none;
    }

    #ltBlock1717869130
    .f-description.lt-tsr-text-part.description {
        font-size: 16px;
    }

    #ltBlock1717869130
    .f-header {
        color: #000000 !important;
    }

    #ltBlock1717869130
    .tsr-header {
        color: #000000 !important;
    }    </style>
<style>
    #ltBlock1717869130 .lt-tsr-block {;
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

    #ltBlock1717869130
    .lt-tsr-block .image-wrapper {
        height: 200px;
    }

    #ltBlock1717869130

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

    #ltBlock1717869130
    .lt-stsr-block .rounded-image {
        width: 150px;
        max-width: 150px;
        border-radius: unset;
        height: 150px;
        margin: 10px auto;
    }    </style>
<style>
    #ltBlock1717869130 .lt-block-wrapper {
        padding-top: 75px;
        padding-bottom: 15px;
        color: #000
    }

    #ltBlock1717869130 .block-set,
    #ltBlock1717869130 .f-text,
    #ltBlock1717869130 .description,
    #ltBlock1717869130 .text,
    #ltBlock1717869130 .image-box,
    #ltBlock1717869130 .lt-form .f-input,
    #ltBlock1717869130 .lt-form .field-label,
    #ltBlock1717869130 .lt-form,
    #ltBlock1717869130 .lt-block .f-btn,
    #ltBlock1717869130,
    #ltBlock1717869130 .lt-menu .right-descr,
    #ltBlock1717869130 .stsr05 .description,
    #ltBlock1717869130 .comment-form-wrapper,
    #ltBlock1717869130 .tag-editor,
    #ltBlock1717869130 .comments-tree a,
    #ltBlock1717869130 div.juxtapose,
    #ltBlock1717869130 .fotorama__caption,
    #ltBlock1717869130 .lt-column-with-icons .column .title,
    #ltBlock1717869130 .stsr05 {
        font-family: 'Montserrat', serif !important
    }


</style>


<div id="ltBlock1717869130" data-block-id="1717872140"
     data-has-css="true" class="lt-block lt-view stsr05 lt-tsr lt-stsr"
     data-code="b-1fd40"
>


    <div class="lazyload lt-block-wrapper block-cover " id="blockCover1717872140"
         style="position: relative; "
         data-bg="//fs-thb03.getcourse.ru/fileservice/file/thumbnail/h/31a52b8f5c6fa57e29071a4cf0efb16b.png/s/s2000x/a/561799/sc/281">
        <div class="cover-filter"></div>
        <div class="cover-wrapper flex-container height-fixed" data-main-class="cover-wrapper">
            <div class="container">
                <div class="row">
                    <div class="modal-block-content block-box col-md-8 col-md-offset-2 text-left"
                         style="color: #000">

                        <?
                        $APPLICATION->IncludeComponent(
                            "bitrix:news.list",
                            "slider_gnv",
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
                                "PARENT_SECTION" => "2",
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



                        <style>
                            #ltBlock1717869130 .lt-stsr-text-part {
                                color: #000
                            }

                        </style>

                        <script>
                            $(function () {

                                function catchFrame(fotorama, $frame) {
                                    $('#blockCover1717872140 .container').width($(window).width() * 0.8 - 30);
                                    fotorama.resize({height: $('.fotorama__html > *', $frame).height()}, 100);
                                }

                                function resizeFotorama() {
                                    var fotorama = $('#st1717872140').data('fotorama');
                                    if (fotorama) {
                                        var $frame = fotorama.activeFrame.$stageFrame;
                                        catchFrame(fotorama, $frame);
                                    }
                                }

                                $('#st1717872140')
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
                                        if ($('#st1717872140 .fotorama_custom__arr').length == 0) {
                                            $blockBox = $('#st1717872140').parent();
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


                                $('#st1717872140')
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
                #ltBlock1717869130 .block-box {
                    background-color: #FFF;
                    padding-left: 60px;
                    padding-right: 60px;
                    padding-top: 30px;
                    padding-bottom: 30px;
                    border: 2px solid #E3E3E3;
                    border-radius: 16px;
                }
            </style>
        </div>
    </div>

    <style media="screen">
        #blockCover1717872140 {
            min-height: 100vh;
            background-attachment: scroll
        }

        @media (max-width: 768px) {
            #blockCover1717872140 {
                background-attachment: scroll;
            }
        }

        .cover-blockCover1717872140 .cover-wrapper {
            height: 100vh;
        }


        #blockCover1717872140 .cover-filter {
            background-image: -moz-linear-gradient(top, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0));
            background-image: -webkit-linear-gradient(top, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0));
            background-image: -o-linear-gradient(top, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0));
            background-image: -ms-linear-gradient(top, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0));
            background-image: linear-gradient(top, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0));
        }

    </style>


</div>

